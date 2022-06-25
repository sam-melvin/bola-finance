<?php
use App\Models\User;
use App\Models\CashPool;
use App\Models\Province;
use App\Models\Transactions;
use App\Models\UsersAccess;

require 'bootstrap.php';

checkSessionRedirect(SESSION_UID, PAGE_LOCATION_LOGIN);

$loggedUser = User::find($_SESSION[SESSION_UID]);
$page = 'index';
$pagetype = 5;
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

$transactions = Transactions::where('tx_type', 3)
         ->orderBy('updated_date','DESC')
         ->get();

$results = Province::where('country_id', 174)
    // ->where($columnFilterName, $loggedUser->user_id_code)
    // ->where('date_submit', $now->format('m-d-Y'))
    // ->where('draw_number', WinningNumber::getNextDrawNumber())
    ->orderBy('province','ASC')
    ->get();

$user = new User();
// $transactions = Journal::where('performed_by', $loggedUser->id)
//     ->orWhere('user_id', $loggedUser->id)
//     ->orderByDesc('id')
//     ->get();

// $myTransactions = Journal::where('performed_by', $loggedUser->id)
//     ->orderByDesc('id')
//     ->count();

$cashpool = new CashPool();
$banker = [
    'currentBalance' => $cashpool->getCashPool()
];

/**
 * get user lists
 *
 * 1. used for the select drop down
 */
