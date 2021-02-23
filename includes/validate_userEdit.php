<?php

session_start();
session_regenerate_id();

require_once("utilities.php");

if(isset($_SESSION["username"])){

    if(isUserAdmin($_SESSION["userID"]) != 1){

        header("location: ../index.php");
        exit();

    }

}else{

    header("location: ../index.php");
    exit();

}

if(isUserAdmin($_GET['userID']) == 1) header("location: ../index.php");

if(isset($_POST['submit']) && $_POST['submit'] == 'changeUName' && isset($_POST['newUsername']) && !empty($_POST['newUsername'])){

    changeUsername($_GET["userID"], $_POST['newUsername']);

}if(isset($_POST['submit']) && $_POST['submit'] == 'changePWord' && isset($_POST['newPassword']) && !empty($_POST['newPassword'])){

    changePassword($_GET['userID'], $_POST['newPassword']);

}


