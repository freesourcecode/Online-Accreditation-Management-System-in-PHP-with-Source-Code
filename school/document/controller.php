<?php
require_once ("../../include/initialize.php");
 	 if (!isset($_SESSION['SCHOOLID'])){
      redirect(web_root."index.php");
     }


$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) { 

	case 'requestDocuments' :
	doUplaodDocuments();
	break;
	
	case 'cancelled' :
	doCancelled();
	break; 

 
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
			$requestID = $singleDocument->RequestID;


			$sql = "INSERT INTO `tblnotification`(`CreatedBy`,`SendTo`,`ForeignID`, `NotificationMessage`, `Category`, `AlreadyViewed`) VALUES ('".$_SESSION['SCHOOLID']."','{$agencyID}','{$requestID}','The school ".$_SESSION['SCHOOLNAME']." sent the following document','Upload Document',0)";
			$mydb->setQuery($sql);


			message("Document uploaded successfully", "success");
			redirect("index.php?id=".$requestID."&cid=".$agencyID);  
	}
	function doCancelled(){ 
 
				$job = New Jobs();  
				$job->Approved		= 0; 
				$job->JOBSTATUS		= 'Cancelled'; 
				$job->update($_GET['id']);

				message("Request has been cancelled!", "success");
				redirect("index.php");  
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