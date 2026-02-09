<?php 
include("../includes/connect.php");
include("../functions/common_functions.php");
session_start();

if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
}

$get_ip_add = getIPAddress();
$total_price = 0;
$main_quantity = 0;
$cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
$result_query = mysqli_query($conn, $cart_query);
$result_count = mysqli_num_rows($result_query);
$invoice_number = mt_rand();
$status = 'pending';
if($result_count > 0){
    while($row = mysqli_fetch_array($result_query)){
        $product_id = $row['product_id'];
        $select_products = "SELECT * FROM `products` WHERE product_id='$product_id'";
        $result_products = mysqli_query($conn, $select_products);
        while($row_product_price = mysqli_fetch_assoc($result_products)){
            $product_price = $row_product_price['product_price'];
            $cart_quantity = $row['quantity'];
            $product_total_price = $product_price * $cart_quantity;
            $total_price += $product_total_price;
            $main_quantity += $cart_quantity;

            //inserting pending orders

            $insert_orders_pending = "INSERT INTO `orders_pending` (user_id, invoice_number, product_id, quantity, order_status) VALUES ($user_id, $invoice_number, $product_id, $cart_quantity, '$status')";
            $result_insert_pending = mysqli_query($conn, $insert_orders_pending);

        }
    }
}

//inserting in user_orders 

$insert_orders = "INSERT INTO `user_orders` (user_id, amount_due, invoice_number, total_products, order_date, order_status) VALUES ($user_id, $total_price, $invoice_number, $main_quantity, NOW(), '$status')";
$result_insert = mysqli_query($conn, $insert_orders);

if($result_insert){
    echo "<script>
        alert('Confirm payment method here!');
        window.location.href = 'profile.php?my_orders';
    </script>";
}
else{
    echo "<script>window.alert('Something went wrong!')</script>";
}

//Deleting cart items
$delete_cart = "DELETE FROM `cart_details` WHERE ip_address = '$get_ip_add'";
$result_delete = mysqli_query($conn, $delete_cart);

?>