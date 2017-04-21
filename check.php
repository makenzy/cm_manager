<?php
require('cnx.php');
$tbl_name="cm_manager"; 


// username and password sent from form 
$myusername=$_POST['username']; 
$mypassword=$_POST['password']; 

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$user = $myusername;
$pwd = $mypassword;
$myusername = mysqli_real_escape_string($con,$myusername);
$mypassword = mysqli_real_escape_string($con,$mypassword);
$sql="SELECT * FROM user WHERE email_u='".$myusername."' and pwd_u='".$mypassword."'";
$result=mysqli_query($con,$sql);
// Mysql_num_row is counting table row
$count=mysqli_num_rows($result);
$datauser = mysqli_fetch_row($result);
// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){

    // Register $myusername, $mypassword and redirect to file "login_success.php"
    session_start();
    $_SESSION['user'] = $user;
    $_SESSION['pwd'] = $pwd;
    $_SESSION['nom'] = $datauser[4];
    $_SESSION['email'] = $datauser[2];
    $_SESSION['type'] = $datauser[1];
    $_SESSION['id'] = $datauser[0];
    header("location: index.php");
}
else {
    header("location: login.php?error=y");
}
?>