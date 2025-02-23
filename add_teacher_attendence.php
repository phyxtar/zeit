<?php
include "include/config.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
    $selected_month = date('Y-m', strtotime($_POST['selected_month']));
    $teacher_data = json_decode($_POST['teacher_data'], true);
    $added_by = $_SESSION["logger_username"];
    $added_date = date('Y-m-d H:i:s');
    $teacher_id = $teacher_data['teacher_id'];
    $attendance = $teacher_data['attendance'];

    $total_days = (new DateTime($selected_month . '-01'))->format('t');
    $total_present = 0;
    $total_absent = 0;
    $working_days = 0;

    $holiday_sql = "SELECT * FROM `tbl_holiday`";
    $holiday_result = $con->query($holiday_sql);
    $holidays = [];
    while ($holiday_row = $holiday_result->fetch_assoc()) {
        $holidays[] = $holiday_row;
    }

    foreach ($attendance as $key => $status) {
        preg_match('/day(\d+)/', $key, $matches);
        $day = $matches[1];
        $date = new DateTime("$selected_month-$day");

        $is_sunday = $date->format('N') == 7;
        $is_holiday = false;
        foreach ($holidays as $holiday) {
            $holiday_start = new DateTime($holiday['h_date_from']);
            $holiday_end = new DateTime($holiday['h_date_to']);
            if ($date >= $holiday_start && $date <= $holiday_end) {
                $is_holiday = true;
                break;
            }
        }

        if (!$is_sunday && !$is_holiday) {
            $working_days++;
        }

        if ($status == 'present') {
            $total_present++;
        } elseif ($status == 'absent') {
            $total_absent++;
        }
    }

    $dates_json = json_encode(array_keys($attendance));
    $statuses_json = json_encode(array_values($attendance));

    $check_sql = "SELECT * FROM tbl_teacher_attendence WHERE staff_id = ? AND month = ?";
    $stmt = $con->prepare($check_sql);
    $stmt->bind_param('is', $teacher_id, $selected_month);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $sql = "UPDATE tbl_teacher_attendence SET date = ?, status = ?, added_by = ?, added_date = ?, total_days = ?, working_days = ?, total_present = ?, total_absent = ? WHERE staff_id = ? AND month = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('ssssiiiiis', $dates_json, $statuses_json, $added_by, $added_date, $total_days, $working_days, $total_present, $total_absent, $teacher_id, $selected_month);
    } else {
        $sql = "INSERT INTO tbl_teacher_attendence (staff_id, month, date, status, added_by, added_date, total_days, working_days, total_present, total_absent) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('isssssiiii', $teacher_id, $selected_month, $dates_json, $statuses_json, $added_by, $added_date, $total_days, $working_days, $total_present, $total_absent);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Attendance submitted successfully!'); window.location.href='emplyee_attendence.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
}
?>
