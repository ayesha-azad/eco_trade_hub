<div class="container-fluid">
  <!-- Heading -->
  <h2 style="color: #0A1F44; font-weight: 800" class="text-center my-3">DELETE ACCOUNT</h2>

  <div class="container d-flex justify-content-center mt-5">
    <!-- Form -->
    <form class="row g-3 mb-3 col-lg-6 text-center" method="post">
      <div class="form-group my-3">
        <button type="button" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $user_id; ?>" class="btn btn-general">Delete Account</button>
      </div>
      <div class="form-group">
        <input type="submit" class="btn btn-general" value="Don't Delete Account" name="dont_delete">
      </div>
    </form>
  </div>
</div>

<!-- Modal for deletion confirmation -->
<div class="modal fade" id="deleteModal<?php echo $user_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this account?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-footer">
        <!-- Form to delete the account -->
        <form method="post">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
          <button type="submit" name="delete" class="btn btn-danger">Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php 
if (isset($_POST['delete'])) {
    
    $delete_query = "DELETE FROM `users` WHERE user_id = $user_id";
    $result = mysqli_query($conn, $delete_query);
    if ($result) {
        session_destroy();
        echo "<script>alert('Account deleted! We are sad to see you go!');</script>";
        echo "<script>window.open('../index.php', '_self');</script>";
    } else {
        echo "<script>alert('Error deleting account. Please try again.');</script>";
    }
}

if (isset($_POST['dont_delete'])) {
    echo "<script>window.open('profile.php', '_self');</script>";
}
?>
