<?php include ("includes/header.php"); ?>

<?php 

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
$items_per_page = 8;
$item_total_count = Photo::counter();


$pagination = new Pagination($page, $items_per_page, $item_total_count);

$sql = "SELECT * FROM photos ";
$sql .= "LIMIT {$items_per_page} ";
$sql .= "OFFSET {$pagination->offset()}";

$photos = Photo::find_by_query($sql);



//$photos = Photo::find_all(); 

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
               
               <img class="photo-responsive home_page_photo" src="admin/<?php echo $photo->picture_path(); ?>" alt="">

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

    <div class="row">
          <ul class="pagination justify-content-center mb-4" style="margin:20px 0">

            <?php 

            if($pagination->page_total() > 1){
              if($pagination->has_previous()){
                echo "<li class='page-item'><a class='page-link' href='index.php?page={$pagination->previous()}'>Previous</a></li>";
              }

              for ($i=1; $i <= $pagination->page_total(); $i++) { 
                if($i == $pagination->current_page){
                  echo "<li class='page-item active'><a class='page-link' href='index.php?page={$i}'>$i</a></li>";
                }else{
                  echo "<li class='page-item'><a class='page-link' href='index.php?page={$i}'>$i</a></li>";
                }
              }

              if($pagination->has_next()){
                echo "<li class='page-item'><a class='page-link' href='index.php?page={$pagination->next()}'>Next</a></li>";
              }
            }


            ?>
            
          </ul>
        </div>


  </div>
  <!-- /.container -->

  <!-- Footer -->
  <?php include "includes/footer.php"; ?>