<?php
session_start();
require_once __DIR__ . '/inc/db.php';
require_once __DIR__ . '/inc/auth.php';
require_login();
$user = current_user();
?>
<?php include __DIR__ . '/inc/header.php'; ?>
<main class="container">
  <h1>Dashboard</h1>
  <p>Selamat datang, <strong><?php echo htmlspecialchars($user['username']); ?></strong></p>

  <section class="card mb-3">
    <h2>Kalkulator HPP</h2>
    <p><a class="btn btn-primary" href="hpp.php">Buka Kalkulator HPP</a></p>
  </section>

  <section class="card">
    <h2>Riwayat Perhitungan</h2>
    <?php
    $pdo = get_pdo();
    $stmt = $pdo->prepare('SELECT * FROM hpp_records WHERE user_id = ? ORDER BY created_at DESC LIMIT 20');
    $stmt->execute([$user['id']]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (!$rows) {
        echo '<p>Belum ada perhitungan.</p>';
    } else {
        echo '<table class="table table-striped"><tr><th>Tanggal</th><th>Persediaan Awal</th><th>Pembelian</th><th>Persediaan Akhir</th><th>HPP</th></tr>';
        foreach ($rows as $r) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($r['created_at']) . '</td>';
            echo '<td>' . number_format($r['beginning_inventory'],2) . '</td>';
            echo '<td>' . number_format($r['purchases'],2) . '</td>';
            echo '<td>' . number_format($r['ending_inventory'],2) . '</td>';
            echo '<td>' . number_format($r['cogs'],2) . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    }
    ?>
  </section>

</main>
<?php include __DIR__ . '/inc/footer.php'; ?>
