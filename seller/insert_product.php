<?php 
include('../includes/connect.php');
session_start();
if(!isset($_SESSION['sellername'])){
  header("location:../login.php?seller_login");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="icon" type="image/png" href="assets/favicon.png" sizes="32x32">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" 
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>
      if(window.history.replaceState){
        window.history.replaceState(null, null, window.location.href);
      }
    </script>
</head>
<body>

<!-- Navbar  -->

<div class="container-fluid">
  <nav class="navbar navbar-expand navbar-dark bg-dark upper-nav fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><img src="assets/favicon.png" alt=""></a>
      <ul class="navbar-nav mb-2 mb-lg-0 me-auto">
      <li class="nav-item">
          <a class="nav-link disabled" aria-current="page">Welcome <?php echo $_SESSION['sellername']; ?></a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="index.php" aria-current="page">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="insert_product.php">Insert Products</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="messages.php">Chat with Buyers <i class="fa-solid fa-comments text-light"></i></a>
        </li>
        
      </ul>

      <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
        <li class="nav-item">
          <a class="nav-link active btn btn-outline-danger mx-2" href="../logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </nav>
</div>

<div class="container-fluid main-body">

<h2 style="color: #0A1F44; font-weight: 800" class="text-center mt-5 mb-5">INSERT PRODUCTS</h2>

<!-- form  -->

<div class="row d-flex justify-content-center">
<form class="row g-3 needs-validation mb-5 col-lg-6" method="post" enctype="multipart/form-data" novalidate>

  <div class="form-group">
    <label for="product_title" class="form-label">Product Title</label>
    <input type="text" class="form-control" id="product_title" name="product_title" placeholder="Enter product title" required>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>

  <div class="form-group">
    <label for="description" class="form-label">Product Description</label>
    <input type="text" class="form-control" id="product_description" name="product_description" placeholder="Enter product description" required>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>

  <div class="form-group">
    <label for="product_keywords" class="form-label">Product Keywords</label>
    <div class="input-group has-validation">
      <input type="text" class="form-control" name="product_keywords" id="product_keywords" aria-describedby="inputGroupPrepend" placeholder="Enter product keywords" required>
      <div class="invalid-feedback">
        Please enter product keywords.
      </div>
    </div>
  </div>

  <div class="form-group">
  <select class="form-select" name="product_categories" aria-label="Default select example">
  <option selected>Select a Category</option>
  <?php 
  $select_categories = "SELECT * FROM `categories`";
  $result_categories = mysqli_query($conn, $select_categories);
  while($row_data = mysqli_fetch_assoc($result_categories)){
    $category_title = $row_data['category_title'];
    $category_id = $row_data['category_id'];
    echo "<option value='$category_id'>$category_title</option>";
  }
  ?>
</select>
  </div>

  <div class="form-group">
  <select class="form-select" name="product_brands" aria-label="Default select example">
  <option selected>Select a Brand</option>
  <?php 
$select_brands = "SELECT * FROM `brands`";
$result_brands = mysqli_query($conn, $select_brands);
// $row_data = mysqli_fetch_assoc($result_brands);
// echo $row_data['brand_title']; fetches only first record 
while($row_data = mysqli_fetch_assoc($result_brands)){
  $brand_title = $row_data['brand_title'];
  $brand_id = $row_data['brand_id'];
  echo "<option value='$brand_id'>$brand_title</option>";
}
  ?>
</select>
  </div>

  <div class="form-group">
    <label for="product_image1" class="form-label">Product Image 1</label>
    <div class="input-group has-validation">
      <input type="file" class="form-control" name="product_image1" id="product_image1" required>
      <div class="invalid-feedback">
        Please add product image 1.
      </div>
    </div>
  </div>

  <div class="form-group">
    <label for="product_image2" class="form-label">Product Image 2</label>
    <div class="input-group has-validation">
      <input type="file" class="form-control" name="product_image2" id="product_image2" required>
      <div class="invalid-feedback">
        Please add product image 2.
      </div>
    </div>
  </div>

  <div class="form-group">
    <label for="product_image3" class="form-label">Product Image 3</label>
    <div class="input-group has-validation">
      <input type="file" class="form-control" name="product_image3" id="product_image3" required>
      <div class="invalid-feedback">
        Please add product image 3.
      </div>
    </div>
  </div>

  <div class="form-group">
    <label for="product_price" class="form-label">Product Price</label>
    <div class="input-group has-validation">
      <input type="text" class="form-control" name="product_price" id="product_price" placeholder="Enter product price" required>
      <div class="invalid-feedback">
        Please enter product price.
      </div>
    </div>
  </div>

  <select class="form-select" name="product_condition" aria-label="Default select example">
  <option selected>Select Product Condition</option>
  <option value="Excellent">Excellent</option>
  <option value="Good">Good</option>
  <option value="Satisfactory">Satisfactory</option>
</select>


  <div class="text-center">
    <input class="btn btn-panel text-white" name="insert_product" type="submit"  value="Submit"/>
  </div>
</form>
</div>



</div>

<?php
if(isset($_POST['insert_product'])){

  $seller = $_SESSION['seller_email'];
  $select_owner = "SELECT * FROM sellers WHERE seller_email = '$seller'";
  $result_seller = mysqli_query($conn, $select_owner);
  $row_seller = mysqli_fetch_assoc($result_seller);

  $product_title = $_POST['product_title'];
  $seller_id = $row_seller['seller_id'];
  $product_description = $_POST['product_description'];
  $product_keywords = $_POST['product_keywords'];
  $product_category = $_POST['product_categories'];
  $product_brand = $_POST['product_brands'];
  $product_price = $_POST['product_price'];
  $product_condition = $_POST['product_condition'];
  $product_status = 'true';

  //accessing images 
  $product_image1 = $_FILES['product_image1']['name'];
  $product_image2 = $_FILES['product_image2']['name'];
  $product_image3 = $_FILES['product_image3']['name'];

  //accessing image tmp name 
  $temp_image1 = $_FILES['product_image1']['tmp_name'];
  $temp_image2 = $_FILES['product_image2']['tmp_name'];
  $temp_image3 = $_FILES['product_image3']['tmp_name'];
  
  // checking empty condition
  if($product_title == "" or $product_description == "" or $product_keywords == "" or $product_category == "" or $product_brand == "" or $product_price == "" or $product_image1 == "" or $product_image2 == "" or $product_image3 == "" or $product_condition == ""){
    echo "<script>window.alert('Please fill all the fields')</script>";
    exit();
  } 
  else{
    move_uploaded_file($temp_image1, "./product_images/$product_image1");
    move_uploaded_file($temp_image2, "./product_images/$product_image2");
    move_uploaded_file($temp_image3, "./product_images/$product_image3");

    //insert query 
    $insert_product = "INSERT INTO `products` (product_title, seller_id, product_description, product_keywords, category_id, brand_id, product_image1, product_image2, product_image3, product_price, product_condition, date, status) VALUES ('$product_title', $seller_id, '$product_description', '$product_keywords', '$product_category', '$product_brand', '$product_image1', '$product_image2', '$product_image3', '$product_price', '$product_condition', NOW(), '$product_status')";

    $result_query = mysqli_query($conn, $insert_product);
    if($result_query){
      echo "<script>window.alert('Product added successfully!')</script>";
      echo "<script>window.location.reload();</script>";
    }
  }

}

?>


<script src="../includes/formValid.js"></script>
<?php 
include(__DIR__ . "/../includes/footer.php");
?>