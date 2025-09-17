<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) session_start();
?>

<!-- Header Section Start -->
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bee</title>
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom Styles -->
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Navigation Bar Start -->
<nav class="navbar navbar-expand-lg navbar-dark sticky-top stylish-navbar" style="background: #000; box-shadow: 0 2px 16px rgba(0,0,0,0.12);">
  <div class="container">
    <!-- Brand Logo and Name -->
    <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
      <img src="images/LOGO (2).png" alt="Logo" style="height:50px; margin-right:10px; border-radius: 50%; box-shadow: 0 2px 8px rgba(255,190,11,0.15);">
      <span class="text-warning fw-bold" style="font-size: 2rem; letter-spacing: 2px;">Bee</span>
    </a>
    <!-- Mobile Toggler Button -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Navbar Links -->
    <div class="collapse navbar-collapse" id="navbarContent">
      <!-- Main Navigation Links -->
      <ul class="navbar-nav ms-auto me-3 mb-2 mb-lg-0 gap-lg-2">
        <li class="nav-item"><a class="nav-link stylish-link" href="index.php"><i class="bi bi-house-door-fill me-1"></i>Home</a></li>
        <li class="nav-item"><a class="nav-link stylish-link" href="men.php"><i class="bi bi-person-fill me-1"></i>Men</a></li>
        <li class="nav-item"><a class="nav-link stylish-link" href="women.php"><i class="bi bi-person-bounding-box me-1"></i>Women</a></li>
        <li class="nav-item"><a class="nav-link stylish-link" href="accessories.php"><i class="bi bi-bag-heart-fill me-1"></i>Accessories</a></li>
      </ul>
      <!-- User Account Links -->
      <ul class="navbar-nav gap-lg-2">
        <?php if(isset($_SESSION['user_name'])): ?>
          <li class="nav-item"><a class="nav-link stylish-link">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?></a></li>
          <li class="nav-item"><a class="nav-link stylish-link" href="cart.php"><i class="bi bi-cart-fill"></i> Cart</a></li>
          <li class="nav-item"><a class="nav-link stylish-link" href="logout.php">Logout</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link stylish-link" href="login.php">Login</a></li>
          <li class="nav-item"><a class="nav-link stylish-link" href="registration.php">Register</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<!-- Navigation Bar End -->

<style>
  .stylish-navbar {
    font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
    font-size: 1.1rem;
    letter-spacing: 1px;
  }
  .stylish-link {
    color: #fff !important;
    position: relative;
    transition: color 0.2s;
    padding-left: 0.5rem;
    padding-right: 0.5rem;
  }
  .stylish-link:hover, .stylish-link:focus {
    color: #ffbe0b !important;
    background: rgba(255,190,11,0.08);
    border-radius: 1rem;
  }
  .navbar-brand span {
    text-shadow: 0 2px 8px rgba(255,190,11,0.15);
  }
  .navbar-nav .nav-link {
    margin-right: 0.5rem;
    margin-left: 0.5rem;
  }
  @media (max-width: 991px) {
    .navbar-nav {
      gap: 0 !important;
    }
  }
</style>
