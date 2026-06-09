<?php
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$request_uri = ltrim($request_uri, '/');

if (strpos($request_uri, 'public/') === 0) {
    $request_uri = substr($request_uri, 7);
}

$file = __DIR__ . '/' . urldecode($request_uri);

if (is_file($file) || is_dir($file)) {
    return false;
}

$_GET['url'] = trim($request_uri, '/');
require __DIR__ . '/index.php';
?>
