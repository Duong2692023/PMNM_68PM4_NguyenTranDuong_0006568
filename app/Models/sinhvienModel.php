<?php
require_once '../app/core/DB.php'; 

class sinhvienModel {
    public function getAll() {
        $conn = ConnectDB::Connect(); 
        $sql = "SELECT * FROM students";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Hàm tạo sinh viên mới
    public function create($mssv, $hoten, $lop) {
        $conn = ConnectDB::Connect();
        $sql = "INSERT INTO students (mssv, hoten, lop) VALUES (:mssv, :hoten, :lop)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':mssv', $mssv);
        $stmt->bindParam(':hoten', $hoten);
        $stmt->bindParam(':lop', $lop);
        return $stmt->execute(); // Trả về true nếu thành công
    }
}
?>