<?php

session_start();
session_regenerate_id();

require_once('../includes/utilities.php');

if(!isset($_SESSION['userID'])){

    header('location: ../session/login.php');
    exit;
}

if(!isset($_GET['userID'])){

    header("location: ../index.php");
    exit;

}

if(isset($_SESSION["userID"]) & isUserAdmin($_SESSION['userID']) != 1){

    header("location: ../index.php");
    exit;

}

if(isUserAdmin($_GET['userID']) == 1) header("location: ../index.php");


?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Kategorie Entfernen</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="../bootstrapAssets/images/login_book_dm.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../session/assets/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../session/assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../session/assets/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../session/assets/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../session/assets/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../session/assets/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../session/assets/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../session/assets/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../session/assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="../session/assets/css/main.css">

    <script src="../session/assets/js/sweetalert2.all.min.js"></script>

    <!--===============================================================================================-->
</head>
<body>

    <?php

    /* Error handler */

    if (isset($_GET["error"])) {


        if ($_GET["error"] == "emptyInput") {

            echo"<script>
                Swal.fire({
                
                    title: 'Fehler',
                    icon: 'error',
                    html: 'Bitte füllen Sie alle Felder aus.'+'<br><br>',
                    backdrop: 'rgb(255,255,255)',
                    timer: 2500,
                    showConfirmButton: false
                
                });
                </script>";

        }

        if ($_GET["error"] == "logout") {

            echo"<script>
                Swal.fire({
                
                    title: 'Auf wiedersehen',
                    icon: 'success',
                    html: 'Sie haben sich erfolgreich ausgeloggt!'+'<br><br>',
                    backdrop: 'rgb(255,255,255)',
                    timer: 2500,
                    showConfirmButton: false
                
                });
                </script>";

        }

        if ($_GET["error"] == "wrongPass" || $_GET["error"] == "userNotExists") {

            echo"<script>
                Swal.fire({
                
                    title: 'Fehler',
                    icon: 'error',
                    html: 'Password falsch oder Benutzer nicht existent.'+'<br><br>',
                    backdrop: 'rgb(255,255,255)',
                    timer: 2500,
                    showConfirmButton: false
                
                });
                </script>";

        }

        if ($_GET["error"] == "notLogged") {

            echo"<script>
                Swal.fire({
                
                    title: 'Fehler',
                    icon: 'error',
                    html: 'Sie sind nicht eingeloggt!'+'<br><br>',
                    backdrop: 'rgb(255,255,255)',
                    timer: 2500,
                    showConfirmButton: false
                
                });
                </script>";

        }
    }

    ?>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('../session/assets/images/bg-01.jpg');">
			<div class="wrap-login100">
				<form action="../includes/addCategory.php?userID=<?=$_GET['userID']?>" method="post" class="login100-form validate-form" autocomplete="off">
					<span class="login100-form-logo">
						<img src="../bootstrapAssets/images/login_book_lm.png" alt="" width="100px"/>
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Kategorie Hinzufügen
					</span>

					<div class="wrap-input100">
						<input class="input100" disabled="disabled" type="text" value="<?=getUserByID($_GET['userID'])['userName']?>" name="user" placeholder="Username">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>
					<div class="wrap-input100 validate-input" style="outline: none" data-validate="Select Category">
                        <input class="input100" type="text" name="categoryName" placeholder="Name of the Category to add">
                        <span class="focus-input100" data-placeholder="&#xf116;"></span>
                    </div>

					<div class="container-login100-form-btn">
						<button type="submit" name="submit" class="login100-form-btn">
							Hinzufügen
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
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="../session/assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../session/assets/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="../session/assets/vendor/bootstrap/js/popper.js"></script>
	<script src="../session/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../session/assets/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="../session/assets/vendor/daterangepicker/moment.min.js"></script>
	<script src="../session/assets/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="../session/assets/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
    <script src="../session/assets/js/main.js"></script>

</body>
</html>