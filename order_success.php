<?php
include 'includes/header.php';
$order_id = $_GET['order_id'] ?? 0;
?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
  <div class="col-md-8 col-lg-6 mx-auto">
    <div class="card shadow-lg border-0 rounded-4 p-5 stylish-success-card text-center">
      <div class="mb-4">
        <span style="font-size:3rem;">🎉</span>
      </div>
      <h2 class="fw-bold mb-3 text-success" style="letter-spacing:1px;">Order Placed Successfully!</h2>
      <p class="lead mb-2">Thank you for shopping with <b class="text-warning">Bee</b>.</p>
      <p class="mb-3">Your order <b class="text-warning">#<?php echo htmlspecialchars($order_id); ?></b> has been placed and is being processed.</p>
      <hr class="my-4">
      <p class="mb-4">You’ll receive an email confirmation shortly.</p>
      <a href="index.php" class="btn btn-warning btn-lg px-4 py-2 fw-bold shadow-sm" style="border-radius:2rem;">Continue Shopping</a>
    </div>
  </div>
</div>

<style>
  .stylish-success-card {
    background: #fff;
    box-shadow: 0 4px 32px rgba(255,190,11,0.10), 0 2px 8px rgba(0,0,0,0.08);
  }
  .btn-warning:hover, .btn-warning:focus {
    background: linear-gradient(90deg, #ffbe0b 0%, #f9d923 100%);
    color: #222;
  }
</style>

<?php include 'includes/footer.php'; ?>
