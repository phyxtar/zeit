<?php
if (empty(session_start()))
    session_start();
include "config.php";
include_once "../../framwork/main.php";
// Setting Time Zone in India Standard Timing
$random_number = rand(111111, 999999); // Random Number
$visible = md5("visible");
$trash = md5("trash");
date_default_timezone_set("Asia/Calcutta");
$date_variable_today_month_year_with_timing = date("d M, Y. h:i A");
//All File Directries Start
$university_logos_dir = "../images/university_logos";
$admission_profile_image_dir = "../images/student_images";
$certificates = "../images/student_certificates";
//All File Directries End
if (isset($_POST["action"])) {
    //Action Section Start
    /* ---------- All Admin(Backend) Codes Start ---------- */
    //Login Section Start With Ajax
    if ($_POST["action"] == "student_login") {
        $student_login_username = user_name($_POST["student_login_username"]);
        $student_login_password = password_check($_POST["student_login_password"]);
        if (!$student_login_username) {
            echo '
            <div class="alert alert-danger alert-dismissible">
                <i class="icon fas fa-ban"></i> Please Enter valid Username
            </div>';
        } elseif (!$student_login_password) {
            echo '
            <div class="alert alert-danger alert-dismissible">
                <i class="icon fas fa-ban"></i> Password must 0-9,a-z ,A-Z ,[!@#$%^&*-] minimum 8 character 
            </div>';
        } else if (!empty($student_login_username && $student_login_password)) {

            $sql = "SELECT * FROM `tbl_admission`
                        WHERE `admission_username` = '$student_login_username' && `admission_password` = '$student_login_password'
                        ";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                //$_SESSION["logger_type1"] = "student";
                $_SESSION["logger_username1"] = $student_login_username;
                $_SESSION["logger_password1"] = $student_login_password;
                // $_SESSION["logger_admission"] = $_SESSION['user']['admission_id'];
                $_SESSION['user'] = mysqli_fetch_assoc($result);
                $_SESSION["logger_time1"] = time();
                echo '
                        <div class="alert alert-success alert-dismissible">
                            <i class="icon fas fa-check"></i> You have logged in Successfully!!!
                        </div>';
                echo "<script> location.replace('dashboard') </script>";
            } else
                echo '
                        <div class="alert alert-danger alert-dismissible">
                            <i class="icon fas fa-ban"></i> Incorrect Credential, Please try again!!!
                        </div>';
        } else {
            echo '
                    <div class="alert alert-warning alert-dismissible">
                        <i class="icon fas fa-exclamation-triangle"></i>  Please fill out Username and Password!!!
                    </div>';
        }
    }
    //Login Section End With Ajax
    //Pay Fee Start
    if ($_POST["action"] == "pay_fees") {

        $registrationNumber = $_POST["registrationNumber"];
        $academicYear = $_POST["academicYear"];
        $courseId = $_POST["courseId"];
        $particular_paid_id = $_POST["particular_paid_id"];
        $particular_paid_amount = $_POST["particular_paid_amount"];
        $fine_amount = $_POST["fine_amount"];
        $rebate_amount = $_POST["rebate_amount"];
        $total_amount = $_POST["total_amount"];
        $remaining_amount = $_POST["remaining_amount"];
        $PaymentMode = $_POST["PaymentMode"];
        $cashDepositTo = $_POST["cashDepositTo"];
        $bankName = $_POST["bankName"];
        $chequeAndOthersNumber = $_POST["chequeAndOthersNumber"];
        $paidDate = $_POST["paidDate"];
        $paymentDate = $_POST["paymentDate"];
        $NotesByAdmin = $_POST["NotesByAdmin"];
        $FeeStatus = "cleared";
        if (!empty($registrationNumber && $academicYear && $courseId) && (count($particular_paid_id) != 0) && (count($particular_paid_amount) != 0) && !empty($total_amount)) {
            if (($PaymentMode != "0" && $cashDepositTo != "0") || ($PaymentMode != "0" && !empty($chequeAndOthersNumber))) {
                if ($fine_amount >= 0 && $rebate_amount >= 0 && $total_amount >= 0 && $remaining_amount >= 0) {




                    echo "success";
                } else
                    echo '<div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <i class="icon fas fa-ban"></i> Cannot calculate Fees with <b>Negative</b> values!!!
                              </div>';
            } else
                echo '<div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <i class="icon fas fa-exclamation-triangle"></i> Please Fill out Payment Details!!!
                          </div>';
        } else
            echo '<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <i class="icon fas fa-ban"></i> Please Fill Out Fee Amounts!!!
                      </div>';
    }
    //Pay Fee End
    //Add complaint Form Start
    if ($_POST["action"] == "add_complaint") {
        $admission_id = $_POST['admission_id'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        $sql = "INSERT INTO `tbl_complaint`
                            (`complaint_id`, `admission_id`,`subject`, `message`,`create_time` ,`status`) 
                            VALUES 
                            ('$complaint_id','$admission_id','$subject','$message','$date_variable_today_month_year_with_timing','$visible')
                            ";
        if ($con->query($sql)) {
            echo "<script>
                                alert('Added successfully!!!');
                                location.replace('../complaint');
                            </script>";
        } else
            echo "<script>
                                alert('Something went wrong please try again!!!');
                                location.replace('../complaint');
                            </script>";
    }


    //Add std placement form  Start With Ajax
    if ($_POST["action"] == "std_placement_form") {

        $msg = '';
        $company_id = $_POST["company_id"];
        $std_first = $_POST["std_first_name"];
        $std_last = $_POST["std_last_name"];
        $std_name =  $std_first . " " . $std_last;
        //  $semester = str_replace("'", "&#39;", $_POST["semester"]);
        $company_name = str_replace("'", "&#39;", $_POST["company_name"]);
        // $exam_fine = str_replace("'", "&#39;", $_POST["exam_fine"]);
        // $exam_fee_last_date = $_POST["exam_fee_last_date"];
        $job_type = $_POST["job_type"];
        // $examname = str_replace("'", "&#39;", $_POST["examname"]);
        $std_session = $_POST["std_session"];
        $std_course = $_POST["std_course"];
        $student_id = $_POST["student_id"];


        if (!empty($student_id)) {
            // $allSemester = count($semester);


            $allExamname = count($company_name);
            // if ($course_id == "all") {
            //     for ($i = 0; $i < $allExamname; $i++) {
            //         $sql = "INSERT INTO `tbl_placement`
            //                     (`id`, `course_id`, `academic_year`,`company_name`,`migrationfee_status`, `examname`, `add_time`, `status`,`form_start_date`) 
            //                     VALUES 
            //                     (NULL,'all','all','$company_name[$i]','$migrationfee_status[$i]','$examname[$i]','$date_variable_today_month_year_with_timing','$visible','$form_start_date');
            //                     ";
            //     }
            //     if ($con->query($sql))
            //         echo 'success';
            //     else
            //         echo 'error';
            // } else {

            $sql = "";
            for ($i = 0; $i < $allExamname; $i++) {
                // $sql_check = "SELECT * FROM `tbl_placement`
                //                  WHERE `status` = '$visible' && `course_id` = '$course_id' && `academic_year` = '$academic_year';
                //                  ";
                // $result = $con->query($sql_check);
                // if ($result->num_rows > 0) {
                //     $row = $result->fetch_assoc();
                //     $sql .= "UPDATE `tbl_placement` 
                //                 SET `examname`='$examname[$i]',`add_time`='$date_variable_today_month_year_with_timing'
                //                 WHERE `status` = '$visible' && `course_id` = '$course_id' && `academic_year` = '$academic_year';
                //                 ";
                // } else {

                // echo 'ahi';
                // exit;

                $sql_check = "SELECT * FROM `tbl_placement_applied`
                                     WHERE `status` = '$visible' && `student_id` = '$student_id' ;
                                     ";
                $result = $con->query($sql_check);

                if ($result->num_rows > 0) {
                    $msg = 'already';
                    // echo 'You already apllied for placement';
                } else {
                    $sql .= "INSERT INTO `tbl_placement_applied`
                                    (`id`,`company_name`,`student_id`,`std_name`,`std_session`,`std_course`,`others`,`add_time`, `status`,`job_type`) 
                                    VALUES 
                                    (NULL,'$company_id','$student_id','$std_name','$std_session','$std_course','$company_name[$i]','$date_variable_today_month_year_with_timing','$visible','$job_type[$i]');
                                    ";
                    $con->multi_query($sql);
                    $msg = 'success';
                }
            }
        }


        if ($msg != '')
            echo $msg;

        else {
            echo 'error';
        }
    } else
        echo 'empty';
}
