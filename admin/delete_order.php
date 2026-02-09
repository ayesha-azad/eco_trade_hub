<?php 

if(isset($_GET['delete_order'])){
    $order_id = $_GET['delete_order'];
}

$delete = "DELETE FROM `user_orders` WHERE order_id = $order_id";
$result = mysqli_query($conn, $delete);
if($result){
    echo "<script>alert('Order deleted successfully!'); window.location.href = 'index.php?list_orders';</script>";
}
?>