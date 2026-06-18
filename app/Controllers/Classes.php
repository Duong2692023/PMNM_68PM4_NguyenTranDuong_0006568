<?php
class Classes extends Controller {
    
    public function index() {
        $classModel = $this->model('classModel');
        
        $search = trim($_GET['search'] ?? '');
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = isset($_GET['limit']) ? max(1, (int)$_GET['limit']) : 10;
        $offset = ($currentPage - 1) * $limit;

        $result = $classModel->paging($limit, $offset, $search);
        
        $totalRecord = $result['totalRecord'];
        $totalPage = ceil($totalRecord / $limit) ?: 1;

        $this->view('classes/index', [
            'page_title' => 'Danh sách lớp học',
            'classes' => $result['data'],
            'totalRecord' => $totalRecord,
            'totalPage' => $totalPage,
            'currentPage' => $currentPage,
            'search' => $search,
            'limit' => $limit
        ]);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $classModel = $this->model('classModel');
            $classModel->create($_POST['ma_lop'], $_POST['ten_lop'], $_POST['giao_vien_chu_nhiem']);
            header('Location: /PMNM_68PM4_NguyenTranDuong_0006568/public/index.php?url=classes/index');
            exit();
        }
        $this->view('classes/create', ['page_title' => 'Thêm lớp học']);
    }

    public function edit($id = null) {
        $classModel = $this->model('classModel');
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $classModel->update($_POST['id'], $_POST['ma_lop'], $_POST['ten_lop'], $_POST['giao_vien_chu_nhiem']);
            header('Location: /PMNM_68PM4_NguyenTranDuong_0006568/public/index.php?url=classes/index');
            exit();
        }

        $class = $classModel->getById($id);
        $this->view('classes/edit', [
            'page_title' => 'Sửa lớp học',
            'class' => $class
        ]);
    }

    public function delete($id = null) {
        if ($id) {
            $classModel = $this->model('classModel');
            $classModel->delete($id);
        }
        header('Location: /PMNM_68PM4_NguyenTranDuong_0006568/public/index.php?url=classes/index');
        exit();
    }
}
?>
