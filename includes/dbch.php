<?php

/* Database Connection Handler*/

$sv_name = "localhost";
$sv_username = "todositeuser";
$sv_password = "onlyID0Th3Qu3r13s!";
$db_name = "todosite";

// Create connection
$conn = mysqli_connect($sv_name, $sv_username, $sv_password, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
