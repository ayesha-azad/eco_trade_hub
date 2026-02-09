<?php
@session_start();
?>

<div class="container-fluid main-body">

<h2 style="color: #0A1F44; font-weight: 800" class="text-center my-3">EDIT ACCOUNT</h2>

<!-- form  -->

<div class="row d-flex justify-content-center">
<form class="row g-3 needs-validation mb-3 col-lg-6" method="post" enctype="multipart/form-data" novalidate>

  <div class="form-group">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" value = "<?php echo $username; ?>" required>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>

  <div class="form-group">
    <label for="user_email" class="form-label">Email</label>
    <input type="text" class="form-control" id="user_email" name="user_email" placeholder="Enter your email" value = "<?php echo $user_email; ?>" required readonly>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>

  <div class="form-group">
    <label for="user_image" class="form-label">User Image</label>
    <div class="input-group">
      <input type="file" class="form-control" name="user_image" id="user_image">
      <img class="edit-img" src="user_images/<?php echo $user_image ?>" alt="">
    </div>
  </div>

  <div class="form-group">
    <label for="user_password" class="form-label">Password</label>
    <input type="password" class="form-control" id="user_password" name="user_password" placeholder="Enter your password" value = "<?php echo $user_password; ?>" required>
    <div class="invalid-feedback">
      Please enter password!
    </div>
  </div>

  <div class="form-group">
    <label for="user_address" class="form-label">Address</label>
    <input type="text" class="form-control" id="user_address" name="user_address" placeholder="Enter your address" value = "<?php echo $user_address; ?>" required>
    <div class="invalid-feedback">
      Password enter your address!
    </div>
  </div>

  <div class="form-group">
    <label for="user_mobile" class="form-label">Contact</label>
    <div class="input-group has-validation">
      <input type="text" class="form-control" name="user_mobile" id="user_mobile" placeholder="Enter your contact" value = "<?php echo $user_mobile; ?>" required>
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
  $user_username = $_POST['username'];
  $user_email = $_POST['user_email'];
  $user_password = $_POST['user_password'];
  $user_address = $_POST['user_address'];
  $user_mobile = $_POST['user_mobile'];

  //accessing images 
  $new_user_image = $_FILES['user_image']['name'];

  //accessing image tmp name 
  $new_temp_image = $_FILES['user_image']['tmp_name'];
  
  // checking empty condition
  if($new_user_image == ""){
    $new_user_image = $user_image;
  } 
  else{
        move_uploaded_file($new_temp_image, "user_images/$new_user_image");
   }

    //update query 
    $update_user = "UPDATE `users` SET username = '$user_username', user_email = '$user_email', user_password = '$user_password', user_image = '$new_user_image', user_address = '$user_address', user_mobile = '$user_mobile' WHERE user_id = $user_id";
    $result_query = mysqli_query($conn, $update_user);
    if($result_query){
      echo "<script>window.alert('User updated successfully!')</script>";
      echo "<script>window.open('../logout.php', '_self');</script>";
    }
}


?>