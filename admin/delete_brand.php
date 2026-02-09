<?php 

if(isset($_GET['delete_brand'])){
    $brand_id = $_GET['delete_brand'];
}

$delete = "DELETE FROM `brands` WHERE brand_id = $brand_id";
$result = mysqli_query($conn, $delete);
if($result){
    echo "<script>alert('Brand deleted successfully!'); window.location.href = 'index.php?view_brands';</script>";
}
?>