<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $title?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo web_root; ?>agency/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo web_root; ?>agency/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo web_root; ?>agency/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo web_root; ?>agency/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo web_root; ?>agency/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo web_root; ?>agency/plugins/summernote/summernote-bs4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo web_root; ?>agency/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo web_root; ?>agency/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo web_root; ?>agency/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo web_root; ?>agency/plugins/toastr/toastr.min.css">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="<?php echo web_root; ?>agency/plugins/fullcalendar/main.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo web_root; ?>agency/plugins/daterangepicker/daterangepicker.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo web_root; ?>agency/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo web_root; ?>agency/dist/css/adminlte.min.css">
</head>
<?php
    $company = New Company();
    $singlecompany = $company->single_company($_SESSION['COMPANY_USERID']);  
?>
 
<body class="hold-transition sidebar-mini layout-fixed">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo web_root; ?>" target="_blank" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
           
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge"><?php echo maxNotification($_SESSION['COMPANY_USERID']);?></span>
        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"><?php echo maxNotification($_SESSION['COMPANY_USERID']);?> Notifications</span>

          <?php
            $sql ="SELECT * FROM `tblnotification` WHERE `AlreadyViewed`=0 AND `SendTo`=".$_SESSION['COMPANY_USERID']. " ORDER BY  NotificationDate DESC LIMIT 4";
            $mydb->setQuery($sql);
            $curNotif = $mydb->loadResultList();
            foreach ($curNotif as $rowNotif) {
            ?> 
                       <div class="dropdown-divider"></div>
                        <a href="<?php echo web_root;?>agency/notification/controller.php?action=viewnotification&id=<?php echo $rowNotif->NotificationID;?>&category=<?php echo $rowNotif->Category;?>" class="dropdown-item">
                        <!--   <i class="fas fa-envelope mr-2"></i> --> <p> <?php echo $rowNotif->NotificationMessage;?>
                          <span class="float-right text-muted text-sm">3 mins</span></p>
                        </a>
          <?php    }

          ?> 
        
          <div class="dropdown-divider"></div>
          <a href="<?php echo web_root; ?>agency/notification/" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li> 
      <li class="nav-item">
        <a href="#" class="nav-link"></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo web_root; ?>agency/user/" class="brand-link">
      <img src="<?php echo web_root; ?>agency/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Agency Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo web_root; ?>agency/user/<?php echo $singlecompany->Img1; ?>" class="img-circle elevation-2" alt="">
        </div>
        <div class="info">
          <a href="<?php echo web_root; ?>agency/user/" class="d-block"><?php echo $singlecompany->COMPANYNAME; ?></a>
        </div>
      </div>
 

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?php echo web_root?>agency/" class="nav-link  <?php echo (currentpage() == 'index.php') ? "active" : false;?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard 
              </p>
            </a>
          
          </li>  
          <li class="nav-item <?php echo (currentpage() == 'request-pending' || currentpage() == 'request-confirmed' || currentpage() == 'request-declined') ? "menu-open" : false;?> ">
            <a href="#" class="nav-link  <?php echo (currentpage() == 'request-pending' || currentpage() == 'request-confirmed' || currentpage() == 'request-declined') ? "active" : false;?>  ">
              <i class="nav-icon fas fa-rocket"></i>
              <p>
                Requested School
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo web_root; ?>agency/request-pending" class="nav-link <?php echo (currentpage() == 'request-pending') ? "active" : false;?> ">
                  <i class="far fa-circle nav-icon text-info"></i>
                  <p>Pending 
                    <span class="badge badge-info right"><?php echo maxRequest('Agency','Pending',$_SESSION['COMPANY_USERID']);?></span>
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo web_root; ?>agency/request-confirmed" class="nav-link <?php echo (currentpage() == 'request-confirmed') ? "active" : false;?>">
                  <i class="far fa-circle nav-icon text-primary"></i>
                  <p>Confirmed 
                    <span class="badge badge-primary right"><?php echo maxRequest('Agency','Confirmed',$_SESSION['COMPANY_USERID']);?></span>
                  </p>
                </a>
              </li> 
              <li class="nav-item">
                <a href="<?php echo web_root; ?>agency/request-declined" class="nav-link <?php echo (currentpage() == 'request-declined') ? "active" : false;?>">
                  <i class="far fa-circle nav-icon text-danger"></i>
                  <p>Declined 
                    <span class="badge badge-danger right"><?php echo maxRequest('Agency','Declined',$_SESSION['COMPANY_USERID']);?></span>
                  </p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?php echo web_root; ?>agency/approval/" class="nav-link <?php echo (currentpage() == 'approval') ? "active" : false;?>"> 
              <!-- <i class="nav-icon fas fa-check"></i> -->
              <i class="nav-icon fas fa-file"></i>
              <p>
                Documents Approval
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo web_root; ?>agency/scheduling/" class="nav-link <?php echo (currentpage() == 'scheduling') ? "active" : false;?>"> 
              <!-- <i class="nav-icon fas fa-check"></i> -->
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                Scheduling
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo web_root; ?>agency/evaluate" class="nav-link <?php echo (currentpage() == 'evaluate') ? "active" : false;?>"> 
              <i class="nav-icon fas fa-star"></i>
              <p>
                School Evaluation  
              </p>
            </a>
          </li>
          <li class="nav-item <?php echo (currentpage() == 'school-accredited' || currentpage() == 'school-proccessing' || currentpage() == 'school-failed') ? "menu-open" : false;?>">
            <a href="<?php echo web_root; ?>agency/school-proccessing" class="nav-link <?php echo (currentpage() == 'school-proccessing') ? "active" : false;?>" class="nav-link <?php echo (currentpage() == 'school-accredited' || currentpage() == 'school-proccessing' || currentpage() == 'school-failed') ? "active" : false;?>">
              <i class="nav-icon fas fa-school"></i>
              <p>
                Schools 
              </p>
            </a>
            
          </li>  
          <!-- <li class="nav-item">
            <a href="<?php echo web_root; ?>agency/reports" class="nav-link <?php echo (currentpage() == 'reports') ? "active" : false;?>">
              <i class="nav-icon far fa-chart-bar"></i>
              <p>
                Reports
              </p>
            </a>
          </li> -->
          <!--  -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

    <div class="sidebar-custom">
      <!-- <a href="#" class="btn btn-link"><i class="fas fa-cogs"></i></a> -->
      <a href="<?php echo web_root;?>agency/logout.php" class="btn btn-secondary hide-on-collapse pos-right">Logout</a>
    </div>
    <!-- /.sidebar-custom -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $title;?></h1>
          </div>
     <!--      <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Layout</a></li>
              <li class="breadcrumb-item active">Fixed Layout</li>
            </ol>
          </div> -->
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content"> 
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">  
              <?php 
               check_message(); 
               require_once $content; 
               ?> 

          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0
    </div>
    <strong>Copyright &copy; 2014-2021 carl.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo web_root; ?>agency/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo web_root; ?>agency/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jQuery UI -->
