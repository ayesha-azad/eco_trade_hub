<?php 
include('../includes/connect.php');
if(isset($_POST["insert_cat"])){
    $category_title = $_POST["cat_title"];

    //select data from database
    $select_query = "SELECT * FROM `categories` WHERE category_title='$category_title'";
    $result_select = mysqli_query($conn, $select_query);
    $number = mysqli_num_rows($result_select);
    if($number > 0){
        echo "<script>window.alert('This category is present inside the database!')</script>";
    }
    else{
        //Insert category
        $insert_query = "INSERT INTO `categories` (category_title) VALUES ('$category_title')";
        $result = mysqli_query($conn, $insert_query);
        if($result){
            echo "<script>window.alert('Category added successfully!');
            window.location.href = 'index.php?view_categories';</script>";
        }
    }

   
}
?>


<h3 style="color: #0A1F44; font-weight: 800" class="text-center mt-5 mb-5">Insert Categories</h3>

<div class="row d-flex justify-content-center">
    <div class="col-6">

    <form action="" method="post">

<div class="input-group mb-3">
  <span class="input-group-text" style="background-color: #0A1F44;" id="basic-addon1"><i class="fa-solid fa-list text-white"></i></span>
  <input type="text" class="form-control" placeholder="Insert Categories" aria-label="Categories" name="cat_title" aria-describedby="basic-addon1">
</div>

<div class="input-group d-flex justify-content-center">
    <input type="submit" class="btn text-white" value="Insert Categories" style="background-color: #0A1F44;" name="insert_cat">
</div>

</form>
    </div>
</div>

