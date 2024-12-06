<?php
// $sql ="SELECT `LevelID`, `SurveyID`, `RequestID`, `SchoolID`, `SchoolName`, `AgencyID`, `AgencyName`, `SchoolLevel`, `ValidationDateFrom`, `ValidationDateTo`, `ValidityStatus`, `LevelAttained`, `SchoolRemarks`, `LNotes` FROM `tblschoollevel` WHERE SchoolID=".$_SESSION['SCHOOLID'];
// $curAS = $mydb->setQuery($sql);
// $maxAS = $mydb->num_rows($curAS);
// if ($maxAS>0) {
//   # code...$accreditationStatus = $mydb->loadResultList();
//   foreach ($accreditationStatus as $aResult) {
//     # code...
//     echo ' <div class="post">
//           <div class="user-block">
//             <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
//             <span class="username">
//               <a href="#">Jonathan Burke Jr.</a>
//               <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
//             </span>
//             <span class="description">Shared publicly - 7:30 PM today</span>
//           </div>
//           <!-- /.user-block -->
//           <p>
//             Lorem ipsum represents a long-held tradition for designers,
//             typographers and the like. Some people hate it and argue for
//             its demise, but others ignore the hate as they create awesome
//             tools to help create filler text for everyone from bacon lovers
//             to Charlie Sheen fans.
//           </p>

//           <p>
//             <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
//             <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
//             <span class="float-right">
//               <a href="#" class="link-black text-sm">
//                 <i class="far fa-comments mr-1"></i> Comments (5)
//               </a>
//             </span>
//           </p>

//           <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
//         </div>';
//   }
// }else{ 
//   echo '<div class="post">
//         <div class="user-block">
//           <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
//           <span class="username">
//             <a href="#">Jonathan Burke Jr.</a>
//             <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
//           </span>
//           <span class="description">Shared publicly - 7:30 PM today</span>
//         </div>
//         <!-- /.user-block -->
//         <p>
//           Lorem ipsum represents a long-held tradition for designers,
//           typographers and the like. Some people hate it and argue for
//           its demise, but others ignore the hate as they create awesome
//           tools to help create filler text for everyone from bacon lovers
//           to Charlie Sheen fans.
//         </p>

//         <p>
//           <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
//           <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
//           <span class="float-right">
//             <a href="#" class="link-black text-sm">
//               <i class="far fa-comments mr-1"></i> Comments (5)
//             </a>
//           </span>
//         </p>

//         <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
//       </div>'; 
// }



 
 

    $sql = "SELECT * FROM `tblrequest`r, `tblschools` s  WHERE r.`SchoolID`=s.`SCHOOLID` AND s.`SCHOOLID`='{$_SESSION['SCHOOLID']}'";
    $mydb->setQuery($sql);
    $singleRequest = $mydb->loadSingleResult(); 
    $requestID = $singleRequest->RequestID;
 
 ?> 
<style type="text/css"> 
td:nth-child(1),
td:nth-child(1), 
td:nth-child(3),
td:nth-child(3){
  width: 1px;
  white-space: nowrap;
}


td:nth-child(4),
td:nth-child(4){
  width:1px;
  white-space: nowrap;
}
</style> 

 
          <div class="row">
          <div class="col-12 col-md-12 col-lg-6 order-1 order-md-1">
            <div class="col-12">
              
                    <h5>School Request</h5>
                    <p>
                      <?php echo $singleRequest->RequestNotes;?>
                    </p> 
            </div>
          </div>
            
            <br/>
            <div class="col-12 col-md-12 col-lg-12 order-1 order-md-2">  
               <table id="example2"  class="table   table-hover" cellspacing="0" > 
                <thead>
                  <tr> 
                  <th>#</th> 
                    <th>Date</th> 
                    <th>Accredited Programs</th> 
                    <th>Average</th>  
                    <th>Remarks</th>  
                    <th>Comment</th>  
                    <th>Level</th>  
                    <th>Duration</th>   
                  </tr> 
                </thead> 
                <tbody>
                  <?php
                  $i=0;
                  $totalAve=0;
                  $sql = "SELECT * FROM `tblsurvey` s, `tblrequestdocuments` d WHERE s.`DocumentID`=d.`DocumentID` AND d.AgencyID='" . $_SESSION['COMPANY_USERID'] . "'";
                  $mydb->setQuery($sql);
                  $cur = $mydb->loadResultList();
                  foreach ($cur as $row) {
 
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
                            echo '<td>'.dateFormat($row->DateEvaluated,'m/d/Y').'</td>'; 
                            echo '<td>'.$row->RequestDocuments.'</td>'; 
                            echo '<td>'.$average.'</td>';
                            echo '<td>'.$remarks.' </td>';
                            echo '<td>'.$note.'</td>';
                            echo '<td>'.$level.'</td>';
                            echo '<td>'.$duration.'</td>'; 
                          
                          
                             
                        }
                        // if ($totalAve >=3) {
                        //   # code...
                        //    $rem = 'Passed';
                        // }else{
                        //    $rem = 'Failed';
                        // }
                        // echo '  <tr><td colspan="3">Total Average</td>
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
          </div> 