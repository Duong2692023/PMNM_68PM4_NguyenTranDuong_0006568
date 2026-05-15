<?php
class Home extends Controller {
    
    // Action mặc định
    public function index() {
        // 1. Gọi Model StudentModel
        $studentModel = $this->model('StudentModel');
        
        // 2. Lấy dữ liệu từ database
        $listStudents = $studentModel->getAllStudents();

        // 3. Gọi View và truyền dữ liệu dạng mảng key => value
        $this->view('student_list', [
            'page_title' => 'Danh sách sinh viên',
            'students' => $listStudents
        ]);
    }
}
?>