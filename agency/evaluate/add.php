<?php  
  if (!isset($_SESSION['COMPANY_USERID'])){
      redirect(web_root."index.php");
   }
 
 

?>
  
<style type="text/css"> 
td:nth-child(1),
td:nth-child(1),
td:nth-child(3),
th:nth-child(3),
td:nth-child(4),
td:nth-child(4),
td:nth-child(6),
td:nth-child(6),
td:nth-child(7),
td:nth-child(7),
td:nth-child(8),
td:nth-child(8){
  width: 1px;
  white-space: nowrap;
}
</style> 
    
    <?php 

   $requestID = isset($_GET['RequestID']) ? $_GET['RequestID'] :''; 
    $sql = "SELECT * FROM `tblrequest`r, `tblschools` s  WHERE r.`SchoolID`=s.`SCHOOLID` AND `RequestID`='{$requestID}'";
    $mydb->setQuery($sql);
    $singleRequest = $mydb->loadSingleResult(); 
    
?>
       <div class="col-12 col-md-12 col-lg-12 order-1 order-md-1"> 
        <div class="card card-info"> 
          <div class="card-header"> 
              <form class="form-horizontal" action="index.php?view=add" method="GET">
                <div class="form-group d-flex align-items-center">
                  <div class="flex-fill">
                    <input type="hidden" name="view" value="add">
                     <select class="form-control select2bs4"  name="RequestID" >
                        <option value="">Select School</option>
                       <?php 
                          $sql ="SELECT * FROM `tblschools`s, `tblrequestdocuments` r WHERE s.`SCHOOLID`=r.`SchoolID` AND  Scheduled=1 AND `AlreadyEvaluated` = 0 AND `AgencyID`=".$_SESSION['COMPANY_USERID'] . " GROUP BY RequestID";
                          $mydb->setQuery($sql);
                          $curSchool = $mydb->loadResultList();
                          foreach ($curSchool as $row) {
                            # code...
                            echo '<option value='.$row->RequestID.'>'.$row->SCHOOLNAME.'</option>';
                          }
                          ?>

                        </select>
                  </div>
                  <span class="input-group-icon">
                    <button class="btn btn-primary ">
                    <i class="fa fa-search"></i> Search</button>
            </span>
          </div>
             
          </form> 
          </div>
          <div class="card-body">
            <h3 >School Details</h3>

              <div class="row">
                <div class="col-12">
                  <h4></h4>
                    <div class="post">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="<?php echo web_root.'school/user/' .$singleRequest->S_PHOTO;?>"  >
                        <span class="username">
                          <a href="#"><?php echo isset($singleRequest->SCHOOLNAME)?$singleRequest->SCHOOLNAME:'No result';?></a>
                        </span>
                        <span class="description">School Name</span>
                      </div> 
                    </div>
 
                </div> 
              </div>
            </div>
          </div>
    </div> 
