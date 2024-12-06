<?php
require_once("../../include/initialize.php");
 if(!isset($_SESSION['SCHOOLID'])){
  redirect(web_root."index.php");
} 

$documentID = $_POST['DocumentID'];

$sql = "SELECT * FROM `tblrequestdocuments` WHERE `DocumentID`='{$documentID}'";
$mydb->setQuery($sql);
$singleRequest = $mydb->loadSingleResult(); 



?>




<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <form action="controller.php?action=requestDocuments" method="POST" enctype="multipart/form-data">
    <div class="modal-header">
      <h4 class="modal-title">Requested Documents</h4>
      <a href="index.php?view=view&id=<?php echo $singleRequest->AgencyID;?>&request=<?php echo $singleRequest->RequestID;?>"  aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </a>
    </div>
    <div class="modal-body"> 
                 <input type="hidden" name="DocumentID" value="<?php echo $singleRequest->DocumentID;?>"> 

                <div class="form-group">
                  <label for="exampleInputEmail1">Agency: </label>
                  <p><?php echo $singleRequest->AgencyName;?></p>
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Type of document need to submit: </label>
                  <p><?php echo $singleRequest->RequestDocuments;?></p>
                </div> 
                <div class="form-group">
                  <label for="exampleInputFile">Attachment File</label>
                  <input type="file" name="files" id="exampleInputFile"> 
                  <p class="help-block">Upload File Extension:  .pdf, .docs</p>
                </div> 
           
    </div> 
    <div class="modal-footer justify-content-between">
<!--       <a href="controller.php?action=cancelrequest&RequestID=<?php echo $requestID;?>" class="btn btn-danger" >Cancel Request</a> -->
      <button type="submit" class="btn btn-primary" id="SaveChanges">Upload File</button>
    </div>
  </form>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->

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
            $(wrapper).append('<div class="col-md-12"><div class="form-group row"><input type="text" placeholder="Document '+x+'" name="Document[]"  id="Document[]" class="form-control col-lg-11"/><a href="#" class="btn btn-danger btn-sm delete col-lg-1"><i class="fa fa-trash"></i></a></div></div>'); //add input box
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