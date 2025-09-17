<?php
require '../includes/db.php';
session_start();

//  Check if admin logged in
if(!isset($_SESSION['admin'])){
    header("Location: index.php");
    exit;
}

//  Approve order and send delivery email
if(isset($_GET['deliver'])){
  $oid = (int)$_GET['deliver'];
  $conn->query("UPDATE orders SET status='Delivered' WHERE id=$oid");
  // Fetch user email for this order
  $orderRes = $conn->query("SELECT user_email, user_name FROM orders WHERE id=$oid");
  if($orderRes && $orderRes->num_rows > 0){
    $order = $orderRes->fetch_assoc();
    $to = $order['user_email'];
    $name = $order['user_name'];
    $subject = "Your Order is Delivered - Bee Ecommerce";
    $message = "Hello $name,\n\nYour order #$oid has been delivered. Thank you for shopping with Bee!";
    $headers = "From: Bee Ecommerce <no-reply@bee.com>\r\nReply-To: no-reply@bee.com";
    mail($to, $subject, $message, $headers);
  }
  header("Location: orders.php");
  exit;
}

//  Remove order
if(isset($_GET['remove'])){
    $oid = (int)$_GET['remove'];
    $conn->query("DELETE FROM orders WHERE id=$oid");
    header("Location: orders.php");
    exit;
}

//  Fetch all orders
$res = $conn->query("SELECT * FROM orders ORDER BY created_at DESC");
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Manage Orders - Bee Admin</title>
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
    <h2 class="mb-4">Manage Orders</h2>
    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>User</th>
          <th>Email</th>
          <th>Address</th>
          <th>Total</th>
          <th>Status</th>
          <th>Placed At</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php while($o = $res->fetch_assoc()): ?>
          <tr>
            <td><?php echo $o['id']; ?></td>
            <td><?php echo htmlspecialchars($o['user_name']); ?></td>
            <td><?php echo htmlspecialchars($o['user_email']); ?></td>
            <td><?php echo nl2br(htmlspecialchars($o['address'])); ?></td>
            <td>$<?php echo number_format($o['total_price'],2); ?></td>
            <td>
              <?php if($o['status'] == 'Pending'): ?>
                <span class="badge bg-warning text-dark">Pending</span>
              <?php elseif($o['status'] == 'Delivered'): ?>
                <span class="badge bg-success">Delivered</span>
              <?php else: ?>
                <span class="badge bg-secondary">Other</span>
              <?php endif; ?>
            </td>
            <td><?php echo $o['created_at']; ?></td>
            <td>
              <?php if($o['status'] == 'Pending'): ?>
                <a href="orders.php?deliver=<?php echo $o['id']; ?>" class="btn btn-sm btn-success">Deliver</a>
              <?php endif; ?>
              <a href="orders.php?remove=<?php echo $o['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">Remove</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
