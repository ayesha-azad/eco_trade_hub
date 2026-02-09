<h2 style="color: #0A1F44; font-weight: 800" class="text-center my-5">EDIT PRODUCT</h2>

<!-- form  -->

<?php 
if(isset($_GET['edit_product'])){
    $product_id = $_GET['edit_product'];
}

$get_products = "SELECT * FROM `products` WHERE product_id = $product_id";
    $result = mysqli_query($conn, $get_products);
    $row = mysqli_fetch_assoc($result);
    $product_title = $row['product_title'];
    $product_owner = $row['product_owner'];
    $product_description = $row['product_description'];
    $product_keywords = $row['product_keywords'];
    $category_id = $row['category_id'];
    $brand_id = $row['brand_id'];
    $product_image1 = $row['product_image1'];
    $product_image2 = $row['product_image2'];
    $product_image3 = $row['product_image3'];
    $product_price = $row['product_price'];
    $product_condition = $row['product_condition'];
    $status = $row['status'];
?>

<div class="row d-flex justify-content-center">
<form class="row g-3 needs-validation mb-5 col-lg-6" method="post" enctype="multipart/form-data" novalidate>

  <div class="form-group">
    <label for="product_title" class="form-label">Product Title</label>
    <input type="text" class="form-control" id="product_title" name="product_title" value="<?php echo $product_title; ?>" required>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>

  <input type="hidden" name="product_owner" value="<?php echo $product_owner; ?>" required>

  <div class="form-group">
    <label for="description" class="form-label">Product Description</label>
    <input type="text" class="form-control" id="product_description" name="product_description" value="<?php echo $product_description; ?>" required>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>

  <div class="form-group">
    <label for="product_keywords" class="form-label">Product Keywords</label>
    <div class="input-group has-validation">
      <input type="text" class="form-control" name="product_keywords" id="product_keywords" aria-describedby="inputGroupPrepend" value="<?php echo $product_keywords; ?>" required>
      <div class="invalid-feedback">
        Please enter product keywords.
      </div>
    </div>
  </div>

  <div class="form-group">
  <select class="form-select" name="product_categories" aria-label="Default select example">
  <?php 

$select_cat = "SELECT * FROM `categories` WHERE category_id = $category_id";
  $result_cat = mysqli_query($conn, $select_cat);
  $row_cat = mysqli_fetch_assoc($result_cat);
  $cat_title = $row_cat['category_title'];
  $cat_id = $row_cat['category_id'];
?>
  <option value="<?php echo $cat_id; ?>" selected><?php echo $cat_title; ?></option>
  <?php 
  $select_categories = "SELECT * FROM `categories`";
  $result_categories = mysqli_query($conn, $select_categories);
  while($row_data = mysqli_fetch_assoc($result_categories)){
    $cate_title = $row_data['category_title'];
    $cate_id = $row_data['category_id'];
    echo "<option value='$cate_id'>$cate_title</option>";
  }
  ?>
</select>
  </div>

  <div class="form-group">
  <select class="form-select" name="product_brands" aria-label="Default select example">

  <?php 

$select_br = "SELECT * FROM `brands` WHERE brand_id = $brand_id";
  $result_br = mysqli_query($conn, $select_br);
  $row_br = mysqli_fetch_assoc($result_br);
  $br_title = $row_br['brand_title'];
  $br_id = $row_br['brand_id'];
?>

<option value="<?php echo $br_id; ?>" selected><?php echo $br_title; ?></option>

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
      <img class="edit-img" src="product_images/<?php echo $product_image1 ?>" alt="">
      <div class="invalid-feedback">
        Please add product image 1.
      </div>
    </div>
  </div>

  <div class="form-group">
    <label for="product_image2" class="form-label">Product Image 2</label>
    <div class="input-group has-validation">
      <input type="file" class="form-control" name="product_image2" id="product_image2" required>
      <img class="edit-img" src="product_images/<?php echo $product_image2 ?>" alt="">
      <div class="invalid-feedback">
        Please add product image 2.
      </div>
    </div>
  </div>

  <div class="form-group">
    <label for="product_image3" class="form-label">Product Image 3</label>
    <div class="input-group has-validation">
      <input type="file" class="form-control" name="product_image3" id="product_image3" required>
      <img class="edit-img" src="product_images/<?php echo $product_image3 ?>" alt="">
      <div class="invalid-feedback">
        Please add product image 3.
      </div>
    </div>
  </div>

  <div class="form-group">
    <label for="product_price" class="form-label">Product Price</label>
    <div class="input-group has-validation">
      <input type="text" class="form-control" name="product_price" id="product_price" value="<?php echo $product_price; ?>" required>
      <div class="invalid-feedback">
        Please enter product price.
      </div>
    </div>
  </div>

  <select class="form-select" name="product_condition" aria-label="Default select example">
  <option selected value="<?php echo $product_condition; ?>"><?php echo $product_condition; ?></option>
  <option value="Excellent">Excellent</option>
  <option value="Good">Good</option>
  <option value="Satisfactory">Satisfactory</option>
</select>


  <div class="text-center">
    <input class="btn btn-panel text-white" name="insert_product" type="submit"  value="Update"/>
  </div>
</form>
</div>

<?php
if (isset($_POST['insert_product'])) {
    $product_title = $_POST['product_title'];
    $product_owner = $_POST['product_owner'];
    $product_description = $_POST['product_description'];
    $product_keywords = $_POST['product_keywords'];
    $product_category = $_POST['product_categories'];
    $product_brand = $_POST['product_brands'];
    $product_price = $_POST['product_price'];
    $product_condition = $_POST['product_condition'];

    if($product_title == "" or $product_description == "" or $product_keywords == "" or $product_category == "" or $product_brand == "" or $product_price == "" or $product_image1 == "" or $product_image2 == "" or $product_image3 == "" or $product_condition == ""){
        echo "<script>window.alert('Please fill all the fields')</script>";
        exit();
      } 
    
    // Access images
    $image_names = ['product_image1', 'product_image2', 'product_image3'];
    $uploaded_images = [];

    foreach ($image_names as $key => $image_name) {
        if (!empty($_FILES[$image_name]['name'])) {
            $uploaded_images[$key] = $_FILES[$image_name]['name'];
            move_uploaded_file($_FILES[$image_name]['tmp_name'], "product_images/" . $uploaded_images[$key]);
        } else {
            // Keep existing image filename if a new image wasn't uploaded
            $uploaded_images[$key] = ${$image_name}; 
        }
    }

    // Assign uploaded image variables for the update query
    [$product_image1, $product_image2, $product_image3] = $uploaded_images;

    // Update query
    $update_product = "UPDATE `products` 
                       SET product_title = '$product_title',
                           product_owner = '$product_owner',
                           product_description = '$product_description',
                           product_keywords = '$product_keywords',
                           category_id = '$product_category',
                           brand_id = '$product_brand',
                           product_image1 = '$product_image1',
                           product_image2 = '$product_image2',
                           product_image3 = '$product_image3',
                           product_price = '$product_price',
                           product_condition = '$product_condition'
                       WHERE product_id = $product_id";

    $result_query = mysqli_query($conn, $update_product);
    if ($result_query) {
        echo "<script>alert('Product updated successfully!'); window.location.href = 'index.php?view_products';</script>";
    }
}
?>
