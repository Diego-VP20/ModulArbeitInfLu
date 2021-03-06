<?php

session_start();
session_regenerate_id();

if(isset($_SESSION['userID'])){

    header('location: ../index.php');
    exit;

}

?>


<!DOCTYPE html>
<html lang="en">
<head>

	<title>Login</title>
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

</head>
<body>

    <?php

    /* Error handler */

    if (isset($_GET['error'])) {


        if ($_GET['error'] == 'emptyInput') {

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

        if ($_GET['error'] == 'logout') {

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

        if ($_GET['error'] == 'wrongPass' || $_GET['error'] == 'userNotExists') {

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

        if ($_GET['error'] == 'notLogged') {

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
		<div class="container-login100" style="background-image: url('../assets/images/bg-01.jpg');">
			<div class="wrap-login100">
				<form action="../includes/validate_login.php" method="post" class="login100-form validate-form" autocomplete="off">
					<span class="login100-form-logo">
						<img src="../assets/images/login_book_lm.png" alt="" width="100px"/>
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
						<a onclick="

                            Swal.fire({

                                title: 'Achtung!',
                                icon: 'warning',
                                html: 'Leider kann nur der Administrator neue Benutzer hinzufügen.<br> Bitten Sie Ihn um einen Benutzernamen und Passwort.'+'<br><br>',
                                backdrop: 'rgb(255,255,255)',
                                showConfirmButton: true

                            });

                            " href="#" class="txt1">
							Don't have an account?
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>

</body>
</html>