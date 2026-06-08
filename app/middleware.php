<?php
require_once '../app/core/App.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class middleware {
    function checklogin() {
        // Cắt bỏ phần query string đằng sau dấu ? để so sánh chính xác
        $currentUri = strtok($_SERVER['REQUEST_URI'], '?');
        $publicPages = ['/home/login', '/auth/login']; 
        
        if (!isset($_SESSION['username']) && !in_array($currentUri, $publicPages)) {
            header('Location: /home/login');
            exit();
        }
    }
}
?>