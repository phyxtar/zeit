<?php
$page_no = "4";
$page_no_inside = "4_2";
include "include/authentication.php";
include "include/config.php";
$visible = md5("visible");
$msg = '';
$random_number = rand(1111111111111, 9999999999999); // Random Number
$image_dir = "images/student_images_new";
$sign_dir = "images/student_sign_new";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NETAJI SUBHAS UNIVERSITY | Examination Form </title>
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
    }

    /*Right click disabled*/
    /* Disables the selection */
    .disableselect {
        -webkit-touch-callout: none;
        /* iOS Safari */
        -webkit-user-select: none;
        /* Chrome/Safari/Opera */
        -khtml-user-select: none;
        /* Konqueror */
        -moz-user-select: none;
        /* Firefox */
        -ms-user-select: none;
        /* Internet Explorer/Edge*/
        user-select: none;
        /* Non-prefixed version, currently 
                                  not supported by any browser */
    }

    .alert {
        width: 855px;
        margin: auto;
    }

    /* Disables the drag event 
(mostly used for images) */
    .disabledrag {
        -webkit-user-drag: none;
        -khtml-user-drag: none;
        -moz-user-drag: none;
        -o-user-drag: none;

    }

    /* // Right click disabled*/
    </style>
</head>

<body class="hold-transition sidebar-mini" oncontextmenu="return false;">
    <?php include 'imp_notice.php'; ?>
    <!-- Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Important Message</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <p><strong>Don't refresh or press back:</strong> Please wait until you receive the paid receipt for
                        your
                        examination form submission.</p>
                    <p style="color: red; font-size: 15px; font-weight:bold;">If you refresh or navigate away from this
                        page, it will be
                        your
                        responsibility for any issues that may arise, and you cannot claim for the paid amount.</p>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <div class="wrapper">

        <?php include 'include/navbar.php'; ?>
        <?php include 'include/aside.php'; ?>

        <?php



        if (isset($_POST['submit'])) {
            $student = array();
            $student['admission_id'] = $_SESSION['user']['admission_id'];
            $student['course_id'] = $_POST["course_id"];
            $student['academic_year'] = $_POST["academic_year"];
            $student['semester_id'] = $_POST["semester_id"];
            $student['registration_no'] = $_POST["registration_no"];
            $student['roll_no'] = $_POST["roll_no"];
            $student['candidate_name'] = $_POST["candidate_name"];
            $student['father_name'] = $_POST["father_name"];
            $student['department'] = $_POST["department"];
            $student['gender'] = $_POST["gender"];
            $student['dob'] = $_POST["dob"];
            $student['email_id'] = $_POST["email_id"];
            $student['mobile_no1'] = $_POST["mobile_no1"];
            $student['mobile_no2'] = $_POST["mobile_no2"];
            $student['adhar_no'] = $_POST["adhar_no"];
            $student['address'] = $_POST["address"];
            $student['last_exam_year'] = $_POST["last_exam_year"];
            $student['paper_code'] = $_POST["paper_code"];
            $student['paper_name'] = $_POST["paper_name"];
            $student['create_time'] = date('Y-m-d h:m:s');
            $student['status'] = $visible;
            $student['amount'] = 0;



            // $photos = fetchRow('tbl_examination_form', '`admission_id`=' . $student['admission_id'] . ' && `semester_id`=' . $student['semester_id'] . '');

            // if ($photos['candidate_signature'] == '') {
            //     $candidate_signature_rand = date('Ymdhis') . $_FILES["candidate_signature"]["name"];
            // } else {
            //     $candidate_signature_rand = $photos['candidate_signature_rand'];
            // }

            // if ($photos['passport_photo'] == '') {
            //     $passport_photo_rand = date('Ymdhis') . $_FILES["passport_photo"]["name"];
            // } else {
            //     $passport_photo_rand = $photos['passport_photo'];
            // }

            // function file_upload1($image, $destination, $size_in_kb = 1024)
            // {
            //     $image_size = 1024 * $size_in_kb;
            //     $ext = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));

            //     if (!in_array($ext, ['jpeg', 'png', 'jpg'])) {
            //         // Handle invalid file type
            //         echo warning_alert('Please insert an image of type: JPEG, PNG, JPG');
            //         redirect('student/exam');
            //         exit;
            //     }

            //     if ($image['size'] > $image_size) {
            //         // Handle large file size
            //         echo warning_alert('Your image size exceeds ' . $size_in_kb . ' Kb. Please insert an image less than ' . $size_in_kb . ' Kb');
            //         redirect('student/exam');
            //         exit;
            //     }

            //     $dir = $destination . "/";
            //     if (!is_dir($dir)) {
            //         // Attempt to create directory if it doesn't exist
            //         if (!mkdir($dir, 0777, true)) {
            //             // Directory creation failed, handle the error
            //             echo 'Failed to create directory: ' . $dir;
            //             return false;
            //         }
            //     }

            //     $image_name = date('Ymdhis') . $image['name'];

            //     if (move_uploaded_file($image['tmp_name'], $dir . $image_name)) {
            //         // File uploaded successfully
            //         return $dir . $image_name; // Return the path to the uploaded file
            //     } else {
            //         // File upload failed, handle the error
            //         echo 'Failed to move file: ' . $image['name'];
            //         return false;
            //     }
            // }


            // // uploading the student signature into file
            // file_upload1($_FILES["passport_photo"], $image_dir);
            // // uploading student profile picture for admit card 
            // file_upload1($_FILES["candidate_signature"], $sign_dir);



            // $student['candidate_signature'] = $candidate_signature_rand;
            // $student['passport_photo'] = $passport_photo_rand;

            // inseting the all data of the student into the database
            $success_result = insertAll('tbl_back_examination_form', $student);

            if ($success_result != "success") {
                // if insertion is not possible then updating the data of the student
                $success_result = updateAll('tbl_back_examination_form', $student, '`admission_id`=' . $student['admission_id'] . ' && `semester_id`=' . $student['semester_id'] . '');
            }


            if ($success_result == "success") {
                $msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success</strong> Your Data Successfully Added into the Database
      
      </div>';
                $_SESSION['exam'] = $student;
                echo "<script>
        setTimeout(function() {
          window.location.replace(window.location.href);
          }, 1000);
    
    </script>";
            } else {
                $msg = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Alert!</strong>  ' . $con->error . '
      </div>';
            }
        }

        ?>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-10">
                            <h1>EXAMINATION FORM - For University Campus Programme</h1>
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
            <section class="content">
                <div class="container-fluid">
                    <!-- <?= $msg ?> -->
                    <!-- SELECT2 EXAMPLE -->
                    <div class="card card-default">
                        <?php





                        $row = $_SESSION['user'];
                        $course_id = $row['admission_course_name'];
                        $sql_course = "SELECT * FROM `tbl_course` WHERE `course_id` = $course_id;";
                        $result_course = $con->query($sql_course);
                        $row_course = $result_course->fetch_assoc();

                        $sql = "SELECT * FROM `tbl_university_details`
		      	WHERE `status` = '$visible' && university_details_id = '" . $row["admission_session"] . "'
		      	ORDER BY `university_details_id` DESC
		      	";
                        $result = $con->query($sql);
                        $rows = $result->fetch_assoc();
                        $academic_yearId = $rows["university_details_id"];

                        $completeSessionStart = explode("-", $rows["university_details_academic_start_date"]);
                        $completeSessionEnd = explode("-", $rows["university_details_academic_end_date"]);
                        $completeSessionOnlyYear = $completeSessionStart[0] . "-" . $completeSessionEnd[0];
                        //echo $completeSessionOnlyYear; 



                        // echo $row["admission_session"];
                        ?>
                        <form id="payment_form" method="post" action="easebuzz/exam.php?api_name=initiate_payment">
                            <input type="hidden" name="paymode" value="9" />
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12" id="error_section"></div>
                                    <div class="col-4">
                                        <label>Transaction ID</label>
                                        <input id="txnid" class="form-control rounded-pill" name="txnid"
                                            value="<?= $_SESSION['txn_no'] = rand(100000000000, 990999999999) ?>"
                                            class="form-control rounded-pill" placeholder="" readonly>
                                    </div>

                                    <div class="col-4">
                                        <label>Exam Fee</label>
                                        <input class="form-control rounded-pill" id="amount" name="amount"
                                            value="<?php echo $_SESSION["amount"]; ?>.0" readonly>
                                        <small class="form-text color-orange">Please Pay this amount For submit this
                                            Form.</small>
                                    </div>

                                    <div class="col-4">
                                        <label>Name</label>
                                        <input id="firstname" class="form-control rounded-pill" name="firstname"
                                            value="<?php echo $_SESSION['exam']["candidate_name"]; ?>" placeholder=""
                                            readonly>
                                    </div>

                                    <div class="col-4">
                                        <label>Father Name</label>
                                        <input id="firstname" class="form-control rounded-pill" name="udf1"
                                            value="<?php echo $_SESSION['exam']["father_name"]; ?>" placeholder=""
                                            readonly>
                                    </div>


                                    <div class="col-4">
                                        <label>Course</label>
                                        <input id="course" class="form-control rounded-pill" name="udf2"
                                            value="<?php echo $row_course["course_name"]; ?>" placeholder="" readonly>
                                        <?php $_SESSION['exam']["course_name"] = $row_course["course_name"]; ?>
                                    </div>




                                    <div class="col-4">
                                        <label>Session</label>
                                        <input id="session" class="form-control rounded-pill" name="udf3"
                                            value="<?php echo $completeSessionOnlyYear; ?>" placeholder="" readonly>
                                    </div>


                                    <div class="col-4">
                                        <label>Email ID</label>
                                        <input id="email" class="form-control rounded-pill" name="email"
                                            value="<?php echo $_SESSION['exam']["email_id"]; ?>" placeholder=""
                                            readonly>
                                    </div>

                                    <div class="col-4">
                                        <label for="">Phone No</label>
                                        <input id="phone" class="form-control rounded-pill" name="phone"
                                            value="<?php echo $_SESSION['exam']["mobile_no1"]; ?>" placeholder=""
                                            readonly>
                                    </div>

                                    <div class="col-4">
                                        <label for="">Status</label>
                                        <input id="productinfo" class="form-control rounded-pill" name="productinfo"
                                            value="<?php echo "Exam Fee Amount"; ?>" placeholder="" readonly>

                                    </div></br></br></br></br>
                                    <div class="col-md-6">
                                        <button type="submit" type="submit" name="button" id="add_admission_button"
                                            class="btn btn-primary"><i class="fa fa-paper-plane"></i> Pay </button>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>

                </form>

        </div>
        </section>
        <!-- /.content -->
    </div>

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




    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', {
            'placeholder': 'dd/mm/yyyy'
        })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', {
            'placeholder': 'mm/dd/yyyy'
        })
        //Money Euro
        $('[data-mask]').inputmask()

        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
                format: 'MM/DD/YYYY hh:mm A'
            }
        })
        //Date range as a button
        $('#daterange-btn').daterangepicker({
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format(
                    'MMMM D, YYYY'))
            }
        )

        //Timepicker
        $('#timepicker').datetimepicker({
            format: 'LT'
        })

        //Bootstrap Duallistbox
        $('.duallistbox').bootstrapDualListbox()

        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        $('.my-colorpicker2').on('colorpickerChange', function(event) {
            $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
        });

        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });

    })
    </script>
    <script>
    $(document).ready(function() {
        $("#myModal").modal('show');
    });
    </script>

</body>

</html>