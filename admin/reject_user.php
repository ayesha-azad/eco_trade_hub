<?php 

// Reject user
if (isset($_GET['reject_user'])) {
    $user_id = $_GET['reject_user'];
    $update_status = "UPDATE `users` SET `status` = 'rejected' WHERE `user_id` = $user_id";
    $result = mysqli_query($conn, $update_status);
    if($result){
        echo "<script>window.alert('User rejected successfully!');
        window.location.href = 'index.php?list_users';</script>";
    }
}

?>