<?php
 if(!isset($_SESSION['SCHOOLID'])){
  redirect(web_root."admin/index.php");
}


     $requestID = isset($_GET['id']) ? $_GET['id']:'';

?>  
 <?php
      // SELECT `DocumentID`, `RequestID`, `RequestDocuments`, `AgencyID`, `AgencyName`, `SchooID`, `SchoolName`, `SchoolAttachment`, `CheckDocumnets`, `Status` FROM `tblrequestdocuments` WHERE 1

 // SELECT `NotificationID`, `CreatedBy`, `SendTo`, `NotificationDate`, `ForeignID`, `NotificationMessage`, `Category`, `AlreadyViewed` FROM `tblnotification` WHERE 1

 // SELECT `COMPANYID`, `COMPANYNAME`, `COMPANYADDRESS`, `COMPANYCONTACTNO`, `AccreditorName`, `C_Username`, `C_Password`, `Img1` FROM `tblcompany` WHERE 1

	$sql ="SELECT * FROM `tblnotification` WHERE `SendTo`=".$_SESSION['SCHOOLID']." ORDER BY  NotificationDate DESC";
	$mydb->setQuery($sql);
	$curNotif = $mydb->loadResultList();
	foreach ($curNotif as $rowNotif) {
 
      # code...
    $sql = "SELECT * FROM `tblcompany` WHERE `COMPANYID`=".$rowNotif->CreatedBy;
   
		$mydb->setQuery($sql);
		$singlresult = $mydb->loadSingleResult();

// SELECT `COMPANYID`, `COMPANYNAME`, `COMPANYADDRESS`, `COMPANYCONTACTNO`, `AccreditorName`, `C_Username`, `C_Password`, `Img1` FROM `tblcompany` WHERE 1

 ?>


  <!-- Default box -->
      <div class="card"> 
        <div class="card-body">   
   				<!-- Post -->
                    <div class="post">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="<?php echo web_root.'agency/user/'. $singlresult->Img1;?>" alt="">
                        <span class="username">
                          <a href="#"><?php echo $singlresult->COMPANYNAME;?></a>
                          <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                        </span>
                        <span class="description">Date  - <?php echo $rowNotif->NotificationDate;?></span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                      	<?php echo $rowNotif->NotificationMessage;?>
                      </p>

                      <p>

                        <?php  
 
                         ?>
                        <a href="<?php echo web_root;?>school/notification/controller.php?action=viewnotification&id=<?php echo $rowNotif->NotificationID;?>&category=<?php echo $rowNotif->Category;?>" class="btn btn-primary btn-sm"><i class="fas fa-file mr-1"></i> View Details</a> 

                        <!-- <span class="float-right">
                          <a href="#" class="link-black text-sm">
                            <i class="far fa-comments mr-1"></i> Comments (5)
                          </a>
                        </span> -->
                      </p>

                      <!-- <input class="form-control form-control-sm" type="text" placeholder="Type a comment"> -->
                    </div>
                    <!-- /.post -->

 
 
 			 </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

        
<?php       
  }
?>

 