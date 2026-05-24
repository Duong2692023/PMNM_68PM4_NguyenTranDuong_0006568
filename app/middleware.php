<?php
class middleware {
    function checklogin() {
        // Khai báo đường dẫn gốc của project trên XAMPP
        $basePath = '/PMNM_NguyenTranDuong_68PM4_0006568/public';
        
        // Các trang không cần đăng nhập vẫn vào được
        $publicPages = [
            $basePath . '/',
            $basePath . '/home/login',
            $basePath . '/auth/login' // Cho phép gửi dữ liệu form vào auth
        ];

        // Lấy đường dẫn hiện tại mà người dùng đang truy cập
        $currentUri = strtok($_SERVER['REQUEST_URI'], '?');

        // Nếu chưa có session (chưa đăng nhập) VÀ đang vào một trang không nằm trong publicPages
        if (!isset($_SESSION['username']) && !in_array($currentUri, $publicPages)) {
            header('Location: ' . $basePath . '/home/login');
            exit();
        }
    }
}
?>