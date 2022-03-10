<?php include("includes/admin_header.php"); ?>

<?php if(!$session->is_signed_in()){redirect("login.php");}?>

<?php
      $photos = Photo::find_all();
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
            <a href="index.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">photos</li>
        </ol>

        <!-- Page Content -->
        <h1>Photos</h1>
        <a href="upload.php" class="btn btn-primary pull-right">Upload Photo</a>
        <br><br>
      

        <div class="col-md-12">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Photo</th>
                <th>Id</th>
                <th>File Name</th>
                <th>Title</th>
                <th>Size</th>
                <th>Comments</th>
              </tr>
            </thead>
            <tbody>

             <?php  foreach ($photos as $photo) : ?>
                <tr>
                <td><img src="<?php echo $photo->picture_path(); ?>" alt="" class="admin-photo-thumbnail">

                  <div class="action_link">
                    <a href="delete_photo.php?id=<?php echo $photo->id; ?>">Delete</a>
                    <a href="edit_photo.php?id=<?php echo $photo->id; ?>">Edit</a>
                    <a href="../photo.php?id=<?php echo $photo->id; ?>">view</a>
                  </div>

                </td>
                <td><?php echo $photo->id; ?></td>
                <td><?php echo $photo->filename; ?></td>
                <td><?php echo $photo->title;    ?></td>
                <td><?php echo $photo->size;     ?></td>
                <td>
                  <a href="Comment_photo.php?id=<?php echo $photo->id; ?>">
                   <?php 
                      $comment_count = count(Comment::find_the_comments($photo->id));
                      echo $comment_count;
                    ?>
                    
                  </a>

                </td>
              </tr>
              <?php endforeach; ?>  

              
            </tbody>
          </table>
        </div>
        
      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
       <?php include("includes/admin_footer.php"); ?>

    

</body>

</html>
