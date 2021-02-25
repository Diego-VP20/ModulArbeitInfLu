<?php

session_start();
session_regenerate_id();

require_once("../includes/utilities.php");

if(isset($_SESSION["username"])){

    if(isUserAdmin($_SESSION["userID"]) != 1){

        header("location: ../index.php");
        exit;

    }

}else{

    header("location: ../index.php");
    exit;

}

if(!isset($_GET["userID"])){

    header("location: ../index.php");
    exit;

}

if(isUserAdmin($_GET['userID']) == 1){

    header("location: ../index.php");
    exit;

}


deleteUser($_GET["userID"]);
header("location: ../index.php");