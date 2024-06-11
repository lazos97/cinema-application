<?php
require '../classes/Database.php';
require '../classes/Movies.php';
require '../includes/header.php';
require '../includes/navbar.php';
require '../functions/authorization.php';
require '../functions/redirects.php';
require '../functions/status_func.php';

$id = $_GET['id'];

$movie = new Movies();

$single_movie = $movie->getSingleMovie($id);
$user = authorization($_SESSION['id']);

if (isset($_POST["update-form"])) {
    $result = $movie->updateMovie($id, $_POST["name"], $_POST["image"]);
    redirect($result, 'Movie has been updated', 'single-movie.php', $id);
}

$status = isset($_GET['status']) ? $_GET['status'] : '';
?>

<!--HTML Head-->
<?php echo headerHTML() ?>

<body>
    <?php echo navbar($user) ?>
    <div class="container">
        <h1 class="mb-3">Update <?php echo $single_movie['name'] ?> movie</h1>
        <?php echo status_func($status) ?>
        <form class="w-100 d-flex flex-column bg-secondary rounded shadow p-3 mb-3" method="post">
            <h3>Update Movie</h3>
            <input type="text" name="name" class="form-control mb-2" required value="<?php echo htmlspecialchars($single_movie['name'], ENT_QUOTES); ?>">
            <input type="text" name="image" class="form-control mb-2" required value=<?php echo $single_movie['image']; ?>>
            <button type="submit" name="update-form" class="btn btn-primary w-100">Update</button>
        </form>
        <!-- Card class -->
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="<?php echo $single_movie['image'] ?>" class="img-fluid rounded-start" alt="Movie Profile Image">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Movie Title</h5>
                        <p class="card-text"><?php echo $single_movie['name'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../assets//js/status-alert.js"></script>

</html>