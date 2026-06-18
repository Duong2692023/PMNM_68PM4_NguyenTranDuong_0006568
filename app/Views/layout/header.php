<style>
    .topbar { position: fixed; top: 0; left: 0; right: 0; height: 56px; background: #343a40; color: #fff; display: flex; align-items: center; box-shadow: 0 1px 0 rgba(0,0,0,0.06); z-index: 1000; }
    .topbar .inner { width: 1100px; max-width: calc(100% - 40px); margin: 0 auto; display: flex; align-items: center; justify-content: space-between; }
    .topbar .left { display:flex; align-items:center; gap:16px; }
    .topbar .brand, .topbar .brand-btn { font-weight: 700; color: #fff; font-size: 16px; padding: 6px 10px; text-decoration: none; display: inline-flex; align-items: center; }
    .topbar .brand-btn { background: transparent; border: none; cursor: pointer; font-family: inherit; border-radius: 6px; transition: background .14s ease, transform .08s ease; }
    .topbar .brand-btn:hover { background: rgba(255,255,255,0.06); transform: translateY(-2px); }
    .topbar .brand-btn:focus { outline: 2px solid rgba(255,255,255,0.12); outline-offset: 2px; box-shadow: 0 4px 10px rgba(0,0,0,0.12); }
    .topbar .nav { display: flex; gap: 18px; align-items: center; }
    .topbar a { color: #fff; text-decoration: none; font-size: 14px; padding: 8px 10px; }
    .topbar a:hover { opacity: 0.95; }
</style>
<?php $base = isset($data['baseUrl']) ? $data['baseUrl'] : '/'; ?>
<div class="topbar">
    <div class="inner">
        <div class="left">
            <button class="brand-btn" type="button" onclick="window.location='<?php echo $base; ?>?url=home/index'">QLSV</button>
            <div class="nav">
                <a href="<?php echo $base; ?>?url=sinhvien/index">Danh sách</a>
                <a href="<?php echo $base; ?>?url=sinhvien/create">Thêm sinh viên</a>
            </div>
        </div>
        <div class="nav">
            <a href="<?php echo $base; ?>?url=auth/logout">Đăng xuất</a>
        </div>
    </div>
</div>