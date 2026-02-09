<h2 style="color: #0A1F44; font-weight: 800" class="text-center my-5">YOUR PRODUCTS</h2>

<div class="container">
    <div class="row">
        <table class="table text-center">

        <thead>
            <tr>
              <th scope="col">Product ID</th>
              <th scope="col">Product Title</th>
              <th scope="col">Product Owner</th>
              <th scope="col">Product Image</th>
              <th scope="col">Product Price</th>
              <th scope="col">Total Sold</th>
              <th scope="col">Status</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>

          <tbody>

          <?php 
          
          $number = 0;
          $owner_seller = $_SESSION['seller_email'];

          $get_owner_id = "SELECT * FROM sellers WHERE seller_email ='$owner_seller'";
          $result_owner = mysqli_query($conn, $get_owner_id);
          $row_owner = mysqli_fetch_assoc($result_owner);
          $seller_id = $row_owner['seller_id'];

          $get_products = "SELECT * FROM `products` WHERE seller_id = $seller_id";
          $result = mysqli_query($conn, $get_products);
          while($row = mysqli_fetch_assoc($result)){
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];
            $status = $row['status'];
            $number++;
            ?>
            <tr>
                <td><?php echo $number; ?></td>
                <td><?php echo $product_title; ?></td>
                <td><?php echo $owner_seller; ?></td>
                <td><?php echo "<img class='product-img' src='product_images/$product_image1'>"; ?></td>
                <td><?php echo $product_price; ?></td>
                <td><?php

                $get_count = "SELECT * FROM `orders_pending` where product_id = $product_id";
                $result_count = mysqli_query($conn, $get_count);
                $row_count = mysqli_num_rows($result_count);

                echo $row_count;

                ?></td>
                <td><?php echo $status; ?></td>
                <td><a href="index.php?edit_product=<?php echo $product_id; ?>" class="text-warning"><i class="fa-solid fa-pen-to-square"></i></a></td>
                <td>
                <a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $product_id; ?>">
                  <i class="fa-solid fa-trash"></i>
                </a>   
                </td>
            </tr>

            <!-- Modal for each category -->
            <div class="modal fade" id="deleteModal<?php echo $product_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this product?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <a href="index.php?delete_product=<?php echo $product_id; ?>" class="btn btn-danger">Yes</a>
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