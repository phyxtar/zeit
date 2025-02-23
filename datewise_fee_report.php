<?php
$page_no = "7";
$page_no_inside = "7_10";
include_once "include/authentication.php";
$startDateMessage = '';
$endDate = '';
$noResult = '';

if (isset($_POST["export"])) {
    //export start
    $query = "SELECT * FROM `tbl_fee_paid` ORDER BY feepaid_id DESC LIMIT 200";
    $results = mysqli_query($con, $query) or die("database error:" . mysqli_error($con));
    $allOrders = array();
    while ($order = mysqli_fetch_assoc($results)) {
        $no = 1;
        $allOrders[] = $order;
    }
    if (empty($_POST["fromDate"])) {
        $startDateMessage = '<label class="text-danger">Select start date.</label>';
    } else if (empty($_POST["toDate"])) {
        $endDate = '<label class="text-danger">Select end date.</label>';
    } else {
        $orderQuery = "
		SELECT * FROM tbl_fee_paid 
		 WHERE receipt_date >= '" . $_POST["fromDate"] . "' AND receipt_date <= '" . $_POST["toDate"] . "' ORDER BY receipt_date DESC";
        $orderResult = mysqli_query($con, $orderQuery) or die("database error:" . mysqli_error($con));
        $filterOrders = array();
        while ($order = mysqli_fetch_assoc($orderResult)) {
            $filterOrders[] = $order;
        }
        if (count($filterOrders)) {
            $fileName = "Fee_Report_DateWise" . date('Ymd') . ".csv";
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$fileName");
            header("Content-Type: application/csv;");
            $file = fopen('php://output', 'w');
            $header = array("S.No", "Receipt Date", "Fee Paid Date", "Reg.No", "Name", "Course", "Session", "Particulars", "Paid Fee", "Remaining Fee", "Payment Mode", "Cheque/DD/Online No", "Bank Name", "Remarks");
            fputcsv($file, $header);
            foreach ($filterOrders as $order) {
                $orderData = array();
                $orderData[] = $no++;
                $orderData[] = date("d-m-Y", strtotime($order["receipt_date"]));
                $orderData[] = date("d-m-Y", strtotime($order["paid_on"]));

                $orderData[] = $order["student_id"];
                $sql_name = "SELECT * FROM `tbl_admission` WHERE `admission_id` = '" . $order["student_id"] . "' ";
                $result_name = $con->query($sql_name);
                $row_name = $result_name->fetch_assoc();
                $orderData[] = $row_name["admission_first_name"] . " " . $row_name["admission_middle_name"] . " " . $row_name["admission_last_name"];
                $sql_course = "SELECT * FROM `tbl_course` WHERE `course_id` = '" . $order["course_id"] . "' ";
                $result_course = $con->query($sql_course);
                $row_course = $result_course->fetch_assoc();
                $orderData[] = $row_course["course_name"];

                $sql_session = "SELECT * FROM `tbl_university_details` WHERE `university_details_id` = '" . $order["university_details_id"] . "' ";
                $result_session = $con->query($sql_session);
                $row_session = $result_session->fetch_assoc();
                $orderData[] = intval($row_session["university_details_academic_start_date"]) . " - " . intval($row_session["university_details_academic_end_date"]);

                $sql_particular = " SELECT * FROM `tbl_fee` WHERE `fee_id` = '" . $order["particular_id"] . "' ";
                $result_particular = $con->query($sql_particular);
                $row_particular = $result_particular->fetch_assoc();
                $orderData[] = $row_particular["fee_particulars"];
                $orderData[] = $order["paid_amount"];
                $orderData[] = $order["balance"];
                $orderData[] = $order["payment_mode"];
                //		   $orderData[] = $order["check_no"];	
                $orderData[] = $order["transaction_no"];
                $orderData[] = $order["bank_name"];

                fputcsv($file, $orderData);
            }
            fclose($file);
            exit;
        } else {
            $noResult = '<label class="text-danger">There are no record exist with this date range to export. Please choose different date range.</label>';
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NETAJI SUBHAS UNIVERSITY | Datewise Fee Report </title>
    <!-- Fav Icon -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <link rel="icon" href="images/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <script src="build/js/datepickers.js"></script>
    <style>
        .dtHorizontalExampleWrapper {
            max-width: 600px;
            margin: 0 auto;
        }

        #dtHorizontalExample th,
        td {
            white-space: nowrap;
        }
    </style>

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php include_once 'include/navbar.php'; ?>
        <?php include_once 'include/aside.php'; ?>

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Datewise Fee Report</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Datewise Fee Report</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <div class="float-sm-right">
                                    <!-- <button type="button" class="btn btn-success" onclick="document.getElementById('add_expenses').style.display='block'">Add Expenses</button>-->
                                </div>
                                <form method="post">
                                    <div class="input-daterange">
                                        <div class="row">
                                            <div class="col-4">
                                                From<input type="text" name="fromDate" id="fromDate"
                                                    class="form-control datepicker" value="<?php echo date("Y-m-d"); ?>"
                                                    readonly />
                                                <?php echo $startDateMessage; ?>
                                            </div>
                                            <div class="col-4">
                                                To<input type="text" name="toDate" id="toDate"
                                                    class="form-control datepicker" value="<?php echo date("Y-m-d"); ?>"
                                                    readonly />
                                                <?php echo $endDate; ?>
                                            </div>

                                            <div class="col-2">
                                                <div>&nbsp;</div>
                                                <input type="submit" name="export" value="Export to CSV"
                                                    class="btn btn-info" />
                                            </div>
                                        </div>
                                    </div>

                                </form>
                                <div class="row">
                                    <div class="col-md-8">
                                        <?php echo $noResult; ?>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <table id="dtHorizontalExample" class="display nowrap table table-bordered table-striped" style="width:100%">
                                        <thead>
                                            <th>S.No</th>
                                            <th>Receipt Date</th>
                                            <th>Fee Paid Date</th>
                                            <th>Reg No</th>
                                            <th>Name</th>
                                            <th>Course</th>
                                            <th>Session</th>
                                            <th>Particulars</th>
                                            <th>Paid Fee</th>
                                            <th>Remaining Fee</th>
                                            <th>Payment Mode</th>
                                            <th>Cheque/DD/Online No</th>
                                            <th>Bank Name</th>
                                            <th>Remarks</th>
                                        </thead>
                                    </table>



                                </div>
                                <!-- /.card-header -->
                                <div class="card-body" id="data_table">

                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
            </section>
            <!-- /.content -->
        </div>

        <?php include_once 'include/footer.php'; ?>

        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <!--<script src="plugins/jquery/jquery.min.js"></script>-->
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- page script -->
    <script>
        $('#dtHorizontalExample').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: 'fetch_fee_data.php',
                type: 'POST',
                error: function(xhr, error, code) {
                    console.error("AJAX Error: ", xhr.responseText);
                }
            },
            pageLength: 100,
            scrollX: true,
            columnDefs: [{
                targets: '_all',
                className: 'text-center'
            }]
        });
    </script>
    <script>
        $(document).ready(function() {
            // Datepicker initialization
            $('.datepicker').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd' // Adjust the date format as per your preference
            });
        });
    </script>
    <!-- <script>
    $(document).ready(function() {
        $('#dtHorizontalExample').DataTable({
            "scrollX": true
        });
        $('.dataTables_length').addClass('bs-select');
    });
    </script> -->
</body>

</html>