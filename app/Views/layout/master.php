<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><?php echo $data['page_title'] ?? 'Quản lý Sinh Viên'; ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; padding-top: 72px; background-color: #f9f9f9; }
        .container { max-width: 1100px; width: calc(100% - 40px); margin: 0 auto; background: white; padding: 18px; box-shadow: 0 0 6px rgba(0,0,0,0.06); border-radius:4px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn { padding: 8px 15px; background: #28a745; color: white; border: none; cursor: pointer; text-decoration: none; display: inline-block; }
        input[type="text"] { width: 100%; padding: 8px; margin-bottom: 15px; box-sizing: border-box; }
    </style>
</head>
<body>

    <?php require_once __DIR__ . '/header.php'; ?>

    <div class="container">
        <?php 
        // Nạp file view cụ thể (ví dụ: index.php hoặc create.php)
        if(isset($viewName) && file_exists($viewName)) {
            require_once $viewName; 
        }
        ?>
    </div>

    <?php require_once __DIR__ . '/footer.php'; ?>

</body>
</html>