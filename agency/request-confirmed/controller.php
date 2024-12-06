<?php
require_once ("../../include/initialize.php");
 if(!isset($_SESSION['COMPANY_USERID'])){
      redirect(web_root."admin/index.php");
     }

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'requestDocuments' :
	doRequestDocuments();
	break;
	case 'cancelrequest' :
	doCancel();
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

			// $subj = New Student();
			// $subj->delete($id[$i]);
			// SELECT `DocumentID`, `RequestID`, `RequestDocuments`, `AgencyID`, `AgencyName`, `SchooID`, `SchoolName`, `SchoolAttachment`, `CheckDocumnets`, `Status` FROM `tblrequestdocuments` WHERE 1
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



				// $schoolRequest = new SchoolRequest();
				// $schoolRequest->RequestStatus = 'Confirmed';
				// $schoolRequest->ConfirmedDate = DATE('Y-m-d H:i:s');
				// $schoolRequest->update($requestID);



		 

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
?>