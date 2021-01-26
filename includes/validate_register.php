<?php

if(isset($_POST["submit"]) && $_POST["submit"] == "Sign Up") {
    $user = $_POST["user"];
    $pass = $_POST["pass"];
    require_once("dbch.php");
    require_once("utilities.php");
    global $conn;

    if(emptySignup($user, $pass) !== false){

        header("location: ../session/register.php?error=emptyFields");
        exit();

    }

    if(invalidUsername($user) !== false){

        header("location: ../session/register.php?error=invalidUser");
        exit();

    }

    if(checkForUser($conn, $user) !== false){

        header("location: ../session/register.php?error=usernameTaken");
        exit();

    }

    if(passLen($pass) !== false){

        header("location: ../session/register.php?error=passLen");
        exit();

    }

    createUser($conn, $user, $pass);

}else{

    header("location: ../session/register.php");

}
