<?php
session_start();
session_regenerate_id();

require_once("../includes/utilities.php");

if(isset($_SESSION["username"])){

    if(isUserAdmin($_SESSION["userID"]) != 1){

        header("location: ../index.php");
        exit;

    }

}else{

    header("location: ../index.php");
    exit;

}

if(!isset($_GET["userID"])){

    header("location: showUsers.php");
    exit;

}



?>

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

<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Icon -->
        <div class="fadeIn first">
            <img src="../bootstrapAssets/images/login_book_dm.png" id="icon" alt="User Icon" style="width: 100px; height: auto; margin: 20px 0 15px 0"/>
        </div>

        <form action="../includes/addCategory.php?userID=<?=$_GET['userID']?>" method="post" autocomplete="off">
            <label for="login"></label><input  type="text" disabled="disabled" value="<?=getUserByID($_GET['userID'])['userName']?>" id="login" class="fadeIn second" placeholder="Username">
            <label for="categoryName"></label><input type="text" id="categoryName" class="fadeIn third" name="categoryName" placeholder="Name of the Category to add">
            <input type="submit" name="submit" class="fadeIn fourth mt-4" value="Add Category">
        </form>


        <div id="formFooter">
            <a class="underlineHover" href="showUsers.php">Go back to Users</a>
        </div>

    </div>
</div>
</body>
</html>
