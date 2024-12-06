<?php  
require_once ("include/initialize.php");
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';
switch ($action) {
	case 'submitapplication' :
	doSubmitApplication();
	break;
  
	case 'registerschool' :
	doRegister();
	break;  

	case 'registerAgency' :
	doRegisterAgency();
	break;  

	case 'login' :
	doLogin();
	break; 

	case 'loginagency' :
	doLoginAgency();
	break; 
}

function doSubmitApplication() { 
	global $mydb;   
		$jobid  = $_GET['JOBID'];
		

		$autonum = New Autonumber();
		$applicantid = $autonum->set_autonumber('APPLICANT');
		$autonum = New Autonumber();
		$fileid = $autonum->set_autonumber('FILEID');

		@$picture = UploadImage();
		@$location = "photos/". $picture ;


		if ($picture=="") {
			# code...
			redirect(web_root."index.php?q=apply&job=".$jobid."&view=personalinfo");
		}else{ 
			
			if (isset($_SESSION['APPLICANTID'])) {

				$sql = "INSERT INTO `tblattachmentfile` (FILEID,`USERATTACHMENTID`, `FILE_NAME`, `FILE_LOCATION`, `JOBID`) 
				VALUES ('". date('Y').$fileid->AUTO."','{$_SESSION['APPLICANTID']}','Resume','{$location}','{$jobid}')";
				$mydb->setQuery($sql); 
				 

				doUpdate($jobid,$fileid->AUTO);
 
			}else{
				 
				$sql = "INSERT INTO `tblattachmentfile` (FILEID,`USERATTACHMENTID`, `FILE_NAME`, `FILE_LOCATION`, `JOBID`) 
				VALUES ('". date('Y').$fileid->AUTO."','". date('Y').$applicantid->AUTO."','Resume','{$location}','{$jobid}')";
				$mydb->setQuery($sql); 
				 

				doInsert($jobid,$fileid->AUTO); 

				$autonum = New Autonumber();
				$autonum->auto_update('APPLICANT');
			}
		} 
	 
}

