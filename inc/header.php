<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Aplikasi HPP</title>
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>
  <header class="site-header">
    <div class="container">
      <a class="brand" href="/">Aplikasi HPP</a>
      <nav class="nav">
        <a href="/">Home</a>
        <?php if (is_logged_in()): ?>
          <a href="dashboard.php">Dashboard</a>
          <a href="hpp.php">Kalkulator</a>
          <a href="logout.php">Logout</a>
        <?php else: ?>
          <a href="login.php">Login</a>
          <a href="register.php">Register</a>
        <?php endif; ?>
      </nav>
    </div>
  </header>
