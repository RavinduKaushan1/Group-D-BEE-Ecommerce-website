<?php
require 'includes/db.php';
session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $res = $conn->query("SELECT * FROM users WHERE email='$email'");
    if($res->num_rows == 1){
        $user = $res->fetch_assoc();
        if(password_verify($password, $user['password'])){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: index.php");
            exit;
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "No account found with that email.";
    }
}

include 'includes/header.php';
?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
  <div class="col-md-6 col-lg-5 mx-auto">
    <div class="card shadow-lg border-0 rounded-4 p-4 stylish-login-card">
      <h2 class="text-center fw-bold mb-4 text-warning" style="letter-spacing:1px;">Login</h2>
      <?php if(isset($error)) echo "<div class='alert alert-danger rounded-3 mb-3'>$error</div>"; ?>
      <form method="post">
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control form-control-lg rounded-3" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control form-control-lg rounded-3" required>
        </div>
        <button type="submit" class="btn btn-warning btn-lg w-100 fw-bold shadow-sm" style="border-radius:2rem;">Login</button>
      </form>
  <p class="mt-4 text-center">Don’t have an account? <a href="registration.php" class="fw-bold" style="color:#222;">Register</a></p>
    </div>
  </div>
</div>

<style>
  .stylish-login-card {
    background: #fff;
    box-shadow: 0 4px 32px rgba(255,190,11,0.10), 0 2px 8px rgba(0,0,0,0.08);
  }
</style>

<?php include 'includes/footer.php'; ?>
