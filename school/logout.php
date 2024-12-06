<?php 
require_once '../include/initialize.php';
// Four steps to closing a session
// (i.e. logging out)

// 1. Find the session
@session_start();

// 2. Unset all the session variables
// unset( $_SESSION['USERID'] );
// unset( $_SESSION['FULLNAME'] );
// unset( $_SESSION['USERNAME'] );
// unset( $_SESSION['PASS'] );
// unset( $_SESSION['ROLE'] );
 

unset($_SESSION['SCHOOLID']);  
unset($_SESSION['SCHOOLNAME']); 
unset($_SESSION['USERNAME']);   
// 4. Destroy the session
// session_destroy();
redirect(web_root."index.php?logout=1");
?>