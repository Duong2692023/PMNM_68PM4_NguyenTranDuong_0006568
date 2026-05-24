<?php
class Database {
    public $conn;
    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "";
    // Đổi mvc_demo thành tên database thực tế của bạn
    protected $dbname = "pmnm_68pm4_nguyentranduong_0006568";

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname;charset=utf8", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Lỗi kết nối CSDL: " . $e->getMessage();
        }
    }
}
?>