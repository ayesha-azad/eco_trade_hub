<?php 
include("includes/connect.php");

//displaying products on main page

function getProducts(){

    global $conn;

    if(!isset($_GET['category'])){
        if(!isset($_GET['brand'])){

    $select_query = "SELECT * FROM `products` LIMIT 0,6";
         $result_query = mysqli_query($conn,$select_query);
         while($row = mysqli_fetch_assoc($result_query)){
          $product_id = $row['product_id'];
          $product_title = $row['product_title'];
          $product_description = $row['product_description'];
          $product_image1 = $row['product_image1'];
          $product_price = $row['product_price'];
          $category_id = $row['category_id'];
          $brand_id = $row['brand_id'];

          echo "<div class='col'>
                <div class='card mb-4'>
                <a href='product_details.php?product_id=".$product_id."'>
                <img src='seller/product_images/$product_image1' class='card-img-top' alt='...'>
                </a>
                    <div class='card-body text-center'>
                        <h5 class='card-title'>$product_title</h5>
                        <p class='card-text'>$product_description</p>
                        <hr>
                        <p class='card-text fw-bold'> Rs. $product_price </p>
                        <a href='index.php?add_to_cart=$product_id' class='text-center btn btn-add-cart'>Add to Cart</a>
                    </div>
                </div>
            </div>";
         }
}
}
}

//Displaying all Products

function getAllProducts(){

    global $conn;

    if(!isset($_GET['category'])){
        if(!isset($_GET['brand'])){

    $select_query = "SELECT * FROM `products`";
         $result_query = mysqli_query($conn,$select_query);
         while($row = mysqli_fetch_assoc($result_query)){
          $product_id = $row['product_id'];
          $product_title = $row['product_title'];
          $product_description = $row['product_description'];
          $product_image1 = $row['product_image1'];
          $product_price = $row['product_price'];
          $category_id = $row['category_id'];
          $brand_id = $row['brand_id'];

          echo "<div class='col'>
                <div class='card mb-4'>
                <a href='product_details.php?product_id=".$product_id."'>
                <img src='seller/product_images/$product_image1' class='card-img-top' alt='...'>
                </a>
                    <div class='card-body text-center'>
                        <h5 class='card-title'>$product_title</h5>
                        <p class='card-text'>$product_description</p>
                        <hr>
                        <p class='card-text fw-bold'> Rs. $product_price </p>
                        <a href='index.php?add_to_cart=$product_id' class='text-center btn btn-add-cart'>Add to Cart</a>
                    </div>
                </div>
            </div>";
         }
}
}
}

//Getting unique categories 

function getUniqueCategories(){

    global $conn;

    if(isset($_GET['category'])){

    $category_id = $_GET['category'];

    $select_query = "SELECT * FROM `products` WHERE category_id = $category_id";
    $result_query = mysqli_query($conn,$select_query);
    $num_of_rows = mysqli_num_rows($result_query);
    if($num_of_rows == 0){
        echo "<div class='container text-center d-flex align-items-center justify-content-center'>
        <div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
        <h4><strong><i class='fa-solid fa-triangle-exclamation me-2'></i></strong>No stock for this Category!</h4>
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
</div>";
    }

         while($row = mysqli_fetch_assoc($result_query)){
          $product_id = $row['product_id'];
          $product_title = $row['product_title'];
          $product_description = $row['product_description'];
          $product_image1 = $row['product_image1'];
          $product_price = $row['product_price'];
          $category_id = $row['category_id'];
          $brand_id = $row['brand_id'];

          echo "<div class='col'>
                <div class='card mb-4'>
                <img src='seller/product_images/$product_image1' class='card-img-top' alt='...'>
                    <div class='card-body text-center'>
                        <h5 class='card-title'>$product_title</h5>
                        <p class='card-text'>$product_description</p>
                        <hr>
                        <p class='card-text fw-bold'> Rs. $product_price </p>
                        <a href='index.php?add_to_cart=$product_id' class='text-center btn btn-add-cart'>Add to Cart</a>
                    </div>
                </div>
            </div>";
         }
}
}


//Getting unique brands

