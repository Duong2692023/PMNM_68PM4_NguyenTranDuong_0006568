<?php
require_once '../app/core/App.php';
session_start();

class middleware {
    function checklogin() {
        // Danh sách các trang không cần đăng nhập
        // Lưu ý: Mình bổ sung thêm '/auth/login' vào mảng này so với trên bảng
        // để form đăng nhập của bạn có thể gửi POST request đi mà không bị chặn lại.
        $publicPages = ['/home/login', '/auth/login']; 
        
        if (!isset($_SESSION['username']) && !in_array($_SERVER['REQUEST_URI'], $publicPages)) {
            header('Location: /home/login');
            exit();
        }
    }
}
?>