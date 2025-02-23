<?php
$page_no = "18";
$page_no_inside = "18_1";
include_once "include/authentication.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NETAJI SUBHAS UNIVERSITY | Attendance Management System</title>
    <!-- Fav Icon -->
    <link rel="icon" href="images/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Include DataTable CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">

    <!-- Include jQuery and DataTable JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

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
                            <h1>Attendance Management System</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Manage Attendance</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row mb-3">
                        <!-- Students Card -->
                        <?php 
$query1=mysqli_query($conn,"SELECT * from tbl_student");                       
$students = mysqli_num_rows($query1);
?>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Students</div>
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                <?php echo $students;?></div>
                                            <div class="mt-2 mb-0 text-muted text-xs">
                                                <!-- <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span>
                        <span>Since last month</span> -->
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-info"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Class Card -->
                        <?php 
$query1=mysqli_query($conn,"SELECT * from tbl_grade");                       
$class = mysqli_num_rows($query1);
?>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Classes</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $class;?>
                                            </div>
                                            <div class="mt-2 mb-0 text-muted text-xs">
                                                <!-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                        <span>Since last month</span> -->
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-chalkboard fa-2x text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Std Att Card  -->
                        <?php 
$query1=mysqli_query($conn,"SELECT * from tbl_attendance");                       
$totAttendance = mysqli_num_rows($query1);
?>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Total Student
                                                Attendance</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $totAttendance;?></div>
                                            <div class="mt-2 mb-0 text-muted text-xs">
                                                <!-- <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                        <span>Since yesterday</span> -->
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-secondary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Teachers Card  -->
                        <?php 
            $query1=mysqli_query($conn,"SELECT * from tbl_teacher");                       
            $classTeacher = mysqli_num_rows($query1);
            ?>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Class Teachers
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $classTeacher;?></div>
                                            <div class="mt-2 mb-0 text-muted text-xs">
                                                <!-- <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                                    <span>Since last years</span> -->
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-chalkboard-teacher fa-2x text-danger"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!--Row-->
                    </div>
                    <!-- /.row -->
                </div>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-header">
                                <h5>Total Attendance</h5>
                            </div>
                            <style>
                            /* Custom table styling */
                            table.dataTable {
                                border-collapse: collapse;
                                width: 100%;
                                font: weight 600px;
                            }

                            table.dataTable thead {
                                background-color: #007bff;
                                color: white;
                            }

                            table.dataTable tbody tr:nth-child(even) {
                                background-color: #f2f2f2;
                            }

                            table.dataTable tbody tr:hover {
                                background-color: #ddd;
                            }

                            .dataTables_filter input {
                                border-radius: 4px;
                                padding: 5px;
                            }

                            .dataTables_length select {
                                border-radius: 4px;
                                padding: 5px;
                            }
                            </style>

                            <!-- /.card-header -->
                            <div class="card-body" id="data_table">

                                <table id="attendanceTable" class="table table-striped table-bordered" width='100%'>
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Student Name</th>
                                            <th>Taken By</th>
                                            <th>Grade</th>
                                            <th>Status</th>
                                            <th>Attendance Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Data will be loaded dynamically via DataTable -->
                                    </tbody>
                                </table>

                                <script>
                                $(document).ready(function() {
                                    $('#attendanceTable').DataTable({
                                        "processing": true, // Shows processing message
                                        "serverSide": true, // Enables server-side processing
                                        "ajax": {
                                            "url": "fetch_dataams.php", // The PHP script to fetch data
                                            "type": "POST"
                                        },
                                        "columns": [{
                                                "data": "attendance_id"
                                            },
                                            {
                                                "data": "student_name"
                                            },
                                            {
                                                "data": "teacher_id"
                                            },
                                            {
                                                "data": "grade_name"
                                            },
                                            {
                                                "data": "attendance_status"
                                            },
                                            {
                                                "data": "attendance_date",
                                                "render": function(data, type, row) {
                                                    return `<span class="badge badge-secondary">${data}</span>`;
                                                }
                                            }
                                        ],
                                        "paging": true,
                                        "searching": true,
                                        "createdRow": function(row, data, dataIndex) {
                                            // Check the value of attendance_status and apply styles
                                            if (data.attendance_status === "Present") {
                                                $('td:eq(4)', row).css({
                                                    'background-color': 'green',
                                                    'color': 'white'
                                                });
                                            } else if (data.attendance_status === "Absent") {
                                                $('td:eq(4)', row).css({
                                                    'background-color': 'red',
                                                    'color': 'white'
                                                });
                                            }
                                        }
                                    });
                                });
                                </script>

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


    <script src="plugins/jquery/jquery.min.js"></script>
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
    $(function() {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "processing": true,
            "serverSide": true, // Enable server-side processing
        });
    });
    </script>

</body>

</html>