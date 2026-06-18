<?php
class App
{
    protected $controller = 'Home'; 
    protected $action = 'index';
    protected $params = [];

    public function __construct()
    {
        $urlProcessed = $this->UrlProcess();  
        
        if (isset($urlProcessed[0])) {
            $controllerName = ucfirst($urlProcessed[0]); 
            if (file_exists(__DIR__ . '/../Controllers/' . $controllerName . '.php')) {
                $this->controller = $controllerName;
                unset($urlProcessed[0]);
            }
        }
        
        require_once __DIR__ . '/../Controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller; 

        if (isset($urlProcessed[1])) {
            if (method_exists($this->controller, $urlProcessed[1])) {
                $this->action = $urlProcessed[1];
                unset($urlProcessed[1]);
            }
        }

        $this->params = $urlProcessed ? array_values($urlProcessed) : [];
        call_user_func_array([$this->controller, $this->action], $this->params);
    }

    public function UrlProcess(){
        // Ưu tiên $GET['url'] nếu có
        if (isset($_GET['url'])) {
            return explode('/', filter_var(trim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }

        // Thử URL rewrite nếu không có $_GET['url']
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestUri = strtok($requestUri, '?'); 
        $requestUri = trim($requestUri, '/'); 
        
        // Loại bỏ phần "PMNM_68PM4_NguyenTranDuong_0006568/public" từ URI
        $basePath = 'PMNM_68PM4_NguyenTranDuong_0006568/public';
        if (strpos($requestUri, $basePath) === 0) {
            $requestUri = substr($requestUri, strlen($basePath));
            $requestUri = trim($requestUri, '/');
        }

        if (!empty($requestUri)) {
            return explode('/', filter_var($requestUri, FILTER_SANITIZE_URL));
        }

        // Mặc định về trang chủ
        return []; 
    }
}
?>