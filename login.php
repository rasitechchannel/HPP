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
    <div class="mb-3">
      <label class="form-label">Username</label>
      <input name="username" required class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">Password</label>
      <input name="password" type="password" required class="form-control">
    </div>
    <div class="d-flex gap-2">
      <button class="btn btn-primary" type="submit">Login</button>
      <a href="register.php" class="btn btn-outline-secondary">Buat akun</a>
    </div>
  </form>
</main>
<?php include __DIR__ . '/inc/footer.php'; ?>
