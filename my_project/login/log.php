<?php
session_start();
error_reporting(0);
if ($_SESSION['user_id'] !== null) {
  // session_unset();   
  // session_destroy();
  header("Location:../AttendancePage\attendance.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Form with Bootstrap Validation</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
    rel="stylesheet" />
  <link rel="stylesheet" href="login.css" />
</head>

<body>
  <div class="login-container">
    <h2 class="text-center mb-4">Login</h2>
    <form
      action="login.php"
      class="needs-validation"
      novalidate
      method="post">
      <div class="mb-3">
        <label for="username" class="form-label">Email</label>
        <div class="input-with-icon position-relative inputs_div">
          <input
            type="email"
            class="form-control"
            id="email"
            name="email"
            placeholder="Enter your email"
            required
            minlength="5"
            style="padding-left: 40px" />
          <img
            src="username.png"
            alt="User"
            style="
                position: absolute;
                left: 12px;
                top: 50%;
                margin-left: 5px;
                transform: translateY(-50%);
                width: 15px;
                height: 15px;
                pointer-events: none;
              " />
          <div class="invalid-feedback">Please provide a valid username.</div>
          <div class="valid-feedback">Looks good!</div>
        </div>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <div class="input-with-icon position-relative ">
          <input
            type="password"
            class="form-control"
            id="password"
            name="password"
            placeholder="Enter your password"
            required
            minlength="6"
            style="padding-left: 40px" />
          <img
            src="password.png"
            alt="Password"
            style="
                position: absolute;
                left: 12px;
                top: 50%;
                margin-left: 5px;
                transform: translateY(-50%);
                width: 15px;
                height: 15px;
                pointer-events: none;
              " />
          <div class="invalid-feedback">Please provide a valid password.</div>
          <div class="valid-feedback">Looks good!</div>
        </div>
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="rememberMe" />
        <label class="form-check-label" for="rememberMe">Remember me</label>
      </div>
      <button type="submit" name="post" class="btn  w-100">
        Login
      </button>
      <div class="text-center mt-3">
        <a href="../registration_from\registor.php" class="text-decoration-none text-light">Registration</a>
      </div>
    </form>
  </div>
  <script src="valid_login.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>

</html>