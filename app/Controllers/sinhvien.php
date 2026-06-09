<?php
class Sinhvien extends Controller {
    
    public function index() {
        $svModel = $this->model('sinhvienModel');
        
        $search = $_GET['search'] ?? '';
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        
        $limit = 5; 
        $offset = ($currentPage - 1) * $limit;

        $result = $svModel->paging($limit, $offset, $search);
        
        $totalRecord = $result['totalRecord'];
        $totalPage = ceil($totalRecord / $limit);

        $this->view('sinhvien/index', [
            'page_title' => 'Danh sách sinh viên',
            'students' => $result['data'],
            'totalPage' => $totalPage,
            'currentPage' => $currentPage,
            'search' => $search
        ]);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $svModel = $this->model('sinhvienModel');
            $svModel->create($_POST['mssv'], $_POST['hoten'], $_POST['lop']);
            header('Location: /sinhvien/index');
            exit();
        }
        $this->view('sinhvien/create', ['page_title' => 'Thêm sinh viên']);
    }

    public function edit($id = null) {
        $svModel = $this->model('sinhvienModel');
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $svModel->update($_POST['id'], $_POST['mssv'], $_POST['hoten'], $_POST['lop']);
            header('Location: /sinhvien/index');
            exit();
        }

        $student = $svModel->getById($id);
        $this->view('sinhvien/edit', [
            'page_title' => 'Sửa sinh viên',
            'student' => $student
        ]);
    }

    public function delete($id = null) {
        if ($id) {
            $svModel = $this->model('sinhvienModel');
            $svModel->delete($id);
        }
        header('Location: /sinhvien/index');
        exit();
    }
}
?>