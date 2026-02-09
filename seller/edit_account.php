<?php
@session_start();


                $seller_email = $_SESSION['seller_email'];
                $select_user = "SELECT * FROM `sellers` where seller_email = '$seller_email'";
                $result_select = mysqli_query($conn, $select_user);
                $row = mysqli_fetch_assoc($result_select);
                $seller_id  = $row['seller_id'];
                $sellername = $row['sellername'];
                $seller_password = $row['seller_password'];
                $seller_image = $row['seller_image'];
                $seller_address = $row['seller_address'];
                $seller_mobile = $row['seller_mobile'];
?>

<div class="container">

<h2 style="color: #0A1F44; font-weight: 800" class="text-center my-3">EDIT ACCOUNT</h2>

<!-- form  -->

<div class="row d-flex justify-content-center">
<form class="row g-3 needs-validation mb-3 col-lg-6" method="post" enctype="multipart/form-data" novalidate>

  <div class="form-group">
    <label for="sellername" class="form-label">Username</label>
    <input type="text" class="form-control" id="sellername" name="sellername" placeholder="Enter your username" value = "<?php echo $sellername; ?>" required>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>

  <div class="form-group">
    <label for="seller_email" class="form-label">Email</label>
    <input type="text" class="form-control" id="seller_email" name="seller_email" placeholder="Enter your email" value = "<?php echo $seller_email; ?>" required readonly>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>

  <div class="form-group">
    <label for="seller_image" class="form-label">User Image</label>
    <div class="input-group">
      <input type="file" class="form-control" name="seller_image" id="seller_image">
      <img class="edit-img" src="seller_images/<?php echo $seller_image ?>" alt="">
    </div>
  </div>

  <div class="form-group">
    <label for="seller_password" class="form-label">Password</label>
    <input type="password" class="form-control" id="seller_password" name="seller_password" placeholder="Enter your password" value = "<?php echo $seller_password; ?>" required>
    <div class="invalid-feedback">
      Please enter password!
    </div>
  </div>

  <div class="form-group">
    <label for="seller_address" class="form-label">Address</label>
    <input type="text" class="form-control" id="seller_address" name="seller_address" placeholder="Enter your address" value = "<?php echo $seller_address; ?>" required>
    <div class="invalid-feedback">
      Password enter your address!
    </div>
  </div>

  <div class="form-group">
    <label for="seller_mobile" class="form-label">Contact</label>
    <div class="input-group has-validation">
      <input type="text" class="form-control" name="seller_mobile" id="seller_mobile" placeholder="Enter your contact" value = "<?php echo $seller_mobile; ?>" required>
      <div class="invalid-feedback">
        Please enter your contact number!
      </div>
    </div>
  </div>

  <div class="text-center mb-3">
    <input class="btn btn-panel text-white" name="user_update" type="submit"  value="Update"/>
  </div>
</form>
</div>

</div>

<?php 

if(isset($_POST['user_update'])){
  $sellername = $_POST['sellername'];
  $seller_email = $_POST['seller_email'];
  $seller_password = $_POST['seller_password'];
  $seller_address = $_POST['seller_address'];
  $seller_mobile = $_POST['seller_mobile'];

  //accessing images 
  $new_user_image = $_FILES['seller_image']['name'];

  //accessing image tmp name 
  $new_temp_image = $_FILES['seller_image']['tmp_name'];
  
  // checking empty condition
  if($new_user_image == ""){
    $new_user_image = $seller_image;
  } 
  else{
        move_uploaded_file($new_temp_image, "seller_images/$new_user_image");
   }

    //update query 
    $update_user = "UPDATE `sellers` SET sellername = '$sellername', seller_email = '$seller_email', seller_password = '$seller_password', seller_image = '$new_user_image', seller_address = '$seller_address', seller_mobile = '$seller_mobile' WHERE seller_id = $seller_id";
    $result_query = mysqli_query($conn, $update_user);
    if($result_query){
      echo "<script>window.alert('Seller updated successfully!')</script>";
      echo "<script>window.open('../logout.php', '_self');</script>";
    }
}


?>