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

    header("location: ../session/login.php?error=notLogged");
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
        <div class="container"><a class="navbar-brand" href="#"><img class="navbar-image" src="../bootstrapAssets/images/login_book_dm.png" alt="">Do It Now!</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav mr-auto">
                </ul><span class="navbar-text actions"><a class="btn btn-light action-button" role="button" href="../session/logout.php">Log out</a></span>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="grid-container">
            <div class="Table">
                <table class="table table-striped table-dark text-center rounded" >
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">Categories</th>
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
                            <td class="text-center">
                            <?php if(isUserAdmin($row["ID"]) == 0): ?>
                            <a href="addCategoryForm.php?userID=<?=$row['ID']?>"><i class="fas fa-plus-square mr-2"></i></a>
                            <?php if(sizeof(getCategoriesFromUser($row['ID']))>0): ?>
                                <a href="removeCategoryForm.php?userID=<?=$row['ID']?>"><i class="fas fa-minus-square"></i></a>
                            <?php endif; ?>
                            <?php endif; ?>

                            </td>

                            <td class="text-center">
                                <?php if(isUserAdmin($row['ID']) == false): ?>
                                    <a href="editUser.php?userID=<?=$row["ID"]?>"><i class="fas fa-edit mr-2"></i></a>
                                    <a href="removeUser.php?userID=<?=$row["ID"]?>"><i class="fas fa-trash-alt"></i></a>
                                <?php elseif(isUserAdmin($row['ID']) == true): ?>
                                    <h5><span class="badge badge-warning"> Admin</span></h5>

                                <?php endif; ?>

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