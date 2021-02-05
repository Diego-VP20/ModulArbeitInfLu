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

?>

<!DOCTYPE html>
<html lang="de">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Admin Area</title>
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
                </ul><span class="navbar-text actions"><a class="btn btn-light action-button" role="button" href="../session/logout.php">Log out</a></span>
            </div>
        </div>
    </nav>


    <div class="container mt-5">
        <div class="grid-container">
            <div class="Table">

                <table class="table table-striped table-dark" style="text-align: center;">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">Actions</th>

                    </tr>
                    </thead>
                    <tbody>

                    <?php

                    if (isset($_GET['pageNr'])) {
                        $pageNr = $_GET['pageNr'];
                    } else {
                        $pageNr = 1;
                    }

                    $usersPerSite = 6;
                    $offset = ($pageNr-1) * $usersPerSite;
                    $result = getUsersToDisplay($offset, $usersPerSite);

                    $pagesToDisplay = getPagesForUserDisplay($usersPerSite);

                    while($row = mysqli_fetch_array($result)):?>
                        <tr>
                            <th scope="row"><?=$row["ID"]?></th>
                            <td><?=$row["userName"]?></td>
                            <td style="text-align: center;">

                                <a href="#"><i class="fas fa-edit mr-2"></i></a>
                                <a href="#"><i class="fas fa-archive mr-2"></i></a>
                                <a href="removeUser.php?userID=<?=$row["ID"]?>"><i class="fas fa-trash-alt"></i></a>


                            </td>
                        </tr>
                    <?php endwhile;?>

                    </tbody>
                </table>

            </div>

            <div class="Spacer"></div>


            <div class="Buttons">

                <!-- Using onclick so Hyperlink doesn't show :) -->
                <div class="First"><a onclick="location.href='?pageNr=1'" class="btn">First</a></div>
                <div class="Prev"><a onclick="location.href='<?php if($pageNr <= 1){ echo '#'; } else { echo "?pageNr=".($pageNr - 1); } ?>'" class="btn">Prev</a></div>
                <div class="Next"><a onclick="location.href='<?php if($pageNr >= $pagesToDisplay){ echo '#'; } else { echo "?pageNr=".($pageNr + 1); } ?>'" class="btn">Next</a></div>
                <div class="Last"><a  onclick="location.href='?pageNr=<?php echo $pagesToDisplay; ?>'" class="btn">Last</a></div>
            </div>


        </div>
    </div>
    </body>

</html>