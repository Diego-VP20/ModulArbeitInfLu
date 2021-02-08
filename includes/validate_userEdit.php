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

if(isset($_GET["userID"], $_POST["newPass"], $_POST["newUsername"])){

    $oldInformationArray = getUserByID($_GET["userID"]);
    $newPass = $_POST["newPass"];
    $newUsername = $_POST["newUsername"];

    if(empty($newPass) and empty($newUsername)){

        header("location: ../admin_area/editUser.php?userID=".$_GET['userID']."&error=emptyFields");
        exit;

    }elseif(empty($newPass) and $newUsername == $oldInformationArray["userName"]){

        header("location: ../admin_area/showUsers.php");
        exit;

        // Only the password was changed in this case.
    }elseif(!empty($newPass) and $oldInformationArray["passwordHash"] != password_hash($newPass, PASSWORD_DEFAULT)
        and !empty($newUsername) and $newUsername == $oldInformationArray["userName"]){

        changePassword($oldInformationArray["ID"], $newPass);

        // Only the username was changed.
    }elseif(empty($newPass) and !empty($newUsername) and $newUsername != $oldInformationArray["userName"]){

        changeUsername($oldInformationArray["ID"], $newPass);

        // Both user and password are new
    }elseif(!empty($newPass) and !empty($newUsername) and $oldInformationArray["passwordHash"] != password_hash($newPass, PASSWORD_DEFAULT)
        and $newUsername != $oldInformationArray["userName"]){

        changeUsernameAndPassword($oldInformationArray["ID"], $newUsername, $newPass);

    }

}