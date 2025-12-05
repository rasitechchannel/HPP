<?php
// CLI helper to (re)create the database
require_once __DIR__ . '/inc/db.php';

$pdo = get_pdo();
echo "Database inisialiasi selesai. DB path: " . get_db_path() . "\n";
