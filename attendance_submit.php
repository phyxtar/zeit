<?php
session_start(); 
include_once "framwork/main.php";
include_once "include/function.php";
include_once "include/config.php";
$message = ""; 
$redirectUrl = "makeattendance.php"; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_SESSION['teacher_id']) || !isset($_SESSION['teacher_grade_id'])) {
        die("Error: Session not initialized correctly.");
    }
    $attendance_date = $_POST['attendance_date'];
    $teacher_id = $_SESSION['teacher_id'];

    $absentStudents = []; 
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'attendance_status_') !== false) {
            $student_id = str_replace('attendance_status_', '', $key);
            $attendance_status = $value;
            $stmt = $con->prepare("INSERT INTO tbl_attendance (student_id, attendance_status, attendance_date, teacher_id, grade_id)
                                   VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("issii", $student_id, $attendance_status, $attendance_date, $teacher_id, $_SESSION['teacher_grade_id']);

            if ($stmt->execute()) {
                if ($attendance_status == 'Absent') {
                    $studentQuery = $con->query("SELECT * FROM tbl_students WHERE student_id = $student_id");

                    if ($studentQuery && $studentQuery->num_rows > 0) {
                        $student = $studentQuery->fetch_assoc();
                        $absentStudents[] = [
                            'name' => $student['student_name'],
                            'mobile' => $student['parent_mob_no_1']
                        ];
                    }
                }
            } else {
                $message = "Error: " . $stmt->error;
                break;
            }
        }
    }
    if (!empty($absentStudents)) {
        foreach ($absentStudents as $student) {
            $authKey = "6a4743a8355fb97aa42dc2452185a1cd";
            $senderId = "NSUJSR";
            $serverUrl = "http://msg.msgclub.net/rest/services/sendSMS/sendGroupSms";
            $mobileNos = $student['mobile'];
            $messageContent = "Dear Sir/Madam, Your ward {$student['name']} is ABSENT today Dated $attendance_date. Regards NSU, Jamshedpur";

            $url = $serverUrl . "?AUTH_KEY=" . urlencode($authKey) .
                "&message=" . urlencode($messageContent) .
                "&senderId=" . urlencode($senderId) .
                "&routeId=1" .
                "&mobileNos=" . urlencode($mobileNos);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
        }
        $message = "Attendance saved successfully, and SMS sent to absent students' guardians.";
    } else {
        $message = "Attendance saved successfully.";
    }
    header('location: amsattendance.php');
    exit;
}
?>
