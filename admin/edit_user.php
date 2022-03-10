<?php include("includes/admin_header.php"); ?>

<?php if(!$session->is_signed_in()){redirect("login.php");}?>

<?php

  $message = "";
  
  if(empty($_GET['id'])){
    redirect("users.php");
  }

  $user = User::find_by_id($_GET['id']);

  if(isset($_POST['update'])){
    
      $user->username = $_POST['username'];
      $user->first_name = $_POST['first_name'];
      $user->last_name = $_POST['last_name'];
      $user->password = $_POST['password'];

      if(!empty($_POST['username']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['password'])){
        if(empty($_FILES['user_image'])){
          $user->save();
        }else{
          $user->set_image($_FILES['user_image']);
          $user->upload_photo();
          $user->save();

          redirect("edit_user.php?id={$user->id}");

          $message = "user {$user->username} successfully updated";

         }
      }else{
        $message = "Field can not be empty";
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
            <a href="index.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">user</li>
        </ol>

        <!-- Page Content -->
        <h1>Edit User</h1>
      
        <div class="col-md-6">
          <img src="<?php echo $user->image_path_and_placeholder(); ?>" class="img-responsive">
        </div>
        <div class="col-md-6 col-md-offset-3">
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
              <a class="btn btn-danger pull-left" href="delete_user.php?id=<?php echo $user->id ?>">Delete</a>
      </form>
      </div>

        
      
      </div>
      <!-- /.container-fluid -->

     
      <!-- Sticky Footer -->
       <?php include("includes/admin_footer.php"); ?>

    

</body>

</html>
