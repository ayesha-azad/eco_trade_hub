<?php 
include("./includes/connect.php");
include("./functions/common_functions.php");
session_start();
if(isset($_SESSION['email'])){
  header("location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ECO Trade Hub</title>
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

<!-- Upper nav  -->

<nav class="navbar navbar-expand navbar-dark bg-dark upper-nav fixed-top">
  <div class="container-fluid pt-1 pb-1">
    <a class="navbar-brand" href="index.php"><img src="assets/favicon.png" alt=""></a>
    
    <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
    <?php 
      if (!isset($_SESSION['username'])){
      ?>
        <li class="nav-item"><a class="nav-link active btn btn-outline-success" href="login.php">Login</a></li>
        <li class="nav-item"><a class="nav-link active btn btn-outline-danger mx-2" href="registration.php">Register</a></li>

        <?php 
          } 
          else{

          
        ?>

          <li class="nav-item"><a class="nav-link active btn btn-outline-danger mx-2" href="logout.php">Logout</a></li>

        <?php }  ?>
        

      </ul>
  </div>
</nav>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid pt-1 pb-1">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item disabled"><a class="nav-link" href="">Welcome 
          <?php 
          if(isset($_SESSION['username'])){
             echo $_SESSION['username'];
            } 
            else{
              echo "Guest";
            }
          ?></a></li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">Home</a>
        </li>
        <?php 
      if (isset($_SESSION['username'])){
      ?>

        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="users/profile.php">My Profile</a>
        </li>

        <?php 
          } 
        ?>

        <li class="nav-item">
          <a class="nav-link" href="display_all.php">Products</a>
        </li>

      </ul>
      <form class="d-flex" role="search" method="get" action="search_product.php">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
        <input class="btn btn-outline-danger" type="submit" value="Search" name="search_data_product">
      </form>
    </div>
  </div>
</nav>

<div class="container-fluid main-body">

<!-- Buttons for different logins -->

<div class="row">
        <div class="col-lg-12 bg-light p-1 mt-5 d-flex justify-content-center">
            <div class="text-center p-3">
                <button class="border-0">
                    <a href="registration.php?user_registration" class="btn text-white btn-panel">User Registration</a>
                </button>
                <button class="border-0">
                    <a href="registration.php?seller_registration" class="btn text-white btn-panel">Seller Registration</a>
                </button>
            </div>
        </div>
    </div>
    
<div class="row row-cols-1 row-col-md-2">
<?php
 if(isset($_GET["user_registration"])){
    include("users/user_registration.php");
 }
 if(isset($_GET["seller_registration"])){
    include("seller/seller_registration.php");
 }
 ?>
    <div class="col">

    </div>
</div>


</div>
    

<?php
include("./includes/footer.php");
?>