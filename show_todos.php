<?php
session_start();
session_regenerate_id();

require_once("includes/utilities.php");

if(!isset($_SESSION["userID"]) or isUserAdmin($_SESSION["userID"])){

    header("location:index.php");

}

?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Show todos</title>
    <script src="https://kit.fontawesome.com/0914a3a2ee.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">

</head>

<body>

<nav class="navbar navbar-dark navbar-expand-md navigation-clean-button">
    <div class="container"><a class="navbar-brand" href="index.php"><img class="navbar-image" src="assets/images/login_book_dm.png" alt="">Do It Now!</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav mr-auto">
            </ul><span class="navbar-text actions"><a class="btn btn-light action-button" role="button" href="session/logout.php">Log out</a></span>
        </div>
    </div>
</nav>

<div class="container mt-5">

    <table class="table table-striped table-dark">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">First</th>
        <th scope="col">Last</th>
        <th scope="col">Handle</th>
        <th scope="col">DM</th>
        <th scope="col">DV</th>
        <th scope="col">Actions</th>

    </tr>
    </thead>
    <tbody>
    <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
        <td>@mdo</td>
        <td style="word-break: break-all">@mdqwuegqwiyeggqwuegyqweguyqwgegquweqwguyegyuytquwyetuqwtetqwueyqweutyqweuqywetyqwteuqweqweo</td>

        <td>

            <a href="#"><i class="fas fa-edit mr-2"></i></a>
            <a href="#"><i class="fas fa-archive mr-2"></i></a>
            <a href="#"><i class="fas fa-trash-alt"></i></a>

        </td>
    </tr>
    <tr>
        <th scope="row">2</th>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
        <td>@mdo</td>
        <td>@mdqweqweqweo</td>

        <td>

            <a href="#"><i class="fas fa-edit mr-2"></i></a>
            <a href="#"><i class="fas fa-archive mr-2"></i></a>
            <a href="#"><i class="fas fa-trash-alt"></i></a>

        </td>
    </tr>
    <tr>
        <th scope="row">3</th>
        <td>Larry</td>
        <td>the Bird</td>
        <td>@twitter</td>
        <td>@mdo</td>
        <td>@mdqweqweqweo</td>

        <td>

            <a href="#"><i class="fas fa-edit mr-2"></i></a>
            <a href="#"><i class="fas fa-archive mr-2"></i></a>
            <a href="#"><i class="fas fa-trash-alt"></i></a>

        </td>
    </tr>
    </tbody>
</table>

</div>

</body>

</html>

