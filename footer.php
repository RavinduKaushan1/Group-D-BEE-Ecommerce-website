<?php ?>

<!-- Footer Section Start -->
<footer class="text-light pt-5 pb-4 stylish-footer" style="background: #000;">
  <div class="container">
    <div class="row align-items-center">
      <!-- Brand Info -->
      <div class="col-md-4 mb-4 mb-md-0">
        <h5 class="text-warning fw-bold mb-3"><i class="bi bi-badge-ad-fill me-2"></i>Bee</h5>
        <p class="mb-2">Premium activewear, bold designs, and performance-first products.</p>
        <!-- Social Media Icons -->
        <div class="d-flex gap-3 mt-3">
          <a href="#" class="footer-icon-link" title="Instagram"><i class="bi bi-instagram fs-4"></i></a>
          <a href="#" class="footer-icon-link" title="Facebook"><i class="bi bi-facebook fs-4"></i></a>
          <a href="#" class="footer-icon-link" title="Twitter"><i class="bi bi-twitter fs-4"></i></a>
        </div>
      </div>
      <!-- Contact Info -->
      <div class="col-md-4 mb-4 mb-md-0">
        <h5 class="text-warning fw-bold mb-3"><i class="bi bi-envelope-fill me-2"></i>Contact</h5>
        <p class="mb-1"><i class="bi bi-envelope"></i> support@beeactivewear.com</p>
        <p class="mb-1"><i class="bi bi-geo-alt"></i> 123 ,pitipana, Homagama</p>
        <p class="mb-1"><i class="bi bi-telephone"></i> +94783739</p>
      </div>
      <!-- Quick Links -->
      <div class="col-md-4 text-md-end">
        <h5 class="text-warning fw-bold mb-3"><i class="bi bi-link-45deg me-2"></i>Quick Links</h5>
        <ul class="list-unstyled">
          <li><a href="index.php" class="footer-link">Home</a></li>
          <li><a href="men.php" class="footer-link">Men</a></li>
          <li><a href="women.php" class="footer-link">Women</a></li>
          <li><a href="accessories.php" class="footer-link">Accessories</a></li>
        </ul>
      </div>
    </div>
    <!-- Copyright -->
    <hr class="text-warning mt-5">
    <p class="text-center mb-0">© <?php echo date("Y"); ?> Bee. All Rights Reserved.</p>
  </div>
</footer>
<!-- Footer Section End -->

<!-- Footer Styles -->
<style>
  .stylish-footer {
    font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
    font-size: 1.05rem;
    letter-spacing: 0.5px;
    box-shadow: 0 -2px 16px rgba(0,0,0,0.10);
  }
  .footer-link {
    color: #fff;
    text-decoration: none;
    transition: color 0.2s, text-shadow 0.2s;
    font-weight: 500;
    display: inline-block;
    margin-bottom: 0.5rem;
  }
  .footer-link:hover, .footer-link:focus {
    color: #ffbe0b;
    text-shadow: 0 2px 8px rgba(255,190,11,0.15);
  }
  /* Social Media Icon Styles */
  .footer-icon-link {
    color: #fff;
    transition: color 0.2s, transform 0.2s;
  }
  .footer-icon-link:hover, .footer-icon-link:focus {
    color: #ffbe0b;
    transform: scale(1.15);
  }
  .stylish-footer h5 {
    letter-spacing: 1px;
  }
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
