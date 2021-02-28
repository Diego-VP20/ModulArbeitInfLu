<?php

session_start();
session_regenerate_id();

require_once('../includes/utilities.php');

if(isset($_GET['todoID'])){

    $todoID = $_GET['todoID'];

    if(!empty(isOwnerOfTodo($todoID, $_SESSION['userID']))){

        unArchiveTodo($todoID); // Go to utilities.php to get further information about the function.
        header('location: ../index.php?error=unArchiveSuccessful');
        exit;

    }else{

        header('location: ../index.php?error=noPermission');
        exit;

    }

}else{

    header('location: ../index.php');
    exit;

}