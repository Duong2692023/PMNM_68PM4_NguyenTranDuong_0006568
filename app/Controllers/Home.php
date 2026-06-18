<?php
class Home extends Controller {

    public function index() {
        $this->view('home/index', ['username' => $_SESSION['username'] ?? '']);
    }

    public function login() {
        if (isset($_SESSION['username'])) {
            header('Location: /PMNM_68PM4_NguyenTranDuong_0006568/public/index.php?url=home/index');
            exit();
        }
        $this->view('home/login');
    }
}
?>