// $userLists = User::where('assign_id', $loggedUser->user_id_code)->get();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bola Manage | Banker</title>
    <link rel="apple-touch-icon" sizes="57x57" href="/dist/img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/dist/img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/dist/img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/dist/img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/dist/img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/dist/img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/dist/img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/dist/img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/dist/img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/dist/img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/dist/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/dist/img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/dist/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="/dist/img/favicon/manifest.json">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <?php
                include APP . DS . 'templates/elements/navbarlinks.php';
            ?>
        </nav>

        <?php
            include APP . DS . 'templates/elements/navigation.php';
        ?>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Finance <?= $loggedUser->code ?></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">Finance</li>
                                <li class="breadcrumb-item active"></li>
                            </ol>
                        </div>
                    </div>
                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="row">
                            <div class="col-8 offset-2">
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                                    <?= $_SESSION['error'] ?>
                                </div>
                            </div>
                        </div>
                    <?php
                            unset($_SESSION['error']);
                        endif;
                    ?>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>&#8369; <?= number_format($banker['currentBalance'], 2) ?></h3>
                                    <p>Total Admin Balance</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-coins"></i>
                                </div>
                               
                                <a href="wallet_trans.php" class="small-box-footer" data-toggle="modal" data-target="#payModal">
                                        Add Funds <i class="fa-solid fa-user-plus"></i>
                                </a>
                            </div>
                        </div>
                        <!-- <div class="col">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3><?= count($userLists) ?></h3>
                                    <p>User Registrations</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="agents.php" class="small-box-footer">
                                    View list <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3><?= $myTransactions ?></h3>
                                    <p>Wallet Transactions</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-money-bill-wave-alt"></i>
                                </div>
                                <a href="transaction.php" class="small-box-footer">
                                    View Transactions <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div> -->
                    </div>

                    <div class="row">
                        <div class="col">
                            <form id="frmSendLoad">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title"><i class="fas fa-paper-plane nav-icon pr-3"></i>Send Money</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="sourceFund">Cash Pool</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-wallet"></i></span>
                                                        </div>
                                                        <input type="text" value="&#8369; <?= number_format($banker['currentBalance'], 2) ?>" name="cashPool" class="form-control" id="cashPool" disabled="disabled">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="amount">Amount</label>
                                                    <div class="input-group">
                                                    <input type="text" class="form-control" id="amount" name="amount" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'prefix': '&#8369;', 'placeholder': '0', 'max': 999999999.99">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">PHP</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="amount">Referrence No</label>
                                                    <div class="input-group">
                                                    <input type="text" class="form-control" id="ref_no" name="ref_no" >
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="receiver">Select Province</label>
                                                    <select required="required" class="form-control select2" name="selProvince" id="selProvince" style="width: 100%;">
                                                        <option value="">Choose a location</option>
                                                        <?php foreach ($results as $res): ?>
                                                            <option value="<?= $res->id ?>"><?= $res->province?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="receiver">To</label>
                                                    <select required="required" class="form-control select2" name="selReceiver" id="selReceiver" style="width: 100%;">
                                                        <option value="">Choose a Loader to send money</option>
                                                       
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <textarea class='form-control' name="remarks" id="remarks" placeholder="What's it for?"></textarea>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                    <div class="card-footer text-center">
                                        <input type="hidden" name="code" id="code" />
                                        <input type="hidden" name="adminId" id="adminId" value="<?= $ids ?>" />
                                        <button type="submit" class="btn btn-primary col-3" id="btnSendLoader">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Your Transaction</h3>
                                </div>
                                <div class="card-body table-responsive">
                                    <table id="lists" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Trans #</th>
                                                <th>Loader ID</th>
                                                <th>Name</th>
                                                <th>Amount</th>
                                                <th>Referrence No</th>
                                                <th>Transaction Type</th>
                                                <th>Status</th>
                                                <th>Remarks</th>
                                                <th>Transaction Date</th>
                                                <!-- <th>Receipt</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                foreach ($transactions as $the):
                                                $datec=date_create($the['updated_date']);
                                            ?>

                                        <tr>
                                        <td><?= $the['id'] ?></td>
                                        <td><?php echo $the['type'] == 'Wallet' ? $the['user_id'] :" "; ?></td>
                                            <td><?= $user->getUserName($the['user_id']) ?></td>
                                            <td>&#8369; <?= number_format($the['amount'],2) ?></td>
                                            <td><?= $the['ref_no'] ?></td>
                                            <td><?= $the['type'] ?></td>
                                            <td>
                                             <?php echo $the['status'] == 'complete' ? "<span class='badge badge-warning'>" :"<span class='badge badge-danger'>"; ?>
                                                <?= $the['status'] ?></td>
                                                <td><?= $the['notes'] ?></td>
                                            <td><?= date_format($datec,'F j, Y, g:i a') ?></td>
                                            <!-- <td><a href="receipt.php?id=<?= $the['id'] ?>" class="btn btn-primary ledgerModalDlg" data-token="$token" data-transactionid="" target="_blank">
                                                 View</a></td> -->
                                        </tr>


                                        <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </section>

            <?php
          include APP . DS . 'templates/elements/updatepass.php';
            ?>


        </div>
        <?php
                     include APP . DS . 'templates/elements/footer.php';
                ?>


            <!-- pay modal -->
            <div class="modal fade" id="payModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="ledger_pay.php" method="post" id="addFundsfrm">
                            <div class="modal-header">
                                <h4 class="modal-title">Add Funds</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="card card-primary">
                                        <div class="card-body">

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>Current Balance</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">&#8369;</i></span>
                                                            </div>
                                                            <input type="text" value="&#8369; <?= number_format($banker['currentBalance'], 2) ?>" name="pBalance" class="form-control" id="pBalance" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="amount">Amount</label>
                                                        <div class="input-group">
                                                            <input required="required" type="text" name="amount_bal" id="amount_bal" class="form-control"  data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'prefix': '&#8369;', 'placeholder': '0', 'max': 999999999.99">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">PHP</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                    <input type="hidden" name="addadminId" id="addadminId" value="<?= $ids ?>" />
                                                        <textarea class='form-control' name="remarks" id="remarks" placeholder="Notes"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <input type="hidden" name="id" id="pid" value="" />
                                <button type="button" class="btn btn-success col-3" id="addFundsbtn">Submit</button>
                                <button type="button" class="btn btn-danger col-3" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- pay modal end -->
    </div>

    <!-- JS starts here -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="plugins/sparklines/sparkline.js"></script>
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="dist/js/adminlte.js"></script>
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
    <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="plugins/toastr/toastr.min.js"></script>
    <script src="plugins/select2/js/select2.full.min.js"></script>
    <script src="plugins/inputmask/jquery.inputmask.min.js"></script>
    <script src="dist/js/pages/admin.js"></script>
    <script src="dist/js/pages/templates.js"></script>
    <script src="plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="https://kit.fontawesome.com/d6574d02b6.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $("#lists").DataTable({
            responsive: false,
            lengthChange: true,
            autoWidth: true,
            ordering: false
        }).buttons();

        $(".select2").select2({
            theme: 'bootstrap4'
        });

        $("#amount").inputmask({removeMaskOnSubmit: true});

        $("#amount_bal").inputmask({removeMaskOnSubmit: true});


  $.validator.setDefaults({
  submitHandler: function () {
    confirmSendLoad();
  // alert( "Form successful submitted!" );

  
  }
  });
  $('#frmSendLoad').validate({
    rules: {
    amount: {
        required: true,
    },
    ref_no: {
        required: true,
    },
    selReceiver: {
        required: true,
    },
    },
    messages: {
    amount: "Please enter a amount",
    selReceiver: "Please Select a receiver",
    selReceiver: "Please enter the referrence no."
    
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
    error.addClass('invalid-feedback');
    element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
    $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
    $(element).removeClass('is-invalid');
    }
});
    </script>
</body>
</html>
