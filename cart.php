<?php 
session_start();
include("./includes/connect.php");
include("./functions/common_functions.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ECO Trade Hub - Cart Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="icon" type="image/png" href="assets/favicon.png" sizes="32x32">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script>
      if(window.history.replaceState){
        window.history.replaceState(null, null, window.location.href);
      }
    </script>

</head>
<body>

<!-- Upper nav -->
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
        <li class="nav-item"><a class="nav-link active w-5" href="cart.php"><i class="fa-solid fa-cart-shopping me-1"></i><sup><?php cartItems() ?></sup></a></li>
    </ul>
  </div>
</nav>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid pt-1 pb-1">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
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
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <?php 
      if (isset($_SESSION['username'])){
      ?>

        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="users/profile.php">My Profile</a>
        </li>

        <?php 
          } 
        ?>

        <li class="nav-item"><a class="nav-link" href="display_all.php">Products</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Calling cart function -->
<?php cart(); ?>

<div class="container-fluid main-body mt-5">
    <!-- Displaying table for cart -->
    <div class="container">
          <?php 
            $get_ip_add = getIPAddress();
            $total_price = 0;
            $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
            $result_query = mysqli_query($conn, $cart_query);
            $result_count = mysqli_num_rows($result_query);
            if($result_count > 0){
            ?>

<div class="row">
        <table class="table text-center">
          <thead>
            <tr>
              <th scope="col">Product Title</th>
              <th scope="col">Product Image</th>
              <th scope="col">Quantity</th>
              <th scope="col">Total Price</th>
              <th scope="col">Operations</th>
            </tr>
          </thead>
          <tbody>

            <?php
            
            while($row = mysqli_fetch_array($result_query)){
                $product_id = $row['product_id'];
                $select_products = "SELECT * FROM `products` WHERE product_id='$product_id'";
                $result_products = mysqli_query($conn, $select_products);
                while($row_product_price = mysqli_fetch_assoc($result_products)){
                    $product_price = $row_product_price['product_price'];
                    $product_title = $row_product_price['product_title'];
                    $product_image = $row_product_price['product_image1'];
                    $cart_quantity = $row['quantity'];
                    $product_total_price = $product_price * $cart_quantity;
                    $total_price += $product_total_price;
          ?>
              <tr>
                <td><?php echo $product_title; ?></td>
                <td><img class='cart-img' src='seller/product_images/<?php echo $product_image; ?>' alt=''></td>
                
                <!-- Each row has its own form -->
                <form action="" method="post">
                  <td>
                    <input class='form-input w-50' type='number' name='qty' value="<?php echo $cart_quantity; ?>">
                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                  </td>
                  <td><?php echo $product_total_price; ?>/-</td>
                  <td>
                    <input name='update_cart' class='btn btn-general mx-2' type='submit' value='Update Cart'/>
                    <button name='remove_item' class='btn btn-general'>Remove Item</button>
                  </td>
                </form>
              </tr>
          <?php 
              }
            }
          ?>

          </tbody>
        </table>

        <!-- Subtotal  -->
        <div class='mt-4'>
          <h4 class="ms-5">Subtotal : <strong><?php echo $total_price; ?>/-</strong></h4>
          <a href="index.php" style="text-decoration: none">
              <button class="btn btn-continue ms-5">Continue Shopping</button>
          </a>
          <a href="checkout.php">
              <button class="btn btn-general mx-3">Checkout</button>
          </a>
        </div>

        </div>

        <?php 
          }
          else{

        ?>
        <div class="container text-center pt-5 mb-3">
          <h3 class="pt-5">No item in your cart</h3>
          <a href="index.php" style="text-decoration: none">
              <button class="btn btn-general rounded-pill px-5 py-2 my-3">Continue Shopping</button>
          </a>
        </div>

        <?php 
          }
        ?>
    </div>
</div>

<?php
// Handle Cart Update and Remove Item logic here

if (isset($_POST['update_cart'])) {
    $qty = $_POST['qty'];
    $product_id = $_POST['product_id'];
    if (!empty($qty)) {
        // Update the quantity in the cart
        $update_cart = "UPDATE `cart_details` SET `quantity` = $qty WHERE ip_address = '$get_ip_add' AND product_id = $product_id";
        $result_update = mysqli_query($conn, $update_cart);
        if ($result_update) {
            echo "<script>window.alert('Quantity Updated!')</script>";
            echo "<script>window.location.reload();</script>";
        }
    }
}

if (isset($_POST['remove_item'])) {
    $product_id = $_POST['product_id'];
    $remove_query = "DELETE FROM `cart_details` WHERE ip_address='$get_ip_add' AND product_id='$product_id'";
    $result_remove = mysqli_query($conn, $remove_query);
    if ($result_remove) {
        echo "<script>window.alert('Item Removed!')</script>";
        echo "<script>window.location.reload();</script>";
    }
}
?>

<?php include("./includes/footer.php"); ?>
