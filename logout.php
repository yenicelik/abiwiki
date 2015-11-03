<?php 

    // First we execute our common code to connection to the database and start the session 
    require_once("startup.php");

    // We remove the user's data from the session 
    unset($_SESSION['loggedin']);

    destroySession();
     
    // We redirect them to the login page

    header("Location: index.php");
    exit();