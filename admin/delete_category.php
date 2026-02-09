<?php 

if(isset($_GET['delete_category'])){
    $category_id = $_GET['delete_category'];
}

$delete = "DELETE FROM `categories` WHERE category_id = $category_id";
$result = mysqli_query($conn, $delete);
if($result){
    echo "<script>alert('Category deleted successfully!'); window.location.href = 'index.php?view_categories';</script>";
}
?>