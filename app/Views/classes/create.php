<h2>Thêm Lớp Học Mới</h2>

<form action="<?php echo $data['baseUrl']; ?>?url=classes/create" method="POST" style="max-width: 500px;">
    <div style="margin-bottom: 15px;">
        <label for="ma_lop">Mã lớp:</label><br>
        <input type="text" id="ma_lop" name="ma_lop" required placeholder="Nhập mã lớp..." style="width: 100%; padding: 8px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="ten_lop">Tên lớp:</label><br>
        <input type="text" id="ten_lop" name="ten_lop" required placeholder="Nhập tên lớp..." style="width: 100%; padding: 8px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="giao_vien_chu_nhiem">Giáo viên chủ nhiệm:</label><br>
        <input type="text" id="giao_vien_chu_nhiem" name="giao_vien_chu_nhiem" placeholder="Nhập tên giáo viên..." style="width: 100%; padding: 8px;">
    </div>

    <button type="submit" class="btn" style="background: #28a745;">Lưu thông tin</button>
    <a href="<?php echo $data['baseUrl']; ?>?url=classes/index" style="display: inline-block; padding: 8px 20px; background: #6c757d; color: white; border-radius: 5px; text-decoration: none; margin-left: 10px;">Hủy bỏ</a>
</form>
