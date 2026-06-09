<?php
class home extends Controller {
    
    public function index() {

        $this->view('home/index', ['username' => $_SESSION['username'] ?? '']);
    }

    public function login() {

        if (isset($_SESSION['username'])) {
            header('Location: /PMNM_NguyenTranDuong_68PM4_0006568/public/home/index');
            exit();
        }
        $this->view('home/login');
    }
}
?>