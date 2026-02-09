<h2 style="color: #0A1F44; font-weight: 800" class="text-center my-5">ALL USERS</h2>

<div class="container">
    <div class="row">
        <table class="table text-center">

        <thead>
            <tr>
              <th scope="col">S No</th>
              <th scope="col">Username</th>
              <th scope="col">User Email</th>
              <th scope="col">User Image</th>
              <th scope="col">User Address</th>
              <th scope="col">User Mobile</th>
              <th scope="col">Status</th>
              <th scope="col">Approve</th>
              <th scope="col">Reject</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>

          <tbody>

          <?php 
          
          $number = 0;

          $get_products = "SELECT * FROM `users`";
          $result = mysqli_query($conn, $get_products);
          while($row = mysqli_fetch_assoc($result)){
            $user_id  = $row['user_id'];
            $username = $row['username'];
            $user_email = $row['user_email'];
            $user_image	 = $row['user_image'];
            $user_address = $row['user_address'];
            $user_mobile = $row['user_mobile'];
            $status = $row['status'];
            $number++;
            ?>
            <tr>
                <td><?php echo $number; ?></td>
                <td><?php echo $username; ?></td>
                <td><?php echo $user_email; ?></td>
                <td><?php echo "<img class='product-img' src='../users/user_images/$user_image'>"; ?></td>
                <td><?php echo $user_address; ?></td>
                <td><?php echo $user_mobile; ?></td>
                <td><?php echo ucfirst($status); ?></td>
                <td><a href="index.php?approve_user=<?php echo $user_id; ?>" class="text-warning"><button class="btn btn-panel text-light">Approve</button></a></td>
                <td>
                    <a href="index.php?reject_user=<?php echo $user_id; ?>" class="text-light"><button class="btn btn-warning text-light">Reject</button></a>
                </td>
                <td>
                <a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $user_id; ?>">
                  <i class="fa-solid fa-trash"></i>
                </a>   
                </td>
            </tr>

            <!-- Modal for each category -->
            <div class="modal fade" id="deleteModal<?php echo $user_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this user?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <a href="index.php?delete_user=<?php echo $user_id; ?>" class="btn btn-danger">Yes</a>
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