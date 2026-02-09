<?php 
include('../includes/connect.php');
if(isset($_POST["insert_brand"])){
    $brand_title = $_POST["brand_title"];

    //select data from database
    $select_query = "SELECT * FROM `brands` WHERE brand_title='$brand_title'";
    $result_select = mysqli_query($conn, $select_query);
    $number = mysqli_num_rows($result_select);
    if($number > 0){
        echo "<script>window.alert('This brand is present inside the database!')</script>";
    }
    else{
        //Insert brands
        $insert_query = "INSERT INTO `brands` (brand_title) VALUES ('$brand_title')";
        $result = mysqli_query($conn, $insert_query);
        if($result){
            echo "<script>window.alert('Brand added successfully!')</script>";
        }
    }

   
}
?>

<h3 style="color: #0A1F44; font-weight: 800" class="text-center mt-5 mb-5">Insert Brands</h3>

<div class="row d-flex justify-content-center">
    <div class="col-6">

    <form action="" method="post" class="">

<div class="input-group mb-3">
  <span class="input-group-text" style="background-color: #0A1F44;" id="basic-addon1"><i class="fa-solid fa-list text-white"></i></span>
  <input type="text" class="form-control" placeholder="Insert Brands" aria-label="Brands" name="brand_title" aria-describedby="basic-addon1">
</div>

<div class="input-group d-flex justify-content-center">
    <input type="submit" class="btn text-white" value="Insert Brands" style="background-color: #0A1F44;" name="insert_brand">
</div>

</form>
    </div>
</div>
