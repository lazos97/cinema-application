<?php
require '../classes/Database.php';
require '../classes/Movies.php';
require '../classes/Users.php';
require '../classes/Views.php';
require '../includes/header.php';
require '../functions/redirects.php';
require '../functions/status_func.php';

if (!empty($_SESSION["id"])) {
  header("Location: home.php");
}

$register = new Register();

if (isset($_POST["submit"])) {
  $result = $register->registration($_POST["name"], $_POST["username"], $_POST["email"], $_POST["password"], $_POST["confirmpassword"]);

  if ($result == 1) {
    redirect($result, 'Welcome back!', 'home.php');
  } elseif ($result == 10) {
    redirect(false, 'Error', 'registration.php');
  } elseif ($result == 100) {
    redirect(false, 'Error', 'registration.php');
  }
}

$status = isset($_GET['status']) ? $_GET['status'] : '';
?>

<?php echo headerHTML() ?>

<body class="register-image lr-body">
  <div class="d-flex flex-column align-items-center vh-100 justify-content-center container-xl">
    <?php echo status_func($status) ?>
    <form class="form row g-3 p-4 bg-transparent-50 rounded mt-2" method="post">
      <h2 class="mt-0 ">Registration</h2>
      <div class="col-md-12">
        <input type="text" class="form-control" placeholder="Name" name="name" required>
      </div>
      <div class="col-md-12">
        <input type="text" class="form-control" placeholder="Username" name="username" required>
      </div>
      <div class="col-md-12">
        <input type="email" class="form-control" placeholder="Email" name="email" required>
      </div>
      <div class="col-md-12">
        <input type="password" class="form-control" placeholder="Password" name="password" required>
      </div>
      <div class="col-md-12">
        <input type="password" class="form-control" placeholder="Confirm Password" name="confirmpassword" required>
      </div>
      <div class="col-md-12">
        <button type="submit" name="submit" class="btn btn-success  w-100">Register</button>
      </div>
      <div class="col-md-12">
        <a href="login.php" class="btn btn-primary w-100">Login</a>
      </div>

    </form>
  </div>
</body>
<script src="../assets//js/status-alert.js"></script>

</html>