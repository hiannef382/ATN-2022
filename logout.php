<?php
session_start();
session_destroy();
header("Location: login.php");
?>
 <label>
        <?php
            echo "Current refresh time is ".$_SESSION["refresh"];
        ?>
    </label>