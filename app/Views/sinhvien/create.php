<h2>Thêm Sinh Viên Mới</h2>

<form action="/sinhvien/create" method="POST">
    <label for="mssv">Mã số sinh viên:</label>
    <input type="text" id="mssv" name="mssv" required placeholder="Nhập MSSV...">

    <label for="hoten">Họ và Tên:</label>
    <input type="text" id="hoten" name="hoten" required placeholder="Nhập họ và tên...">

    <label for="lop">Lớp:</label>
    <input type="text" id="lop" name="lop" required placeholder="Nhập tên lớp...">

    <button type="submit" class="btn">Lưu thông tin</button>
    <a href="/sinhvien/index" style="margin-left: 10px; color: #555;">Hủy bỏ</a>
</form>