<?php
session_start();
require_once __DIR__ . '/inc/db.php';
require_once __DIR__ . '/inc/auth.php';
require_login();
$user = current_user();

$result = null;
$error = null;

function parse_number($value) {
    if ($value === null) return null;
    $normalized = str_replace(',', '.', trim($value));
    return filter_var($normalized, FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_THOUSAND) !== false
        ? (float)$normalized
        : null;
}

function field_value($key, $default = '0') {
    return htmlspecialchars($_POST[$key] ?? $default, ENT_QUOTES, 'UTF-8');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bi = parse_number($_POST['beginning_inventory'] ?? null);
    $p  = parse_number($_POST['purchases'] ?? null);
    $ei = parse_number($_POST['ending_inventory'] ?? null);

    if ($bi === null || $p === null || $ei === null) {
        $error = 'Input harus berupa angka yang valid.';
    } elseif ($bi < 0 || $p < 0 || $ei < 0) {
        $error = 'Nilai tidak boleh negatif.';
    } else {
        $cogs = $bi + $p - $ei;
        $result = $cogs;
        // simpan ke DB
        $pdo = get_pdo();
        $stmt = $pdo->prepare('INSERT INTO hpp_records (user_id, beginning_inventory, purchases, ending_inventory, cogs) VALUES(?,?,?,?,?)');
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
      <input name="beginning_inventory" type="number" step="0.01" min="0" required class="form-control" value="<?php echo field_value('beginning_inventory'); ?>">
    </div>
    <div class="mb-3">
      <label class="form-label">Pembelian</label>
      <input name="purchases" type="number" step="0.01" min="0" required class="form-control" value="<?php echo field_value('purchases'); ?>">
    </div>
    <div class="mb-3">
      <label class="form-label">Persediaan Akhir</label>
      <input name="ending_inventory" type="number" step="0.01" min="0" required class="form-control" value="<?php echo field_value('ending_inventory'); ?>">
    </div>
    <div class="d-flex gap-2">
      <button class="btn btn-primary" type="submit">Hitung HPP</button>
      <a href="dashboard.php" class="btn btn-outline-secondary">Kembali</a>
    </div>
  </form>

  <?php if ($result !== null): ?>
    <section class="card">
      <h2>Hasil</h2>
      <p class="mb-1">HPP: <strong><?php echo number_format($result, 2); ?></strong></p>
      <small>Perhitungan: <?php echo number_format($bi, 2); ?> + <?php echo number_format($p, 2); ?> - <?php echo number_format($ei, 2); ?></small>
    </section>
  <?php endif; ?>

</main>
<?php include __DIR__ . '/inc/footer.php'; ?>
