<?php
	 if(!isset($_SESSION['COMPANY_USERID'])){
      redirect(web_root."admin/index.php");
     }

?> 
 <style type="text/css"> 
td:nth-child(4),
th:nth-child(4){
	width: 1px;
  white-space: nowrap;
}
td:nth-child(5),
th:nth-child(5){
	width: 1px;
  white-space: nowrap;
}
td:nth-child(2),
th:nth-child(2){
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
                <h3 class="card-title">List of Pending Request</h3>

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
									<th>SchoolName</th> 
									<th>School Request</th> 
									<th>Date Requested</th>  
									<th>Action</th> 
							  	</tr>	
							  </thead> 
							  <tbody>
							  	<?php
							  	$i=0;
							  	$sql = "SELECT `RequestID`, `SchoolID`, `SchoolName`, `AgencyID`, `AgencyName`, `RequestNotes`, `RequestStatus`, `DateRequested`, `RequestAccepted` FROM `tblrequest` WHERE `RequestStatus` = 'Pending'  AND AgencyID=" . $_SESSION['COMPANY_USERID'];
							  	$mydb->setQuery($sql);
							  	$cur = $mydb->loadResultList();
							  	foreach ($cur as $row) {
							  		# code...
							  		$i = $i +1;
							  		echo '<tr>';
							  		echo '<td>'.$i.'</td>';
							  		echo '<td>'.$row->SchoolName.'</td>';
							  		echo '<td>'.$row->RequestNotes.'</td>';
							  		echo '<td>'.$row->DateRequested.'</td>';
							  		if ($row->RequestStatus=='Cancelled') {
							  			# code...
							  		}
							  		echo '<td align="center"><a href="#modal-lg" data-toggle="modal" class="btn btn-primary btn-sm pendingModal" data-id="'.$row->RequestID.'"><i class="fa fa-check"></i> Confirm Request </a>  <a href="controller.php?action=cancelrequest&RequestID='.$row->RequestID.'" class="btn btn-danger btn-sm" ><i class="fa fa-times"></i> Cancel Request</a> </td>';
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
 <div class="modal fade pendingModals" id="modal-lg">
     
  </div>
  <!-- /.modal -->