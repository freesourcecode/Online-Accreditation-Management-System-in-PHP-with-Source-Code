<?php
require_once("../../include/initialize.php");
 if(!isset($_SESSION['COMPANY_USERID'])){
  redirect(web_root."index.php");
} 

$documentID = $_POST['DocumentID'];

$sql = "SELECT * FROM `tblrequestdocuments` WHERE `DocumentID`='{$documentID}'";
$mydb->setQuery($sql);
$singleDocument = $mydb->loadSingleResult(); 


// SELECT `SurveyID`, `RequestID`, `DocumentID`, `AgencyName`, `SchoolName`, `SurveyAverage`, `Remarks`, `Reason`, `LevelAttained`, `DateFrom`, `DateTo`, `ValidityStatus` FROM `tblsurvey` WHERE 1

$sql = "SELECT * FROM `tblsurvey` WHERE `DocumentID`='{$documentID}'";
$mydb->setQuery($sql);
$singleSurvey = $mydb->loadSingleResult(); 
?>




    <form action="controller.php?action=setDuration" method="POST">

      <div class="col-md-12"> 
              <div class="form-group">
                <label for="inputName">Rate: </label>
                <input type="hidden" id="inputName"  value="<?php echo $singleDocument->DocumentID;?>"  name="DocumentID" class="form-control">
                <input type="hidden" id="inputName"  value="<?php echo isset($singleSurvey->SurveyID) ? $singleSurvey->SurveyID : '' ?>"  name="SurveyID" class="form-control"> <?php echo isset($singleSurvey->SurveyAverage) ? $singleSurvey->SurveyAverage : '' ?> 
              </div>
              <div class="form-group">
                <label for="inputDescription">Remarks: </label><?php echo isset($singleSurvey->Remarks) ?  $singleSurvey->Remarks : '' ?> 
              </div>
              <hr/>
       <!--        <div class="form-group">
                <label for="inputStatus">Remarks</label>
                <select id="inputStatus" name="" class="form-control custom-select">
                  <option value="" selected disabled>Select one</option>
                  <option>On Hold</option>
                  <option>Canceled</option>
                  <option>Success</option>
                </select>
              </div> -->
              <div class="form-group">
                <label for="inputClientCompany">Level Attained</label>
                <input type="text" id="inputClientCompany" name="LevelAttained" class="form-control" value="<?php echo isset($singleSurvey->LevelAttained) ? $singleSurvey->LevelAttained : '' ?>">
              </div>
              <div class="form-group">
                <label for="inputProjectLeader">Start Duration</label>
                <div class="input-group date" id="DateFrom" data-target-input="nearest"> 
                        <input data-toggle="datetimepicker" type="text" class="form-control datetimepicker-input dFrom" data-target="#DateFrom"  name="DateFrom" required  value="<?php echo isset($singleSurvey->DateFrom) ? dateFormat($singleSurvey->DateFrom,'m/d/Y') : '' ?>" />
                        <div class="input-group-append" data-target="#DateFrom" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
              </div>
              <div class="form-group">
                <label for="inputProjectLeader">End Duration</label>
                <div class="input-group date" id="DateTo" data-target-input="nearest"> 
                        <input data-toggle="datetimepicker" type="text" class="form-control datetimepicker-input dTo" data-target="#DateTo"  name="DateTo" required  value="<?php echo isset($singleSurvey->DateTo) ? dateFormat($singleSurvey->DateTo,'m/d/Y') : '' ?>" />
                        <div class="input-group-append" data-target="#DateTo" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
              </div>
             
        </div>

        <div class="row">
        <div class="col-12">
          <a href="#" data-dismiss="modal" aria-label="Close"  class="btn btn-secondary">Cancel</a>
          <input type="submit" value="Save Changes" class="btn btn-success float-right">
        </div>
      </div>
    </form>

<script type="text/javascript">


    $('#DateTo').datetimepicker({ 
     format: 'L'
   });
    $('#DateFrom').datetimepicker({ 
     format: 'L'
   });
        // $('#DateTo').datetimepicker({
    //     format: 'L'
    // });
  </script>