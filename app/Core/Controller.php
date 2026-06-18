<?php
class Controller {
    public function model($model){
        require_once __DIR__ . '/../Models/' . $model . '.php';
        return new $model;
    }

    public function view($view, $data = []){
        // Thêm baseUrl vào data
        $data['baseUrl'] = '/PMNM_68PM4_NguyenTranDuong_0006568/public/index.php';
        
        $viewName = __DIR__ . '/../Views/' . $view . '.php';
        
        require_once __DIR__ . '/../Views/layout/master.php';
    }
}
?>