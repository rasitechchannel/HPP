<?php
session_start();
require_once __DIR__ . '/inc/db.php';
require_once __DIR__ . '/inc/auth.php';

$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username'] ?? '');
  $password = $_POST['password'] ?? '';
  $password2 = $_POST['password2'] ?? '';

  if ($username === '' || $password === '') {
    $error = 'Username dan password wajib diisi.';
  } elseif (strlen($username) < 3) {
    $error = 'Username minimal 3 karakter.';
  } elseif ($password !== $password2) {
    $error = 'Password tidak cocok.';
  } else {
    // cek apakah username sudah ada
    $existing = find_user_by_username($username);
    if ($existing) {
      $error = 'Username sudah dipakai. Silakan pilih username lain.';
    } else {
      $res = register_user($username, $password);
      if ($res) {
        // auto login
        login_user($username, $password);
        header('Location: dashboard.php');
        exit;
      } else {
        $error = 'Gagal mendaftar. Terjadi kesalahan pada server.';
      }
    }
  }
}
?>
<?php include __DIR__ . '/inc/header.php'; ?>
<main class="container">
  <h1>Register</h1>
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
    <div class="mb-3">
      <label class="form-label">Konfirmasi Password</label>
      <input name="password2" type="password" required class="form-control">
    </div>
    <div class="d-flex gap-2">
      <button class="btn btn-primary" type="submit">Register</button>
      <a href="login.php" class="btn btn-outline-secondary">Sudah punya akun? Login</a>
    </div>
  </form>
</main>
<?php include __DIR__ . '/inc/footer.php'; ?>
