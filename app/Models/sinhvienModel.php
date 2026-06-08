<?php
// Gọi file DB vừa tạo để sử dụng class ConnectDB
require_once '../app/core/DB.php'; 

class sinhvienModel {
    public function getAll() {
        // Lấy kết nối CSDL thông qua hàm static
        $conn = ConnectDB::Connect(); 
        
        $sql = "SELECT * FROM students"; // Đảm bảo bạn đã có bảng students trong CSDL
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>