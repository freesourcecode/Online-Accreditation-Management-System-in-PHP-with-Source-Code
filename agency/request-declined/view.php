<?php
require_once("../../include/initialize.php");
 if(!isset($_SESSION['COMPANY_USERID'])){
  redirect(web_root."index.php");
} 

$requestID = $_GET['request'];
$notificationID = $_GET['id'];

$sql="UPDATE `tblnotification` SET `AlreadyViewed`=1 WHERE `NotificationID`='{$notificationID}'";
$mydb->setQuery($sql);

$sql = "SELECT * FROM `tblrequest`r, `tblschools` s  WHERE r.`SchoolID`=s.`SCHOOLID` AND `RequestID`='{$requestID}'";
$mydb->setQuery($sql);
$singleRequest = $mydb->loadSingleResult(); 


?>



 
    <form action="controller.php?action=requestDocuments" method="POST">
    <div class="modal-header">
      <h4 class="modal-title">School Request Details </h4>
      <a href="index.php"  aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </a>
    </div>
    <div class="modal-body">
  
          <div class="row">
            <div class="col-12 col-md-12 col-lg-12 order-2 order-md-1"> 
              <div class="row">
                <div class="col-12"> 
                    <div class="post">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="<?php echo web_root.'school/user/' .$singleRequest->S_PHOTO;?>" alt="user image">
                        <span class="username">
                          <a href="#"><?php echo $singleRequest->SCHOOLNAME;?></a>
                        </span>
                        <span class="description">School Name</span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                        <?php echo $singleRequest->RequestNotes;?>
                      </p> 
                    </div>
 
                </div>
                <p>Status:  <?php echo $singleRequest->RequestStatus;?></p>
 
              </div>
            </div>
 

    </div>
  </div>
    <div class="modal-footer justify-content-between">  
      <a href="index.php" class="btn btn-default" >Close</a> 
    </div>
  </form>
 

<!-- text editor -->
<script>
  $(function () {
    //Add text editor
    $('#compose-textarea').summernote()
  })
</script>
 