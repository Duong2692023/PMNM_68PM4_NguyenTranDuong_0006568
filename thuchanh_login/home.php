<?php
session_start();

// Nếu chưa đăng nhập nhưng cố tình nhập URL đến home -> đẩy về login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Dữ liệu mẫu để minh họa phân trang
$users = [
    ['id' => 1, 'username' => 'admin', 'fullname' => 'Nguyễn Văn A', 'role' => 'Quản trị'],
    ['id' => 2, 'username' => 'duongnt', 'fullname' => 'Nguyễn Trần Dương', 'role' => 'Người dùng'],
    ['id' => 3, 'username' => 'linhx', 'fullname' => 'Lê Thị Linh', 'role' => 'Người dùng'],
    ['id' => 4, 'username' => 'hoangp', 'fullname' => 'Hoàng Phương', 'role' => 'Người dùng'],
    ['id' => 5, 'username' => 'tramk', 'fullname' => 'Trần Mỹ Trâm', 'role' => 'Người dùng'],
    ['id' => 6, 'username' => 'hieuqn', 'fullname' => 'Huỳnh Quốc Nhi', 'role' => 'Người dùng'],
];

$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$perPage = 3;
$totalUsers = count($users);
$totalPages = max(1, (int) ceil($totalUsers / $perPage));
if ($page > $totalPages) {
    $page = $totalPages;
}
$start = ($page - 1) * $perPage;
$pagedUsers = array_slice($users, $start, $perPage);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang Chủ</title>
    <style>
        table { border-collapse: collapse; width: 80%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .pagination { margin-top: 15px; }
        .pagination a {
            padding: 8px 12px;
            margin-right: 6px;
            text-decoration: none;
            border: 1px solid #007bff;
            color: #007bff;
            border-radius: 4px;
        }
        .pagination a.active, .pagination a:hover {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>

    <h2>Trang Chủ</h2>
    <p>Chào mừng <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></p>

    <p>Danh sách tài khoản (phân trang):</p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tài khoản</th>
                <th>Họ và tên</th>
                <th>Quyền</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pagedUsers as $user) : ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['fullname']); ?></td>
                    <td><?php echo htmlspecialchars($user['role']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
            <a href="home.php?page=<?php echo $i; ?>" class="<?php echo $i === $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
    </div>

    <a href="logout.php">
        <button style="padding: 5px 15px; margin-top: 10px;">Đăng xuất</button>
    </a>

</body>
</html>
