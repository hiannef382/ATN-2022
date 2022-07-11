<?php
    session_start();
    $page = $_SERVER['PHP_SELF'];
    
    if(isset($_POST["submit_time"]))
    {
        $_SESSION["refresh"] = $_POST["refresh_time"];
    }

    if(isset($_POST["selected_shop"]))
    {
        $_SESSION["selected_shop"] = $_POST["shop"];
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="db_mng.css">
<body>
<?php
include("db_config.php");
$dbconn = pg_connect($db_conn_string);
$role = $_SESSION["role"];
if($role=="Admin")
{
    include("admin_display.php");
    ?>
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="<?php echo $_SESSION["refresh"];?> ;URL='<?php echo $page?>'">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATN</title>
    
    </head>
<div id="main">
<div class="select-div">
    <form action=""  method="post">
    <div id ="sub">
    <div>
    <select name="refresh_time">
        <option value="5">5 second</option>
        <option value="10">10 second</option>
        <option value="20">20 second</option>
    </select>
    </div>
    <div><input type="submit" class="choose" name="submit_time" value="Set time"></div>
    </div>
    </form>
</div>
<div class="select-div">
    <form action="" method="post">
    <div id ="sub">
    <div>
    <select name="shop">
        <option value="ShopA" >Shop A</option>
        <option value="ShopB" >Shop B</option>
        <option value="All_Shop" selected >All Shop</option>
    </select>
    </div>
    <div><input type="submit" class="choose" name="selected_shop" value="Select Shop"></div>
</div>
    </form>
</div>
<div class="select-div">
    <a class="link" href = "logout.php"> Logout</a><br/>
</div>
</div>
    <?php
    $selected_shop = $_SESSION["selected_shop"];
    if($selected_shop=="All_Shop")
    {
        $query = "SELECT * FROM product ORDER BY productid";
    }
    else
    {
        $query = "SELECT * FROM product WHERE  role= '$selected_shop' ORDER BY productid";
    }
}
else
{
    include("shop_display.php");
    ?>
    <div id="sub-main">
    <div><a  href = "insert.php"> Insert</a><br/></div>
    <div><a  href = "logout.php"> Logout</a><br/></div>
    </div>
    <?php
    $query = "SELECT * FROM product WHERE  role= '$role' ORDER BY productid";
}
$result = pg_query($dbconn, $query);
display_table($result);
?>
</body>
</html>




