<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin_display.css">
</head>
<body>
<header>ATN Toy Company</header>
<?php
include("db_config.php");
$dbconn = pg_connect($db_conn_string);
if ($_SERVER["REQUEST_METHOD"]=="POST")
{
    if (isset($_POST['edit'])){
        
        $edit_query="UPDATE product SET productname="."'".$_POST['productname']."', price="."'".$_POST['price']."', amount="."'".$_POST['amount']."' WHERE productid="."'".$_POST['productid']."'";
        $edit_result=pg_query($dbconn,$edit_query);
    }
    if (isset($_POST['delete'])){
        $del_query="DELETE FROM product WHERE productid="."'".$_POST['productid']."'";
        $del_result=pg_query($dbconn,$del_query);

    }
}
function display_table($query_object)
    {
        echo "<table border=1>";
        echo "<tr>";
        $num_field = pg_num_fields($query_object);
        for ($i=0;$i<$num_field;$i++){
            $field_name = pg_field_name($query_object,$i);
            // echo "<th class='th'>$field_name</th>";
            if ($field_name == 'role')
            echo "<th class='th'>Shop</th>";
        else if ($field_name == 'productid')
            echo "<th class='th'>Product ID</th>";
        else if ($field_name == 'productname')
            echo "<th class='th'>Product Name</th>";
        else if ($field_name == 'price')
            echo "<th class='th'>Price</th>";
        else echo "<th class='th'>Quantity</th>";
        }
        echo "</tr>";
        $num_row=pg_num_rows($query_object);
        for ($j=0;$j<$num_row;$j++){
            $row=pg_fetch_array($query_object,$j);
            echo "<tr>";
            echo "<form action='' method='post'>";
            for ($i=0;$i<$num_field;$i++){
                $field_name = pg_field_name($query_object,$i);
                $field_value=$row[$field_name];
                if ($field_name=='productid' || $field_name=='role')
                    echo "<td><input class='fieldname' type='text' name=$field_name value=$field_value readonly></td>";
                else
                    echo "<td><input class='fieldname' type='text' name=$field_name value=$field_value></td>";
            }
            echo "<td><input type='submit' value='Edit' name='edit'></td>";
            echo "<td><input type='submit' value='Delete' name='delete'></td>";
            echo "</form>";
            echo "</tr>";
        }
        echo "</table>";
    }
?>
</body>
</html>



