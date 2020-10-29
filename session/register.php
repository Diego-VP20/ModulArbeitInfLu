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
    <link rel="stylesheet" href="../css/style.css">

    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body style="background-image: url('../assets/images/login_background_dm.jpg'); ">
<!-- JS from Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>



<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark static-top bg-dark" style="z-index: 1; position:fixed; width:100%;top:0;border-radius: 0 0 60px 60px; opacity: 0.7;">

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
                                <a class="nav-link" href = "login.php" > Log in </a >
                            </li >
                        
                        ';

                }
                ?>
            </ul>
        </div>
    </div>
</nav>

<?php
/* Error handler */

if (isset($_GET["error"])){

    if ($_GET["error"] == "emptyFields"){

        echo '<div class="alert alert-danger alert-dismissible fade show fadeInDown" style="z-index: 10; border-radius: 30px; width: 98%; position: fixed; margin-top: 20px; margin-left: 1%">
                                  <h4 class="alert-heading">Error!</h4>
                                    Some of the fields are empty.
                                        <hr>
                                      <p class="mb-0">Make sure to provide us with an Username and a Password!</p>
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                            </div>
                            
                            ';

    }

    if ($_GET["error"] == "invalidUser"){

        echo '<div class="alert alert-danger alert-dismissible fade show fadeInDown" style="z-index: 10; border-radius: 30px; width: 98%; position: fixed; margin-top: 20px; margin-left: 1%">
                                  <h4 class="alert-heading">Error!</h4>
                                    Invalid Username.
                                        <hr>
                                      <p class="mb-0">Please enter a name with characters from a to Z and 0 to 9!</p>
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                            </div>
                            ';

    }

    if ($_GET["error"] == "usernameTaken"){

        echo '<div class="alert alert-danger alert-dismissible fade show fadeInDown" style="z-index: 10; border-radius: 30px; width: 98%; position: fixed; margin-top: 20px; margin-left: 1%">
                                  <h4 class="alert-heading">Error!</h4>
                                    Username already in use.
                                        <hr>
                                      <p class="mb-0">The username you entered is already taken, try another one!</p>
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                            </div>
                            ';

    }

    if ($_GET["error"] == "passLen"){

        echo '<div class="alert alert-danger alert-dismissible fade show fadeInDown" style="z-index: 10; border-radius: 30px; width: 98%; position: fixed; margin-top: 20px; margin-left: 1%">
                                  <h4 class="alert-heading">Error!</h4>
                                    Password too weak.
                                        <hr>
                                      <p class="mb-0">Please enter a password that is at least 8 characters long!</p>
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                            </div>
                            ';

    }

    if ($_GET["error"] == "none"){

        echo '<div class="alert alert-success alert-dismissible fade show fadeInDown" style="z-index: 10; border-radius: 30px; width: 98%; position: fixed; margin-top: 20px; margin-left: 1%">
                                  <h4 class="alert-heading">Success!</h4>
                                        <hr>
                                      <p class="mb-0">You can now login <a href="login.php" class="alert-link">here</a> !</p>
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                            </div>
                            ';

    }

}

?>

    <div class="wrapper fadeInDown" style="padding-top:100px; z-index:1;">

        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
                <img src="../assets/images/login_book_dm.png" id="icon" alt="User Icon" style="width: 100px; height: auto; margin: 20px 0 15px 0"/>
            </div>

            <!-- Register Form -->
            <form action="../includes/validate_register.php" method="post">
                <label for="login"></label><input type="text" id="login" class="fadeIn second" name="user" placeholder="Username">
                <label for="password"></label><input type="password" id="password" class="fadeIn third" name="pass" placeholder="Password">
                <input type="submit" name="submit" class="fadeIn fourth" value="Sign Up" style="margin-top: 20px">
            </form>

            <!-- Login to existing Account -->
            <div id="formFooter">
                <a class="underlineHover" style="text-decoration: none" href="login.php">Already have an account? Log in!</a>
            </div>

        </div>
    </div>



</body>
</html>
