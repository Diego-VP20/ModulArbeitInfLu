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

    <title>Admin Area</title>

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

    if($_GET['error'] == 'categoryAddSuccess'){

        echo "<script>
                Swal.fire({
                    title: 'Erfolgreich',
                    html: '<p><b>Sie haben dem Benutzer die Kategorie erfolgreich hinzugefügt.</b></p>',
                    icon: 'success',
                    backdrop: 'rgb(255,255,255)',
                    timer: 3000,
                    showConfirmButton: false
                    })
                </script>";

    }

    if($_GET['error'] == 'alreadyInCat'){

        echo "<script>
                Swal.fire({
                    title: 'Achtung!',
                    html: '<p><b>Dieser Benutzer war schon in dieser Kategorie drin. Keine Änderungen wurden getätigt.</b></p>',
                    icon: 'warning',
                    backdrop: 'rgb(255,255,255)',
                    timer: 3000,
                    showConfirmButton: false
                    })
                </script>";

    }

     if($_GET['error'] == 'categoryRemoveSuccess'){

         echo "<script>
                Swal.fire({
                    title: 'Erfolgreich',
                    html: '<p><b>Sie haben die Kategorie des Benutzers erfolgreich entfernt.</b></p>',
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
                <li class="active">
                    <a href="adminPage.php">
                        <i class="fas fa-users"></i>
                        <p>Kategorien der Benutzer verwalten</p>
                    </a>
                </li>
                <li>
                    <a href="editUsers.php">
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
                    <a class="navbar-brand" href="#">Kategorien der Benutzer verwalten</a>
                </div>
                <div class="collapse navbar-collapse">

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a>
                                <span id="day"></span>
                                <span id="month"></span>
                                <span id="year"></span>
                                <span>  </span>
                            </a>
                        </li>
                        <li>
                            <a>
                                <span id="hr"></span>
                                <span> : </span>
                                <span id="min"></span>
                                <span> : </span>
                                <span id="sec"></span>
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
                            <p class="category">Hier können Sie Benutzer löschen und denen Kategorien zuweisen.</p>
                            <p class="category">Durch das klicken auf ID, Benutzername usw. können Sie die Einträge so sortieren.</p>
                        </div>
                        <div class="content table-responsive table-full-width">
                            <table id="userTable" class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Benutzername</th>
                                    <th>Kategorien</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php

                                if (isset($_GET['pageNr'])) {
                                    $pageNr = $_GET['pageNr'];
                                } else {
                                    $pageNr = 1;
                                }

                                $result = getUsersToDisplay(); // Go to utilities.php for information about the function.

                                // Array used to put in the values for every todo.
                                while($row = mysqli_fetch_array($result)):?>

                                    <tr>
                                        <td><b><?=$row["ID"]?></b></td>
                                        <td><?=$row["userName"]?></td>
                                        <td>
                                            <?php if(isUserAdmin($row['ID']) == 0): ?>
                                                <a href="addCategory.php?userID=<?=$row['ID']?>"><i class="fas fa-plus-square mr-2" style="color:#285fa5;"></i></a>
                                                <?php if(sizeof(getCategoriesFromUser($row['ID']))>0): ?>
                                                    <a href="removeCategory.php?userID=<?=$row['ID']?>"><i class="fas fa-minus-square" style="color:#285fa5;"></i></a>
                                                <?php endif; ?>
                                            <?php elseif(isUserAdmin($row['ID']) == 1): ?>
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

        <footer class="footer">
            <div class="container-fluid">
                <p class="copyright text-center">
                    &copy; <script>document.write(new Date().getFullYear())</script> Made with Bootstrap and templates.
                </p>
            </div>
        </footer>

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
