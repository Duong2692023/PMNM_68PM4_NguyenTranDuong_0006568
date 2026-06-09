<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><?php echo $data['page_title']; ?></title>
    <style>
        table { width: 50%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

    <h2><?php echo $data['page_title']; ?></h2>

    <p><strong>URL bạn đang truy cập:</strong> 
        <?php echo isset($_GET['url']) ? '/' . $_GET['url'] : 'Trang chủ mặc định (Chưa nhập URL)'; ?>
    </p>

    <p><strong>Tổng số sinh viên:</strong> <?php echo $data['totalStudents']; ?></p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>MSSV</th>
                <th>Họ và Tên</th>
                <th>Lớp</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            // Vòng lặp in dữ liệu sinh viên
            foreach($data['students'] as $student) {
                echo "<tr>";
                echo "<td>" . $student['id'] . "</td>";
                echo "<td>" . $student['mssv'] . "</td>";
                echo "<td>" . $student['hoten'] . "</td>";
                echo "<td>" . $student['lop'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Phân trang -->
    <div style="margin-top: 20px;">
        <p>Trang <?php echo $data['currentPage']; ?> / <?php echo $data['totalPages']; ?></p>
        
        <div>
            <!-- Nút Previous -->
            <?php if ($data['currentPage'] > 1): ?>
                <a href="/sinhvien/index?page=<?php echo $data['currentPage'] - 1; ?>">← Trang trước</a>
            <?php else: ?>
                <span style="color: gray;">← Trang trước</span>
            <?php endif; ?>

            <!-- Các nút số trang -->
            <?php 
            for ($i = 1; $i <= $data['totalPages']; $i++) {
                if ($i == $data['currentPage']) {
                    echo "<strong>[$i]</strong> ";
                } else {
                    echo "<a href=\"/sinhvien/index?page=$i\">[$i]</a> ";
                }
            }
            ?>

            <!-- Nút Next -->
            <?php if ($data['currentPage'] < $data['totalPages']): ?>
                <a href="/sinhvien/index?page=<?php echo $data['currentPage'] + 1; ?>">Trang sau →</a>
            <?php else: ?>
                <span style="color: gray;">Trang sau →</span>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>