<?php
require_once ("../../include/initialize.php");
 if(!isset($_SESSION['COMPANY_USERID'])){
      redirect(web_root."index.php");
     }


$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'viewnotification' :
	doNotification();
	break;
	 
	}
   
function doNotification()
{
	global $mydb;
	# code...

   $requestID = isset($_GET['request']) ? $_GET['request'] :'';

    $notificationID = $_GET['id'];

    $sql="UPDATE `tblnotification` SET `AlreadyViewed`=1 WHERE `NotificationID`='{$notificationID}'";
    $mydb->setQuery($sql);
    

	$sql ="SELECT * FROM `tblnotification` WHERE `NotificationID`=".$_GET['id']." ORDER BY  NotificationDate DESC";
	$mydb->setQuery($sql);
	$rowNotif = $mydb->loadSingleResult(); 


  


  if ($rowNotif->Category=='Request Accreditation') {
                              # code...
		   $sql = "SELECT * FROM `tblrequest` WHERE `RequestID`=".$rowNotif->ForeignID; 
		  $mydb->setQuery($sql);
		  $singleRequest = $mydb->loadSingleResult();

		  if ($singleRequest->RequestStatus=='Pending') {
		    # code...
		     // echo '<a href="'.web_root.'agency/request-pending/index.php?view=view&request='.$rowNotif->ForeignID.'&id='. $rowNotif->NotificationID.'" class="btn btn-primary btn-sm"><i class="fas fa-file mr-1"></i> View Details</a> ';
 
			redirect(web_root.'agency/request-pending/index.php?view=view&request='.$rowNotif->ForeignID.'&id='. $rowNotif->NotificationID); 


		  }elseif ($singleRequest->RequestStatus=='Confirmed') {
		    # code...
		     // echo '<a href="'.web_root.'agency/request-confirmed/index.php?view=view&request='.$rowNotif->ForeignID.'&id='. $rowNotif->NotificationID.'" class="btn btn-primary btn-sm"><i class="fas fa-file mr-1"></i> View Details</a> ';
		  		redirect(web_root.'agency/request-confirmed/index.php?view=view&request='.$rowNotif->ForeignID.'&id='. $rowNotif->NotificationID); 
		  }elseif ($singleRequest->RequestStatus=='Declined') {
		    # code...
		     // echo '<a href="'.web_root.'agency/request-declined/index.php?view=view&request='.$rowNotif->ForeignID.'&id='. $rowNotif->NotificationID.'" class="btn btn-primary btn-sm"><i class="fas fa-file mr-1"></i> View Details</a> ';
		  		redirect(web_root.'agency/request-declined/index.php?view=view&request='.$rowNotif->ForeignID.'&id='. $rowNotif->NotificationID); 
		  } 

 

}elseif ($rowNotif->Category=='Requesting Documents') {
  # code...
   // $sql = "SELECT * FROM `tblrequestdocuments` WHERE `RequestID`=".$rowNotif->ForeignID;

     // echo '<a href="'.web_root.'agency/approval/index.php?view=view&request='.$rowNotif->ForeignID.'&id='. $rowNotif->NotificationID.'" class="btn btn-primary btn-sm"><i class="fas fa-file mr-1"></i> View Details</a> ';

		  		redirect(web_root.'agency/approval/index.php?view=view&request='.$rowNotif->ForeignID.'&id='. $rowNotif->NotificationID); 
}elseif ($rowNotif->Category=='Upload Document') {
  # code...
   // $sql = "SELECT * FROM `tblrequestdocuments` WHERE `RequestID`=".$rowNotif->ForeignID;
     // echo '<a href="'.web_root.'agency/approval/index.php?view=view&request='.$rowNotif->ForeignID.'&id='. $rowNotif->NotificationID.'" class="btn btn-primary btn-sm"><i class="fas fa-file mr-1"></i> View Details</a> ';
		  		redirect(web_root.'agency/approval/index.php?view=view&request='.$rowNotif->ForeignID.'&id='. $rowNotif->NotificationID); 
}elseif ($rowNotif->Category=='Schedule') {
  # code...
   // $sql = "SELECT * FROM `tblschedule` WHERE `ScheduleID`=".$rowNotif->ForeignID;
     // echo '<a href="'.web_root.'agency/scheduling/index.php?view=view&schedule='.$rowNotif->ForeignID.'&id='. $rowNotif->NotificationID.'" class="btn btn-primary btn-sm"><i class="fas fa-file mr-1"></i> View Details</a> ';
	
		  		redirect(web_root.'agency/scheduling/index.php?view=view&request='.$rowNotif->ForeignID.'&id='. $rowNotif->NotificationID); 
}

	 
 
 }
 
?>