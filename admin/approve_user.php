<?php

// Approve user
if (isset($_GET['approve_user'])) {
    $user_id = $_GET['approve_user'];
    $update_status = "UPDATE `users` SET `status` = 'approved' WHERE `user_id` = $user_id";
    $result = mysqli_query($conn, $update_status);
    if($result){
        echo "<script>window.alert('User approved successfully!');
        window.location.href = 'index.php?list_users';</script>";
    }
}


?>
