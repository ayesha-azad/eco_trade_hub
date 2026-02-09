<?php 

if(isset($_GET['delete_product'])){
    $product_id = $_GET['delete_product'];
}

$delete = "DELETE FROM `products` WHERE product_id = $product_id";
$result = mysqli_query($conn, $delete);
if($result){
    echo "<script>alert('Product deleted successfully!'); window.location.href = 'index.php?view_products';</script>";
}
?>