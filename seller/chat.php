<?php 
include("includes/connect.php");
include("../functions/common_functions.php");

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
    <title>ECO Trade Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="icon" type="image/png" href="assets/favicon.png" sizes="32x32">
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
          <a class="nav-link" href="index.php" aria-current="page">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="insert_product.php">Insert Products</a>
        </li>

        <li class="nav-item">
          <a class="nav-link active" href="chat.php">Chat with Buyers <i class="fa-solid fa-comments text-light"></i></a>
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

<div class="container-fluid main-body mt-5">

<div class="container d-flex flex-column">

    <div class="container text-center bg-dark py-2">
        <h1 style="font-weight: 900; font-family: 'Itim', cursive;" class="text-center text-light">My Chats</h1>
    </div>

    <div class="container flex-grow-1">
        <div class="row h-75">
            <div class="col-lg-3 bg-secondary overflow-auto" style="height: calc(80vh - 70px);">
                <?php

$sender = $_SESSION['seller_email'];

// Use GROUP BY to get each unique sender only once
$seller_chatList = "SELECT DISTINCT sender FROM `chat_messages` WHERE receiver = '$sender'";

$result_sellers = mysqli_query($conn, $seller_chatList);

while($row = mysqli_fetch_assoc($result_sellers)) {
    $previous_sender = $row['sender'];

    $seller_contacts = "SELECT * FROM `users` WHERE user_email = '$previous_sender'";
    $result_contacts = mysqli_query($conn, $seller_contacts);

    while($row_seller_contacts = mysqli_fetch_assoc($result_contacts)) {
        $user_id = $row_seller_contacts['user_id'];
        $username = $row_seller_contacts['username'];
        $user_email = $row_seller_contacts['user_email'];
        ?>
    
        <li class="pt-3 text-center" style="list-style-type: none">
            <a href="chat.php?chat_with_buyers=<?php echo urlencode($user_email); ?>&username=<?php echo urlencode($username); ?>" class="text-light text-decoration-none">
                <?php echo htmlspecialchars($username); ?>
            </a>
        </li>
    
    <?php     
    }
}

                ?>

            </div>
            <div class="col-lg-9 bg-light overflow-auto chat-container" style="height: calc(80vh - 70px);">
                
                <?php 
if (isset($_GET['chat_with_buyers']) && isset($_GET['username'])) {
    $buyer_email = urldecode($_GET['chat_with_buyers']);
    $buyer_name = urldecode($_GET['username']);

    $receiver = $buyer_email;

    if(isset($_SESSION['seller_email'])){
      $sender = $_SESSION['seller_email'];
    }

    echo "<div class='py-2 bg-primary d-flex align-items-center justify-content-center text-light'><b>" . htmlspecialchars($buyer_name). "</b></div>";

    ?>

    <div id="chat-messages" class="py-3 px-3 flex-grow-1 overflow-auto chat-form">
        <!-- Chat messages will go here -->
    </div>

    <form id="chat-form" class="chat-form d-flex align-items-center">
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
                            <p>Chat with the Buyers Here</p>
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

