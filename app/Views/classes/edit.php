<h2>Sửa Thông Tin Lớp Học</h2>

<form action="<?php echo $data['baseUrl']; ?>?url=classes/edit" method="POST" style="max-width: 500px;">
    <input type="hidden" name="id" value="<?php echo $data['class']['id']; ?>">

    <div style="margin-bottom: 15px;">
        <label for="ma_lop">Mã lớp:</label><br>
        <input type="text" id="ma_lop" name="ma_lop" required value="<?php echo htmlspecialchars($data['class']['ma_lop']); ?>" style="width: 100%; padding: 8px;">
    </div>
    
    <div style="margin-bottom: 15px;">
        <label for="ten_lop">Tên lớp:</label><br>
        <input type="text" id="ten_lop" name="ten_lop" required value="<?php echo htmlspecialchars($data['class']['ten_lop']); ?>" style="width: 100%; padding: 8px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="giao_vien_chu_nhiem">Giáo viên chủ nhiệm:</label><br>
        <input type="text" id="giao_vien_chu_nhiem" name="giao_vien_chu_nhiem" value="<?php echo htmlspecialchars($data['class']['giao_vien_chu_nhiem'] ?? ''); ?>" style="width: 100%; padding: 8px;">
    </div>

    <button type="submit" class="btn" style="background: #ffc107;">Lưu thay đổi</button>
    <a href="<?php echo $data['baseUrl']; ?>?url=classes/index" style="display: inline-block; padding: 8px 20px; background: #6c757d; color: white; border-radius: 5px; text-decoration: none; margin-left: 10px;">Hủy</a>
</form>
