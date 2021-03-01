<?php

session_start();
session_regenerate_id();

include_once('../includes/utilities.php');

if(isset($_SESSION['username'])){

    if(isUserAdmin($_SESSION['userID']) != 1){

        header('location: ../index.php');
        exit;

    }

}else{

    header('location: ../index.php');
    exit;

}

?>


<!doctype html>
<html lang="en">
<head>

    <title>Edit Users</title>

    <meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <script src="https://kit.fontawesome.com/0914a3a2ee.js" crossorigin="anonymous"></script>
    <script src="../assets/js/sweetalert2.all.min.js"></script>

    <link rel="icon" type="image/png" href="../assets/images/login_book_dm.png">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>
    <link href="../assets/css/tableSearchbar.css" rel="stylesheet"/>

</head>
<body>

<?php

// Error handler

if(isset($_GET['error'])){

    if($_GET['error'] == 'usernameChangeSuccess'){

        echo "<script>
                Swal.fire({
                    title: 'Erfolgreich',
                    html: '<p><b>Sie haben den Benutzernamen des Benutzers erfolgreich geändert.</b></p>',
                    icon: 'success',
                    backdrop: 'rgb(255,255,255)',
                    timer: 3000,
                    showConfirmButton: false
                    })
                </script>";

    }

    if($_GET['error'] == 'passwordChangeSuccess'){

        echo "<script>
                Swal.fire({
                    title: 'Erfolgreich',
                    html: '<p><b>Sie haben den Passwort des Benutzers erfolgreich geändert.</b></p>',
                    icon: 'success',
                    backdrop: 'rgb(255,255,255)',
                    timer: 3000,
                    showConfirmButton: false
                    })
                </script>";

    }

    if($_GET['error'] == 'userDeleteSuccess'){

        echo "<script>
                Swal.fire({
                    title: 'Erfolgreich',
                    html: '<p><b>Sie haben den Benutzer erfolgreich gelöscht.</b></p>',
                    icon: 'success',
                    backdrop: 'rgb(255,255,255)',
                    timer: 3000,
                    showConfirmButton: false
                    })
                </script>";

    }



}

?>

<div class="wrapper">
    <div class="sidebar" data-color="blue" data-image="../assets/images/sideBarBG.jpg">

    <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">
                    <img src="../assets/images/login_book_dm.png" alt="" width="30"> &nbsp; Do it Now!
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="adminPage.php">
                        <i class="fas fa-users"></i>
                        <p>Kategorien der Benutzer verwalten</p>
                    </a>
                </li>
                <li class="active">
                    <a href="#">
                        <i class="fas fa-edit"></i>
                        <p>Benutzerdaten Verwalten</p>
                    </a>
                </li>
                <li>
                    <a href="../session/createUser.php">
                        <i class="fas fa-user-plus"></i>
                        <p>Benutzer hinzufügen</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
		<nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Benutzer Editieren</a>
                </div>
                <div class="collapse navbar-collapse">

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a>
                                <span id="day"></span>
                                <span> / </span>
                                <span id="month"></span>
                                <span> / </span>
                                <span id="year"></span>
                                <span>  </span>
                            </a>
                        </li>
                        <li>
                            <a>
                                <span id="hr">00</span>
                                <span> : </span>
                                <span id="min">00</span>
                                <span> : </span>
                                <span id="sec">00</span>
                            </a>
                        </li>
                        <li>
                            <a>
                                <p class="badge badge-primary" style="background-color: cornflowerblue">Admin: &nbsp; <?=$_SESSION['username']?> </p>
                            </a>
                        </li>
                        <li>
                            <a href="../session/logout.php">
                                <p>Log out</p>
                            </a>
                        </li>
						<li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="content">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Benutzerliste</h4>
                            <p class="category">Hier können Sie Benutzernamen und Passwörter der Benutzer editieren.</p>
                            <p class="category">Sie können bestimmte Benutzer suchen oder durch das Klicken auf die Titel der Spalten die Nutzer so sortieren.</p>

                        </div>
                        <div class="content table-responsive table-full-width">
                            <table id="userTable" class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Benutzername</th>
                                    <th>Benutzername</th>
                                    <th>Passwort</th>
                                    <th>Löschen</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $result = getUsersToDisplay(); // Goto utilities.php for the description of the function.?>
                                <?php /* Iterate over array for the results. */ while($row = mysqli_fetch_array($result)): ?>

                                    <tr>
                                        <td><b><?= $row['ID'] ?></b></td>

                                        <?php if(isUserAdmin($row['ID']) == false): ?>
                                        <td><?= $row['userName'] ?>  </td>

                                        <td><a href="changeUsername.php?userID=<?=$row['ID']?>"><i class="fas fa-edit" style="color:#285fa5;"></i></a></td>

                                        <?php else: ?>
                                        <td><?= $row['userName'] ?></td>
                                        <td></td>
                                        <?php endif; ?>

                                        <td>
                                            <?php if(isUserAdmin($row['ID']) == false): ?>
                                                <a href="changePassword.php?userID=<?= $row['ID'] ?>"><i class="fas fa-edit" style="color:#285fa5;"></i></a>
                                            <?php elseif(isUserAdmin($row['ID']) == true): ?>

                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if(isUserAdmin($row['ID']) == false): ?>
                                                <!-- Deletion Confirmation  -->
                                                <a onclick="

                                                    Swal.fire({
                                                    title: 'Sind Sie sicher?',
                                                    icon: 'warning',
                                                    backdrop: 'rgb(255,255,255)',
                                                    target: 'body',
                                                    html: '<b>Nachdem Sie diesen Benutzer löschen werden alle seine todos gelöscht.</b>',
                                                    showCancelButton: true,
                                                    focusConfirm: false,
                                                    confirmButtonText: 'Löschen',
                                                    cancelButtonText: 'Nicht löschen',
                                                    confirmButtonColor: '#007938',
                                                    cancelButtonColor: '#ff0059'
                                                    }).then((result) => {

                                                    if (result.isConfirmed) {

                                                        window.location.replace('removeUser.php?userID=<?= $row['ID'] ?>');

                                                    }

                                                    });
                                                    "><i class="fas fa-trash mr-2" style="color:#285fa5;"></i></a>
                                            <?php elseif(isUserAdmin($row['ID']) == true): ?>
                                                <h5><span class="badge badge-warning" style="background-color: cornflowerblue"> Admin</span></h5>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endwhile;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../assets/js/jquery.3.2.1.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
<script src="../assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>
<script src="../assets/js/dataTableScriptUsers.js"></script>
<script src="../includes/clock.js"></script>

</body>
</html>
