<?php
class Controller {
    // Gọi model
    public function model($model){
        require_once '../app/models/' . $model . '.php';
        return new $model;
    }

    // Gọi view và truyền dữ liệu
    public function view($view, $data = []){
        require_once '../app/views/' . $view . '.php';
    }
}
?>