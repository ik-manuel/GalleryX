<?php include("includes/admin_header.php"); ?>

<?php if(!$session->is_signed_in()){redirect("login.php");}?>

<?php
      $comments = Comment::find_all();
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
        <h1>All Comments</h1>
        <br>

        <!--  Display Message -->
        <?php 
            
            if(!empty($message)){

                $output = "<div class='alert alert-success alert-dismissible'>";
                $output .= "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
                $output .= "<strong>{$message}</strong></div>";
                echo $output;
              }

         ?>
        

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
                    <a class="delete_link" href="delete_comment.php?id=<?php echo $comment->id; ?>">Delete</a>
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
