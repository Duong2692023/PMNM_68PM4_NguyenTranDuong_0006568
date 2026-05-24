<?php
session_start();

// Nếu đã đăng nhập thì chặn không cho vào lại form login, đẩy thẳng đến home
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header("Location: home.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập hệ thống</title>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; margin-top: 50px; }
        .login-box { border: 1px solid #ccc; padding: 20px; width: 300px; border-radius: 8px; }
        .error { color: red; font-weight: bold; margin-bottom: 10px; font-size: 14px; }
        input { width: 100%; padding: 8px; margin: 10px 0; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
    </style>
</head>
<body>

<div class="login-box">
    <h3>Đăng nhập</h3>
    
    <?php
    // Hiển thị lỗi nếu có từ auth.php gửi sang
    if (isset($_SESSION['error'])) {
        echo '<div class="error">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']); // Xóa lỗi đi để F5 không hiện lại
    }
    ?>

    <form action="auth.php" method="POST">
        <label>Tài khoản:</label>
        <input type="text" name="username" required>

        <label>Mật khẩu:</label>
        <input type="password" name="password" required>

        <button type="submit">Đăng nhập</button>
    </form>
</div>

</body>
</html>