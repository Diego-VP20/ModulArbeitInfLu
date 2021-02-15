<?php

session_start();
session_regenerate_id();

if(isset($_SESSION["userID"])){

    header("location: ../index.php");
    exit();

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="assets/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="assets/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="assets/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <script src="assets/js/sweetalert2.all.min.js"></script>

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
		<div class="container-login100" style="background-image: url('assets/images/bg-01.jpg');">
			<div class="wrap-login100">
				<form action="../includes/validate_login.php" method="post" class="login100-form validate-form" autocomplete="off">
					<span class="login100-form-logo">
						<img src="../bootstrapAssets/images/login_book_lm.png" alt="" width="100px"/>
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Log in
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="user" placeholder="Username">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div>

					<div class="container-login100-form-btn">
						<button type="submit" name="submit" class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-90">
						<a class="txt1" href="createUser.php">
							Don't have an account?
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/vendor/bootstrap/js/popper.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="assets/vendor/daterangepicker/moment.min.js"></script>
	<script src="assets/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="assets/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
    <script src="assets/js/main.js"></script>

</body>
</html>