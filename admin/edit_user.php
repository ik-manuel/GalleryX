<?php include("includes/admin_header.php"); ?>

<?php if(!$session->is_signed_in()){redirect("login.php");}?>

<?php


$message = "";

if(empty($_GET['id'])){
  redirect("users.php");
}

$user = User::find_by_id($_GET['id']);

if(isset($_POST['update'])){

    if($user){

      $user->username = $_POST['username'];
      $user->first_name = $_POST['first_name'];
      $user->last_name = $_POST['last_name'];
      $user->password = $_POST['password'];


      if(empty($_FILES['user_image'])){
        $user->save();

        $session->message("The user {$user->username} has been updated successfully");
        redirect("users.php");

      }else{
        $user->set_image($_FILES['user_image']);
        $user->upload_photo();
        $user->save();

        // redirect("edit_user.php?id={$user->id}");
        
        $session->message("The user {$user->username} has been updated successfully");
        redirect("users.php");
        
       }
    }

    
 }


 /// Object for Photo Library Modal
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
          <li class="breadcrumb-item active">Edit User</li>
        </ol>

        <!-- Page Content -->
        <h1>Edit User</h1>

        <div class="row">
          <div class="col-md-6 user_image_box">
           <a href="" data-toggle="modal" data-target="#photo-library"> 
            <img class="photo-responsive" src="<?php echo $user->image_path_and_placeholder(); ?>">
          </a>
          </div>

          <div class="col-md-6">
          <form action="" method="post" enctype="multipart/form-data">
                <?php echo $message; ?>
                <div class="form-group">
                  <input type="file" name="user_image" value="<?php echo $user->user_image; ?>">
                </div>
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" name="username" class="form-control" value="<?php echo $user->username; ?>">
                </div>
                <div class="form-group">
                  <label for="first name">First Name</label>
                  <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name; ?>">
                </div>
                <div class="form-group">
                  <label for="last name">Last Name</label>
                  <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name; ?>">
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" class="form-control" value="<?php echo $user->password; ?>">
                </div>
                <input type="submit" name="update" value="Update" class="btn btn-primary pull-right">
                <a id="user-id" class="btn btn-danger delete_link pull-left" href="delete_user.php?id=<?php echo $user->id ?>">Delete</a>
        </form>
        </div>

      </div>

        
      
      </div>
      <!-- /.container-fluid -->



<!--/////// PHOTO GALLERY LIBRARY MODAL //////////-->
      
  <div class="modal fade" id="photo-library">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Gallery System Library</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
         <div class="row">
          <div class="col-md-9">
             <div class="thumbnails row">
            
                <!-- PHP FOREACH LOOP -->
                <?php foreach ($photos as $photo) : ?>
                
               <div class="col-xs-2">
                 <a role="checkbox" aria-checked="false" tabindex="0" id="" href="#" class="thumbnails">
                   <img class="modal_thumbnails photo-responsive" src="<?php echo $photo->picture_path(); ?>" data="<?php echo $photo->id; ?>">
                 </a>
                  <div class="photo-id hidden"></div>
               </div>

                    <!-- END OF PHP LOOP-->
                  <?php endforeach; ?>

             </div>
          </div><!--col-md-9 -->

          <div class="col-md-3">
            <div id="modal_sidebar"></div>
          </div>
          </div>
   
   </div><!--Modal Body-->
      <div class="modal-footer">
        <div class="row">
               <!--Closes Modal-->
              <button id="set_user_image" type="button" class="btn btn-primary" disabled="true" data-dismiss="modal">Apply Selection</button>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--/////// END OF PHOTO GALLERY LIBRARY MODAL //////////-->


     
      <!-- Sticky Footer -->
       <?php include("includes/admin_footer.php"); ?>

    

</body>

</html>
