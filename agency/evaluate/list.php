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
                <h3 class="card-title">List of Evaluated School</h3>

                <div class="card-tools"> 
                  <a href="index.php?view=add" class="btn btn-primary btn-sm">
                    <i class="fas fa-edit"></i> Evaluate School
                  </a>
                </div>
              </div>
              <div class="card-body">

							<table id="example2"  class="table   table-hover" cellspacing="0" > 
							  <thead>
							  	<tr> 
									<th>#</th>
									<th>Schools</th> 
									<th>Date Evaluated</th> 
									<!-- <th>School Request</th> 
									<th>Date Confirmed</th>   -->
									<!-- <th>Number of Documents</th>   -->
									<th></th> 
							  	</tr>	
							  </thead> 
							  <tbody>
							  	<?php
							  	$i=0;
							  	$sql = "SELECT * FROM `tblsurvey` s, `tblrequestdocuments` d WHERE s.`DocumentID`=d.`DocumentID` AND AlreadyEvaluated=1 AND d.AgencyID='" . $_SESSION['COMPANY_USERID'] . "' GROUP BY d.RequestID ";
							  	$mydb->setQuery($sql);
							  	$cur = $mydb->loadResultList();
							  	foreach ($cur as $row) {


				                    // $sql ="SELECT `DocumentID`, `RequestID`, `RequestDocuments`, `AgencyID`, `AgencyName`, `SchoolID`, `SchoolName`, `SchoolAttachment`, `CheckDocumnets`, `Status`, `AccreditationLevel`, `DateApproved` FROM `tblrequestdocuments` WHERE 	AlreadyEvaluated=0 AND `RequestID`=".$row->RequestID;
				                    // $docu = $mydb->setQuery($sql);
				                    // $maxDocu = $mydb->num_rows($docu);
				                    // if ($maxDocu>0) {
				                    // 	# code...
				                    // 	$resDocu = $mydb->loadSingleResult(); 
				                    // }
 
							  		# code...
							  		$i = $i +1;
							  		echo '<tr>';
							  		echo '<td>'.$i.'</td>';
							  		echo '<td>'.$row->SchoolName.'</td>';
							  		echo '<td>'.dateFormat($row->DateEvaluated,'m/d/Y').'</td>';
							  		// echo '<td>'.$maxDocu.'</td>'; 
							  		// echo '<td>'.$row->RequestNotes.'</td>';
							  		// echo '<td>'.$row->ConfirmedDate.'</td>'; 
							  		echo '<td><a href="index.php?view=view&id='.$row->SchoolID.'&RequestID='.$row->RequestID.'"   class="btn btn-primary btn-sm" ><i class="fa fa-folder"></i> View Evaluation</a> </td>';
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