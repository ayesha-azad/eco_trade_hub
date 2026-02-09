<h2 style="color: #0A1F44; font-weight: 800" class="text-center my-5">ALL CATEGORIES</h2>

<div class="container">
    <div class="row">
        <table class="table text-center">
        <thead>
            <tr>
              <th scope="col">Category ID</th>
              <th scope="col">Category Title</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
          <?php 
          $number = 0;
          $get_categories = "SELECT * FROM `categories`";
          $result = mysqli_query($conn, $get_categories);
          while($row = mysqli_fetch_assoc($result)){
            $category_id = $row['category_id'];
            $category_title = $row['category_title'];
            $number++;
            ?>
            <tr>
                <td><?php echo $number; ?></td>
                <td><?php echo $category_title; ?></td>
                <td><a href="index.php?edit_category=<?php echo $category_id; ?>" class="text-warning"><i class="fa-solid fa-pen-to-square"></i></a></td>
                <td>
                    <a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $category_id; ?>">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </td>
            </tr>

            <!-- Modal for each category -->
            <div class="modal fade" id="deleteModal<?php echo $category_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this category?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <a href="index.php?delete_category=<?php echo $category_id; ?>" class="btn btn-danger">Yes</a>
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
