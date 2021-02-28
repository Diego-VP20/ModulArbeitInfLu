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


$result = getTodosToDisplay($_SESSION['userID']); // Go to utilities.php to see what this function does.


while($row = mysqli_fetch_array($result)){

    if($row['ID'] == $_GET['todoID']){

        $creationDate = $row['creationDate'];

    }

}

if(!isset($creationDate)){

    header('location: ../index.php');
    exit;

}


$userID = $_SESSION['userID'];
$todoID = $_GET['todoID'];
$title = $_POST['titel'];
$priority = $_POST['priority'];
$category = $_POST['category'];
$expiryDate = $_POST['expiryDate'];
$content = $_POST['inhalt'];

if(!empty(isOwnerOfTodo($_GET['todoID'], $_SESSION['userID']))){

    $allowedCategoriesID = array();

    foreach (hasAccessToCategories($_SESSION['userID']) as $value){

        array_push($allowedCategoriesID,$value[0]);

    }

    if(!in_array($category, $allowedCategoriesID)){

        header('location: ../todos/editTodo.php?todoID=' . $todoID . '&error=noAccessToCat');
        exit;

    }else {

        // Edit todo in DB

        global $conn;

        $stmt = mysqli_stmt_init($conn);

        mysqli_stmt_prepare($stmt, 'UPDATE todo SET fromUser=?,categoryID=?,expiryDate=?,creationDate=?,title=?,text=?,priority=? WHERE ID=?');

        mysqli_stmt_bind_param($stmt, 'iissssii', $userID, $category, $expiryDate, $creationDate, $title, $content, $priority, $todoID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header('location: ../index.php?error=editSuccess');
        exit;
    }
}else{

    header('location: ../index.php?error=noPermission');
    exit;

}