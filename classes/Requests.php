<?php

class Requests extends Connection
{
    // Create Request
    public function makeRequest($user_id, $views_id)
    {
        $query = "INSERT INTO requests VALUES('', 'pending' ,'$user_id', '$views_id')";
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            return 1; //success
        } else {
            return 0; //error
        }
    }

    // Get user request.
    public function getRequestByUserID($user_id)
    {
        $query = "SELECT m.name, v.date, v.lobby, r.status FROM requests r JOIN views v on r.views_id = v.id LEFT JOIN movies m ON v.movieFK = m.id WHERE r.user_id = $user_id";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Shows request for Admin
    public function getAllRequests()
    {
        $query = "SELECT m.name as movie_name, v.date, v.lobby, r.status, u.name, r.id, v.seats, r.views_id FROM requests r JOIN views v on r.views_id = v.id LEFT JOIN movies m ON v.movieFK = m.id JOIN users u on r.user_id = u.id";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Function when the admin accept a request
    public function approveRequest($view_id, $req_id)
    {
        $query = "UPDATE views SET seats = seats - 1 WHERE id = $view_id";
        mysqli_query($this->conn, $query);

        $queryReq = "UPDATE requests SET status = 'approved' WHERE id = $req_id";
        $result = mysqli_query($this->conn, $queryReq);

        if ($result) {
            return 1; //succes
        } else {
            return 0; //error
        }
    }

    //Function when the admin refuse a request
    public function refuseRequest($req_id)
    {
        $fetchSingleQuery = "SELECT * FROM requests WHERE id = $req_id";
        $fetchRes = mysqli_query($this->conn, $fetchSingleQuery);
        $reqToUpdate = mysqli_fetch_assoc($fetchRes);
        if ($reqToUpdate['status'] == 'approved') {
            $view_id = $reqToUpdate['views_id'];
            $query = "UPDATE views SET seats = seats + 1 WHERE id = $view_id";
            mysqli_query($this->conn, $query);
        }

        $query = "UPDATE requests SET status = 'refused' WHERE id = $req_id";
        $result = mysqli_query($this->conn, $query);

        if ($result) {
            return 1; //succes
        } else {
            return 0; //error
        }
    }
}
