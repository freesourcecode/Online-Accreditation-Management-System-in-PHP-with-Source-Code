<?php 
require_once("../include/initialize.php");
 if(!isset($_SESSION['SCHOOLID'])){
    redirect(web_root."login.php");
  }

$content='home.php';
$view = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';
switch ($view) {
  case '1' :
        // $title="Home"; 
    // $content='home.php'; 
    if ($_SESSION['ADMIN_ROLE']=='Cashier') {
        # code...
      redirect('orders/');

    } 
    if ($_SESSION['ADMIN_ROLE']=='Administrator') {
        # code... 

      redirect('meals/');

    } 
    break;  
  default :

 
 $requestID = isset($_GET['request']) ? $_GET['request'] :'';
 if ($requestID=='') {
   # code...
      $title="Dashboard"; 
 }else{

      $title="Schedule"; 
 }
    $content ='dashboard.php';    
}
require_once("theme/templates.php");
?>