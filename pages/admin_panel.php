<?php
require '../classes/Database.php';
require '../classes/Movies.php';
require '../classes/Views.php';
require '../includes/header.php';
require '../classes/Requests.php';
require '../functions/redirects.php';
require '../includes/navbar.php';
require '../functions/authorization.php';
require '../functions/status_func.php';

$select = new Select();
$user = authorization($_SESSION['id']);

// Create objects
$movies = new Movies();
$views = new Views();
$requests = new Requests();

//POST requests based on button element
if (isset($_POST["submit_movie_form"])) {
    $result = $movies->addMovie($_POST["name"], $_POST["image"]);
    redirect($result, 'Movie has been added.', 'admin_panel.php');
}
if (isset($_POST["submit_view_form"])) {
    $result = $views->insertViews($_POST["seats"], $_POST["lobby"], $_POST["dateTime"], $_POST["movie"]);
    redirect($result,  'View has been added.', 'admin_panel.php');
}
if (isset($_POST["approve"])) {
    $result = $requests->approveRequest($_POST["view_id"], $_POST["req_id"]);
    redirect($result,  'Request has been approved.', 'admin_panel.php');
}
if (isset($_POST["refuse"])) {
    $result = $requests->refuseRequest($_POST["req_id"]);
    redirect($result, 'Request has been refused.', 'admin_panel.php');
}


$all_movies = $movies->getAllMovies();
$all_views = $views->getAllViews();
$all_requests = $requests->getAllRequests();

$status = isset($_GET['status']) ? $_GET['status'] : '';

?>

