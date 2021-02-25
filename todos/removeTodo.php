<?php

session_start();
session_regenerate_id();

require_once('../includes/utilities.php');

if(isset($_GET['todoID'])){

    $todoID = $_GET['todoID'];

    if(!empty(isOwnerOfTodo($todoID, $_SESSION['userID']))){

        removeTodo($todoID);
        header('location: ../index.php?error=removalSuccessful');
        exit;

    }else{

        header('location: ../index.php?error=noPermission');
        exit;
        
    }

}else{

    header('location: ../index.php');
    exit;
    
}