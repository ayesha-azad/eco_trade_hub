<?php 

// Reject seller
if (isset($_GET['reject_seller'])) {
    $seller_id = $_GET['reject_seller'];
    $update_status = "UPDATE `sellers` SET `status` = 'rejected' WHERE `seller_id` = $seller_id";
    $result = mysqli_query($conn, $update_status);
    if($result){
        echo "<script>window.alert('Seller rejected successfully!');
        window.location.href = 'index.php?list_sellers';</script>";
    }
}

?>