<!--HTML Head-->
<?php echo headerhtml() ?>
<body>
    <?php echo navbar($user) ?>
    <div class="container">
        <h1>Admin Panel</h1>
         <?php echo status_func($status) ?>
    <section class="p-2 rounded bg-white mb-4">
    <form class="form row g-2 p-4 bg-transparent-50 rounded" method="post">
        <h3 class="mt-0">Add a movie</h3>
        <div class="col-md-12">
         <input type="text" class="form-control" name="name" placeholder="Movie name" required>
        </div>
        <div class="col-md-12">
          <input type="text" class="form-control" name="image" placeholder="Image URL" required>
        </div>
        <div class="col-md-12">
          <button type="submit" name="submit_movie_form" class='btn btn-primary'>Add</button>
        </div>
    </form>
    <div class="w-100 d-flex flex-wrap justify-content-center">
        <!-- div class to show movie information to edit -->
        <?php foreach ($all_movies as $movie) { ?>
        <div class="card w-25 ws-250 mx-2 mb-4">
            <img src="<?php echo $movie['image'] ?>" class="card-img-top img-fluid img-admin-panel">
            <div class="card-body">
                <h5 class="card-title">Title: <span class="badge bg-primary text-capitalize"><?php echo $movie['name'] ?></span></h5>
                <a href='single-movie.php?id=<?php echo $movie['id'] ?>' class="btn btn-primary w-100 mt-2">Edit</a>
            </div>
        </div>
       <?php } ?>
    </div>
    </section>
    <section class="p-2 rounded bg-white mb-4">
         <form class="form row g-2 p-4 bg-transparent-50 rounded" method="post">
            <h3>Add a view</h3>
             <div class="col-md-12">
            <input type="text" class="form-control" name="seats" placeholder="Seats" required>
             </div>
             <div class="col-md-12">
            <input type="text" class="form-control" name="lobby" placeholder="Lobby" required>
             </div>
             <div class="col-md-12">
            <input type="text" class="form-control" name="dateTime" placeholder="Date/Time" required>
             </div>
            <select name="movie" class="form-select mb-2">>
                <?php foreach ($all_movies as $movie) { 
                    echo "   <option value=" . $movie['id'] . "> " . $movie['name'] . "</option>";
                } ?>
            </select>
            <div class="col-md-12">
            <button type="submit" name="submit_view_form" class='btn btn-primary'>Add</button>
            </div>
        </form>

        <!-- // div class για να μας εμφανίζει τις προβολές ταινιών και left join τα views με τα movies για να πάρουμε το όνομα της Ταινίας. -->
      <div class="w-100 d-flex flex-wrap justify-content-center">
        <?php 
        $i = 1;
        foreach ($all_views as $view) { ?>
        <div class="card w-25 ws-250 mx-2 mb-4">
            <div class="card-header">
                <h4 class="m-0"><?php echo $i ?>/<?php echo count($all_views) ?></h4>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Seats: <span class="badge rounded-pill bg-primary ms-1"><?php echo $view['seats'] ?></span></li>
                <li class="list-group-item">Lobby: <span class="badge rounded-pill bg-primary ms-1 text-capitalize"> <?php echo $view['lobby'] ?></span></li>
                <li class="list-group-item">Date: <span class="badge rounded-pill bg-primary ms-1"><?php echo $view['date'] ?></span></li>
                <li class="list-group-item">Movie: <span class="badge rounded-pill bg-primary ms-1 text-capitalize"><?php echo $view['name'] ?></span></li>
                <li class="list-group-item"><a href='single-view.php?id=<?php echo $view['id'] ?>' class='btn btn-primary w-100'>Edit</a></li>                
            </ul>
        </div>
         <?php 
        $i++;
        } ?>
    </div>
    </section>

    <section class="p-2 rounded bg-white mb-4">
    <h3 class="p-4">Requests for a seat from users</h3>
    <div class="w-100 d-flex flex-wrap justify-content-center">
        <?php
        $y = 1;
         //Τα input είναι hidden γιατι δεν θέλουμε να μας εμφανίζει τα id στις ταινίες. Το if else condition το έκανα γιατί όταν ο admin κάνει ενα request approved ή refused, τα seats να επανέρχονται στην αρχική τους θέση.
        foreach ($all_requests as $request) { ?>
         <div class="card w-25 ws-250 mx-2 mb-4">
            <div class="card-header">
                <h4 class="m-0"><?php echo $y ?>/<?php echo count($all_requests) ?></h4>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Movie: <span class="badge rounded-pill bg-primary ms-1 text-capitalize"><?php echo $request['movie_name'] ?></span></li>
                <li class="list-group-item">Date: <span class="badge rounded-pill bg-primary ms-1"><?php echo $request['date'] ?></span></li>
                <li class="list-group-item">Lobby: <span class="badge rounded-pill bg-primary ms-1 text-capitalize"><?php echo $request['lobby'] ?></span></li>
                <li class="list-group-item">Status: <span class="badge rounded-pill bg-<?php
                if($request['status'] === 'pending') {
                    echo "warning";
                } else if($request['status'] === 'approved') {
                    echo "success";
                } else {
                    echo "danger";
                }
                ?> ms-1 text-capitalize"><?php echo $request['status'] ?></span></li>
                <li class="list-group-item">User: <span class="badge rounded-pill bg-primary ms-1 text-capitalize"><?php echo $request['name'] ?></span></li>
                <li class="list-group-item">Available Seats: <span class="badge rounded-pill bg-primary ms-1"><?php echo $request['seats'] ?></span></li>
                <li class="list-group-item">
                    <form method='post'> 
                        <input type='hidden' name='req_id' value='<?php echo $request['id'] ?>'> 
                        <input type='hidden' name='view_id' value='<?php echo $request['views_id'] ?>'>
                         <?php if ($request['status'] === 'pending') { ?>
                            <button type='submit' name='approve' class='btn btn-success'>Approve</button>
                            <button type='submit' name='refuse' class='btn btn-danger'>Refused</button>
                        <?php } else if ($request['status'] === 'approved') { ?>
                            <button type='submit' name='refuse' class='btn btn-danger'>Refused</button>
                        <?php } else if ($request['status'] === 'refused') { ?>
                            <button type='submit' name='approve' class='btn btn-success'>Approve</button>
                         <?php } ?>
                    </form>
                </li>             
            </ul>
        </div>
       <?php $y++; } ?>
    </div>
    </section>
    </div>
</body>
</html>