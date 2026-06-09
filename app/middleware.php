<?php
require_once '../app/core/App.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class middleware {
    function checklogin() {
        $urlProcessed = [];
        if (isset($_GET['url'])) {
            $urlProcessed = explode('/', filter_var(trim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        } else {
            $requestUri = $_SERVER['REQUEST_URI'];
            $requestUri = strtok($requestUri, '?');
            $requestUri = trim($requestUri, '/');
            if (!empty($requestUri)) {
                $urlProcessed = explode('/', filter_var($requestUri, FILTER_SANITIZE_URL));
            }
        }
        
        $publicPages = ['home/login', 'auth/login', 'debug.php'];
        
        $currentPage = isset($urlProcessed[0]) && isset($urlProcessed[1]) 
            ? $urlProcessed[0] . '/' . $urlProcessed[1] 
            : ($urlProcessed[0] ?? '');
        
        if (!isset($_SESSION['username']) && !in_array($currentPage, $publicPages)) {
            header('Location: /home/login');
            exit();
        }
    }
}
?>