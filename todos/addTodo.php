<?php

session_start();
session_regenerate_id();

require_once('../includes/utilities.php');

if(isset($_SESSION["userID"]) && isUserAdmin($_SESSION['userID']) == 1){

    header("location: ../index.php");
    exit();

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Todo</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="../bootstrapAssets/images/login_book_dm.png"/>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/addTodo.css" rel="stylesheet">
    <link href="../bootstrapAssets/css/the-datepicker.css" rel="stylesheet" />
    <script src="../bootstrapAssets/js/the-datepicker.js"></script>


</head>
<body>

<?php

/* Error handler */

if (isset($_GET["error"])) {

    if ($_GET["error"] == "missingValues") {

        echo "<script>
                Swal.fire({
                    title: 'Leere Felder!',
                    html: '<p><b>Bitte füllen Sie alle Felder aus!</b></p>',
                    icon: 'warning',
                    backdrop: 'rgb(255,255,255)',
                    timer: 3000,
                    showConfirmButton: false
                    })
                </script>";

    }
}
?>


<div class="container">
    <div class=" text-center mt-5 ">
        <h1 class="text-white">Todo Erstellen</h1>
    </div>
    <div class="row ">
        <div class="col-lg-7 mx-auto">
            <div class="card mt-2 mx-auto p-4 bg-light">
                <div class="card-body bg-light">
                    <div class="container">
                        <form action="../includes/createTodo.php" method="post">
                            <div class="controls">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="form_name">Titel</label>
                                            <input id="form_name" type="text" name="titel" class="form-control" placeholder="Titel des Todo's" required="required"">
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
                                                <?php foreach (getCategoriesFromUser($_SESSION['userID']) as $category):?>

                                                    <option value="<?=$category[1]?>"><?=$category[0]?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="form_name">Ablaufdatum</label>
                                            <input id="datePicker" type="text" name="expiryDate" class="form-control" placeholder="Ablaufdatum des Todo's" required="required"">
                                        </div>

                                        <script>

                                            const input = document.getElementById('datePicker');
                                            const datepicker = new TheDatepicker.Datepicker(input);
                                            datepicker.options.setInputFormat('y-m-d');
                                            datepicker.render();

                                        </script>

                                    </div>
                                    </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group"> <label for="form_message">Inhalt</label> <textarea id="form_message" name="inhalt" class="form-control" placeholder="Inhalt des Todo's" rows="4" required="required" data-error="Please, leave us a message."></textarea> </div>
                                    </div>
                                    <div class="col-md-12"> <input type="submit" class="btn btn-primary btn-send pt-2 btn-block " value="Todo erstellen"> </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- /.8 -->
        </div> <!-- /.row-->
    </div>
</div>



</body>
</html>