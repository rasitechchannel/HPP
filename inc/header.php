<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Aplikasi HPP</title>
  <!-- Custom stylesheet -->
    <link rel="stylesheet" href="css/style.css">
  <!-- Bootstrap CSS (loaded after custom to let Bootstrap utilities take precedence where needed) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <header class="site-header">
    <div class="container d-flex align-items-center justify-content-between py-3">
      <a class="brand" href="/">Aplikasi HPP</a>
      <nav class="nav d-flex align-items-center">
        <a class="nav-link d-inline" href="/">Home</a>
        <?php if (is_logged_in()): ?>
          <a class="nav-link d-inline" href="dashboard.php">Dashboard</a>
          <a class="nav-link d-inline" href="hpp.php">Kalkulator</a>
          <a class="nav-link d-inline" href="logout.php">Logout</a>
        <?php else: ?>
          <a class="nav-link d-inline" href="login.php">Login</a>
          <a class="nav-link d-inline" href="register.php">Register</a>
        <?php endif; ?>
        <!-- Theme toggle -->
        <button id="theme-toggle" type="button" class="btn btn-sm btn-outline-light ms-3">Light</button>
      </nav>
    </div>
  </header>
    <div class="container">
