<?php
session_start();

// Nếu chưa đăng nhập nhưng cố tình nhập URL đến home -> đẩy về login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang Chủ</title>
</head>
<body>

    <h2>Trang Chủ</h2>
    <p>Chào mừng <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></p>
    
    <a href="logout.php">
        <button style="padding: 5px 15px;">Đăng xuất</button>
    </a>

</body>
</html>