function getUniqueBrands(){

    global $conn;

    if(isset($_GET['brand'])){

    $brand_id = $_GET['brand'];

    $select_query = "SELECT * FROM `products` WHERE brand_id = $brand_id";
    $result_query = mysqli_query($conn,$select_query);
    $num_of_rows = mysqli_num_rows($result_query);
    if($num_of_rows == 0){
        echo "<div class='container text-center d-flex align-items-center justify-content-center'>
        <div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
        <h4><strong><i class='fa-solid fa-triangle-exclamation me-2'></i></strong>This brand is not available!</h4>
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
</div>";
    }

         while($row = mysqli_fetch_assoc($result_query)){
          $product_id = $row['product_id'];
          $product_title = $row['product_title'];
          $product_description = $row['product_description'];
          $product_image1 = $row['product_image1'];
          $product_price = $row['product_price'];
          $category_id = $row['category_id'];
          $brand_id = $row['brand_id'];

          echo "<div class='col'>
                <div class='card mb-4'>
                <img src='seller/product_images/$product_image1' class='card-img-top' alt='...'>
                    <div class='card-body text-center'>
                        <h5 class='card-title'>$product_title</h5>
                        <p class='card-text'>$product_description</p>
                        <hr>
                        <p class='card-text fw-bold'> Rs. $product_price </p>
                        <a href='index.php?add_to_cart=$product_id' class='text-center btn btn-add-cart'>Add to Cart</a>
                    </div>
                </div>
            </div>";
         }
}
}


//Displaying brands in sidenav

function getBrands(){
    
    global $conn; 

    $select_brands = "SELECT * FROM `brands`";
            $result_brands = mysqli_query($conn, $select_brands);
            // $row_data = mysqli_fetch_assoc($result_brands);
            // echo $row_data['brand_title']; fetches only first record 
            while($row_data = mysqli_fetch_assoc($result_brands)){
              $brand_title = $row_data['brand_title'];
              $brand_id = $row_data['brand_id'];
              echo "<li class='nav-item text-center'>
                      <a class='nav-link active' href='index.php?brand=$brand_id'>$brand_title</a>
                    </li>";
            }
}

// Displaying categories in sidenav

function getCategories(){

    global $conn;

    $select_categories = "SELECT * FROM `categories`";
            $result_categories = mysqli_query($conn, $select_categories);
            while($row_data = mysqli_fetch_assoc($result_categories)){
              $category_title = $row_data['category_title'];
              $category_id = $row_data['category_id'];
              echo "<li class='nav-item text-center'>
                      <a class='nav-link active' href='index.php?category=$category_id'>$category_title</a>
                    </li>";
            }
}

//searching products function 

function searchProduct(){
    global $conn;

    if(isset($_GET['search_data_product'])){

        $search_data_value = $_GET['search_data'];

    $search_query = "SELECT * FROM `products` WHERE product_keywords LIKE '%$search_data_value%'";
    $result_query = mysqli_query($conn, $search_query);
    $num_of_rows = mysqli_num_rows($result_query);
    if($num_of_rows == 0){
        echo "<div class='container text-center d-flex align-items-center justify-content-center'>
        <div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
        <h4><strong><i class='fa-solid fa-triangle-exclamation me-2'></i></strong>No record found!</h4>
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
</div>";
    }

    while($row = mysqli_fetch_assoc($result_query)){
          $product_id = $row['product_id'];
          $product_title = $row['product_title'];
          $product_description = $row['product_description'];
          $product_image1 = $row['product_image1'];
          $product_price = $row['product_price'];
          $category_id = $row['category_id'];
          $brand_id = $row['brand_id'];

          echo "<div class='col'>
                <div class='card mb-4'>
                <a href='product_details.php?product_id=".$product_id."'>
                <img src='seller/product_images/$product_image1' class='card-img-top' alt='...'>
                </a>
                    <div class='card-body text-center'>
                        <h5 class='card-title'>$product_title</h5>
                        <p class='card-text'>$product_description</p>
                        <hr>
                        <p class='card-text fw-bold'> Rs. $product_price </p>
                        <a href='index.php?add_to_cart=$product_id' class='text-center btn btn-add-cart'>Add to Cart</a>
                    </div>
                </div>
            </div>";
 
        }       
    }
}

