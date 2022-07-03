<?php
require 'config/config.php';

if(isset($_SESSION['username'])){
    $userLoggedIn = $_SESSION['username'];
    $user_details_query = mysqli_query($conn, "SELECT * FROM users WHERE username='$userLoggedIn'");
    $user = mysqli_fetch_array($user_details_query);
} else {
    header("Location: register.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to MemoryLane</title>

    <!-- JavaScript -->
    <script src="https://kit.fontawesome.com/7425c3ab84.js" crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/bootstrap.bundle.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">
    
    
</head>
<body>

<div class="top_bar">
  <div class="logo">
    <a href="index.php">MemoryLane</a>
  </div>
  <nav>
    <a href="<?php echo $userLoggedIn; ?>">
      <?php echo $user['first_name'] ?>
    </a>
    <a href="#">
      <i class="fa-solid fa-envelope"></i>
    </a>
    <a href="#">
      <i class="fa-solid fa-house-chimney"></i>
    </a>
    <a href="#">
      <i class="fa-solid fa-bell"></i>
    </a>
    <a href="#">
    <i class="fa-solid fa-users"></i>
    </a>
    <a href="#">
    <i class="fa-solid fa-gear"></i>
    </a>
    <a href="#">
    <i class="fa-solid fa-arrow-right-from-bracket"></i>
    </a>
  </nav>
</div>
    
<div class="wrapper">

