<?php
$page_no = "11";
$page_no_inside = "11_31";
include_once "include/authentication.php";
$visible = md5("visible");
date_default_timezone_set("Asia/Calcutta");
$date_variable_today_month_year_with_timing = date("d M, Y. h:i A");
//echo $admin_username = $_SESSION['logger_username'];
$admin_id = $_SESSION['admin_id'];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NETAJI SUBHAS UNIVERSITY | Migration Form Application List </title>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
    table,
    th,
    td {
        border-collapse: collapse;
    }
    </style>
    <script type="text/javascript">
    $(document).ready(function() {
        $("#frmCSVImport").on("submit", function() {

            $("#response").attr("class", "");
            $("#response").html("");
            var fileType = ".csv";
            var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
            if (!regex.test($("#file").val().toLowerCase())) {
                $("#response").addClass("error");
                $("#response").addClass("display-block");
                $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
                return false;
            }
            return true;
        });
    });
    </script>
    <!-- <style>
        .scrollable-container {
         overflow-x: auto;   
        }

    </style> -->
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php include_once 'include/navbar.php'; ?>
        <?php include_once 'include/aside.php'; ?>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Migration Form Application List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Migration Form Application List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- SELECT2 EXAMPLE -->
                    <div class="card card-default">
                        <div class="card-header">
                        <h3 class="card-title">Migration Form Application List</h3>
                    </div>
                        <form role="form" method="POST" id="fetchStudentDataForm" >
                            <div class="card-body" >


                                <div class="row" style="overflow-x: auto;">
                                  <div class="col-12" id="error_section"></div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Course Name</label>
                                            <select class="form-control" id="course_id" name="course_id"
                                                onchange="change_semester(this.value)">
                                                <option value="0">Select Course</option>
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
                                            <select class="form-control" onchange="showdesg(this.value)" id="session_id"
                                                name="academic_year">
                                                <option value="0">Select Academic Year</option>
                                                <?php
                                                $sql_ac_year = "SELECT * FROM `tbl_university_details`
                                                                   WHERE `status` = '$visible';
                                                                   ";
                                                $result_ac_year = $con->query($sql_ac_year);
                                                while ($row_ac_year = $result_ac_year->fetch_assoc()) {
                                                ?>
                                                <?php
                                                    $completeSessionStart = explode("-", $row_ac_year["university_details_academic_start_date"]);
                                                    $completeSessionEnd = explode("-", $row_ac_year["university_details_academic_end_date"]);
                                                    $completeSessionOnlyYear = $completeSessionStart[0] . "-" . $completeSessionEnd[0];
                                                    ?>
                                                <option value="<?php echo $row_ac_year["university_details_id"]; ?>">
                                                    <?php echo $completeSessionOnlyYear; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-1" style="margin-top: 29px;">
                                        <button type="submit" id="fetchStudentDataButton"
                                            class="btn btn-primary">Go</button>
                                    </div>
                                  
<div id="fee_list" >
                                    <table id="migrationFormTable" class="table table-bordered table-striped" style="position: relative; overflow: auto; width: 100%;">
                   
                                        <thead>
                                            <tr>
                                                <th rowspan="2">S.No</th>
                                                <th rowspan="2">Admission No</th>
                                                <th rowspan="2">Student Name</th>
                                                <th rowspan="2">Course</th>
                                                <th rowspan="2">University Regn No</th>
                                                <th rowspan="2">Semester</th>
                                                <th rowspan="2">Passed or Failed</th>
                                                <th rowspan="2">Passing Year</th>
                                                <th rowspan="2">Session</th>
                                                <th rowspan="2">Application Date</th>
                                                <th rowspan="2">Payment Status</th>
                                                <th rowspan="2">View Document</th>
                                                <th colspan="6" class="text-center">Clearance From</th>

                                            </tr>
                                            <tr>
                                                <th>Library</th>
                                                <th>Admin Dept</th>
                                                <th>Finance Dept</th>
                                                <th>HOD's</th>
                                                <th>IT Lab</th>
                                                <th>Print Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            
                                             $s_no = 1;
                                            $sql = "SELECT * FROM `tbl_migration_form` WHERE `status` = '$visible'";
                                            $result = $con->query($sql); 

                                            if ($result->num_rows > 0) {
                                             
                                                while ($row = $result->fetch_assoc()) {
                                                    $admission_id =  $row["admission_id"];
                                                    $sql_name = "SELECT * FROM `tbl_admission` WHERE `status` = '$visible' AND `admission_id` = '$admission_id'";
                                                    $result_name = $con->query($sql_name);
                                                    $row_name = $result_name->fetch_assoc();

                                                    $course_id = $row["course_id"];
                                                    $sql_course = "SELECT * FROM `tbl_course` WHERE `status` = '$visible' AND `course_id` = '$course_id'";
                                                    $result_course = $con->query($sql_course);
                                                    $row_course = $result_course->fetch_assoc();

                                                    $sql_admin = "SELECT admin_type FROM tbl_admin WHERE admin_id = '$admin_id'";
                                                    $result_admin = $con->query($sql_admin);
                                                    $admin = $result_admin->fetch_assoc();
                                                    $admin_type = $admin['admin_type'];
                                                    ?>
                                            <tr class="text-center">
                                                <td><?php echo $s_no; ?></td>
                                                <td><?php echo $row["admission_id"]; ?></td>
                                                <td><?php echo $row_name["admission_first_name"] . " " . $row_name["admission_middle_name"] . " " . $row_name["admission_last_name"]; ?>
                                                </td>
                                                <td><?php echo $row_course["course_name"]; ?></td>
                                                <td><?php echo $row["registration_no"]; ?></td>
                                                <td><?php echo $row["semester"]; ?></td>
                                                <td><?php echo $row["passfail"]; ?></td>
                                                <td><?php echo $row["name_of_the_exam"]; ?></td>
                                                <td><?php echo $row["session"]; ?></td>
                                                <td><?php echo $row["create_time"]; ?></td>
                                                <td>
                                                    <?php if ($row["amount"] == 0 || is_null($row["amount"])) { ?>
                                                    <span class="badge badge-warning">Pending</span>
                                                    <?php } else { ?>
                                                    <span class="badge badge-success">Paid</span>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-warning btn-sm"
                                                        onclick="showDocumentModal('<?php echo $row['admission_id']; ?>')">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                                <script>
                                                function showDocumentModal(admissionId) {
                                                    // Fetch document data using AJAX
                                                    fetch('view_document.php?admission_id=' + admissionId)
                                                        .then(response => response.json())
                                                        .then(data => {
                                                            if (data.error) {
                                                                alert(data.error);
                                                            } else {
                                                                // Update modal content with document images
                                                                document.getElementById('doc_reg_img').src = data
                                                                    .doc_reg;
                                                                document.getElementById('doc_marksheet_img').src =
                                                                    data.doc_marksheet;
                                                                document.getElementById('doc_admitcard_img').src =
                                                                    data.doc_admitcard;

                                                                // Show the modal
                                                                $('#documentModal').modal('show');
                                                            }
                                                        })
                                                        .catch(error => {
                                                            console.error('Error fetching document data:', error);
                                                        });
                                                }
                                                </script>



                                                <div class="modal fade" id="documentModal" tabindex="-1"
                                                    aria-labelledby="documentModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="documentModalLabel">View
                                                                    Documents</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p><strong>Registration Slip:</strong></p>
                                                                <img id="doc_reg_img" src="#"
                                                                    alt="Registration Document"
                                                                    style="max-width: 100%; height: auto;">

                                                                <p><strong>Marksheet :</strong></p>
                                                                <img id="doc_marksheet_img" src="#"
                                                                    alt="Marksheet Document"
                                                                    style="max-width: 100%; height: auto;">

                                                                <p><strong>Admit Card:</strong></p>
                                                                <img id="doc_admitcard_img" src="#"
                                                                    alt="Admit Card Document"
                                                                    style="max-width: 100%; height: auto;">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <td>
                                                    <button type="button" class="status-btn-lib btn btn-sm"
                                                        data-id="<?php echo $row['admission_id']; ?>">
                                                        <?php echo ($row['library'] === 'Approved') ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>';
                                                                if ($row['library'] === 'Approved' && ($row["lib_approvedby"] != null or $row["lib_approvedby"] != '')) {
                                                                    echo "Approved By" . " " . $row["lib_approvedby"];
                                                                }
                                                                ?>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button type="button" class="status-btn-admin btn btn-sm"
                                                        data-id="<?php echo $row['admission_id']; ?>">
                                                        <?php echo ($row['admin_dept'] === 'Approved') ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>';
                                                                if ($row['admin_dept'] === 'Approved' && ($row["admin_approvedby"] != null or $row["admin_approvedby"] != '')) {
                                                                    echo "Approved By" . " " . $row["admin_approvedby"];
                                                                }
                                                                ?>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button type="button" class="status-btn-finance btn btn-sm"
                                                        data-id="<?php echo $row['admission_id']; ?>">
                                                        <?php echo ($row['finance_dept'] === 'Approved') ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>';
                                                                if ($row['finance_dept'] === 'Approved' && ($row["finance_approvedby"] != null or $row["finance_approvedby"] != '')) {
                                                                    echo "Approved By" . " " . $row["finance_approvedby"];
                                                                }
                                                                ?>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button type="button" class="status-btn-deptlab btn btn-sm"
                                                        data-id="<?php echo $row['admission_id']; ?>">
                                                        <?php echo ($row['dept_labs'] === 'Approved') ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>';
                                                                if ($row['dept_labs'] === 'Approved' && ($row["dept_approvedby"] != null or $row["dept_approvedby"] != '')) {
                                                                    echo "Approved By" . " " . $row["dept_approvedby"];
                                                                }
                                                                ?>
                                                    </button>
                                                </td>

                                                <td>
                                                    <button type="button" class="status-btn-it btn btn-sm"
                                                        data-id="<?php echo $row['admission_id']; ?>">
                                                        <?php echo ($row['IT_lab'] === 'Approved') ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>';
                                                                if ($row['IT_lab'] === 'Approved' && ($row["it_approvedby"] != null or $row["it_approvedby"] != '')) {
                                                                    echo "Approved By" . " " . $row["it_approvedby"];
                                                                }
                                                                ?>
                                                    </button>
                                                </td>
                                                <td>
                                                    <?php
                                                            // Check if admin_id is set and equals 94
                                                            $admin_id = $_SESSION['admin_id'];
                                                            if ($admin_id == 94) {
                                                                ?>
                                                    <button type="button" class="btn btn-sm btn-primary"
                                                        onclick="window.open('print_migration.php?admission_id=<?php echo $row['admission_id']; ?>', '_blank')">
                                                        <i class="fas fa-print"></i>
                                                    </button>

                                                    <?php
                                                            }
                                                            ?>
                                                </td>
                                                <td>
                                                    <?php
                                                            if ($admin_id == 94) {
                                                                ?>
                                                    <button class="btn btn-info btn-sm" type="button"
                                                        data-toggle="modal"
                                                        data-target="#edit_migration<?= $row['migration_id'] ?>">
                                                        <i class="fas fa-pencil-alt"></i> Edit
                                                    </button>
                                                    <?php
                                                            }
                                                            ?>
                                                </td>

                                                <div id="edit_migration<?php echo $row["migration_id"]; ?>"
                                                    class="w3-modal" style="z-index:2020;">
                                                    <div class="w3-modal-content w3-animate-top w3-card-4"
                                                        style="width:40%">
                                                        <header class="w3-container"
                                                            style="background:#343a40; color:white;">
                                                            <button data-dismiss="modal" aria-label="Close"
                                                                class="  w3-button w3-display-topright">&times;</button>
                                                            <h2 align="center">Edit Migration</h2>
                                                        </header>
                                                        <form id="edit_migration<?php echo $row["migration_id"]; ?>" role="form" method="POST" action="update_migration.php">
                                                            <div class="card-body">
                                                                <?php
                                                                $m_id = $row['migration_id'];
                                                                $sql_reg = "SELECT * FROM `tbl_migration_form` WHERE `migration_id` = '$m_id'";
                                                                $query_reg = mysqli_query($con, $sql_reg);
                                                                $row_reg = $query_reg->fetch_assoc();
                                                                ?>
                                                                
                                                                <input type="hidden" name="edit_migration_id" value="<?= $row['migration_id']; ?>">
                                                                
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label>Student Name</label>
                                                                            <input type="text" name="edit_candidate_name" class="form-control" value="<?= $row_reg["candidate_name"]; ?>">
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label>S/o / D/o / W/o</label>
                                                                            <input type="text" name="edit_father_name" class="form-control" value="<?= $row_reg["father_name"]; ?>">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label>DOB</label>
                                                                            <input type="text" name="edit_dob" class="form-control" value="<?= $row_reg["dob"]; ?>">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label>Email</label>
                                                                            <input type="text" name="edit_email_id" class="form-control" value="<?= $row_reg["email_id"]; ?>">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label>Semester</label>
                                                                            <input type="text" name="edit_semester" class="form-control" value="<?= $row_reg["semester"]; ?>">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label>Pass or Fail</label>
                                                                            <input type="text" name="edit_passfail" class="form-control" value="<?= $row_reg["passfail"]; ?>">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label>Passing Year</label>
                                                                            <input type="text" name="edit_name_of_the_exam" class="form-control" value="<?= $row_reg["name_of_the_exam"]; ?>">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label>Course</label>
                                                                            <select name="edit_course_name" class="form-control" required>
                                                                                <?php
                                                                                if ($course_id != '') {
                                                                                    $sql_course = "SELECT * FROM `tbl_course` WHERE `course_id` = '" . $row['course_id'] . "'";
                                                                                    $query_course = mysqli_query($con, $sql_course);
                                                                                    $row_course = $query_course->fetch_assoc();
                                                                                ?>
                                                                                    <option value="<?php echo $row_course['course_id']; ?>"><?php echo $row_course['course_name']; ?></option>
                                                                                <?php } else { ?>
                                                                                    <option value="">-Select-</option>
                                                                                <?php } ?>

                                                                                <?php
                                                                                $sql_course = "SELECT * FROM tbl_course";
                                                                                $query_course = mysqli_query($con, $sql_course);
                                                                                while ($row_course = mysqli_fetch_array($query_course)) {
                                                                                ?>
                                                                                    <option value="<?php echo $row_course['course_id']; ?>"><?php echo $row_course['course_name']; ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label>Registration No.</label>
                                                                            <input type="text" name="edit_registration_no" class="form-control" value="<?= $row_reg["registration_no"]; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <input type='hidden' name='edit_course_id' value='<?php echo $row["course_id"]; ?>'>
                                                                <input type='hidden' name='action' value='edit_migrations'>

                                                                <button type="submit" class="btn btn-primary mb-3">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                                <?php
                                                        $s_no++;
                                                }
                                            } else {
                                                echo '<tr><td colspan="13" class="text-center">No data available now!!!</td></tr>';
                                            }
                                            ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                    </div>
                                    <script>
                                    $(document).ready(function() {
                                        // Initialize the DataTable
                                        var table = $('#migrationFormTable').DataTable({
                                            scrollX: true,
                                            "paging": true,
                                            "lengthChange": false,
                                            "searching": true,
                                            "ordering": true,
                                            "info": true,
                                            "autoWidth": true,
                                        });

                                        // Handle status button click
                                        $('#migrationFormTable').on('click', '.status-btn', function() {
                                            var button = $(this);
                                            var admission_id = button.data('id');
                                            $.ajax({
                                                url: 'update_status.php', // The URL of the PHP script that will update the status
                                                type: 'POST',
                                                data: {
                                                    admission_id: admission_id
                                                },
                                                dataType: 'json',
                                                success: function(response) {
                                                    if (response.new_status) {
                                                        // Update the button text based on the new status
                                                        button.text(response.new_status);

                                                        // Update the cell content in the DataTable
                                                        var row = table.row(button.parents(
                                                            'tr'));
                                                        var cellIndex = table.cell(button
                                                                .parents('td')).index()
                                                            .column; // Get cell index
                                                        table.cell(row, cellIndex).data(
                                                            response.new_status).draw(
                                                            false);
                                                    } else {
                                                        alert(response.error);
                                                    }
                                                }
                                            });
                                        });

                                        $('#migrationFormTable').on('click', '.status-btn-lib', function() {
                                            var button = $(this);
                                            var admission_id = button.data('id');
                                            $.ajax({
                                                url: 'update_status2.php', // The URL of the PHP script that will update the status
                                                type: 'POST',
                                                data: {
                                                    admission_id: admission_id
                                                },
                                                dataType: 'json',
                                                success: function(response) {
                                                    if (response.new_status) {
                                                        // Update the button text based on the new status
                                                        button.text(response.new_status);

                                                        // Update the cell content in the DataTable
                                                        var row = table.row(button.parents(
                                                            'tr'));
                                                        var cellIndex = table.cell(button
                                                                .parents('td')).index()
                                                            .column; // Get cell index
                                                        table.cell(row, cellIndex).data(
                                                            response.new_status).draw(
                                                            false);
                                                    } else {
                                                        alert(response.error);
                                                    }
                                                }
                                            });
                                        });

                                        $('#migrationFormTable').on('click', '.status-btn-admin', function() {
                                            var button = $(this);
                                            var admission_id = button.data('id');
                                            $.ajax({
                                                url: 'update_status3.php', // The URL of the PHP script that will update the status
                                                type: 'POST',
                                                data: {
                                                    admission_id: admission_id
                                                },
                                                dataType: 'json',
                                                success: function(response) {
                                                    if (response.new_status) {
                                                        // Update the button text based on the new status
                                                        button.text(response.new_status);

                                                        // Update the cell content in the DataTable
                                                        var row = table.row(button.parents(
                                                            'tr'));
                                                        var cellIndex = table.cell(button
                                                                .parents('td')).index()
                                                            .column; // Get cell index
                                                        table.cell(row, cellIndex).data(
                                                            response.new_status).draw(
                                                            false);
                                                    } else {
                                                        alert(response.error);
                                                    }
                                                }
                                            });
                                        });

                                        $('#migrationFormTable').on('click', '.status-btn-finance', function() {
                                            var button = $(this);
                                            var admission_id = button.data('id');
                                            $.ajax({
                                                url: 'update_status4.php', // The URL of the PHP script that will update the status
                                                type: 'POST',
                                                data: {
                                                    admission_id: admission_id
                                                },
                                                dataType: 'json',
                                                success: function(response) {
                                                    if (response.new_status) {
                                                        // Update the button text based on the new status
                                                        button.text(response.new_status);

                                                        // Update the cell content in the DataTable
                                                        var row = table.row(button.parents(
                                                            'tr'));
                                                        var cellIndex = table.cell(button
                                                                .parents('td')).index()
                                                            .column; // Get cell index
                                                        table.cell(row, cellIndex).data(
                                                            response.new_status).draw(
                                                            false);
                                                    } else {
                                                        alert(response.error);
                                                    }
                                                }
                                            });
                                        });
                                        $('#migrationFormTable').on('click', '.status-btn-deptlab', function() {
                                            var button = $(this);
                                            var admission_id = button.data('id');
                                            $.ajax({
                                                url: 'update_status5.php', // The URL of the PHP script that will update the status
                                                type: 'POST',
                                                data: {
                                                    admission_id: admission_id
                                                },
                                                dataType: 'json',
                                                success: function(response) {
                                                    if (response.new_status) {
                                                        // Update the button text based on the new status
                                                        button.text(response.new_status);

                                                        // Update the cell content in the DataTable
                                                        var row = table.row(button.parents(
                                                            'tr'));
                                                        var cellIndex = table.cell(button
                                                                .parents('td')).index()
                                                            .column; // Get cell index
                                                        table.cell(row, cellIndex).data(
                                                            response.new_status).draw(
                                                            false);
                                                    } else {
                                                        alert(response.error);
                                                    }
                                                }
                                            });
                                        });
                                        $('#migrationFormTable').on('click', '.status-btn-it', function() {
                                            var button = $(this);
                                            var admission_id = button.data('id');
                                            $.ajax({
                                                url: 'update_status6.php', // The URL of the PHP script that will update the status
                                                type: 'POST',
                                                data: {
                                                    admission_id: admission_id
                                                },
                                                dataType: 'json',
                                                success: function(response) {
                                                    if (response.new_status) {
                                                        // Update the button text based on the new status
                                                        button.text(response.new_status);

                                                        // Update the cell content in the DataTable
                                                        var row = table.row(button.parents(
                                                            'tr'));
                                                        var cellIndex = table.cell(button
                                                                .parents('td')).index()
                                                            .column; // Get cell index
                                                        table.cell(row, cellIndex).data(
                                                            response.new_status).draw(
                                                            false);
                                                    } else {
                                                        alert(response.error);
                                                    }
                                                }
                                            });
                                        });
                                    });
                                    </script>

                                </div>

                            </div>   
                                    
                            </form>
                            <div class="col-12" id="loader_section"></div>
                            <!-- /.card-header -->
                            <div class="card-body" id="data_table">

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
    $(function() {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
    });
    </script>
    <script>
    function change_semester(semester) {
        $.ajax({
            url: 'include/ajax/add_semester.php',
            type: 'POST',
            data: {
                'data': semester
            },
            success: function(result) {
                document.getElementById('session_id').innerHTML = result;
            }

        });
    }

    function showdesg(session) {
        var dept = document.getElementById('course_id').value;
        $.ajax({
            url: 'ajaxdata.php',
            type: 'POST',
            data: {
                'depart': dept,
                'session': session
            },
            success: function(data) {
                $("#sem").html(data);
            },
        });

    }
    </script>

    <script>
    $(document).ready(function() {
        $('#fetchStudentDataForm').submit(function(event) {
            $('#loader_section').append(
                '<center id = "loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /></center>'
                );
            $('#fetchStudentDataButton').prop('disabled', true);
            $.ajax({
                url: 'include/view.php?action=fetch_migration_view',
                type: 'POST',
                data: $('#fetchStudentDataForm').serializeArray(),
                success: function(result) {
                    $('#response').remove();
                    $('#fee_list').empty();
                    if (result == 0) {
                        $('#error_section').append(
                            '<div id = "response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Please select Academic Year!!!</div></div>'
                            );
                    } else {
                        $('#fee_list').append('<div id = "response">' + result +
                        '</div>');
                    }
                    $('#loading').fadeOut(500, function() {
                        $(this).remove();
                    });
                    $('#fetchStudentDataButton').prop('disabled', false);
                }
            });
            event.preventDefault();
        });
    });
    </script>
    
</body>

</html>