<?php include ("includes/header.php"); ?>

<?php 

$page = empty($_GET['page']) ? (int)$_GET['page'] : 1;
$items_per_page = 4;
$item_total_count = Photo::counter();


$photos = Photo::find_all(); 



?>


  <!-- Navigation -->
  <?php include "includes/navigation.php"; ?>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <div class="col-md-12">
        <div class="img-thumbnail row">


        <?php foreach ($photos as $photo): ?>

           <div class="col-xs-6 col-md-3">
             <a href="photo.php?id=<?php echo $photo->id; ?>">
               
               <img class="home_page_photo photo-esponsive" src="admin/<?php echo $photo->picture_path(); ?>" alt="">

             </a>
           </div>
        <?php endforeach; ?>

        </div>
        

      </div>

      <!-- Sidebar Widgets Column 
      <?php //include "includes/sidebar.php"; ?>
      -->
    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <?php include "includes/footer.php"; ?>