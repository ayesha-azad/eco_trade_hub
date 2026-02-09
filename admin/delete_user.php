<?php 

if(isset($_GET['delete_user'])){
    $user_id = $_GET['delete_user'];
}

$delete = "DELETE FROM `users` WHERE user_id = $user_id";
$result = mysqli_query($conn, $delete);
if($result){
    echo "<script>alert('User deleted successfully!'); window.location.href = 'index.php?list_users';</script>";
}
?>