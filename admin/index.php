<?php 
include("../includes/connect.php");
include("../functions/common_functions.php");
session_start();
if(!isset($_SESSION['admin_email'])){
   header("location:../login.php?admin_login");
 }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
      <a class="navbar-brand" href="../index.php"><img src="assets/favicon.png" alt=""></a>
      <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
      <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Welcome 
            <?php
            echo $_SESSION['admin_name']; ?>
         </a>
      </li>
        <li class="nav-item">
          <a class="nav-link active btn btn-outline-danger" aria-current="page" href="../logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </nav>
</div>

<div class="container-fluid main-body">
<h2 style="color: #0A1F44; font-weight: 800" class="text-center my-5">MANAGE DETAILS</h2>

<div class="container">
    <div class="row">
        <div class="col-lg-12 bg-light p-1 d-flex">

            <div>
                <a href="index.php">

                <?php
                  $admin = $_SESSION['admin_email'];
                  $select_admin = "SELECT * FROM `admins` where admin_email = '$admin'";
                  $result_admin = mysqli_query($conn, $select_admin);
                  $row_admin = mysqli_fetch_assoc($result_admin);
                  $admin_pic = $row_admin['admin_image'];
                  $admin_name = $row_admin['admin_name'];
                  ?>

                    <img src="admin_images/<?php echo $admin_pic; ?>" alt="" class="admin-image">
                </a>
                <p><?php echo $admin_name; ?></p>
            </div>

            <div class="button text-center p-3 d-flex justify-content-center align-items-center flex-wrap">
                <button>
                    <a href="index.php?view_products" class="btn text-white btn-panel">View Products</a>
                </button>
                <button>
                    <a href="index.php?insert_category" class="btn text-white btn-panel">Insert Categories</a>
                </button>
                <button>
                    <a href="index.php?view_categories" class="btn text-white btn-panel">View Categories</a>
                </button>
                <button>
                    <a href="index.php?insert_brands" class="btn text-white btn-panel">Insert Brands</a>
                </button>
                <button>
                    <a href="index.php?view_brands" class="btn text-white btn-panel">View Brands</a>
                </button>
                <button>
                    <a href="index.php?list_orders" class="btn text-white btn-panel">All Orders</a>
                </button>
                <button>
                    <a href="index.php?list_payments" class="btn text-white btn-panel">All Payments</a>
                </button>
                <button>
                    <a href="index.php?list_users" class="btn text-white btn-panel">List Users</a>
                </button>
                <button>
                    <a href="index.php?list_sellers" class="btn text-white btn-panel">List Sellers</a>
                </button>
                <button>
                    <a href="index.php?generate_reports" class="btn text-white btn-panel">Generate Reports</a>
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

 if(isset($_GET["insert_category"])){
    include("insert_categories.php");
 }

 if(isset($_GET["insert_brands"])){
    include("insert_brands.php");
 }

 if(isset($_GET["view_categories"])){
    include("view_categories.php");
 }

 if(isset($_GET["view_brands"])){
    include("view_brands.php");
 }

 if(isset($_GET["edit_category"])){
    include("edit_category.php");
 }

 if(isset($_GET["edit_brand"])){
    include("edit_brand.php");
 }

 if(isset($_GET["delete_category"])){
    include("delete_category.php");
 }

 if(isset($_GET["delete_brand"])){
    include("delete_brand.php");
 }

 if(isset($_GET["list_orders"])){
    include("list_orders.php");
 }

 if(isset($_GET["delete_order"])){
    include("delete_order.php");
 }

 if(isset($_GET["list_payments"])){
    include("list_payments.php");
 }

 if(isset($_GET["delete_payment"])){
    include("delete_payment.php");
 }

 if(isset($_GET["list_users"])){
    include("list_users.php");
 }

 if(isset($_GET["approve_user"])){
    include("approve_user.php");
 }

 if(isset($_GET["reject_user"])){
    include("reject_user.php");
 }

 if(isset($_GET["delete_user"])){
    include("delete_user.php");
 }

 if(isset($_GET["list_sellers"])){
    include("list_sellers.php");
 }

 if(isset($_GET["approve_seller"])){
    include("approve_seller.php");
 }

 if(isset($_GET["reject_seller"])){
    include("reject_seller.php");
 }

 if(isset($_GET["delete_seller"])){
    include("delete_seller.php");
 }
 
 if(isset($_GET["generate_reports"])){
    include("generate_reports.php");
 }

 if(isset($_GET['complete_order'])){
   include("update_orders.php");
 }
 ?>
</div>

</div>





<?php 
include("includes/footer.php")
?>