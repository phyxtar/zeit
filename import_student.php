<?php
$page_no = "18";
$page_no_inside = "18_2";
include_once "include/authentication.php";
if (isset($_FILES['csv_file']['name'])) {
    // Check if a file is uploaded
    $filename = $_FILES['csv_file']['tmp_name'];
    
    if ($_FILES['csv_file']['size'] > 0) {
        // Open the CSV file
        $file = fopen($filename, 'r');
        
        // Skip the first row if it's a header
        fgetcsv($file);
        
        // Loop through CSV rows and insert data into the database
        while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
            // Sanitize input to prevent SQL injection
            $student_name = mysqli_real_escape_string($con, $data[1]);
            $student_roll_number = mysqli_real_escape_string($con, $data[2]);
            $parent_mob_no_1 = mysqli_real_escape_string($con, $data[3]);
            $parent_mob_no_2 = mysqli_real_escape_string($con, $data[4]);
            $student_dob = mysqli_real_escape_string($con, $data[5]);
            $student_grade_id = mysqli_real_escape_string($con, $data[6]);

            // Insert the data into the database
            $sql = "INSERT INTO tbl_students (student_name, student_roll_number, parent_mob_no_1, parent_mob_no_2, student_dob, student_grade_id) 
                    VALUES ('$student_name', '$student_roll_number', '$parent_mob_no_1', '$parent_mob_no_2', '$student_dob', '$student_grade_id')";
            
            if (mysqli_query($con, $sql)) {
                echo "Student data uploaded successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
        }

        fclose($file);  // Close the CSV file
    }
}


?>