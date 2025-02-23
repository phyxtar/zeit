<?php
if ($_SERVER['HTTP_HOST'] == 'localhost') {
    $con = new mysqli("localhost", "root", "", "zeit");
} else {
    $con = new mysqli("localhost", "usernsucms_cms", "Nsuraja83013@#", "nsucms_cms");
}
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
if ($_POST["action"] == "edit_reg_form") {
   $edit_reg_id = $_POST["edit_reg_id"];
   
    $edit_candidate_name = $_POST["edit_candidate_name"];
    $edit_candidate_roll = $_POST["edit_candidate_roll"];
    $edit_candidate_reg = $_POST["edit_candidate_reg"];
    $edit_father_name = $_POST["edit_father_name"];
    $edit_mother_name = $_POST["edit_mother_name"];
    $edit_abc_id = $_POST["edit_abc_id"];
    $edit_dob = $_POST["edit_dob"];
    $edit_amount = $_POST["edit_amount"];
    $edit_transactionid = $_POST["edit_transactionid"];
    $edit_easebuzzid = $_POST["edit_easebuzzid"];

    $sql = "UPDATE `tbl_registration_form` 
            SET 
            `candidate_name` = '$edit_candidate_name', `roll_no` = '$edit_candidate_roll' , `registration_no` = '$edit_candidate_reg', `father_name` = '$edit_father_name', `mother_name` = '$edit_mother_name',`abc_id` = '$edit_abc_id',`dob` = ' $edit_dob', `amount` = '$edit_amount', `transactionid` = '$edit_transactionid', `easebuzzid` = '$edit_easebuzzid' 
            WHERE `admission_id` = '$edit_reg_id'";
    if ($con->query($sql) === TRUE) {
        echo "<script>
                alert('Record updated successfully!');
                window.location.href = '../../registered_student.php'; 
              </script>";
    } else {
        echo "<script>
                alert('Error updating record: " . mysqli_error($con) . "');
                window.history.back(); 
              </script>";
    }
}
$con->close();
?>
