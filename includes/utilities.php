<?php

use JetBrains\PhpStorm\NoReturn;
use JetBrains\PhpStorm\Pure;

require_once('dbch.php');

// Bei Funktionen deren Namen alles aussagen werde ich nichts kommentieren.

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

    if (!preg_match('/^[a-zA-Z0-9]*$/', $user)){

        return true;

    }else{

        return false;

    }

}

// Checks if password length is enough
#[Pure] function passLen($pass): bool
{

    if (strlen($pass) < 8 and strlen($pass)<=255){

        return true;

    }else{

        return false;

    }

}


/* This function will be able to return userdata if user already exists */
function checkForUser($user): array|bool|null
{

    global $conn;

    $stmt = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($stmt,'SELECT * FROM users WHERE userName = ?;');
    mysqli_stmt_bind_param($stmt, 's', $user);
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

// Given an user ID it returns the user from the database as an associative array.
function getUserByID($userID): array|bool|null
{

    global $conn;

    $stmt = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($stmt, 'SELECT * FROM users WHERE ID = ?;');
    mysqli_stmt_bind_param($stmt, 'i', $userID);
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

#[NoReturn] function createUser($user, $pass){

    global $conn;

    $stmt = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($stmt, 'INSERT INTO users(userName, passwordHash) values(?,?);');

    $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, 'ss', $user, $hashedPass);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('location: ../session/createUser.php?error=success');
    exit;


}



function loginUser($user, $pass){

    $userArray = checkForUser($user);

    if($userArray === false){

        header('location: ../session/login.php?error=userNotExists');
        exit;

    }

    $passHashed = $userArray['passwordHash'];
    $checkPass = password_verify($pass, $passHashed);

    if($checkPass === false){

        header('location: ../session/login.php?error=wrongPass');
        exit;

    }else{

        session_start();

        // I set up important things into the $_SESSION Array.

        $_SESSION['userID'] = $userArray['ID'];
        $_SESSION['username'] = $userArray['userName'];

        if(isUserAdmin($_SESSION['userID'])){

            header('location: ../admin_area/adminPage.php');

        }else {

            header('location: ../index.php');
            exit;

        }
    }

}

// If the user is an admin return true, else false.
function isUserAdmin($userID): ?bool
{

    global $conn;

    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, 'SELECT admin FROM users WHERE ID=?')) {

        /* bind parameters for markers */
        mysqli_stmt_bind_param($stmt, 'i', $userID);

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

        }
    }
    // If check is somehow compromised or it can't find proper value
    // then it will always return false.
    return false;

}

// Get's the data for the Admin table to display all users.
function getUsersToDisplay(): bool|mysqli_result|null
{

    global $conn;

    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, 'SELECT ID, userName FROM users')) {


        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        mysqli_stmt_close($stmt);

        return $result;

    }

    return null;
}

// Get's the date for the normal users to view all the Todo's
function getTodosToDisplay($userID): bool|mysqli_result
{

    global $conn;

    $stmt = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($stmt, 'SELECT todo.* FROM todo
                                        WHERE todo.isArchived = 0 AND todo.categoryID IN (
                                            SELECT category.ID from users
                                            INNER JOIN users_category ON users.ID = users_category.userID
                                            INNER JOIN category on users_category.categoryID = category.ID
                                            WHERE users.ID = ?)
                                        ORDER BY todo.priority DESC, todo.creationDate ASC');


    mysqli_stmt_bind_param($stmt, 'i', $userID);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    mysqli_stmt_close($stmt);

    return $result;

}

// Get's all the archived todo's of a user.
function getArchivedTodos($userID): bool|mysqli_result
{

    global $conn;

    $stmt = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($stmt, 'SELECT * FROM todo WHERE fromUser=? AND isArchived = 1');


    mysqli_stmt_bind_param($stmt, 'i', $userID);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    mysqli_stmt_close($stmt);

    return $result;

}

// Get's all the information of a given todo ID
function getTodoInformation($todoID): ?array
{

    global $conn;

    $stmt = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($stmt, 'SELECT * FROM todo WHERE ID=?');


    mysqli_stmt_bind_param($stmt, 'i', $todoID);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    mysqli_stmt_close($stmt);

    return mysqli_fetch_row($result);

}

function deleteUser($userID){

    global $conn;

    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, 'DELETE FROM todo WHERE fromUser = ?');
    mysqli_stmt_bind_param($stmt, 'i', $userID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, 'DELETE FROM users_category WHERE UserID = ?');
    mysqli_stmt_bind_param($stmt, 'i', $userID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, 'DELETE FROM users WHERE ID = ?');
    mysqli_stmt_bind_param($stmt, 'i', $userID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);



}

