<?php

declare(strict_types=1);

session_start();

header('Content-Type: application/json; charset=utf-8');

function demo_user_message(string $error, bool $is_en = false): string
{
    switch ($error) {
        case 'phone_required':
            return $is_en ? 'Please enter your phone number.' : 'Введіть номер телефону.';
        case 'invalid_phone':
            return $is_en
                ? 'Invalid phone format. Use +380XXXXXXXXX.'
                : 'Некоректний формат. Введіть номер у форматі +380XXXXXXXXX.';
        case 'rate_limit':
            return $is_en
                ? 'Demo call already requested. Please wait 30 minutes.'
                : 'Демо-дзвінок вже замовлено. Повторіть через 30 хвилин.';
        case 'crm_not_configured':
        case 'crm_unreachable':
        case 'crm_error':
            return $is_en
                ? 'Demo calls are temporarily unavailable. Please try again later.'
                : 'Демо-дзвінки тимчасово недоступні. Спробуйте пізніше.';
        default:
            return $is_en
                ? 'Could not process your request. Please try again later.'
                : 'Не вдалося обробити запит. Спробуйте пізніше.';
    }
}

function normalize_phone_ua(string $phone): string
{
    $digits = preg_replace('/\D+/', '', $phone) ?? '';
    if ($digits === '') {
        return '';
    }
    if (strlen($digits) === 12 && str_starts_with($digits, '380')) {
        return '+' . $digits;
    }
    if (strlen($digits) === 10) {
        return '+38' . $digits;
    }
    if (strlen($digits) === 11 && str_starts_with($digits, '8')) {
        return '+3' . $digits;
    }
    if (strlen($digits) === 12) {
        return '+' . $digits;
    }
    return '+' . $digits;
}

function respond_error(string $error, int $http_code = 400, ?string $log_detail = null): void
{
    if ($log_detail !== null) {
        error_log('[demo-call] ' . $error . ': ' . $log_detail);
    }
    http_response_code($http_code);
    echo json_encode([
        'ok' => false,
        'error' => $error,
        'message' => demo_user_message($error),
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond_error('method', 405);
}

$secrets_path = __DIR__ . '/includes/secrets.php';
if (!is_readable($secrets_path)) {
    respond_error('crm_not_configured', 503, 'secrets.php missing');
}
require_once $secrets_path;

$raw = file_get_contents('php://input');
$data = json_decode((string) $raw, true);
if (!is_array($data)) {
    $data = $_POST;
}

$phone = normalize_phone_ua(isset($data['phone']) ? trim((string) $data['phone']) : '');
$name  = isset($data['name']) ? trim((string) $data['name']) : '';
$name  = mb_substr($name, 0, 200);

if ($phone === '' || strlen(preg_replace('/\D+/', '', $phone)) < 12) {
    respond_error('invalid_phone', 400, 'raw phone=' . (string) ($data['phone'] ?? ''));
}

/* ── Rate limiting: max 1 demo call per IP per 30 minutes ── */
$rate_key = 'demo_call_' . md5($_SERVER['REMOTE_ADDR'] ?? '');
if (isset($_SESSION[$rate_key]) && (time() - (int) $_SESSION[$rate_key]) < 1800) {
    respond_error('rate_limit', 429);
}

$crm_url   = defined('CRM_API_URL')   ? trim((string) CRM_API_URL)   : '';
$crm_token = defined('CRM_API_TOKEN') ? trim((string) CRM_API_TOKEN) : '';

if ($crm_url === '') {
    respond_error('crm_not_configured', 503, 'CRM_API_URL is empty in secrets.php');
}

$payload = json_encode(['phone' => $phone, 'name' => $name], JSON_UNESCAPED_UNICODE);
$crm_endpoint = rtrim($crm_url, '/') . '/api/website-demo-call';

$ch = curl_init($crm_endpoint);
curl_setopt_array($ch, [
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => $payload,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT        => 25,
    CURLOPT_CONNECTTIMEOUT => 10,
    CURLOPT_HTTPHEADER     => [
        'Content-Type: application/json',
        'Accept: application/json',
        'x-admin-token: ' . $crm_token,
    ],
]);
$crm_response = curl_exec($ch);
$curl_error   = curl_error($ch);
$crm_code     = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($crm_response === false) {
    respond_error('crm_unreachable', 502, 'curl: ' . $curl_error . ' url=' . $crm_endpoint);
}

$crm_data = json_decode((string) $crm_response, true);
if (!is_array($crm_data)) {
    respond_error('crm_error', 502, 'invalid JSON from CRM, http=' . $crm_code);
}

if (empty($crm_data['ok'])) {
    $crm_error = (string) ($crm_data['error'] ?? 'crm_error');
    if ($crm_error === 'invalid_phone') {
        respond_error('invalid_phone', 400, 'CRM rejected phone=' . $phone);
    }
    respond_error('crm_error', 502, 'CRM http=' . $crm_code . ' error=' . $crm_error);
}

/* ── Notify Telegram ── */
if (defined('TELEGRAM_BOT_TOKEN') && defined('TELEGRAM_CHAT_ID')) {
    $lines = [
        '<b>📞 Демо-дзвінок з сайту</b>',
        '',
        'Телефон: ' . htmlspecialchars($phone, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'),
    ];
    if ($name !== '') {
        $lines[] = 'Ім\'я: ' . htmlspecialchars($name, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
    if (!empty($crm_data['lead_id'])) {
        $lines[] = 'CRM lead #' . (int) $crm_data['lead_id'];
    }
    $lines[] = '';
    $lines[] = 'IP: ' . htmlspecialchars($_SERVER['REMOTE_ADDR'] ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

    $tg_url  = 'https://api.telegram.org/bot' . TELEGRAM_BOT_TOKEN . '/sendMessage';
    $tg_post = [
        'chat_id'                  => TELEGRAM_CHAT_ID,
        'text'                     => implode("\n", $lines),
        'parse_mode'               => 'HTML',
        'disable_web_page_preview' => '1',
    ];
    $tg_ch = curl_init($tg_url);
    curl_setopt_array($tg_ch, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $tg_post,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 10,
    ]);
    curl_exec($tg_ch);
    curl_close($tg_ch);
}

$_SESSION[$rate_key] = time();

echo json_encode([
    'ok' => true,
    'message' => 'Ваш номер прийнято. AI-агент зателефонує вам протягом хвилини!',
], JSON_UNESCAPED_UNICODE);
exit;
