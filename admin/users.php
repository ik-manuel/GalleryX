<?php include("includes/admin_header.php"); ?>

<?php if(!$session->is_signed_in()){redirect("login.php");}?>

<?php
      $users = User::find_all();
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
          <li class="breadcrumb-item active">users</li>
        </ol>

        <!-- Page Content -->
        <h1>users</h1>
         

        <!--  Display Message -->
        <?php 
            
            if(!empty($message)){

                $output = "<div class='alert alert-success alert-dismissible'>";
                $output .= "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
                $output .= "<strong>{$message}</strong></div>";
                echo $output;
              }

         ?>
  

         <a href="add_user.php" class="btn btn-primary pull-right">Add User</a>
        <br><br>
      

        <div class="col-md-12">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Id</th>
                <th>Photo</th>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
              </tr>
            </thead>
            <tbody>

             <?php  foreach ($users as $user) : ?>
                <tr>
                <td><?php echo $user->id; ?></td>
                <td><img src="<?php echo $user->image_path_and_placeholder(); ?>" alt="" class="admin-user-thumbnail user_image">
                </td>
                <td><?php echo $user->username; ?>
                  <div class="action_links">
                    <a href="delete_user.php?id=<?php echo $user->id; ?>">Delete</a>
                    <a href="edit_user.php?id=<?php echo $user->id; ?>">Edit</a>
                  </div>
                </td>
                <td><?php echo $user->first_name;    ?></td>
                <td><?php echo $user->last_name;     ?></td>
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
