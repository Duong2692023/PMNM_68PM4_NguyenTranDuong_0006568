<?php
class sinhvien extends Controller {
    public function index() {
        $svModel = $this->model('sinhvienModel');
        
        // Cài đặt số lượng sinh viên trên mỗi trang
        $itemsPerPage = 5;
        
        // Lấy trang hiện tại từ URL, mặc định là trang 1
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        
        // Đảm bảo trang hiện tại không nhỏ hơn 1
        if ($currentPage < 1) {
            $currentPage = 1;
        }
        
        // Tính toán offset
        $offset = ($currentPage - 1) * $itemsPerPage;
        
        // Lấy tổng số sinh viên
        $totalStudents = $svModel->getTotalCount();
        
        // Tính tổng số trang
        $totalPages = ceil($totalStudents / $itemsPerPage);
        
        // Nếu trang hiện tại vượt quá tổng số trang, set về trang cuối
        if ($currentPage > $totalPages && $totalPages > 0) {
            $currentPage = $totalPages;
            $offset = ($currentPage - 1) * $itemsPerPage;
        }
        
        // Lấy dữ liệu sinh viên cho trang hiện tại
        $dataStudents = $svModel->getPaginated($itemsPerPage, $offset);
        
        $this->view('sinhvien/index', [
            'page_title' => 'Danh sách sinh viên',
            'students' => $dataStudents,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'totalStudents' => $totalStudents,
            'itemsPerPage' => $itemsPerPage
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