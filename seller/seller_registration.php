<?php
@session_start();
?>

<div class="container-fluid main-body">

<h2 style="color: #0A1F44; font-weight: 800" class="text-center mt-5 mb-2">NEW SELLER REGISTRATION</h2>

<!-- form  -->

<div class="row d-flex justify-content-center">
<form class="row g-3 needs-validation mb-3 col-lg-6" method="post" enctype="multipart/form-data" novalidate>

  <div class="form-group">
    <label for="sellername" class="form-label">Username</label>
    <input type="text" class="form-control" id="sellername" name="sellername" placeholder="Enter your name" required>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>

  <div class="form-group">
    <label for="seller_email" class="form-label">Email</label>
    <input type="text" class="form-control" id="seller_email" name="seller_email" placeholder="Enter your email" required>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>

  <div class="form-group">
    <label for="seller_image" class="form-label">User Image</label>
    <div class="input-group has-validation">
      <input type="file" class="form-control" name="seller_image" id="seller_image" required>
      <div class="invalid-feedback">
        Please add seller image.
      </div>
    </div>
  </div>

  <div class="form-group">
    <label for="seller_password" class="form-label">Password</label>
    <input type="password" class="form-control" id="seller_password" name="seller_password" placeholder="Enter your password" required>
    <div class="invalid-feedback">
      Please enter password!
    </div>
  </div>

  <div class="form-group">
    <label for="conf_user_password" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="conf_user_password" name="conf_user_password" placeholder="Confirm Password" required>
    <div class="invalid-feedback">
      Password and confirm password should be same!
    </div>
  </div>

  <div class="form-group">
    <label for="seller_address" class="form-label">Address</label>
    <input type="text" class="form-control" id="seller_address" name="seller_address" placeholder="Enter your address" required>
    <div class="invalid-feedback">
      Password enter your address!
    </div>
  </div>

  <div class="form-group">
    <label for="seller_mobile" class="form-label">Contact</label>
    <div class="input-group has-validation">
      <input type="text" class="form-control" name="seller_mobile" id="seller_mobile" placeholder="Enter your contact" required>
      <div class="invalid-feedback">
        Please enter your contact number!
      </div>
    </div>
  </div>

  <div class="text-center">
    <input class="btn btn-panel text-white" name="seller_register" type="submit"  value="Register"/>
    <p class="mt-2">Already have an account? <a href="http://localhost/eco_trade_hub/login.php?seller_login">Login</a></p>
  </div>
</form>
</div>

</div>

<?php 

if(isset($_POST['seller_register'])){
  $sellername = $_POST['sellername'];
  $seller_email = $_POST['seller_email'];
  $seller_password = $_POST['seller_password'];
  $conf_user_password = $_POST['conf_user_password'];
  $seller_address = $_POST['seller_address'];
  $seller_mobile = $_POST['seller_mobile'];
  $status = 'pending';


  //accessing images 
  $seller_image = $_FILES['seller_image']['name'];

  //accessing image tmp name 
  $temp_image = $_FILES['seller_image']['tmp_name'];
  
  // checking empty condition
  if($sellername == "" or $seller_email == "" or $seller_password == "" or $conf_user_password == "" or $seller_mobile == "" or $status == "" or $seller_image == "" or $seller_address == ""){
    echo "<script>window.alert('Please fill all the fields')</script>";
    exit();
  } 
  else if($seller_password != $conf_user_password){
    echo "<script>window.alert('Password and confirm password should be same!')</script>";
      exit();
   }
    else{

      //select query 

      $select_users = "SELECT * FROM `sellers` where seller_email = '$seller_email'";
      $result_select = mysqli_query($conn, $select_users);
      $result_rows = mysqli_num_rows($result_select);
      if($result_rows > 0){
        echo "<script>window.alert('Account with the same email already exists!')</script>";
      }
      else{
        move_uploaded_file($temp_image, "seller/seller_images/$seller_image");

        //insert query 
        $insert_user = "INSERT INTO `sellers` (sellername, seller_email, seller_password, seller_image, seller_address, seller_mobile, status) VALUES ('$sellername', '$seller_email', '$seller_password', '$seller_image', '$seller_address', '$seller_mobile', '$status')";
    
        $result_query = mysqli_query($conn, $insert_user);
        if($result_query){
          echo "<script>window.alert('Seller added successfully!')</script>";
          echo "<script>window.location.reload();</script>";
        }
      }
  }

}


?>