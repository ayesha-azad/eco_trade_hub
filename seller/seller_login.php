<?php 
@session_start();
?>

<div class="container-fluid main-body">

<h2 style="color: #0A1F44; font-weight: 800" class="text-center mt-5 mb-2">SELLER LOGIN</h2>

<!-- form  -->

<div class="row d-flex justify-content-center">
<form class="row g-3 needs-validation mb-3 col-lg-6" method="post" novalidate>

  <div class="form-group">
    <label for="seller_email" class="form-label">Email</label>
    <input type="text" class="form-control" id="seller_email" name="seller_email" placeholder="Enter your email" required>
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
    <input class="btn btn-panel text-white" name="seller_login" type="submit"  value="Login"/>
    <p class="mt-2">Don't have an account? <a href="http://localhost/eco_trade_hub/registration.php?seller_registration">Register</a></p>
  </div>
</form>
</div>



</div>

<?php 

if(isset($_POST['seller_login'])){

  $seller_email = $_POST['seller_email'];
  $user_password = $_POST['user_password'];

  $select_users = "SELECT * FROM `sellers` where seller_email = '$seller_email' AND seller_password = '$user_password' AND status = 'approved'";
      $result_select = mysqli_query($conn, $select_users);
      $result_rows = mysqli_num_rows($result_select);

      //data for session
      $row = mysqli_fetch_assoc($result_select);
      $sellername = $row['sellername'];

      if($result_rows > 0){
        $_SESSION['sellername'] = $row['sellername'];
        $_SESSION['seller_email'] =  $seller_email;
          echo "<script>window.alert('Login Successful! $sellername')</script>";
          echo "<script>window.open('seller/index.php', '_self')</script>";
        }
      else{
        echo "<script>window.alert('Invalid Credentials! Please enter correct email and password')</script>";
      }


}

?>

