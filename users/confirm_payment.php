<?php 
include("../includes/connect.php");
include("../functions/common_functions.php");
session_start();
if(!isset($_SESSION['username'])){
  header("location:../login.php");
}
if(isset($_GET['order_id'])){
    $order_id = $_GET['order_id'];
    $get_order_details = "SELECT * FROM `user_orders` WHERE order_id = $order_id";
    $orders_query = mysqli_query($conn, $get_order_details);
    $row = mysqli_fetch_assoc($orders_query);
    $amount_due = $row['amount_due'];
    $invoice_number = $row['invoice_number'];
}

if (isset($_POST['confirm_payment'])) {
  $invoice_number = $_POST['invoice_number'];
  $amount = $_POST['amount'];
  $payment_mode = $_POST['payment_mode'];

  // Check if a payment record already exists for this order
  $check_payment_query = "SELECT * FROM `user_payments` WHERE order_id = $order_id";
  $check_payment_result = mysqli_query($conn, $check_payment_query);

  if (mysqli_num_rows($check_payment_result) > 0) {
      // Payment record already exists, so update it
      $update_payment_query = "UPDATE `user_payments` SET 
          amount = $amount, 
          payment_mode = '$payment_mode', 
          date = NOW() 
          WHERE order_id = $order_id";
      $update_payment_result = mysqli_query($conn, $update_payment_query);

      if (!$update_payment_result) {
          die("Payment Update Failed: " . mysqli_error($conn));
      }

      echo "<script>alert('Payment record updated for this order.');</script>";
  } else {
      // No existing payment record, so insert a new one
      $insert_query = "INSERT INTO `user_payments` (order_id, invoice_number, amount, payment_mode, date) 
                       VALUES ($order_id, $invoice_number, $amount, '$payment_mode', NOW())";
      $result_query = mysqli_query($conn, $insert_query);

      if (!$result_query) {
          die("Payment Insertion Failed: " . mysqli_error($conn));
      }

      echo "<script>alert('Payment confirmed for this order.');</script>";
  }

  // Update order status to 'complete' if payment mode is 'credit_card'
  if ($payment_mode == 'credit_card') {
      $update_orders = "UPDATE `user_orders` SET order_status = 'complete' WHERE order_id = $order_id";
      $update_query = mysqli_query($conn, $update_orders);

      $update_orders_pending = "UPDATE `orders_pending` SET `order_status` = 'complete' WHERE `invoice_number` = '$invoice_number'";
      $orders_pending_result = mysqli_query($conn, $update_orders_pending);

      if (!$update_query) {
          die("Order Update Failed: " . mysqli_error($conn));
      }
  }

  echo "<script>window.open('profile.php?my_orders', '_self')</script>";
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
          <a class="nav-link" href="#">Contact</a>
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

<div class="container-fluid main-body d-flex flex-column justify-content-center align-items-center text-center">
  <!-- Heading -->
  <h2 style="color: #0A1F44; font-weight: 800" class="text-center py-3">CONFIRM PAYMENT</h2>

  <!-- Form -->
  <form class="row g-3 mb-3 col-lg-6" method="post">
    <div class="form-group">
      <label for="exampleInputEmail1">Invoice Number</label>
      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="invoice_number" value="<?php echo $invoice_number; ?>">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Amount</label>
      <input type="text" class="form-control" id="exampleInputPassword1" name="amount" value="<?php echo $amount_due; ?>">
    </div>
    <select class="form-select" aria-label="Default select example" name="payment_mode">
  <option selected>Select Payment Mode</option>
  <option value="credit_card">Credit Card</option>
  <option value="CoD">Cash on Delivery</option>
</select>
    <input type="submit" class="btn btn-general" value="Confirm Payment" name="confirm_payment">
  </form>
</div>

<?php
include("../includes/footer.php");
?>