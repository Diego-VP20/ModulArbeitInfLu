<?php

/* Database Connection Handler*/

$sv_name = "localhost";
$sv_username = "root";
$sv_password = "";
$db_name = "dvp_projekt";

// Create connection
$conn = mysqli_connect($sv_name, $sv_username, $sv_password, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
