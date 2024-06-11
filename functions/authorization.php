<?php
require '../classes/Users.php';

function authorization($id, $is_on_home = false)
{
    // Condition for user cannot redirect to admin page
    if (!empty($id)) {
        $select = new Select();
        $user = $select->selectUserById($id);

        if ($user['usertype'] != 'admin' && !$is_on_home) {
            header("Location: ../pages/home.php");
        }

        return $user;
    } else {
        header("Location: ../pages/login.php");
    }
}
