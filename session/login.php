<?php

    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- CSS from Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">

    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark static-top bg-dark" style="z-index: 5; position:fixed; width:100%;top:0;border-radius: 0 0 60px 60px; opacity: 0.7;">
        <div class="container">
            <a class="navbar-brand" href="../index.php"><img src="../assets/images/login_book_dm.png" alt="" width="8%" height="8%"> Get It Done!</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>

                    <?php

                    if(isset($_SESSION["username"])){
                        header("location: ../index.php?error=alreadyLogged");
                        exit();

                    }else {

                        echo '
                        
                            <li class="nav-item" >
                                <a class="nav-link" href = "register.php" > Sign Up </a >
                            </li >
                        
                        ';

                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="wrapper fadeInDown" style="z-index: 9; padding-top:100px;">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
                <img src="../assets/images/login_book_dm.png" id="icon" alt="User Icon" style="width: 100px; height: auto; margin: 20px 0 15px 0"/>
            </div>

            <!-- Login Form -->
            <form action="../includes/validate_login.php" method="post" autocomplete="off">
                <label for="login"></label><input type="text" id="login" class="fadeIn second" name="user" placeholder="Username">
                <label for="password"></label><input type="password" id="password" class="fadeIn third" name="pass" placeholder="Password">
                <input type="submit" name="submit" class="fadeIn fourth" value="Log In" style="margin-top: 20px">
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
            }

            ?>

            <!-- Create Account -->
            <div id="formFooter">
                <a class="underlineHover" href="register.php">Not registered yet? Sign up!</a>
            </div>

        </div>
    </div>

</body>
</html>

