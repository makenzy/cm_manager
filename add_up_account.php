<?php

// print_r($_POST);
if (!empty($_POST)){
    if ($_POST['action']  == 'maj'){
        require('cnx.php');
        majCpt($con,$_POST['id'],$_POST);
    } else if ($_POST['action']  == 'add'){
        require('cnx.php');
        addCpt($con, $_POST);
    }
}

?>