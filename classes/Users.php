<?php
class Register extends Connection
{
    public function registration($name, $username, $email, $password, $confirmpassword)
    {
        $duplicate = mysqli_query($this->conn, "SELECT * FROM users WHERE username = '$username' OR email = '$email'");
        if (mysqli_num_rows($duplicate) > 0) {
            return 10;
            // Username or email exist.
        } else {
            if ($password == $confirmpassword) {
                $query = "INSERT INTO users VALUES('', '$name', '$username', '" . md5($password) . "', '$email', 'customer')"; // Έβαλα το md5 function για να είναι το password κρυπτογραφημένο στην βάση.
                mysqli_query($this->conn, $query);
                return 1;
                // Succesful register return 1
            } else {
                return 100;
                // Password dont match. Return 100
            }
        }
    }
}

class Login extends Connection
{
    public $id;
    public function login($usernameemail, $password)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM users WHERE username = '$usernameemail' OR email = '$usernameemail'");
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) > 0) {
            if (md5($password) == $row["password"]) {
                $this->id = $row["id"];
                return 1;
                // Succesful login
            } else {
                return 10;
                // Wrong password.
            }
        } else {
            return 100;
            // User does not exist
        }
    }

    public function idUser()
    {
        return $this->id;
    }
}

class Select extends Connection
{
    public function selectUserById($id)
    {
        $result = mysqli_query($this->conn, "SELECT * FROM users WHERE id = $id");
        return mysqli_fetch_assoc($result);
    }
}
