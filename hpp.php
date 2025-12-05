<?php
session_start();
require_once __DIR__ . '/inc/db.php';
require_once __DIR__ . '/inc/auth.php';
require_login();
$user = current_user();

$result = null;
$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bi = floatval(str_replace(',', '.', $_POST['beginning_inventory'] ?? 0));
    $p  = floatval(str_replace(',', '.', $_POST['purchases'] ?? 0));
    $ei = floatval(str_replace(',', '.', $_POST['ending_inventory'] ?? 0));

    if ($bi < 0 || $p < 0 || $ei < 0) {
        $error = 'Nilai tidak boleh negatif.';
    } else {
        $cogs = $bi + $p - $ei;
        $result = $cogs;
        // simpan ke DB
        $pdo = get_pdo();
        $stmt = $pdo->prepare('INSERT INTO hpp_records (user_id, beginning_inventory, purchases, ending_inventory, cogs) VALUES (?,?,?,?,?)');
        $stmt->execute([$user['id'], $bi, $p, $ei, $cogs]);
    }
}
?>
<?php include __DIR__ . '/inc/header.php'; ?>
<main class="container">
  <h1>Kalkulator HPP</h1>
  <p>Rumus: HPP = Persediaan Awal + Pembelian - Persediaan Akhir</p>
  <?php if ($error): ?><p class="error"><?php echo htmlspecialchars($error); ?></p><?php endif; ?>
  <form method="post" class="form">
    <div class="mb-3">
      <label class="form-label">Persediaan Awal</label>
      <input name="beginning_inventory" required class="form-control" value="<?php echo htmlspecialchars($_POST['beginning_inventory'] ?? '0'); ?>">
    </div>
    <div class="mb-3">
      <label class="form-label">Pembelian</label>
      <input name="purchases" required class="form-control" value="<?php echo htmlspecialchars($_POST['purchases'] ?? '0'); ?>">
    </div>
    <div class="mb-3">
      <label class="form-label">Persediaan Akhir</label>
      <input name="ending_inventory" required class="form-control" value="<?php echo htmlspecialchars($_POST['ending_inventory'] ?? '0'); ?>">
    </div>
    <div class="d-flex gap-2">
      <button class="btn btn-primary" type="submit">Hitung HPP</button>
      <a href="dashboard.php" class="btn btn-outline-secondary">Kembali</a>
    </div>
  </form>

  <?php if ($result !== null): ?>
    <section class="card">
      <h2>Hasil</h2>
      <p>HPP: <strong><?php echo number_format($result, 2); ?></strong></p>
    </section>
  <?php endif; ?>

</main>
<?php include __DIR__ . '/inc/footer.php'; ?>
