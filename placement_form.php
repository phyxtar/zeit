<?php
$page_no = "11";
$page_no_inside = "11_15";
include_once "include/authentication.php";
$visible = md5("visible");
$trash = md5("trash");
date_default_timezone_set("Asia/Calcutta");
$date_variable_today_month_year_with_timing = date("d M, Y. h:i A");
$msg='';
$fail='';
$imag='';

if ($_POST["action"] == "add_placement") {

  
  

       // Get file details
       $fileName = $_FILES['company_logo']['name'];
       $fileTmpName = $_FILES['company_logo']['tmp_name'];
       $fileSize = $_FILES['company_logo']['size'];
       $fileError = $_FILES['company_logo']['error'];
       $fileType = $_FILES['company_logo']['type'];

       // Allowed file types (You can add more types)
       $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];


       $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
       $newFileName = uniqid('', true) . '.' . $fileExt;

       // Specify the directory to store the uploaded file
       $uploadDir = 'uploads/';
       if (!file_exists($uploadDir)) {
           mkdir($uploadDir, 0777, true); // Create uploads folder if not exists
       }

       // Specify the path to save the file
       $filePath = $uploadDir . $newFileName;

       // Move the uploaded file to the desired location
       if (move_uploaded_file($fileTmpName, $filePath)) {
        //    echo "File uploaded successfully!<br>";
        //    echo "File path: " . $filePath;
       } else {
        $imag='error';
        //    echo "Error moving the uploaded file.";
       }









    $course_id = $_POST["course_id"];
    $academic_year = $_POST["academic_year"];
    //  $semester = str_replace("'", "&#39;", $_POST["semester"]);
    $company_name = str_replace("'", "&#39;", $_POST["company_name"]);
    // $exam_fine = str_replace("'", "&#39;", $_POST["exam_fine"]);
    // $exam_fee_last_date = $_POST["exam_fee_last_date"];
    $migrationfee_status = $_POST["migrationfee_status"];
    $job_title = str_replace("'", "&#39;", $_POST["job_title"]);
    $form_start_date = $_POST["form_start_date"];
    $form_last_date = $_POST["form_last_date"];


    if (!empty($course_id && $academic_year) != "" && $job_title[0] != "") {
        // $allSemester = count($semester);

        // exit;/
        $allExamname = count($job_title);



        if ($course_id == "all") {
            for ($i = 0; $i < $allExamname; $i++) {
                $sql = "INSERT INTO tbl_placement
                        (id, course_id, academic_year,company_name,migrationfee_status, job_title, add_time, status,form_start_date,form_last_date) 
                        VALUES 
                        (NULL,'all','all','$company_name[$i]','$migrationfee_status[$i]','$job_title[$i]','$date_variable_today_month_year_with_timing','$visible','$form_start_date','$form_last_date');
                        ";
            }
            if ($con->query($sql))
                echo 'success';
            else
                echo 'error';
        } else {



            $sql = "";
            for ($i = 0; $i < $allExamname; $i++) {
                // $sql_check = "SELECT * FROM tbl_placement
                //              WHERE status = '$visible' && course_id = '$course_id' && academic_year = '$academic_year';
                //              ";
                // $result = $con->query($sql_check);
                // if ($result->num_rows > 0) {
                //     $row = $result->fetch_assoc();
                //     $sql .= "UPDATE tbl_placement 
                //             SET job_title='$job_title[$i]',add_time='$date_variable_today_month_year_with_timing'
                //             WHERE status = '$visible' && course_id = '$course_id' && academic_year = '$academic_year';
                //             ";
                // } else {

                // exit;
                $sql .= "INSERT INTO tbl_placement
                        (id, course_id, academic_year,company_name,logo_data,company_status, job_title, add_time, status,form_start_date,form_last_date) 
                        VALUES 
                        (NULL,'$course_id','$academic_year','$company_name[$i]','$filePath','$migrationfee_status[$i]','$job_title[$i]','$date_variable_today_month_year_with_timing','$visible','$form_start_date','$form_last_date');
                        ";
                // }
                // exit;
            }
            if ($con->multi_query($sql)){
                $msg = 'success';   
                // echo $msg;
            }
            else{
                $fail='error';
                // echo $fail;
            }
        }
    } else
        // echo 'empty';
        $fail='error';
}









