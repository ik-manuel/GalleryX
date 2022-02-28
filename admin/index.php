<?php include("includes/admin_header.php"); ?>
<?php if(!$session->is_signed_in()){redirect("login.php");}?>
 
<?php include("includes/admin_navigation.php"); ?>
  

  <div id="wrapper">

    

    <!-- Sidebar -->
    <?php include("includes/admin_sidebar.php"); ?>


    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.html">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Blank Page</li>
        </ol>

              <?php
              


              // $user = User::find_user_by_id(5);
              // $user = new User();
              // $user->username = "Tango";

              // $user->update();

              // $user->save();

              //$user->delete();


             // $user = new User();

             // $user->username =  "Setainer";
             // $user->password =  "02344";
             // $user->first_name =  "set";
             // $user->last_name =  "goanna";

             // $user->create();



              // $users = User::find_all_users();
              //  foreach ($users as $user) {
              //     echo $user->username ."<br>";

              //  }
               
                // $found_user = User::find_user_by_id(2);
                // echo $found_user->username;

              // $all_result = User::find_all_users();
              // while($row = mysqli_fetch_array($all_result)){
              //     echo $row['username'] . "<br>";
              // }

              // $found_user = User::find_user_by_id(1);
              // $user = User::instantiation($found_user);
              // echo $user->username;

              ?>




        <!-- Page Content -->
        <h1>Dashboard Page</h1>
        <hr>
        <p>This is a great starting point for new custom pages.</p>

      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
       <?php include("includes/admin_footer.php"); ?>

    

</body>

</html>
