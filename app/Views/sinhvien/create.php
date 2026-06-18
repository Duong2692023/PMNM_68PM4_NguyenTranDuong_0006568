<style>
    .create-wrapper { display:flex; justify-content:center; padding:20px 0; }
    .create-card { width:100%; max-width:760px; background: linear-gradient(180deg,#ffffff 0%, #ffffff 60%); border-radius:10px; padding:22px; box-shadow:0 10px 30px rgba(44,62,80,0.08); border:1px solid rgba(0,0,0,0.03); }
    .create-header { display:flex; align-items:center; gap:14px; margin-bottom:18px; }
    .create-header .dot { width:46px; height:46px; background:linear-gradient(135deg,#6a82fb,#fc5c7d); border-radius:10px; display:flex; align-items:center; justify-content:center; color:#fff; font-weight:400; font-size:20px; box-shadow:0 6px 18px rgba(102,120,255,0.16); }
    .create-header h2 { margin:0; font-size:20px; color:#2b3a42; }
    .create-desc { color:#6c757d; font-size:13px; margin-top:4px; }

    .form-grid { display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-top:12px; }
    .form-group { display:flex; flex-direction:column; }
    .form-group label { font-weight:400; color:#344050; margin-bottom:6px; font-size:13px; }
    .form-control { padding:10px 12px; border:1px solid #e3e8ee; border-radius:6px; font-size:14px; outline:none; transition:box-shadow .15s, border-color .15s; }
    .form-control:focus { box-shadow:0 6px 18px rgba(106,130,251,0.12); border-color:#6a82fb; }

    .fullwidth { grid-column:1 / -1; }

    .actions { display:flex; gap:12px; align-items:center; margin-top:18px; }
    .btn-primary { background:linear-gradient(90deg,#6a82fb,#fc5c7d); color:#fff; padding:10px 18px; border:none; border-radius:8px; cursor:pointer; font-weight:400; box-shadow:0 8px 24px rgba(252,92,125,0.12); }
    .btn-outline { background:#fff; border:1px solid #e6e9ef; padding:9px 16px; border-radius:8px; color:#5b6b77; text-decoration:none; display:inline-flex; align-items:center; }
    .note { color:#6c757d; font-size:13px; margin-left:auto; }

    .pill { display:inline-block; padding:6px 10px; border-radius:20px; background:#20a4b8; color:#fff; font-size:12px; }
    @media (max-width:760px){ .form-grid{ grid-template-columns:1fr; } .create-card{ padding:16px; } }
</style>

<div class="create-wrapper">
    <div class="create-card">
        <div class="create-header">
            <div class="dot">+</div>
            <div>
                <h2>Thêm Sinh Viên Mới</h2>
                <div class="create-desc">Nhập thông tin sinh viên chính xác để lưu vào hệ thống.</div>
            </div>
        </div>

        <form action="<?php echo $data['baseUrl']; ?>?url=sinhvien/create" method="POST">
            <div class="form-grid">
                <div class="form-group">
                    <label for="mssv">Mã số sinh viên</label>
                    <input class="form-control" type="text" id="mssv" name="mssv" required placeholder="Ví dụ: SV001">
                </div>

                <div class="form-group">
                    <label for="hoten">Họ và Tên</label>
                    <input class="form-control" type="text" id="hoten" name="hoten" required placeholder="Nhập họ và tên">
                </div>

                <div class="form-group">
                    <label for="gioi_tinh">Giới tính</label>
                    <select class="form-control" id="gioi_tinh" name="gioi_tinh" required>
                        <option value="">-- Chọn giới tính --</option>
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                        <option value="Khác">Khác</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="lop">Lớp học</label>
                    <select class="form-control" id="lop" name="lop" required>
                        <option value="">-- Chọn lớp --</option>
                        <?php 
                        if (!empty($data['classes'])) {
                            foreach($data['classes'] as $class) {
                                echo "<option value=\"" . htmlspecialchars($class['ten_lop']) . "\">" . htmlspecialchars($class['ten_lop']) . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group fullwidth">
                    <label for="note">Ghi chú (tùy chọn)</label>
                    <input class="form-control" type="text" id="note" name="note" placeholder="Ghi chú về sinh viên">
                </div>
            </div>

            <div class="actions">
                <button type="submit" class="btn-primary">Lưu thông tin</button>
                <a href="<?php echo $data['baseUrl']; ?>?url=sinhvien/index" class="btn-outline">Hủy bỏ</a>
                <div class="note">Bạn có thể thêm nhiều sinh viên sau này.</div>
            </div>
        </form>
    </div>
</div>