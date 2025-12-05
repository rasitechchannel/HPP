<?php
require_once __DIR__ . '/db.php';

function register_user($username, $password) {
    $pdo = get_pdo();
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
    try {
        $stmt->execute([$username, $hash]);
        return $pdo->lastInsertId();
    } catch (PDOException $e) {
        return false;
    }
}

function find_user_by_username($username) {
    $pdo = get_pdo();
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ? LIMIT 1');
    $stmt->execute([$username]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function login_user($username, $password) {
    $user = find_user_by_username($username);
    if (!$user) return false;
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        return true;
    }
    return false;
}

function logout_user() {
    unset($_SESSION['user_id']);
    session_destroy();
}

function is_logged_in() {
    return !empty($_SESSION['user_id']);
}

function current_user() {
    if (!is_logged_in()) return null;
    $pdo = get_pdo();
    $stmt = $pdo->prepare('SELECT id, username, created_at FROM users WHERE id = ? LIMIT 1');
    $stmt->execute([$_SESSION['user_id']]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function require_login() {
    if (!is_logged_in()) {
        header('Location: login.php');
        exit;
    }
}
