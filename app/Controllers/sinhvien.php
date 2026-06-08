<?php
class sinhvien extends Controller {
    public function index() {
        $svModel = $this->model('sinhvienModel');
        $dataStudents = $svModel->getAll();
        
        $this->view('sinhvien/index', [
            'page_title' => 'Danh sách sinh viên',
            'students' => $dataStudents
        ]);
    }

    // Action xử lý thêm sinh viên
    public function create() {
        // Kiểm tra xem người dùng có đang bấm nút Submit form (POST) hay không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $mssv = $_POST['mssv'] ?? '';
            $hoten = $_POST['hoten'] ?? '';
            $lop = $_POST['lop'] ?? '';

            // Gọi model để lưu dữ liệu
            $svModel = $this->model('sinhvienModel');
            if ($svModel->create($mssv, $hoten, $lop)) {
                // Thêm thành công -> chuyển hướng về trang danh sách
                header('Location: /sinhvien/index');
                exit();
            }
        }

        // Nếu không phải POST (vào bằng link bình thường), thì hiển thị form
        $this->view('sinhvien/create', [
            'page_title' => 'Thêm sinh viên mới'
        ]);
    }
}
?>