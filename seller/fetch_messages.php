<?php
session_start();
include(__DIR__ . "/../../includes/connect.php");

if (!isset($_SESSION['sellername'])) {
    exit("You are not logged in");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sender = $_POST['sender'];
    $receiver = $_POST['receiver'];

    $sql = "SELECT * FROM chat_messages WHERE (sender='$sender' AND receiver='$receiver') OR (sender='$receiver' AND receiver='$sender') ORDER BY date";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Determine the message class based on the sender
            $messageClass = ($row['sender'] === $sender) ? 'message-sender' : 'message-receiver';

            echo '<div class="' . $messageClass . ' container px-5 pb-3">' . htmlspecialchars($row['message']) . '</div>';
        }
    }
}
?>
