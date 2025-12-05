<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Aplikasi HPP</title>
  <!-- Custom stylesheet -->
  <link rel="stylesheet" href="/css/style.css">
  <!-- Bootstrap CSS (loaded after custom to let Bootstrap utilities take precedence where needed) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ENjdO4Dr2bkBIFxQpeoYz1K/0sA5FQ9Wv1p5Yx1QmXc8Xw5YkNf5Yv5Y3G5b5E5D" crossorigin="anonymous">
</head>
<body>
  <header class="site-header">
    <div class="container d-flex align-items-center justify-content-between py-3">
      <a class="brand" href="/">Aplikasi HPP</a>
      <nav class="nav">
        <a class="nav-link d-inline" href="/">Home</a>
        <?php if (is_logged_in()): ?>
          <a class="nav-link d-inline" href="dashboard.php">Dashboard</a>
          <a class="nav-link d-inline" href="hpp.php">Kalkulator</a>
          <a class="nav-link d-inline" href="logout.php">Logout</a>
        <?php else: ?>
          <a class="nav-link d-inline" href="login.php">Login</a>
          <a class="nav-link d-inline" href="register.php">Register</a>
        <?php endif; ?>
      </nav>
    </div>
  </header>
    <div class="container">
