<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="insert.css">
</head>
<body>
<?php
session_start();
include("db_config.php");
$dbconn = pg_connect($db_conn_string);
$role = $_SESSION['role'];
$getProductQuery = "SELECT * FROM product";
$product = pg_query($getProductQuery) or die('Query failed: ' . pg_last_error());
$num_field = pg_num_fields($product);
if ($_SERVER["REQUEST_METHOD"]=="POST"){
    if (isset($_POST['insert'])){
        $add_query="INSERT INTO product VALUES ('".$role."',";
        for ($i=0;$i<$num_field;$i++){
            $field_name = pg_field_name($product,$i);
            if($field_name!='role')
            {
                $field_value = $_POST[$field_name];
                if($i!=$num_field-1){
                
                    $add_query=$add_query."'".$field_value."',"; 
                }
                else {
                    $add_query=$add_query."'".$field_value."'";
                }
            }
        }
        $add_query=$add_query.")";
        // echo $add_query;
        $add_result=pg_query($dbconn, $add_query);
        header("Location: db_mng.php");
    }
}
function insert($table,$role)
    {
    echo "<div class='sign-up-form'>";
    echo "<form action='' method='post' class='form'>";
    $num_field = pg_num_fields($table);
    for ($i=0;$i<$num_field;$i++){
        $field_name = pg_field_name($table,$i);
        
        if ($field_name=='role')
        {
            echo "<input class='input-box' type='text' value=$role name=$field_name readonly></br>";
        }
        else
        {
            echo "<input class='input-box' type='text' placeholder=$field_name name=$field_name required></br>";
        }
        
    }
    echo "<input type='submit' class='signup-btn' value='Insert' name='insert'></br>";
    echo "</form>";
    echo "</div>";
}
insert($product,$role);
?>
</body>
</html>




























<?php
// include("db_config.php");
// $dbconn = pg_connect($db_conn_string);
// if ($_SERVER['REQUEST_METHOD'] == "POST")
// {
// //ADD
//    if(isset($_POST['add'])) {
//         $role = $_POST ['role'];
//         $productid= $_POST['productid'];
//         $productname = $_POST['productname'];
//         $price = $_POST['price'];
//         $amount = $_POST['amount'];
//         $query = "INSERT INTO product (role,productId,productname,price,amount ) VALUES 
//           ('".$role."','".$productid."','".$productname."','".$price."','".$amount."')";
//           $result = pg_query($dbconn, $query);
//           header("Location: db_mng.php");
//     }
// }
?>
<!-- <form action="" method = "post">
<div class ="shopname">
    <div><label for="">Role</label></div>
    <div><input type="text" name="role" placeholder="Shop Name"></div>
    </div>
    <div class ="id">
    <div><label for="">Product ID</label></div>
    <div><input type="text" name="productid" placeholder="Product ID"></div>
    <div class="productname">
    <div><label for="">Product Name</label></div>
    <div><input type="text" name="productname" placeholder="Product Name"></div>
    </div>
    <div class="price">
    <div><label for="">Price</label></div>
    <div><input type="text" name="price" placeholder="Price"></div>
    </div>
    </div>
    <div class="amount">
    <div><label for="">Amount</label></div>
    <div><input type="text" name="amount" placeholder="Amount"></div>
    </div>
    </div>
    <br>
    <input type="submit" name="add" value="Add">
  </form> -->
