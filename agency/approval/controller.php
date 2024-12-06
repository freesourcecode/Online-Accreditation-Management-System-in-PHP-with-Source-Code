<?php
require_once ("../../include/initialize.php");
 if(!isset($_SESSION['COMPANY_USERID'])){
      redirect(web_root."index.php");
     }

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'requestDocuments' :
	doRequestDocuments();
	break;
	case 'cancelrequest' :
	doCancel();
	break;
	case 'changestatus' :
	doChangeStatus();
	break; 
	 
	
}
   
function doRequestDocuments()
{
	global $mydb;
	# code...
	if (isset($_POST['Document'])==''){
		message("Empty fields","error");
		redirect('index.php');
		}else{

		$requestID = $_POST['RequestID']; 
		$document = $_POST['Document']; 
 
			$sql = "SELECT `RequestID`, `SchoolID`, `SchoolName`, `AgencyID`, `AgencyName`, `RequestNotes`, `RequestStatus`, `DateRequested`, `RequestAccepted` FROM `tblrequest` WHERE RequestID='{$requestID}'";
			$mydb->setQuery($sql);
			$result = $mydb->loadSingleResult();

			$schoolID = $result->SchoolID;

			$requestDocument = new RequestDocument();
			$requestDocument->RequestID = $requestID;
			$requestDocument->RequestDocuments = $document;
			$requestDocument->AgencyID = $_SESSION['COMPANY_USERID'];
			$requestDocument->AgencyName = $_SESSION['COMPANYNAME'];
			$requestDocument->SchoolID = $result->SchoolID;
			$requestDocument->SchoolName = $result->SchoolName;
			$requestDocument->Status = 'Pending';
			$requestDocument->AccreditationLevel = 1;
			$requestDocument->create();



				$schoolRequest = new SchoolRequest();
				$schoolRequest->RequestStatus = 'Confirmed';
				$schoolRequest->update($requestID);



		 

			$sql = "INSERT INTO `tblnotification`(`CreatedBy`,`SendTo`,`ForeignID`, `NotificationMessage`, `Category`, `AlreadyViewed`) VALUES ('".$_SESSION['COMPANY_USERID']."','{$schoolID}','{$requestID}','The agency ".$_SESSION['COMPANYNAME']." is Requesting another documents','Requesting Documents',0)";
			$mydb->setQuery($sql);
			// $mydb->executeQuery();

			redirect("index.php?view=view&id=".$schoolID."&request=".$requestID);
	}

 }
function doCancel()
{
	global $mydb;
	# code...
	 
			$requestID = $_GET['RequestID'];
  
			$schoolRequest = new SchoolRequest();
			$schoolRequest->RequestStatus = 'Declined';
			$schoolRequest->update($requestID);

			$singleRequest = $schoolRequest->single_request($requestID);

			$schoolID = $singleRequest->SchoolID;


  

			$sql = "INSERT INTO `tblnotification`(`CreatedBy`,`SendTo`,`ForeignID`, `NotificationMessage`, `Category`, `AlreadyViewed`) VALUES ('".$_SESSION['COMPANY_USERID']."','{$schoolID}',{$requestID}','The agency ".$_SESSION['COMPANYNAME']." cancelled your request because your school has no prof of existance.','Declined Request',0)";
			$mydb->setQuery($sql);
			// $mydb->executeQuery();

			redirect("index.php"); 
 }
function doChangeStatus()
{
	global $mydb;
	# code...
	 
			$documentID = $_POST['id'];
			$status = $_POST['Status'];
  
			$docu = new RequestDocument();
			$docu->CheckDocumnets = 1;
			$docu->Status = $status;
			if ($status=='Checking') {
				# code...
				$docu->DateApproved = DATE('Y-m-d H:i:s');
			}
			$docu->update($documentID);


			$singleDocu = $docu->single_requestDocuments($documentID);

			$schoolID = $singleDocu->SchoolID;
			$requestID = $singleDocu->RequestID;


	   $sql ="SELECT `DocumentID`, `RequestID`, `RequestDocuments`, `AgencyID`, `AgencyName`, `SchoolID`, `SchoolName`, `SchoolAttachment`, `CheckDocumnets`, `Status`, `AccreditationLevel`, `DateApproved` FROM `tblrequestdocuments` WHERE  	AlreadyEvaluated=0 AND `RequestID`='{$requestID}'";
            $docu = $mydb->setQuery($sql);
            $maxDocu = $mydb->num_rows($docu);



	   $sql ="SELECT `DocumentID`, `RequestID`, `RequestDocuments`, `AgencyID`, `AgencyName`, `SchoolID`, `SchoolName`, `SchoolAttachment`, `CheckDocumnets`, `Status`, `AccreditationLevel`, `DateApproved` FROM `tblrequestdocuments` WHERE Status='Approved' AND  AlreadyEvaluated=0 AND `RequestID`='{$requestID}'";
            $docu = $mydb->setQuery($sql);
            $approveDocu = $mydb->num_rows($docu);


         if ($maxDocu==$approveDocu) {
	         	$sql ="UPDATE `tblrequestdocuments` SET  `ReadytoSchedule`=1 WHERE `RequestID`='{$requestID}' AND `ReadytoSchedule`=0 AND `AlreadyEvaluated`=0";
	         	$mydb->setQuery($sql);
         }else{
         	$sql ="UPDATE `tblrequestdocuments` SET  `ReadytoSchedule`=0 WHERE `RequestID`='{$requestID}' AND `ReadytoSchedule`=1 AND `AlreadyEvaluated`=0";
	        $mydb->setQuery($sql);



			$sql = "INSERT INTO `tblnotification`(`CreatedBy`,`SendTo`,`ForeignID`, `NotificationMessage`, `Category`, `AlreadyViewed`) VALUES ('".$_SESSION['COMPANY_USERID']."','{$schoolID}','{$requestID}','The agency ".$_SESSION['COMPANYNAME']." approved all the documents the you provided. We well inform you of your schedule for visiting. ','Requesting Documents',0)";
			$mydb->setQuery($sql);
			
         }






			echo " Status change to " . $status;

	  
 }

 
?>