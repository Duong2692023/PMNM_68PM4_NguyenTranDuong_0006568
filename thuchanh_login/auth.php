<?php
session_start();

// Mảng chứa tài khoản + mật khẩu được phép đăng nhập
$users = [
    'admin' => '123456',
    'duongnt' => '68pm34'
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Xác thực
    if (array_key_exists($username, $users) && $users[$username] === $password) {
        // Đăng nhập đúng
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        header("Location: home.php");
        exit;
    } else {
        // Đăng nhập sai
        $_SESSION['error'] = "sai tên đăng nhập hoặc tài khoản"; // Đúng string yêu cầu
        header("Location: login.php");
        exit;
    }
} else {
    // Truy cập trái phép không qua form
    header("Location: login.php");
    exit;
}
?>