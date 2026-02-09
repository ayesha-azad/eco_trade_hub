<?php

// Approve seller
if (isset($_GET['approve_seller'])) {
    $seller_id = $_GET['approve_seller'];
    $update_status = "UPDATE `sellers` SET `status` = 'approved' WHERE `seller_id` = $seller_id";
    $result = mysqli_query($conn, $update_status);
    if($result){
        echo "<script>window.alert('Seller approved successfully!');
        window.location.href = 'index.php?list_sellers';</script>";
    }
}


?>
