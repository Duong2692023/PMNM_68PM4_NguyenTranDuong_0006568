<?php
session_start();

// Nạp các file core
require_once '../app/core/App.php';
require_once '../app/core/Controller.php';
require_once '../app/core/Database.php';

// Khởi chạy App
$app = new App();
?>