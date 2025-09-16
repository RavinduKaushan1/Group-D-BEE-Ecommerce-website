<?php
require 'includes/db.php';
include 'includes/header.php';

// Search support
$q = isset($_GET['q']) ? $conn->real_escape_string($_GET['q']) : '';
$sql = "SELECT * FROM products";
if($q){
  $sql .= " WHERE name LIKE '%$q%' OR category LIKE '%$q%'";
}
$res = $conn->query($sql);
?>

<!-- Modern Carousel -->
<div id="carouselExampleCaptions" class="carousel slide mb-5 shadow-lg overflow-hidden" data-bs-ride="carousel" data-bs-interval="3500">
  <div class="carousel-inner">
    <div class="carousel-item active">
  <img src="images/Hero page (carosal img 2).jpg" class="d-block w-100" style="height: 700px; object-fit:cover; filter: brightness(0.85);">
      <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-3 p-3">
        <h2 class="fw-bold text-warning mb-2">Unleash Your Power</h2>
        <p class="lead text-light">At Bee, we blend innovation with performance.</p>
      </div>
    </div>
    <div class="carousel-item">
  <img src="images/Hero page (carosal img 1).jpg" class="d-block w-100" style="height: 700px; object-fit:cover; filter: brightness(0.85);">
      <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-3 p-3">
        <h2 class="fw-bold text-warning mb-2">Rise. Run. Repeat</h2>
        <p class="lead text-light">Bee gear is with you every step.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>

<!-- Modern Products -->
<div class="container py-5">
  <h1 class="text-center mb-5 fw-bold" style="background: linear-gradient(90deg, #ffbe0b 0%, #f9d923 100%); color: #222; border-radius: 1rem; padding: 1rem 0; box-shadow: 0 2px 16px rgba(0,0,0,0.08);">Recent Products</h1>
  <!-- Search Bar -->
  <form class="d-flex justify-content-center mb-5" method="get" action="index.php">
    <input type="text" name="q" class="form-control form-control-lg w-50 shadow-sm" placeholder="Search products by name or category..." value="<?php echo htmlspecialchars($q); ?>" style="max-width: 500px; border-radius: 2rem 0 0 2rem; border: 2px solid #ffbe0b;">
    <button type="submit" class="btn btn-warning btn-lg px-4" style="border-radius: 0 2rem 2rem 0;">Search</button>
  </form>
  <div class="row g-4">
    <?php while($row = $res->fetch_assoc()): ?>
      <div class="col-md-6 col-lg-4">
        <div class="card h-100 border-0 shadow-lg rounded-4 product-card" style="transition: transform 0.2s;">
          <img src="images/<?php echo htmlspecialchars($row['image']); ?>" class="card-img-top rounded-top-4" style="height:300px; object-fit:cover;" alt="<?php echo htmlspecialchars($row['name']); ?>">
          <div class="card-body text-center bg-light rounded-bottom-4">
            <h5 class="card-title fw-bold text-warning mb-1"><?php echo htmlspecialchars($row['name']); ?></h5>
            <p class="text-secondary mb-2" style="font-size: 1.1rem;"><?php echo htmlspecialchars($row['category']); ?></p>
            <p class="mb-3"><span class="fs-5 fw-bold text-warning" style="background:none; border:none;">$<?php echo number_format($row['price'],2); ?></span></p>
            <a href="cart.php?add=<?php echo $row['id']; ?>" class="btn btn-warning btn-lg px-4 py-2 fw-bold shadow-sm" style="border-radius: 2rem; transition: background 0.2s;">Add to Cart</a>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>

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
