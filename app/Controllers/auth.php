<?php
class Auth extends Controller {

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
                $_SESSION['username'] = $username;
                header('Location: /PMNM_68PM4_NguyenTranDuong_0006568/public/index.php?url=home/index');
                exit();
            } else {
                // Đăng nhập thất bại
                $_SESSION['error'] = "Sai tên đăng nhập hoặc mật khẩu";
                header('Location: /PMNM_68PM4_NguyenTranDuong_0006568/public/index.php?url=home/login'); 
                exit();
            }
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header('Location: /PMNM_68PM4_NguyenTranDuong_0006568/public/index.php?url=home/login'); 
        exit();
    }
}
?>