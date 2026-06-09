<?php
class Home extends Controller {

    public function index() {
        $this->view('home/index', ['username' => $_SESSION['username'] ?? '']);
    }

    public function login() {
        if (isset($_SESSION['username'])) {
            header('Location: /home/index');
            exit();
        }
        $this->view('home/login');
    }
}
?>