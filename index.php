<?php
session_start();
require_once __DIR__ . '/inc/db.php';
require_once __DIR__ . '/inc/auth.php';
?>
<?php include __DIR__ . '/inc/header.php'; ?>

<main class="container">
  <h1>Selamat datang di Aplikasi HPP</h1>
  <p>Aplikasi sederhana untuk menghitung Harga Pokok Penjualan (HPP).</p>

  <?php if (is_logged_in()): ?>
    <p>Halo, <strong><?php echo htmlspecialchars(current_user()['username']); ?></strong> — <a href="dashboard.php">Buka Dashboard</a> | <a href="logout.php">Logout</a></p>
  <?php else: ?>
    <p><a class="btn" href="login.php">Login</a> atau <a class="btn" href="register.php">Register</a></p>
  <?php endif; ?>

  <section class="features">
    <h2>Fitur</h2>
    <ul>
      <li>Login / Register menggunakan SQLite</li>
      <li>Dashboard pengguna</li>
      <li>Kalkulator HPP (COGS): Persediaan Awal + Pembelian - Persediaan Akhir</li>
      <li>Mencatat riwayat perhitungan HPP per pengguna</li>
    </ul>
  </section>
</main>

<?php include __DIR__ . '/inc/footer.php'; ?>
