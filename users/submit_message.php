<?php
session_start();
include("includes/connect.php");

if (!isset($_SESSION['username'])) {
    exit("You are not logged in");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sender = $_POST['sender'];
    $receiver = $_POST['receiver'];
    $message = $_POST['message'];

    $sql = "INSERT INTO chat_messages (sender, receiver, message, date) VALUES ('$sender', '$receiver', '$message', NOW())";
    $conn->query($sql);
    $conn->close();
}


?>