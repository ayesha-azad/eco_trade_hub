<?php
@session_start();
?>

<h2 style="color: #0A1F44; font-weight: 800" class="text-center mt-5 mb-5">PAYMENT OPTIONS</h2>
<div class="row row-cols-1 row-cols-md-2 row-cols-sm-1 row-cols-lg-2">
<div class="col">
    <?php
    $get_ip_add = getIPAddress();
    $select_cart = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
    $result_cart = mysqli_query($conn,$select_cart); 
    while($row = mysqli_fetch_assoc($result_cart)){
        $product_id = $row['product_id'];
        $select_cart_items = "SELECT * FROM `products` WHERE product_id = $product_id";
        $result_cart_items = mysqli_query($conn, $select_cart_items);
        while($row_cart = mysqli_fetch_assoc($result_cart_items)){
            $product_image1 = $row_cart['product_image1'];
            $product_name = $row_cart['product_title'];
            ?>
            <div class="card text-center mx-auto" style="width: 18rem;">
                <!-- Centered Image -->
                <img src="seller/product_images/<?php echo $product_image1?>" alt="Product Image" class="card-img-pay mx-auto d-block mt-3" style="width: 150px;">
                <div class="card-body">
                    <p><?php echo $product_name; ?></p>
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>

<div class="col text-center">

    <?php 
    $user_email =  $_SESSION['email'];

    $select_details = "SELECT * FROM `users` WHERE user_ip='$get_ip_add' AND user_email = '$user_email'";
    $result_details = mysqli_query($conn,$select_details); 
    $result_fetch = mysqli_fetch_assoc($result_details);
    $user_id = $result_fetch['user_id'];
    ?>
        <a href="users/order.php?user_id=<?php echo $user_id; ?>"><button class="btn btn-general my-5 px-5 rounded-pill">Confirm Order</button></a>
    </div>
</div>

</div>
