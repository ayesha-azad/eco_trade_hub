<?php 
include("includes/connect.php");
include("../functions/common_functions.php");
session_start();
if(!isset($_SESSION['username'])){
  header("location:../login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ECO Trade Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="icon" type="image/png" href="../assets/favicon.png" sizes="32x32">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" 
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Itim&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">

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
    <a class="navbar-brand" href="index.php"><img src="../assets/favicon.png" alt=""></a>
    
    <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
    <?php 
      if (!isset($_SESSION['username'])){
      ?>
        <li class="nav-item"><a class="nav-link active btn btn-outline-success" href="../login.php">Login</a></li>
        <li class="nav-item"><a class="nav-link active btn btn-outline-danger mx-2" href="../registration.php">Register</a></li>

        <?php 
          } 
          else{

          
        ?>

          <li class="nav-item"><a class="nav-link active btn btn-outline-danger mx-2" href="../logout.php">Logout</a></li>

        <?php }  ?>
        <li class="nav-item">
          <a class="nav-link active w-5" aria-current="page" href="../cart.php"><i class="fa-solid fa-cart-shopping me-1"></i><sup><?php cartItems() ?></sup></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active w-5" aria-current="page" href="#">Total Amount : <?php totalCartPrice(); ?>/-</a>
        </li>
        

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
          <a class="nav-link" aria-current="page" href="../index.php">Home</a>
        </li>
        
        <?php 
      if (isset($_SESSION['username'])){
      ?>

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="profile.php">My Profile</a>
        </li>

        <?php 
          } 
        ?>

        <li class="nav-item">
          <a class="nav-link" href="../display_all.php">Products</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="chat.php">Chat with Sellers <i class="fa-solid fa-comments text-light"></i></a>
        </li>

      </ul>
      <form class="d-flex" role="search" method="get" action="search_product.php">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
        <input class="btn btn-outline-danger" type="submit" value="Search" name="search_data_product">
      </form>
    </div>
  </div>
</nav>

<!-- Calling cart function  -->
<?php
 cart();
 ?>

<div class="container-fluid main-body mt-5">

<div class="row">

    <!-- Displaying Filters  -->

    <div class="col-lg-2 bg-light p-0">
        <ul class="navbar-nav me-auto">
            <li class="nav-item bg-danger text-white text-center">
                <a class="nav-link active" href="#"><h5>Your Profile</h5></a>
            </li>

            <?php 
                $user_email = $_SESSION['email'];
                $select_user = "SELECT * FROM `users` where user_email = '$user_email'";
                $result_select = mysqli_query($conn, $select_user);
                $row = mysqli_fetch_assoc($result_select);
                $user_id = $row['user_id'];
                $username = $row['username'];
                $user_email = $row['user_email'];
                $user_password = $row['user_password'];
                $user_image = $row['user_image'];
                $user_address = $row['user_address'];
                $user_mobile = $row['user_mobile'];
            ?>

            <li class="nav-item text-center mt-2">
                <a href="profile.php">
                  <img src="user_images/<?php echo $user_image; ?>" class="profile-img" alt="User">
                </a>
            </li>
            <li class="nav-item text-center">
                <a class="nav-link active" href="profile.php?pending_orders">Pending Orders</a>
            </li>
            <li class="nav-item text-center">
                <a class="nav-link active" href="profile.php?edit_account">Edit Account</a>
            </li>
            <li class="nav-item text-center">
                <a class="nav-link active" href="profile.php?my_orders">My Orders</a>
            </li>
            <li class="nav-item text-center">
                <a class="nav-link active" href="profile.php?delete_account">Delete Account</a>
            </li>
            <li class="nav-item text-center">
                <a class="nav-link active" href="../logout.php">Logout</a>
            </li>

        </ul>
    </div>

    <div class="col-lg-10">

    <?php 
    if(!isset($_GET['pending_orders'])){
      if(!isset($_GET['edit_account'])){
        if(!isset($_GET['my_orders'])){
          if(!isset($_GET['delete_account'])){
    ?>
    <div class="container">
<div id="carouselExampleCaptions" class="carousel slide">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="../assets/carousel_profileee.jpg" class="d-block w-100" alt="1st Image">
      <div class="carousel-caption d-none d-md-block">
        <h5>ECO Trade Hub</h5>
        <p>Work by Nouman Asghar</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="../assets/carousel_profilee.jpg" class="d-block w-100" alt="2nd Image">
      <div class="carousel-caption d-none d-md-block">
      <h5>ECO Trade Hub</h5>
      <p>Work by Nouman Asghar</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="../assets/carousel_profile.jpg" class="d-block w-100" alt="2nd Image">
      <div class="carousel-caption d-none d-md-block">
      <h5>ECO Trade Hub</h5>
      <p>Work by Nouman Asghar</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
  </div>
  </div>
  <?php 
}
}
}
}

if(isset($_GET['pending_orders'])){
  getUserOrderDetails();
}

if(isset($_GET['edit_account'])){
  include("edit_account.php");
}

if(isset($_GET['my_orders'])){
  include("user_orders.php");
}

if(isset($_GET['delete_account'])){
  include("delete_account.php");
}
  ?>





    </div>
    
    
</div>


</div>
    

<?php
include("../includes/footer.php");
?>