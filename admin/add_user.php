<?php include("includes/admin_header.php"); ?>

<?php if(!$session->is_signed_in()){redirect("login.php");}?>

<?php

  $message = "";
  $user = new User();
  if(isset($_POST['create'])){
    
      $user->username = $_POST['username'];
      $user->first_name = $_POST['first_name'];
      $user->last_name = $_POST['last_name'];
      $user->password = $_POST['password'];

      if(!empty($_POST['username']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['password'])){
        $user->set_image($_FILES['user_image']);
        $user->upload_photo();
        $user->save();
        
        $session->message("The user {$user->username} has been created successfully");
        redirect("users.php");

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
        <h1>Add User</h1>
        <hr><br>
      
        
        
        <form action="" method="post" enctype="multipart/form-data">
            <div class="col-md-6 col-md-offset-3">
              
              <?php 

                //Display Message
                if(!empty($message)){
                  $output = "<div class='alert alert-success alert-dismissible'>";
                  $output .= "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
                  $output .= "<strong>{$message}</strong></div>";

                  echo $output;
                }

               ?>

              <div class="form-group">
                <input type="file" name="user_image">
              </div>
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control">
              </div>
              <div class="form-group">
                <label for="first name">First Name</label>
                <input type="text" name="first_name" class="form-control">
              </div>
              <div class="form-group">
                <label for="last name">Last Name</label>
                <input type="text" name="last_name" class="form-control">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control">
              </div>
              <input type="submit" name="create" value="Add User" class="btn btn-primary pull-right">
            </div>
      </form>
    

        
      
      </div>
      <!-- /.container-fluid -->

     
      <!-- Sticky Footer -->
       <?php include("includes/admin_footer.php"); ?>

    

</body>

</html>
