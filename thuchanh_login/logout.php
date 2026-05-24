<?php
session_start();

// Xóa tất cả dữ liệu phiên làm việc
session_unset();
session_destroy();

// Trở về trang đăng nhập
header("Location: login.php");
exit;
?>