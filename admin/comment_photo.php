<?php include("includes/admin_header.php"); ?>

<?php if(!$session->is_signed_in()){redirect("login.php");}?>

<?php

if(empty($_GET['id'])){
  redirect("photos.php");
}
      
$comments = Comment::find_the_comments($_GET['id']);

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
          <li class="breadcrumb-item active">Comments</li>
        </ol>

        <!-- Page Content -->
        <h1>comments</h1>
        <br>

        <div class="col-md-12">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Id</th>
                <th>Author</th>
                <th>comment</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>

             <?php  foreach ($comments as $comment) : ?>
                <tr>
                <td><?php echo $comment->id; ?></td>
                <td><?php echo $comment->author; ?></td>
                <td><?php echo $comment->body; ?></td>
                <td>
                  <div class="action_links">
                    <a href="delete_comment_photo.php?id=<?php echo $comment->id; ?>">Delete</a>
                    <a href="edit_comment.php?id=<?php echo $comment->id; ?>">Edit</a>
                  </div>
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