?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NETAJI SUBHAS UNIVERSITY | Add Placement </title>
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
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <script>

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
                            <h1>Add Placement</h1>
                        </div>

                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Add Placement</li>
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
                            <h3 class="card-title">Add Placement</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-success"><a href="placemet_comp_view.php"
                                        style="color: #fff;">
                                        Placement List</a></button>

                            </div>
                            <!-- <div class="card-tools">
                                <button type="button" class="btn btn-success"><a href="reg_view" style="color: #fff;">
                                        Migration List</a></button>

                            </div> -->
                        </div>
                        <?php
                                    if(!$msg==''){
                                        ?>
                                      <div id = "response" class="col-md-12"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Placement added successfully!!!</div></div>'
                                      <?php
                                    }
                                    ?>
                                    <?php
                                    if(!$fail==''){
                                        ?>
                                      <div id = "response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>
                                      <?php
                                    }
                                    ?>
                                      <?php
                                    if(!$imag==''){
                                        ?>
                                      <div id = "response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Image not upload please try again!!!</div></div>
                                      <?php
                                    }
                                    ?>

                        <form role="form" method="POST" id="add_migration_form" enctype="multipart/form-data">
                            <div class="card-body">
                          
                                <div class="row">
                                    <!-- <div class="col-md-12" id="error_section"></div> -->

                                  

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Course Name</label>
                                            <select class="form-control" name="course_id" id="course_id"
                                                onchange="change_semester(this.value)">
                                                <!-- <option value="all">All</option> -->
                                                <?php
                                                $sql_course = "SELECT * FROM tbl_course
                                                WHERE status = '$visible' order by course_name asc;
                                              ";
                                                $result_course = $con->query($sql_course);
                                                while ($row_course = $result_course->fetch_assoc()) {
                                                ?>
                                                    <option value="<?php echo $row_course["course_id"]; ?>">
                                                        <?php echo $row_course["course_name"]; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Academic Year</label>
                                            <select class="form-control" name="academic_year" id="session"
                                                onchange="showdesg(this.value)">
                                                <?php
                                                $sql_ac_year = "SELECT * FROM tbl_university_details
                                                WHERE status = '$visible';
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
                                                        <?php echo $completeSessionOnlyYear; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for=""> Placement Form Start Date </label>
                                            <input class="form-control" type="date" name="form_start_date">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for=""> Placement Form Last Date </label>
                                            <input class="form-control" type="date" name="form_last_date">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- /.card-header -->

                            <div class="card-body">
                                <table class="table table-bordered table-responsive" id="dynamic_field">
                                    <thead>
                                        <tr>
                                            <th data-field="S.NO" data-sortable="true" rowspan="2">S.NO</th>
                                            <th data-field="Migration Fee" data-sortable="true" rowspan="2">Enter Company Name

                                            </th>
                                            <!-- <th data-field="Migration Fee" data-sortable="true" rowspan="2">Company Logo
                                                
                                                </th> -->
                                            <th data-field="ExamName" data-sortable="true" rowspan="2">Company Logo
                                            </th>
                                            <th data-field="Status" data-sortable="true" rowspan="2">Job Title</th>
                                            <th data-field="Status" data-sortable="true" rowspan="2">Status</th>

                                            <!-- <th rowspan="2">Actions</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="5%"><input type="text" id="slno1" value="1" readonly
                                                    class="form-control" style="border:none;" /></td>
                                            <!-- <td><input type="hidden" name="semester[]" placeholder="Semester"
                                                    class="form-control" /></td> -->
                                            <td><input type="text" name="company_name[]" placeholder="Company Name"
                                                    class="form-control" /></td>

                                            <td><input type="file" name="company_logo" 
                                                    class="form-control" value=""  required />
                                            </td>
                                            <td><input type="text" name="job_title[]" placeholder="Job Title"
                                                    class="form-control" value="" required/>
                                            </td>
                                            <td><select name="migrationfee_status[]" class="form-control">
                                                    <option value="0">Select</option>
                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>
                                                </select></td>

                                            <!-- <td><input type="text" name="examname[]" placeholder="migration Name"
                                                    class="form-control" value="Application For Migration CUM CLC Form"
                                                    readonly />
                                            </td> -->

                                            <!-- <td><button type="button" name="add" id="add" class="btn btn-success"><i
                                                        class="fa fa-plus" aria-hidden="true"></i></button></td> -->

                                        </tr>
                                    </tbody>
                                </table>

                                <br>
                                <input type='hidden' name='action' value='add_placement' />
                                <div class="col-md-12" id="loader_section"></div>
                                <button type="submit" id="add_semester_button" class="btn btn-primary">Add</button>
                                <button type="reset" class="btn btn-danger">Reset</button>
                            </div>
                            <!-- /.card-body -->


                    </div>

                    </form>
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
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>

    <!-- Page script -->


    <script>
        $(function() {

            // add btn name change
            $('#add_semester_').click(function() {
                $('#loader_section').append(
                    '<center id = "loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /></center>'
                );
                $('#add_semester_button').prop('disabled', true);
                $.ajax({
                    url: 'include/controller.php',
                    type: 'POST',
                    data: $('#add_migration_form').serializeArray(),
                    success: function(result) {
                        $('#response').remove();
                        if (result == "courseempty")
                            $('#error_section').append(
                                '<div id = "response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Please First Add!!!</div></div>'
                            );
                        if (result == "empty")
                            $('#error_section').append(
                                '<div id = "response"><div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-exclamation-triangle"></i>  Please fill out all required fields!!!</div></div>'
                            );
                        if (result == "error")
                            $('#error_section').append(
                                '<div id = "response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                            );
                        if (result == "success") {
                            $('#add_migration_form')[0].reset();
                            $('#error_section').append(
                                '<div id = "response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Semester added successfully!!!</div></div>'
                            );
                        }
                        if (result == "update") {
                            $('#add_migration_form')[0].reset();
                            $('#error_section').append(
                                '<div id = "response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Semester updated successfully!!!</div></div>'
                            );
                        }
                        console.log(result);
                        $('#loading').fadeOut(500, function() {
                            $(this).remove();
                        });
                        $('#add_semester_button').prop('disabled', false);
                    }

                });
            });

        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            var i = 1;

            $('#add').click(function() {
                i++;
                $('#dynamic_field').append('<tr id="row' + i +
                    '" class="dynamic-added" ><td><input type="text" id="slno' + i + '" value="' + i +
                    '" readonly class="form-control" style="border:none;" /></td><input type="text" name="migration_fee[]" placeholder="Migration Fee" class="form-control" /></td><td><input type="text" name="migration_fine[]" placeholder="Migration Fine" class="form-control" /></td><td><input type="date" name="Migration_fee_last_date[]" placeholder="" class="form-control" /></td><td><select name="migrationfee_status[]" class="form-control"><option value="0">Select</option><option value="Active">Active</option><option value="Inactive">Inactive</option></select></td><td><input type="text" name="examname[]" placeholder="Migration Name" class="form-control" /></td><td><button type="button" name="remove" id="' +
                    i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
            });

            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });

        });

        function change_semester(semester) {
            $.ajax({
                url: 'include/ajax/add_semester.php',
                type: 'POST',
                data: {
                    'data': semester
                },
                success: function(result) {
                    document.getElementById('session').innerHTML = result;
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