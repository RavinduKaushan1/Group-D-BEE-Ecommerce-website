<?php
require '../includes/db.php';
session_start();

// ✅ Check if admin logged in
if(!isset($_SESSION['admin'])){
  header("Location: index.php");
  exit;
}

// ✅ Handle product add form
$productMsg = '';
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])){
  $name = $conn->real_escape_string($_POST['name']);
  $category = $conn->real_escape_string($_POST['category']);
  $color = $conn->real_escape_string($_POST['color']);
  $price = floatval($_POST['price']);
  $image = '';
  if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK){
    $imgName = basename($_FILES['image']['name']);
    $imgPath = '../images/' . $imgName;
    if(move_uploaded_file($_FILES['image']['tmp_name'], $imgPath)){
      $image = $imgName;
    }
  }
  if($name && $category && $color && $price && $image){
    $conn->query("INSERT INTO products (name, category, color, price, image) VALUES ('$name', '$category', '$color', $price, '$image')");
    $productMsg = '<div class="alert alert-success mb-3">Product added successfully!</div>';
  } else {
    $productMsg = '<div class="alert alert-danger mb-3">Please fill all fields and upload an image.</div>';
  }
}

// ✅ Get order stats
$totalOrders = $conn->query("SELECT COUNT(*) AS c FROM orders")->fetch_assoc()['c'];
$pendingOrders = $conn->query("SELECT COUNT(*) AS c FROM orders WHERE status='Pending'")->fetch_assoc()['c'];
$approvedOrders = $conn->query("SELECT COUNT(*) AS c FROM orders WHERE status='Approved'")->fetch_assoc()['c'];
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard - Bee</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="d-flex">
  <!-- Sidebar -->
  <div class="bg-dark text-white p-3" style="width:220px; min-height:100vh;">
    <h4 class="text-warning">Bee Admin</h4>
    <ul class="nav flex-column mt-4">
      <li class="nav-item"><a href="dashboard.php" class="nav-link text-white">Dashboard</a></li>
      <li class="nav-item"><a href="orders.php" class="nav-link text-white">Orders</a></li>
      <li class="nav-item"><a href="logout.php" class="nav-link text-danger">Logout</a></li>
    </ul>
  </div>

  <!-- Main content -->
  <div class="flex-grow-1 p-4">
    <h2 class="mb-4">Dashboard</h2>
    <div class="row mb-5">
      <div class="col-md-4">
        <div class="card text-center shadow">
          <div class="card-body">
            <h5>Total Orders</h5>
            <p class="display-6"><?php echo $totalOrders; ?></p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card text-center shadow">
          <div class="card-body">
            <h5>Pending Orders</h5>
            <p class="display-6 text-warning"><?php echo $pendingOrders; ?></p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card text-center shadow">
          <div class="card-body">
            <h5>Approved Orders</h5>
            <p class="display-6 text-success"><?php echo $approvedOrders; ?></p>
          </div>
        </div>
      </div>
    </div>

    <!-- Product Add Section -->
    <div class="card shadow-lg border-0 rounded-4 p-4 mb-5">
      <h4 class="mb-4 text-warning fw-bold">Add New Product</h4>
      <?php echo $productMsg; ?>
      <form method="post" enctype="multipart/form-data">
        <div class="row g-3">
          <div class="col-md-4">
            <label class="form-label">Product Name</label>
            <input type="text" name="name" class="form-control form-control-lg rounded-3" required>
          </div>
          <div class="col-md-4">
            <label class="form-label">Category</label>
            <select name="category" class="form-control form-control-lg rounded-3" required>
              <option value="">Select Category</option>
              <option value="Men">Men</option>
              <option value="Women">Women</option>
              <option value="Accessories">Accessories</option>
            </select>
          </div>
          <div class="col-md-4">
            <label class="form-label">Color</label>
            <input type="text" name="color" class="form-control form-control-lg rounded-3" required>
          </div>
        </div>
        <div class="row g-3 mt-2">
          <div class="col-md-4">
            <label class="form-label">Price</label>
            <input type="number" name="price" class="form-control form-control-lg rounded-3" step="0.01" min="0" required>
          </div>
          <div class="col-md-4">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control form-control-lg rounded-3" accept="image/*" required>
          </div>
          <div class="col-md-4 d-flex align-items-end">
            <button type="submit" name="add_product" class="btn btn-warning btn-lg w-100 fw-bold shadow-sm" style="border-radius:2rem;">Add Product</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
