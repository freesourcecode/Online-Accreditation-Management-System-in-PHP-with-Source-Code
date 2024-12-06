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
  <link rel="stylesheet" href="<?php echo web_root; ?>agency/plugins/fullcalendar/main.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo web_root; ?>agency/plugins/daterangepicker/daterangepicker.css">
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo web_root; ?>agency/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo web_root; ?>agency/dist/css/adminlte.min.css">
</head>
<?php
    $school = New School();
    $singleschool = $school->single_school($_SESSION['SCHOOLID']);  

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
          <span class="badge badge-warning navbar-badge"><?php echo maxNotification($_SESSION['SCHOOLID']);?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"><?php echo maxNotification($_SESSION['SCHOOLID']);?> Notifications</span>

          <?php
            $sql ="SELECT * FROM `tblnotification` WHERE `AlreadyViewed`=0 AND `SendTo`=".$_SESSION['SCHOOLID']." ORDER BY  NotificationDate DESC LIMIT 4";
            $mydb->setQuery($sql);
            $curNotif = $mydb->loadResultList();
            foreach ($curNotif as $rowNotif) {
            ?> 
                       <div class="dropdown-divider"></div>
                        <a href="<?php echo web_root;?>school/request/index.php?view=view&request=<?php echo $rowNotif->ForeignID;?>&id=<?php echo $rowNotif->CreatedBy;?>" class="dropdown-item">
                        <!--   <i class="fas fa-envelope mr-2"></i> --> <p> <?php echo $rowNotif->NotificationMessage;?>
                          <span class="float-right text-muted text-sm">3 mins</span></p>
                        </a>
          <?php    }

          ?> 
        
           
          <div class="dropdown-divider"></div>
          <a href="<?php echo web_root; ?>school/notification/" class="dropdown-item dropdown-footer">See All Notifications</a>
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
    <a href="#" class="brand-link">
      <img src="<?php echo web_root; ?>school/dist/img/schoolpanel.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">School Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo web_root.'school/user/'.$singleschool->S_PHOTO;?>" class="img-circle elevation-2" alt="">
        </div>
        <div class="info">
          <a href="<?php echo web_root; ?>school/user/" class="d-block"><?php echo $singleschool->SCHOOLNAME; ?></a>
        </div>
      </div>
 

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?php echo web_root?>school/" class="nav-link  <?php echo (currentpage() == '') ? "active" : false;?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard 
              </p>
            </a>
          
          </li>  
         <li class="nav-item">
            <a href="<?php echo web_root; ?>school/request/" class="nav-link  <?php echo (currentpage() == 'request') ? "active" : false;?>">
              <i class="nav-icon fas fa-rocket"></i>
              <p>
                Requests
              </p>
            </a>
          
          </li>  
         <!--  <li class="nav-item <?php echo (currentpage() == 'request-pending' || currentpage() == 'request-confirmed' || currentpage() == 'request-declined' || currentpage() == 'request-send') ? "menu-open" : false;?> ">
            <a href="#" class="nav-link  <?php echo (currentpage() == 'request-pending' || currentpage() == 'request-confirmed' || currentpage() == 'request-declined' || currentpage() == 'request-send' ) ? "active" : false;?>  ">
              <i class="nav-icon fas fa-rocket"></i>
              <p>
                Request
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo web_root; ?>school/request-send" class="nav-link <?php echo (currentpage() == 'request-send') ? "active" : false;?> ">
                  <i class="far fa-circle nav-icon text-warning"></i>
                  <p>Send Request  
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo web_root; ?>school/request-pending" class="nav-link <?php echo (currentpage() == 'request-pending') ? "active" : false;?> ">
                  <i class="far fa-circle nav-icon text-info"></i>
                  <p>Pending 
                    <span class="badge badge-info right"><?php echo maxRequest('School','Pending',$_SESSION['SCHOOLID']);?></span>
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo web_root; ?>school/request-confirmed" class="nav-link <?php echo (currentpage() == 'request-confirmed') ? "active" : false;?>">
                  <i class="far fa-circle nav-icon text-primary"></i>
                  <p>Confirmed 
                    <span class="badge badge-primary right"><?php echo maxRequest('School','Confirmed',$_SESSION['SCHOOLID']);?></span>
                  </p>
                </a>
              </li> 
              <li class="nav-item">
                <a href="<?php echo web_root; ?>school/request-declined" class="nav-link <?php echo (currentpage() == 'request-declined') ? "active" : false;?>">
                  <i class="far fa-circle nav-icon text-danger"></i>
                  <p>Declined 
                    <span class="badge badge-danger right"><?php echo maxRequest('School','Declined',$_SESSION['SCHOOLID'])?></span>
                  </p>
                </a>
              </li>
            </ul>
          </li> -->
