<?php include("includes/admin_header.php"); ?>

<?php if(!$session->is_signed_in()){redirect("login.php");}?>

<?php

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
$items_per_page = 4;
$item_total_count = User::user_photo_counter($_SESSION['user_id']);

$pagination = new Pagination($page, $items_per_page, $item_total_count);

$sql = "SELECT * FROM photos ";
$sql .= "WHERE user_id = " . $_SESSION['user_id'];
$sql .= " LIMIT {$items_per_page} ";
$sql .= "OFFSET {$pagination->offset()}";


$photos = Photo::find_by_query($sql);



//$photos = User::find_by_id($_SESSION['user_id'])->user_photo();


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

        
        <h3><?php echo User::find_by_id($_SESSION['user_id'])->username; ?>'s photos</h3>

         <!--  Display Message -->
        <?php 
            
            if(!empty($message)){

                $output = "<div class='alert alert-success alert-dismissible'>";
                $output .= "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
                $output .= "<strong>{$message}</strong></div>";
                echo $output;
              }

         ?>

        <!-- Pagination -->
        <div class="row">
          <ul class="pagination justify-center-center" style="margin:20px 15px -37px">

            <?php 

            if($pagination->page_total() > 1){
              if($pagination->has_previous()){
                echo "<li class='page-item'><a class='page-link' href='user_photos.php?page={$pagination->previous()}'>Previous</a></li>";
              }

              for ($i=1; $i <= $pagination->page_total(); $i++) { 
                if($i == $pagination->current_page){
                  echo "<li class='page-item active'><a class='page-link' href='user_photos.php?page={$i}'>$i</a></li>";
                }else{
                  echo "<li class='page-item'><a class='page-link' href='user_photos.php?page={$i}'>$i</a></li>";
                }
              }

              if($pagination->has_next()){
                echo "<li class='page-item'><a class='page-link' href='user_photos.php?page={$pagination->next()}'>Next</a></li>";
              }
            }


            ?>
            
          </ul>
        </div>



        <a href="upload.php" class="btn btn-primary pull-right">Upload Photo</a>
        <br><br>
      
       <div class="row">
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
                    <a class="delete_link" href="delete_user_photo.php?id=<?php echo $photo->id; ?>">Delete</a>
                    <a href="edit_user_photo.php?id=<?php echo $photo->id; ?>">Edit</a>
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
        
      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
       <?php include("includes/admin_footer.php"); ?>

    

</body>

</html>
