<?php
session_start();
include("db_config.php");
$dbconn = pg_connect($db_conn_string);

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
  //get username and password from post request
  $uname = $_POST['username'];
  $passwd = $_POST['password'];
   
  $query = "SELECT * FROM account WHERE username = '".$uname."' AND password = '".$passwd."'";
  $result = pg_query($dbconn ,$query);

  if (pg_num_rows($result) == 1){
    $user_info = pg_fetch_array($result);
    $role = $user_info["role"];
    $_SESSION["role"] = $role;
    $_SESSION["refresh"] = 5;
    $_SESSION["selected_shop"] = "All_Shop";
    
    header('Location: db_mng.php');
    
  }
  else header('Location: login.php');
}
pg_close($dbconn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="login">
        <h1>Login</h1>
        <form action="login.php" method="post">
            <label>Your Email</label>
            <div class="field_text">
                <input  type="text" name="username" required>
            </div>
            <label>Password</label>
            <div class="field_text">
                <input type="password" name="password" required>
            </div>
            <input type="submit" name="login" value="Login">
            <div class="signup_link">
                Create new Account? <a href="register.php">Register</a>
            </div>
            
        </form>
    </div>
</body>
</html>