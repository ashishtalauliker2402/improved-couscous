<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "book_database";

//Create Connection

$conn = mysqli_connect($servername, $username, $password, $db_name);

//Check Connection
if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}
?>