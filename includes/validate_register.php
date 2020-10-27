<?php

if(isset($_POST["submit"])) {
    $user = $_POST["user"];
    $pass = $_POST["pass"];
    require_once("dbch.php");
    require_once("utilities.php");
    global $conn;

    if(emptySignup($user, $pass) !== false){

        header("location: ../login/register.php?error=emptyFields");
        exit();

    }

    if(invalidUsername($user) !== false){

        header("location: ../login/register.php?error=invalidUser");
        exit();

    }

    if(usernameAlreadyTaken($conn, $user) !== false){

        header("location: ../login/register.php?error=usernameTaken");
        exit();

    }

    if(passLen($pass) !== false){

        header("location: ../login/register.php?error=passLen");
        exit();

    }

    createUser($conn, $user, $pass);

}else{

    header("location: ../login/register.php");

}
