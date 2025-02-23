<?php
include "include/authentication.php";

if (isset($_POST['admission_id'])) {
    $admission_id = $_POST['admission_id'];

    
    $admission_id = mysqli_real_escape_string($con, $admission_id);
    $query = "SELECT amount, easebuzzid, transactionid, candidate_name FROM tbl_registration_form WHERE admission_id = '$admission_id'";
    $result = mysqli_query($con, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        
        $data = mysqli_fetch_assoc($result);

        
        if (empty($data['amount']) || empty($data['easebuzzid']) || empty($data['transactionid'])) {
            echo "<div class='alert alert-warning'>You have not paid yet. Please check your payment details or we are unable to verify your payment, Please contact to Examination Department. </div>";
        } else {
            $candidate_name = htmlspecialchars($data['candidate_name']);
            echo "
            <p class='text-success'>Dear <b>$candidate_name</b>,</br> you have successfully paid your <b>UNIVERSITY REGISTRATION FORM</b>. You can download your payment receipt by clicking the button below.</p>
                <form action='download_receipt.php' method='POST'>
                    <input type='hidden' name='admission_id' value='$admission_id'>
                    <button type='submit' class='btn btn-success btn-sm'>Download Receipt</button>
                </form>
            ";
        }
    } else {
        
        echo "<div class='alert alert-danger'>No record found for Admission ID: $admission_id</div>";
    }
} else {
    
    echo "<div class='alert alert-warning'>Invalid Request</div>";
}
?>