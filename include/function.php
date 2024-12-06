<?php
	function strip_zeros_from_date($marked_string="") {
		//first remove the marked zeros
		$no_zeros = str_replace('*0','',$marked_string);
		$cleaned_string = str_replace('*0','',$no_zeros);
		return $cleaned_string;
	}
	function redirect_to($location = NULL) {
		if($location != NULL){
			header("Location: {$location}");
			exit;
		}
	}
	function redirect($location=Null){
		if($location!=Null){
			echo "<script>
					window.location='{$location}'
				</script>";	
		}else{
			echo 'error location';
		}
		 
	}
	function output_message($message="") {
	
		if(!empty($message)){
		return "<p class=\"message\">{$message}</p>";
		}else{
			return "";
		}
	}
	function date_toText($datetime=""){
		$nicetime = strtotime($datetime);
		return strftime("%B %d, %Y at %I:%M %p", $nicetime);	
					
	}
	function __autoload($class_name) {
		$class_name = strtolower($class_name);
		$path = LIB_PATH.DS."{$class_name}.php";
		if(file_exists($path)){
			require_once($path);
		}else{
			die("The file {$class_name}.php could not be found.");
		}
					
	}

	function currentpage_public(){
		$this_page = $_SERVER['SCRIPT_NAME']; // will return /path/to/file.php
	    $bits = explode('/',$this_page);
	    $this_page = $bits[count($bits)-1]; // will return file.php, with parameters if case, like file.php?id=2
	    $this_script = $bits[0]; // will return file.php, no parameters*/
		 return $bits[2];
	  
	}

	function currentpage_admin(){
		$this_page = $_SERVER['SCRIPT_NAME']; // will return /path/to/file.php
	    $bits = explode('/',$this_page);
	    $this_page = $bits[count($bits)-1]; // will return file.php, with parameters if case, like file.php?id=2
	    $this_script = $bits[0]; // will return file.php, no parameters*/
		 return $bits[4];
	  
	}
  // echo "string " .currentpage_admin()."<br/>";

	function curPageName() {
 return substr($_SERVER['REQUEST_URI'], 21, strrpos($_SERVER['REQUEST_URI'], '/')-24);
}

  // echo "The current page name is ".curPageName();

