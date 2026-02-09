<?php 
include('../includes/connect.php');

if(isset($_GET['edit_brand'])){
    $edit_id = $_GET['edit_brand'];
}

if(isset($_POST["update_brand"])){
    $brand_title = $_POST["brand_title"];

    // Update category
    $update_query = "UPDATE `brands` SET brand_title = '$brand_title' WHERE brand_id = '$edit_id'";
    $result = mysqli_query($conn, $update_query);
    if($result){
        echo "<script>window.alert('Brand updated successfully!');
        window.location.href = 'index.php?view_brands';</script>";
    }
}
?>



<h3 style="color: #0A1F44; font-weight: 800" class="text-center mt-5 mb-5">Update Category</h3>

<div class="row d-flex justify-content-center">
    <div class="col-6">

    <form action="" method="post">

    <?php 

$select = "SELECT * FROM `brands` WHERE brand_id='$edit_id'";
$result = mysqli_query($conn, $select);
$row = mysqli_fetch_assoc($result);
$old_brand_title = $row['brand_title'];

    ?>
<div class="input-group mb-3">
  <span class="input-group-text" style="background-color: #0A1F44;" id="basic-addon1"><i class="fa-solid fa-list text-white"></i></span>
  <input type="text" class="form-control" value="<?php echo $old_brand_title;?>" aria-label="Categories" name="brand_title" aria-describedby="basic-addon1">
</div>

<div class="input-group d-flex justify-content-center">
    <input type="submit" class="btn text-white" value="Update Brand" style="background-color: #0A1F44;" name="update_brand">
</div>

</form>
    </div>
</div>

