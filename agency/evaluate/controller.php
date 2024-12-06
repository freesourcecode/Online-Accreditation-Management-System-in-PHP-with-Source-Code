<?php
require_once ("../../include/initialize.php");
 if(!isset($_SESSION['COMPANY_USERID'])){
      redirect(web_root."index.php");
     }

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'addRating' :
	doAdd();
	break;
	case 'setDuration' :
	doSetDuration();
	break;
	case 'saveEvaluation' :
	doSaveEvaluation();
	break;
	case 'cancelrequest' :
	doCancel();
	break;
	case 'changestatus' :
	doChangeStatus();
	break;
	 
	
}
   
function doAdd()
{
	global $mydb;
	# code...
 
		$documentID = $_POST['DocumentID']; 
		$rating = $_POST['Rating']; 
		$remarks ='';
		$improvements = $_POST['improvements'];
		$recommendations = $_POST['recommendations'];
		$feedBack = $_POST['feedBack'];
		$SurveyID = $_POST['SurveyID'];

		// $LevelAttained = $_POST['LevelAttained'];
		// $dateFrom = dateFormat( $_POST['DateFrom'],"Y-m-d");
		// $dateTo = dateFormat( $_POST['DateTo'],"Y-m-d"); 
		// $validityStatus =  CalculateAge($dateFrom,$dateTo); 

		$LevelAttained = 'N/A';
		$dateFrom =0;
		$dateTo = 0;  
		$validityStatus = 'N/A'; 
 

		if ($rating >=3) {
			# code...
			$remarks ='Passed';
		}else{
			$remarks ='Failed';
		}
		// SELECT `SurveyID`, `RequestID`, `DocumentID`, `AgencyName`, `SchoolName`, `SurveyAverage`, `Remarks`, `Reason`, `LevelAttained`, `DateFrom`, `DateTo`, `ValidityStatus` FROM `tblsurvey` WHERE 1
		
 
			$sql = "SELECT `DocumentID`, `RequestID`, `RequestDocuments`, `AgencyID`, `AgencyName`, `SchoolID`, `SchoolName`, `SchoolAttachment`, `CheckDocumnets`, `Status`, `AccreditationLevel`, `DateApproved`, `ReadytoSchedule`, `Scheduled`, `AlreadyEvaluated` FROM `tblrequestdocuments` WHERE DocumentID='{$documentID}'";
			$mydb->setQuery($sql);
			$result = $mydb->loadSingleResult();

			$SchoolName = $result->SchoolName;
			$AgencyName = $result->AgencyName;
			$SchoolID = $result->SchoolID;
			$RequestID = $result->RequestID;

			if ($SurveyID=='') {
				# code...

	 			$sql = "INSERT INTO `tblsurvey`(`RequestID`, `DocumentID`, `AgencyName`, `SchoolName`, `SurveyAverage`, `Remarks`, `Improvements`,`Recommendations`, `Reason`,`LevelAttained`, `DateFrom`, `DateTo`, `ValidityStatus`) VALUES ('{$RequestID}','{$documentID}','{$AgencyName}','{$SchoolName}','{$rating}','{$remarks}','{$improvements}','{$recommendations}','{$feedBack}','{$LevelAttained}','{$dateFrom}','{$dateTo}','{$validityStatus}')";
				$mydb->setQuery($sql);
				// $SurveyID = $mydb->insert_id();

			}else{
				$sql ="UPDATE `tblsurvey` SET  `SurveyAverage`='{$rating}',`Remarks`='{$remarks}',`Improvements`='{$improvements}',`Recommendations`='{$recommendations}',`Reason`='{$feedBack}',`LevelAttained`='{$LevelAttained}',`DateFrom`='{$dateFrom}',`DateTo`='{$dateTo}',`ValidityStatus`='{$validityStatus}' WHERE `SurveyID`='{$SurveyID}'";
				$mydb->setQuery($sql);  
			}

			// $sql = "UPDATE `tblrequestdocuments` SET `AlreadyEvaluated`=1 WHERE `DocumentID`='{$documentID}'";
			// $mydb->setQuery($sql);
 
			// $sql = "INSERT INTO `tblnotification`(`CreatedBy`,`SendTo`,`ForeignID`, `NotificationMessage`, `Category`, `AlreadyViewed`) VALUES ('".$_SESSION['COMPANY_USERID']."','{$schoolID}','{$requestID}','The agency ".$_SESSION['COMPANYNAME']." is Requesting another documents','Requesting Documents',0)";
			// $mydb->setQuery($sql);
			// $mydb->executeQuery();

			if ($_POST['AlreadyEvaluated']==0) {
				# code...
				redirect("index.php?view=add&RequestID=".$RequestID); 
			}else{


		

				redirect("index.php?view=view&RequestID=".$RequestID); 
			}


 }
 function doSetDuration()
{
	global $mydb;
	# code...
 
		 
		$documentID = $_POST['DocumentID']; 
		$SurveyID = $_POST['SurveyID'];

		$levelAttained = $_POST['LevelAttained'];
		$dateFrom = dateFormat( $_POST['DateFrom'],"Y-m-d");
		$dateTo = dateFormat( $_POST['DateTo'],"Y-m-d"); 
		$validityStatus =  CalculateAge($dateFrom,$dateTo); 

 
			$sql = "SELECT `DocumentID`, `RequestID`, `RequestDocuments`, `AgencyID`, `AgencyName`, `SchoolID`, `SchoolName`, `SchoolAttachment`, `CheckDocumnets`, `Status`, `AccreditationLevel`, `DateApproved`, `ReadytoSchedule`, `Scheduled`, `AlreadyEvaluated` FROM `tblrequestdocuments` WHERE DocumentID='{$documentID}'";
			$mydb->setQuery($sql);
			$result = $mydb->loadSingleResult();
 
			$RequestID = $result->RequestID;
			$alreadyEvaluated = $result->AlreadyEvaluated;
 

 
		// SELECT `SurveyID`, `RequestID`, `DocumentID`, `AgencyName`, `SchoolName`, `SurveyAverage`, `Remarks`, `Reason`, `LevelAttained`, `DateFrom`, `DateTo`, `ValidityStatus` FROM `tblsurvey` WHERE 1
		
 
 
				$sql ="UPDATE `tblsurvey` SET  `LevelAttained`='{$levelAttained}',`DateFrom`='{$dateFrom}',`DateTo`='{$dateTo}',`ValidityStatus`='{$validityStatus}' WHERE `SurveyID`='{$SurveyID}'";
				$mydb->setQuery($sql);   
 
			// $sql = "INSERT INTO `tblnotification`(`CreatedBy`,`SendTo`,`ForeignID`, `NotificationMessage`, `Category`, `AlreadyViewed`) VALUES ('".$_SESSION['COMPANY_USERID']."','{$schoolID}','{$requestID}','The agency ".$_SESSION['COMPANYNAME']." is Requesting another documents','Requesting Documents',0)";
			// $mydb->setQuery($sql);
			// $mydb->executeQuery();
			if ($alreadyEvaluated == 0) {
				# code...
						redirect("index.php?view=add&RequestID=".$RequestID); 
			}else{

						redirect("index.php?view=view&RequestID=".$RequestID); 
			}

 }
 function doSaveEvaluation()
{
	global $mydb;
	# code...
 	   $autonum = New Autonumber();
       $res = $autonum->set_autonumber('TransactionNo');
       $transactionNo  = DATE('Ymd').$res->AUTO;
		 
		$documentID = $_POST['DocumentID'];  

		$key = count($documentID);

		for($i=0;$i<$key;$i++){
  

			$docu = New RequestDocument();
			$docu->AlreadyEvaluated = 1;
			$docu->TransactionNo = $transactionNo;
			$docu->update($documentID[$i]); 

			$sql ="UPDATE `tblsurvey` SET  `TransactionNo`='{$transactionNo}',`DateEvaluated`=Now() WHERE `DocumentID`='{$documentID[$i]}'";
			$mydb->setQuery($sql);    
			 
		}

		$sql ="SELECT * FROM `tblrequestdocuments` WHERE `TransactionNo`='{$transactionNo}'";
		$mydb->setQuery($sql);
		$school = $mydb->loadSingleResult();
		$schoolID = $school->SchoolID;
 



 
		$sql = "INSERT INTO `tblnotification`(`CreatedBy`,`SendTo`,`ForeignID`, `NotificationMessage`, `Category`, `AlreadyViewed`) VALUES ('".$_SESSION['COMPANY_USERID']."','{$schoolID}','{$transactionNo}','The agency ".$_SESSION['COMPANYNAME']." already evaluated your school . ','Survey',0)";
		  $mydb->setQuery($sql);


        $autonum = New Autonumber(); 
        $autonum->auto_update('TrasactionNo');

		 message("New evaluation created successfully!", "success");

		redirect("index.php"); 

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
         }




			echo " Status change to " . $status;

	  
 }
?>