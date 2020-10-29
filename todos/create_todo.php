<?php

session_start();

require_once("../includes/utilities.php");
require_once("../includes/dbch.php");
global $conn;

if (isset($_POST["submit"])){

    createTODO($conn, $_POST["title"], $_POST["content"], $_POST["priority"]);

}else{

    header("location: todo.php");
    exit();
}

if(isset($_POST["cancel"])){

    header("location: ../index.php");
    exit();

}
