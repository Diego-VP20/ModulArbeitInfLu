<?php

session_start();
session_regenerate_id();

include_once('utilities.php');
include_once('dbch.php');

if(!isset($_SESSION['userID'])){

    header('location: ../session/login.php?error=notLogged');
    exit;

}

if(isUserAdmin($_SESSION['userID']) == 1){

    header('location: ../index.php');
    exit;

}

if(!isset($_POST['titel'], $_POST['priority'], $_POST['category'], $_POST['expiryDate'], $_POST['inhalt'])){

    header('location: ../todos/addTodo.php?error=missingValues');
    exit;

}

global $conn;

$userID = $_SESSION['userID'];
$title = $_POST['titel'];
$priority = $_POST['priority'];
$category = $_POST['category'];
$expiryDate = $_POST['expiryDate'];
$content = $_POST['inhalt'];

$allowedCategoriesID = array();

foreach (hasAccessToCategory($_SESSION['userID']) as $value){

    array_push($allowedCategoriesID,$value[0]);

}

if(!in_array($category, $allowedCategoriesID)){

    header('location: ../todos/addTodo.php?error=noAccessToCat&content='.$content);

}else {

    $stmt = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($stmt, "insert into todo(fromUser,categoryID,expiryDate,title,text,priority) values(?,?,?,?,?,?)");

    mysqli_stmt_bind_param($stmt, "iisssi", $userID, $category, $expiryDate, $title, $content, $priority);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../index.php?error=success");
    exit;
}