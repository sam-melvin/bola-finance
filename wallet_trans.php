<?php
use App\Models\User;
use App\Models\CashIn;
use App\Models\BolaUsers;
use App\Models\Transactions;
use App\Models\UsersAccess;

require 'bootstrap.php';
checkSessionRedirect(SESSION_UID, PAGE_LOCATION_LOGIN);
$loggedUser = User::find($_SESSION[SESSION_UID]);
$page = 'cashin';
$pagetype = 3;
checkCurUserIsAllow($pagetype,$_SESSION[SESSION_TYPE]);

$userAccess = UsersAccess::create([
  'user_id' => $loggedUser->id,
  'username' => $loggedUser->username,
  'full_name' => $loggedUser->full_name,
  'ip_address' => $_SERVER['REMOTE_ADDR'],
  'agent' => $_SERVER['HTTP_USER_AGENT'],
  'type' => 'visited',
  'page' => $_SERVER['SCRIPT_URI']
]);

$_SESSION['last_page'] = $_SERVER['SCRIPT_URI'];

$ids = $_SESSION[SESSION_UID];
$lists = [];
$now = new DateTime('now');

$user = new User();
$bolauser = new BolaUsers();
$results = Transactions::where('loader_code', $loggedUser->code)
        ->where(function ($query) {
            $query->where('status', 'sent')->orWhere('status', 'complete');
        })
        ->where(function ($query) {
            $query->where('type', 'Wallet')->orWhere('type', 'Cash In');
        })
    // ->where('date_submit', $now->format('m-d-Y'))
    // ->where('draw_number', WinningNumber::getNextDrawNumber())
    ->orderByDesc('updated_date')
    ->get();


    foreach ($results as $trans) {
        // $fname = $cash->first_name. ' '.$cash->last_name;
        // echo 'wew: ' . $bets->id;
        array_push($lists, [
            'id' => $trans->id,
            'user_id' => $trans->user_id,
            'amount' => $trans->amount,
            'type' => $trans->type,
            'ref_no' => $trans->ref_no,
            'status' => $trans->status,
            'updated_date' => $trans->updated_date,
            
        ]);
    }



?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BolaSwerte | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">

  
</head>
<!-- <body class="hold-transition sidebar-mini layout-fixed"> -->
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <!-- <nav class="main-header navbar navbar-expand navbar-white navbar-light"> -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <?php
          include APP . DS . 'templates/elements/navbarlinks.php';
    ?>


  </nav>
  <!-- /.navbar -->
  

  <?php
          include APP . DS . 'templates/elements/navigation.php';
    ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">BolaSwerte Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Cashin</li>
              <li class="breadcrumb-item">Wallet History</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-12">
              <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Wallet History</h3>
                        
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                        <th>Trans #</th>
                        <th>User ID</th>
                        <th>Name</th>
                          <th>Amount</th>
                          <!-- <th>Address</th> -->
                          <th>Type</th>
                          <th>Ref No.</th>
                          <th>Status</th>
                          <th>Remarks</th>
                          <th>Trans Date</th>
                          <!-- <th></th> -->
                          
                        </tr>
                        </thead>
                        <tbody>
                        
                        <?php
                                                foreach ($lists as $the):

                                                $datec=date_create($the['updated_date']);
                                                
?>
                                                
                                            <tr>
                                            <td><?= $the['id'] ?></td>
                                            <td><?= $the['user_id'] ?></td>
                                            
                                            <td>
                                                <?php echo $the['type'] == 'Cash In' ? $bolauser->getUserName($the['user_id']) :$user->getUserName($the['user_id']); ?>
                                            </td>
                                            <td>&#8369; <?= number_format($the['amount'],2) ?></td>
                                            <td><?= $the['type'] ?></td>
                                            <td><?= $the['ref_no'] ?></td>
                                            <td>
                                            <?php echo $the['status'] == 'sent' ? "<span class='badge badge-warning'>" :"<span class='badge badge-primary'>"; ?>
                                                <?= $the['status'] ?></span>
                                             </td>
                                            
                                                <?php echo $the['status'] == 'sent' ? "<td class='text-danger'>Deducted" : "<td class='text-warning'>Added"; ?>
                                            </td>
                                            <td><?= date_format($datec,'F j, Y, g:i a') ?></td>
                                                      
                                            <!-- <td></td> -->
                                               </tr>

                                                    
                                               <?php endforeach ?>
                                               
                                        
                                    
                                    
                        
                        </tbody>
                        <!-- <tfoot>
                        <tr>
                        <th>Agent ID Code</th>
                          <th>Full Name</th>
                          <th>Supervisor</th>
                          <th>Manager</th>
                          <th>Date Uploaded</th>
                          <th>3 Digits</th>
                          <th>2 Digits</th>
                          <th>1 Digit</th>
                          <th>Total Sales</th>
                          <th>Rate Com.</th>
                          <th>Total Payout</th>
                        </tr>
                        </tfoot> -->
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
        </div>
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
           

           
            
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">

           
            

           
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->

      

      <?php
          include APP . DS . 'templates/elements/updatepass.php';
      ?>


    </section>
    <!-- /.content -->
  </div>
  <?php
            include APP . DS . 'templates/elements/footer.php';
      ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<script src="dist/js/pages/templates.js"></script>
<script src="dist/js/share.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="https://kit.fontawesome.com/d6574d02b6.js" crossorigin="anonymous"></script>

<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="plugins/toastr/toastr.min.js"></script>
<script type="text/javascript"> 
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": true, "sorter": 1, "order": [[0, 'desc']],
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    
    
  });
  Share.init()

</script>
</body>
</html>

