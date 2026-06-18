<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang chủ</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .container { background: white; padding: 40px; border-radius: 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.3); max-width: 600px; text-align: center; }
        h2 { color: #333; margin-bottom: 10px; font-size: 32px; }
        .welcome-text { color: #666; margin-bottom: 30px; font-size: 16px; }
        .menu { display: flex; gap: 15px; justify-content: center; flex-wrap: wrap; }
        .menu-btn { display: inline-block; padding: 15px 30px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-decoration: none; border-radius: 5px; font-weight: 400; transition: transform 0.3s; }
        .menu-btn:hover { transform: translateY(-3px); box-shadow: 0 5px 15px rgba(0,0,0,0.2); }
        .logout-btn { background: #dc3545; }
        .logout-btn:hover { background: #c82333; }
    </style>
</head>
<body>
    <div class="container">
        <h2>👋 Chào mừng, <?php echo htmlspecialchars($data['username'] ?? 'Người dùng'); ?></h2>
        <p class="welcome-text">Bạn đã đăng nhập thành công vào hệ thống quản lý sinh viên.</p>
        
        <div class="menu">
            <a href="<?php echo $data['baseUrl']; ?>?url=sinhvien/index" class="menu-btn">📚 Quản lý Sinh viên</a>
            <a href="<?php echo $data['baseUrl']; ?>?url=classes/index" class="menu-btn">🏫 Quản lý Lớp học</a>
            <a href="<?php echo $data['baseUrl']; ?>?url=auth/logout" class="menu-btn logout-btn">🚪 Đăng xuất</a>
        </div>
    </div>
</body>
</html>