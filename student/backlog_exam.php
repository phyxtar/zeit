<?php
error_reporting(0);
$page_no = "4";
$page_no_inside = "4_2";
include "include/authentication.php";
$row = $_SESSION['user'];
$course_id = $row["admission_course_name"];
$academic_yearId = $_SESSION['user']["admission_session"];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NETAJI SUBHAS UNIVERSITY | Admission Form </title>
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
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
    .form-control {
        font-weight: 900 !important;
        color: #ad183a !important;
        margin-bottom: 15px;
    }

    .responsive-container {
        width: 90%;
        max-width: 800px;
        margin: 0 auto;
        background-color: red;
        color: white;
        padding: 10px;
        text-align: center;
    }

    /* Responsive adjustments */
    @media (max-width: 600px) {
        .responsive-container {
            width: 95%;
            padding: 15px;
        }

        .responsive-container h1 {
            font-size: 1.5rem;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini" oncontextmenu="return false;">
    <?php include 'imp_notice.php'; ?>
    <div class="wrapper">

        <?php include 'include/navbar.php'; ?>
        <?php include 'include/aside.php'; ?>

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-10">
                            <h1>BACKLOG EXAMINATION FORM - For University Campus Programme</h1>
                        </div>
                        <div class="col-sm-2">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Main content -->
            <?php
            $student_data = fetchRow('tbl_allot_semester', '`admission_id`=' . $row['admission_id'] . ' ORDER BY allot_id DESC');
           $semester_id = $student_data['semester_id'];
            $reg_no = $student_data['reg_no'];
            //  $sql_sem = "SELECT * FROM `tbl_semester`
            //            WHERE `semester_id`='$semester_id' && `course_id` = $course_id && `fee_academic_year` = '" . $row["admission_session"] . "'";

            $sql_sem = "SELECT * FROM `tbl_backlogs` ORDER BY `backlogs_id` DESC ";
            $sem_result = $con->query($sql_sem);
            $sem_row = $sem_result->fetch_assoc();
            $today = date("Y-m-d");
            // echo $today;
            // echo "<pre>";
            // print_r($sem_row);
            // echo "</pre>";

            if ($sem_row['form_start_date'] == "") {
            ?>
            <div class="responsive-container">
                <h1>Examination Form Haven't Started Yet.</h1>
            </div>
            <?php
            } elseif ($sem_row['form_close_date'] != "" && strtotime($sem_row['form_close_date'] . ' 23:59:59') < time()) {
            ?>
            <div class="responsive-container">
                <h1>Examination Form has been Ended on
                    <?php echo $sem_row['form_close_date']; ?>
                </h1>
            </div>
            <?php



            } else {
            ?>
            <section class="content">
                <div class="container-fluid">
                    <!-- SELECT2 EXAMPLE -->
                    <div class="card card-default">
                        <form role="form" method="POST" id="fetchStudentDataForm">
                            <div class="card-body">

                                <div class="row">
                                    <?php

                                       
                                        if (isset($sem_row['form_start_date']) && $today >= $sem_row['form_start_date']) {
                                          

                                        ?>
                                    <div class="card card-secondary" style="width: -webkit-fill-available;">
                                        <div class="card-header">
                                            <h3 class="card-title">INSTRUCTIONS FOR FILLING UP THE EXAMINATION FORM:
                                            </h3>
                                        </div>
                                        <div class="card-body table-responsive p-0">
                                            <div class="card-body">
                                                <ul>
                                                    <li>Write correct subject code(s) as indicated in your Programme
                                                        Guide / Syllabus.</li>
                                                    <li>In case, wrong / invalid course or subject code is mentioned in
                                                        examination form, the
                                                        Admit Card will not be issued.</li>
                                                    <li>Submit examination form within the due date.</li>
                                                    <li>It is advised to enclose photocopy of Admit Card / Mark sheet /
                                                        Registration slip of the
                                                        last examination passed.</li>
                                                    <li>Registration is valid for only enrolled Course.</li>
                                                    <li>The enrolment number, subject code, papers’ name are correctly
                                                        filled in the examination
                                                        form.</li>
                                                    <li> Examination fees once paid, not refundable / adjusted in any
                                                        case.</li>
                                                    <li> The correct size of a passport photo and candidate signature is
                                                        must within between 50KB
                                                    </li>
                                                </ul><br><br><br>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Course Name</label>
                                                            <input type="hidden" name="academic_year"
                                                                value="<?php echo $row["academic_year"]; ?>">
                                                            <?php
                                                                        $sql_course = "SELECT * FROM `tbl_course`
															   WHERE `status` = '$visible';
															   ";
                                                                        $result_course = $con->query($sql_course);
                                                                        while ($row_course = $result_course->fetch_assoc()) {
                                                                            if ($course_id == $row_course["course_id"]) {
                                                                        ?>
                                                            <input type="hidden" name="course_id"
                                                                value="<?php echo $course_id ?>">
                                                            <input type="hidden" name="academic_year"
                                                                value="<?php echo $academic_yearId ?>">
                                                            <input class="form-control  rounded-pill" name=""
                                                                id="course_id"
                                                                value="<?php echo $row_course["course_name"]; ?>"
                                                                readonly>
                                                            <?php }
                                                                        } ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-4" style="display: none;">
                                                        <div class="form-group">
                                                            <label>Semester</label>
                                                            <input type="hidden" name="subject_id">
                                                            <select class="form-control  rounded-pill"
                                                                name="semester_id" id="sem"
                                                                onchange="showdesg1(this.value)" required>
                                                                <option value="<?= $sem_row['semester_id'] ?>">
                                                                    <?= $sem_row['semester'] ?>
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label>Exam Fee</label>
                                                            <input type="text" class="form-control  rounded-pill"
                                                                name="amount" id="amount" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php

                                         
                                        } else {

                                            if (isset($sem_row['form_start_date']) && $today <= $sem_row['form_start_date']) { ?>
                                    <h4 class="text-warning">Dear <strong class="text-dark">
                                            <?= ucfirst($_SESSION['user']["admission_first_name"]) ?>
                                        </strong> Examination Form Start Form
                                        <?= date('d-M-Y', strtotime($sem_row['form_start_date'])) ?> .
                                    </h4>;

                                    <?php } else { ?>
                                    <h4 class="text-warning">Dear <strong class="text-dark">
                                            <?= ucfirst($_SESSION['user']["admission_first_name"]) ?>
                                        </strong> Examination has been closed on this date
                                        <?= date('d-M-Y', strtotime($sem_row['form_close_date'])) ?> .
                                    </h4>;

                                    <?php }
                                        }
                                        ?>
                                </div>
                            </div>
                        </form>
                        <div class="col-12" id="loader_section"></div>
                        <!-- /.card-header -->
                        <div class="card-body" id="data_table">

                        </div>
                    </div>
                </div>
            </section>
            <?php } ?>
            <!-- /.content -->
        </div>
        <script>
        function image_check(element, uploadImageSize) {
            var imgpath = element;
            console.log(element.files[0]);
            if (element.files[0].type == "image/jpeg" || element.files[0].type == "image/jpg" || element.files[0]
                .type == "image/png") {
                if (!imgpath.value == "") {

                    var img = imgpath.files[0].size;
                    var imgsize = Math.round(img / 1024);
                    if (imgsize > uploadImageSize) {
                        alert("Image size is " + imgsize + " KB please Upload  Image smaller than " + uploadImageSize +
                            " KB");
                        element.value = "";
                    }
                }

            } else {
                alert("Image type must be jpg or jpeg or png only");
                element.value = "";
            }
        }
        </script>
        <?php include 'include/footer.php'; ?>

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
    <script>
    document.onkeydown = function(e) {
        if (event.keyCode == 123) {
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



    function fetch_data() {
        $('#loader_section').append(
            '<center id = "loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /></center>'
        );
        $('#fetchStudentDataButton').prop('disabled', true);
        $.ajax({
            url: 'include/view.php?action=fetch_backlog_exam_form',
            type: 'POST',
            data: $('#fetchStudentDataForm').serializeArray(),
            success: function(result) {
                $('#response').remove();
                if (result == 0) {
                    $('#error_section').append(
                        '<div id = "response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Please select Academic Year!!!</div></div>'
                    );
                } else {
                    $('#data_table').append('<div id = "response">' + result + '</div>');
                }
                $('#loading').fadeOut(500, function() {
                    $(this).remove();
                });
                $('#fetchStudentDataButton').prop('disabled', false);
            }
        });
        event.preventDefault();
    }
    </script>
    <script>
    $(function() {
        function showdesg() {
            dept = <?= $course_id ?>;
            academic_year = <?= $academic_yearId ?>;
            $.ajax({
                url: '../ajaxdata3.php',
                type: 'POST',
                data: {
                    depart: dept,
                    academic_year: academic_year
                },
                success: function(data) {
                    $("#sem").html(data);
                },
            });
        }
    });
    </script>
    <script>
    showdesg1();

    function showdesg1() {
        var dept1 = document.getElementById('sem').value
        $.ajax({
            url: 'ajaxdata_backlog.php',
            type: 'POST',
            data: {
                depart1: dept1
            },
            success: function(data) {
                $("#amount").val(data);
                fetch_data();
            },
        });

    }
    </script>

</body>

</html>