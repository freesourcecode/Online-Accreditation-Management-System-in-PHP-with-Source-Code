<?php
	 if(!isset($_SESSION['SCHOOLID'])){
      redirect(web_root."index.php");
     }

?> 
 <style type="text/css"> 
td:nth-child(4),
th:nth-child(4){
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
							<table id="example2"  class="table table-bordered table-striped" cellspacing="0"> 
							  <thead>
							  	<tr> 
									<th>#</th>
									<th>SchoolName</th> 
									<th>RequestNotes</th> 
									<th>Date</th>  
							  	</tr>	
							  </thead> 
							  <tbody>
							  	<?php
							  	$i=0;
							  	$sql = "SELECT `RequestID`, `SchoolID`, `SchoolName`, `AgencyID`, `AgencyName`, `RequestNotes`, `RequestStatus`, `DateRequested`, `RequestAccepted` FROM `tblrequest` WHERE `RequestStatus` = 'Pending'";
							  	$mydb->setQuery($sql);
							  	$cur = $mydb->loadResultList();
							  	foreach ($cur as $row) {
							  		# code...
							  		$i = $i +1;
							  		echo '<tr>';
							  		echo '<td>'.$i.'</td>';
							  		echo '<td>'.$result->SchoolName.'</td>';
							  		echo '<td>'.$result->RequestNotes.'</td>';
							  		echo '<td>'.$result->DateRequested.'</td>';
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