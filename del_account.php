<?php
if (!empty($_GET)){
    $id = $_GET['id'];
    require('cnx.php');
    delCpt($con, $id);
}

?>