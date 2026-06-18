<?php
class Sinhvien extends Controller {
    
    public function index() {
        $svModel = $this->model('sinhvienModel');
        $classModel = $this->model('classModel');
        
        $search = trim($_GET['search'] ?? '');
        $lop = trim($_GET['lop'] ?? '');
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = isset($_GET['limit']) ? max(1, (int)$_GET['limit']) : 10;
        $offset = ($currentPage - 1) * $limit;

        // sorting
        $allowedSort = ['mssv','hoten','lop','gioi_tinh'];
        $sort = isset($_GET['sort']) ? trim($_GET['sort']) : '';
        $dir = isset($_GET['dir']) ? strtolower(trim($_GET['dir'])) : 'asc';
        if (!in_array($sort, $allowedSort)) $sort = '';
        if ($dir !== 'asc' && $dir !== 'desc') $dir = 'asc';

        $result = $svModel->paging($limit, $offset, $search, $lop, $sort, $dir);
        
        $totalRecord = $result['totalRecord'];
        $totalPage = ceil($totalRecord / $limit);

        $classes = $classModel->getAll();

        $this->view('sinhvien/index', [
            'page_title' => 'Danh sách sinh viên',
            'students' => $result['data'],
            'totalRecord' => $result['totalRecord'],
            'totalPage' => $totalPage,
            'currentPage' => $currentPage,
            'search' => $search,
            'limit' => $limit,
            'sort' => $sort,
            'dir' => $dir,
            'classes' => $classes,
            'lop' => $lop
        ]);
    }

    public function create() {
        $svModel = $this->model('sinhvienModel');
        $classModel = $this->model('classModel');
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $lop = $_POST['lop'] ?? '';
            $svModel->create($_POST['mssv'], $_POST['hoten'], $_POST['gioi_tinh'], $lop);
            header('Location: /PMNM_68PM4_NguyenTranDuong_0006568/public/index.php?url=sinhvien/index');
            exit();
        }
        
        $classes = $classModel->getAll();
        $this->view('sinhvien/create', [
            'page_title' => 'Thêm sinh viên',
            'classes' => $classes
        ]);
    }

    public function edit($id = null) {
        $svModel = $this->model('sinhvienModel');
        $classModel = $this->model('classModel');
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $lop = $_POST['lop'] ?? '';
            $svModel->update($_POST['id'], $_POST['mssv'], $_POST['hoten'], $_POST['gioi_tinh'], $lop);
            header('Location: /PMNM_68PM4_NguyenTranDuong_0006568/public/index.php?url=sinhvien/index');
            exit();
        }

        $student = $svModel->getById($id);
        $classes = $classModel->getAll();
        $this->view('sinhvien/edit', [
            'page_title' => 'Sửa sinh viên',
            'student' => $student,
            'classes' => $classes
        ]);
    }

    public function delete($id = null) {
        if ($id) {
            $svModel = $this->model('sinhvienModel');
            $svModel->delete($id);
        }
        header('Location: /PMNM_68PM4_NguyenTranDuong_0006568/public/index.php?url=sinhvien/index');
        exit();
    }
}
?>