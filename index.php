<?php

session_start();
session_regenerate_id();
require_once("includes/utilities.php")

?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">


</head>

<body>

<nav class="navbar navbar-dark navbar-expand-md navigation-clean-button">
    <div class="container"><a class="navbar-brand" href="#"><img class="navbar-image" src="bootstrapAssets/images/login_book_dm.png" alt="">Do It Now!</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav mr-auto">
                <?php
                if(isset($_SESSION["username"]) and isUserAdmin($_SESSION["userID"]) == 1):
                ?>
                <li class="nav-item"><a class="nav-link" href="admin_area/showUsers.php">Manage Users</a></li>
            </ul><span class="navbar-text actions"><a class="btn btn-light action-button" role="button" href="session/logout.php">Log out</a></span>
            <?php endif; ?>
            <?php if(!isset($_SESSION["username"])): ?>
                </ul><span class="navbar-text actions"> <a class="login" href="session/login.php">Log In</a><a class="btn btn-light action-button" role="button" href="session/register.php">Sign Up</a></span>
            <?php elseif(isset($_SESSION["username"]) and isUserAdmin($_SESSION["userID"]) == 0):?>
                <li class="nav-item"><a class="nav-link" href="show_todos.php">TODO's</a></li>
                </ul><span class="navbar-text actions"><a class="btn btn-light action-button" role="button" href="session/logout.php">Log out</a></span>
            <?php endif; ?>
        </div>
    </div>
</nav>

</body>

</html>