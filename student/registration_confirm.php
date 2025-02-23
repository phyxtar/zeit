<?php
$page_no = "10";
$page_no_inside = "10_1";
include "include/authentication.php";
include "include/config.php";
error_reporting(E_ALL);
$visible = md5("visible");
$msg = '';
$random_number = rand(1111111111111, 9999999999999); // Random Number
$image_dir = "images/regstudent_images";
$sign_dir = "images/regstudent_sign";
$document10th_dir = "images/10th_marksheet";
$document10th1_dir = "images/10th_certificate";
$document12th_dir = "images/12th_marksheet";
$document12th1_dir = "images/12th_certificate";
$documentbachelor_dir = "images/bachelor_marksheet";
$documentbachelor1_dir = "images/bachelor_certificate";
$documentmaster_dir = "images/master_marksheet";
$documentmaster1_dir = "images/master_certificate";
$transfer_certificate_dir = "images/transfer_certificate";
$migration_certificate_dir = "images/migration_certificate";
$adhar_dir = "images/adhar_card";
// $fadhar_dir = "images/fadhar_card";
// $caste_dir = "images/caste";
// $residential_dir = "images/residential";

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NETAJI SUBHAS UNIVERSITY | Registration Form </title>
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
                        University Registration form submission.</p>
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
            // $student['registration_no'] = $_POST["registration_no"];
            // $student['roll_no'] = $_POST["roll_no"];
            $student['candidate_name'] = $_POST["candidate_name"];
            $student['father_name'] = $_POST["father_name"];
            $student['mother_name'] = $_POST["mother_name"];
            $student['gender'] = $_POST["gender"];
            $student['dob'] = $_POST["dob"];
            $student['email_id'] = $_POST["email_id"];
            $student['mobile_no1'] = $_POST["mobile_no1"];
            $student['mobile_no2'] = $_POST["mobile_no2"];
            $student['adhar_no'] = $_POST["adhar_no"];
            $student['address'] = $_POST["address"];
            $student['department'] = $_POST["department"];
            $student['category'] = $_POST["category"];
            $student['residence_status'] = $_POST["residence_status"];
            $student['blood'] = $_POST["blood"];
            $student['matrial_status'] = $_POST["matrial_status"];
            $student['abc_id'] = $_POST["abc_id"];
            $student['guardian_name'] = $_POST["guardian_name"];
            $student['guardian_relation'] = $_POST["guardian_relation"];
            $student['nationality'] = $_POST["nationality"];
            $student['religion'] = $_POST["religion"];
            $student['father_occu'] = $_POST["father_occu"];
            $student['mother_occu'] = $_POST["mother_occu"];
            $student['father_edu'] = $_POST["father_edu"];
            $student['mother_edu'] = $_POST["mother_edu"];

            $student['texamination'] = $_POST["texamination"];
            $student['tpassing_year'] = $_POST["tpassing_year"];
            $student['tschool_college'] = $_POST["tschool_college"];
            $student['tboard_name'] = $_POST["tboard_name"];
            $student['tmax_marks'] = $_POST["tmax_marks"];
            $student['tmarks_obtained'] = $_POST["tmarks_obtained"];
            $student['tpercentage_grade'] = $_POST["tpercentage_grade"];
            $student['tmedium_instruction'] = $_POST["tmedium_instruction"];
            $student['tdiscipline'] = $_POST["tdiscipline"];
            $student['twexamination'] = $_POST["twexamination"];
            $student['twpassing_year'] = $_POST["twpassing_year"];
            $student['twschool_college'] = $_POST["twschool_college"];
            $student['twboard_name'] = $_POST["twboard_name"];
            $student['twmax_marks'] = $_POST["twmax_marks"];
            $student['twmarks_obtained'] = $_POST["twmarks_obtained"];
            $student['twpercentage_grade'] = $_POST["twpercentage_grade"];
            $student['twmedium_instruction'] = $_POST["twmedium_instruction"];
            $student['twdiscipline'] = $_POST["twdiscipline"];
            $student['gexamination'] = $_POST["gexamination"];
            $student['gpassing_year'] = $_POST["gpassing_year"];
            $student['gschool_college'] = $_POST["gschool_college"];
            $student['gboard_name'] = $_POST["gboard_name"];
            $student['gmax_marks'] = $_POST["gmax_marks"];
            $student['gmarks_obtained'] = $_POST["gmarks_obtained"];
            $student['gpercentage_grade'] = $_POST["gpercentage_grade"];
            $student['gmedium_instruction'] = $_POST["gmedium_instruction"];
            $student['gdiscipline'] = $_POST["gdiscipline"];
            $student['postexamination'] = $_POST["postexamination"];
            $student['postpassing_year'] = $_POST["postpassing_year"];
            $student['postschool_college'] = $_POST["postschool_college"];
            $student['postboard_name'] = $_POST["postboard_name"];
            $student['postmax_marks'] = $_POST["postmax_marks"];
            $student['postmarks_obtained'] = $_POST["postmarks_obtained"];
            $student['postpercentage_grade'] = $_POST["postpercentage_grade"];
            $student['postmedium_instruction'] = $_POST["postmedium_instruction"];
            $student['postdiscipline'] = $_POST["postdiscipline"];

            $student['parnament_adr'] = $_POST["parnament_adr"];
            $student['parnament_dist'] = $_POST["parnament_dist"];
            $student['parnament_pin'] = $_POST["parnament_pin"];
            $student['parnament_state'] = $_POST["parnament_state"];
            $student['parnament_country'] = $_POST["parnament_country"];
            $student['corr_adr'] = $_POST["corr_adr"];
            $student['corr_dist'] = $_POST["corr_dist"];
            $student['corr_pin'] = $_POST["corr_pin"];
            $student['corr_state'] = $_POST["corr_state"];
            $student['corr_country'] = $_POST["corr_country"];

            $student['swhatsapp'] = $_POST["swhatsapp"];
            $student['pmob'] = $_POST["pmob"];
            $student['pwhatsapp'] = $_POST["pwhatsapp"];
            $student['pmail'] = $_POST["pmail"];

            $student['create_time'] = date('Y-m-d h:m:s');
            $student['status'] = $visible;
            $student['verified_by'] = "Not Verified";
            $student['reg_status'] = "Not Approved";
            $student['amount'] = 0;
            // $student['registration_no'] = 'Not';
            // $student['roll_no'] = 'Not ';
            // Your existing code to get the last registration number
            // Your existing code to get the last registration number
            $sql_last_reg = "SELECT `registration_no` FROM `tbl_registration_form` 
        WHERE `status` = '$visible' 
        AND `course_id` = '" . $_SESSION["course_id"] . "' 
        AND `academic_year` = '" . $_POST["academic_year"] . "' 
        ORDER BY `registration_no` DESC LIMIT 1";
            $last_reg_result = $con->query($sql_last_reg);
            $last_reg_row = $last_reg_result->fetch_assoc();

            $lastRegNo = $last_reg_row['registration_no'] ?? null;
            $lastNumber = $lastRegNo ? intval(substr($lastRegNo, -3)) : 0;

            $currentYear = date('y');

            // Fetching course code
            $course_id = $_SESSION["course_id"]; // Ensure the course ID is set
            $sql_course = "SELECT * FROM `tbl_course` WHERE `status` = '$visible' AND `course_id` = '$course_id'";
            $result_course = $con->query($sql_course);

            if ($result_course === FALSE) {
                echo "Error in SQL query: " . $con->error;
                exit;
            }

            $row_course = $result_course->fetch_assoc();
            if ($row_course) {
                $course_code = $row_course['course_code'];

                if (strlen($course_code) == 1 && is_numeric($course_code)) {
                    $course_code = '0' . $course_code; // Prefix if necessary
                }
            } else {
                echo "No course found for course_id: $course_id";
                exit;
            }

            do {
                $newNumber = $lastNumber + 1; // Increment the last number
                $newRegNo = 'NSU' . $currentYear . $course_code . sprintf('%03d', $newNumber); // Format new registration number
                $newRollNo = $currentYear . $course_code . sprintf('%03d', $newNumber); // Format new roll number

                // Check if the generated numbers already exist in the database
                $check_sql = "SELECT COUNT(*) FROM `tbl_registration_form` 
                      WHERE `registration_no` = '$newRegNo' OR `roll_no` = '$newRollNo'";
                $check_result = $con->query($check_sql);
                $check_count = $check_result->fetch_row()[0];

                // If a duplicate exists, increment the number for the next iteration
                $lastNumber++;
            } while ($check_count > 0); // Repeat until a unique number is found

            // Now you can use $newRegNo and $newRollNo for the registration and roll numbers
            $student['registration_no'] = $newRegNo;
            $student['roll_no'] = $newRollNo;



            $photos = fetchRow('tbl_registration_form', '`admission_id`=' . $student['admission_id'] . ' && `course_id`=' . $student['course_id'] . '');

            if ($photos['candidate_signature'] == '') {
                $candidate_signature_rand = date('Ymdhis') . $_FILES["candidate_signature"]["name"];
            } else {
                $candidate_signature_rand = $photos['candidate_signature_rand'];
            }

            if ($photos['passport_photo'] == '') {
                $passport_photo_rand = date('Ymdhis') . $_FILES["passport_photo"]["name"];
            } else {
                $passport_photo_rand = $photos['passport_photo'];
            }
            if ($photos['10th_marksheet'] == '') {
                $document10th_rand = date('Ymdhis') . $_FILES["10th_marksheet"]["name"];
            } else {
                $document10th_rand = $photos['10th_marksheet'];
            }
            if ($photos['10th_certificate'] == '') {
                $document10th1_rand = date('Ymdhis') . $_FILES["10th_certificate"]["name"];
            } else {
                $document10th1_rand = $photos['10th_certificate'];
            }
            if ($photos['12th_marksheet'] == '') {
                $document12th_rand = date('Ymdhis') . $_FILES["12th_marksheet"]["name"];
            } else {
                $document12th_rand = $photos['12th_marksheet'];
            }
            if ($photos['12th_certificate'] == '') {
                $document12th1_rand = date('Ymdhis') . $_FILES["12th_certificate"]["name"];
            } else {
                $document12th1_rand = $photos['12th_certificate'];
            }
            if ($photos['bachelor_marksheet'] == '') {
                $documentbachelor_rand = date('Ymdhis') . $_FILES["bachelor_marksheet"]["name"];
            } else {
                $documentbachelor_rand = $photos['bachelor_marksheet'];
            }
            if ($photos['bachelor_certificate'] == '') {
                $documentbachelor1_rand = date('Ymdhis') . $_FILES["bachelor_certificate"]["name"];
            } else {
                $documentbachelor1_rand = $photos['bachelor_certificate'];
            }
            if ($photos['master_marksheet'] == '') {
                $documentmaster_rand = date('Ymdhis') . $_FILES["master_marksheet"]["name"];
            } else {
                $documentmaster_rand = $photos['master_marksheet'];
            }
            if ($photos['master_certificate'] == '') {
                $documentmaster1_rand = date('Ymdhis') . $_FILES["master_certificate"]["name"];
            } else {
                $documentmaster1_rand = $photos['master_certificate'];
            }
            if ($photos['transfer_certificate'] == '') {
                $transfer_certificate_rand = date('Ymdhis') . $_FILES["transfer_certificate"]["name"];
            } else {
                $transfer_certificate_rand = $photos['transfer_certificate'];
            }
            if ($photos['migration_certificate'] == '') {
                $migration_certificate_rand = date('Ymdhis') . $_FILES["migration_certificate"]["name"];
            } else {
                $migration_certificate_rand = $photos['migration_certificate'];
            }
            if ($photos['adhar_card'] == '') {
                $adhar_card_rand = date('Ymdhis') . $_FILES["adhar_card"]["name"];
            } else {
                $adhar_card_rand = $photos['adhar_card'];
            }
            // if ($photos['fadhar_card'] == '') {
            //     $fadhar_card_rand = date('Ymdhis') . $_FILES["fadhar_card"]["name"];
            // } else {
            //     $fadhar_card_rand = $photos['fadhar_card'];
            // }
            // if ($photos['caste_certificate'] == '') {
            //     $caste_rand = date('Ymdhis') . $_FILES["caste_certificate"]["name"];
            // } else {
            //     $caste_rand = $photos['caste_certificate'];
            // }
            // if ($photos['residential_certificate'] == '') {
            //     $residential_rand = date('Ymdhis') . $_FILES["residential_certificate"]["name"];
            // } else {
            //     $residential_rand = $photos['residential_certificate'];
            // }



            function file_upload1($image, $destination, $size_in_kb = 1024)
            {
                $image_size = 1024 * $size_in_kb;
                $ext = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));

                if (!in_array($ext, ['jpeg', 'png', 'jpg', 'pdf','jfif'])) {
                    // Handle invalid file type
                    echo warning_alert('Please insert an image of type: JPEG, PNG, JPG, JFIF');
                    redirect('student/registration_form');
                    exit;
                }

                if ($image['size'] > $image_size) {
                    // Handle large file size
                    echo warning_alert('Your image size exceeds ' . $size_in_kb . ' Kb. Please insert an image less than ' . $size_in_kb . ' Kb');
                    redirect('student/registration_form');
                    exit;
                }

                $dir = $destination . "/";
                if (!is_dir($dir)) {
                    // Attempt to create directory if it doesn't exist
                    if (!mkdir($dir, 0777, true)) {
                        // Directory creation failed, handle the error
                        echo 'Failed to create directory: ' . $dir;
                        return false;
                    }
                }

                $image_name = date('Ymdhis') . $image['name'];

                if (move_uploaded_file($image['tmp_name'], $dir . $image_name)) {
                    // File uploaded successfully
                    return $dir . $image_name; // Return the path to the uploaded file
                } else {
                    // File upload failed, handle the error
                    echo 'Failed to move file: ' . $image['name'];
                    return false;
                }
            }


            // Check and upload files, assigning NULL if not uploaded
            // Candidate Signature
            if (isset($_FILES["candidate_signature"]) && $_FILES["candidate_signature"]["error"] === UPLOAD_ERR_OK) {
                $candidate_signature_rand = file_upload1($_FILES["candidate_signature"], $sign_dir);
                $student['candidate_signature'] = basename($candidate_signature_rand); // Store only the filename
            } else {
                $student['candidate_signature'] = NULL; // Assign NULL if not uploaded
            }

            // Passport Photo
            if (isset($_FILES["passport_photo"]) && $_FILES["passport_photo"]["error"] === UPLOAD_ERR_OK) {
                $passport_photo_rand = file_upload1($_FILES["passport_photo"], $image_dir);
                $student['passport_photo'] = basename($passport_photo_rand); // Store only the filename
            } else {
                $student['passport_photo'] = NULL; // Assign NULL if not uploaded
            }

            // 10th Marksheet
            if (isset($_FILES["10th_marksheet"]) && $_FILES["10th_marksheet"]["error"] === UPLOAD_ERR_OK) {
                $document10th_rand = file_upload1($_FILES["10th_marksheet"], $document10th_dir);
                $student['10th_marksheet'] = basename($document10th_rand); // Store only the filename
            } else {
                $student['10th_marksheet'] = NULL; // Assign NULL if not uploaded
            }

            // 10th Certificate
            if (isset($_FILES["10th_certificate"]) && $_FILES["10th_certificate"]["error"] === UPLOAD_ERR_OK) {
                $document10th1_rand = file_upload1($_FILES["10th_certificate"], $document10th1_dir);
                $student['10th_certificate'] = basename($document10th1_rand); // Store only the filename
            } else {
                $student['10th_certificate'] = NULL; // Assign NULL if not uploaded
            }

            // 12th Marksheet
            if (isset($_FILES["12th_marksheet"]) && $_FILES["12th_marksheet"]["error"] === UPLOAD_ERR_OK) {
                $document12th_rand = file_upload1($_FILES["12th_marksheet"], $document12th_dir);
                $student['12th_marksheet'] = basename($document12th_rand); // Store only the filename
            } else {
                $student['12th_marksheet'] = NULL; // Assign NULL if not uploaded
            }

            // 12th Certificate
            if (isset($_FILES["12th_certificate"]) && $_FILES["12th_certificate"]["error"] === UPLOAD_ERR_OK) {
                $document12th1_rand = file_upload1($_FILES["12th_certificate"], $document12th1_dir);
                $student['12th_certificate'] = basename($document12th1_rand); // Store only the filename
            } else {
                $student['12th_certificate'] = NULL; // Assign NULL if not uploaded
            }

            // Bachelor Marksheet
            if (isset($_FILES["bachelor_marksheet"]) && $_FILES["bachelor_marksheet"]["error"] === UPLOAD_ERR_OK) {
                $documentbachelor_rand = file_upload1($_FILES["bachelor_marksheet"], $documentbachelor_dir);
                $student['bachelor_marksheet'] = basename($documentbachelor_rand); // Store only the filename
            } else {
                $student['bachelor_marksheet'] = NULL; // Assign NULL if not uploaded
            }

            // Bachelor Certificate
            if (isset($_FILES["bachelor_certificate"]) && $_FILES["bachelor_certificate"]["error"] === UPLOAD_ERR_OK) {
                $documentbachelor1_rand = file_upload1($_FILES["bachelor_certificate"], $documentbachelor1_dir);
                $student['bachelor_certificate'] = basename($documentbachelor1_rand); // Store only the filename
            } else {
                $student['bachelor_certificate'] = NULL; // Assign NULL if not uploaded
            }

            // Master Marksheet
            if (isset($_FILES["master_marksheet"]) && $_FILES["master_marksheet"]["error"] === UPLOAD_ERR_OK) {
                $documentmaster_rand = file_upload1($_FILES["master_marksheet"], $documentmaster_dir);
                $student['master_marksheet'] = basename($documentmaster_rand); // Store only the filename
            } else {
                $student['master_marksheet'] = NULL; // Assign NULL if not uploaded
            }

            // Master Certificate
            if (isset($_FILES["master_certificate"]) && $_FILES["master_certificate"]["error"] === UPLOAD_ERR_OK) {
                $documentmaster1_rand = file_upload1($_FILES["master_certificate"], $documentmaster1_dir);
                $student['master_certificate'] = basename($documentmaster1_rand); // Store only the filename
            } else {
                $student['master_certificate'] = NULL; // Assign NULL if not uploaded
            }

            // Transfer Certificate
            if (isset($_FILES["transfer_certificate"]) && $_FILES["transfer_certificate"]["error"] === UPLOAD_ERR_OK) {
                $transfer_certificate_rand = file_upload1($_FILES["transfer_certificate"], $transfer_certificate_dir);
                $student['transfer_certificate'] = basename($transfer_certificate_rand); // Store only the filename
            } else {
                $student['transfer_certificate'] = NULL; // Assign NULL if not uploaded
            }

            // Migration Certificate
            if (isset($_FILES["migration_certificate"]) && $_FILES["migration_certificate"]["error"] === UPLOAD_ERR_OK) {
                $migration_certificate_rand = file_upload1($_FILES["migration_certificate"], $migration_certificate_dir);
                $student['migration_certificate'] = basename($migration_certificate_rand); // Store only the filename
            } else {
                $student['migration_certificate'] = NULL; // Assign NULL if not uploaded
            }

            // Aadhar Card
            if (isset($_FILES["adhar_card"]) && $_FILES["adhar_card"]["error"] === UPLOAD_ERR_OK) {
                $adhar_card_rand = file_upload1($_FILES["adhar_card"], $adhar_dir);
                $student['adhar_card'] = basename($adhar_card_rand); // Store only the filename
            } else {
                $student['adhar_card'] = NULL; // Assign NULL if not uploaded
            }
            // // Father Aadhar Card
            // if (isset($_FILES["fadhar_card"]) && $_FILES["fadhar_card"]["error"] === UPLOAD_ERR_OK) {
            //     $fadhar_card_rand = file_upload1($_FILES["fadhar_card"], $fadhar_dir);
            //     $student['fadhar_card'] = basename($fadhar_card_rand); // Store only the filename
            // } else {
            //     $student['fadhar_card'] = NULL; // Assign NULL if not uploaded
            // }
            // if (isset($_FILES["caste_certificate"]) && $_FILES["caste_certificate"]["error"] === UPLOAD_ERR_OK) {
            //     $caste_rand = file_upload1($_FILES["caste_certificate"], $caste_dir);
            //     $student['caste_certificate'] = basename($caste_rand); // Store only the filename
            // } else {
            //     $student['caste_certificate'] = NULL; // Assign NULL if not uploaded
            // }
            // if (isset($_FILES["residential_certificate"]) && $_FILES["residential_certificate"]["error"] === UPLOAD_ERR_OK) {
            //     $residential_rand = file_upload1($_FILES["residential_certificate"], $residential_dir);
            //     $student['residential_certificate'] = basename($residential_rand); // Store only the filename
            // } else {
            //     $student['residential_certificate'] = NULL; // Assign NULL if not uploaded
            // }


            // print_r($student);

            // inseting the all data of the student into the database
            $success_result = insertAll('tbl_registration_form', $student);

            if ($success_result != "success") {
                // if insertion is not possible then updating the data of the student
                $success_result = updateAll('tbl_registration_form', $student, '`admission_id`=' . $student['admission_id'] . ' && `course_id`=' . $student['course_id'] . '');
            }


            if ($success_result == "success") {
                $msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success</strong> Your Data Successfully Added into the Database
      
      </div>';
                $_SESSION['registration'] = $student;
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
                            <h1>University Registration FORM - For University Campus Programme</h1>
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
                        // echo "<pre>";
                        // print_r($row);
                        // echo "</pre>";
                        ?>

                        <form id="payment_form" method="post"
                            action="easebuzz/registration.php?api_name=initiate_payment">
                            <input type="hidden" name="paymode" value="9" />
                            <div class="card-body">
                                <?php

                                ?>
                                <div class="row">
                                    <div class="col-md-12" id="error_section"></div>
                                    <div class="col-4">
                                        <label>Transaction ID</label>
                                        <input id="txnid" class="form-control rounded-pill" name="txnid"
                                            value="<?= $_SESSION['txn_no'] = rand(100000000000, 990999999999) ?>"
                                            class="form-control rounded-pill" placeholder="" readonly>
                                    </div>

                                    <div class="col-4">
                                        <label>Registration Fee</label>
                                        <input class="form-control rounded-pill" id="amount" name="amount"
                                            value="<?php echo $_SESSION["amount"]; ?>.0" readonly>
                                        <small class="form-text color-orange">Please Pay this amount For submit this
                                            Form.</small>
                                    </div>

                                    <div class="col-4">
                                        <label>Name</label>
                                        <input id="firstname" class="form-control rounded-pill" name="firstname"
                                            value="<?php echo $row["admission_first_name"] . " " . $row["admission_middle_name"] . " " . $row["admission_last_name"]; ?>"
                                            placeholder="" readonly>
                                        <?php $_SESSION['registration']["candidate_name"] = $row["admission_first_name"] . " " . $row["admission_middle_name"] . " " . $row["admission_last_name"]; ?>
                                    </div>

                                    <div class="col-4">
                                        <label>Father Name</label>
                                        <input id="firstname" class="form-control rounded-pill" name="udf1"
                                            value="<?php echo $row["admission_father_name"]; ?>" placeholder=""
                                            readonly>
                                        <?php $_SESSION['registration']["father_name"] = $row["admission_father_name"]; ?>
                                    </div>


                                    <div class="col-4">
                                        <label>Course</label>
                                        <input id="course" class="form-control rounded-pill" name="udf2"
                                            value="<?php echo $row_course["course_name"]; ?>" placeholder="" readonly>
                                        <?php $_SESSION['registration']["course_name"] = $row_course["course_name"]; ?>
                                    </div>

                                    <div class="col-4">
                                        <label>Session</label>
                                        <input id="session" class="form-control rounded-pill" name="udf3"
                                            value="<?php echo $completeSessionOnlyYear; ?>" placeholder="" readonly>
                                    </div>


                                    <div class="col-4">
                                        <label>Email ID</label>
                                        <input id="email" class="form-control rounded-pill" name="email"
                                            value="<?php echo $row["admission_emailid_student"]; ?>" placeholder=""
                                            readonly>
                                        <?php $_SESSION['registration']["email_id"] = $row["admission_emailid_student"]; ?>
                                    </div>

                                    <div class="col-4">
                                        <label for="">Phone No</label>
                                        <input id="phone" class="form-control rounded-pill" name="phone"
                                            value="<?php echo $row["admission_mobile_student"]; ?>" placeholder=""
                                            readonly>
                                        <?php $_SESSION['registration']["mobile_no1"] = $row["admission_mobile_student"]; ?>
                                    </div>

                                    <div class="col-4">
                                        <label for="">Status</label>
                                        <input id="productinfo" class="form-control rounded-pill" name="productinfo"
                                            value="<?php echo "Registration Fee Amount"; ?>" placeholder="" readonly>

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