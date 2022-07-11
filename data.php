<?php
include("db_config.php");
$dbconn = pg_connect($db_conn_string);
$getProductQuery = "SELECT * FROM product";
$product = pg_query($getProductQuery) or die('Query failed: ' . pg_last_error());
$num_field = pg_num_fields($product);
if ($_SERVER["REQUEST_METHOD"]=="POST"){
    if (isset($_POST['insert'])){
        $add_query="INSERT INTO product VALUES (";
        for ($i=0;$i<$num_field;$i++){
            $field_name = pg_field_name($product,$i);
            $field_value = $_POST[$field_name];

            if($i!=$num_field-1){
                
                $add_query=$add_query."'".$field_value."'".",";
               
            }
            else {
                $add_query=$add_query."'".$field_value."'";
            }

        }
        $add_query=$add_query.")";
         echo $add_query;
        $add_result=pg_query($dbconn, $add_query);
    }
    if (isset($_POST['edit'])){
        
        $edit_query="UPDATE product SET productname="."'".$_POST['productname']."', price="."'".$_POST['price']."', amount="."'".$_POST['amount']."' WHERE productid="."'".$_POST['productid']."'";
        $edit_result=pg_query($dbconn,$edit_query);
    }
    if (isset($_POST['delete'])){
        $del_query="DELETE FROM product WHERE productid="."'".$_POST['productid']."'";
        $del_result=pg_query($dbconn,$del_query);

    }
    $product = pg_query($getProductQuery) or die('Query failed: ' . pg_last_error());
    $num_field = pg_num_fields($product);
}

function DisplayTable($table){
    //table: gia tri cua pg_query
    echo "<table border=1>";
    echo "<tr>";
    $num_field = pg_num_fields($table);

    for ($i=0;$i<$num_field;$i++){
        $field_name = pg_field_name($table,$i);
        echo "<th>$field_name</th>";
    }
    echo "</tr>";
    $num_row=pg_num_rows($table);
    for ($j=0;$j<$num_row;$j++){
        $row=pg_fetch_array($table,$j);

        echo "<tr>";
        echo "<form action='' method='post'>";
        for ($i=0;$i<$num_field;$i++){
            $field_name = pg_field_name($table,$i);
            $field_value=$row[$field_name];
            if ($field_name=='productid' || $field_name=='role')
                echo "<td><input type='text' name=$field_name value=$field_value readonly></td>";
            else
                echo "<td><input type='text' name=$field_name value=$field_value></td>";
            
        }
        echo "<td><input type='submit' value='Edit' name='edit'></td>";
        echo "<td><input type='submit' value='Delete' name='delete'></td>";
        echo "</form>";
        echo "</tr>";
    }
    echo "<tr>";
    echo "<form action='' method='post'>";
    for ($i=0;$i<$num_field;$i++){
        $field_name = pg_field_name($table,$i);
        echo "<td><input type='text' name=$field_name></td>";

    }
    echo "<td><input type='submit' value='Insert' name='insert'></td><td></td>";
    echo "</form>";
    echo "</tr>";
    echo "</table>";
}

DisplayTable($product);
?>
