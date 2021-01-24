<?php

/* Database Connection Handler*/

$sv_name = "localhost";
$sv_username = "todoDBAdmin";
$sv_password = "0nly1D0Ch4ng3s!!";
$db_name = "todos";

// Create connection
$conn = mysqli_connect($sv_name, $sv_username, $sv_password, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
