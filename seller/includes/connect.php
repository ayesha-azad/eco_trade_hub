<?php
$servername = "mysql";
$username = "myuser";
$password = "mypassword";
$database = "mydatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die(mysqli_error($conn));
}
?>