<?php 
    $page_no = "14";
    $page_no_inside = "14_1";
    include_once "include/authentication.php"; 
	$visible = md5("visible");
	date_default_timezone_set("Asia/Calcutta");
    $date_variable_today_month_year_with_timing = date("d M, Y. h:i A");
?>
<?php
        if(isset($_POST["importExcelButton"]))
        {
            $conn = mysqli_connect("localhost", "root", "", "zeit");
            $file = $_FILES['importExcelFile']['tmp_name'];
            $handle = fopen($file, "r");
            if ($file == NULL) {
                echo "<script>
                        alert('Please first select an Excel file!!!');
                        location.replace('student_view');
                    </script>";
                   
            }
            else {
                $c = 0;
                while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
                {   
                    
                    $admission_id = $filesop[0];
					$student_name = $filesop[1];
					$student_course_name = $filesop[2];								
					$academic_year = $filesop[3];
					$student_semester_name = $filesop[4];	
					$serial_no = $filesop[5];
                    $reg_no = $filesop[6];
                    $roll_no = $filesop[7];
					$course_id = "";
                    $semester_id = "";
					$fee_academic_year = "";
                    $type = $filesop[8];
                    
                    $sql_grade = "SELECT * FROM `tbl_course` WHERE `course_name`='$student_course_name' ";
                    $result_grade = mysqli_query($conn, $sql_grade);
                    $row_grade = mysqli_fetch_assoc($result_grade);
                    $course_id = $row_grade["course_id"];
					
					$sql_semester = "SELECT * FROM `tbl_semester` WHERE `semester`='$student_semester_name' ";
                    $result_semester = mysqli_query($conn, $sql_semester);
                    $row_semester = mysqli_fetch_assoc($result_semester);
                    $semester_id = $row_semester["semester_id"];
					
					$sql_year = "SELECT * FROM `tbl_university_details` WHERE `academic_session`='$academic_year' ";
					$result_year = mysqli_query($conn, $sql_year);
					$row_year = mysqli_fetch_assoc($result_year);
					$fee_academic_year = $row_year["university_details_id"];
					
                    $sql = "INSERT INTO `tbl_admission_details`(`admission_details_id`,`admission_id`, `student_name`,`course_id`,`academic_year`, `serial_no`,`reg_no`, `roll_no`, `semester_id`,`type`,`create_time` ,`status`) 
                    VALUES ('','$admission_id','$student_name','$course_id','$academic_year','$serial_no','$reg_no','$roll_no','$semester_id','$type','$date_variable_today_month_year_with_timing','$visible')";  
                    $stmt = mysqli_prepare($conn,$sql);
                    mysqli_stmt_execute($stmt);
                    $c = $c + 1;
                }
                if($sql){
                   echo "<script>
                            alert('Excel Imported Successfully!!!');
                            location.replace('student_view');
                        </script>";
                } 
                else
                {
                    echo "<script>
                            alert('Something went wrong please try again!!!');
                            location.replace('student_view');
                        </script>";
                }
            }
        }
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

                            <!--<div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                            </div>-->
                            <!-- <div id="response"
						class="<?php // if(!empty($type)) { echo $type . " display-block"; } ?>">
						<?php // if(!empty($message)) { echo $message; } ?>
						</div>
                        
						<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
								<div class="input-row">
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="images/marksheet/STUDENT_FORMAT.csv"><b style="font-size:16px;">Format</b></a>
									<label class="col-md-4 control-label">Choose CSV
										File</label> <input type="file" name="importExcelFile" />
									<input type="submit" name="importExcelButton" class="btn btn-success btn-sm" value="Import" />
									
								</div>

					    </form>-->
                            <form role="form" method="POST" id="fetchStudentDataForm">
                                <div class="card-body" style="margin-top: 0px;">
                                    <div class="row">
                                        <div class="col-12" id="error_section"></div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label>Course Name</label>
                                                <select class="form-control rounded-pill" id="course_id"
                                                    name="course_id" onchange="change_semester(this.value)">
                                                    <option value="0">Select Course</option>
                                                    <?php 
                                                    $sql_course = "SELECT * FROM `tbl_course`
                                                                   WHERE `status` = '$visible' order by course_name asc;
                                                                   ";
                                                    $result_course = $con->query($sql_course);
                                                    while($row_course = $result_course->fetch_assoc()){
                                                ?>
                                                    <option value="<?php echo $row_course["course_id"]; ?>">
                                                        <?php echo $row_course["course_name"]; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="form-group">
                                                <label>Academic Year</label>
                                                <select class="form-control rounded-pill "
                                                    onchange="showdesg(this.value)" id="session_id"
                                                    name="academic_year">
                                                    <option value="0">Select Academic Year</option>
                                                    <?php 
                                                    $sql_ac_year = "SELECT * FROM `tbl_university_details`
                                                                   WHERE `status` = '$visible';
                                                                   ";
                                                    $result_ac_year = $con->query($sql_ac_year);
                                                    while($row_ac_year = $result_ac_year->fetch_assoc()){
                                                ?>
                                                    <?php 
                    							  $completeSessionStart = explode("-", $row_ac_year["university_details_academic_start_date"]);
                    							  $completeSessionEnd = explode("-", $row_ac_year["university_details_academic_end_date"]);
                    							  $completeSessionOnlyYear = $completeSessionStart[0]."-".$completeSessionEnd[0];
                    							?>
                                                    <option
                                                        value="<?php echo $row_ac_year["university_details_id"]; ?>">
                                                        <?php echo $completeSessionOnlyYear ; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label>Semester</label>
                                                <select class="form-control rounded-pill " name="semester_id" id="sem"
                                                    onchange="show(this.value)">
                                                    <option value="-1">Select</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-1" style="margin-top: 29px;">
                                            <button type="submit" id="fetchStudentDataButton"
                                                class="btn btn-primary rounded-pill ">Go</button>
                                        </div>
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
    $(document).ready(function() {
        $('#fetchStudentDataForm').submit(function(event) {
            $('#loader_section').append(
                '<center id = "loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /></center>'
            );
            $('#fetchStudentDataButton').prop('disabled', true);
            $.ajax({
                url: 'include/view.php?action=get_student_admitcard',
                type: 'POST',
                data: $('#fetchStudentDataForm').serializeArray(),
                success: function(result) {
                    $('#response').remove();
                    if (result == 0) {
                        $('#error_section').append(
                            '<div id = "response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Please select Academic Year!!!</div></div>'
                        );
                    } else {
                        $('#data_table').append('<div id = "response">' + result +
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
</body>

</html>