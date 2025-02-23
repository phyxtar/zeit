<?php
$page_no = "17";
$page_no_inside = "17_22";
include_once "include/authentication.php";
include_once "framwork/main.php";
include_once "include/function.php";
error_reporting(0);
if (isset($_GET['year']) && $_GET['year'] != '') {
    $year = $_GET['year'];
} else {
    $year = date('Y');
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
    <link rel="stylesheet" href="dist/css/style.css">
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
    <div class="wrapper">

        <?php include_once 'include/navbar.php'; ?>
        <?php include_once 'include/aside.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-10">


                            <div class="row">
                                <div class="col-md-3">
                                    <h1 class="text-dark mt-4">Hostel Dashboard</h1>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" id="hostel_id" class="form-control form-control-lg mt-4"
                                        placeholder="Search Student">
                                    <div id="hostel_id_list"></div>
                                </div>
                                <div class="modal fade" id="certificateModal" tabindex="-1" role="dialog"
                                    aria-labelledby="certificateModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="certificateModalLabel">Student Details
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div id="certificateDetails"></div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                $(document).ready(function() {
                                    $('#hostel_id').keyup(function() {
                                        var value = $(this).val();
                                        if (value != '') {
                                            $.ajax({
                                                url: "search_hostel_list.php",
                                                method: "POST",
                                                data: {
                                                    value: value
                                                },
                                                success: function(data) {
                                                    $('#hostel_id_list').fadeIn();
                                                    $('#hostel_id_list').html(data);
                                                }
                                            });
                                        } else {
                                            $('#hostel_id_list').fadeOut();
                                            $('#hostel_id_list').html("");
                                        }
                                    });

                                    $(document).on('click', '#hostel_id_list li', function() {
                                        var selectedText = $(this).text().trim();
                                        $('#hostel_id').val(selectedText);
                                        $('#hostel_id_list').fadeOut();

                                        $.ajax({
                                            url: "selected_hostel_student.php",
                                            method: "POST",
                                            data: {
                                                selectedText: selectedText
                                            },
                                            success: function(myresponse) {
                                                $('#certificateDetails').html(myresponse);
                                                $('#certificateModal').modal('show');
                                            },
                                            error: function(xhr, status, error) {
                                                console.error('Error:', error);
                                            }
                                        });
                                    });
                                });
                                </script>
                                <div class="col-md-3"></div>
                            </div>
                        </div><!-- /.col -->
                        <div class="col-2">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                                <li class="breadcrumb-item active">Hostel Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->

            <form action="" class="pl-5 pr-5">
                <select class="form-control form-control-sm ml-2 text-center" onchange="change_date(this.value)"
                    name="date" id="">
                    <?php for ($i = date('Y'); $i >= 2017; $i--) { ?>
                    <option <?php if (isset($_GET['year']) && $_GET['year'] == $i) echo "selected"   ?>
                        value="<?= $i ?>"> <?= $i ?></option>
                    <?php } ?>
                </select>
            </form>

            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning    ">
                                <div class="inner">
                                    <h3><?php $hoster_student = get_count('tbl_admission', 'admission_id', ' `status` = "' . $visible . '" &&  admission_hostel="Yes" ORDER BY  `admission_id` DESC');
                                            echo $hoster_student; ?>
                                    </h3>
                                    <p>Total Hostellers</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <!-- <a href="print_receipt" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3><?php $active_hoster_student = get_count('tbl_admission', 'admission_id', ' `status` = "' . $visible . '" &&  admission_hostel="Yes" && stud_status=1 && hostel_leave_date="" ORDER BY  `admission_id` DESC');
                                            echo $active_hoster_student; ?>
                                    </h3>
                                    <p>Active Hostellers</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <!-- <a href="print_receipt" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3><?php $active_male_hoster_student = get_count('tbl_admission', 'admission_id', ' `status` = "' . $visible . '" &&  admission_hostel="Yes" && stud_status=1 && hostel_leave_date="" && admission_gender="male" ORDER BY  `admission_id` DESC');
                                            echo $active_male_hoster_student; ?>
                                    </h3>
                                    <p>Male Hostellers</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <!-- <a href="print_receipt" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3><?php $active_female_hoster_student = get_count('tbl_admission', 'admission_id', ' `status` = "' . $visible . '" &&  admission_hostel="Yes" && stud_status=1 && hostel_leave_date="" && admission_gender="female" ORDER BY  `admission_id` DESC');
                                            echo $active_female_hoster_student; ?>
                                    </h3>
                                    <p>Female Hostellers</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <!-- <a href="print_receipt" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- PIE CHART -->
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h3 class="card-title">Overall Total Income - <?= $year ?></h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                                class="fas fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <canvas id="pieChart"
                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <!-- /.col (LEFT) -->
                        <div class="col-md-6 ">

                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Income and Expenses - <?= $year ?></h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                                class="fas fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <canvas id="barChart"
                                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->


                        </div>
                        <!-- /.card -->



                    </div>
                    <!-- /.col (RIGHT) -->
                </div>
                <!-- /.row -->

            </section>


            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php include_once 'include/footer.php'; ?>


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
</body>

</html>

<style>
::-webkit-scrollbar {
    width: 6px;
}
</style>
<script>
const date1 = []
const income = []
const expense = []
</script>
<?php

$start =  $year . "-01-01";
$end =  ($year + 1) . "-01-01";
// getting the total fee admission and semester

echo "<script>
fine=" . get_paid_fine_year($start, $end) . "
admission_fee=" . get_paid_amount_year($start, $end) . "
prospectus_fee=" . get_prospectus_amount_year($start, $end) . "
extra_fee=" . get_extra_income($start, $end) . "
exam_form=" . get_exam_form_amount($start, $end) . "
</script>";



// print the month of the year
$last_date = date('m');
$arr = array();


for ($i = 1; $i <= 12; $i++) {
    $d =  date("M", strtotime("+" . ($i - 1) . " month", $last_date));


    echo "<script>
date1.push('" . $d . "')
</script>";

    if ($i <= 9) {
        $start = $year . '-0' . $i . '-01';
        $end = $year . '-0' . $i . '-31';
        $total_expense = "SELECT SUM(amount) as total FROM `tbl_expenses` WHERE payment_date BETWEEN '$year-0$i-01' AND '$year-0$i-31' ";
        $expense_result = mysqli_query($con, $total_expense);
        $total_expense_data = mysqli_fetch_array($expense_result);
        $total_expense_amount = $total_expense_data['total'];

        echo "<script>
        income.push('" . overall_income($start, $end)  . "')
        expense.push('" . $total_expense_amount . "')
        </script>";
    } else {

        $start = $year . '-' . $i . '-01';
        $end = $year . '-' . $i . '-31';


        $total_expense = "SELECT SUM(amount) as total FROM `tbl_expenses` WHERE payment_date BETWEEN '$year-$i-01' AND '$year-$i-31' ";
        $expense_result = mysqli_query($con, $total_expense);
        $total_expense_data = mysqli_fetch_array($expense_result);
        $total_expense_amount = $total_expense_data['total'];

        echo "<script>
        income.push('" . overall_income($start, $end) . "')
        expense.push('" . $total_expense_amount . "')
        </script>";
    }
}

?>

<script>
function change_date(date) {
    window.location.replace("<?= url('hosteldashboard') ?>?year=" + date)
}
$(function() {
    var areaChartData = {
        labels: date1,
        datasets: [{
                label: 'Expenses',
                backgroundColor: '#f70707',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: expense
            },

            {
                label: 'Income',
                backgroundColor: '#34eb67',
                borderColor: 'rgba(210, 214, 222, 1)',
                pointRadius: false,
                pointColor: 'rgba(210, 214, 222, 1)',
                pointStrokeColor: '#c1c7d1',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data: income
            },

        ]
    }

    var areaChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
            display: false
        },
        scales: {
            xAxes: [{
                gridLines: {
                    display: false,
                }
            }],
            yAxes: [{
                gridLines: {
                    display: false,
                }
            }]
        }
    }

    // This will get the first returned node in the jQuery collection.

    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutData = {
        labels: [
            'Total Fee',
            'Fee Paid',
            'Fee Dues',
            'Male Students',
            'Female Students',

        ],
        datasets: [{
            data: [admission_fee, prospectus_fee, extra_fee, exam_form],
            backgroundColor: ['#00a65a', '#ffc107', '#dc3545', '#00c0ef'],
        }]
    }


    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData = donutData;
    var pieOptions = {
        maintainAspectRatio: false,
        responsive: true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
        type: 'pie',
        data: pieData,
        options: pieOptions
    })

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false
    }

    var barChart = new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
    })


})
</script>