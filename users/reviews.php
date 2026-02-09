<?php



if(isset($_GET["product_id"])){
  $product_id = $_GET["product_id"];
}

$avgRatings = 0;
$avgUserRatings = 0;
$totalReviews = 0;
$totalRatings5 = 0;
$totalRatings4 = 0;
$totalRatings3 = 0;
$totalRatings2 = 0;
$totalRatings1 = 0;
$totalRatings_avg = 0;

$sql = "SELECT * FROM reviews WHERE product_id = $product_id";
$result = mysqli_query($conn, $sql);
if(!$result){
echo mysqli_error($conn);
}

while($row = mysqli_fetch_assoc($result)) {

switch ($row['rating']) {
  case '5': $totalRatings5++; break;
  case '4': $totalRatings4++; break;
  case '3': $totalRatings3++; break;
  case '2': $totalRatings2++; break;
  case '1': $totalRatings1++; break;
}
$totalReviews++;
$totalRatings_avg += intval($row['rating']);  
}

$avgUserRatings = $totalReviews > 0 ? number_format($totalRatings_avg / $totalReviews, 1) : 0; // Avoid division by zero

?>


<div class="container my-5">
        <div class="row">
            <div class="col-sm-4 text-center">
                <h1><span id="avg_rating"><?php echo $avgUserRatings; ?></span>/5.0</h1>
                <div>

                <?php 
                // Filled stars
                for($i = 0; $i < floor($avgUserRatings); $i++) {
                    echo '<i class="fa fa-star text-warning main_star mr-1"></i>';
                }

                // Remaining empty stars
                $remaining_stars = 5 - floor($avgUserRatings);
                for($i = 0; $i < $remaining_stars; $i++) {
                    echo '<i class="fa fa-star star-light main_star mr-1"></i>';
                }
                ?>

                  </div>
                <span id="total_review"><?php echo $totalReviews; ?></span> Reviews
            </div>

            <div class="col-sm-4 text-center m-auto">

              <!-- 5 stars  -->
              <div>
              <i class="fa fa-star text-warning main_star mr-1"></i>
              <i class="fa fa-star text-warning main_star mr-1"></i>
              <i class="fa fa-star text-warning main_star mr-1"></i>
              <i class="fa fa-star text-warning main_star mr-1"></i>
              <i class="fa fa-star text-warning main_star mr-1"></i>
              (<?php echo  $totalRatings5;?> Reviews)
              </div>

              <!-- 4 stars  -->
              <div>
              <i class="fa fa-star text-warning main_star mr-1"></i>
              <i class="fa fa-star text-warning main_star mr-1"></i>
              <i class="fa fa-star text-warning main_star mr-1"></i>
              <i class="fa fa-star text-warning main_star mr-1"></i>
              (<?php echo  $totalRatings4;?> Reviews)
              </div>

              <!-- 3 stars  -->
              <div>
              <i class="fa fa-star text-warning main_star mr-1"></i>
              <i class="fa fa-star text-warning main_star mr-1"></i>
              <i class="fa fa-star text-warning main_star mr-1"></i>
              (<?php echo  $totalRatings3;?> Reviews)
              </div>

              <!-- 2 stars  -->
              <div>
              <i class="fa fa-star text-warning main_star mr-1"></i>
              <i class="fa fa-star text-warning main_star mr-1"></i>
              (<?php echo  $totalRatings2;?> Reviews)
              </div>

              <!-- 1 star  -->
              <div>
              <i class="fa fa-star text-warning main_star mr-1"></i>
              (<?php echo  $totalRatings1;?> Reviews)
              </div>
              
            </div>
            
            <div class="col-sm-4 text-center m-auto">
                <?php 
                if(isset($_SESSION['username'])){
                    echo '<button type="button" class="btn btn-general" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add Review</button>';

                    $reviewer = $_SESSION['email'];
                    $get_reviewer = "SELECT * FROM users WHERE user_email = '$reviewer'";
                    $result_reviewer = mysqli_query($conn, $get_reviewer);
                    if ($row_reviewer = mysqli_fetch_assoc($result_reviewer)) {
                        $user_id = $row_reviewer['user_id'];
                    }
                }
                else{
                  echo '<a class="btn btn-general" href="login.php?user_login">Login to Add Review</a>';
                }
                ?>

            </div>
        </div>

        <div id="display_review">
        <?php 
        getReviews();
        if (isset($_POST['delete_review'])) {
          $review_id = $_POST['review_id'];
          deleteReview($review_id);
        }
        ?>
        </div>
    </div>
    
  <!-- The Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Write your review</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        
        <!-- Modal body -->
        <div class="modal-body text-center">
        <h4>
            <i class="fa fa-star star-light submit_star  mr-1 " id='submit_star_1'  data-rating='1'></i>
            <i class="fa fa-star star-light submit_star  mr-1 " id='submit_star_2' data-rating='2'></i>
            <i class="fa fa-star star-light submit_star   mr-1 " id='submit_star_3' data-rating='3'></i>
            <i class="fa fa-star star-light submit_star  mr-1 " id='submit_star_4' data-rating='4'></i>
            <i class="fa fa-star star-light submit_star  mr-1 " id='submit_star_5' data-rating='5'></i>
        </h4>
        <div class="my-3"> 
            
        <?php
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    echo "<input type='hidden' id='productId' name='productId' value='$product_id'>";

    echo "<input type='hidden' id='userId' name='userId' value='$user_id';";
}
?>


            
            <p><?php echo $_SESSION['email']; ?></p>
            
        </div>
        <div class="my-3">

        <textarea name="userMessage" id="userMessage" class="form-control" placeholder="Enter message"></textarea>
        </div>
        <div class="my-3p">
            <button class="btn btn-general" id='sendReview'>Add</button>
        </div>

        </div>
         
      </div>
    </div>
  </div>

