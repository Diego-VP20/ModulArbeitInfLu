<?php

    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- CSS from Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/style.css">

    <meta charset="UTF-8">
    <title>Home</title>
</head>

<body style="background-image: url('assets/images/login_background_dm.jpg')">
<!-- JS from Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <?php

    if (isset($_GET["loggedIn"])){

        if ($_GET["loggedIn"] == "1"){

            echo '
                                <div style="position: absolute; bottom: 0; right: 0; top: 0; left: 0; ">
                                <div class="alert alert-success alert-dismissible fade show fadeInDown" style="z-index: 10; margin: 10px 50px">
                                      <h4 class="alert-heading">Logged in!</h4>
                                        You are now logged in as <strong>' .  $_SESSION["username"] . '</strong>
                                                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>
                                </div>
                                ';

        }
    }

    ?>


    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark static-top bg-dark" style="z-index: 9; border-radius: 0 0 60px 60px; opacity: 0.7">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="assets/images/login_book_dm.png" alt="" width="8%" height="8%"> Get It Done!</a>
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

                        echo '
                            <li class="nav-item">
                                <a class="nav-link" href="#">+ Add a todo</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">My Todo\'s</a>
                            </li>
                                <li class="nav-item">
                                <a class="nav-link" href="includes/logout.php">Logout</a>
                            </li>
                        
                        ';

                    }else {

                        echo '
                        
                            <li class="nav-item" >
                                <a class="nav-link" href = "login/login.php" > Log in </a >
                            </li >
                        
                        ';

                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>





</body>
</html>