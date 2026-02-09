<?php 
include('../includes/connect.php');

if(isset($_GET['edit_category'])){
    $edit_id = $_GET['edit_category'];
}

if(isset($_POST["update_cat"])){
    $category_title = $_POST["cat_title"];

    // Update category
    $update_query = "UPDATE `categories` SET category_title = '$category_title' WHERE category_id = '$edit_id'";
    $result = mysqli_query($conn, $update_query);
    if($result){
        echo "<script>window.alert('Category updated successfully!');
        window.location.href = 'index.php?view_categories';</script>";
    }
}
?>



<h3 style="color: #0A1F44; font-weight: 800" class="text-center mt-5 mb-5">Update Category</h3>

<div class="row d-flex justify-content-center">
    <div class="col-6">

    <form action="" method="post">

    <?php 

$select = "SELECT * FROM `categories` WHERE category_id='$edit_id'";
$result = mysqli_query($conn, $select);
$row = mysqli_fetch_assoc($result);
$old_category_title = $row['category_title'];

    ?>
<div class="input-group mb-3">
  <span class="input-group-text" style="background-color: #0A1F44;" id="basic-addon1"><i class="fa-solid fa-list text-white"></i></span>
  <input type="text" class="form-control" value="<?php echo $old_category_title;?>" aria-label="Categories" name="cat_title" aria-describedby="basic-addon1">
</div>

<div class="input-group d-flex justify-content-center">
    <input type="submit" class="btn text-white" value="Update Category" style="background-color: #0A1F44;" name="update_cat">
</div>

</form>
    </div>
</div>

