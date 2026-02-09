<?php
include("../includes/connect.php");

if(isset($_POST['rating_value'])){

    $rating_value = $_POST['rating_value'];
    $userId = $_POST['userId']; 
    $productId = $_POST['productId']; 
    $userMessage = $_POST['userMessage'];
    
$sql = "INSERT INTO reviews (user_id, product_id, rating, message, date)
VALUES ($userId, $productId, '$rating_value', '$userMessage', NOW())";

if (mysqli_query($conn, $sql)) {
  echo "New Review Added Successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

}



?>