function doInsert($jobid=0,$fileid=0) {
	if (isset($_POST['submit'])) {  
	global $mydb; 

			$birthdate =  $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];

			$age = date_diff(date_create($birthdate),date_create('today'))->y;

			if ($age < 20){
			message("Invalid age. 20 years old and above is allowed.", "error");
			redirect("index.php?q=apply&view=personalinfo&job=".$jobid);

			}else{

			$autonum = New Autonumber();
			$auto = $autonum->set_autonumber('APPLICANT');
			 
			$applicant =New Applicants();
			$applicant->APPLICANTID = date('Y').$auto->AUTO;
			$applicant->FNAME = $_POST['FNAME'];
			$applicant->LNAME = $_POST['LNAME'];
			$applicant->MNAME = $_POST['MNAME'];
			$applicant->ADDRESS = $_POST['ADDRESS'];
			$applicant->SEX = $_POST['optionsRadios'];
			$applicant->CIVILSTATUS = $_POST['CIVILSTATUS'];
			$applicant->BIRTHDATE = $birthdate;
			$applicant->BIRTHPLACE = $_POST['BIRTHPLACE'];
			$applicant->AGE = $age;
			$applicant->USERNAME = $_POST['USERNAME'];
			$applicant->PASS = sha1($_POST['PASS']);
			$applicant->EMAILADDRESS = $_POST['EMAILADDRESS'];
			$applicant->CONTACTNO = $_POST['TELNO'];
			$applicant->DEGREE = $_POST['DEGREE'];
			$applicant->create();


			$sql = "SELECT * FROM `tblcompany` c,`tbljob` j WHERE c.`COMPANYID`=j.`COMPANYID` AND JOBID = '{$jobid}'" ;
			$mydb->setQuery($sql);
			$result = $mydb->loadSingleResult();


			$jobreg = New JobRegistration(); 
			$jobreg->COMPANYID = $result->COMPANYID;
			$jobreg->JOBID     = $result->JOBID;
			$jobreg->APPLICANTID = date('Y').$auto->AUTO;
			$jobreg->APPLICANT   = $_POST['FNAME'] . ' ' . $_POST['LNAME'];
			$jobreg->REGISTRATIONDATE = date('Y-m-d');
			$jobreg->FILEID = date('Y').$fileid;
			$jobreg->REMARKS = 'Pending';
			$jobreg->DATETIMEAPPROVED = date('Y-m-d H:i');
			$jobreg->create();



		$autonum = New Autonumber();
	    $autonum->auto_update('FILEID'); 
  

			message("Your application already submitted. Please wait for the company confirmation if your are qualified to this job.","success");
			redirect("index.php?q=success&job=".$result->JOBID);

			
	 }
}
}
function doUpdate($jobid=0,$fileid=0) {
	if (isset($_POST['submit'])) {
	global $mydb;   

			$applicant =New Applicants();
			$appl  = $applicant->single_applicant($_SESSION['APPLICANTID']);

			 

			$sql = "SELECT * FROM `tblcompany` c,`tbljob` j WHERE c.`COMPANYID`=j.`COMPANYID` AND JOBID = '{$jobid}'" ;
			$mydb->setQuery($sql);
			$result = $mydb->loadSingleResult();


			$jobreg = New JobRegistration(); 
			$jobreg->COMPANYID = $result->COMPANYID;
			$jobreg->JOBID     = $result->JOBID;
			$jobreg->APPLICANTID = $appl->APPLICANTID;
			$jobreg->APPLICANT   = $appl->FNAME . ' ' . $appl->LNAME;
			$jobreg->REGISTRATIONDATE = date('Y-m-d');
			$jobreg->FILEID = date('Y').$fileid;
			$jobreg->REMARKS = 'Pending';
			$jobreg->DATETIMEAPPROVED = date('Y-m-d H:i');
			$jobreg->create();

			$autonum = New Autonumber();
	   		$autonum->auto_update('FILEID'); 

  
			message("Your application already submitted. Please wait for the company confirmation if your are qualified to this job.","success");
			redirect("index.php?q=success&job=".$result->JOBID);
 
	}
}
function doRegister(){
	global $mydb;
	// if (isset($_POST['btnRegister'])) { 
			  
			 
			$school =New School; 
			$school->SCHOOLNAME = $_POST['SCHOOLNAME']; 
			$school->ADDRESS = $_POST['ADDRESS'];   
			$school->EMAILADDRESS = $_POST['EMAILADDRESS'];
			$school->CONTACTNO = $_POST['CONTACTNO']; 
			$school->USERNAME = $_POST['USERNAME'];
			$school->PASS = sha1($_POST['PASS']);
			$school->create();

 

			message("You are successfully registered to the site. You can login now!","success");
			redirect("index.php?q=success");

			
	 // } 
}
function doRegisterAgency(){
	global $mydb;
	if (isset($_POST['btnRegister'])) { 


		// SELECT `COMPANYID`, `COMPANYNAME`, `COMPANYADDRESS`, `COMPANYCONTACTNO`, `AccreditorName`, `C_Username`, `C_Password`, `Img1` FROM `tblcompany` WHERE 1


			$company = New Company();
			$company->COMPANYNAME		= $_POST['COMPANYNAME'];
			$company->COMPANYADDRESS	= $_POST['COMPANYADDRESS'];
			$company->COMPANYCONTACTNO	= $_POST['COMPANYCONTACTNO'];
			$company->C_Username		= $_POST['C_Username']; 
			$company->C_Password		= sha1($_POST['C_Password']);
			$company->create();
			
			message("You are successfully registered to the site. You can login now!","success");
			redirect("index.php?q=success");



			// $email = trim($_POST['C_Username']);
			// $upass  = trim($_POST['C_Password']);
			// $h_upass = sha1($upass);

		 
			   //  $company = new Company();
			   //  //make use of the static function, and we passed to parameters
			   // $r = $company->companyAuthentication($email, $h_upass);
			   // if ($r==true) { 

		    //   	 	message("You are now successfully login!","success");
		    //    	   redirect(web_root."company/");
		    //    }else{
		    // 		echo "Account does not exist! Please contact Administrator."; 

		    //    } 
 

			message("You are successfully registered to the site. You can login now!","success");
			redirect("index.php?q=success");

			
	 } 
}

function doLogin(){

	// echo "School";
 
	$email = trim($_POST['USERNAME']);
	$upass  = trim($_POST['PASS']);
	$h_upass = sha1($upass); 

  	// //it creates a new objects of member
    $school = new School();
    //make use of the static function, and we passed to parameters
    $res = $school->schoolAuthentication($email, $h_upass);
    if ($res==true) { 

       	 message("You are now successfully login!","success"); 
         redirect(web_root."school/");
     
    }else{  
    		echo "Account does not exist! Please contact Administrator."; 

    } 
}


function doLoginAgency(){

	// echo "Agency";
  
	$email = trim($_POST['USERNAME']);
	$upass  = trim($_POST['PASS']);
	$h_upass = sha1($upass);

 
	    $company = new Company();
	    //make use of the static function, and we passed to parameters
	   $r = $company->companyAuthentication($email, $h_upass);
	   if ($r==true) { 

      	 	message("You are now successfully login!","success");
       	   redirect(web_root."agency/");
       }else{
    		echo "Account does not exist! Please contact Administrator."; 

       } 
}
 


function UploadImage($jobid=0){
	$target_dir = "applicant/photos/";
	$target_file = $target_dir . date("dmYhis") . basename($_FILES["picture"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		
	if($imageFileType != "jpg" || $imageFileType != "png" || $imageFileType != "jpeg"
|| $imageFileType != "gif" ) {
		 if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
			return  date("dmYhis") . basename($_FILES["picture"]["name"]);
		}else{
			message("Error Uploading File","error");
			// redirect(web_root."index.php?q=apply&job=".$jobid."&view=personalinfo");
			// exit;
		}
	}else{
			message("File Not Supported","error");
			// redirect(web_root."index.php?q=apply&job=".$jobid."&view=personalinfo");
			// exit;
		}
} 


?>