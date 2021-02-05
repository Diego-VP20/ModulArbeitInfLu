<?php

require_once("dbch.php");

function emptySignup($user, $pass): bool
{

    if (empty($user) || empty($pass)){

        return true;

    }else{

        return false;

    }

}

function invalidUsername($user): bool
{

    if (!preg_match("/^[a-zA-Z0-9]*$/", $user)){

        return true;

    }else{

        return false;

    }

}

function passLen($pass): bool
{

    if (strlen($pass) < 8){

        return true;

    }else{

        return false;

    }

}


/* This function will be able to return userdata if user already exists */
function checkForUser($user){

    global $conn;

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

function createUser($user, $pass){

    global $conn;

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



function loginUser($user, $pass){

    $userArray = checkForUser($user);

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
        // I won't put that in here so if a user is turned into an admin no relog is needed.
        //$_SESSION["admin"] = $userArray["admin"];
        header("location: ../index.php");
        exit();
    }

}

function isUserAdmin($userID): ?bool
{

    global $conn;

    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, 'SELECT admin FROM users WHERE ID=?')) {

        /* bind parameters for markers */
        mysqli_stmt_bind_param($stmt, "i", $userID);

        /* execute query */
        mysqli_stmt_execute($stmt);

        /* bind result variables */
        mysqli_stmt_bind_result($stmt, $isAdmin);

        /* fetch value */
        mysqli_stmt_fetch($stmt);

        /* close statement */
        mysqli_stmt_close($stmt);

        if($isAdmin == 0){

            return false;

        }elseif($isAdmin == 1){

            return true;

        }else{

            // If check is somehow compromised or it can't find proper value
            // then it will always return false.
            return false;

        }
    }
    return null;

}

function getUsersToDisplay($offset, $nrOfPages){

    global $conn;

    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, 'SELECT ID, userName FROM users LIMIT ?,?')) {

        /* bind parameters for markers */
        mysqli_stmt_bind_param($stmt, "ii", $offset, $nrOfPages);

        /* execute query */
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        /* close statement */
        mysqli_stmt_close($stmt);

        return $result;

    }
}

function getPagesForUserDisplay($usersPerSite){

    global $conn;

    $total_pages_sql = "SELECT COUNT(*) FROM users";
    $result = mysqli_query($conn,$total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $usersPerSite);

    return $total_pages;

}

function deleteUser($userID){

    global $conn;

    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, 'DELETE FROM users WHERE ID = ?')) {

        /* bind parameters for markers */
        mysqli_stmt_bind_param($stmt, "i", $userID);

        /* execute query */
        mysqli_stmt_execute($stmt);

        /* close statement */
        mysqli_stmt_close($stmt);


        // On successful deletion
        return true;

    }

    // On unsuccessful deletion
    return false;

}