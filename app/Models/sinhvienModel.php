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

    // Lấy số lượng tổng cộng các sinh viên
    public function getTotalCount() {
        $conn = ConnectDB::Connect();
        $sql = "SELECT COUNT(*) as total FROM students";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    // Lấy sinh viên với phân trang
    public function getPaginated($limit = 5, $offset = 0) {
        $conn = ConnectDB::Connect();
        $sql = "SELECT * FROM students LIMIT :limit OFFSET :offset";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
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