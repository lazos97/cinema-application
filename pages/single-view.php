<?php
require '../classes/Database.php';
require '../classes/Movies.php';
require '../classes/Views.php';
require '../includes/header.php';
require '../includes/navbar.php';
require '../functions/authorization.php';
require '../functions/redirects.php';
require '../functions/status_func.php';

$user = authorization($_SESSION['id']);

$id = $_GET['id'];

$views = new Views();
$movies = new Movies();

$single_view = $views->getSingleView($id);
$all_movies = $movies->getAllMovies();

if (isset($_POST["update-form"])) {
    $result = $views->updateViews($id, $_POST["seats"], $_POST["lobby"], $_POST["date"], $_POST["movie"]);
    redirect($result, 'View has been updated', 'single-view.php', $id);
}

$status = isset($_GET['status']) ? $_GET['status'] : '';
?>

<!--HTML Head-->
<?php echo headerHTML() ?>

<body>
    <?php echo navbar($user) ?>
    <div class="container">
        <h1 class="mb-3">Update view for <?php echo $single_view['date']; ?> for movie : <?php echo $single_view['name']; ?> </h1>
        <?php echo status_func($status) ?>
        <form class="w-100 d-flex flex-column bg-secondary rounded shadow p-3 mb-3" method="post">
            <h3>Update View</h3>
            <input type="text" name="seats" class="form-control mb-2" required value=<?php echo $single_view['seats']; ?>>
            <input type="text" name="lobby" class="form-control mb-2" required value=<?php echo $single_view['lobby']; ?>>
            <input type="text" name="date" class="form-control mb-2" required value=<?php echo $single_view['date']; ?>>
            <select name="movie" class="form-select mb-2">
                <?php foreach ($all_movies as $movie) { 
                    $selected = ($movie['id'] == $single_view['movie_id']) ? 'selected' : '';
                    echo "<option value='" . $movie['id'] . "' $selected>" . $movie['name'] . "</option>";
                } ?>
            </select>
            <button type="submit" name="update-form" class="btn btn-primary w-100">Update</button>
        </form>
        <!-- Card -->
        <div class="card w-100">
            <div class="card-header">
                <h4>Current values of view</h4>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><span class="badge rounded-pill bg-primary ms-1">Seats</span> <?php echo $single_view['seats'] ?></li>
                <li class="list-group-item"><span class="badge rounded-pill bg-primary ms-1">Lobby</span> <?php echo $single_view['lobby'] ?></li>
                <li class="list-group-item"><span class="badge rounded-pill bg-primary ms-1">Date</span> <?php echo $single_view['date'] ?></li>
                <li class="list-group-item"><span class="badge rounded-pill bg-primary ms-1">Movie</span> <?php echo $single_view['name'] ?></li>
            </ul>
        </div>
    </div>
</body>
<script src="../assets//js/status-alert.js"></script>

</html>