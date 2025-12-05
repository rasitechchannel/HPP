<?php
// Simple SQLite PDO connection and initialization
function get_db_path() {
    return __DIR__ . '/../data/hpp.db';
}

function get_pdo() {
    static $pdo = null;
    if ($pdo) return $pdo;

    $dbPath = get_db_path();
    $dir = dirname($dbPath);
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }

    $shouldInit = !file_exists($dbPath);
    $pdo = new PDO('sqlite:' . $dbPath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($shouldInit) {
        init_db($pdo);
    }

    return $pdo;
}

function init_db(PDO $pdo) {
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT UNIQUE NOT NULL,
        password TEXT NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    $pdo->exec("CREATE TABLE IF NOT EXISTS hpp_records (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        user_id INTEGER NOT NULL,
        beginning_inventory REAL NOT NULL,
        purchases REAL NOT NULL,
        ending_inventory REAL NOT NULL,
        cogs REAL NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY(user_id) REFERENCES users(id)
    )");

    // Create a default admin user when table is empty
    $stmt = $pdo->query('SELECT COUNT(*) FROM users');
    $userCount = (int)$stmt->fetchColumn();
    if ($userCount === 0) {
        $pw = password_hash('admin', PASSWORD_DEFAULT);
        $insert = $pdo->prepare('INSERT INTO users (username, password) VALUES (?,?)');
        $insert->execute(['admin', $pw]);
    }
}
