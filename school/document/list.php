<?php
	 if(!isset($_SESSION['SCHOOLID'])){
      redirect(web_root."index.php");
     }

     $notificationID = isset($_GET['id']) ? $_GET['id']:'';


    $sql="UPDATE `tblnotification` SET `AlreadyViewed`=1 WHERE `NotificationID`='{$notificationID}'";
    $mydb->setQuery($sql);


    @$sql ="SELECT * FROM `tblnotification` WHERE `NotificationID`='{$notificationID}'";
	@$mydb->setQuery($sql); 
	@$rowNotif = $mydb->loadSingleResult();  
     @$companyID = $rowNotif->CreatedBy;

     if ($notificationID=='') {
     	# code...
     	$cardTitle = "List of Documents";
     }else{
	     $sql ="SELECT * FROM `tblcompany` WHERE `COMPANYID`='{$companyID}' LIMIT 1";
	     $mydb->setQuery($sql);
	     $singleRequest = $mydb->loadSingleResult();
	     $cardTitle = "These are the following documents need to comply by school. <br/>Requsted by: " . $singleRequest->COMPANYNAME;

     }


?> 
 <style type="text/css"> 
td:nth-child(3),
th:nth-child(3){
	width: 1px;
  white-space: nowrap;
}
/*td:nth-child(5),
th:nth-child(5){
	width: 1px;
  white-space: nowrap;
}*/
/*td:nth-child(2),
th:nth-child(2){
	width: 1px;
  white-space: nowrap;
}*/
td:nth-child(1),
th:nth-child(1) {
	width: 1px;
  white-space: nowrap;

}

td:nth-child(2),
th:nth-child(2) {
	width: 1px;
  white-space: nowrap;

}
td:nth-child(4),
th:nth-child(4),
td:nth-child(5),
th:nth-child(5){
	width: 1px;
  white-space: nowrap;
}


 </style>
                   <!-- Default box -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><?php echo $cardTitle;?></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>

                <div></div>

              </div>
              <div class="card-body">



							<table id=""  class="table table-bordered table-striped table-sm" cellspacing="0"> 
							  <thead>
							  	<tr> 
									<th>#</th> 
									<th>Requested By (Agency)</th>  
									<th>Document Need to Comply</th> 
									<th>Upload Status</th>  
									<th>Document</th>  
							  	</tr>	
							  </thead> 
							  <tbody>
							  	<?php
							  	// SELECT `DocumentID`, `RequestID`, `RequestDocuments`, `AgencyID`, `AgencyName`, `SchooID`, `SchoolName`, `SchoolAttachment`, `CheckDocumnets`, `Status` FROM `tblrequestdocuments` WHERE 1
							  	$i=0; 
							  		# code...
							  	$sql = "SELECT *  FROM `tblrequestdocuments`  WHERE SchoolID=".$_SESSION['SCHOOLID'];
							  	$mydb->setQuery($sql);
							  	$cur = $mydb->loadResultList();
							  	 foreach ($cur as $row) {
					                      # code...
					                      $i = $i +1;
					                      echo '<tr>';
					                      echo '<td>'.$i.'</td>'; 
					                      echo '<td>'.$row->AgencyName.'</td>';
					                      echo '<td>'.$row->RequestDocuments.'</td>';
					                      echo '<td>'.$row->Status.'</td>';
					                      if ($row->Status=='Pending') {
					                        # code...
					                        echo '<td align="center"><a href="#modal-lg" data-toggle="modal"  title="Upload Document"  target="_blank" class="uploadModal btn btn-primary btn-sm" data-id="'.$row->DocumentID.'" ><i class="fa fa-upload"></i></a></td>';
					                      }else  if ($row->Status=='Approved'){ 
					                      	  echo '<td align="center">   <a title="Dowload Attachment" href="'.$row->SchoolAttachment.'" target="_blank"  class="btn btn-success btn-sm"><i class="fa fa-download"></i> Download</a> </td>';
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
 
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                Footer
              </div>
              <!-- /.card-footer-->
            </div>
            <!-- /.card -->           

<!-- modal -->
 <div class="modal fade uploadModals" id="modal-lg">
     
  </div>
  <!-- /.modal -->