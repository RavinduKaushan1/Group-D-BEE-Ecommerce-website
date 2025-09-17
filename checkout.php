<?php
// Database connection and session start
require 'includes/db.php';
session_start();

// Redirect to login if user is not logged in
if(!isset($_SESSION['user_id'])){
  header("Location: login.php");
  exit;
}

// Get logged-in user details
$uid = (int)$_SESSION['user_id'];
$userRes = $conn->query("SELECT * FROM users WHERE id=$uid");
$user = $userRes->fetch_assoc();

// Handle order placement
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $cart = $_SESSION['cart'] ?? [];
  if(empty($cart)){
    // Show error if cart is empty
    $error = "Cart is empty.";
  } else {
    // Get product details and calculate total
    $ids = implode(',', array_map('intval', array_keys($cart)));
    $res = $conn->query("SELECT * FROM products WHERE id IN ($ids)");
    $total = 0;
    $products = [];
    while($r = $res->fetch_assoc()){ 
      $products[$r['id']] = $r; 
      $total += $r['price'] * $cart[$r['id']]; 
    }

    // Prepare user info for order
    $name = $conn->real_escape_string($user['name']);
    $email = $conn->real_escape_string($user['email']);
    $address = $conn->real_escape_string($user['address']);

    // Insert order into orders table
    $conn->query("INSERT INTO orders (user_name,user_email,address,total_price) 
            VALUES ('$name','$email','$address',$total)");
    $order_id = $conn->insert_id;

    // Insert each item into order_items table
    foreach($cart as $pid=>$qty){
      $pid = (int)$pid;
      $qty = (int)$qty;
      $conn->query("INSERT INTO order_items (order_id, product_id, quantity) VALUES ($order_id, $pid, $qty)");
    }

    // Send order confirmation email to user
    $subject = "Order Confirmation - Bee Ecommerce";
    $message = "Thank you for your order!\n\nYour order #$order_id has been placed successfully.\nTotal: $$total\nWe appreciate your business and will process your order soon.";
    $headers = "From: Bee Ecommerce <no-reply@bee.com>\r\nReply-To: no-reply@bee.com";
    mail($email, $subject, $message, $headers);

    // Clear cart and redirect to success page
    unset($_SESSION['cart']);
    header("Location: order_success.php?order_id=$order_id");
    exit;
  }
}

// Include header
include 'includes/header.php';
?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
  <div class="row w-100 justify-content-center">
    <div class="col-lg-10 mx-auto">
      <div class="card shadow-lg border-0 rounded-4 p-4 stylish-checkout-card">
        <h2 class="text-center fw-bold mb-4 text-warning" style="letter-spacing:1px;">Checkout</h2>
        <?php if(isset($error)) echo "<div class='alert alert-danger rounded-3 mb-3'>$error</div>"; ?>
        <div class="row g-4">
          <div class="col-md-6">
            <div class="p-3 rounded-3 bg-light h-100">
              <h5 class="fw-bold text-warning mb-3"><i class="bi bi-truck me-2"></i>Shipping Details</h5>
              <p class="mb-1"><strong><?php echo htmlspecialchars($user['name']); ?></strong></p>
              <p class="mb-1"><?php echo nl2br(htmlspecialchars($user['address'])); ?></p>
              <p class="mb-1"><?php echo htmlspecialchars($user['email']); ?></p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="p-3 rounded-3 bg-light h-100">
              <h5 class="fw-bold text-warning mb-3"><i class="bi bi-bag-check me-2"></i>Order Summary</h5>
              <?php
              $cart = $_SESSION['cart'] ?? [];
              if(empty($cart)) echo "<p>Your cart is empty.</p>";
              else {
                  $ids = implode(',', array_map('intval', array_keys($cart)));
                  $res = $conn->query("SELECT * FROM products WHERE id IN ($ids)");
                  $total = 0;
                  echo "<ul class='list-group mb-3'>";
                  while($r = $res->fetch_assoc()){
                      $qty = $cart[$r['id']];
                      $sub = $r['price'] * $qty;
                      $total += $sub;
                      echo "<li class='list-group-item d-flex justify-content-between align-items-center rounded-3 mb-2'>{$r['name']} <span class='fw-bold text-warning'>{$qty} × \$".number_format($r['price'],2)."</span></li>";
                  }
                  echo "<li class='list-group-item d-flex justify-content-between rounded-3'><b>Total</b> <b class='text-warning'>\$".number_format($total,2)."</b></li>";
                  echo "</ul>";
              }
              ?>
              <form method="post" class="mt-3">
                <button class="btn btn-warning btn-lg w-100 fw-bold shadow-sm" style="border-radius:2rem;">Place Order</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  .stylish-checkout-card {
    background: #fff;
    box-shadow: 0 4px 32px rgba(255,190,11,0.10), 0 2px 8px rgba(0,0,0,0.08);
  }
  .btn-warning:hover, .btn-warning:focus {
    background: linear-gradient(90deg, #ffbe0b 0%, #f9d923 100%);
    color: #222;
  }
</style>

<?php include 'includes/footer.php'; ?>
