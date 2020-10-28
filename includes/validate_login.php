<?php

if (isset($_POST["submit"])){

    $user = $_POST["user"];
    $pass = $_POST["pass"];

    require_once("dbch.php");
    require_once ("utilities.php");

    global $conn;

    /* emptySignup() works here because I'm checking the same as in the signu form.- */
    if(emptySignup($user, $pass)){

        header("location: ../login/login.php?error=emptyInput");
        exit();
    }

    loginUser($conn, $user, $pass);

}else{
    header("location: ../login/login.php");
    exit();
}