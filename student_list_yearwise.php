<?php
$page_no = "6";
$page_no_inside = "6_7";
include_once "include/authentication.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NETAJI SUBHAS UNIVERSITY | Student List </title>
    <link rel="icon" href="images/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- Theme style -->
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
    </script>

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
    table,
    th,
    td {
        border-collapse: collapse;
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
                            <h1>Student List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Student List</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- SELECT2 EXAMPLE -->
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Student List</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                        class="fas fa-remove"></i></button>
                            </div>
                        </div>
                        <form role="form" method="POST" id="fetchStudentDataForm">
                            <div class="card-body" style="margin-top: 0px;">
                                <div class="row">
                                    <div class="col-12" id="error_section"></div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Course Name</label>
                                            <select onchange="change_semester(this.value)" class="form-control"
                                                name="course_id">
                                                <option value="all">All</option>
                                                <?php
                                                $sql_course = "SELECT * FROM `tbl_course`
                                                                   WHERE `status` = '$visible' order by course_name asc;
                                                                   ";
                                                $result_course = $con->query($sql_course);
                                                while ($row_course = $result_course->fetch_assoc()) {
                                                ?>
                                                <option value="<?php echo $row_course["course_id"]; ?>">
                                                    <?php echo $row_course["course_name"]; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Academic Year</label>
                                            <select class="form-control" id="session_check" name="academic_year">
                                                <option selected disabled>Select Year</option>
                                                <?php for ($year = 2018; $year <= 2025; $year++) : ?>
                                                <option value='<?php echo $year; ?>'><?php echo $year; ?></option>
                                                <?php endfor; ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-1" style="margin-top: 29px;">
                                        <button type="submit" id="fetchStudentDataButton"
                                            class="btn btn-primary">Go</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="col-12" id="loader_section"></div>
</body>

</html>

<div class="card-body" id="data_table">
    <?php
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                $selected_course_id = $_POST['course_id'];
                                $selected_year = $_POST['academic_year'];
                                if (!is_numeric($selected_year)) {
                                    die("Invalid Academic Year.");
                                }
                                        $sql = "SELECT a.*, c.course_name 
                                        FROM tbl_admission a 
                                        LEFT JOIN tbl_course c ON a.admission_course_name = c.course_id
                                        WHERE YEAR(a.date_of_admission) = '$selected_year'";

                                    // Add condition for course if not "all"
                                    if ($selected_course_id !== 'all') {
                                    $sql .= " AND a.admission_course_name = '$selected_course_id'";
                                    }

                                // Execute the query
                                $result = $con->query($sql);

                                if ($result && $result->num_rows > 0) {
                                    
                                    echo "
                                    <table id='studentListTable' class='table table-bordered table-striped'>
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Reg No.</th>
                                                    <th>Student  Name</th>
                                                    <th>Course</th>
                                                    <th>Father Name</th>
                                                    <th>Mother Name</th>
                                                    <th>Student Contact No.</th>
                                                    <th>DOB</th>
                                                    <th>Gender</th>
                                                    <th>Admission Date</th>
                                                    <th>Student Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>";
                                
                                    $serial_no = 1; // Initialize serial number
                                    while ($row = $result->fetch_assoc()) {
                                        $full_name = $row['admission_first_name'] . ' ' . $row['admission_middle_name'] . ' ' . $row['admission_last_name'];
                                        // Determine the student status
            if ($row['stud_status'] == 1) {
                $status = '<span class="badge badge-success">Active</span>';
            } else {
                $status = '<span class="badge badge-danger">Inactive</span>';
            } 
                                        echo "<tr>
                                                <td>{$serial_no}</td>
                                                <td>{$row['admission_id']}</td>
                                                <td>{$full_name}</td>
                                                <td>{$row['course_name']}</td>
                                                <td>{$row['admission_father_name']}</td>
                                                <td>{$row['admission_mother_name']}</td>
                                                <td>{$row['admission_mobile_student']}</td>
                                                <td>{$row['admission_dob']}</td>
                                                <td>{$row['admission_gender']}</td>
                                                <td>{$row['date_of_admission']}</td>
                                                <td>{$status}</td>
                                            </tr>";
                                        $serial_no++; 
                                    }
                                    echo "</tbody>
                                        </table>";
                                } else {
                                    echo "<p>No students found for the selected criteria.</p>";
                                }
                                
                            }
                            
                            ?>
</div>
</div>

</div>

</div>
</section>
<!-- /.content -->
</div>

<?php include_once 'include/footer.php'; ?>

<aside class="control-sidebar control-sidebar-dark">
</aside>
</div>

<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page script -->
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<script>
$(document).ready(function() {
    $('#studentListTable').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true

    });
});
</script>




</body>

</html>