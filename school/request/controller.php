<?php
require_once ("../../include/initialize.php");
 if(!isset($_SESSION['SCHOOLID'])){
      redirect(web_root."index.php");
     }

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) { 
	case 'send' :
	doSend();
	break;
	  

	case 'requestDocuments' :
	doUplaodDocuments();
	break;
 

	case 'remove' :
	doRemoveDocument();
	break;
	

	}	
function doSend(){
		global $mydb;
		if(isset($_POST['save'])){
			// SELECT `RequestID`, `SchoolID`, `SchoolName`, `AgencyID`, `AgencyName`, `RequestNotes`, `RequestStatus`, `DateRequested`, `RequestAccepted` FROM `tblrequest` WHERE 1

			$agencyID = $_POST['AgencyID'];

			$sql = "SELECT * FROM tblcompany WHERE COMPANYID=".$_POST['AgencyID'];
			$mydb->setQuery($sql);
			$singleCompany = $mydb->loadSingleResult();  


			$schoolRequest = New SchoolRequest();  
			$schoolRequest->SchoolID			= $_SESSION['SCHOOLID']; 
			$schoolRequest->SchoolName			= $_SESSION['SCHOOLNAME'];
			$schoolRequest->AgencyID 	   		= $_POST['AgencyID'];
			$schoolRequest->AgencyName			= $singleCompany->COMPANYNAME;
			$schoolRequest->RequestNotes		= $_POST['RequestNotes'];  
			$schoolRequest->RequestStatus 		= 'Pending';
		 	$schoolRequest->create(); 
		 	$id=$mydb->insert_id();

 
			$sql = "INSERT INTO `tblnotification`(`CreatedBy`,`SendTo`,`ForeignID`, `NotificationMessage`, `Category`, `AlreadyViewed`) VALUES ('".$_SESSION['SCHOOLID']."','{$agencyID}','{$id}','The school ".$_SESSION['SCHOOLNAME']." is Requesting for accreditation.','Request Accreditation',0)";
			$mydb->setQuery($sql);
			// $mydb->executeQuery();

			 $to = $singleCompany->COMPANYEMAIL;
	         $subject = $_POST['Subject'];
	         
	         $message = $_POST['RequestNotes'];
	         
	         $header = "From:abc@somedomain.com \r\n";
	         $header .= "Cc:afgh@somedomain.com \r\n";
	         $header .= "MIME-Version: 1.0\r\n";
	         $header .= "Content-type: text/html\r\n";
	         
	         $retval = mail ($to,$subject,$message,$header);
	         
	         if( $retval == true ) {
	            echo "Message sent successfully...";
	         }else {
	            echo "Message could not be sent...";
	         }
 
 

			message("Request has been sent successfully!", "success");
			redirect("index.php");
 		}
}
function doUplaodDocuments(){ 
		global $mydb;


			$filename = UploadImage();
			$location = web_root."school/dist/uploadedfiles/". $filename ;

			$documentID =$_POST['DocumentID'];
 
			$requestDocument = new RequestDocument(); 
			$requestDocument->Status = 'Ready for Checking';
			$requestDocument->SchoolAttachment = $location;
			$requestDocument->update($documentID);

			$singleDocument = $requestDocument->single_requestDocuments($documentID);
			$agencyID = $singleDocument->AgencyID;


			$sql = "INSERT INTO `tblnotification`(`CreatedBy`,`SendTo`,`ForeignID`, `NotificationMessage`, `Category`, `AlreadyViewed`) VALUES ('".$_SESSION['SCHOOLID']."','{$agencyID}','{$documentID}','The school ".$_SESSION['SCHOOLNAME']." sent the following document','Upload Document',0)";
			$mydb->setQuery($sql);


			message("Document uploaded successfully", "success");
			redirect("index.php?view=view&id=".$singleDocument->AgencyID."&request=".$singleDocument->RequestID);  
	}
   
	 
	function doRemoveDocument(){
		
 
		$documentID = 	$_GET['id'];

		$requestDocument = new RequestDocument(); 
		$requestDocument->Status = 'Pending';
		$requestDocument->SchoolAttachment = "";
		$requestDocument->update($documentID);

		$singleDocument = $requestDocument->single_requestDocuments($documentID);
		$agencyID = $singleDocument->AgencyID;
	 

		message("Document removed successfully", "success");
		redirect("index.php?view=view&id=".$singleDocument->AgencyID."&request=".$singleDocument->RequestID);  
		
	}

 
function UploadImage(){
			$target_dir = "../dist/uploadedfiles/";
			$target_file = $target_dir . date("dmYhis") . basename($_FILES["files"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			
			
			if($imageFileType != "pdf" || $imageFileType != "docx") {
				 if (move_uploaded_file($_FILES["files"]["tmp_name"], $target_file)) {
					return  date("dmYhis") . basename($_FILES["files"]["name"]);
				}else{
					echo "Error Uploading File";
					exit;
				}
			}else{
					echo "File Not Supported";
					exit;
		    }
} 

 

 
?>