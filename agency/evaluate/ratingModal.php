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




    <form action="controller.php?action=addRating" method="POST">

      <div class="col-md-12"> 
              <div class="form-group">
                <label for="inputName">Rate</label>
                <input type="hidden" id="inputName"  value="<?php echo $singleDocument->DocumentID;?>"  name="DocumentID" class="form-control">
                <input type="hidden" id="inputName"  value="<?php echo isset($singleSurvey->SurveyID) ? $singleSurvey->SurveyID : '' ?>"  name="SurveyID" class="form-control">

                <input type="hidden" id="inputName"  value="<?php echo isset($singleDocument->AlreadyEvaluated) ? $singleDocument->AlreadyEvaluated : '' ?>"  name="AlreadyEvaluated" class="form-control">

                <input type="text" id="inputName" name="Rating" class="form-control" value="<?php echo isset($singleSurvey->SurveyAverage) ? $singleSurvey->SurveyAverage : '' ?>">
              </div>
              <div class="form-group">
                <label for="inputImprovements">Improvements</label>
                <textarea id="inputImprovements" class="form-control" rows="4" name="improvements"><?php echo isset($singleSurvey->Improvements) ?  $singleSurvey->Improvements : '' ?></textarea>
              </div>
              <div class="form-group">
                <label for="inputRecommendations">Recommendations</label>
                <textarea id="inputRecommendations" class="form-control" rows="4" name="recommendations"><?php echo isset($singleSurvey->Recommendations) ?  $singleSurvey->Recommendations : '' ?></textarea>
              </div>
              <div class="form-group">
                <label for="inputDescription">Action Taken</label>
                <textarea id="inputDescription" class="form-control" rows="4" name="feedBack"><?php echo isset($singleSurvey->Reason) ?  $singleSurvey->Reason : '' ?></textarea>
              </div>
       <!--        <div class="form-group">
                <label for="inputStatus">Remarks</label>
                <select id="inputStatus" name="" class="form-control custom-select">
                  <option value="" selected disabled>Select one</option>
                  <option>On Hold</option>
                  <option>Canceled</option>
                  <option>Success</option>
                </select>
              </div> -->
<!--               <div class="form-group">
                <label for="inputClientCompany">Level Attained</label>
                <input type="text" id="inputClientCompany" name="LevelAttained" class="form-control" value="<?php echo isset($singleSurvey->LevelAttained) ? $singleSurvey->LevelAttained : '' ?>">
              </div>
              <div class="form-group">
                <label for="inputProjectLeader">Date Expire</label>
                <div class="input-group date" id="DateTo" data-target-input="nearest"> 
                        <input type="text" class="form-control datetimepicker-input" data-target="#DateTo"  name="DateTo" required onkeydown="return false" value="<?php echo isset($singleSurvey->DateTo) ? $singleSurvey->DateTo : '' ?>" />
                        <div class="input-group-append" data-target="#DateTo" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
              </div>
              <div class="form-group">
                <label for="inputProjectLeader">Date Expire</label>
                <div class="input-group date" id="DateTo" data-target-input="nearest"> 
                        <input type="text" class="form-control datetimepicker-input" data-target="#DateTo"  name="DateTo" required onkeydown="return false" value="<?php echo isset($singleSurvey->DateTo) ? $singleSurvey->DateTo : '' ?>" />
                        <div class="input-group-append" data-target="#DateTo" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
              </div> -->
             
        </div>

        <div class="row">
        <div class="col-12">
          <a href="#" data-dismiss="modal" aria-label="Close"  class="btn btn-secondary">Cancel</a>
          <input type="submit" value="Save Changes" class="btn btn-success float-right">
        </div>
      </div>
    </form>