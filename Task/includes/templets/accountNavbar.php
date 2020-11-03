<!-- Start Navbar -->

<nav class="navbar sticky-top navbar-expand-md navbar-light">
  <div class="container">
  <a class="navbar-brand" href="index.php">Website Name <span>The Best In Middle East</span></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
   <span class="navbar-toggler-icon">   
      <i class="fas fa-bars" style="color:#fff; font-size:20px;"></i>
   </span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">          
      <li class="nav-item">
        <a href="addbook.php" class="nav-link" id="loginbutton">Add Book</a> 
      </li>
      <li class="nav-item">
        <a href="logout.php" class="nav-link" id="loginbutton">Logout</a> 
      </li>
      <li class="nav-item">
        <p class="Username" ><?php echo $_SESSION['Username'] ?></p> 
      </li>
    </ul>
  </div>
  </div>
</nav>

<!-- End Navbar -->