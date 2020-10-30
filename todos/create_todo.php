<?php

session_start();

require_once("../includes/utilities.php");
require_once("../includes/dbch.php");
global $conn;

if (isset($_POST["submit"])){

    if($_POST["title"].strlen() > 25){

        header("location: todo.php?error=titleLong");
        exit();

    }elseif (empty($_POST["title"])){

        header("location: todo.php?error=empty");
        exit();

    }

    createTODO($conn, $_POST["title"], $_POST["content"], $_POST["priority"]);

}elseif(isset($_POST["cancel"])){

    header("location: ../index.php");
    exit();

}

else{

    header("location: todo.php");
    exit();
}


