<?php
include_once "../../include/config.php";
include_once "../../../framwork/main.php";
include_once "../../../include/sms.php";
$reg_no = $_POST["reg_no"];

if (isset($_POST['otp'])) {
    $otp = $_POST['otp'];
    $s_otp = $_SESSION['otp'];
    if ($otp == $s_otp && $reg_no==$_SESSION['user_reg_no']) {
        if ($reg_no != '') {
            if (!is_numeric($reg_no)) {
                echo warning_alert("Please Enter Valid Registration No");
            } else {
                $sql = "SELECT * FROM `tbl_admission`
                  WHERE `admission_id` = '$reg_no' ;
                  ";
                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                    $data = mysqli_fetch_assoc($result);
                    $_SESSION["user"] = $data;
                    $_SESSION["reg_no"] = $reg_no;
                    $_SESSION["logger_time1"] = time();

                    echo success_alert("You have logged in Successfully!!!");
                    redirect('student/payfee');
                } else
                    echo danger_alert("Incorrect Credential, Please try again!!!");
            }
        }
    } else {
        echo   "wrong";
    }
} else {
    if (!isset($_POST['otp'])) {
        if ($reg_no != '') {
            if (!is_numeric($reg_no)) {
                echo warning_alert("Please Enter Valid Registration No");
            } else {
                $sql = "SELECT * FROM `tbl_admission`
                  WHERE `admission_id` = '$reg_no' ;
                  ";
                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                    $data = mysqli_fetch_assoc($result);
                    $_SESSION['otp'] = otp($data['admission_mobile_student']);
                    $_SESSION['user_reg_no'] = $reg_no;
                    echo '
                <b> Enter OTP:</b><input type="text" id="opt" name="otp" class="form-control" placeholder="Enter 6 digit  valid OTP">
               <div class="text-center mt-2" >  <button name="pay" type="submit" id="student_pay_fees_button" class="btn btn-primary btn-block" > Validate </button> </div>';
                } else
                    echo danger_alert("Incorrect Credential, Please try again!!!");
            }
        } else {
            echo   warning_alert("Please fill out Username and Password!!!");
        }
    }
}
