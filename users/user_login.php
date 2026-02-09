<?php 
@session_start();
?>

<div class="container-fluid main-body">

<h2 style="color: #0A1F44; font-weight: 800" class="text-center mt-5 mb-2">USER LOGIN</h2>

<!-- form  -->

<div class="row d-flex justify-content-center">
<form class="row g-3 needs-validation mb-3 col-lg-6" method="post" novalidate>

  <div class="form-group">
    <label for="user_email" class="form-label">Email</label>
    <input type="text" class="form-control" id="user_email" name="user_email" placeholder="Enter your email" required>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>

  <div class="form-group">
    <label for="user_password" class="form-label">Password</label>
    <input type="password" class="form-control" id="user_password" name="user_password" placeholder="Enter your password" required>
    <div class="invalid-feedback">
      Please enter password!
    </div>
  </div>

  <div class="text-center">
    <input class="btn btn-panel text-white" name="user_login" type="submit"  value="Login"/>
    <p class="mt-2">Don't have an account? <a href="http://localhost/eco_trade_hub/registration.php?user_registration">Register</a></p>
  </div>
</form>
</div>



</div>

<?php 

//accessing ip address
$get_ip_add = getIPAddress();

if(isset($_POST['user_login'])){

  $user_email = $_POST['user_email'];
  $user_password = $_POST['user_password'];

  $select_users = "SELECT * FROM `users` WHERE user_email = '$user_email' AND user_password = '$user_password' AND status = 'approved'";
      $result_select = mysqli_query($conn, $select_users);
      $result_rows = mysqli_num_rows($result_select);

      //data for session
      $row = mysqli_fetch_assoc($result_select);
      $username = $row['username'];

      //cart items 
      $select_user_cart = "SELECT * FROM `cart_details` where ip_address = '$get_ip_add'";
      $result_select_cart = mysqli_query($conn, $select_user_cart);
      $result_rows_cart = mysqli_num_rows($result_select_cart);
      if($result_rows > 0){
        $_SESSION['username'] =  $username;
        $_SESSION['email'] =  $user_email;
        if($result_rows == 1 and $result_rows_cart == 0){
          $_SESSION['username'] =  $username;
          $_SESSION['email'] =  $user_email;
          echo "<script>window.alert('Login Successful! $username')</script>";
          echo "<script>window.open('users/profile.php', '_self')</script>";
        }
        else{
          $_SESSION['username'] =  $username;
          $_SESSION['email'] =  $user_email;
          echo "<script>window.alert('Login Successful! $username')</script>";
          echo "<script>window.open('./checkout.php', '_self')</script>";
        }
      }
      else{
        echo "<script>window.alert('Invalid Credentials! Please enter correct email and password')</script>";
      }


}

?>

