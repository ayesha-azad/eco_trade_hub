<h2 style="color: #0A1F44; font-weight: 800" class="text-center my-5">ALL ORDERS</h2>

<div class="container">
    <div class="row">
        <table class="table text-center">

        <?php 
$number = 0;

$get_orders = "SELECT * FROM `user_orders`";
$result = mysqli_query($conn, $get_orders);
$row_count = mysqli_num_rows($result);
if($row_count == 0){
    echo "<h3 style='color: #0A1F44; font-weight: 700' class='text-center'>No orders yet!</h3>";
}else{
        ?>

        <thead>
            <tr>
              <th scope="col">S No</th>
              <th scope="col">Due Amount</th>
              <th scope="col">Invoice Number</th>
              <th scope="col">Total Products</th>
              <th scope="col">Order Date</th>
              <th scope="col">Status</th>
              <th scope="col">Update</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>

          <tbody>

          <?php 
          
          
          while($row = mysqli_fetch_assoc($result)){
            $order_id  = $row['order_id'];
            $user_id  = $row['user_id'];
            $amount_due = $row['amount_due'];
            $invoice_number = $row['invoice_number'];
            $total_products = $row['total_products'];
            $order_date = $row['order_date'];
            $order_status = $row['order_status'];
            $number++;
            ?>
            <tr>
                <td><?php echo $number; ?></td>
                <td><?php echo $amount_due; ?></td>
                <td><?php echo $invoice_number; ?></td>
                <td><?php echo $total_products; ?></td>
                <td><?php echo $order_date; ?></td>
                <td><?php echo ucfirst($order_status); ?></td>
                <td>
                  <?php 
                  if($order_status == 'pending'){ ?>

                  <a href="index.php?complete_order=<?php echo $order_id; ?>" class="btn btn-general">
                    Complete
                   </a> 

                  <?php 
                  }
                  else{
                    echo "<i class='fa-solid fa-check-circle' style='color: #0A1F44'></i>";
                  }
                  ?>
                  
 
                </td>
                <td>
                <a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $order_id; ?>">
                  <i class="fa-solid fa-trash"></i>
                </a>   
                </td>
            </tr>

            <!-- Modal for each category -->
            <div class="modal fade" id="deleteModal<?php echo $order_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this order?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <a href="index.php?delete_order=<?php echo $order_id; ?>" class="btn btn-danger">Yes</a>
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