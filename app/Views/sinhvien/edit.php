<h3 class="mb-4">Sửa Sinh Viên</h3>

<form action="/sinhvien/edit" method="POST" class="w-50">
    <input type="hidden" name="id" value="<?php echo $data['student']['id']; ?>">

    <div class="mb-3">
        <label class="form-label">Mã số sinh viên:</label>
        <input type="text" name="mssv" class="form-control" required value="<?php echo htmlspecialchars($data['student']['mssv']); ?>">
    </div>
    
    <div class="mb-3">
        <label class="form-label">Họ và Tên:</label>
        <input type="text" name="hoten" class="form-control" required value="<?php echo htmlspecialchars($data['student']['hoten']); ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Lớp:</label>
        <input type="text" name="lop" class="form-control" required value="<?php echo htmlspecialchars($data['student']['lop']); ?>">
    </div>

    <button type="submit" class="btn btn-warning">Lưu thay đổi</button>
    <a href="/sinhvien/index" class="btn btn-secondary ms-2">Hủy</a>
</form>