<?php

session_start();
session_regenerate_id();

?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/Navigation-with-Button.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/own_style.css">

</head>

<body>
<nav class="navbar navbar-dark navbar-expand-md navigation-clean-button">
    <div class="container"><a class="navbar-brand" href="index.php"><img class="navbar-image" src="assets/images/login_book_dm.png" alt="">Do It Now!</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="#">TODO's</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Admin</a></li>
            </ul><span class="navbar-text actions"><a class="login" href="login.php">Log In</a></span>
        </div>
    </div>
</nav>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>