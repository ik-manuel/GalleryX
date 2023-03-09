<?php include("includes/admin_header.php"); ?>
 
<?php include("includes/admin_navigation.php"); ?>

<?php

$message = "";

if(isset($_FILES['file'])){
  $photo = new Photo();
  $photo->user_id = $_SESSION['user_id'];
  $photo->title = $_POST['title'];
  $photo->set_file($_FILES['file']);

  if($photo->save_file()){
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
            <a href="index.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">upload</li>
        </ol>

        <!-- Page Content -->
        <h1>Upload Photo</h1>
        <a href="photos.php" class="btn btn-primary pull-right">View Photos</a>
        <br><br>
        <hr>
 
        <div class="row">
        <div class="col-md-6">
          
          <!--  Display Message -->
        <?php 
            
            if(!empty($message)){

                $output = "<div class='alert alert-success alert-dismissible'>";
                $output .= "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
                $output .= "<strong>{$message}</strong></div>";
                echo $output;
              }

         ?>
         
          <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="title">Photo Title</label>
              <input type="text" name="title" class="form-control">
            </div>
            <div class="form-group">
              <input type="file" name="file">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Upload">
          </form>
        </div>
      </div> <!-- END OF ROW -->
      <div class="row">
        <div class="col-lg-12">
          <form action="upload.php" class="dropzone"></form>
        </div>
      </div>

      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
       <?php include("includes/admin_footer.php"); ?>

    

</body>

</html>
