<?php
include 'include/authentication.php'; // Database connection

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=registration_data.csv');

$output = fopen("php://output", "w");

// Define column headers based on the fields from both tables
fputcsv($output, array(
    'registration_id', 'admission_id', 'course_id', 'course_name', 'academic_year', 'semester_id',
    'registration_no', 'roll_no', 'candidate_name', 'father_name', 'mother_name',
    'department', 'category', 'abc_id', 'matrial_status', 'blood',
    'residence_status', 'candidate_signature', 'passport_photo', 'gender', 'dob',
    'email_id', 'mobile_no1', 'mobile_no2', 'adhar_no', 'address',
    'amount', 'transactionid', 'easebuzzid', 'create_time', 'update_time',
    'status', 'guardian_name', 'guardian_relation', 'nationality',
    'religion', 'father_occu', 'mother_occu', 'father_edu', 'mother_edu',
    'texamination', 'tpassing_year', 'tschool_college', 'tboard_name', 'tmax_marks',
    'tmarks_obtained', 'tpercentage_grade', 'tmedium_instruction', 'tdiscipline',
    'twexamination', 'twpassing_year', 'twschool_college', 'twboard_name', 'twmax_marks',
    'twmarks_obtained', 'twpercentage_grade', 'twmedium_instruction', 'twdiscipline',
    'gexamination', 'gpassing_year', 'gschool_college', 'gboard_name', 'gmax_marks',
    'gmarks_obtained', 'gpercentage_grade', 'gmedium_instruction', 'gdiscipline',
    'postexamination', 'postpassing_year', 'postschool_college', 'postboard_name', 'postmax_marks',
    'postmarks_obtained', 'postpercentage_grade', 'postmedium_instruction', 'postdiscipline',
    'parnament_adr', 'parnament_dist', 'parnament_pin', 'parnament_state', 'parnament_country',
    'corr_adr', 'corr_dist', 'corr_pin', 'corr_state', 'corr_country',
    'swhatsapp', 'pmob', 'pwhatsapp', 'pmail',
    '10th_marksheet', '10th_certificate', '12th_marksheet', '12th_certificate',
    'bachelor_marksheet', 'bachelor_certificate', 'master_marksheet', 'master_certificate',
    'transfer_certificate', 'migration_certificate', 'adhar_card', 'fadhar_card',
    'caste_certificate', 'residential_certificate', 'reg_status'
));

// Fetch and output each row from the table, joining with `tbl_courses` to get the course name
$query = "
    SELECT 
        r.registration_id, r.admission_id, r.course_id, c.course_name, r.academic_year, r.semester_id,
        r.registration_no, r.roll_no, r.candidate_name, r.father_name, r.mother_name,
        r.department, r.category, r.abc_id, r.matrial_status, r.blood,
        r.residence_status, r.candidate_signature, r.passport_photo, r.gender, r.dob,
        r.email_id, r.mobile_no1, r.mobile_no2, r.adhar_no, r.address,
        r.amount, r.transactionid, r.easebuzzid, r.create_time, r.update_time,
        r.status, r.guardian_name, r.guardian_relation, r.nationality,
        r.religion, r.father_occu, r.mother_occu, r.father_edu, r.mother_edu,
        r.texamination, r.tpassing_year, r.tschool_college, r.tboard_name, r.tmax_marks,
        r.tmarks_obtained, r.tpercentage_grade, r.tmedium_instruction, r.tdiscipline,
        r.twexamination, r.twpassing_year, r.twschool_college, r.twboard_name, r.twmax_marks,
        r.twmarks_obtained, r.twpercentage_grade, r.twmedium_instruction, r.twdiscipline,
        r.gexamination, r.gpassing_year, r.gschool_college, r.gboard_name, r.gmax_marks,
        r.gmarks_obtained, r.gpercentage_grade, r.gmedium_instruction, r.gdiscipline,
        r.postexamination, r.postpassing_year, r.postschool_college, r.postboard_name, r.postmax_marks,
        r.postmarks_obtained, r.postpercentage_grade, r.postmedium_instruction, r.postdiscipline,
        r.parnament_adr, r.parnament_dist, r.parnament_pin, r.parnament_state, r.parnament_country,
        r.corr_adr, r.corr_dist, r.corr_pin, r.corr_state, r.corr_country,
        r.swhatsapp, r.pmob, r.pwhatsapp, r.pmail,
        r.10th_marksheet, r.10th_certificate, r.12th_marksheet, r.12th_certificate,
        r.bachelor_marksheet, r.bachelor_certificate, r.master_marksheet, r.master_certificate,
        r.transfer_certificate, r.migration_certificate, r.adhar_card, r.fadhar_card,
        r.caste_certificate, r.residential_certificate, r.reg_status
    FROM tbl_registration_form r
    LEFT JOIN tbl_course c ON r.course_id = c.course_id
";

$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, $row);
}

fclose($output);
exit();
?>