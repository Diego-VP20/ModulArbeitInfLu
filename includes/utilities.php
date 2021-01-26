<?php

function emptySignup($user, $pass){

    if (empty($user) || empty($pass)){

        return true;

    }else{

        return false;

    }

}

function invalidUsername($user){

    if (!preg_match("/^[a-zA-Z0-9]*$/", $user)){

        return true;

    }else{

        return false;

    }

}

function passLen($pass){

    if (strlen($pass) < 8){

        return true;

    }else{

        return false;

    }

}


/* This function will be able to return userdata if user already exists */
function checkForUser($conn, $user){

    $sql = "SELECT * FROM users WHERE userName = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){

        header("location: ../session/register.php?error=usernameCheckFailed");
        exit();

    }

    mysqli_stmt_bind_param($stmt, "s", $user);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)){

        mysqli_stmt_close($stmt);
        return $row;

    }else{

        mysqli_stmt_close($stmt);
        return false;

    }


}

function createUser($conn, $user, $pass){

    $sql = "INSERT INTO users(userName, passwordHash) values(?,?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){

        header("location: ../session/register.php?error=createUserFailed");
        exit();

    }

    $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ss", $user, $hashedPass);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../session/register.php?error=success");
    exit();


}



function loginUser($conn, $user, $pass){

    $userArray = checkForUser($conn, $user);

    if($userArray === false){

        header("location: ../session/login.php?error=userNotExists");
        exit();

    }

    $passHashed = $userArray["passwordHash"];
    $checkPass = password_verify($pass, $passHashed);

    if($checkPass === false){

        header("location: ../session/login.php?error=wrongPass");
        exit();

    }else{

        session_start();
        $_SESSION["userID"] = $userArray["ID"];
        $_SESSION["username"] = $userArray["userName"];
        $_SESSION["admin"] = $userArray["admin"];
        header("location: ../index.php");
        exit();
    }

}