function viewDetails(){
    global $conn;

    if(isset($_GET['product_id'])){

    if(!isset($_GET['category'])){
        if(!isset($_GET['brand'])){

            $id_product = $_GET['product_id'];

    $select_query = "SELECT * FROM `products` WHERE product_id = $id_product";
         $result_query = mysqli_query($conn,$select_query);
         while($row = mysqli_fetch_assoc($result_query)){
          $product_id = $row['product_id'];
          $product_title = $row['product_title'];
          $seller_id = $row['seller_id'];
          $product_description = $row['product_description'];
          $product_image1 = $row['product_image1'];
          $product_image2 = $row['product_image2'];
          $product_image3 = $row['product_image3'];
          $product_price = $row['product_price'];
          $product_condition = $row['product_condition'];
          $category_id = $row['category_id'];
          $brand_id = $row['brand_id'];

          $select_seller = "SELECT * FROM `sellers` WHERE seller_id = $seller_id";
         $result_seller = mysqli_query($conn,$select_seller);
         $row_seller = mysqli_fetch_assoc($result_seller);
         $seller_pic = $row_seller['seller_image'];
         $seller_email = $row_seller['seller_email'];

          echo "<div class='col-lg-5 col-12 mt-lg-5'>
          <div id='carouselExampleControlsNoTouching' class='carousel slide' data-bs-touch='false' data-bs-interval='false'>
  <div class='carousel-inner'>
    <div class='carousel-item active'>
      <img src='seller/product_images/$product_image1' class='d-block w-100' alt='...'>
    </div>
    <div class='carousel-item'>
      <img src='seller/product_images/$product_image2' class='d-block w-100' alt='...'>
    </div>
    <div class='carousel-item'>
      <img src='seller/product_images/$product_image3' class='d-block w-100' alt='...'>
    </div>
  </div>
  <button class='carousel-control-prev' type='button' data-bs-target='#carouselExampleControlsNoTouching' data-bs-slide='prev'>
    <span class='carousel-control-prev-icon' aria-hidden='true'></span>
    <span class='visually-hidden'>Previous</span>
  </button>
  <button class='carousel-control-next' type='button' data-bs-target='#carouselExampleControlsNoTouching' data-bs-slide='next'>
    <span class='carousel-control-next-icon' aria-hidden='true'></span>
    <span class='visually-hidden'>Next</span>
  </button>
</div> 
          </div>
          
          <div = 'col-lg-5 mt-lg-5'>
          <div class='text-center'>
          <h3 style='text-transform:uppercase; font-weight: 800'>$product_title</h3>
          <br>
          <h4 style='font-weight: 700'>Rs. $product_price</h4>
          <br>
          <h5 style='text-transform:uppercase;'>Product Description</h5>
          <p>$product_description</p>
          <br>
          <h5>Product Condition : $product_condition</h5>
          <br>

          <a href='index.php?add_to_cart=$product_id' class='text-center btn btn-add-cart'>Add to Cart</a>
          <div class='pt-5'>
          <strong>Owner:</strong> 
          <br>
          <img src='seller/seller_images/$seller_pic' class='owner-pic' alt='Seller Image'>
          <div>$seller_email</div>
          </div>

          </div>";
         }
}
}
}
}

//get ip address function

function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  
// $ip = getIPAddress();  
// echo 'User Real IP Address - '.$ip;  

//cart function 

function cart(){

    global $conn;

    if(isset($_GET['add_to_cart'])){
        $get_ip_add = getIPAddress();
        $get_product_id = $_GET['add_to_cart'];
        $select_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add' AND product_id=$get_product_id";
        $result_query = mysqli_query($conn,$select_query);
        $num_of_rows = mysqli_num_rows($result_query);
        if($num_of_rows > 0){
            echo "<script>window.alert('This item is already present inside the cart!')</script>";
            echo "<script>window.open('index.php', '_self')</script>";
        }
        else{
            $insert_query = "INSERT INTO `cart_details` (product_id, ip_address, quantity) VALUES ($get_product_id, '$get_ip_add', 1)";
            $result_query = mysqli_query($conn,$insert_query);
            echo "<script>window.alert('Item added to cart!')</script>";
            echo "<script>window.open('index.php', '_self')</script>";
        }
    }
}

// function to get cart item number 
function cartItems(){
    global $conn;

    if(isset($_GET['add_to_cart'])){
        $get_ip_add = getIPAddress();
        $select_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
        $result_query = mysqli_query($conn,$select_query);
        $count_cart_items = mysqli_num_rows($result_query);
    }
    else{
        $get_ip_add = getIPAddress();
        $select_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
        $result_query = mysqli_query($conn,$select_query);
        $count_cart_items = mysqli_num_rows($result_query);
    }
    echo $count_cart_items;
}

//total price function 

