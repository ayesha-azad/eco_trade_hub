<?php 

if(isset($_GET['delete_seller'])){
    $seller_id = $_GET['delete_seller'];
}

$delete = "DELETE FROM `sellers` WHERE seller_id = $seller_id";
$result = mysqli_query($conn, $delete);
if($result){
    echo "<script>alert('Seller deleted successfully!'); window.location.href = 'index.php?list_sellers';</script>";
}
?>