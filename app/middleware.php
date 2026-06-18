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
            
            // Loại bỏ phần "PMNM_68PM4_NguyenTranDuong_0006568/public" từ URI
            $basePath = 'PMNM_68PM4_NguyenTranDuong_0006568/public';
            if (strpos($requestUri, $basePath) === 0) {
                $requestUri = substr($requestUri, strlen($basePath));
                $requestUri = trim($requestUri, '/');
            }
            
            if (!empty($requestUri)) {
                $urlProcessed = explode('/', filter_var($requestUri, FILTER_SANITIZE_URL));
            }
        }
        
        $publicPages = ['home/login', 'auth/login', 'debug.php', 'home'];
        
        $currentPage = isset($urlProcessed[0]) && isset($urlProcessed[1]) 
            ? $urlProcessed[0] . '/' . $urlProcessed[1] 
            : ($urlProcessed[0] ?? '');
        
        if (!isset($_SESSION['username']) && !in_array($currentPage, $publicPages)) {
            header('Location: /PMNM_68PM4_NguyenTranDuong_0006568/public/index.php?url=home/login');
            exit();
        }
    }
}
?>