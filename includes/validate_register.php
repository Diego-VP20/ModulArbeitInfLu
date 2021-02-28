<?php

if(isset($_POST['submit']) && $_POST['submit'] == 'Sign Up') {
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    require_once('dbch.php');
    require_once('utilities.php');
    global $conn;

    if(emptySignup($user, $pass) !== false){

        header('location: ../session/createUser.php?error=emptyFields');
        exit;

    }

    if(invalidUsername($user) !== false){

        header('location: ../session/createUser.php?error=invalidUser');
        exit;

    }

    if(checkForUser($user) !== false){

        header('location: ../session/createUser.php?error=usernameTaken');
        exit;

    }

    if(passLen($pass) !== false){

        header('location: ../session/createUser.php?error=passLen');
        exit;

    }

    createUser($user, $pass); // Go to utilities.php to get further information about the function.

}else{

    header('location: ../session/createUser.php');

}
