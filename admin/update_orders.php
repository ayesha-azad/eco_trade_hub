<?php
if (isset($_GET['complete_order'])) {
    $order_id = $_GET['complete_order'];

    // Retrieve the invoice_number from the user_orders table for the given order_id
    $get_invoice_number = "SELECT `invoice_number` FROM `user_orders` WHERE `order_id` = $order_id";
    $invoice_result = mysqli_query($conn, $get_invoice_number);

    if ($invoice_result && mysqli_num_rows($invoice_result) > 0) {
        $invoice_row = mysqli_fetch_assoc($invoice_result);
        $invoice_number = $invoice_row['invoice_number'];

        // Update order status to 'complete' in user_orders table
        $update_user_orders = "UPDATE `user_orders` SET `order_status` = 'complete' WHERE `order_id` = $order_id";
        $user_orders_result = mysqli_query($conn, $update_user_orders);

        // Update order status to 'complete' in orders_pending table where the invoice_number matches
        $update_orders_pending = "UPDATE `orders_pending` SET `order_status` = 'complete' WHERE `invoice_number` = '$invoice_number'";
        $orders_pending_result = mysqli_query($conn, $update_orders_pending);

        if ($user_orders_result && $orders_pending_result) {
            echo "<script>alert('Order status updated to complete!');</script>";
            echo "<script>window.location.href = 'index.php?list_orders';</script>";  // Redirect to refresh the page
        } else {
            echo "<script>alert('Failed to update order status');</script>";
        }
    } else {
        echo "<script>alert('Invoice number not found');</script>";
    }
}
?>
