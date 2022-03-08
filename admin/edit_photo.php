<?php include("includes/admin_header.php"); ?>

<?php if(!$session->is_signed_in()){redirect("login.php");}?>

<?php

if(empty($_GET['id'])){
  redirect("photos.php");
}else{
  $photo = Photo::find_by_id($_GET['id']);
  if(isset($_POST['update'])){
    if($photo){
      $photo->title = $_POST['title'];
      $photo->caption = $_POST['caption'];
      $photo->alternate_text = $_POST['alternate_text'];
      $photo->description = $_POST['description'];

      $photo->save();

    }
  }
}


?>
 
<?php include("includes/admin_navigation.php"); ?>
  

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
          <li class="breadcrumb-item active">photos</li>
        </ol>

        <!-- Page Content -->
        <h1>Photos</h1>
      
        
        <div class="col-md-12">
        <form action="" method="post">
            <div class="col-md-8">
              <div class="form-group">
                <input type="text" name="title" class="form-control" value="<?php echo $photo->title; ?>">
              </div>
              <div class="form-group">
              <a href="#"><img src="<?php echo $photo->picture_path(); ?>" alt="" class="admin-photo-thumbnail"></a>
              </div>
              <div class="form-group">
                <label for="Caption">Caption</label>
                <input type="text" name="caption" class="form-control" value="<?php echo $photo->caption; ?>">
              </div>
              <div class="form-group">
                <label for="Alternate">Alternate Text</label>
                <input type="text" name="alternate_text" class="form-control" value="<?php echo $photo->alternate_text; ?>">
              </div>
              <div class="form-group">
                <label for="Description">Description</label>
                <textarea class="form-control" name="description" cols="30" rows="10"><?php echo $photo->description; ?></textarea>
              </div>
            </div>
            <div class="col-md-4">
              <div  class="photo-info-box">
                  <div class="info-box-header">
                     <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                  </div>
              <div class="inside">
                <div class="box-inner">
                   <p class="text">
                     <span class="glyphicon glyphicon-calendar"></span> Uploaded on: April 22, 2030 @ 5:26
                    </p>
                    <p class="text ">
                      Photo Id: <span class="data photo_id_box"><?php echo $photo->id ?></span>
                    </p>
                    <p class="text">
                      Filename: <span class="data"><?php echo $photo->filename ?></span>
                    </p>
                   <p class="text">
                    File Type: <span class="data"><?php echo $photo->type ?></span>
                   </p>
                   <p class="text">
                     File Size: <span class="data"><?php echo $photo->size ?></span>
                   </p>
                </div>
                <div class="info-box-footer clearfix">
                  <div class="info-box-delete pull-left">
                      <a  href="delete_photo.php?id=<?php echo $photo->id; ?>" class="btn btn-danger btn-lg ">Delete</a>   
                  </div>
                  <div class="info-box-update pull-right ">
                      <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
                      </div>   
                    </div>
                  </div>          
              </div>
          </div>
      </form>
    </div>

        
      
      </div>
      <!-- /.container-fluid -->

     
      <!-- Sticky Footer -->
       <?php include("includes/admin_footer.php"); ?>

    

</body>

</html>
