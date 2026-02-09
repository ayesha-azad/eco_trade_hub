<h2 style="color: #0A1F44; font-weight: 800" class="text-center my-5">ALL BRANDS</h2>

<div class="container">
    <div class="row">
        <table class="table text-center">

        <thead>
            <tr>
              <th scope="col">Brand ID</th>
              <th scope="col">Brand Title</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>

          <tbody>

          <?php 
          
          $number = 0;

          $get_brands = "SELECT * FROM `brands`";
          $result = mysqli_query($conn, $get_brands);
          while($row = mysqli_fetch_assoc($result)){
            $brand_id = $row['brand_id'];
            $brand_title = $row['brand_title'];
            $number++;
            ?>
            <tr>
                <td><?php echo $number; ?></td>
                <td><?php echo $brand_title; ?></td>
                <td><a href="index.php?edit_brand=<?php echo $brand_id; ?>" class="text-warning"><i class="fa-solid fa-pen-to-square"></i></a></td>
                <td>
                <a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $brand_id; ?>">
                        <i class="fa-solid fa-trash"></i>
                    </a>  
                </td>
            </tr>

            <!-- Modal for each category -->
            <div class="modal fade" id="deleteModal<?php echo $brand_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this brand?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <a href="index.php?delete_brand=<?php echo $brand_id; ?>" class="btn btn-danger">Yes</a>
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