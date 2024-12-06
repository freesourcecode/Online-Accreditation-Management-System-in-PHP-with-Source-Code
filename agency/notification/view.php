<?php  
  if (!isset($_SESSION['SCHOOLID'])){
      redirect(web_root."index.php");
   }

   $requestID = isset($_GET['request']) ? $_GET['request'] :'';

   $agencyID = isset($_GET['id']) ? $_GET['id'] :''; 

   $category = isset($_GET['category']) ? $_GET['category'] :''; 

 

          if ($category=='Request Accreditation') {
            # code...
             $sql = "SELECT * FROM `tblrequest` WHERE `RequestID`=".$rowNotif->ForeignID;
          }elseif ($category=='Requesting Documents') {
            # code...
             $sql = "SELECT * FROM `tblrequestdocuments` WHERE `RequestID`=".$rowNotif->ForeignID;
          }elseif ($category=='Upload Document') {
            # code...
             $sql = "SELECT * FROM `tblrequestdocuments` WHERE `RequestID`=".$rowNotif->ForeignID;
          }elseif ($category=='Schedule') {
            # code...
             $sql = "SELECT * FROM `tblschedule` WHERE `ScheduleID`=".$rowNotif->ForeignID;
          }
          $mydb->setQuery($sql);
          $singleResult = $mydb->loadSingleResult();
 
 ?> 
<style type="text/css"> 
td:nth-child(1),
td:nth-child(1),
td:nth-child(3),
td:nth-child(3),
td:nth-child(4),
th:nth-child(4){
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
            <div class="col-12 col-md-12 col-lg-4 order-2 order-md-1">
               
              <div class="row">
                <div class="col-12"> 
                  <h5>Agency Details</h5>
                    <div class="post">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="<?php echo $singleRequest->Img1; ?>" alt="">
                        <span class="username">
                          <a href="#"><?php echo $singleRequest->COMPANYNAME; ?></a>
                        </span>
                        <span class="description">Agency Name</span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                       <i class="fa fa-map-marker"></i> <?php echo $singleRequest->COMPANYADDRESS; ?>
                      </p>
                      <ul class="list-unstyled">
                        <li>
                          <a href="" class="btn-link text-secondary"><i class="fa fa-phone"></i> <?php echo $singleRequest->COMPANYCONTACTNO; ?></a>
                        </li> 
                      </ul>
                      <h5>School Request</h5>
                      <p>
                       <?php echo $singleRequest->RequestNotes; ?>
                      </p>
 
                    </div>
  
                </div>
              </div>
            </div>
            <div class="col-12 col-md-12 col-lg-8 order-1 order-md-2"> 
              <h5>School Requirements</h5>
              <p class="text-muted">These are the documents that the school are required to submit inorder to be check by an accreditor.</p> 
              <table id=""  class="table table-bordered table-striped table-sm" cellspacing="0"> 
                <thead>
                  <tr> 
                  <th>#</th> 
                  <th>Document need to Comply</th> 
                  <th>Upload Status</th>  
                  <th>Action</th>  
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
                      echo '<td>'.$row->Status.'</td>';
                      if ($row->Status=='Pending') {
                        # code...
                        echo '<td align="center"><a href="#modal-lg" data-toggle="modal"  title="Upload Document"  target="_blank" class="uploadModal btn btn-primary btn-sm" data-id="'.$row->DocumentID.'" ><i class="fa fa-upload"></i></a></td>';
                      }else{ 
                        echo '<td align="center">
                        <a title="Dowload Attachment" href="'.$row->SchoolAttachment.'" target="_blank"  class="btn btn-success btn-sm"><i class="fa fa-download"></i></a> 
                        <a href="#modal-lg" data-toggle="modal"  title="Change Document"  target="_blank" class="uploadModal btn btn-primary btn-sm" data-id="'.$row->DocumentID.'" ><i class="fa fa-upload"></i> </a> 
                        <a href="controller.php?action=remove&id='.$row->DocumentID.'"  title="Remove uploaded Document"   class="btn btn-danger btn-sm" ><i class="fa fa-trash"></i> </a>
                        </td>';
                      }
                      echo '</tr>';
                  }

                  ?>
                </tbody> 
              </table>  
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
 

 <!-- modal -->
 <div class="modal fade uploadModals" id="modal-lg">
     
  </div>
  <!-- /.modal -->