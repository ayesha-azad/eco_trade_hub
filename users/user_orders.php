<div class="container-fluid">

<h2 style="color: #0A1F44; font-weight: 800" class="text-center my-3">ALL ORDERS AND CONFIRM PAYMENTS</h2>

<table class="table text-center">
  <thead>
    <tr>
      <th scope="col">S No. </th>
      <th scope="col">Order Number</th>
      <th scope="col">Order Amount</th>
      <th scope="col">Total Products</th>
      <th scope="col">Invoice Number</th>
      <th scope="col">Date</th>
      <th scope="col">Complete/Incomplete</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
    

    <?php 
    $number = 1;
    $get_order_details = "SELECT * FROM `user_orders` WHERE user_id = $user_id";
    $orders_query = mysqli_query($conn, $get_order_details);
    while($row = mysqli_fetch_assoc($orders_query)){
        $order_id = $row['order_id'];
        $amount_due = $row['amount_due'];
        $total_products = $row['total_products'];
        $invoice_number = $row['invoice_number'];
        $order_date = $row['order_date'];
        $order_status = $row['order_status'];
        if($order_status == 'pending'){
            $order_status = "Incomplete";
        }
        else{
            $order_status = "Complete";
        }
    ?>
    <tr>
      <th scope="row"><?php echo $number; ?></th>
      <td><?php echo $order_id; ?></td>
      <td><?php echo $amount_due; ?></td>
      <td><?php echo $total_products; ?></td>
      <td><?php echo $invoice_number; ?></td>
      <td><?php echo $order_date; ?></td>
      <td><?php echo $order_status; ?></td>
      <td><?php 
      if($order_status == "Complete"){
        echo "<a href='' class='btn btn-general'>Paid</a>";
      }
      else{
        echo "<a href='confirm_payment.php?order_id=$order_id' class='btn btn-general'>Confirm</a>";
      }
      ?></td>
    </tr>

    <?php 
    $number++;
    }
    ?>
  </tbody>
</table>

</div>
