<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATN</title>
    <link rel="stylesheet" href="index.css">
    <script src="https://kit.fontawesome.com/cb7a61f42e.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Raleway:wght@200&display=swap" rel="stylesheet"/>
</head>
<body>
<nav id="navbar" class="nav">
  <div class="Logo">
    <img src="" alt="">
  </div>
  <div>
  <ul class="nav-list">
    <li> 
      <div class="dropdown">
        <button class="dropbtn"></button>
      </div>
    </li>
    <li>
      <a href="emptycart.php">Menu</a>
    </li>
    <?php
    if(!isset($_SESSION['username']))
    {
      ?> 
        <li>
          <a href="login.php">Login</a>
        </li>
        <li>
          <a href="register.php">SignUp</a>
        </li>
      <?php
    }
    else
    {
      ?>
      <li>
          <a href="profile.php">Profile</a>
        </li>
        <li>
          <a href="index.php">Logout</a>
        </li>
      <?php
    }
    ?>
  </ul>
  </div>
</nav>
<div id="header-title" class="header-title">
  <h1>ATN Company</h1><br>
</div>
