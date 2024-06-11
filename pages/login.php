<?php
require __DIR__ . '/../classes/Database.php';
require __DIR__ . '/../classes/Movies.php';
require __DIR__ . '/../classes/Users.php';
require __DIR__ . '/../classes/Views.php';
require __DIR__ . '/../includes/header.php';
require __DIR__ . '/../functions/redirects.php';
require __DIR__ . '/../functions/status_func.php';

if (!empty($_SESSION["id"])) {
  header("Location: home.php");
}

$login = new Login();

if (isset($_POST["submit"])) {
  $result = $login->login($_POST["usernameemail"], $_POST["password"]);

  if ($result == 1) {
    $_SESSION["login"] = true;
    $_SESSION["id"] = $login->idUser();
    redirect($result, 'Welcome back!', 'home.php');
  } elseif ($result == 10) {
    redirect(false, 'Wrong password!', 'login.php');
  } elseif ($result == 100) {
    redirect(false, 'No user found!', 'login.php');
  }
}

$status = isset($_GET['status']) ? $_GET['status'] : '';
?>


<?php echo headerHTML() ?>

<body class="login-image lr-body">
  <div class="d-flex flex-column align-items-center vh-100 justify-content-around container-xl">
    <?php echo status_func($status) ?>
    <form class="form row g-3 p-4 bg-transparent-50 rounded" method="post">
      <h2 class="mt-0 ">Login</h2>
      <div class="col-md-12">
        <input type="text" class="form-control" placeholder="Username or Email" name="usernameemail" required>
      </div>
      <div class="col-md-12">
        <input type="password" class="form-control" placeholder="Password" name="password" required>
      </div>
      <div class="col-md-12">
        <button type="submit" name="submit" class="btn btn-success w-100">Login</button>
      </div>
      <div class="col-md-12">
        <a href="registration.php" class="btn btn-primary w-100">Registration</a>
      </div>
    </form>
  </div>
</body>

</html>