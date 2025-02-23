<?php
include "include/authentication.php";

if (isset($_POST['admission_id'])) {
    $admission_id = $_POST['admission_id'];

    // Sanitize the admission_id
    $admission_id = mysqli_real_escape_string($con, $admission_id);

    // Query to fetch payment details
    $query = "SELECT * FROM tbl_registration_form WHERE admission_id = '$admission_id'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the data
        $data = mysqli_fetch_assoc($result);

        // Check if the amount or easebuzzid is null
        if (empty($data['amount']) || empty($data['easebuzzid']) || empty($data['transactionid'])) {
            $message = "<div class='alert alert-warning'>You have not paid yet. Please complete the payment.</div>";
            $details = null;
        } else {
            // Fetch course name using course_id
            $course_id = $data['course_id'];
            $course_query = "SELECT course_name FROM tbl_course WHERE course_id = '$course_id'";
            $course_result = mysqli_query($con, $course_query);

            if ($course_result && mysqli_num_rows($course_result) > 0) {
                $course_data = mysqli_fetch_assoc($course_result);
                $data['course_name'] = $course_data['course_name']; // Add course name to details
            } else {
                $data['course_name'] = "Course Not Found"; // Default if course not found
            }

            $message = null;
            $details = $data; // Store details in a variable
        }
    } else {
        $message = "<div class='alert alert-danger'>No record found for Admission ID: $admission_id</div>";
        $details = null;
    }
} else {
    $message = "<div class='alert alert-warning'>Invalid Request</div>";
    $details = null;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Payment Details</title>
    <style>
    body {

        margin: 30px;
        border: 10px double #8a0410;
    }

    .form-label {
        font-weight: 700;
        margin-bottom: .5rem;
    }

    /* Add custom styles for filled input fields */
    .form-control.filled {
        font-weight: 700;
        color: #8a0410;
        background-color: #f8f9fa;
        border-radius: 20px;
        border: 1px solid #dee2e6;
    }

    .migration-header {

        /* margin-top: 10px; */
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .migration-header h5 {
        font-weight: 600;
        font-size: 40px;
        font-family: 'PT Serif', serif;
        text-transform: uppercase;
        margin-top: 0 !important;
        margin-bottom: 0 !important;
        letter-spacing: 3px;
    }

    .migration_cum h3 {
        text-transform: uppercase;
        font-weight: 600;
        font-size: 19px;
        letter-spacing: 1px;
        margin-bottom: 0 !important;
    }

    .migration_cum p {
        font-size: 16px;
        font-weight: normal;
    }
    </style>
</head>

<body>

    <div class="container my-5">
        <?php
        if (isset($message)) {
            echo $message;
        }

        if (isset($details) && $details !== null) {
        ?>

        <div id="receipt-container">
            <div class="migration-header">
                <img src="images/logo.png" width="20%" class="" alt="">
                <h5 class='migration_head'>netaji subhas university</h5>
                <div class="lower-content">
                    <p
                        style="margin-bottom: 0 !important;font-size: 18px;letter-spacing: 6px;margin-top: 7px;border-bottom: 2px solid;">
                        <b>
                            JAMSHEDPUR</b>
                    </p>
                    <p style="margin-top: 7px;font-size: 13px;font-weight: 600;font-style: italic;margin-bottom: 0;">
                        Estd.
                        under Jharkhand
                        State
                        Private
                        University Act, 2018</p>
                </div>
                <div class='migration_cum'>
                    <h3 style="">Payment Recipt</h3>
                    <p style="margin:0;"><b>(For University Registration Form)</b></p>
                </div>
            </div>
            <hr>
            <div style="">
                <img style="background-size: cover;opacity: 0.2;filter: invert(0);position: fixed;width: 80%;"
                    class="img-fluid" src="images/logo.png" alt="">
            </div>
            <div class="row mb-3 mt-5">
                <div class="col-md-6">
                    <label for="amount" class="form-label">Student Name</label>
                    <input type="text" class="form-control filled" id="candidate_name"
                        value="<?= htmlspecialchars($details['candidate_name']); ?>" readonly>
                </div>
                <div class="col-md-6">
                    <label for="easebuzzid" class="form-label">Registration No.</label>
                    <input type="text" class="form-control filled" id="reg_no"
                        value="<?= htmlspecialchars($details['registration_no']); ?>" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="amount" class="form-label">Roll No.</label>
                    <input type="text" class="form-control filled" id="roll"
                        value="<?= htmlspecialchars($details['roll_no']); ?>" readonly>
                </div>
                <div class="col-md-6">
                    <label for="easebuzzid" class="form-label">Course</label>
                    <input type="text" class="form-control filled" id="course"
                        value="<?= htmlspecialchars($details['course_name']); ?>" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="transactionid" class="form-label">Amount</label>
                    <input type="text" class="form-control filled" id="amount"
                        value="<?= htmlspecialchars($details['amount']); ?>" readonly>
                </div>
                <div class="col-md-6">
                    <label for="candidate_name" class="form-label">Easebuzz ID</label>
                    <input type="text" class="form-control filled" id="easebuzzid"
                        value="<?= htmlspecialchars($details['easebuzzid']); ?>" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="transactionid" class="form-label">Transaction ID</label>
                    <input type="text" class="form-control filled" id="amount"
                        value="<?= htmlspecialchars($details['transactionid']); ?>" readonly>
                </div>
                <div class="col-md-6">
                    <label for="payment_date" class="form-label">Payment Date</label>
                    <input type="text" class="form-control filled" id="payment_date"
                        value="<?= htmlspecialchars(date("Y-m-d", strtotime($details['create_time']))); ?>" readonly>
                </div>

            </div>
        </div>
        <script type="text/javascript">
        window.onload = function() {
            window.print(); // Automatically trigger print dialog
        }
        </script>
        <?php
        }
        ?>
    </div>

    <!-- Include Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>