<script src="<?php echo web_root; ?>agency/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?php echo web_root; ?>agency/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo web_root; ?>agency/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo web_root; ?>agency/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo web_root; ?>agency/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo web_root; ?>agency/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo web_root; ?>agency/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo web_root; ?>agency/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo web_root; ?>agency/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo web_root; ?>agency/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo web_root; ?>agency/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo web_root; ?>agency/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo web_root; ?>agency/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo web_root; ?>agency/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- Summernote -->
<script src="<?php echo web_root; ?>agency/plugins/summernote/summernote-bs4.min.js"></script>
<!-- Select2 -->
<script src="<?php echo web_root; ?>agency/plugins/select2/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo web_root; ?>agency/dist/js/adminlte.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?php echo web_root; ?>agency/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?php echo web_root; ?>agency/plugins/toastr/toastr.min.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="<?php echo web_root; ?>agency/plugins/moment/moment.min.js"></script>
<script src="<?php echo web_root; ?>agency/plugins/fullcalendar/main.min.js"></script> 
<!-- InputMask -->
<script src="<?php echo web_root; ?>agency/plugins/moment/moment.min.js"></script>
<script src="<?php echo web_root; ?>agency/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="<?php echo web_root; ?>agency/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo web_root; ?>agency/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo web_root; ?>agency/dist/js/demo.js"></script>
<!-- Page specific script -->
<!-- datatables -->
<script src="<?php echo web_root; ?>agency/dist/js/datatablesFunction.js"></script> 
<!-- text editor -->
<script src="<?php echo web_root; ?>agency/dist/js/textEditorFunction.js"></script>  
<!-- select to -->
<script src="<?php echo web_root; ?>agency/dist/js/select2Function.js"></script>   
<!-- for sweet alerts Page specific script -->
<script src="<?php echo web_root; ?>agency/dist/js/sweetAlertFunction.js"></script>   
<script>

 
</script>
<!-- for scheduling  Page specific script -->
<!-- <script src="<?php echo web_root; ?>agency/dist/js/calendarSchedulingFunction.js"></script>    -->
<script>
 
