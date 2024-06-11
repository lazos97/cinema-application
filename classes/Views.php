<?php
class Views extends Connection
{
    public function insertViews($seats, $lobby, $date, $movieFK)
    {
        $query = "INSERT INTO views VALUES('', '$seats', '$lobby', '$date', '$movieFK')";
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            return 1; //success
        } else {
            return 0; //error
        }
    }

    public function getAllViews()
    {
        $query = "SELECT views.id, views.seats, views.lobby, views.date, movies.name, movies.id AS movie_id FROM views LEFT JOIN movies ON views.movieFK = movies.id";
        $result = mysqli_query($this->conn, $query);
        $views = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $views[] = $row;
        }
        return $views;
    }

    public function getSingleView($id)
    {
        $query = "SELECT views.id, views.seats, views.lobby, views.date, movies.name, movies.id AS movie_id 
    FROM views
    LEFT JOIN movies ON views.movieFK = movies.id
    WHERE views.id = $id";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_assoc($result);
    }

    public function updateViews($view_id, $seats, $lobby, $date, $movie_id)
    {
        $query = "UPDATE views SET seats = '$seats', lobby = '$lobby', date = '$date', movieFK = '$movie_id' WHERE id = $view_id";
        $result = mysqli_query($this->conn, $query);
        return $result ? true : false;
    }

    public function getViewsByMovieId($movie_id)
    {
        $query = "SELECT * FROM views WHERE movieFK = $movie_id";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
