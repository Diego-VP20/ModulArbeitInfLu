<?php

session_start();
session_regenerate_id();

require_once('../includes/utilities.php');

if(isset($_SESSION['username'])){

    if(isUserAdmin($_SESSION['userID']) != 1){

        header('location: ../index.php');
        exit;

    }

}else{

    header('location: ../index.php');
    exit;

}

if(!isset($_GET['userID'], $_POST['categoryName']) or empty($_POST['categoryName'])){

    header('location: ../index.php');
    exit;

}

if(isUserAdmin($_GET['userID']) == 1) header('location: ../index.php');


global $conn;

// When user taken out from category then his TODO's shouldn't be visible

$stmt = mysqli_stmt_init($conn);

mysqli_stmt_prepare($stmt, 'UPDATE todo SET isArchived = 1 WHERE fromUser=? and categoryID=?');
mysqli_stmt_bind_param($stmt, 'ii', $_GET['userID'], $_POST['categoryName']);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

$stmt = mysqli_stmt_init($conn);

mysqli_stmt_prepare($stmt, 'DELETE FROM users_category WHERE UserID=? and CategoryID=?');
mysqli_stmt_bind_param($stmt, 'ii', $_GET['userID'], $_POST['categoryName']);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

header('location: ../index.php');
exit;