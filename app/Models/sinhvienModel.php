<?php
require_once '../app/core/DB.php'; 

class sinhvienModel {
    private $conn;

    public function __construct() {
        $this->conn = ConnectDB::Connect();
    }

    public function paging($limit = 5, $offset = 0, $search = "") {
        $query = "SELECT * FROM students WHERE hoten LIKE :search OR mssv LIKE :search LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        $searchParam = "%$search%";
        $stmt->bindParam(':search', $searchParam);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $queryTotal = "SELECT COUNT(*) FROM students WHERE hoten LIKE :search OR mssv LIKE :search";
        $stmtTotal = $this->conn->prepare($queryTotal);
        $stmtTotal->bindParam(':search', $searchParam);
        $stmtTotal->execute();
        $totalRecord = $stmtTotal->fetchColumn();

        return [
            'data' => $data,
            'totalRecord' => $totalRecord
        ];
    }

    public function create($mssv, $hoten, $lop) {
        $sql = "INSERT INTO students (mssv, hoten, lop) VALUES (:mssv, :hoten, :lop)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':mssv' => $mssv, ':hoten' => $hoten, ':lop' => $lop]);
    }

    public function getById($id) {
        $sql = "SELECT * FROM students WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $mssv, $hoten, $lop) {
        $sql = "UPDATE students SET mssv = :mssv, hoten = :hoten, lop = :lop WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':mssv' => $mssv, ':hoten' => $hoten, ':lop' => $lop, ':id' => $id]);
    }

    public function delete($id) {
        $sql = "DELETE FROM students WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
?> 