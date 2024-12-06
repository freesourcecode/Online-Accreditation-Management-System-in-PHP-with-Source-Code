<?php  
// SELECT `SCHOOLID`, `SCHOOLNAME`, `FNAME`, `LNAME`, `MNAME`, `ADDRESS`, `USERNAME`, `PASS`, `EMAILADDRESS`, `CONTACTNO`, `S_PHOTO`, `SchoolStatus` FROM `tblschools` WHERE 1

// SELECT `LevelID`, `RequestID`, `SchoolID`, `SchoolName`, `AgencyID`, `AgencyName`, `SchoolLevel`, `ValidationDateFrom`, `ValidationDateTo`, `ValidityStatus`, `LevelAttained`, `SchoolRemarks`, `LNotes` FROM `tblschoollevel` WHERE 1

// SELECT `RequestID`, `SchoolID`, `SchoolName`, `AgencyID`, `AgencyName`, `RequestNotes`, `RequestStatus`, `DateRequested`, `RequestAccepted`, `ConfirmedDate`, `DeclinedDate` FROM `tblrequest` WHERE 1

  if (!isset($_SESSION['SCHOOLID'])){
      redirect(web_root."index.php");
   }
 

    $sql = "SELECT * FROM `tblschools` WHERE `SCHOOLID`=".$_SESSION['SCHOOLID'];
    $mydb->setQuery($sql);
    $singleSchool = $mydb->loadSingleResult();
 
 ?> 

    <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                 <a  data-target="#myModal" data-toggle="modal" href="" title="Click here to Change Image." >
                  <img class="profile-user-img img-fluid img-circle"
                       src="<?php echo web_root.'school/user/'.$singleSchool->S_PHOTO;?>"
                       alt="User profile picture">
                     </a>
                </div>

                <h3 class="profile-username text-center"><?php echo  $singleSchool->SCHOOLNAME;?></h3>

                <p class="text-muted text-center" style="font-size: 12px">School Name</p>

                <ul class="list-group list-group-unbordered mb-3" style="font-size: 12px">
                  <li class="list-group-item">
                    <b>Contact #</b> <a class="float-right"><?php echo  $singleSchool->CONTACTNO;?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right"><?php echo  $singleSchool->EMAILADDRESS;?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Status</b> <a class="float-right"><?php echo  $singleSchool->SchoolStatus;?></a>
                  </li>
                </ul> 
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card --> 
 
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Accreditation Status</a></li>
                  <!-- <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li> -->
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Modify Account</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                      <?php include 'activity.php';?>
                  
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                      <?php include 'timeline.php';?>
                 
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                      <?php include 'modifyaccount.php';?>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
         </div>
         <!-- row -->



<!-- Modal -->
          <div class="modal fade" id="myModal" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel">Choose Image.</h4>
                  <button class="close" data-dismiss="modal" type=
                  "button">×</button> 
                </div>

                <form action="controller.php?action=photos" enctype="multipart/form-data" method="post">
                  <div class="modal-body">
                    <div class="form-group">
                      <div class="rows">
                        <div class="col-md-12">
                          <div class="rows">
                            <div class="col-md-8"> 
                              <input name="MAX_FILE_SIZE" type=
                              "hidden" value="1000000"> <input id=
                              "photo" name="photo" type=
                              "file">
                            </div>

                            <div class="col-md-4"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Close</button> <button class="btn btn-primary"
                    name="savephoto" type="submit">Upload Photo</button>
                  </div>
                </form>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->