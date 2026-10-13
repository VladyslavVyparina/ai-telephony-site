<?php

declare(strict_types=1);

session_start();

header('Content-Type: application/json; charset=utf-8');
$accept = (string)($_SERVER['HTTP_ACCEPT'] ?? '');
$expectsJson = stripos($accept, 'application/json') !== false;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'method']);
    exit;
}

$path = __DIR__ . '/includes/secrets.php';
if (!is_readable($path)) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => 'config']);
    exit;
}

require_once $path;

$name = isset($_POST['name']) ? trim((string) $_POST['name']) : '';
$name = mb_substr($name, 0, 200);
$phone = isset($_POST['phone']) ? trim((string) $_POST['phone']) : '';
$phone = mb_substr($phone, 0, 40);
$page = isset($_POST['page']) ? trim((string) $_POST['page']) : '';
$page = mb_substr($page, 0, 200);
$selectedVoice = isset($_POST['selected_voice']) ? trim((string) $_POST['selected_voice']) : '';
$selectedVoice = mb_substr($selectedVoice, 0, 80);
$selectedPlan = isset($_POST['selected_plan']) ? trim((string) $_POST['selected_plan']) : '';
$selectedPlan = mb_substr($selectedPlan, 0, 80);

if ($phone === '') {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'phone']);
    exit;
}

$utm_keys = ['utm_source', 'utm_medium', 'utm_term', 'utm_content', 'utm_campaign'];
$utms = $_SESSION['utms'] ?? [];
if (!is_array($utms)) {
    $utms = [];
}
foreach ($utm_keys as $k) {
    if (isset($_POST[$k])) {
        $pv = trim((string) $_POST[$k]);
        if ($pv !== '') {
            $utms[$k] = $pv;
        }
    }
}

$lines = [
    '<b>Нова заявка</b> ai-agent.website',
    '',
    'Телефон: ' . htmlspecialchars($phone, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'),
];

if ($name !== '') {
    $lines[] = 'Ім’я: ' . htmlspecialchars($name, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
if ($page !== '') {
    $lines[] = 'Сторінка: ' . htmlspecialchars($page, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
if ($selectedVoice !== '') {
    $lines[] = 'Персонаж: ' . htmlspecialchars($selectedVoice, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
if ($selectedPlan !== '') {
    $lines[] = 'План: ' . htmlspecialchars($selectedPlan, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

$lines[] = '';
$lines[] = '<b>UTM</b>';
foreach ($utm_keys as $k) {
    $v = isset($utms[$k]) ? (string) $utms[$k] : '';
    if ($v !== '') {
        $lines[] = $k . ': ' . htmlspecialchars($v, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}

$lines[] = '';
$lines[] = 'IP: ' . htmlspecialchars($_SERVER['REMOTE_ADDR'] ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$lines[] = 'UA: ' . htmlspecialchars(mb_substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 300), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

$text = implode("\n", $lines);

$url = 'https://api.telegram.org/bot' . TELEGRAM_BOT_TOKEN . '/sendMessage';
$post = [
    'chat_id' => TELEGRAM_CHAT_ID,
    'text' => $text,
    'parse_mode' => 'HTML',
    'disable_web_page_preview' => '1',
];

$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $post,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 12,
]);
$response = curl_exec($ch);
$code = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($response === false || $code !== 200) {
    http_response_code(502);
    echo json_encode(['ok' => false, 'error' => 'telegram']);
    exit;
}

$data = json_decode((string) $response, true);
if (!is_array($data) || empty($data['ok'])) {
    http_response_code(502);
    echo json_encode(['ok' => false, 'error' => 'telegram_api']);
    exit;
}

if ($expectsJson) {
    echo json_encode(['ok' => true]);
    exit;
}

header('Location: lead.php?thanks=1&lead=1', true, 302);
exit;
