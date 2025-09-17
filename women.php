<?php
require 'includes/db.php';
include 'includes/header.php';
$category = 'Women';
$res = $conn->query("SELECT * FROM products WHERE category='Women'");
?>

<!-- Cover Section -->
<section class="cover-section text-light d-flex align-items-center" style="background: url('images/Women item (Cover img).jpg') no-repeat center center/cover; min-height: 80vh; position: relative;">
  <div class="container position-relative z-2">
    <h1 class="display-3 fw-bold mb-3 text-warning" style="text-shadow: 0 2px 16px rgba(0,0,0,0.18);">Bee Women</h1>
    <p class="lead fs-4" style="text-shadow: 0 2px 8px rgba(0,0,0,0.12);">From workouts to daily wear — strength meets style.</p>
  </div>
  <div style="position:absolute; inset:0; background:rgba(0,0,0,0.45); z-index:1;"></div>
</section>

<!-- Products Section -->
<section class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center mb-5 fw-bold" style="background: linear-gradient(90deg, #ffbe0b 0%, #f9d923 100%); color: #222; border-radius: 1rem; padding: 1rem 0; box-shadow: 0 2px 16px rgba(0,0,0,0.08);">
      <?php echo $category; ?> Collection
    </h2>
    <div class="row g-4">
      <?php while($row = $res->fetch_assoc()): ?>
        <div class="col-md-6 col-lg-4">
          <div class="card h-100 border-0 shadow-lg rounded-4 product-card" style="transition: transform 0.2s;">
            <img src="images/<?php echo htmlspecialchars($row['image']); ?>" class="card-img-top rounded-top-4" style="height:300px; object-fit:cover;" alt="<?php echo htmlspecialchars($row['name']); ?>">
            <div class="card-body text-center bg-light rounded-bottom-4">
              <h5 class="card-title fw-bold text-warning mb-1"><?php echo htmlspecialchars($row['name']); ?></h5>
              <p class="text-secondary mb-2" style="font-size: 1.1rem;"><?php echo htmlspecialchars($row['color']); ?></p>
              <p class="mb-3"><span class="fs-5 fw-bold text-warning" style="background:none; border:none;">$<?php echo number_format($row['price'],2); ?></span></p>
              <a href="cart.php?add=<?php echo $row['id']; ?>" class="btn btn-warning btn-lg px-4 py-2 fw-bold shadow-sm" style="border-radius: 2rem; transition: background 0.2s;">Add to Cart</a>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</section>

<style>
  .product-card:hover {
    transform: translateY(-8px) scale(1.03);
    box-shadow: 0 8px 32px rgba(255,190,11,0.15), 0 2px 8px rgba(0,0,0,0.08);
  }
  .btn-warning:hover, .btn-warning:focus {
    background: linear-gradient(90deg, #ffbe0b 0%, #f9d923 100%);
    color: #222;
  }
</style>

<?php include 'includes/footer.php'; ?>
