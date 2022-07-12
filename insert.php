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
$product = pg_query($dbconn,$getProductQuery) or die('Query failed: ' . pg_last_error());
$num_field = pg_num_fields($product);
if ($_SERVER["REQUEST_METHOD"]=="POST"){
    if (isset($_POST['insert'])){
        $add_query="INSERT INTO product VALUES (";
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
        //$add_query=rtrim($add_query, ",");
        $add_query=$add_query."'".$role."')";
        //echo $add_query;
        $add_result=pg_query($dbconn, $add_query);
        header("Location: db_mng.php");
    }
}

function insert($table,$role)
    {
    echo "<div class='sign-up-form'>";
    echo "<form action='insert.php' method='POST' class='form'>";
    $num_field = pg_num_fields($table);
    for ($i=0;$i<$num_field;$i++)
    {
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