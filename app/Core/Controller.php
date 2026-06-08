<?php
class Controller {
    // Gọi model
    public function model($model){
        require_once '../app/models/' . $model . '.php';
        return new $model;
    }

    // Gọi view thông qua Layout Master
    public function view($view, $data = []){
        // Biến $viewName chứa đường dẫn tới file view cần hiển thị bên trong master
        $viewName = '../app/views/' . $view . '.php';
        
        // Gọi file layout master (file này sẽ include $viewName ở bên trong)
        require_once '../app/views/layout/master.php';
    }
}
?>