</script>
<!-- for datepicker and time picker  -->
<script type="text/javascript">
 //Datemask dd/mm/yyyy
    $('#Datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#Datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' }) 
  //Money Euro
    $('[data-mask]').inputmask()

    //Date and time picker
    var dateToday = new Date(); 
    $('#ScheduleDate').datetimepicker({ icons: { time: 'far fa-clock' }, ignoreReadonly: true,minDate: dateToday});
    $('#EndScheduleDate').datetimepicker({ icons: { time: 'far fa-clock' }, ignoreReadonly: true ,minDate: dateToday});

    // $('#DateTo').datetimepicker({ icons: { time: 'far fa-clock' } });
    // $('#DateFrom').datetimepicker({ icons: { time: 'far fa-clock' } });
    
    // $('#DateTo').datetimepicker({
    //     format: 'L'
    // });

  </script>
<!-- ajax modal for pending request-->
<script type="text/javascript">
  $(".pendingModal").on("click", function(){
 
   var id = $(this).data("id");
   // alert(id)

  $.ajax({ 
        url: "statusModal.php", 
        type:"POST",  
        data: {  RequestID: id},
        success: function(data) {
          console.log(data); 
          $(".pendingModals").html(data)
        },
        error: function(data) {
          console.log(data);
        }
  });

 
});
</script>
<!-- ajax modal to  add ratings-->
<script type="text/javascript">
  $(".ratingModal").on("click", function(){
 
   var id = $(this).data("id"); 
   
  $.ajax({ 
        url: "ratingModal.php", 
        type:"POST",  
        data: {  DocumentID: id},
        success: function(data) {
          console.log(data); 
          $(".ratingModalDisplay").html(data)
        },
        error: function(data) {
          console.log(data);
        }
  });

 
});
</script>
<!-- ajax modal to  set duration-->
<script type="text/javascript">
  $(".ratingDurationModal").on("click", function(){
 
   var id = $(this).data("id");
   // alert(id)

  $.ajax({ 
        url: "ratingDurationModal.php", 
        type:"POST",  
        data: {  DocumentID: id},
        success: function(data) {
          console.log(data); 
          $(".ratingDurationModalDisplay").html(data)
        },
        error: function(data) {
          console.log(data);
        }
  });

 
});
</script>
<!-- ajax for changing status of the documents approval -->
<script type="text/javascript">
   var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

   $(".documentsApproval").on("change", function(){
 
   var id = $(this).data("id");
   var status = $("#ChangeStatus"+id).val();
   // alert(status)

  $.ajax({ 
        url: "<?php echo web_root;?>agency/approval/controller.php?action=changestatus", 
        type:"POST",  
        data: {id: id,Status:status},
        success: function(data) {
          console.log(data); 
         Toast.fire({
            icon: 'success',
            title: data
          })
          
        },
        error: function(data) {
          console.log(data);
        }
  });

 
});
</script> 
<?php  echo (currentpage() == 'scheduling') ?  include ('calendarFunction.php') : false;?> 
</body>
</html>
