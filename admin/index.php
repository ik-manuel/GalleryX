<?php include("includes/admin_header.php"); ?>
<?php if(!$session->is_signed_in()){redirect("login.php");}?>
 
<?php include("includes/admin_navigation.php"); ?>
  

  <div id="wrapper">

    

    <!-- Sidebar -->
    <?php include("includes/admin_sidebar.php"); ?>


    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Page Content -->
        <h1>Admin  Dashboard</h1>
        <hr>

      
         <!-- Icon Cards--> 
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-tags"></i>
                </div>
                  <div class="mr-5"><h2><?php echo $session->count; ?></h2><span>new views</span></div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-folder-open"></i>
                </div>
                <div class="mr-5"><h2><?php echo Photo::counter(); ?></h2><span>Photos</span></div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="photos.php">
                <span class="float-left">Total photos in Gallery</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-users"></i>
                </div>
                <div class="mr-5"><h2><?php echo User::counter(); ?></h2><span>Users</span></div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="users.php">
                <span class="float-left">Total Users</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-comments"></i>
                </div>
                <div class="mr-5"><h2><?php echo Comment::counter(); ?></h2><span>Comments</span></div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="comments.php">
                <span class="float-left">Total Comments</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
        </div>  <!--   END OF CARD WIDGET -->


        
      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
       <?php include("includes/admin_footer.php"); ?>

    

</body>

</html>
