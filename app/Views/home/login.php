<h2>Đăng nhập Hệ thống</h2>

<?php if (!empty($_SESSION['error'])): ?>
    <p style="color:red; font-weight: bold;"><?php echo htmlspecialchars($_SESSION['error']); ?></p>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<form method="post" action="/auth/login">
    <label for="username">Tên đăng nhập:</label><br>
    <input type="text" id="username" name="username" required placeholder="Nhập tên tài khoản..."><br>

    <label for="password">Mật khẩu:</label><br>
    <input type="password" id="password" name="password" required placeholder="Nhập mật khẩu..."><br>

    <button type="submit" class="btn">Đăng nhập</button>
</form>