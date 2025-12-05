<?php
session_start();
require_once __DIR__ . '/inc/auth.php';
logout_user();
header('Location: index.php');
exit;
