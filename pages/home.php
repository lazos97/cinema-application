<?php
require '../classes/Database.php';
require '../classes/Movies.php';
require '../classes/Views.php';
require '../classes/Requests.php';
require '../includes/header.php';
require '../functions/redirects.php';
require '../includes/navbar.php';
require '../functions/authorization.php';
require '../functions/status_func.php';

$movies = new Movies(); //Show movies in user
$views = new Views(); //Show views in user
$requests = new Requests();

$user = authorization($_SESSION['id'], true);
$all_movies = $movies->getAllMovies();
$users_requests = $requests->getRequestByUserID($_SESSION["id"]);

if (isset($_POST["request"])) {
  $result = $requests->makeRequest($_SESSION["id"], $_POST['view_id']);
  redirect($result, 'You have been made a request!', 'home.php');
}

$status = isset($_GET['status']) ? $_GET['status'] : '';
?>

<?php echo headerHTML() ?>

<body>
  <?php echo navbar($user) ?>
  <div class="container">
    <h1 class="mb-3">Welcome back <span class="badge bg-secondary text-capitalize"><?php echo $user["name"]; ?></span></h1>
    <?php echo status_func($status) ?>
    <div>
      <div class="row p-2">
        <h3>Your requests.</h3>
        <?php
        if (!count($users_requests)) {
        ?>
          <!-- If user does not have request shows this pop up -->
          <div class="nr-info text-center">You have no requests</div>
          <?php } else {
          $index = 1;
          foreach ($users_requests as $request) { ?>
            <div class="col-md-3 g-3">
              <div class="card shadow">
                <div class="card-header"> <?php echo $index ?>. Request </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Date: <span class="badge bg-primary"><?php echo $request['date'] ?></span></li>
                  <li class="list-group-item">Movie: <span class="badge bg-primary text-capitalize"><?php echo $request['name'] ?></span></li>
                  <li class="list-group-item">Lobby: <span class="badge bg-primary text-capitalize"><?php echo $request['lobby'] ?></span></li>
                  <li class="list-group-item">Status: <span class="badge 
                <?php 
                if ($request['status'] == 'pending') echo 'bg-warning';
                else if ($request['status'] == 'approved') echo 'bg-success';
                else echo 'bg-danger'; ?>
                text-capitalize">
                      <?php echo $request['status'] ?></span></li>
                </ul>
              </div>
            </div>
        <?php $index++;
          }
        }
        ?>
      </div>
    </div>
    <div class="row mb-3">
      <?php foreach ($all_movies as $movie) {
        $views_for_movies = $views->getViewsByMovieId($movie['id']);
      ?>
        <div class="col-md-6 g-3">
          <div class="card mb-3">
            <div class="row g-0">
              <div class="col-md-4">
                <img src=<?php echo $movie['image'] ?> class="img-fluid rounded-start img-home">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title text-capitalize"> <span class="badge bg-primary"><?php echo $movie['name'] ?></span></h5>

                  <?php foreach ($views_for_movies as $view) { ?>
                    <form class="p-3 text-sm-start rounded mb-2 d-flex flex-wrap justify-content-between align-items-center border shadow" method="post">
                      <p class="card-text mb-0 mx-1 mt-1">Date: <span class="badge bg-primary"><?php echo $view['date'] ?></span></p>
                      <p class="card-text mb-0 mx-1 mt-1">Lobby: <span class="badge bg-primary"><?php echo $view['lobby'] ?></span></p>
                      <p class="card-text mb-0 mx-1 mt-1">Availabe seats: <span class="badge bg-primary"><?php echo $view['seats'] ?></span></p>
                      <input type='hidden' name='view_id' value=<?php echo $view['id'] ?>>
                      <button type=submit name=request class='btn btn-success text-capitalize mt-3 w-100'>Request Seat</button>
                    </form>
                  <?php } ?>

                </div>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</body>
<script src="../assets//js/status-alert.js"></script>

</html>