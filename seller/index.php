<?php

include("../includes/connect.php");
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
    <title>Seller Dashboard</title>
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
          <a class="nav-link active" href="index.php" aria-current="page">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="insert_product.php">Insert Products</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="chat.php">Chat with Buyers <i class="fa-solid fa-comments text-light"></i></a>
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
  
<h2 style="color: #0A1F44; font-weight: 800" class="text-center my-5">SELLER DASHBOARD</h2>


<div class="container">
    <div class="row">
        <div class="col-lg-12 bg-light p-1 d-flex">

            <div>
                <a href="index.php">
                  <?php
                  $seller = $_SESSION['seller_email'];
                  $select_seller = "SELECT * FROM `sellers` where seller_email = '$seller'";
                  $result_seller = mysqli_query($conn, $select_seller);
                  $row_seller = mysqli_fetch_assoc($result_seller);
                  $seller_pic = $row_seller['seller_image'];
                  ?>
                    <img src="seller_images/<?php echo $seller_pic; ?>" alt="" class="seller-image">
                </a>
                <p><?php echo $_SESSION['sellername']; ?></p>
            </div>

            <div class="button text-center p-3 d-flex justify-content-center align-items-center">
                <button>
                    <a href="index.php?view_products" class="btn text-white btn-panel">View Products</a>
                </button>
                <button>
                    <a href="insert_product.php" class="btn text-white btn-panel">Insert Products</a>
                </button>
                <button>
                    <a href="index.php?edit_account" class="btn text-white btn-panel">Edit Account</a>
                </button>
            </div>
        </div>
    </div>
</div>


<div class="container">
  <?php 

  if(isset($_GET["view_products"])){
    include("view_products.php");
  }

  if(isset($_GET["edit_product"])){
    include("edit_products.php");
 }

 if(isset($_GET["delete_product"])){
  include("delete_product.php");
}

  if(isset($_GET['edit_account'])){
    include("edit_account.php");
  }

  

  ?>
</div>


</div>




<?php 
include("../includes/footer.php")
?>