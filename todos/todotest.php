<?php

session_start();
session_regenerate_id();

include_once("../includes/utilities.php");

if(isset($_SESSION["username"])){

    if(isUserAdmin($_SESSION["userID"]) != 0){

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

    <!--  Light Bootstrap Table core CSS    -->
    <link href="../bootstrapAssets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>
    <link href="../session/assets/css/test.css" rel="stylesheet"/>


    <script src="../session/assets/js/sweetalert2.all.min.js"></script>

    <!--     Fonts and icons     -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
</head>
<body>

<!-- TODO ADD ERROR HANDLERS -->

<?php

    /* Error handler */

    if (isset($_GET["error"])) {

        if ($_GET["error"] == "noPermission") {

            echo "<script>
                Swal.fire({
                    title: 'Keine Rechte!',
                    html: '<p><b>Sie haben keine Rechte um diesen TODO zu Archivieren / Löschen.</b></p>',
                    icon: 'error',
                    backdrop: 'rgb(255,255,255)',
                    timer: 3000,
                    showConfirmButton: false
                    })
                </script>";

        }
    }
    ?>

<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="../bootstrapAssets/images/login_background_dm.jpg" >

    <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="../index.php" class="simple-text">
                    <img src="../bootstrapAssets/images/login_book_dm.png" alt="" width="30px"> &nbsp Do it Now!
                </a>
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="../admin_area/table.php">
                        <i class="fas fa-users"></i>
                        <p>Benutzer und Kategorien</p>
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
                    <a class="navbar-brand" href="#">Todo's List</a>
                </div>
                <div class="collapse navbar-collapse">

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a>
                                <p class="badge badge-primary" style="background-color: green">User: &nbsp <?=$_SESSION["username"]?> </p>
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
                                <h4 class="title">Todo's</h4>
                                <p class="category">Hier können Sie alle Todo's sehen, die zur Ihnen hinzugefügten Kategorien gehören.</p>
                                <p class="category">Sie können den Titel oder Inhalt Ihres Todo's suchen und Sie werden es finden.</p>
                                <p class="category">Sie werden den Titel oder Text nicht sehen, macht alles etwas schöner :)</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="userTable" class="table table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <th>Von</th>
                                        <th>Status</th>
                                        <th>Text</th>
                                        <th>Titel</th>
                                        <th>Priorität</th>
                                        <th>Erstellt am</th>
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

                                    $result = getTodosToDisplay($_SESSION['userID']);


                                    while($row = mysqli_fetch_array($result)):?>

                                        <?php

                                        $creationDate = new DateTime($row["creationDate"]);
                                        $fromUser = getUserByID($row['fromUser'])['userName'];
                                        $daysUntilExpiration = daysTillExpiry($row['expiryDate']);
                                        $priority = $row['priority'];

                                        ?>

                                        <tr>
                                            <td><?=$fromUser?></td>
                                            <td>
                                                <?php if(strpos($daysUntilExpiration, "-") !== false): ?>
                                                <p style="color: red">
                                                    <?php if($daysUntilExpiration==-1):?>
                                                    <?= 'Seit ' . str_replace("-", "", $daysUntilExpiration) . ' Tag fällig.'?>
                                                    <?php elseif($daysUntilExpiration<-1):?>
                                                    <?= 'Seit ' . str_replace("-", "", $daysUntilExpiration) . ' Tagen fällig.'?>
                                                </p>
                                                <?php endif; ?>

                                                <?php elseif(strpos($daysUntilExpiration, "-") === false): ?>
                                                <?php if($daysUntilExpiration==1): ?>
                                                    <p style="color: green"><?='Noch ' . $daysUntilExpiration . ' Tag übrig.'?></p>
                                                <?php elseif($daysUntilExpiration==0): ?>
                                                    <p style="color: green">Heute fällig</p>
                                                <?php elseif($daysUntilExpiration>0): ?>
                                                    <p style="color: green"><?='Noch ' . $daysUntilExpiration . ' Tagen übrig.'?></p>

                                                <?php endif;?>
                                                <?php endif;?>

                                            </td>

                                            <td><?=$row['text']?></td>
                                            <td><?=$row['title']?></td>

                                            <?php if($priority == 1): ?>
                                                <td><p class="badge badge-primary" style="background-color: green;"><?='Unwichtig ('. $priority . ')'?></p></td>
                                            <?php elseif($priority == 2): ?>
                                            <td><p class="badge badge-primary" style="background-color: lightgreen; color: black"><?='Nicht sehr Wichtig ('. $priority . ')'?></p></td>
                                            <?php elseif($priority == 3): ?>
                                                <td><p class="badge badge-primary" style="background-color: yellow; color: black"><?='Etwas wichtig ('. $priority . ')'?></p></td>
                                            <?php elseif($priority == 4): ?>
                                                <td><p class="badge badge-primary" style="background-color: orange; color: black"><?='Wichtig ('. $priority . ')'?></p></td>
                                            <?php elseif($priority == 5): ?>
                                                <td><p class="badge badge-primary" style="background-color: red; color: white"><?='Sehr wichtig ('. $priority . ')'?></p></td>
                                            <?php else: ?>
                                            <td><p><?=$priority?></p></td>
                                            <?php endif; ?>
                                            <td><?= $creationDate->format('d/m/y') ?></td>

                                            <td>
                                                    <?php if($_SESSION['userID'] == $row['fromUser']): ?>
                                                    <a href="editTodo.php?todoID=<?=$row["ID"]?>"><i class="fas fa-edit mr-2"></i></a>
                                                    <a onclick="

                                                        Swal.fire({
                                                            title: 'Sind Sie sicher?',
                                                            icon: 'warning',
                                                            backdrop: 'rgb(255,255,255)',
                                                            target: 'body',
                                                            html: '<b>Nachdem Sie ihr Todo archiviert haben, können Sie ihn nicht mehr sehen.</b>',
                                                            showCancelButton: true,
                                                            focusConfirm: false,
                                                            confirmButtonText: 'Archivieren',
                                                            cancelButtonText: 'Nicht archivieren',
                                                            confirmButtonColor: '#007938',
                                                            cancelButtonColor: '#ff0059'
                                                        }).then((result) => {

                                                            if (result.isConfirmed) {

                                                            window.location.replace('archiveTodo.php?todoID=<?= $row["ID"] ?>');

                                                            }

                                                        });

                                                    "><i class="fas fa-archive mr-2"></i></a>
                                                    <a onclick="

                                                        Swal.fire({
                                                        title: 'Sind Sie sicher?',
                                                        icon: 'warning',
                                                        backdrop: 'rgb(255,255,255)',
                                                        target: 'body',
                                                        html: '<b>Nachdem Sie ihr Todo gelöscht haben können Sie ihn nicht mehr sehen.</b>',
                                                        showCancelButton: true,
                                                        focusConfirm: false,
                                                        confirmButtonText: 'Löschen',
                                                        cancelButtonText: 'Nicht löschen',
                                                        confirmButtonColor: '#007938',
                                                        cancelButtonColor: '#ff0059'
                                                        }).then((result) => {

                                                        if (result.isConfirmed) {

                                                        window.location.replace('removeTodo.php?todoID=<?= $row["ID"] ?>');

                                                        }

                                                        });

                                                    "><i class="fas fa-trash-alt"></i></a>
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
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="../bootstrapAssets/js/bootstrap-notify.js"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="../bootstrapAssets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>
    <script src="../bootstrapAssets/js/dataTableScriptTodos.js"></script>


</html>
