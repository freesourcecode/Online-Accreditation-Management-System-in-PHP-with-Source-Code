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
      <h4 class="modal-title">School Request Details</h4>
      <a href="index.php"  aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </a>
    </div>
    <div class="modal-body">
  
          <div class="row">
            <div class="col-12 col-md-12 col-lg-6 order-2 order-md-1"> 
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

                <hr/>
              </div>
            </div>
            <div class="col-12 col-md-12 col-lg-6 order-1 order-md-2">
              <h3 class="text-primary"><i class="fas fa-paint-brush"></i>School Compliance</h3>
              <p class="text-muted">Add the following requirements as basis for school evalaution.</p> 

              <!-- <h5 class="mt-5 text-muted">Project files</h5> -->
              <!-- <textarea id="compose-textarea" ></textarea> -->
              <!-- <ul class="list-unstyled">
                <li>
                  <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i> Functional-requirements.docx</a>
                </li>
                <li>
                  <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> UAT.pdf</a>
                </li>
                <li>
                  <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-envelope"></i> Email-from-flatbal.mln</a>
                </li>
                <li>
                  <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-image "></i> Logo.png</a>
                </li>
                <li>
                  <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i> Contract-10_12_2014.docx</a>
                </li>
              </ul> -->
             <!--  <div class="text-center mt-5 mb-3">
                <a href="#" class="btn btn-sm btn-primary">Add files</a>
                <a href="#" class="btn btn-sm btn-warning">Report contact</a>
              </div> -->

              <div class="container1">
                <input type="hidden" name="RequestID" value="<?php echo $requestID;?>">

                <button class="btn btn-primary add_form_field btn-sm" style="margin-bottom: 3px;">Add New Field &nbsp; <span style="font-size:16px; font-weight:bold;">+ </span></button> 
                <div class="form-group col-md-12 row"><input type="text" name="Document[]" placeholder="Requirement 1" class="form-control"></div>
              </div>
            </div> 

    </div>
  </div>
    <div class="modal-footer justify-content-between">  
      <a href="index.php" class="btn btn-default" >Close</a>
      <!-- <a href="controller.php?action=cancelrequest&RequestID=<?php echo $requestID;?>" class="btn btn-danger" >Cancel Request</a> -->
      <button type="submit" class="btn btn-primary" id="SaveChanges">Confirm Request</button>
    </div>
  </form>
 

<!-- text editor -->
<script>
  $(function () {
    //Add text editor
    $('#compose-textarea').summernote()
  })
</script>
<!-- add fields -->
<script>
$(document).ready(function() {
    var max_fields      = 10;
    var wrapper         = $(".container1");
    var add_button      = $(".add_form_field");
 
    var x = 1;
    $(add_button).click(function(e){
        e.preventDefault();
        if(x < max_fields){
            x++;
            $(wrapper).append('<div class="col-md-12"><div class="form-group row"><input type="text" placeholder="Requirement '+x+'" name="Document[]"  id="Document[]" class="form-control col-lg-11"/><a href="#" class="btn btn-danger btn-sm delete col-lg-1"><i class="fa fa-trash"></i></a></div></div>'); //add input box
        }
  else
  {
  alert('You Reached the limits')
  }
    });
 
    $(wrapper).on("click",".delete", function(e){
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>
<!-- ajax saving documents -->
<script type="text/javascript">
  $("#SaveChanges").click(function(e){
   //      e.preventDefault();
 
   // var id = $("#Document2").val();
   // alert(id)

 //  $.ajax({ 
 //        url: "statusModal.php", 
 //        type:"POST",  
 //        data: {  RequestID: id},
 //        success: function(data) {
 //          console.log(data); 
 //          $(".pendingModals").html(data)
 //        },
 //        error: function(data) {
 //          console.log(data);
 //        }
 //  });

 
});
</script>