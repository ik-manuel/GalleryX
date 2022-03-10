<?php include("includes/admin_header.php"); ?>

<?php if(!$session->is_signed_in()){redirect("login.php");}?>

<?php

  $message = "";
  
  if(empty($_GET['id'])){
    redirect("comments.php");
  }

  $comment = Comment::find_by_id($_GET['id']);

  if(isset($_POST['update'])){
    
      $comment->author = $_POST['author'];
      $comment->body = $_POST['body'];

      $comment->save();

      redirect("edit_comment.php?id={$comment->id}");

      $message = "comment successfully updated";

         
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
            <a href="index.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">comment</li>
        </ol>

        <!-- Page Content -->
        <h1>Edit comment</h1>
    
        <div class="col-md-6 col-md-offset-3">
        <form action="" method="post" enctype="multipart/form-data">
              <?php echo $message; ?>
              <div class="form-group">
                <label for="author">Author</label>
                <input type="text" name="author" class="form-control" value="<?php echo $comment->author; ?>">
              </div>
              <div class="form-group">
                <label for="body">Comment</label>
                <textarea class="form-control" name="body" cols="10" rows="10"><?php echo $comment->body; ?> </textarea>
              </div>
              <input type="submit" name="update" value="Update" class="btn btn-primary pull-right">
              <a class="btn btn-danger pull-left" href="delete_comment_photo.php?id=<?php echo $comment->id ?>">Delete</a>
      </form>
      </div>

        
      
      </div>
      <!-- /.container-fluid -->

     
      <!-- Sticky Footer -->
       <?php include("includes/admin_footer.php"); ?>

    

</body>

</html>
