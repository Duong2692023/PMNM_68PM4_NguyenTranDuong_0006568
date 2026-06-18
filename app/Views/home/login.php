<style>
    :root{ --bg1:#667eea; --bg2:#764ba2; --card:#ffffff; --muted:#6c757d; --accent:#5b8def; }
    html,body{ height:100%; }
    body{ font-family: Inter, Arial, sans-serif; margin:0; background: linear-gradient(135deg,var(--bg1) 0%, var(--bg2) 100%); display:flex; align-items:center; justify-content:center; }
    .login-area{ width:100%; max-width:1100px; padding:40px 24px; box-sizing:border-box; }
    .stage { background: linear-gradient(180deg, rgba(255,255,255,0.06), rgba(255,255,255,0.02)); padding:48px; border-radius:14px; box-shadow: 0 20px 60px rgba(0,0,0,0.25); display:flex; align-items:center; justify-content:center; }
    .login-card { width:100%; max-width:520px; background:var(--card); border-radius:12px; padding:32px; box-shadow: 0 8px 30px rgba(8,35,63,0.08); transform: translateY(0); animation: pop .28s cubic-bezier(.2,.9,.3,1); }
    @keyframes pop { from { transform: translateY(8px) scale(.995); opacity:0 } to { transform: translateY(0) scale(1); opacity:1 } }
    .login-brand { display:flex; align-items:center; gap:12px; margin-bottom:8px; }
    .brand-badge { width:44px; height:44px; border-radius:8px; background: linear-gradient(135deg,var(--bg1),var(--bg2)); display:flex; align-items:center; justify-content:center; color:white; font-weight:400; box-shadow: 0 6px 18px rgba(102,126,234,0.28); }
    .login-card h2 { margin:6px 0 6px; font-size:22px; color:#111; }
    .login-card p.desc { color:var(--muted); margin-bottom:18px; }

    .form-group { margin-bottom:14px; position:relative; }
    .form-group label { display:block; margin-bottom:8px; color:#333; font-weight:400; }
    .form-control { width:100%; padding:12px 14px; border:1px solid #e6ecf8; border-radius:8px; font-size:15px; transition: box-shadow .12s ease, border-color .12s ease, transform .08s ease; background:#fbfdff; }
    .form-control:focus { outline:none; border-color:var(--accent); box-shadow: 0 8px 20px rgba(91,141,239,0.12); transform: translateY(-1px); }
    .form-row { display:flex; gap:12px; align-items:center; }

    .btn-login { background: linear-gradient(90deg,var(--bg1),var(--bg2)); color:#fff; border:none; padding:10px 18px; border-radius:10px; cursor:pointer; font-size:15px; font-weight:400; box-shadow: 0 8px 20px rgba(118,75,162,0.18); transition: transform .12s ease, box-shadow .12s ease, opacity .12s ease; }
    .btn-login:hover { transform: translateY(-3px); box-shadow: 0 14px 32px rgba(102,126,234,0.18); }
    .btn-login:active { transform: translateY(-1px); }

    .error { background:#fff2f2; color:#b30000; padding:10px 12px; border-radius:8px; margin-bottom:12px; border:1px solid #ffd6d6; }

    .footer-note { margin-top:14px; font-size:13px; color:var(--muted); text-align:center; }

    /* responsive */
    @media (max-width:720px){ .stage{ padding:28px } .login-card{ padding:20px } }
</style>

<div class="login-area">
    <div class="stage">
        <div class="login-card">
            <div class="login-brand">
                <div class="brand-badge">QL</div>
                <div>
                    <h2>Đăng nhập Hệ thống</h2>
                    <div class="desc">Vui lòng nhập tên đăng nhập và mật khẩu để truy cập trang quản trị.</div>
                </div>
            </div>

            <?php if (!empty($_SESSION['error'])): ?>
                <div class="error"><?php echo htmlspecialchars($_SESSION['error']); ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <form method="post" action="<?php echo $data['baseUrl']; ?>?url=auth/login">
                <div class="form-group">
                    <label for="username">Tên đăng nhập</label>
                    <input class="form-control" type="text" id="username" name="username" required placeholder="Nhập tên tài khoản...">
                </div>

                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input class="form-control" type="password" id="password" name="password" required placeholder="Nhập mật khẩu...">
                </div>

                <div style="display:flex; align-items:center; gap:12px; margin-top:8px;">
                    <button type="submit" class="btn-login">Đăng nhập</button>
                </div>
            </form>

            <div class="footer-note">Bạn cần trợ giúp? Liên hệ quản trị viên để lấy lại mật khẩu.</div>
        </div>
    </div>
</div>