#[NoReturn] function changePassword($ID, $newPassword){

    global $conn;

    if(passLen($newPassword) !== false){

        header('location: ../admin_area/changePassword.php?userID='.$ID.'&error=passLen');
        exit;

    }

    // Update hashed password.

    $stmt = mysqli_stmt_init($conn);

    $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    mysqli_stmt_prepare($stmt, 'UPDATE users SET passwordHash = ? where ID = ?');
    mysqli_stmt_bind_param($stmt, 'si', $newPassword, $ID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('location: ../admin_area/editUsers.php?error=passwordChangeSuccess');
    exit;

}

#[NoReturn] function changeUsername($ID, $newUsername){

    global $conn;

    if(invalidUsername($newUsername) !== false){

        header('location: ../admin_area/changeUsername.php?userID='.$ID.'&error=invalidUsername');
        exit;

    }

    if(checkForUser($newUsername) !== false){

        header('location: ../admin_area/changeUsername.php?userID='.$ID.'&error=usernameTaken');
        exit;

    }

    // Update username.

    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, 'UPDATE users SET userName = ? where ID = ?');
    mysqli_stmt_bind_param($stmt, 'si', $newUsername, $ID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('location: ../admin_area/editUsers.php?error=usernameChangeSuccess');
    exit;

}

// Returns an array of categories in which the user is in.
function getCategoriesFromUser($UserID): array
{

    global $conn;

    $stmt = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($stmt, 'select c.name, c.ID, uc.userID from users_category uc left join category c on c.ID = uc.categoryID where userID=?');
    mysqli_stmt_bind_param($stmt, 's',$UserID);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $result = mysqli_fetch_all($result);

    mysqli_stmt_close($stmt);

    return $result;



}

// Returns a filled array if user is owner of todo, else the array will be empty.
function isOwnerOfTodo($todoID, $userID): array
{

    global $conn;

    $stmt = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($stmt, 'SELECT * FROM todo WHERE ID=? AND fromUser=?');
    mysqli_stmt_bind_param($stmt, 'ii', $todoID,$userID);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $result = mysqli_fetch_all($result);

    mysqli_stmt_close($stmt);

    return $result;



}

// Check's if a user has still access to a category (It returns an array of categories on which the user has access to)
function hasAccessToCategories($userID): array
{

    global $conn;

    $stmt = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($stmt, 'select categoryID from users_category where userID=?');
    mysqli_stmt_bind_param($stmt, 'i', $userID);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $result = mysqli_fetch_all($result);

    mysqli_stmt_close($stmt);

    return $result;


}

function archiveTodo($todoID){

    global $conn;

    $stmt = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($stmt, 'UPDATE todo SET isArchived = 1 WHERE ID=?');
    mysqli_stmt_bind_param($stmt, 'i', $todoID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

}

function unArchiveTodo($todoID){

    global $conn;

    $stmt = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($stmt, 'UPDATE todo SET isArchived = 0 WHERE ID=?');
    mysqli_stmt_bind_param($stmt, 'i', $todoID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

}


function removeTodo($todoID){

    global $conn;

    $stmt = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($stmt, 'DELETE FROM todo WHERE ID=?');
    mysqli_stmt_bind_param($stmt, 'i', $todoID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

}

// This function gets the days until expiry given an expiry date.
function daysTillExpiry($expiryDate): int|string
{
    try {
        $expiryDate = new DateTime($expiryDate);
    } catch (Exception) {
    }
    $now = new DateTime();
    if($expiryDate->format('y-m-d') === $now->format('y-m-d')) return 0;

    $daysDiff = $now->diff($expiryDate)->format('%R%a');
    if($daysDiff >= 0) $daysDiff++;
    return $daysDiff;
}