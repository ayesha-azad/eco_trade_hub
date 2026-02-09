<?php 
@session_start();
?>

<div class="container-fluid main-body">

<h2 style="color: #0A1F44; font-weight: 800" class="text-center mt-5 mb-2">Admin LOGIN</h2>

<!-- form  -->

<div class="row d-flex justify-content-center">
<form class="row g-3 needs-validation mb-3 col-lg-6" method="post" novalidate>

  <div class="form-group">
    <label for="admin_email" class="form-label">Email</label>
    <input type="text" class="form-control" id="admin_email" name="admin_email" placeholder="Enter your email" required>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>

  <div class="form-group">
    <label for="admin_password" class="form-label">Password</label>
    <input type="password" class="form-control" id="admin_password" name="admin_password" placeholder="Enter your password" required>
    <div class="invalid-feedback">
      Please enter password!
    </div>
  </div>

  <div class="text-center">
    <input class="btn btn-panel text-white" name="admin_login" type="submit"  value="Login"/>
  </div>
</form>
</div>



</div>

<?php 

if(isset($_POST['admin_login'])){

  $admin_email = $_POST['admin_email'];
  $admin_password = $_POST['admin_password'];

  $select_users = "SELECT * FROM `admins` where admin_email = '$admin_email' AND admin_password = '$admin_password'";
      $result_select = mysqli_query($conn, $select_users);
      $result_rows = mysqli_num_rows($result_select);

      //data for session
      $row = mysqli_fetch_assoc($result_select);
      $admin_name = $row['admin_name'];

      if($result_rows > 0){
        $_SESSION['admin_name'] = $row['admin_name'];
        $_SESSION['admin_email'] =  $admin_email;
          echo "<script>window.alert('Login Successful! $admin_name')</script>";
          echo "<script>window.open('admin/index.php', '_self')</script>";
        }
      else{
        echo "<script>window.alert('Invalid Credentials! Please enter correct email and password')</script>";
      }


}

?>

