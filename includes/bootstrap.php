<?php

declare(strict_types=1);

// Load secrets (API keys, tokens, etc.)
$secretsPath = __DIR__ . '/secrets.php';
if (file_exists($secretsPath)) {
    require_once $secretsPath;
}

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$period_cookie = 2592000; // 30 днів

$utm_keys = ['utm_source', 'utm_medium', 'utm_term', 'utm_content', 'utm_campaign'];

if (!isset($_SESSION['utms']) || !is_array($_SESSION['utms'])) {
    $_SESSION['utms'] = array_fill_keys($utm_keys, '');
}

if (!empty($_GET)) {
    foreach ($utm_keys as $key) {
        if (isset($_GET[$key]) && $_GET[$key] !== '') {
            $val = (string) $_GET[$key];
            setcookie($key, $val, time() + $period_cookie, '/');
            $_SESSION['utms'][$key] = $val;
        }
    }
}

foreach ($utm_keys as $key) {
    if (($_SESSION['utms'][$key] ?? '') === '' && isset($_COOKIE[$key])) {
        $_SESSION['utms'][$key] = (string) $_COOKIE[$key];
    }
}
