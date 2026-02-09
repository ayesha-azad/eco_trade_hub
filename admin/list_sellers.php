<h2 style="color: #0A1F44; font-weight: 800" class="text-center my-5">ALL SELLERS</h2>

<div class="container">
    <div class="row">
        <table class="table text-center">

        <thead>
            <tr>
              <th scope="col">S No</th>
              <th scope="col">Seller Name</th>
              <th scope="col">Seller Email</th>
              <th scope="col">Seller Image</th>
              <th scope="col">Seller Address</th>
              <th scope="col">Seller Mobile</th>
              <th scope="col">Status</th>
              <th scope="col">Approve</th>
              <th scope="col">Reject</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>

          <tbody>

          <?php 
          
          $number = 0;

          $get_products = "SELECT * FROM `sellers`";
          $result = mysqli_query($conn, $get_products);
          while($row = mysqli_fetch_assoc($result)){
            $seller_id  = $row['seller_id'];
            $sellername = $row['sellername'];
            $seller_email = $row['seller_email'];
            $seller_image	 = $row['seller_image'];
            $seller_address = $row['seller_address'];
            $seller_mobile = $row['seller_mobile'];
            $status = $row['status'];
            $number++;
            ?>
            <tr>
                <td><?php echo $number; ?></td>
                <td><?php echo $sellername; ?></td>
                <td><?php echo $seller_email; ?></td>
                <td><?php echo "<img class='product-img' src='../seller/seller_images/$seller_image'>"; ?></td>
                <td><?php echo $seller_address; ?></td>
                <td><?php echo $seller_mobile; ?></td>
                <td><?php echo ucfirst($status); ?></td>
                <td><a href="index.php?approve_seller=<?php echo $seller_id; ?>" class="text-warning"><button class="btn btn-panel text-light">Approve</button></a></td>
                <td>
                    <a href="index.php?reject_seller=<?php echo $seller_id; ?>" class="text-light"><button class="btn btn-warning text-light">Reject</button></a>
                </td>
                <td>
                <a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $seller_id; ?>">
                  <i class="fa-solid fa-trash"></i>
                </a>   
                </td>
            </tr>

            <!-- Modal for each category -->
            <div class="modal fade" id="deleteModal<?php echo $seller_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this seller?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <a href="index.php?delete_seller=<?php echo $seller_id; ?>" class="btn btn-danger">Yes</a>
                  </div>
                </div>
              </div>
            </div>


        <?php
          }
          ?>
          </tbody>
        </table>
    </div>
</div>