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
            echo "<td><input class='fieldname' type='text' name=$field_name value=$field_value readonly></td>";
        }
        echo "</form>";
        echo "</tr>";
    }
    echo "</table>";
    }
?>
</body>
</html>


