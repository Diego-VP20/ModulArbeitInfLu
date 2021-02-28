<?php

session_start();
session_regenerate_id();

require_once('../includes/utilities.php');


if(!isset($_GET['userID'], $_POST['categoryName']) or empty($_POST['categoryName'])){

    header('location: ../index.php');
    exit;

}

if(isset($_SESSION['userID'])){

    if(isUserAdmin($_SESSION['userID']) != 1){

        header('location: ../index.php');
        exit;

    }
    if(isUserAdmin($_GET['userID']) == 1) header('location: ../index.php');


}else{

    header('location: ../index.php');
    exit;

}

$nameOfCategoryToAdd = trim($_POST['categoryName']);

global $conn;

$stmt = mysqli_stmt_init($conn);

// Check if there is a category with the $nameOfCategoryToAdd

mysqli_stmt_prepare($stmt, 'SELECT ID, name FROM category where name=?');
mysqli_stmt_bind_param($stmt, 's',$nameOfCategoryToAdd);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$result = mysqli_fetch_all($result);

mysqli_stmt_close($stmt);

// If category doesn't exist
if(sizeof($result) < 1) {

    $stmt = mysqli_stmt_init($conn);

    // Create category

    mysqli_stmt_prepare($stmt, 'INSERT INTO category(name) VALUES(?)');
    mysqli_stmt_bind_param($stmt, 's',$nameOfCategoryToAdd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $stmt = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($stmt, 'SELECT ID, name FROM category where name=?');
    mysqli_stmt_bind_param($stmt, 's',$nameOfCategoryToAdd);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $result = mysqli_fetch_all($result);

    addToCategory($result);

// If category exists
}elseif(sizeof($result) == 1){

    addToCategory($result);

}

function addToCategory($result){

    global $conn;
    $stmt = mysqli_stmt_init($conn);

    $categoryID = $result[0][0];
    mysqli_stmt_prepare($stmt, 'SELECT UserID, CategoryID FROM users_category where UserID=? and CategoryID=?');
    mysqli_stmt_bind_param($stmt, 'ii',$_GET['userID'],$categoryID);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $result = mysqli_fetch_all($result);

    mysqli_stmt_close($stmt);

    // User has to be added to category
    if(sizeof($result)==0){

        $stmt = mysqli_stmt_init($conn);

        mysqli_stmt_prepare($stmt, 'INSERT INTO users_category VALUES(?,?)');
        mysqli_stmt_bind_param($stmt, 'ii',$_GET['userID'],$categoryID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header('location: ../admin_area/adminPage.php?error=categoryAddSuccess');

    // User already in category
    }elseif(sizeof($result)>0){

        header('location: ../admin_area/adminPage.php?error=alreadyInCat');

    }

}