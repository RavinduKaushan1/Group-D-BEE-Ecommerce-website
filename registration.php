<?php
require 'includes/db.php';
session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $address = $conn->real_escape_string($_POST['address']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = $conn->query("SELECT id FROM users WHERE email='$email'");
    if($check->num_rows > 0){
        $error = "Email already registered. Please log in.";
    } else {
        $conn->query("INSERT INTO users (name,email,password,address) 
                      VALUES ('$name','$email','$password','$address')");
        $_SESSION['user_id'] = $conn->insert_id;
        $_SESSION['user_name'] = $name;
        header("Location: index.php");
        exit;
    }
}

include 'includes/header.php';
?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
  <div class="col-md-7 col-lg-6 mx-auto">
    <div class="card shadow-lg border-0 rounded-4 p-4 stylish-register-card">
      <h2 class="text-center fw-bold mb-4 text-warning" style="letter-spacing:1px;">Register</h2>
      <?php if(isset($error)) echo "<div class='alert alert-danger rounded-3 mb-3'>$error</div>"; ?>
      <form method="post">
        <div class="mb-3">
          <label class="form-label">Full Name</label>
          <input type="text" name="name" class="form-control form-control-lg rounded-3" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control form-control-lg rounded-3" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control form-control-lg rounded-3" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Home Address</label>
          <textarea name="address" class="form-control form-control-lg rounded-3" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-warning btn-lg w-100 fw-bold shadow-sm" style="border-radius:2rem;">Register</button>
      </form>
      <p class="mt-4 text-center">Already have an account? <a href="login.php" class="fw-bold" style="color:#222;">Login</a></p>
    </div>
  </div>
</div>

<style>
  .stylish-register-card {
    background: #fff;
    box-shadow: 0 4px 32px rgba(255,190,11,0.10), 0 2px 8px rgba(0,0,0,0.08);
  }
</style>

<?php include 'includes/footer.php'; ?>
