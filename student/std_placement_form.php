<?php
error_reporting(0);
$page_no = "5";
$page_no_inside = "5_3";
include_once "include/authentication.php";


// print_r($rows);
// echo $rows;
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
    <style>
        .card-secondary:not(.card-outline)>.card-header {
            background-color: rgb(250, 214, 53) !important;
        }
    </style>

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php include_once 'include/navbar.php'; ?>
        <?php include_once 'include/aside.php'; ?>

        <?php
        $sql_course = "SELECT * FROM `tbl_placement`
         WHERE `status` = '$visible' AND course_id='" . $row["admission_course_name"] . "' AND academic_year='" . $row["admission_session"] . "';
         ";
        $result_course = $con->query($sql_course);
        $rows = $result_course->fetch_assoc();
        $no_of_rows = mysqli_num_rows($result_course);
        echo $rows;
        if ($no_of_rows > 0) {


        ?>



            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Apply For Placement Drive</h1>
                            </div>

                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Apply For Placement</li>
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
                                <h3 class="card-title">Apply For Placement</h3>
                            </div>
                            <form role="form" method="POST" id="add_placement_form">

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12" id="error_section"></div>


                                        <?php
                                        $sql = "SELECT * FROM `tbl_admission` WHERE `status` = '$visible' && `admission_id` = '" . $_SESSION['user']["admission_id"] . "'";
                                        $result = $con->query($sql);
                                        $row = $result->fetch_assoc();


                                        $sql = "SELECT * FROM `tbl_university_details`
                                        WHERE `status` = '$visible' && university_details_id = '" . $row["admission_session"] . "'
                                         ORDER BY `university_details_id` DESC
                                         ";
                                        $result = $con->query($sql);
                                        $row_session = $result->fetch_assoc();
                                        //   echo $row_session['academic_session'];

                                        $sql_course = "SELECT * FROM `tbl_course`
                                      WHERE `status` = '$visible' && `course_id` = '" . $row["admission_course_name"] . "' 
                                          ";
                                        $result_course = $con->query($sql_course);
                                        $rows_course = $result_course->fetch_assoc();
                                        // echo $rows_course['course_name'];
                                        // exit;




                                        $sql_course = "SELECT * FROM `tbl_placement`
                                                         WHERE `status` = '$visible' AND course_id='" . $row["admission_course_name"] . "' AND academic_year='" . $row["admission_session"] . "';
                                                         ";
                                        $result_course = $con->query($sql_course);
                                        $rows = $result_course->fetch_assoc();
                                        ?>

                                    </div>


                                </div>


                                <!-- style="width: -webkit-fill-available;" -->
                                <div class="card-body card-secondary" style="width: -webkit-fill-available;">
                                    <div class="card-header">
                                        <h3 class="card-title">APPLICATION FORM FOR PLACEMENT
                                        </h3>
                                    </div>
                                    <div class="card-body table-responsive p-0">
                                        <div class="card-body">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for=""> Form Start Date </label>
                                                        <input class="form-control" type="text" name="form_start_date" value="<?php echo $rows["form_start_date"]; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for=""> Form Last Date </label>
                                                        <input class="form-control" type="text" name="form_last_date" value="<?php echo $rows["form_last_date"]; ?>" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for=""> Select Company Name </label>
                                                        <select class="form-control" name="company_id" id="company_id"
                                                            onchange="change_semester(this.value)" required>
                                                            <option value="all">Select</option>
                                                            <?php
                                                            $sql_course = "SELECT * FROM `tbl_placement`
                                                         WHERE `status` = '$visible' AND course_id='" . $row["admission_course_name"] . "' AND academic_year='" . $row["admission_session"] . "' order by company_name asc;
                                                         ";
                                                            $result_course = $con->query($sql_course);

                                                            while ($row_course = $result_course->fetch_assoc()) {
                                                            ?>
                                                                <option value="<?php echo $row_course["company_name"]; ?>">
                                                                    <?php echo $row_course["company_name"]; ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for=""> Job Title </label>
                                                        <select name="job_type[]" class="form-control" id="job_title" require>
                                                            <option value="0">Select</option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for=""> Others Skills </label>
                                                        <input class="form-control" type="textarea" name="company_name[]" placeholder="other information" required>
                                                    </div>
                                                </div>

                                            </div>


                                        </div>
                                    </div>
                                    <button type="submit" id="add_semester_button" class="btn btn-primary">Apply Placement</button>
                                </div>




                                <br>
                                <input type='hidden' name='action' value='std_placement_form' />
                                <input type='hidden' name='std_first_name' value='<?php echo $row['admission_first_name']; ?>' />
                                <input type='hidden' name='std_last_name' value='<?php echo $row['admission_last_name']; ?>' />
                                <input type='hidden' name='std_session' value='<?php echo $row_session['academic_session']; ?>' />
                                <input type='hidden' name='std_course' value='<?php echo $rows_course['course_name']; ?>' />
                                <input type='hidden' name='student_id' value='<?php echo $_SESSION['user']['admission_id']; ?>' />
                                <div class="col-md-12" id="loader_section"></div>

                                <!-- <button type="reset" class="btn btn-danger">Reset</button> -->

                                <!-- /.card-body -->



                            </form>
                        </div>
                    </div>

            </div>
            </section>


            <!-- /.content -->
    </div>
<?php
        } else {
            echo  '<h1  style="margin-bottom: 95%; text-align:center" > Placement form will start soon.</h2>';
        }
?>
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
<!-- <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>/ -->
<!-- Bootstrap Switch -->
<!-- <script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script> -->
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- DataTables -->
<!-- <script src="plugins/datatables/jquery.dataTables.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script> -->
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<!-- Page script -->


<script>
    $(function() {

        $('#add_semester_button').click(function() {
            $('#loader_section').append(
                '<center id = "loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /></center>'
            );
            $('#add_semester_button').prop('disabled', true);
            $.ajax({
                url: 'include/controller.php',
                type: 'POST',
                data: $('#add_placement_form').serializeArray(),
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
                        $('#add_placement_form')[0].reset();
                        $('#error_section').append(
                            '<div id = "response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Your placement form applied successfully!!!</div></div>'



                        );

                        // window.location.href = 'placement_reciept.php';
                        window.location.replace("placement_reciept.php");

                    }
                    if (result == "update") {
                        $('#add_placement_form')[0].reset();
                        $('#error_section').append(
                            '<div id = "response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Semester updated successfully!!!</div></div>'
                        );
                    }
                    if (result == "already") {
                        $('#add_placement_form')[0].reset();
                        $('#error_section').append(
                            '<div id = "response"><div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> You have already applied for this placement!!!    For download reciept <a href="placement_reciept.php">click here</a> </div></div>'
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
                '" readonly class="form-control" style="border:none;" /> </td><input type="text" name="migration_fee[]" placeholder="Migration Fee" class="form-control" /></td><td><input type="text" name="migration_fine[]" placeholder="Migration Fine" class="form-control" /></td><td><select name="migrationfee_status[]" class="form-control" id="job_title"><option value="0">Select</option><option value="Active">Active</option><option value="Inactive">Inactive</option></select></td><td><input type="text" name="examname[]" placeholder="Companay Name" class="form-control" /></td><td><button type="button" name="remove" id="' +
                i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
        });

        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });

    });

    function change_semester(semester) {
        $.ajax({
            url: 'ajaxfetchjobtitle.php',
            type: 'POST',
            data: {
                'data': semester
            },
            success: function(result) {
                document.getElementById('job_title').innerHTML = result;
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


    //  function fetchJobTitle(company){
    //     //      var company_id = document.getElementById('company_id');
    //     //   console.log(company)
    //       $.ajax({
    //         url: 'ajaxfetchjobtitle.php',
    //         type: 'POST',
    //         data: {
    //             'company_id':company_id
    //         },
    //         success:function(job_title){

    //              document.getElementById('').innerHTML = job_title; 
    //         }
    //       })
    // }
</script>
</body>

</html>