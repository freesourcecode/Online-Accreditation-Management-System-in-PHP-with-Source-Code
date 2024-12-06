<?php  
  if (!isset($_SESSION['COMPANY_USERID'])){
      redirect(web_root."index.php");
   }

   $requestID = isset($_GET['request']) ? $_GET['request'] :'';

$notificationID = $_GET['id'];

$sql="UPDATE `tblnotification` SET `AlreadyViewed`=1 WHERE `NotificationID`='{$notificationID}'";
$mydb->setQuery($sql);
 

    $sql = "SELECT * FROM `tblrequest`r, `tblschools` s  WHERE r.`SchoolID`=s.`SCHOOLID` AND `RequestID`='{$requestID}'";
    $mydb->setQuery($sql);
    $singleRequest = $mydb->loadSingleResult(); 
?>
 
 ?> 
<style type="text/css"> 
td:nth-child(1),
td:nth-child(1),
td:nth-child(3),
td:nth-child(3),
td:nth-child(4),
td:nth-child(4){
  width: 1px;
  white-space: nowrap;
}
</style> 

       <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Request Detail</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
           <div class="col-12 col-md-12 col-lg-5 order-2 order-md-1"> 
              <div class="row">
                <div class="col-12">
                  <h4>School Request Details</h4>
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

                <hr/>
              </div>
            </div>
            <div class="col-12 col-md-12 col-lg-7 order-1 order-md-2"> 
              <h5>School Requirements</h5>
              <p class="text-muted">These are the documents that the school are required to submit inorder to be check by an accreditor.</p> 
              <table id=""  class="table   table-sm" cellspacing="0"> 
                <thead>
                  <tr> 
                  <th>#</th> 
                  <th>Requirements</th>  
                  <th>Document Submitted by the School</th>  
                  <th>Document Status</th> 
                  </tr> 
                </thead> 
                <tbody>
                  <?php
                  // SELECT `DocumentID`, `RequestID`, `RequestDocuments`, `AgencyID`, `AgencyName`, `SchooID`, `SchoolName`, `SchoolAttachment`, `CheckDocumnets`, `Status` FROM `tblrequestdocuments` WHERE 1
                  $i=0;
                  $sql = "SELECT *  FROM `tblrequestdocuments` WHERE RequestID='$requestID'";
                  $mydb->setQuery($sql);
                  $cur = $mydb->loadResultList();
                  foreach ($cur as $row) {
                      # code...
                      $i = $i +1;
                      echo '<tr>';
                      echo '<td>'.$i.'</td>'; 
                      echo '<td>'.$row->RequestDocuments.'</td>';
                      if ($row->Status=='Pending') {
                        # code...
                        echo '<td align="center">NONE</td>';
                      }else{ 
                        echo '<td align="center"><a title="Dowload Attachment" href="'.$row->SchoolAttachment.'" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-download"></i> Document</a></td>';
                      }
                      echo '<td>'.$row->Status.'</td>';
                      echo '</tr>';
                  }

                  ?>
                </tbody> 
              </table> 
<!--            <form class="form-horizontal" action="controller.php?action=requestDocuments" method="POST">
            <div class="input-group input-group-sm mb-0">
              <input type="hidden" name="RequestID" value="<?php echo $requestID;?>">
              <input class="form-control form-control-sm" name="Document" placeholder="Add Another Requirements" required>
              <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Add</button>
              </div>
            </div>
          </form> -->
             <!--  <div class="text-center mt-5 mb-3">
                <a href="#" class="btn btn-sm btn-primary">Add files</a>
                <a href="#" class="btn btn-sm btn-warning">Report contact</a>
              </div>
            </div> -->
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
 