<form action="controller.php?action=saveEvaluation" method="POST">
          <div class="row">
           
            <div class="col-12 col-md-12 col-lg-12 order-1 order-md-1"> 

                <div class="card card-info">
                    <div class="card-header">
                      <h3 class="card-title">Evaluate</h3>

                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body p-0">
                      <table id=""  class="table table-hover  table-sm" cellspacing="0"> 
                        <thead>
                          <tr> 
                          <th>#</th> 
                          <th>Accredited Programs</th> 
                          <th>Average</th>  
                          <th>Remarks</th>  
                          <th>Comment</th>  
                          <th>Level</th>  
                          <th>Duration</th>  
                          <th>Action</th>  
                          </tr> 
                        </thead> 
                        <tbody>
                          <?php
                          // SELECT `DocumentID`, `RequestID`, `RequestDocuments`, `AgencyID`, `AgencyName`, `SchooID`, `SchoolName`, `SchoolAttachment`, `CheckDocumnets`, `Status` FROM `tblrequestdocuments` WHERE 1
                          $i=0;
                          $totalAve=0;
                          $sql = "SELECT *  FROM `tblrequestdocuments` WHERE AlreadyEvaluated =0 AND RequestID='$requestID'";
                          $mydb->setQuery($sql);
                          $cur = $mydb->loadResultList();
                          foreach ($cur as $row) {
                              # code...

    // SELECT `SurveyID`, `RequestID`, `DocumentID`, `AgencyName`, `SchoolName`, `SurveyAverage`, `Remarks`, `Reason`, `LevelAttained`, `DateFrom`, `DateTo`, `ValidityStatus` FROM `tblsurvey` WHERE 1
    
                            $sql ="SELECT * FROM `tblsurvey` WHERE  `DocumentID`=" .$row->DocumentID;
                            $curSurvey = $mydb->setQuery($sql);
                            $maxSurvey = $mydb->num_rows($curSurvey);

                            if ($maxSurvey > 0) {
                              # code...

                              $singleSurvey = $mydb->loadSingleResult();

                              $average = $singleSurvey->SurveyAverage;
                              $remarks = $singleSurvey->Remarks;
                              $note =   $singleSurvey->Reason;
                              $level =   $singleSurvey->LevelAttained;
                              $duration =   $singleSurvey->DateFrom . ' - ' . $singleSurvey->DateTo;
                              if ($duration>0) {
                                # code...
                                   $duration =   $singleSurvey->DateFrom . ' - ' . $singleSurvey->DateTo;
                              }else{
                                  $duration ='NONE';
                              }
                              $btnSet = '<a href="#modal-md.DurationModal" data-toggle="modal" class="btn btn-success btn-sm ratingDurationModal"  data-id="'.$row->DocumentID.'" ><i class="fas fa-clock"></i> Duration</a/>';

                            }else{ 
                              $average = 0;
                              $remarks ='NONE';
                              $note =   'NONE';
                              $level =   'N/A';
                              $duration = 'NONE';
                              $btnSet = '';

                            }

                              $totalAve = $totalAve + $average;

                              $i = $i +1;
                              echo '<tr>';
                              echo '<td>'.$i.'</td>'; 
                              echo '<td><input type="hidden" name="DocumentID[]" value="'.$row->DocumentID.'" />'.$row->RequestDocuments.'</td>';
                              echo '<td>'.$average.'</td>';
                              echo '<td>'.$remarks.' </td>';
                              echo '<td>'.$note.'</td>';
                              echo '<td>'.$level.'</td>';
                              echo '<td>'.$duration.'</td>';

                              if ($remarks=='Failed') {
                                # code...
                                  echo  '<td class="text-right py-0 align-middle"> 
                                        <a href="#modal-md.ratingModals" data-toggle="modal" class="btn btn-primary btn-sm ratingModal" data-id="'.$row->DocumentID.'" data-title="Rate"><i class="fas fa-edit"></i> Ratings</a>  
                                    </td>';
                              }else{
                                  echo  '<td class="text-right py-0 align-middle"> 
                                         '.$btnSet.'
                                        <a href="#modal-md.ratingModals" data-toggle="modal" class="btn btn-primary btn-sm ratingModal" data-id="'.$row->DocumentID.'" ><i class="fas fa-edit"></i> Ratings</a> 
                                    </td>';
                              }
                            
                               
                          }
                          if ($totalAve >=3) {
                            # code...
                             $rem = 'Passed';
                          }else{
                             $rem = 'Failed';
                          }
                          echo '  <tr><td colspan="2">Total Average</td>
                            <td>'.$totalAve.'</td>
                            <td>'.$rem.'</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr>';

                          ?>
                        
                            
                        </tbody> 
                      </table>  
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
        </div>
      </div>
        <!--/ row -->
       <?php if ($requestID!='') { ?>
       <div class="row">
        <div class="col-12">
          <a href="index.php" class="btn btn-secondary">Back</a>
          <input type="submit" value="Save Evaluation" class="btn btn-success float-right">
        </div>
      </div>
      <br/>
    </form>
      <br/>
      <?php } ?>



<!-- modal -->
 <div class="modal fade  ratingModals" id="modal-md">
  <div class="modal-dialog modal-md">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Rate</h4>
      <a href="#p" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </a>
    </div>
    <div class="modal-body ">
      <div class="ratingModalDisplay"></div>  
    </div>  
</div>
</div>    
  </div>
  <!-- /.modal -->
  <!-- modal -->
 <div class="modal fade  DurationModal" id="modal-md">
  <div class="modal-dialog modal-md">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Set Duration</h4>
      <a href="#p" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </a>
    </div>
    <div class="modal-body ">
      <div class="ratingDurationModalDisplay"></div>  
    </div>  
</div>
</div>    
  </div>
  <!-- /.modal -->
 