<?php
// Class for movies
class Movies extends Connection
{
    public function addMovie($name, $image)
    {
        $query = "INSERT INTO movies VALUES('', '$name', '$image')";
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            return 1; //success
        } else {
            return 0; //error
        }
    }

    public function getAllMovies()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM movies");
        $movies = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $movies[] = $row;
        }
        return $movies;
    }

    public function getSingleMovie($id)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM movies WHERE id = $id");
        return mysqli_fetch_assoc($result);
    }

    public function updateMovie($id, $name, $image)
    {
        $query = "UPDATE movies SET name = '$name', image = '$image' WHERE id = $id";
        $result = mysqli_query($this->conn, $query);
        return $result ? true : false;
    }
}
