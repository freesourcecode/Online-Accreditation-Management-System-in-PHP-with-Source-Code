<?php 
 if(!isset($_SESSION['SCHOOLID'])){
    redirect(web_root."index.php");
   }
  
 ?> 
 <form action="controller.php?action=send" method="Post" > 
          <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Compose New Request</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="form-group">
                  <select class="form-control select2" name="AgencyID">
                    <option>Send To:</option>
                    <?php
                      $sql = "SELECT * FROM `tblcompany`";
                      $mydb->setQuery($sql);
                      $cur = $mydb->loadResultList();
                      foreach ($cur as $row) {
                        # code...
                        echo '<option value='.$row->COMPANYID.'>'.$row->COMPANYNAME.'</option>';
                      }
                    ?>
                  </select> 
                </div>
                <div class="form-group">
                  <input class="form-control" placeholder="Subject:" name="Subject">
                </div>
                <div class="form-group">
                    <textarea id="compose-textarea" class="form-control" style="height: 300px" name="RequestNotes" rows="10" placeholder="Type your request here">
                     
                    </textarea>
                </div> 
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <div class="float-right"> 
                  <button type="submit" class="btn btn-primary" name="save"><i class="far fa-envelope"></i> Send</button>
                </div> 
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>

        </form>