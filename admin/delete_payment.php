<?php 

if(isset($_GET['delete_payment'])){
    $payment_id = $_GET['delete_payment'];
}

$delete = "DELETE FROM `user_payments` WHERE payment_id = $payment_id";
$result = mysqli_query($conn, $delete);
if($result){
    echo "<script>alert('Payment deleted successfully!'); window.location.href = 'index.php?list_payments';</script>";
}
?>