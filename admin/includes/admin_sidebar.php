<ul class="sidebar navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="users.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Users</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="user_photos.php">
          <i class="fas fa-fw fa-table"></i>
          <span><?php echo User::find_by_id($_SESSION['user_id'])->username; ?>'s Photos</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="upload.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Upload</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="photos.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Photos</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="comments.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Comments</span></a>
      </li>
    </ul>