function totalCartPrice(){
    global $conn;
    $get_ip_add = getIPAddress();
    $total_price=0;

    $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
    $result_query = mysqli_query($conn, $cart_query);
    while($row = mysqli_fetch_array($result_query)){
        $product_id = $row['product_id'];
        $select_products = "SELECT * FROM `products` WHERE product_id='$product_id'";
        $result_products = mysqli_query($conn, $select_products);
        while($row_product_price = mysqli_fetch_assoc($result_products)){
            $product_price = $row_product_price['product_price'];
            $cart_quantity = $row['quantity'];
            $product_total_price = $product_price * $cart_quantity;
            $total_price += $product_total_price;
        }
    }
    echo $total_price;
}

//get user order details

function getUserOrderDetails(){
    global $conn;
    $email = $_SESSION['email'];
    $get_details = "SELECT * from `users` WHERE user_email = '$email'";
    $result_details = mysqli_query($conn, $get_details);
    while($row_query = mysqli_fetch_assoc($result_details)){
        $user_id = $row_query['user_id'];
        if(isset($_GET['pending_orders'])){
            $get_orders = "SELECT * FROM `user_orders` WHERE user_id = $user_id AND order_status = 'pending'";
            $get_result = mysqli_query($conn, $get_orders);
            $row_count = mysqli_num_rows($get_result);

            if($row_count > 0){
                // Handle pluralization based on order count
                $order_text = ($row_count == 1) ? "order" : "orders";
                echo "<h2 class='text-center mt-5 pt-5'>You have $row_count $order_text pending!</h2>";
                echo "<p class='text-center'><a href='profile.php?my_orders'>Order Details</a></p>";
            }
            else{
                echo "<h2 class='text-center mt-5 pt-5'>You have no orders yet!</h2>";
                echo "<p class='text-center'><a href='../index.php'>Explore Products</a></p>";
            }
        }
    }
}

function getReviews(){

    if(isset($_GET["product_id"])){
        $product_id = $_GET["product_id"];
      }


    global $conn; 

    $sql = "SELECT * FROM reviews WHERE product_id = $product_id";
$result = mysqli_query($conn, $sql);
if(!$result){
echo mysqli_error($conn);
}

while($row = mysqli_fetch_assoc($result)) {
  $review_id = $row['review_id'];
  $user_id = $row['user_id'];
  $rating = $row['rating'];
  $message = $row['message'];
  $date = $row['date'];

  $get_pic = "SELECT * from `users` WHERE user_id = $user_id";
  $result_pic = mysqli_query($conn, $get_pic);
  $row_pic = mysqli_fetch_assoc($result_pic);
  $user_img = $row_pic['user_image'];
  $user_email = $row_pic['user_email'];

  echo " <hr>
  <div class='row'>

  <div class='col-1'>
  <img src='users/user_images/$user_img' class='review_img'>
  </div>

  <div class='col-6 d-flex justify-content-center'>
                <div class='card mb-2' style= 'width: 500px; padding-top:0'>
                    <div class='card-header'>
                    $user_email
                    </div>
                    <div class='card-body'>";
                        
                    // Filled stars
                for($i = 0; $i < $rating ; $i++) {
                    echo '<i class="fa fa-star text-warning main_star mr-1"></i>';
                }

                // Remaining empty stars
                $remaining_stars = 5 - floor($rating);
                for($i = 0; $i < $remaining_stars; $i++) {
                    echo '<i class="fa fa-star star-light main_star mr-1"></i>';
                }
                        
                        echo "<p class='card-text'>$message</p>";
                        if(isset($_SESSION['email'])) {
                            if($_SESSION['email'] == $user_email) {
                                echo "<form method='post' action=''>
                                        <input type='hidden' name='review_id' value='$review_id'>
                                        <button type='submit' class='text-center btn btn-danger btn-sm' name='delete_review'>
                                            Delete <i class='fa-solid fa-trash'></i>
                                        </button>
                                      </form>";
                            }
                        }
                        
                        
                        
                        

                    echo "</div> 
                    <div class='card-footer'>
                    $date
                    </div>

                </div>
            </div>
            
            </div>";
}
}


function deleteReview($review_id) {
    global $conn;

    $sql = "DELETE FROM reviews WHERE review_id = $review_id";
    if (mysqli_query($conn, $sql)) {
        echo "Review deleted successfully";
    } else {
        echo "Error deleting review: " . mysqli_error($conn);
    }
}

?>