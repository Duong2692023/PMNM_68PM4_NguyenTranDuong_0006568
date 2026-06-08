<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang chủ</title>
</head>
<body>
    <h2>Chào mừng <?php echo htmlspecialchars($data['username'] ?? ''); ?></h2>
    <p>Bạn đã đăng nhập thành công.</p>
    
    <a href="/auth/logout">Đăng xuất</a> 
</body>
</html>