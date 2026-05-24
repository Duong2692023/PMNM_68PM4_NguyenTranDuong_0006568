<?php
class home extends Controller {
    
    // Trang chủ sau khi đăng nhập
    public function index() {
        // Truyền tên username sang View
        $this->view('home/index', ['username' => $_SESSION['username'] ?? '']);
    }

    // Trang hiển thị form đăng nhập
    public function login() {
        // Nếu đã đăng nhập rồi thì không cho vào form login nữa
        if (isset($_SESSION['username'])) {
            header('Location: /PMNM_NguyenTranDuong_68PM4_0006568/public/home/index');
            exit();
        }
        $this->view('home/login');
    }
}
?>