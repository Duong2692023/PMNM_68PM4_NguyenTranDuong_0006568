<?php
session_start();

// Nạp các file core và middleware
require_once '../app/core/App.php';
require_once '../app/core/Controller.php';
// require_once '../app/core/Database.php'; // Bỏ comment nếu bạn có dùng database
require_once '../app/middleware.php';

// Chạy Middleware bảo vệ route
$middleware = new middleware();
$middleware->checklogin();

// Khởi chạy hệ thống MVC
$app = new App();
?>