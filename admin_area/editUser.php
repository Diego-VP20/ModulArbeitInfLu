<?php
session_start();
session_regenerate_id();

require_once("../includes/utilities.php");

if(isset($_SESSION["username"])){

    if(isUserAdmin($_SESSION["userID"]) != 1){

        header("location: ../index.php");
        exit();

    }

}else{

    header("location: ../index.php");
    exit();

}

// By this point the user is verified as admin.

if(!isset($_GET["userID"]) or $_GET["userID"] == ""){

    header("location: showUsers.php");
    exit();

}

?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Edit User</title>
    <script src="https://kit.fontawesome.com/0914a3a2ee.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/adminsite.css">

</head>

<body>

<nav class="navbar navbar-dark navbar-expand-md navigation-clean-button">
    <div class="container"><a class="navbar-brand" href="../index.php"><img class="navbar-image" src="../assets/images/login_book_dm.png" alt="">Do It Now!</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="showUsers.php">Manage Users</a></li>
            </ul><span class="navbar-text actions"><a class="btn btn-light action-button" role="button" href="../session/logout.php">Log out</a></span>
        </div>
    </div>
</nav>

<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first">
            <img src="../assets/images/login_book_dm.png" id="icon" alt="User Icon" style="width: 100px; height: auto; margin: 20px 0 15px 0"/>
        </div>

        <!-- Login Form -->
        <form class="pt-3" action="../includes/validate_userEdit.php?userID=<?=$_GET['userID']?>" method="post" autocomplete="off">
            <?php

            /* Error handler */

            if (isset($_GET["error"])) {

                if ($_GET["error"] == "userTaken") {

                    echo '<div class="login-error-div">
                                          <p class="login-error-text">Es gibt schon einen Benutzer mit diesen Namen</p>
                                    </div>
                                    ';

                }

                if ($_GET["error"] == "passLen") {

                    echo '<div class="login-error-div">
                                          <p class="login-error-text">Passwort muss grösser als 8 und kleiner als 255 sein</p>
                                    </div>
                                    ';

                }

                if ($_GET["error"] == "invalidUsername") {

                    echo '<div class="login-error-div">
                                          <p class="login-error-text">Dieser Benutzername kann nicht benutzt werden.</p>
                                    </div>
                                    ';

                }

                if ($_GET["error"] == "emptyFields") {

                    echo '<div class="login-error-div">
                                          <p class="login-error-text">Füllen Sie bitte mindestens den Benutzername aus.</p>
                                    </div>
                                    ';

                }

            }
            ?>
            <label for="username"></label><input type="text" value="<?= getUserByID($_GET['userID'])["userName"]?>" id="username" class="fadeIn second" name="newUsername" placeholder="Username">
            <label for="password"></label><input type="password" id="password" class="fadeIn third" name="newPass" placeholder="New Password or empty for no changes">
            <input type="submit" name="submit" class="fadeIn fourth mt-4" value="Edit">
        </form>

    </div>
</div>
</body>

</html>