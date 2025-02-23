<?php

include('config.php');
if ($_POST['add_admission_data'] == 'add_admission_data') {
    $visible = md5("visible");
    $date_variable_today_month_year_with_timing = date("d M, Y. h:i A");
    $admission_id = mysqli_real_escape_string($con, $_POST['add_admission_id']);
    $form_no = mysqli_real_escape_string($con, $_POST['add_admission_form_no']);
    $admission_no = mysqli_real_escape_string($con, $_POST['add_admission_no']);
    $title = mysqli_real_escape_string($con, $_POST['add_admission_title']);
    $first_name = mysqli_real_escape_string($con, $_POST['add_admission_first_name']);
    $middle_name = mysqli_real_escape_string($con, $_POST['add_admission_middle_name']);
    $last_name = mysqli_real_escape_string($con, $_POST['add_admission_last_name']);

    $course_name = mysqli_real_escape_string($con, $_POST['add_admission_course_name']);
    $admission_program_type = mysqli_real_escape_string($con, $_POST['add_admission_program_type']);
  
    $session = mysqli_real_escape_string($con, $_POST['add_admission_session']);
    $dob = mysqli_real_escape_string($con, $_POST['add_admission_dob']);
    $nationality = mysqli_real_escape_string($con, $_POST['add_admission_nationality']);
    $aadhar_no = mysqli_real_escape_string($con, $_POST['add_admission_aadhar_no']);
    $date_of_admission = mysqli_real_escape_string($con, $_POST['add_date_of_admission']);
    $religion = mysqli_real_escape_string($con, $_POST['add_admission_religion']);
    $category = mysqli_real_escape_string($con, $_POST['add_admission_category']);
    $gender = mysqli_real_escape_string($con, $_POST['add_admission_gender']);
    $username = mysqli_real_escape_string($con, $_POST['add_admission_username']);
    $password = md5(mysqli_real_escape_string($con, $_POST['add_admission_password']));
    $blood_group = mysqli_real_escape_string($con, $_POST['add_admission_blood_group']);
    $apaar_id = mysqli_real_escape_string($con, $_POST['apaar_id']);
    $hostel = mysqli_real_escape_string($con, $_POST['add_admission_hostel']);
    $hostel_join_date = mysqli_real_escape_string($con, $_POST['hostel_join_date']);
    $transport = mysqli_real_escape_string($con, $_POST['add_admission_transport']);
    $add_admission_father_name = mysqli_real_escape_string($con, $_POST['add_admission_father_name']);
    $add_admission_father_whatsappno = mysqli_real_escape_string($con, $_POST['add_admission_father_whatsappno']);
    $add_admission_mother_name = mysqli_real_escape_string($con, $_POST['add_admission_mother_name']);

    $add_admission_residential_address = mysqli_real_escape_string($con, $_POST['add_admission_residential_address']);
    $add_admission_state = mysqli_real_escape_string($con, $_POST['add_admission_state']);
    $add_admission_city = mysqli_real_escape_string($con, $_POST['add_admission_city']);
    $add_admission_district = mysqli_real_escape_string($con, $_POST['add_admission_district']);
    $add_admission_pin_code = mysqli_real_escape_string($con, $_POST['add_admission_pin_code']);
    $add_admission_home_landlineno = mysqli_real_escape_string($con, $_POST['add_admission_home_landlineno']);
    $add_admission_mobile_student = mysqli_real_escape_string($con, $_POST['add_admission_mobile_student']);
    $add_admission_father_phoneno = mysqli_real_escape_string($con, $_POST['add_admission_father_phoneno']);
    $add_admission_emailid_father = mysqli_real_escape_string($con, $_POST['add_admission_emailid_father']);
    $add_admission_emailid_student = mysqli_real_escape_string($con, $_POST['add_admission_emailid_student']);
    
    $profile_image = '';  
    if (isset($_FILES['add_admission_profile_image']) && $_FILES['add_admission_profile_image']['error'] == 0) {
        $imageData = $_FILES['add_admission_profile_image'];
        
        $fileExtension = pathinfo($imageData['name'], PATHINFO_EXTENSION);
        $filePath = 'uploads/' . uniqid() . '.' . $fileExtension;
        if (move_uploaded_file($imageData['tmp_name'], $filePath)) {
            $profile_image = $filePath;
        } else {
            echo "Error saving the profile image.";
            exit();
        }
    }
    

    $query = "INSERT INTO `tbl_admission`
    (`admission_id`, `admission_form_no`, `admission_no`, `admission_title`, `admission_first_name`, `admission_middle_name`, `admission_last_name`, `admission_course_name`, `admission_program_type`,`admission_session`, `admission_dob`, `admission_nationality`, `admission_aadhar_no`,`date_of_admission`,`admission_category`,`admission_gender`,`admission_username`,`admission_password`,`admission_blood_group`,`apaar_id`,`admission_hostel`,`admission_transport`,`admission_profile_image`,`admission_residential_address`,`admission_state`,`admission_city`,`admission_district`,`admission_pin_code`,`admission_home_landlineno`,`admission_mobile_student`,`admission_father_phoneno`,`admission_emailid_father`,`admission_emailid_student`,`admission_father_name`,`admission_father_whatsappno`,`admission_mother_name`,`admission_high_school_board_university`,`admission_high_school_college_name`,`admission_high_school_passing_year`,`admission_high_school_per`,`admission_high_school_subjects`,`admission_intermediate_board_university`,`admission_intermediate_college_name`,`admission_intermediate_passing_year`,`admission_intermediate_per`,`admission_intermediate_subjects`,`admission_graduation_board_university`,`admission_graduation_college_name`,`admission_graduation_passing_year`,`admission_graduation_per`,`admission_graduation_subjects`,`admission_post_graduation_board_university`,`admission_post_graduation_college_name`,`admission_post_graduation_others`,`admission_post_graduation_per`,`admission_post_graduation_subjects`,`admission_others_board_university`,`admission_others_college_name`,`admission_others_passing_year`,`admission_others_per`,`admission_others_subjects`,`admission_tenth_marksheet`,`admission_tenth_passing_certificate`,`admission_twelve_markesheet`,`admission_twelve_passing_certificate`,`admission_graduation_marksheet`,`admission_recent_character_certificate`,`admission_other_certificate`,`admission_character_certificate`,`admission_course1`,`admission_board_university1`,`admission_year_of_passing1`,`admission_percentage1`,`admission_course2`,`admission_board_university2`,`admission_year_of_passing2`,`admission_percentage2`,`admission_course3`,`admission_board_university3`,`admission_year_of_passing3`,`admission_percentage3`,`admission_course4`,`admission_board_university4`,`admission_year_of_passing4`,`admission_percentage4`,`admission_course5`,`admission_board_university5`,`admission_year_of_passing5`,`admission_percentage5`,`admission_name_of_org1`,`admission_designation1`,`admission_duration1`,`post_at`,`type`,`approval`,`transactionid`,`easebuzzid`, `status`,`hostel_join_date`) 
    VALUES 
    ('$admission_id','$form_no','$admission_no','$title','$first_name', '$middle_name', '$last_name', '$course_name','$admission_program_type','$session','$dob', '$nationality', '$aadhar_no','$date_of_admission','$category', '$gender', '$username', '$password', '$blood_group','$apaar_id', '$hostel','$transport','$profile_image','$add_admission_residential_address','$add_admission_state','$add_admission_city','$add_admission_district','$add_admission_pin_code','$add_admission_home_landlineno','$add_admission_mobile_student','$add_admission_father_phoneno','$add_admission_emailid_father','$add_admission_emailid_student','$add_admission_father_name','$add_admission_father_whatsappno','$add_admission_mother_name', 'NA', 'NA' , 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA','$date_variable_today_month_year_with_timing','','','','','$visible','$hostel_join_date')
    ";

    if (mysqli_query($con, $query)) {
        echo "Form submitted successfully!";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

if ($_POST['add_admission_data_2'] == 'add_admission_data_2') {
    $add_admission_id = $_POST['add_admission_id'];
    $high_school_board_university = $_POST['add_admission_high_school_board_university'];
    $high_school_college_name = $_POST['add_admission_high_school_college_name'];
    $high_school_passing_year = $_POST['add_admission_high_school_passing_year'];
    $high_school_per = $_POST['add_admission_high_school_per'];
    $high_school_subjects = $_POST['add_admission_high_school_subjects'];
    
    $intermediate_board_university = $_POST['add_admission_intermediate_board_university'];
    $intermediate_college_name = $_POST['add_admission_intermediate_college_name'];
    $intermediate_passing_year = $_POST['add_admission_intermediate_passing_year'];
    $intermediate_per = $_POST['add_admission_intermediate_per'];
    $intermediate_subjects = $_POST['add_admission_intermediate_subjects'];

    $graduation_board_university = $_POST['add_admission_graduation_board_university'];
    $graduation_college_name = $_POST['add_admission_graduation_college_name'];
    $graduation_passing_year = $_POST['add_admission_graduation_passing_year'];
    $graduation_per = $_POST['add_admission_graduation_per'];
    $graduation_subjects = $_POST['add_admission_graduation_subjects'];

    $post_graduation_board_university = $_POST['add_admission_post_graduation_board_university'];
    $post_graduation_college_name = $_POST['add_admission_post_graduation_college_name'];
    $post_graduation_others = $_POST['add_admission_post_graduation_others'];
    $post_graduation_per = $_POST['add_admission_post_graduation_per'];
    $post_graduation_subjects = $_POST['add_admission_post_graduation_subjects'];

    $others_board_university = $_POST['add_admission_others_board_university'];
    $others_college_name = $_POST['add_admission_others_college_name'];
    $others_passing_year = $_POST['add_admission_others_passing_year'];
    $others_per = $_POST['add_admission_others_per'];
    $others_subjects = $_POST['add_admission_others_subjects'];

    // Technical Qualifications
    $course1 = $_POST['add_admission_course1'];
    $board_university1 = $_POST['add_admission_board_university1'];
    $year_of_passing1 = $_POST['add_admission_year_of_passing1'];
    $percentage1 = $_POST['add_admission_percentage1'];
    
    $course2 = $_POST['add_admission_course2'];
    $board_university2 = $_POST['add_admission_board_university2'];
    $year_of_passing2 = $_POST['add_admission_year_of_passing2'];
    $percentage2 = $_POST['add_admission_percentage2'];
    
    $course3 = $_POST['add_admission_course3'];
    $board_university3 = $_POST['add_admission_board_university3'];
    $year_of_passing3 = $_POST['add_admission_year_of_passing3'];
    $percentage3 = $_POST['add_admission_percentage3'];

    $course4 = $_POST['add_admission_course4'];
    $board_university4 = $_POST['add_admission_board_university4'];
    $year_of_passing4 = $_POST['add_admission_year_of_passing4'];
    $percentage4 = $_POST['add_admission_percentage4'];
    
    $course5 = $_POST['add_admission_course5'];
    $board_university5 = $_POST['add_admission_board_university5'];
    $year_of_passing5 = $_POST['add_admission_year_of_passing5'];
    $percentage5 = $_POST['add_admission_percentage5'];

    // Work Experience
    $org1 = $_POST['add_admission_name_of_org1'];
    $designation1 = $_POST['add_admission_designation1'];
    $duration1 = $_POST['add_admission_duration1'];

    $sql = "UPDATE tbl_admission SET 
                admission_high_school_board_university = '$high_school_board_university', 
                admission_high_school_college_name = '$high_school_college_name', 
                admission_high_school_passing_year = '$high_school_passing_year', 
                admission_high_school_per = '$high_school_per', 
                admission_high_school_subjects = '$high_school_subjects', 
                admission_intermediate_board_university = '$intermediate_board_university', 
                admission_intermediate_college_name = '$intermediate_college_name', 
                admission_intermediate_passing_year = '$intermediate_passing_year', 
                admission_intermediate_per = '$intermediate_per', 
                admission_intermediate_subjects = '$intermediate_subjects', 
                admission_graduation_board_university = '$graduation_board_university', 
                admission_graduation_college_name = '$graduation_college_name', 
                admission_graduation_passing_year = '$graduation_passing_year', 
                admission_graduation_per = '$graduation_per', 
                admission_graduation_subjects = '$graduation_subjects', 
                admission_post_graduation_board_university = '$post_graduation_board_university', 
                admission_post_graduation_college_name = '$post_graduation_college_name', 
                admission_post_graduation_others = '$post_graduation_others', 
                admission_post_graduation_per = '$post_graduation_per', 
                admission_post_graduation_subjects = '$post_graduation_subjects', 
                admission_others_board_university = '$others_board_university', 
                admission_others_college_name = '$others_college_name', 
                admission_others_passing_year = '$others_passing_year', 
                admission_others_per = '$others_per', 
                admission_others_subjects = '$others_subjects', 
                admission_course1 = '$course1', 
                admission_board_university1 = '$board_university1', 
                admission_year_of_passing1 = '$year_of_passing1', 
                admission_percentage1 = '$percentage1', 
                admission_course2 = '$course2', 
                admission_board_university2 = '$board_university2', 
                admission_year_of_passing2 = '$year_of_passing2', 
                admission_percentage2 = '$percentage2', 
                admission_course3 = '$course3', 
                admission_board_university3 = '$board_university3', 
                admission_year_of_passing3 = '$year_of_passing3', 
                admission_percentage3 = '$percentage3', 
                admission_course4 = '$course4', 
                admission_board_university4 = '$board_university4', 
                admission_year_of_passing4 = '$year_of_passing4', 
                admission_percentage4 = '$percentage4', 
                admission_course5 = '$course5', 
                admission_board_university5 = '$board_university5', 
                admission_year_of_passing5 = '$year_of_passing5', 
                admission_percentage5 = '$percentage5', 
                admission_name_of_org1 = '$org1', 
                admission_designation1 = '$designation1', 
                admission_duration1 = '$duration1'
            WHERE admission_id = '$add_admission_id'";
    if ($con->query($sql) === TRUE) {
        echo "Data updated successfully!";
    } else {
        echo "Error updating record: " . $con->error;
    }
}

if ($_POST['add_admission_data_3'] == 'add_admission_data_3'){
    $admission_id = $_POST['add_admission_id'];
    $upload_dir = "uploads/";
    $file_paths = [];
    function generateRandomFileName($file_name) {
        $random_number = rand(100000000000, 999999999999); 
        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
        return $random_number . '.' . $file_extension;
    }
    $files = [
        'add_admission_tenth_marksheet',
        'add_admission_tenth_passing_certificate',
        'add_admission_twelve_marksheet',
        'add_admission_twelve_passing_certificate',
        'add_admission_graduation_marksheet',
        'add_admission_recent_character_certificate',
        'add_admission_other_certificate',
        'add_admission_character_certificate'
    ];

    foreach ($files as $file_key) {
        if (!empty($_FILES[$file_key]['name'])) {
            $original_file_name = $_FILES[$file_key]['name'];
            $new_file_name = generateRandomFileName($original_file_name); 
            $file_path = $upload_dir . basename($new_file_name); 
            
            if (move_uploaded_file($_FILES[$file_key]['tmp_name'], $file_path)) {
                $file_paths[$file_key] = $file_path; 
            } else {
                $file_paths[$file_key] = ''; 
            }
        }
    }
    
    $query = "UPDATE tbl_admission SET 
              admission_tenth_marksheet = '" . (isset($file_paths['add_admission_tenth_marksheet']) ? $file_paths['add_admission_tenth_marksheet'] : '') . "',
              admission_tenth_passing_certificate = '" . (isset($file_paths['add_admission_tenth_passing_certificate']) ? $file_paths['add_admission_tenth_passing_certificate'] : '') . "',
              admission_twelve_markesheet = '" . (isset($file_paths['add_admission_twelve_marksheet']) ? $file_paths['add_admission_twelve_marksheet'] : '') . "',
              admission_twelve_passing_certificate = '" . (isset($file_paths['add_admission_twelve_passing_certificate']) ? $file_paths['add_admission_twelve_passing_certificate'] : '') . "',
              admission_graduation_marksheet = '" . (isset($file_paths['add_admission_graduation_marksheet']) ? $file_paths['add_admission_graduation_marksheet'] : '') . "',
              admission_recent_character_certificate = '" . (isset($file_paths['add_admission_recent_character_certificate']) ? $file_paths['add_admission_recent_character_certificate'] : '') . "',
              admission_other_certificate = '" . (isset($file_paths['add_admission_other_certificate']) ? $file_paths['add_admission_other_certificate'] : '') . "',
              admission_character_certificate = '" . (isset($file_paths['add_admission_character_certificate']) ? $file_paths['add_admission_character_certificate'] : '') . "'
              WHERE admission_id = $admission_id";

              
              if ($con->query($query)) {
                include "sms.php";
                $sql = "SELECT MAX(`admission_id`) as `admission_id` FROM `tbl_admission` WHERE 1 ";
                $result = $con->query($sql);
                $registrationNumber = $result->fetch_assoc()["admission_id"];
                admissionConfirmation($registrationNumber, $_POST['add_admission_password']);
                echo "<script>
                                    alert('Added successfully!!!');
                                    location.replace('../admission_form');
                                </script>";
            } else
                echo "<script>
                                    alert('Something went wrong please try again!!!');
                                    location.replace('../admission_form');
                                </script>";
            /*} else{
                            echo "<script>
                                        alert('Please fill out all required fields!!!');
                                        location.replace('../admission_form');
                                    </script>";
                        }*/
        

    mysqli_close($con);
}

?>