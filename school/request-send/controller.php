<?php
require_once ("../../include/initialize.php");
 if(!isset($_SESSION['SCHOOLID'])){
      redirect(web_root."index.php");
     }

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'add' :
	doInsert();
	break;

	case 'send' :
	doSend();
	break;
	
	case 'edit' :
	doEdit();
	break; 
	
	case 'delete' :
	doDelete();
	break;

	case 'photos' :
	doupdateimage();
	break;
   
   
    case 'addfiles' :
	doAddFiles();
	break;

	case 'approve' :
	doApproved();
	break;

	case 'checkid' :
	Check_StudentID();
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
	         $subject = "Request for Accreditation";
	         
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
 

			// message("Request has been sent successfully!", "success");
			// redirect("index.php");
 		}

	}
   
	function doInsert(){
		global $mydb;
		if(isset($_POST['save'])){


		if ( $_POST['FNAME'] == "" OR $_POST['LNAME'] == ""
			OR $_POST['MNAME'] == ""  OR $_POST['ADDRESS'] == "" 
			OR $_POST['TELNO'] == "") {
			$messageStats = false;
			message("All fields are required!","error");
			redirect('index.php?view=add');
		}else{	

			$birthdate =  $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];

			$age = date_diff(date_create($birthdate),date_create('today'))->y;

			if ($age < 20){
			message("Invalid age. 20 years old and above is allowed.", "error");
			redirect("index.php?view=add");

			}else{
			 


				$sql = "SELECT * FROM tblemployees WHERE EMPLOYEEID='" .$_POST['EMPLOYEEID']. "'";
				$mydb->setQuery($sql);
				$cur = $mydb->executeQuery();
				$maxrow = $mydb->num_rows($cur);


				// $res = mysqli_query($sql) or die(mysql_error());
				// $maxrow = mysql_num_rows($res);
				if ($maxrow > 0) { 
					# code... 
					message("Employee ID already in use!", "error");
					redirect("index.php?view=add");
				}else{

					@$datehired = date_format(date_create($_POST['DATEHIRED']),'Y-m-d');

					$emp = New Employee(); 
					$emp->EMPLOYEEID 		= $_POST['EMPLOYEEID'];
					$emp->FNAME				= $_POST['FNAME']; 
					$emp->LNAME				= $_POST['LNAME'];
					$emp->MNAME 	   		= $_POST['MNAME'];
					$emp->ADDRESS			= $_POST['ADDRESS'];  
					$emp->BIRTHDATE	 		= $birthdate;
					$emp->BIRTHPLACE		= $_POST['BIRTHPLACE'];  
					$emp->AGE			    = $age;
					$emp->SEX 				= $_POST['optionsRadios']; 
					$emp->TELNO				= $_POST['TELNO'];
					$emp->CIVILSTATUS		= $_POST['CIVILSTATUS']; 
					$emp->POSITION			= trim($_POST['POSITION']);
					// $emp->DEPARTMENTID		= $_POST['DEPARTMENTID'];
					// $emp->DIVISIONID		= $_POST['DIVISIONID'];
					$emp->EMP_EMAILADDRESS	= $_POST['EMP_EMAILADDRESS'];
					$emp->EMPUSERNAME		= $_POST['EMPLOYEEID'];
					$emp->EMPPASSWORD		= sha1($_POST['EMPLOYEEID']);
					$emp->DATEHIRED			=  @$datehired;
					$emp->COMPANYID			= $_POST['COMPANYID'];
					$emp->create(); 


				 
							
						$autonum = New Autonumber(); 
						$autonum->auto_update('employeeid');

					message("New employee created successfully!", "success");
					redirect("index.php");

				}
				
			}
		 }
		}

	}

	function doEdit(){
	if(isset($_POST['save'])){

		if ( $_POST['FNAME'] == "" OR $_POST['LNAME'] == ""
			OR $_POST['MNAME'] == "" OR $_POST['ADDRESS'] == "" 
			OR $_POST['TELNO'] == "") {
			$messageStats = false;
			message("All fields are required!","error");
			redirect('index.php?view=add');
		}else{	

			$birthdate =  $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];

			$age = date_diff(date_create($birthdate),date_create('today'))->y;
		 	if ($age < 20 ){
		       message("Invalid age. 20 years old and above is allowed.", "error");
		       redirect("index.php?view=edit&id=".$_POST['EMPLOYEEID']);

		    }else{

		    	@$datehired = date_format(date_create($_POST['DATEHIRED']),'Y-m-d');

					$emp = New Employee(); 
					$emp->EMPLOYEEID 		= $_POST['EMPLOYEEID'];
					$emp->FNAME				= $_POST['FNAME']; 
					$emp->LNAME				= $_POST['LNAME'];
					$emp->MNAME 	   		= $_POST['MNAME'];
					$emp->ADDRESS			= $_POST['ADDRESS'];  
					$emp->BIRTHDATE	 		= $birthdate;
					$emp->BIRTHPLACE		= $_POST['BIRTHPLACE'];  
					$emp->AGE			    = $age;
					$emp->SEX 				= $_POST['optionsRadios']; 
					$emp->TELNO				= $_POST['TELNO'];
					$emp->CIVILSTATUS		= $_POST['CIVILSTATUS']; 
					$emp->POSITION			= trim($_POST['POSITION']);
					// $emp->DEPARTMENTID		= $_POST['DEPARTMENTID'];
					// $emp->DIVISIONID		= $_POST['DIVISIONID'];
					$emp->EMP_EMAILADDRESS		= $_POST['EMP_EMAILADDRESS'];
					$emp->EMPUSERNAME		= $_POST['EMPLOYEEID'];
					$emp->EMPPASSWORD		= sha1($_POST['EMPLOYEEID']);
					$emp->DATEHIRED			=  @$datehired;
					$emp->COMPANYID			= $_POST['COMPANYID'];

					$emp->update($_POST['EMPLOYEEID']);
 

				message("Employee has been updated!", "success");
				// redirect("index.php?view=view&id=".$_POST['EMPLOYEEID']);
		       redirect("index.php?view=edit&id=".$_POST['EMPLOYEEID']);
	    	}


		}
  	
	 
	}

} 
	function doDelete(){
		
 
		$id = 	$_GET['id'];

		$jobreg = New JobRegistration();
		 	$jobreg->delete($id);
	 

		message("Employee(s) already Deleted!","success");
		redirect('index.php'); 
		
	}

 
 
  function UploadImage(){
			$target_dir = "../../employee/photos/";
			$target_file = $target_dir . date("dmYhis") . basename($_FILES["picture"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			
			
			if($imageFileType != "jpg" || $imageFileType != "png" || $imageFileType != "jpeg"
		|| $imageFileType != "gif" ) {
				 if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
					return  date("dmYhis") . basename($_FILES["picture"]["name"]);
				}else{
					echo "Error Uploading File";
					exit;
				}
			}else{
					echo "File Not Supported";
					exit;
				}
} 

	function doupdateimage(){
 
			$errofile = $_FILES['photo']['error'];
			$type = $_FILES['photo']['type'];
			$temp = $_FILES['photo']['tmp_name'];
			$myfile =$_FILES['photo']['name'];
		 	$location="photo/".$myfile;


		if ( $errofile > 0) {
				message("No Image Selected!", "error");
				redirect("index.php?view=view&id=". $_GET['id']);
		}else{
	 
				@$file=$_FILES['photo']['tmp_name'];
				@$image= addslashes(file_get_contents($_FILES['photo']['tmp_name']));
				@$image_name= addslashes($_FILES['photo']['name']); 
				@$image_size= getimagesize($_FILES['photo']['tmp_name']);

			if ($image_size==FALSE ) {
				message("Uploaded file is not an image!", "error");
				redirect("index.php?view=view&id=". $_GET['id']);
			}else{
					//uploading the file
					move_uploaded_file($temp,"photo/" . $myfile);
		 	
					 

						$stud = New Student();
						$stud->StudPhoto	= $location;
						$stud->studupdate($_POST['StudentID']);
						redirect("index.php?view=view&id=". $_POST['StudentID']);
						 
							
					}
			}
			 
		}
function doApproved(){
global $mydb; 
		# code... 
		$rateid = $_GET['id'];

		$sql ="UPDATE `tblrate` SET `Remarks`='Fit to Work'  WHERE RateID='{$rateid}'";
		$mydb->setQuery($sql);
		$res = $mydb->executeQuery();

		  
			message("Applicant is fit to work", "success");
			redirect("index.php"); 

		 
}

 
?>