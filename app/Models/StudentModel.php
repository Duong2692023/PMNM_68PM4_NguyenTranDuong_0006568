<?php
class StudentModel extends Database {
    public function getAllStudents() {
        $sql = "SELECT * FROM students";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về mảng dữ liệu
    }
}
?>