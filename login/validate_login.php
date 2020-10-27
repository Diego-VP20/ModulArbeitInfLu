<?php

$user = $_POST["user"];
$pass = $_POST["pass"];


$sv_name = "localhost";
$sv_username = "root";
$sv_password = "";

// Create connection
$conn = new mysqli($sv_name, $sv_name, $sv_password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, username, password FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    }
} else {
    echo "0 results";
}
