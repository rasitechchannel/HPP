<?php
session_start();
require_once __DIR__ . '/inc/db.php';
require_once __DIR__ . '/inc/auth.php';
?>
<?php include __DIR__ . '/inc/header.php'; ?>

<main class="container">
  <section class="hero">
    <div class="left">
      <h1>Hitung HPP dengan cepat dan mudah</h1>
      <p class="lead">Aplikasi sederhana untuk menghitung Harga Pokok Penjualan (HPP) dan menyimpan riwayat perhitungan Anda secara lokal menggunakan SQLite.</p>

      <div class="cta">
        <?php if (is_logged_in()): ?>
          <a class="btn" href="dashboard.php">Buka Dashboard</a>
          <a class="btn btn-light" href="hpp.php">Langsung Hitung</a>
        <?php else: ?>
          <a class="btn" href="register.php">Daftar Sekarang</a>
          <a class="btn btn-light" href="login.php">Sudah Punya Akun?</a>
        <?php endif; ?>
      </div>
    </div>

    <div class="right">
      <div class="card">
        <h3>Ringkasan</h3>
        <p class="lead">Rumus HPP: Persediaan Awal + Pembelian - Persediaan Akhir</p>
      </div>
    </div>
  </section>

  <section class="features">
    <div class="feature">
      <h3>Aman & Lokal</h3>
      <p>Semua data disimpan lokal di SQLite pada server Anda.</p>
    </div>
    <div class="feature">
      <h3>Riwayat</h3>
      <p>Simpan riwayat perhitungan untuk referensi dan audit.</p>
    </div>
    <div class="feature">
      <h3>Mudah Digunakan</h3>
      <p>Form sederhana yang cocok untuk pencatatan cepat</p>
    </div>
  </section>
</main>

<?php include __DIR__ . '/inc/footer.php'; ?>
