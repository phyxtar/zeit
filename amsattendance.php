<?php
$page_no = "18";
$page_no_inside = "18_4";
include_once "framwork/main.php";
include_once "include/function.php";
include_once "include/config.php";
error_reporting(0);
// $page_no_inside = "2_1";
// include_once "include/authentication.php";
$teacher_grade_id = isset($_SESSION['teacher_grade_id']) ? $_SESSION['teacher_grade_id'] : "Unknown";
$teacher_id = isset($_SESSION['teacher_id']) ? $_SESSION['teacher_id'] : "Unknown";

$teacher_name = isset($_SESSION['logger_username']) ? $_SESSION['logger_username'] : "Unknown";

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NETAJI SUBHAS UNIVERSITY | Make Attendance </title>
    <!-- Fav Icon -->
    <link rel="icon" href="images/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <!-- Include jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Include DataTables JS -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
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
                            <h1>Make Attendance</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Make Attendance</li>
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
                                    <button type="button" class="btn btn-success"
                                        onclick="showStudentDetailsModal()">Make Attendance</button>
                                </div>
                            </div>
                            <!-- Student Details Modal -->
                            <div class="modal" id="studentDetailsModal" tabindex="-1" role="dialog"
                                aria-labelledby="studentDetailsModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" id="studentDetailsBody">

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <style>
                            table {
                                width: 100%;
                                border-collapse: collapse;
                                /* To remove spacing between cells */
                            }

                            th,
                            td {
                                padding: 5px;
                                /* Reduces the padding */
                                text-align: left;
                                /* Aligns the text to the left */
                                white-space: nowrap;
                                /* Prevents text from wrapping */
                            }

                            th {
                                width: 10%;
                                /* Set width for header columns */
                            }

                            td {
                                width: 10%;
                                /* Set width for data columns */
                            }

                            /* Style for the radio buttons */
                            .radio-inline {
                                margin: 0;
                                padding: 0;
                            }

                            /* Present radio button - green */
                            .attendance-status[value="Present"]:checked+label {
                                background-color: green;
                                color: white;
                            }

                            /* Absent radio button - red */
                            .attendance-status[value="Absent"]:checked+label {
                                background-color: red;
                                color: white;
                            }

                            /* General radio label style */
                            label {
                                padding: 5px 10px;
                                border-radius: 4px;
                                cursor: pointer;
                            }
                            </style>

                            <script>
                            function showStudentDetailsModal() {
                                // Fetch student details using AJAX
                                $.ajax({
                                    url: 'fetch_student_attendance.php', // PHP script to fetch student details
                                    type: 'GET',
                                    success: function(response) {
                                        // Insert the fetched details into the modal's table body
                                        $('#studentDetailsBody').html(response);
                                        // Show the modal
                                        $('#studentDetailsModal').modal('show');
                                    },
                                    error: function(xhr, status, error) {
                                        alert('Error fetching student details');
                                    }
                                });
                            }

                            $(document).ready(function() {
                                // Initialize DataTable if needed
                                $("#example1").DataTable();
                            });
                            </script>
                            <!-- /.card-header -->
                            <div class="card-body" id="data_table">

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

                                                <table id="attendanceTable" class="table table-striped table-bordered"
                                                    width='100%'>
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
                                                        "scrollX": true,
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
                                                                "data": "grade_name",
                                                                "render": function(data, type,
                                                                    row) {
                                                                    return `<span class="badge bg-primary">${data}</span>`;
                                                                }
                                                            },
                                                            {
                                                                "data": "attendance_status"
                                                            },
                                                            {
                                                                "data": "attendance_date",
                                                                "render": function(data, type,
                                                                    row) {
                                                                    return `<span class="badge badge-warning">${data}</span>`;
                                                                }
                                                            }
                                                        ],
                                                        "paging": true,
                                                        "searching": true,
                                                        "createdRow": function(row, data,
                                                            dataIndex) {
                                                            // Check the value of attendance_status and apply styles
                                                            if (data.attendance_status ===
                                                                "Present") {
                                                                $('td:eq(4)', row).css({
                                                                    'background-color': '#28a745',
                                                                    'color': 'white',
                                                                    'font-weight': '600'
                                                                });
                                                            } else if (data
                                                                .attendance_status === "Absent"
                                                            ) {
                                                                $('td:eq(4)', row).css({
                                                                    'background-color': '#dc3545',
                                                                    'color': 'white',
                                                                    'font-weight': '600'
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

                                <script>
                                $(function() {
                                    $("#example1").DataTable();
                                    $('#example2').DataTable({
                                        "processing": true, // Shows processing message
                                        "serverSide": true,
                                        "paging": true,
                                        "lengthChange": false,
                                        "searching": false,
                                        "ordering": true,
                                        "info": true,
                                        "autoWidth": false,
                                        "scrollX": true

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
    <!-- ./wrapper -->
    <!-- Add Courses Modal Start-->

    <!-- Add Courses Modal End -->
    <!-- Add Courses With Excel Modal Start-->

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


</body>

</html>