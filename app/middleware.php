<?php
require_once '../app/core/App.php';
session_start();

class middleware {
    function checklogin() {
        // Gắn thêm tên thư mục project vào
        $basePath = '/PMNM_NguyenTranDuong_68PM4_0006568/public';
        $publicPages = [$basePath . '/home/login', $basePath . '/auth/login']; 
        
        if (!isset($_SESSION['username']) && !in_array($_SERVER['REQUEST_URI'], $publicPages)) {
            header('Location: ' . $basePath . '/home/login');
            exit();
        }
    }
}
?>