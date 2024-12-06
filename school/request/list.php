<?php
	 if(!isset($_SESSION['SCHOOLID'])){
      redirect(web_root."admin/index.php");
     }

?> 
 <style type="text/css"> 
td:nth-child(6),
th:nth-child(6),
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

      <div class="row">
        <div class="col-12"> 
             	<a href="<?php echo web_root; ?>school/request/index.php?view=send" class="btn btn-primary">
                  <i class="far fa-paper-plane "></i> Send Request   
                </a>
        </div>
      </div>
      <br/>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List of Confirmed Request</h3>

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
							<table id=""  class="table table-bordered table-striped table-sm" cellspacing="0"> 
							  <thead>
							  	<tr> 
									<th>#</th>
									<th>Name of Agency</th> 
									<th>School Request</th> 
									<th>Date</th>  
									<th>Status</th> 
									<th>Action</th>  
							  	</tr>	
							  </thead> 
							  <tbody>
							  	<?php
							  	$i=0;
							  	$sql = "SELECT * FROM `tblrequest` WHERE SCHOOLID=" . $_SESSION['SCHOOLID'];
							  	$mydb->setQuery($sql);
							  	$cur = $mydb->loadResultList();
							  	foreach ($cur as $row) {
							  		# code...
							  		$i = $i +1;
							  		echo '<tr>';
							  		echo '<td>'.$i.'</td>';
							  		echo '<td>'.$row->AgencyName.'</td>';
							  		echo '<td>'.$row->RequestNotes.'</td>';
							  		if ($row->RequestStatus=='Pending') {
							  			# code...
							  			echo '<td>'.$row->DateRequested.'</td>';
							  		}elseif ($row->RequestStatus=='Confirmed') {
							  			# code...
							  			echo '<td>'.dateFormat($row->ConfirmedDate,"m/d/Y").'</td>';
							  		}
							  		echo '<td>'.$row->RequestStatus.'</td>';
							  		echo '<td><a href="index.php?view=view&id='.$row->AgencyID.'&request='.$row->RequestID.'"   class="btn btn-primary btn-sm" ><i class="fa fa-folder"></i> View</a> </td>';
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