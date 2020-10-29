<!DOCTYPE html>
<html lang="en">
<head>
    <!-- CSS from Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/own_style.css">

    <meta charset="UTF-8">
    <title>Home</title>
</head>

<body style="background-image: url('../assets/images/login_background_dm.jpg')">
<!-- JS from Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


<form style="position:relative; top:25%; width: 60%; margin: auto; opacity: 0.9;" action="create_todo.php" method="post">
    <div class="container text-center" style="position:absolute;">
        <div class="card p-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6"> <input name="title" type="text" placeholder="Title" class="form-control" /> </div>
                        <div class="col-md-6"> <input name="priority" type="number" min=1 max=3 placeholder="Priority" class="form-control" /> </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"> <textarea name="content" class="form-control textarea" style="resize: none;" placeholder="TODO:" rows="4"></textarea> </div>
                    </div>
                    <div class="send-button mt-4"> <button class="button" value="submit" name="submit">Create TODO</button> </div>
                    <div class="cancel-button mt-4"><button class="button" value="cancel" name="cancel">Cancel</button></div>
                </div>
            </div>
        </div>
    </div>
</form>


</body>
</html>