<!--           <li class="nav-item <?php echo (currentpage() == 'school-accredited' || currentpage() == 'school-proccessing' || currentpage() == 'school-failed') ? "menu-open" : false;?>">
            <a href="#" class="nav-link <?php echo (currentpage() == 'school-accredited' || currentpage() == 'school-proccessing' || currentpage() == 'school-failed') ? "active" : false;?>">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Schools
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo web_root; ?>school/school-accredited" class="nav-link <?php echo (currentpage() == 'school-accredited') ? "active" : false;?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Accredited</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo web_root; ?>school/school-proccessing" class="nav-link <?php echo (currentpage() == 'school-proccessing') ? "active" : false;?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ongoing Process 
                    <span class="badge badge-warning right"><?php  echo maxSchool('School','Processing',$_SESSION['SCHOOLID']); ?></span>
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo web_root; ?>school/school-failed" class="nav-link <?php echo (currentpage() == 'school-failed') ? "active" : false;?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Failed 
                    <span class="badge badge-danger right"><?php  echo maxSchool('School','Failed',$_SESSION['SCHOOLID']); ?></span>
                  </p>
                </a>
              </li>
             
            </ul> 
          </li>  -->

         <li class="nav-item">
            <a href="<?php echo web_root; ?>school/document/" class="nav-link  <?php echo (currentpage() == 'document') ? "active" : false;?>">
              <i class="nav-icon fa fa-file"></i>
              <p>
                Documents
              </p>
            </a>
          
          </li>  
            <!-- <li class="nav-item <?php echo (currentpage() == 'document-pending' || currentpage() == 'document-completed') ? "menu-open" : false;?>">
            <a href="#" class="nav-link <?php echo (currentpage() == 'document-pending' || currentpage() == 'document-completed') ? "active" : false;?>">
              <i class="nav-icon fas fa-paperclip"></i>
              <p>
                Documents
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo web_root; ?>school/document-pending" class="nav-link <?php echo (currentpage() == 'document-pending') ? "active" : false;?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pending</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo web_root; ?>school/document-completed" class="nav-link <?php echo (currentpage() == 'document-completed') ? "active" : false;?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Completed 
                  </p>
                </a>
              </li> 
             
            </ul>
          </li>   -->

     <!--      <li class="nav-item">
            <a href="<?php echo web_root; ?>school/reports" class="nav-link <?php echo (currentpage() == 'reports') ? "active" : false;?>">
              <i class="nav-icon far fa-chart-bar"></i>
              <p>
                Reports
              </p>
            </a> -->
          </li>
          <!--  -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

    <div class="sidebar-custom">
      <!-- <a href="#" class="btn btn-link"><i class="fas fa-cogs"></i></a> -->
      <a href="<?php echo web_root;?>school/logout.php" class="btn btn-secondary hide-on-collapse pos-right">Logout</a>
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
    <strong>Copyright &copy; 2014-2021.</strong> All rights reserved.
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
  <!-- SweetAlert2 -->
<!-- AdminLTE App -->
<script src="<?php echo web_root; ?>agency/dist/js/adminlte.min.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="<?php echo web_root; ?>agency/plugins/moment/moment.min.js"></script>
<script src="<?php echo web_root; ?>agency/plugins/fullcalendar/main.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo web_root; ?>agency/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?php echo web_root; ?>agency/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?php echo web_root; ?>agency/plugins/toastr/toastr.min.js"></script>
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
<!-- datatables -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<!-- text editor -->
<script>
  $(function () {
    //Add text editor
    $('#compose-textarea').summernote()
  })
</script> 
<!-- ajax modal for pending request-->
<script type="text/javascript">
  $(".uploadModal").on("click", function(){
 
   var id = $(this).data("id");
   // alert(id)

  $.ajax({ 
        url: "uploadModals.php", 
        type:"POST",  
        data: {  DocumentID: id},
        success: function(data) {
          console.log(data); 
          $(".uploadModals").html(data)
        },
        error: function(data) {
          console.log(data);
        }
  });

 
});
</script>
<?php   

  echo (currentpage() == 'index.php') ?  include ('calendarFunction.php') : false;?> 
 
</body>
</html>
