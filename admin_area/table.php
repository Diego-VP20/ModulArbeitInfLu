<?php

session_start();
session_regenerate_id();

include_once("../includes/utilities.php");

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


<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="../bootstrapAssets/images/login_book_dm.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Manage User</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <script src="https://kit.fontawesome.com/0914a3a2ee.js" crossorigin="anonymous"></script>

    <!-- Bootstrap core CSS     -->
    <link href="../bootstrapAssets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="../bootstrapAssets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="../bootstrapAssets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>
    <link href="../session/assets/css/test.css" rel="stylesheet"/>

  


    <!--     Fonts and icons     -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="../bootstrapAssets/css/pe-icon-7-stroke.css" rel="stylesheet" />
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="azure" data-image="assets/img/sidebar-5.jpg">

    <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="../index.php" class="simple-text">
                    Do it Now!
                </a>
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="table.php">
                        <i class="fas fa-users"></i>
                        <p>Benutzer und Kategorien</p>
                    </a>
                </li>
                <li>
                    <a href="../session/createUser.php">
                        <i class="fas fa-user-plus"></i>
                        <p>Benutzer hinzufügen</p>
                    </a>
                </li>
                <li>
                    <a href="../todos/todotest.php">
                        <i class="fas fa-user-plus"></i>
                        <p>Todo's</p>
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
                    <a class="navbar-brand" href="#">Table List</a>
                </div>
                <div class="collapse navbar-collapse">

                    <ul class="nav navbar-nav navbar-right">
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
                                <h4 class="title">Benutzer</h4>
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
                                        <th>Aktionen</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php

                                    if (isset($_GET['pageNr'])) {
                                        $pageNr = $_GET['pageNr'];
                                    } else {
                                        $pageNr = 1;
                                    }

                                    $result = getUsersToDisplay();

                                    while($row = mysqli_fetch_array($result)):?>

                                        <tr>
                                            <td><b><?=$row["ID"]?></b></td>
                                            <td><?=$row["userName"]?></td>
                                            <td>
                                                <?php if(isUserAdmin($row["ID"]) == 0): ?>
                                                    <a href="addCategoryForm.php?userID=<?=$row['ID']?>"><i class="fas fa-plus-square mr-2"></i></a>
                                                    <?php if(sizeof(getCategoriesFromUser($row['ID']))>0): ?>
                                                        <a href="removeCategoryForm.php?userID=<?=$row['ID']?>"><i class="fas fa-minus-square"></i></a>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                            </td>

                                            <td>
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


</body>

    <!--   Core JS Files   -->
    <script src="../bootstrapAssets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="../bootstrapAssets/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- MDBootstrap Datatables  -->
    <script type="text/javascript" src="js/addons/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="../bootstrapAssets/js/bootstrap-notify.js"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="../bootstrapAssets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>
    <script src="../bootstrapAssets/js/dataTableScriptUsers.js"></script>



</html>
