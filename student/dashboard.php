<?php
$page_no = "1";
$page_no_inside = "";
include "include/config.php";
include "include/authentication.php";
?>
<?php
$sql = "SELECT * FROM `tbl_admission` WHERE `status` = '$visible' && `admission_username` = '" . $_SESSION["logger_username1"] . "'";
$result = $con->query($sql);
$row = $result->fetch_assoc();
$doc_status = $row['doc_status']; // Fetch the doc_status field
$student_name = $row['admission_first_name'];

// Assuming you are storing the admission_id in session after login
$admission_id = $_SESSION['admission_id']; // Change according to your session variable

// Check if the admission_id exists in tbl_migration_form
$sql_migration_check = "SELECT * FROM `tbl_migration_form` WHERE `admission_id` = '$admission_id'";
$result_migration_check = $con->query($sql_migration_check);

// Variable to track if the form is filled
$show_modal = false;

if ($result_migration_check->num_rows > 0) {
    // Migration form exists for this admission_id, trigger the modal
    $show_modal = true;
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NETAJI SUBHAS UNIVERSITY | Dashboard</title>
    <!-- Fav Icon -->
    <link rel="icon" href="images/logo.png" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
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
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script>
    $(function() {
        var current = location.pathname;
        $('#nav li a').each(function() {
            var $this = $(this);
            // if the current path is like this link, make it active
            if ($this.attr('href').indexOf(current) !== -1) {
                $this.addClass('active');
            }
        })
    })
    </script>
</head>


<body class="hold-transition sidebar-mini layout-fixed">
    <?php include 'imp_notice.php'; ?>
    <div class="wrapper">

        <?php include 'include/navbar.php'; ?>
        <?php include 'include/aside.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <!-- <?php echo($row["admission_id"]) ?> -->
                    <?php 
                // Check if admission_id matches any of the specified IDs
                if (in_array($row["admission_id"], [8804, 6412])) {
                    echo "
                    <div class='alert alert-danger alert-dismissible fade show' role='alert' style='background-color: #fbe6e6; border-left: 6px solid #d9534f; border-radius: 8px; padding: 20px; color: #a94442; font-family: Arial, sans-serif; position: relative;'>
                        <h5 style='font-weight: bold; text-transform: uppercase; margin-bottom: 10px; color: #d9534f;'>
                            <i class='fas fa-exclamation-circle' style='margin-right: 8px;'></i> Important Notice
                        </h5>
                        <p style='font-size: 16px; line-height: 1.5; margin: 0;'>
                            This is a system-generated message. Your <b>Examination Form has been rejected</b>; please clear your dues to get the examination form approved.
                        </p>
                       
                    </div>";
                } else {
                    echo "";
                }
                ?>
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Dashboard</h1>
                            <?php if ($show_modal): ?>
                            <script>
                            // Trigger the modal after the page loads if the form is filled
                            window.onload = function() {
                                $('#successModal').modal('show');
                            };
                            </script>
                            <?php else: ?>
                            <p style="color: red; text-align: center;"></p>
                            <?php endif; ?>

                            <!-- Bootstrap Modal (only shown if admission_id exists in tbl_migration_form) -->
                            <div class="modal fade" id="successModal" tabindex="-1" role="dialog"
                                aria-labelledby="successModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="color: white;background: #e3b020;">
                                            <h5 class="modal-title" id="successModalLabel">Important Notice*</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Kindly check your <b>Migration form</b> on NSU Student App For
                                                approval
                                                Status.</p>
                                            <p class='text-danger'>When approved please come with the <b>Original
                                                    Rergistration slip</b> to collect the migration cum TC certificate.
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <a class="text-white" href="userprofile">
                                        <h3>
                                            <?php echo "Profile" ?>
                                        </h3>

                                        <p>Details</p>
                                    </a>
                                </div>

                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="./userprofile" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <a class="text-white" href="payfee">
                                        <h3>Fee<sup style="font-size: 20px"></sup></h3>

                                        <p>Payment</p>
                                    </a>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="./payfee" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <a class="text-white" href="paid_fee_details">
                                        <h3>
                                            <?php echo "Payment"; ?>
                                        </h3>

                                        <p>Details</p>
                                    </a>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-receipt"></i>
                                </div>
                                <a href="./fee_details.php" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <a class="text-white" href="admitcard">
                                        <h3>
                                            <?php echo "Admit" ?>
                                        </h3>

                                        <p>Card</p>
                                    </a>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-address-card"></i>
                                </div>
                                <a href="./admitcard" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-secondary">
                                <div class="inner">
                                    <a class="text-white" href="attendance">
                                        <h3>
                                            <?php echo "Attendance" ?>
                                        </h3>

                                        <p>Report</p>
                                    </a>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-book-reader"></i>
                                </div>
                                <a href="./attendance" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <!-- ./col -->

                        <div class="col-lg-3 col-6">
                            <!-- small box -->

                            <div class="small-box bg-primary">

                                <div class="inner">
                                    <a class="text-white" href="admitcard">
                                        <h3>
                                            <?php echo "Bus" ?>
                                        </h3>

                                        <p> Tracking</p>
                                </div>
                                </a>
                                <div class="icon">
                                    <i class="fas fa-location-arrow"></i>
                                </div>

                                <a href="./admitcard" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>

                            </div>

                        </div>

                        <!-- ./col -->
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-dark">
                                <div class="inner">
                                    <a class="text-white" href="request">
                                        <h3>
                                            <?php echo "Request" ?>
                                        </h3>

                                        <p>Form</p>
                                    </a>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <a href="./request" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                    <!-- Main row -->
                </div>

            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <h5 class="m-0 text-dark">
                            &emsp;&emsp;Hello, <a href="#">
                                <?php echo ucfirst($row["admission_first_name"]) ?>

                            </a>- Welcome to your dashboard
                            <br>&emsp;&emsp;
                            if you want to update your profile information, please drop a message in
                            <a href='complaint'>Complaint Management</a>

                        </h5>
                    </div>
                </div>
            </section>

            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php include 'include/footer.php'; ?>

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
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <script>
    document.onkeydown = function(e) {
        if (e.keyCode == 123) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
            return false;
        }

        if (e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
            return false;
        }

        if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
            return false;
        }
    }

    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
    });
    </script>
</body>

</html>