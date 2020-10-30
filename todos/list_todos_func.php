<?php

require_once("../includes/dbch.php");

function listTodos(){

    global $conn;

    $sql = "SELECT * FROM todos WHERE belongsTo = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $_SESSION["userID"]);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $row = mysqli_fetch_assoc($result);




    if(!empty($row["title"])){

        return '
            
            <div class="card" style="width: 18rem; top: 25%; left: 38%; opacity: 0.9;max-height: 200px;">
              <img src="../assets/images/login_book_dm.png" class="card-img-top" alt="...">
              <div class="card-body" style="background-color: #3e3e3e">
                <h5 class="card-title" style="color: white;">' . $row["title"] . '</h5>
                <p class="card-text" style="color:white;">' . $row["content"] . '</p>
                <a href="#" class="btn btn-primary">Open TODO</a>
              </div>
            </div>
    
        ';

    }

    else{

        return "";

    }
}