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
    <title>Sign Up!</title>
</head>
<body style="background-image: url('../assets/images/login_background_dm.jpg')">
    <!-- JS from Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <div class="wrapper fadeInDown">
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

    <?php

    if (isset($_GET["error"])){

        if ($_GET["error"] == "emptyFields"){

            echo '<div class="alert alert-danger alert-dismissible fade show fadeInDown" style="position: absolute; left: 31%; top: 0; margin:20px; width: 35%" role="alert">
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

    }

    ?>

</body>
</html>
