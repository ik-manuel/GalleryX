<?php require_once("includes/admin_header.php"); ?>
<?php 


if($session->is_signed_in()){
	redirect("index.php");
}


if(isset($_POST['submit'])){
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);



    // Method to verify user 
    $found_user = User::verify_user($username, $password);

    if($found_user){
    	$session->login($found_user);
    	redirect("index.php");
    }else{
    	$the_message = "Your username or Password are incorrect!";
    }

}else{
	$username = "";
	$password = "";
  $the_message = "";
}





 ?>



 <!-- <div class="container"> -->
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="bg-danger">
        <?php echo $the_message; ?>
      </div>
      <div class="card-body">
        <form action="" method="post">
          <div class="form-group">
            <div class="form-label-group">
              <input type="username" name="username" class="form-control" placeholder="Username" required="required" autofocus="autofocus" value="<?php echo htmlentities($username)?>">
              <label for="username">Username</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" name="password" class="form-control" placeholder="Password" required="required" value="<?php echo htmlentities($password)?>">
              <label for="password">Password</label>
            </div>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me">
                Remember Password
              </label>
            </div>
          </div>
          <input type="submit" name="submit" value="Login" class="btn btn-primary btn-block">
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="#">Register an Account</a>
          <a class="d-block small" href="#">Forgot Password?</a>
        </div>
      </div>
    </div>
 <!--  </div> -->