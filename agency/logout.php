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
 

unset($_SESSION['COMPANY_USERID']);  
unset($_SESSION['COMPANYUSERNAME']); 
unset($_SESSION['COMPANYNAME']);   
// 4. Destroy the session
// session_destroy();
redirect(web_root."index.php?logout=1");
?>