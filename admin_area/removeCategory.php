<?php

session_start();
session_regenerate_id();

require_once('../includes/utilities.php');

if(!isset($_SESSION['userID'])){

    header('location: ../session/login.php');

}

if(!isset($_GET['userID'])){

    header('location: ../index.php');
    exit;

}

if(isset($_SESSION['userID'])){
    if(isUserAdmin($_SESSION['userID']) != 1) {

        header('location: ../index.php');
        exit;
    }
}else{

    header('location: ../session/login.php');
    exit;

}

if(isUserAdmin($_GET['userID']) == 1) header('location: ../index.php');


?>


<!DOCTYPE html>
<html lang="en">
<head>

	<title>Kategorie Entfernen</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="../assets/js/sweetalert2.all.min.js"></script>

    <link rel="icon" type="image/png" href="../assets/images/login_book_dm.png"/>
    <link rel="stylesheet" type="text/css" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/categoryPages.css">

</head>
<body>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('../assets/images/bg-01.jpg');">
			<div class="wrap-login100">
				<form action="../includes/removeCategory.php?userID=<?= $_GET['userID'] ?>" method="post" class="login100-form validate-form" autocomplete="off">
					<span class="login100-form-logo">
						<img src="../assets/images/login_book_lm.png" alt="" width="100"/>
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Kategorie Entfernen
					</span>

					<div class="wrap-input100">
						<input class="input100" disabled="disabled" type="text" value="<?= getUserByID($_GET['userID'])['userName'] ?>" name="user" placeholder="Username">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>
					<div id="selectContainer" class="wrap-input100 validate-input" style="outline: none" data-validate="Select Category">
                        <select class="input100" style="" id="categoryName" name="categoryName">

                            <?php foreach (getCategoriesFromUser($_GET['userID']) as $category):?>

                                <option value="<?=$category[1]?>"><?=$category[0]?></option>
                            <?php endforeach; ?>

                        </select>
                        <span class="focus-input100" data-placeholder="&#xf116;"></span>
                    </div>

					<div class="container-login100-form-btn">
						<button type="submit" name="submit" class="login100-form-btn">
							Entfernen
						</button>
					</div>

                    <div class="text-center p-t-90">
                        <a href="../index.php" class="txt1">
                            Back to the menu
                        </a>
                    </div>

				</form>
			</div>
		</div>
	</div>

    <script src="../assets/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/popper.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/vendor/select2/select2.min.js"></script>
    <script src="../assets/js/main.js"></script>

</body>
</html>