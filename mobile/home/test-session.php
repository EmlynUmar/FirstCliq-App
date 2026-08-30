<?php
ini_set("session.use_only_cookies", 1);
ini_set("session.use_strict_mode", 1);
session_set_cookie_params([
    'lifetime' => 365 * 24 * 60 * 60,
    'path' => '/',
    'secure' => false,
    'httponly' => true,
    'samesite' => 'Lax'
]);
session_start();

if (!isset($_SESSION['test_count'])) {
    $_SESSION['test_count'] = 1;
} else {
    $_SESSION['test_count']++;
}

header('Content-Type: application/json');
echo json_encode([
    'status' => 'success',
    'session_id' => session_id(),
    'session_data' => $_SESSION,
    'cookies' => $_COOKIE,
    'server_https' => isset($_SERVER['HTTPS']) ? $_SERVER['HTTPS'] : 'not set',
    'server_name' => $_SERVER['SERVER_NAME']
]);
