<?php

session_start();
session_regenerate_id();

if(isset($_SESSION["userID"])){

    header("location: ../index.php");
    exit();

}

?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Sign-Up</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css">

</head>

<body>
<nav class="navbar navbar-dark navbar-expand-md navigation-clean-button">
    <div class="container"><a class="navbar-brand" href="../index.php"><img class="navbar-image" src="../bootstrapAssets/images/login_book_dm.png" alt="">Do It Now!</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="#">TODO's</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Admin</a></li>
            </ul><span class="navbar-text actions"> <a class="login" href="login2.php">Log In</a></span>
        </div>
    </div>
</nav>

<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first">
            <img src="../bootstrapAssets/images/login_book_dm.png" id="icon" alt="User Icon" style="width: 100px; height: auto; margin: 20px 0 15px 0"/>
        </div>

        <!-- Login Form -->
        <form action="../includes/validate_register.php" method="post" autocomplete="off">
            <label for="login"></label><input type="text" id="login" class="fadeIn second" name="user" placeholder="Username">
            <label for="password"></label><input type="password" id="password" class="fadeIn third" name="pass" placeholder="Password">
            <input type="submit" name="submit" class="fadeIn fourth mt-4" value="Sign Up">
        </form>

        <?php

        /* Error handler */

        if (isset($_GET["error"])) {

            if ($_GET["error"] == "emptyInput") {

                echo '<div class="login-error-div">
                                  <p class="login-error-text">Eins oder mehrere Pflichtfelder wurden ausgelassen!</p>
                            </div>
                            ';

            }

            if ($_GET["error"] == "logout") {

                echo '<div class="login-success-div">
                                  <p class="login-success-text">Sie haben sich erfolgreich abgemeldet!</p>
                            </div>
                            ';

            }

            if ($_GET["error"] == "wrongPass" || $_GET["error"] == "userNotExists") {

                echo '<div class="login-error-div">
                                  <p class="login-error-text">Diesen Benutzer gibt es nicht oder das Passwort ist falsch!</p>
                            </div>
                            ';

            }

            if ($_GET["error"] == "notLogged") {

                echo '<div class="login-error-div">
                                  <p class="login-error-text">Sie sind nicht eingeloggt!</p>
                            </div>
                            ';

            }

            if ($_GET["error"] == "createUserFailed") {

                echo '<div class="login-error-div">
                                  <p class="login-error-text">Es konnte kein Benutzer erstellt werden.</p>
                            </div>
                            ';

            }

            if ($_GET["error"] == "invalidUser") {

                echo '<div class="login-error-div">
                                  <p class="login-error-text">Dieser Benutzername kann nicht benutzt werden.</p>
                            </div>
                            ';

            }

            if ($_GET["error"] == "success") {

                echo '<div class="login-success-div">
                                  <p class="login-success-text">Erfolgreich registriert. Wir leiten Sie weiter.</p>
                            </div>
                            ';
                header("Refresh: 4; ../session/login2.php");


            }
        }

        ?>

        <!-- Create Account -->
        <div id="formFooter">
            <a class="underlineHover" href="createUser.php">Not registered yet? Sign up!</a>
        </div>

    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>