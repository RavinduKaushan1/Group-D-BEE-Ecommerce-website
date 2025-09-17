<?php
require 'includes/db.php';
session_start();

// Add item to cart (?add=ID)
if(isset($_GET['add'])){
    $id = (int)$_GET['add'];
    if(!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
    $_SESSION['cart'][$id] = (isset($_SESSION['cart'][$id]) ? $_SESSION['cart'][$id] + 1 : 1);
    header("Location: cart.php");
    exit;
}

// Remove item from cart (?remove=ID)
if(isset($_GET['remove'])){
    $id = (int)$_GET['remove'];
    if(isset($_SESSION['cart'][$id])) unset($_SESSION['cart'][$id]);
    header("Location: cart.php");
    exit;
}

// Update quantities
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['qty'])){
    foreach($_POST['qty'] as $id=>$q){
        $id = (int)$id;
        $q = (int)$q;
        if($q <= 0) unset($_SESSION['cart'][$id]);
        else $_SESSION['cart'][$id] = $q;
    }
    header("Location: cart.php");
    exit;
}

include 'includes/header.php';
?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
  <div class="col-lg-10 mx-auto">
    <div class="card shadow-lg border-0 rounded-4 p-4 stylish-cart-card">
      <h2 class="text-center fw-bold mb-4 text-warning" style="letter-spacing:1px;">Your Cart</h2>
      <?php if(empty($_SESSION['cart'])): ?>
        <p class="text-center">Your cart is empty. <a href="index.php" class="fw-bold text-warning">Shop now</a></p>
      <?php else: ?>
        <form method="post">
          <div class="table-responsive">
            <table class="table table-bordered align-middle rounded-3 overflow-hidden">
              <thead class="table-light">
                <tr class="text-center">
                  <th>Product</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Subtotal</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $total = 0;
                $ids = array_keys($_SESSION['cart']);
                if(!empty($ids)){
                    $ids_list = implode(',', array_map('intval', $ids));
                    $res = $conn->query("SELECT * FROM products WHERE id IN ($ids_list)");
                    $products = [];
                    while($r = $res->fetch_assoc()) $products[$r['id']] = $r;

                    foreach($_SESSION['cart'] as $id=>$qty){
                        if(!isset($products[$id])) continue;
                        $p = $products[$id];
                        $sub = $p['price'] * $qty;
                        $total += $sub;
                        echo "<tr>
                                <td class='fw-bold text-warning'>{$p['name']}</td>
                                <td class='text-center'>\$".number_format($p['price'],2)."</td>
                                <td class='text-center'><input type='number' name='qty[$id]' value='$qty' min='0' class='form-control form-control-sm rounded-3 mx-auto' style='width:80px;'></td>
                                <td class='text-center fw-bold text-warning'>\$".number_format($sub,2)."</td>
                                <td class='text-center'><a href='cart.php?remove=$id' class='btn btn-sm btn-danger rounded-3'>Remove</a></td>
                              </tr>";
                    }
                }
                ?>
                <tr class="table-warning">
                  <td colspan="3" class="fw-bold">Total</td>
                  <td colspan="2" class="fw-bold text-warning">$<?php echo number_format($total,2); ?></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="d-flex flex-wrap gap-3 justify-content-end mt-4">
            <button class="btn btn-warning btn-lg fw-bold shadow-sm" style="border-radius:2rem;">Update Cart</button>
            <a href="checkout.php" class="btn btn-success btn-lg fw-bold shadow-sm" style="border-radius:2rem;">Proceed to Checkout</a>
          </div>
        </form>
      <?php endif; ?>
    </div>
  </div>
</div>

<style>
  .stylish-cart-card {
    background: #fff;
    box-shadow: 0 4px 32px rgba(255,190,11,0.10), 0 2px 8px rgba(0,0,0,0.08);
  }
  .btn-warning:hover, .btn-warning:focus {
    background: linear-gradient(90deg, #ffbe0b 0%, #f9d923 100%);
    color: #222;
  }
</style>

<?php include 'includes/footer.php'; ?>
