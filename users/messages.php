<?php 
include(__DIR__ . "/../includes/connect.php");
include(__DIR__ . "/../functions/common_functions.php");
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
          <a class="nav-link" aria-current="page" href="profile.php">My Profile</a>
        </li>

        <?php 
          } 
        ?>

        <li class="nav-item">
          <a class="nav-link" href="../display_all.php">Products</a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link active" href="messages.php">Chat with Sellers <i class="fa-solid fa-comments text-light"></i></a>
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

<div class="container d-flex flex-column">

    <div class="container text-center bg-dark py-2">
        <h1 style="font-weight: 900; font-family: 'Itim', cursive;" class="text-center text-light">My Chats</h1>
    </div>

    <div class="container flex-grow-1">
        <div class="row h-75">
            <div class="col-lg-3 bg-secondary overflow-auto" style="height: calc(80vh - 70px);">
                <?php

                $sellers = "SELECT * FROM `sellers`";
                $result_sellers = mysqli_query($conn, $sellers);

                while($row = mysqli_fetch_assoc($result_sellers)) {
                    $seller_id = $row['seller_id'];
                    $sellername = $row['sellername'];
                    $seller_email = $row['seller_email'];
                    ?>
                
                    <li class="pt-3 text-center" style="list-style-type: none">
                        <a href="messages.php?chat_with_sellers=<?php echo urlencode($seller_email); ?>&seller_name=<?php echo urlencode($sellername); ?>" class="text-light text-decoration-none">
                            <?php echo htmlspecialchars($sellername); ?>
                        </a>
                    </li>
                
                <?php     
                }
                ?>

            </div>
            <div class="col-lg-9 bg-light overflow-auto chat-container" style="height: calc(80vh - 70px);">
                
                <?php 
if (isset($_GET['chat_with_sellers']) && isset($_GET['seller_name'])) {
    $seller_email = urldecode($_GET['chat_with_sellers']);
    $seller_name = urldecode($_GET['seller_name']);

    $receiver = $seller_email;

    if(isset($_SESSION['email'])){
      $sender = $_SESSION['email'];
    }

    echo "<div class='py-2 bg-primary d-flex align-items-center justify-content-center text-light'><b>" . htmlspecialchars($seller_name). "</b></div>";

    ?>

    <div id="chat-messages" class=" py-3 px-3 flex-grow-1 overflow-auto">
        <!-- Chat messages will go here -->
    </div>

    <form id="chat-form" class="d-flex align-items-center chat-form">
        <input type="hidden" id="sender" value="<?php echo $sender; ?>">
        <input type="hidden" id="receiver" value="<?php echo $receiver; ?>">
        <input type="text" id="message" class="form-control ms-2" placeholder="Type your message..." required>
        <button type="submit" class="btn-chat btn-chat-submit">
            <i class="fa-brands fa-telegram"></i>
        </button>
    </form>


    <?php
}
                else{
                    echo "<div class='container text-center mt-5 pt-5' style='font-size: 2rem; font-weight: 600'>
                            <i class='fa-regular fa-comments'></i>
                            <p>Chat with the Sellers Here</p>
                            <p>Select a contact to continue</p>
                          </div>";
                }

                ?>
            </div>
        </div>
    </div>
</div>


</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

function fetchMessages() {
            var sender = $('#sender').val();
            var receiver = $('#receiver').val();
            
            $.ajax({
                url: 'fetch_messages.php',
                type: 'POST',
                data: {sender: sender, receiver: receiver},
                success: function(data) {
                    $('#chat-messages').html(data);
                }
            });
        }
 
        $(document).ready(function() {
            // Fetch messages every 3 seconds
            
            fetchMessages();
            setInterval(fetchMessages, 3000);
        });


            // Submit the chat message
            $('#chat-form').submit(function(e) {
            e.preventDefault();
            var sender = $('#sender').val();
            var receiver = $('#receiver').val();
            var message = $('#message').val();

            $.ajax({
                url: 'submit_message.php',
                type: 'POST',
                data: {sender: sender, receiver: receiver, message: message},
                success: function() {
                    $('#message').val('');
                    fetchMessages(); // Fetch messages after submitting
                }
            });

            });


</script>
    

<?php
include("../includes/footer.php");
?>

