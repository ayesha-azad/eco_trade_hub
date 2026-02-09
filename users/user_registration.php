<?php
@session_start();
?>

<div class="container-fluid main-body">

<h2 style="color: #0A1F44; font-weight: 800" class="text-center mt-5 mb-2">NEW USER REGISTRATION</h2>

<!-- form  -->

<div class="row d-flex justify-content-center">
<form class="row g-3 needs-validation mb-3 col-lg-6" method="post" enctype="multipart/form-data" novalidate>

  <div class="form-group">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>

  <div class="form-group">
    <label for="user_email" class="form-label">Email</label>
    <input type="text" class="form-control" id="user_email" name="user_email" placeholder="Enter your email" required>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>

  <div class="form-group">
    <label for="user_image" class="form-label">User Image</label>
    <div class="input-group has-validation">
      <input type="file" class="form-control" name="user_image" id="user_image" required>
      <div class="invalid-feedback">
        Please add user image.
      </div>
    </div>
  </div>

  <div class="form-group">
    <label for="user_password" class="form-label">Password</label>
    <input type="password" class="form-control" id="user_password" name="user_password" placeholder="Enter your password" required>
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
    <label for="user_address" class="form-label">Address</label>
    <input type="text" class="form-control" id="user_address" name="user_address" placeholder="Enter your address" required>
    <div class="invalid-feedback">
      Password enter your address!
    </div>
  </div>

  <div class="form-group">
    <label for="user_mobile" class="form-label">Contact</label>
    <div class="input-group has-validation">
      <input type="text" class="form-control" name="user_mobile" id="user_mobile" placeholder="Enter your contact" required>
      <div class="invalid-feedback">
        Please enter your contact number!
      </div>
    </div>
  </div>

  <div class="text-center">
    <input class="btn btn-panel text-white" name="user_register" type="submit"  value="Register"/>
    <p class="mt-2">Already have an account? <a href="http://localhost/eco_trade_hub/login.php?user_login">Login</a></p>
  </div>
</form>
</div>

</div>

<?php 

  //accessing ip address
  $get_ip_add = getIPAddress();

if(isset($_POST['user_register'])){
  $user_username = $_POST['username'];
  $user_email = $_POST['user_email'];
  $user_password = $_POST['user_password'];
  $conf_user_password = $_POST['conf_user_password'];
  $user_address = $_POST['user_address'];
  $user_mobile = $_POST['user_mobile'];
  $user_status = 'pending';


  //accessing images 
  $user_image = $_FILES['user_image']['name'];

  //accessing image tmp name 
  $temp_image = $_FILES['user_image']['tmp_name'];
  
  // checking empty condition
  if($user_username == "" or $user_email == "" or $user_password == "" or $conf_user_password == "" or $user_mobile == "" or $user_status == "" or $user_image == "" or $user_address == ""){
    echo "<script>window.alert('Please fill all the fields')</script>";
    exit();
  } 
  else if($user_password != $conf_user_password){
    echo "<script>window.alert('Password and confirm password should be same!')</script>";
      exit();
   }
    else{

      //select query 

      $select_users = "SELECT * FROM `users` where user_email = '$user_email'";
      $result_select = mysqli_query($conn, $select_users);
      $result_rows = mysqli_num_rows($result_select);
      if($result_rows > 0){
        echo "<script>window.alert('Account with the same email already exists!')</script>";
      }
      else{
        move_uploaded_file($temp_image, "users/user_images/$user_image");

        //insert query 
        $insert_user = "INSERT INTO `users` (username, user_email, user_password, user_image, user_ip, user_address, user_mobile, status) VALUES ('$user_username', '$user_email', '$user_password', '$user_image', '$get_ip_add', '$user_address', '$user_mobile', '$user_status')";
    
        $result_query = mysqli_query($conn, $insert_user);
        if($result_query){
          echo "<script>window.alert('User added successfully!')</script>";
          echo "<script>window.location.reload();</script>";
        }
      }
  }

//selecting cart items to tell user they have something in the cart

$select_user_cart = "SELECT * FROM `cart_details` where ip_address = '$get_ip_add'";
$result_select_cart = mysqli_query($conn, $select_user_cart);
$result_rows_cart = mysqli_num_rows($result_select_cart);
if($result_rows_cart > 0){
  $_SESSION['username'] =  $user_username;
  $_SESSION['email'] =  $user_email;
  
  echo "<script>window.alert('You have items in the cart!')</script>";
  echo "<script>window.open('users/checkout.php', '_self')</script>";
}
else{
  echo "<script>window.open('../index.php', '_self')</script>";
}

}


?>