<?php
class App
{
    protected $controller = 'Home'; // Đổi thành viết hoa chữ cái đầu cho chuẩn tên Class
    protected $action = 'index';
    protected $params = [];

    public function __construct()
    {
        $urlProcessed = $this->UrlProcess();  
        
        // Kiểm tra Controller
        if (isset($urlProcessed[0])) {
            // Chữ cái đầu viết hoa để khớp tên file (VD: home -> Home)
            $controllerName = ucfirst($urlProcessed[0]); 
            if (file_exists('../app/controllers/' . $controllerName . '.php')) {
                $this->controller = $controllerName;
                unset($urlProcessed[0]);
            }
        }
        
        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller; // Tạo đối tượng controller

        // Kiểm tra Action
        if (isset($urlProcessed[1])) {
            if (method_exists($this->controller, $urlProcessed[1])) {
                $this->action = $urlProcessed[1];
                unset($urlProcessed[1]);
            }
        }

        // Lấy Params
        $this->params = $urlProcessed ? array_values($urlProcessed) : [];
        call_user_func_array([$this->controller, $this->action], $this->params);
    }

    public function UrlProcess(){
        // Cách 1: Ưu tiên lấy URL từ .htaccess (nếu đang chạy XAMPP)
        if (isset($_GET['url'])) {
            return explode('/', filter_var(trim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }

        // Cách 2: Lấy trực tiếp từ thanh địa chỉ (khi chạy bằng PHP Built-in Server)
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestUri = strtok($requestUri, '?'); // Cắt bỏ các tham số phía sau dấu ?
        $requestUri = trim($requestUri, '/');   // Xóa dấu gạch chéo dư thừa

        if (!empty($requestUri)) {
            return explode('/', filter_var($requestUri, FILTER_SANITIZE_URL));
        }

        return []; // Trả về mảng rỗng nếu đang ở trang gốc
    }
}
?>