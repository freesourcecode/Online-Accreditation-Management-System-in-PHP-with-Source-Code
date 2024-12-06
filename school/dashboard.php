<?php
   if(!isset($_SESSION['SCHOOLID'])){
      redirect(web_root."index.php");
     }

?>  


    <!-- Main content -->
 
        <div class="row">
          
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-body p-0">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid --> 

