<h2 style="color: #0A1F44; font-weight: 800" class="text-center my-5">ALL ORDERS</h2>

<div class="container">
    <div class="row">
        <table class="table text-center">

        <?php 
$number = 0;

$get_payments = "SELECT * FROM `user_payments`";
$result = mysqli_query($conn, $get_payments);
$row_count = mysqli_num_rows($result);
if($row_count == 0){
    echo "<h3 style='color: #0A1F44; font-weight: 700' class='text-center'>No orders yet!</h3>";
}else{
        ?>

        <thead>
            <tr>
              <th scope="col">S No</th>
              <th scope="col">Invoice Number</th>
              <th scope="col">Amount</th>
              <th scope="col">Payment Mode</th>
              <th scope="col">Order Date</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>

          <tbody>

          <?php 
          
          
          while($row = mysqli_fetch_assoc($result)){
            $payment_id  = $row['payment_id'];
            $order_id  = $row['order_id'];
            $invoice_number = $row['invoice_number'];
            $amount = $row['amount'];
            $payment_mode = $row['payment_mode'];
            $date = $row['date'];
            $number++;
            ?>
            <tr>
                <td><?php echo $number; ?></td>
                <td><?php echo $invoice_number; ?></td>
                <td><?php echo $amount; ?></td>
                <td><?php echo $payment_mode; ?></td>
                <td><?php echo $date; ?></td>
                <td>
                <a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $payment_id; ?>">
                  <i class="fa-solid fa-trash"></i>
                </a>   
                </td>
            </tr>

            <!-- Modal for each category -->
            <div class="modal fade" id="deleteModal<?php echo $payment_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this order?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <a href="index.php?delete_payment=<?php echo $payment_id; ?>" class="btn btn-danger">Yes</a>
                  </div>
                </div>
              </div>
            </div>


        <?php
          }
          }
          ?>
          </tbody>
        </table>
    </div>
</div>