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
      <div class="col-lg-8">

        <!-- Title -->
        <h1 class="mt-4">Post Title</h1>

        <!-- Author -->
        <p class="lead">
          by
          <a href="#">Start Bootstrap</a>
        </p>

        <hr>

        <!-- Date/Time -->
        <p>Posted on January 1, 2019 at 12:00 PM</p>

        <hr>

        <!-- Preview Image -->
        <img class="img-fluid rounded" src="http://placehold.it/900x300" alt="">

        <hr>

        <!-- Post Content -->
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus, vero, obcaecati, aut, error quam sapiente nemo saepe quibusdam sit excepturi nam quia corporis eligendi eos magni recusandae laborum minus inventore?</p>

        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, tenetur natus doloremque laborum quos iste ipsum rerum obcaecati impedit odit illo dolorum ab tempora nihil dicta earum fugiat. Temporibus, voluptatibus.</p>

        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, doloribus, dolorem iusto blanditiis unde eius illum consequuntur neque dicta incidunt ullam ea hic porro optio ratione repellat perspiciatis. Enim, iure!</p>

        <blockquote class="blockquote">
          <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
          <footer class="blockquote-footer">Someone famous in
            <cite title="Source Title">Source Title</cite>
          </footer>
        </blockquote>

        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, nostrum, aliquid, animi, ut quas placeat totam sunt tempora commodi nihil ullam alias modi dicta saepe minima ab quo voluptatem obcaecati?</p>

        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, dolor quis. Sunt, ut, explicabo, aliquam tenetur ratione tempore quidem voluptates cupiditate voluptas illo saepe quaerat numquam recusandae? Qui, necessitatibus, est!</p>

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



    <!-- Sidebar Widgets Column -->
    <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <?php include "includes/footer.php"; ?>       <!-- Sidebar Widgets Column -->
      <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <?php include "includes/footer.php"; ?>
