<?php
session_start();
require_once __DIR__ . '/inc/db.php';
require_once __DIR__ . '/inc/auth.php';

$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    if ($username === '' || $password === '') {
        $error = 'Masukkan username dan password.';
    } else {
        if (login_user($username, $password)) {
            header('Location: dashboard.php');
            exit;
        } else {
            $error = 'Login gagal. Periksa kredensial Anda.';
        }
    }
}
?>
<?php include __DIR__ . '/inc/header.php'; ?>
<main class="container">
  <h1>Login</h1>
  <?php if ($error): ?><p class="error"><?php echo htmlspecialchars($error); ?></p><?php endif; ?>
  <form method="post" class="form">
    <label>Username
      <input name="username" required>
    </label>
    <label>Password
      <input name="password" type="password" required>
    </label>
    <div>
      <button class="btn" type="submit">Login</button>
      <a href="register.php" class="btn btn-light">Buat akun</a>
    </div>
  </form>
</main>
<?php include __DIR__ . '/inc/footer.php'; ?>
