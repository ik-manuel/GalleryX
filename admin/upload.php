<?php include("includes/admin_header.php"); ?>
 
<?php include("includes/admin_navigation.php"); ?>

<?php

$message = "";

if(isset($_POST['submit'])){
  $photo = new Photo();
  $photo->title = $_POST['title'];
  $photo->set_file($_FILES['file_upload']);

  if($photo->save()){
    $message = "Photo uploaded successful";
  }else{
    $message = join("<br>", $photo->errors);
  }
}

    
?>
  

  <div id="wrapper">

    

    <!-- Sidebar -->
    <?php include("includes/admin_sidebar.php"); ?>


    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.html">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">upload</li>
        </ol>

        <!-- Page Content -->
        <h1>Upload Photo</h1>
        <hr>

        <div class="col-md-6">
          <?php echo $message; ?>
          <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <input type="text" name="title" class="form-control">
            </div>
            <div class="form-group">
              <input type="file" name="file_upload">
            </div>
            <input type="submit" name="submit" class="btn btn-primary">
          </form>
        </div>

      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
       <?php include("includes/admin_footer.php"); ?>

    

</body>

</html>
