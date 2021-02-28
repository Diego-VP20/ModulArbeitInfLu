<?php

session_start();
session_regenerate_id();

include_once('../includes/utilities.php');

if(isset($_SESSION['username'])){

    // User is admin.
    if(isUserAdmin($_SESSION['userID']) != 0){

        header('location: ../index.php');
        exit;

    }

}else{

    header('location: session/login.php');
    exit;

}

?>


<!doctype html>
<html lang="en">
<head>

    <title>Todo erstellen</title>

    <meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <script src="https://kit.fontawesome.com/0914a3a2ee.js" crossorigin="anonymous"></script>
    <script src="../assets/js/the-datepicker.js"></script>
    <script src="../assets/js/sweetalert2.all.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>
    <link rel="icon" type="image/png" href="../assets/images/login_book_dm.png">
    <link href="../assets/css/the-datepicker.css" rel="stylesheet" />
    <link href="../assets/css/addTodoPage.css" rel="stylesheet" />

</head>
<body>

<?php

    /* Error handler */

    if (isset($_GET['error'])) {

        if ($_GET['error'] == 'noPermission') {

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

        if ($_GET['error'] == 'removalSuccessful') {

            echo "<script>
                Swal.fire({
                    title: 'Erfolgreich',
                    html: '<p><b>Sie haben Ihren Todo erfolgreich gelöscht.</b></p>',
                    icon: 'success',
                    backdrop: 'rgb(255,255,255)',
                    timer: 3000,
                    showConfirmButton: false
                    })
                </script>";

        }

        if ($_GET['error'] == 'archiveSuccessful') {

            echo "<script>
                Swal.fire({
                    title: 'Erfolgreich',
                    html: '<p><b>Sie haben Ihren Todo erfolgreich archiviert.</b></p>',
                    icon: 'success',
                    backdrop: 'rgb(255,255,255)',
                    timer: 3000,
                    showConfirmButton: false
                    })
                </script>";

        }

        if ($_GET['error'] == 'noAccessToCat') {

            echo "<script>
                Swal.fire({
                    title: 'Fehler!',
                    html: '<p><b>Sie haben keinen Zugriff auf die von Ihnen gewählte Kategorie.</b></p>',
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
    <div class="sidebar" data-color="purple" data-image="../assets/images/sideBarBG.jpg" >

    <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">
                    <img src="../assets/images/login_book_dm.png" alt="" width="30"> &nbsp; Do it Now!
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="../index.php">
                        <i class="fas fa-users"></i>
                        <p>Todo's</p>
                    </a>
                </li>
                <li>
                    <a href="archiv.php">
                        <i class="fas fa-archive"></i>
                        <p>Archiv</p>
                    </a>
                </li>
                <li class="active">
                    <a href="addTodo.php">
                        <i class="fas fa-plus"></i>
                        <p>Todo hinzufügen</p>
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
                    <a class="navbar-brand" href="#">Todo hinzufügen</a>
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
                                <p class="badge badge-primary" style="background-color: mediumpurple">User: &nbsp; <?= $_SESSION['username'] ?> </p>
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
                        <div class="container">
                            <div class=" text-center mt-5 ">
                                <h1 class="text-white">Todo Erstellen</h1>
                            </div>
                            <div class="container">
                                <form action="../includes/createTodo.php" method="post">
                                    <div class="controls">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="form_name">Titel</label>
                                                    <input id="form_name" type="text" name="titel" class="form-control" placeholder="Titel des Todo's" required="required">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="form_lastname">Priorität (1-5)</label>
                                                    <input id="form_lastname" type="number" min="1" max="5" name="priority" class="form-control" required="required">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="form_need">Kategorie</label>
                                                    <select id="form_need" name="category" class="form-control" required="required">
                                                        <option value="" selected disabled>Wählen Sie eine Kategorie aus.</option>
                                                        <?php // Go to utilities.php to see what the function does. ?>
                                                        <?php foreach (getCategoriesFromUser($_SESSION['userID']) as $category): ?>

                                                            <option value="<?= $category[1] ?>"><?= $category[0] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label for="form_name">Ablaufdatum</label>
                                                    <input id="datePicker" type="text" name="expiryDate" class="form-control" placeholder="Ablaufdatum des Todo's" required="required">
                                                </div>

                                                <script>
                                                    // Script for the Date Picker to work.
                                                    const input = document.getElementById('datePicker');
                                                    const datepicker = new TheDatepicker.Datepicker(input);
                                                    datepicker.options.setInputFormat('y-m-d');
                                                    datepicker.render();

                                                </script>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group"> <label for="form_message">Inhalt</label> <textarea id="form_message" maxlength="255" name="inhalt" class="form-control" placeholder="Inhalt des Todo's" rows="4" required="required" data-error="Please, leave us a message."><?php if(isset($_GET['content'])): ?> <?= $_GET['content'] ?> <?php endif; ?></textarea> </div>
                                            </div>
                                            <div class="col-md-12"> <input type="submit" class="btn btn-primary btn-send pt-2 btn-block " value="Todo erstellen" style="color: #7250b4; border-color:#7250b4 "> </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> <!-- /.8 -->
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
<script src="../assets/js/dataTableScriptTodos.js"></script>
<script src="../includes/clock.js"></script>

</body>
</html>
