<?php

// creating the function for sending sms

// admission confirmation message
function student($id)
{
    include "config.php";
    $visible = md5("visible");
    $sql_course = "SELECT * FROM `tbl_admission`
    WHERE `status` = '$visible' && `admission_id` = '$id';
    ";
    $result_course = $con->query($sql_course);
    return $result_course->fetch_assoc();
}

function getCourse($id)
{
    include "config.php";
    $visible = md5("visible");
    $sql_course = "SELECT * FROM `tbl_course`
    WHERE `status` = '$visible' && `course_id` = '$id';
    ";
    $result_course = $con->query($sql_course);
    return $result_course->fetch_assoc()['course_name'];
}

function getSession($id)
{
    include "config.php";
    $visible = md5("visible");
    $sql_course = "SELECT * FROM `tbl_university_details`
    WHERE `status` = '$visible' && `university_details_id` = '$id';
    ";
    $result_course = $con->query($sql_course);
    $data = $result_course->fetch_assoc();
    $session = date('Y', strtotime($data['university_details_academic_start_date'])) . "-" . date('Y', strtotime($data['university_details_academic_end_date']));
    return $session;
}

// don't touch into the method only pass the student registration number sms will autometically sent to the student
function admissionConfirmation($student_id,$password)
{
    $student = student($student_id);
    $name = $student["admission_first_name"] . " " . $student["admission_middle_name"] . $student["admission_last_name"];
    $course = getCourse($student['admission_course_name']);
    $reg_no = $student['admission_id'];
    $session = getSession($student['admission_session']);
    $phone = $student['admission_mobile_student'];
    $link="bit.ly/3oTkC1T";
    $message="Dear $name, Admission for course $course, Session $session has been successfully processed. Your Registration No. is $reg_no & password - $password. Please reset password using the below link. $link Regards, Netaji Subhas University, Jamshedpur";
    // $message = "Dear " . $name . " Your Admission Form for " . $course . " Session " . $session . " Has been successfully Processed. Sit back for the Next procedure. Regards, Netaji Subhas University, JSR";
    apiCall($message, $phone);
}


// don't touch into the method only pass the student registration number sms will autometically sent to the student
function feePayment($student_id, $amount)
{
    $amount=str_replace(',','',$amount);
    $student = student($student_id);
    $name = $student["admission_first_name"] . " " . $student["admission_middle_name"] . $student["admission_last_name"];
    $course = getCourse($student['admission_course_name']);
    $session = getSession($student['admission_session']);
    $phone = $student['admission_mobile_student'];

    $message = "Dear " . $name . ",Your fee payment for " . $course . " session " . $session . " of Rs " . $amount . " has been successfully done. Regards, Netaji Subhas University, JSR";
  //  apiCall($message, $phone);
}

// for every kind of otp send
function otp($phone)
{
    $otp = rand(111111, 999999);
    $message = "Your OTP is " . $otp . " Please do not share this OTP to anyone. Regards, Netaji Subhas University, JSR";
    apiCall($message, $phone);
    return $otp;
}

// for enquiry purpose
function enquiry($phone, $name, $course, $session)
{
    
    $message = "Dear" . $name . ", Thankyou for enquiring about " . $course . " for the " . $session . " We would get back to you shortly. Regards, Netaji Subhas University, JSR";
    apiCall($message, $phone);
}

function apiCall($message, $phone)
{
    $senderId = "NSUJSR";
    $serverUrl = "msg.msgclub.net";
    $authKey = "6a4743a8355fb97aa42dc2452185a1cd";
    $routeId = "1";
    $postData = array(
        'mobileNumbers' => $phone,
        'smsContent' => $message,
        'senderId' => $senderId,
        'routeId' => $routeId,
        "smsContentType" => 'english'
    );
    $data_json = json_encode($postData);
    $url = "http://" . $serverUrl . "/rest/services/sendSMS/sendGroupSms?AUTH_KEY=" . $authKey;
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_HTTPHEADER => array('Content-Type: application/json', 'Content-Length: ' . strlen($data_json)),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $data_json,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0
    ));
    curl_exec($ch);
}
