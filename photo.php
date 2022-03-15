<?php 
require_once("admin/includes/init.php");


if(empty($_GET['id'])){
  redirect("index.php");
}

$photo = Photo::find_by_id($_GET['id']);

if(isset($_POST['submit'])){

  $author = trim($_POST['author']);
  $body   = trim($_POST['body']);

  $new_comment = Comment::create_comment($photo->id, $author, $body);


if($new_comment && $new_comment->save()){
  redirect("photo.php?id={$photo->id}");
}

}else{
  $author = "";
  $body   = "";
}


$comments = Comment::find_the_comments($photo->id);




 ?>




<?php include "includes/header.php"; ?>


  <!-- Navigation -->
  <?php include "includes/navigation.php"; ?>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Post Content Column -->
      <div class="col-lg-12">

        <!-- Title -->
        <h1 class="mt-4"><?php echo $photo->title; ?></h1>

        <!-- Author -->
        <p class="lead">
          by
          <a href="#">Manuel</a>
        </p>

        <hr>

        <!-- Date/Time -->
        <p>Posted on January 1, 2019 at 12:00 PM</p>

        <hr>

        <!-- Preview Image -->
        <img class="photo-responsive" src="admin/<?php echo $photo->picture_path(); ?>" alt="">

        <hr>

        <!-- Post Content -->
        <p class="lead"><?php echo $photo->caption; ?></p>

        <p><?php echo $photo->description; ?></p>

        <hr>

        <!-- Comments Form -->
        <div class="card my-4">
          <h5 class="card-header">Leave a Comment:</h5>
          <div class="card-body">
            <form action="" method="post">
              <div class="form-group">
                <label for="author">Author</label>
                <input type="text" name="author" class="form-control">
              </div>
              <div class="form-group">
                <textarea name="body" class="form-control" rows="3"></textarea>
              </div>
              <button type="submit" name="submit" class="btn btn-primary">Comment</button>
            </form>
          </div>
        </div>

        <!-- Single Comment -->
        <?php foreach($comments as $comment) : ?>
        <div class="media mb-4">
          <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
          <div class="media-body">
            <h5 class="mt-0"><?php echo $comment->author; ?> <small>Posted on January 1, 2019 at 12:00 PM</small></h5>
            <?php echo $comment->body; ?>
          </div>
        </div>
      <?php endforeach; ?>

      </div><!--  End of col-md-8 -->

    <!-- Sidebar Widgets Column -->
<!--     <?php //include "includes/sidebar.php"; ?> -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <?php include "includes/footer.php"; ?>       <!-- Sidebar Widgets Column -->
      
