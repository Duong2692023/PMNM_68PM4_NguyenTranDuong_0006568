<?php
require_once __DIR__ . '/../Core/DB.php'; 

class classModel {
    private $conn;

    public function __construct() {
        $this->conn = ConnectDB::Connect();
    }

    public function getAll() {
        $query = "SELECT id, ma_lop, ten_lop, giao_vien_chu_nhiem FROM classes ORDER BY ten_lop ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = "SELECT id, ma_lop, ten_lop, giao_vien_chu_nhiem FROM classes WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($ma_lop, $ten_lop, $giao_vien_chu_nhiem) {
        $query = "INSERT INTO classes (ma_lop, ten_lop, giao_vien_chu_nhiem) VALUES (:ma_lop, :ten_lop, :giao_vien_chu_nhiem)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':ma_lop' => $ma_lop, 
            ':ten_lop' => $ten_lop,
            ':giao_vien_chu_nhiem' => $giao_vien_chu_nhiem
        ]);
    }

    public function update($id, $ma_lop, $ten_lop, $giao_vien_chu_nhiem) {
        $query = "UPDATE classes SET ma_lop = :ma_lop, ten_lop = :ten_lop, giao_vien_chu_nhiem = :giao_vien_chu_nhiem WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':id' => $id,
            ':ma_lop' => $ma_lop,
            ':ten_lop' => $ten_lop,
            ':giao_vien_chu_nhiem' => $giao_vien_chu_nhiem
        ]);
    }

    public function delete($id) {
        $query = "DELETE FROM classes WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':id' => $id]);
    }

    public function paging($limit = 10, $offset = 0, $search = "") {
        $query = "SELECT id, ma_lop, ten_lop, giao_vien_chu_nhiem FROM classes 
                  WHERE ma_lop LIKE :search OR ten_lop LIKE :search 
                  ORDER BY ten_lop ASC 
                  LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        $searchParam = "%$search%";
        $stmt->bindParam(':search', $searchParam);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $queryTotal = "SELECT COUNT(*) FROM classes WHERE ma_lop LIKE :search OR ten_lop LIKE :search";
        $stmtTotal = $this->conn->prepare($queryTotal);
        $stmtTotal->bindParam(':search', $searchParam);
        $stmtTotal->execute();
        $totalRecord = $stmtTotal->fetchColumn();

        return [
            'data' => $data,
            'totalRecord' => $totalRecord
        ];
    }
}
?>
