<?php
class auth extends Controller {

    protected $user = [
        'admin' => '123456',
        'hieulx' => '123456',
        'duongnt' => '123456' 
    ];

    public function login() {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            if (isset($this->user[$username]) && $this->user[$username] == $password) {
                // Đăng nhập thành công
                $_SESSION['username'] = $username;
                header('Location: /home/index'); 
                exit();
            } else {
                // Đăng nhập thất bại
                $_SESSION['error'] = "Sai tên đăng nhập hoặc mật khẩu";
                header('Location: /home/login'); 
                exit();
            }
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header('Location: /home/login'); 
        exit();
    }
}
?>