<?php
require './classes/Database.php';
require './classes/Movies.php';
require './classes/Users.php';
require './classes/Views.php';
require './includes/header.php';

$_SESSION = [];
session_unset();
session_destroy();
header("Location: ./pages/login.php");

//When logout session is terminated.
