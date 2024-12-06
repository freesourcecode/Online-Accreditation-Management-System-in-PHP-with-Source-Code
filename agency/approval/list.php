<?php
	 if(!isset($_SESSION['COMPANY_USERID'])){
      redirect(web_root."admin/index.php");
     }

?> 
 <style type="text/css"> 
td:nth-child(5),
th:nth-child(5){
	width: 1px;
  white-space: nowrap;
}
td:nth-child(4),
th:nth-child(4){
	width: 1px;
  white-space: nowrap;
}
td:nth-child(3),
th:nth-child(3){
	width: 1px;
  white-space: nowrap;
}
td:nth-child(1),
th:nth-child(1){
	width: 1px;
  white-space: nowrap;
}
 </style>
                   <!-- Default box -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List of School Waiting for Approval</h3>

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
							<table id="example2"  class="table table-bordered table-striped table-sm" cellspacing="0" style="font-size: 15px"> 
							  <thead>
							  	<tr> 
									<th>#</th>
									<th>Schools</th> 
									<!-- <th>School Request</th> 
									<th>Date Confirmed</th>   -->
									<th>Number of Documents</th>  
									<th>Action</th> 
							  	</tr>	
							  </thead> 
							  <tbody>
							  	<?php
							  	$i=0;
							  	$sql = "SELECT * FROM `tblrequest` r, `tblrequestdocuments` d WHERE r.`RequestID`=d.`RequestID` AND `RequestStatus` = 'Confirmed' AND `AlreadyEvaluated`=0 AND r.AgencyID=" . $_SESSION['COMPANY_USERID'] . " GROUP BY d.`RequestID`";
							  	$mydb->setQuery($sql);
							  	$cur = $mydb->loadResultList();
							  	foreach ($cur as $row) {


                    $sql ="SELECT `DocumentID`, `RequestID`, `RequestDocuments`, `AgencyID`, `AgencyName`, `SchoolID`, `SchoolName`, `SchoolAttachment`, `CheckDocumnets`, `Status`, `AccreditationLevel`, `DateApproved` FROM `tblrequestdocuments` WHERE 	AlreadyEvaluated=0 AND `RequestID`=".$row->RequestID;
                    $docu = $mydb->setQuery($sql);
                    $maxDocu = $mydb->num_rows($docu);
                    if ($maxDocu>0) {
                    	# code...
                    	$resDocu = $mydb->loadSingleResult(); 
                    }
 
							  		# code...
							  		$i = $i +1;
							  		echo '<tr>';
							  		echo '<td>'.$i.'</td>';
							  		echo '<td>'.$row->SchoolName.'</td>';
							  		echo '<td>'.$maxDocu.'</td>'; 
							  		// echo '<td>'.$row->RequestNotes.'</td>';
							  		// echo '<td>'.$row->ConfirmedDate.'</td>'; 
							  		echo '<td><a href="index.php?view=view&id='.$row->SchoolID.'&request='.$row->RequestID.'"   class="btn btn-primary btn-sm" ><i class="fa fa-folder"></i> View</a> </td>';
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