function currentpage(){
		$this_page = $_SERVER['SCRIPT_NAME']; // will return /path/to/file.php
	    $bits = explode('/',$this_page);
	    $this_page = $bits[count($bits)-1]; // will return file.php, with parameters if case, like file.php?id=2
	    $this_script = $bits[0]; // will return file.php, no parameters*/
		 return $bits[3];
	  
	}
	function publiccurrentpage(){
		$this_page = $_SERVER['SCRIPT_NAME']; // will return /path/to/file.php
	    $bits = explode('/',$this_page);
	    $this_page = $bits[count($bits)-1]; // will return file.php, with parameters if case, like file.php?id=2
	    $this_script = $bits[0]; // will return file.php, no parameters*/
		 return $bits[2];
	  
	}
	 // echo publiccurrentpage();
	function msgBox($msg=""){
		?>
		<script type="text/javascript">
			 alert(<?php echo $msg; ?>)
		</script>
		<?php
	}

    function maxRequest($type,$status,$id) {
		global $mydb;

		switch ($type) {
			case 'Agency':
				# code...
				$sqlRequest = "SELECT COUNT(*) as maxRequest FROM `tblrequest` WHERE `RequestStatus`='{$status}' AND AgencyID='{$id}'";
				$mydb->setQuery($sqlRequest);
				$singleRequest = $mydb->loadSingleResult();
				$request = $singleRequest->maxRequest;
				break;
			case 'School'	:
				$sqlRequest = "SELECT COUNT(*) as maxRequest FROM `tblrequest` WHERE `RequestStatus`='{$status}' AND SchoolID='{$id}'";
				$mydb->setQuery($sqlRequest);
				$singleRequest = $mydb->loadSingleResult();
				$request = $singleRequest->maxRequest;
				break;
			default:
				# code...
				break;
		}

	   

	    // $sqlRequest = "SELECT COUNT(*) as maxRequest FROM `tblrequest` WHERE `RequestStatus`='{$status}'";
	    // $mydb->setQuery($sqlRequest);
	    // $singleRequest = $mydb->executeQuery();
	    // $maxrow = $mydb->num_rows($singleRequest); 

	    return $request;
	}

	function maxSchool($type,$status,$id) {
		global $mydb;

		switch ($type) {
			case 'Agency':
				# code...
				$sql = "SELECT  * FROM `tblschools` s, `tblrequestdocuments` r WHERE s.SchoolID=r.SchoolID AND `SchoolStatus`='{$status}' AND `AgencyID`='{$id}' GROUP BY s.SCHOOLID";
			    $cur = $mydb->setQuery($sql);
			    $maxrow = $mydb->num_rows($cur);
			    if ($maxrow > 0) {
			    	# code...
			  
			    $schoolStatus =$maxrow;

			    }else{
			    	$schoolStatus = 0;

			    }
				break;
			case 'School':
				# code...
				$sql = "SELECT  * FROM `tblschools` s, `tblrequestdocuments` r WHERE s.SchoolID=r.SchoolID AND `SchoolStatus`='{$status}' AND s.`SchoolID`='{$id}' GROUP BY s.SCHOOLID";
			    $cur = $mydb->setQuery($sql);
			    $maxrow = $mydb->num_rows($cur);
			    if ($maxrow > 0) {
			    	# code...
			  
			    $schoolStatus =$maxrow;

			    }else{
			    	$schoolStatus = 0;

			    }
				break;
			
			default:
				# code...
				break;
		}

	    return $schoolStatus;
	}

	function dateFormat($strdate="",$strFormat=""){
		$date = date_format(date_create($strdate),$strFormat);
		return $date;
	}

    function CalculateAge($dateFrom,$dateTo)
	{  
		$resultDays = ''; 
		$resultMonths = ''; 
		$resultYears = '';
		$date1 =$dateFrom;
		$date2 =$dateTo;

		$diff = abs(strtotime($date2) - strtotime($date1));

		$years = floor($diff / (365*60*60*24));
		$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
		$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

		if ($days > 0) {
			# code...
			$resultDays =  $days.'%d days ';
		}elseif ($months>0) {
			# code...
			$resultMonths =  $months.'%d months and ';
		}elseif ($years>0) {
			# code...
			$resultYears = $years .'%d years, ';
		}

		$resultAge = $resultYears . $resultMonths .$resultDays;

		return $resultAge; 

		// printf("%d years, %d months, %d days\n", $years, $months, $days);
	}
		
	function maxNotificationAdmin($id) {
		global $mydb;

	    $sqlSchool = "SELECT COUNT(*) as max FROM `tblnotification` WHERE AlreadyViewed=0 AND `SendTo`='{$id}'";
	    $mydb->setQuery($sqlSchool);
	    $singleNotification = $mydb->loadSingleResult();
	    $notification = $singleNotification->max;  
	    return $notification;
	}
	function maxNotificationAgency($id) {
		global $mydb;

	    $sqlSchool = "SELECT COUNT(*) as max FROM `tblnotification` WHERE AlreadyViewed=0 AND `SendTo`='{$id}'";
	    $mydb->setQuery($sqlSchool);
	    $singleNotification = $mydb->loadSingleResult();
	    $notification = $singleNotification->max;  
	    return $notification;
	}
	function maxNotification($id) {
		global $mydb;

	    $sqlSchool = "SELECT COUNT(*) as max FROM `tblnotification` WHERE AlreadyViewed=0 AND `SendTo`='{$id}'";
	    $mydb->setQuery($sqlSchool);
	    $singleNotification = $mydb->loadSingleResult();
	    $notification = $singleNotification->max;  
	    return $notification;
	}

?>