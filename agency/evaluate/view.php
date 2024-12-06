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
  <div class="card card-primary"> 
  <div class="card-header"> 
    <h3 class="card-title">Evaluation Details</h3>
  </div>
  <div class="card-body"> 
                  <div class="row">
                         <div class="col-12 col-md-12 col-lg-3 order-1 order-md-1"> 
                          <div class="card card-success"> 
                            <div class="card-header"> 
                              <h3 class="card-title">School Details</h3>
                            </div>
                            <div class="card-body"> 

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

                  <div class="col-12 col-md-12 col-lg-9 order-2 order-md-2"> 

                                  <div class="card card-danger">
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
                                            <th>List of Requirements</th> 
                                            <th>Average</th>  
                                            <th>Remarks</th>  
                                            <th>Improvements</th> 
                                            <th>Recommendations</th>
                                            <th>Action Taken</th> 
                                            <th>Level</th>  
                                            <th>Duration</th>  
                                            <th>Modify</th>  
                                            </tr> 
                                          </thead> 
                                          <tbody>
                                            <?php
                                            // SELECT `DocumentID`, `RequestID`, `RequestDocuments`, `AgencyID`, `AgencyName`, `SchooID`, `SchoolName`, `SchoolAttachment`, `CheckDocumnets`, `Status` FROM `tblrequestdocuments` WHERE 1
                                            $i=0;
                                            $totalAve=0;
                                            $sql = "SELECT *  FROM `tblrequestdocuments` WHERE AlreadyEvaluated =1 AND RequestID='$requestID'";
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
                                                $improvements =   $singleSurvey->Improvements;
                                                $recommendations =   $singleSurvey->Recommendations;
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
                                                $improvements =   'NONE';
                                                $recommendations =   'NONE';
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
                                                echo '<td>'.$improvements.'</td>';
                                                echo '<td>'.$recommendations.'</td>';
                                                echo '<td>'.$note.'</td>';
                                                echo '<td>'.$level.'</td>';
                                                echo '<td>'.$duration.'</td>';

                                                if ($singleSurvey->Remarks=='Failed') {
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
                                            // echo '  <tr><td colspan="2">Total Average</td>
                                            //   <td>'.$totalAve.'</td>
                                            //   <td>'.$rem.'</td>
                                            //   <td></td>
                                            //   <td></td>
                                            //   <td></td>
                                            //   <td></td>
                                            // </tr>';

                                            ?>
                                          
                                              
                                          </tbody> 
                                        </table>  
                                      </div>
                                      <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                          </div> 
                        </div>

</div>
</div>




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
