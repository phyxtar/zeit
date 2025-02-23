<?php
error_reporting(0);
//Starting Session
if (empty(session_start()))
    session_start();
//DataBase Connectivity
include "config.php";
// error_reporting(0);
// Setting Time Zone in India Standard Timing
$random_number = rand(111111, 999999); // Random Number
$s_no = 1; //Serial Number
$visible = md5("visible");
$trash = md5("trash");
date_default_timezone_set("Asia/Calcutta");
$date_variable_today_month_year_with_timing = date("d M, Y. h:i A");
//All File Directries Start
$university_logos_dir = "../images/university_logos";
$admission_profile_image_dir = "images/student_images";
$certificates = "images/student_certificates";
//All File Directries End
if (isset($_GET["action"])) {
    //Action Section Start
    /* ---------- All Admin(Backend) View Codes Start ---------- */
    // student fee start
    // include 'views/s_payfee.php';
    //Student fee End
    //  fee Calculations Details start
    if ($_GET["action"] == "completeCalculationForFees") {
        $completeCalculationArray = array();
        $totalAmountArry = array();
        $totalPerticularArry = array();
        $completeCalculation = "";
        $paid_perticular_amount = 0;
        $remaining_perticular_amount = 0;
        $fine_perticular_amount = 0;
        $total_perticular_amount = 0;
        $total_paid_perticular_amount = 0;
        $total_remaining_perticular_amount = 0;
        $total_fine_perticular_amount = 0;
        $total_total_perticular_amount = 0;
        $particular_paid_amount = 0;
        $fine_amount = 0;
        $rebate_amount = 0;
        $total_amount = 0;
        $remaining_amount = 0;
        $last_fine = 0;
        $errorMessage = "";
        $registrationNumber = $_POST["registrationNumber"];
        $academicYear = $_POST["academicYear"];
        $courseId = $_POST["courseId"];
        $hostelCheck = $_POST["hostelCheck"];
        $paymentDate = $_POST["paymentDate"];
        $sql_paid = "SELECT * FROM `tbl_fee_paid`
                        WHERE `status` = '$visible' && `student_id` = '$registrationNumber' && `university_details_id` = '$academicYear'
                        ";
        $result_paid = $con->query($sql_paid);
        while ($row_paid = $result_paid->fetch_assoc()) {
            $last_balance = $row_paid["balance"];
            $last_fine = intval($row_paid["fine"]);
            $amountsPaid = explode(",", $row_paid["paid_amount"]);
            $totalPerticularArry = explode(",", $row_paid["particular_id"]);
            $totalAmountVal = 0;
            for ($i = 0; $i < count($amountsPaid); $i++) {
                if (!isset($totalAmountArry[$i]) && empty($totalAmountArry[$i]))
                    $totalAmountArry[$i] = 0;
                $totalAmountArry[$i] = $totalAmountArry[$i] + intval($amountsPaid[$i]);
            }
            if ($last_balance == 0)
                $submitClose = "";
        }
        $sql_fee = "SELECT * FROM `tbl_fee`
                        WHERE `status` = '$visible' && `course_id` = '$courseId' && `fee_academic_year` = '$academicYear'
                       ";
        $result_fee = $con->query($sql_fee);
        $sno = 0;
        $Idno = 0;
        $total_fees = 0;
        $total_paid = 0;
        $total_remaining = 0;
        $total_fine = 0;
        while ($row_fee = $result_fee->fetch_assoc()) {
            $fee_perticular = 0;
            if (strtolower($hostelCheck) == "yes") {
                $sno++;
                $total_fees = $total_fees + $row_fee["fee_amount"];
                $fine_perticular_amountArray[$Idno] = 0;
                $total_perticular_amountArray[$Idno] = 0;
                if (isset($totalAmountArry[$Idno])) {
                    $total_paid = $total_paid + $totalAmountArry[$Idno];
                    if ($totalAmountArry[$Idno] == $row_fee["fee_amount"]) {
                        $total_fine = $total_fine + 0;
                        $fee_perticular = 0;
                        $fine_perticular_amountArray[$Idno] = $fee_perticular;
                        $total_perticular_amountArray[$Idno] = $fee_perticular;
                    } else {
                        $beforeDate = date($row_fee["fee_lastdate"]);
                        if ($paymentDate > $beforeDate) {
                            if ($row_fee["fee_astatus"] == "Active") {
                                $numberOfDays = (strtotime($paymentDate) - strtotime($beforeDate)) / 60 / 60 / 24;
                                $total_fine = $total_fine + ($numberOfDays * intval($row_fee["fee_fine"]));
                                $fee_perticular = $fee_perticular + ($numberOfDays * intval($row_fee["fee_fine"]));
                                $fine_perticular_amountArray[$Idno] = $fee_perticular;
                            }
                        }
                        $total_perticular_amountArray[$Idno] = $row_fee["fee_amount"] + ($fee_perticular + $totalAmountArry[$Idno]);
                    }
                } else {
                    $beforeDate = date($row_fee["fee_lastdate"]);
                    if ($paymentDate > $beforeDate) {
                        if ($row_fee["fee_astatus"] == "Active") {
                            $numberOfDays = (strtotime($paymentDate) - strtotime($beforeDate)) / 60 / 60 / 24;
                            $total_fine = $total_fine + ($numberOfDays * intval($row_fee["fee_fine"]));
                            $fee_perticular = $fee_perticular + ($numberOfDays * intval($row_fee["fee_fine"]));
                            $fine_perticular_amountArray[$Idno] = $fee_perticular;
                        }
                    }
                    $total_perticular_amountArray[$Idno] = $fee_perticular + $row_fee["fee_amount"];
                }
                $Idno++;
            } else {
                if (strtolower($row_fee["fee_particulars"]) != "hostel fee") {
                    $sno++;
                    $total_fees = $total_fees + $row_fee["fee_amount"];
                    $fine_perticular_amountArray[$Idno] = 0;
                    if (isset($totalAmountArry[$Idno])) {
                        $total_paid = $total_paid + $totalAmountArry[$Idno];
                        if ($totalAmountArry[$Idno] == $row_fee["fee_amount"]) {
                            $total_fine = $total_fine + 0;
                            $fee_perticular = 0;
                            $fine_perticular_amountArray[$Idno] = $fee_perticular;
                            $total_perticular_amountArray[$Idno] = $fee_perticular;
                        } else {
                            $beforeDate = date($row_fee["fee_lastdate"]);
                            if ($paymentDate > $beforeDate) {
                                if ($row_fee["fee_astatus"] == "Active") {
                                    $numberOfDays = (strtotime($paymentDate) - strtotime($beforeDate)) / 60 / 60 / 24;
                                    $total_fine = $total_fine + ($numberOfDays * intval($row_fee["fee_fine"]));
                                    $fee_perticular = $numberOfDays * intval($row_fee["fee_fine"]);
                                    $fine_perticular_amountArray[$Idno] = $fee_perticular;
                                    $total_perticular_amountArray[$Idno] = $fee_perticular + $totalAmountArry[$Idno];
                                }
                            }
                            $total_perticular_amountArray[$Idno] = $row_fee["fee_amount"] + ($fee_perticular + $totalAmountArry[$Idno]);
                        }
                    } else {
                        $beforeDate = date($row_fee["fee_lastdate"]);
                        if ($paymentDate > $beforeDate) {
                            if ($row_fee["fee_astatus"] == "Active") {
                                $numberOfDays = (strtotime($paymentDate) - strtotime($beforeDate)) / 60 / 60 / 24;
                                $total_fine = $total_fine + ($numberOfDays * intval($row_fee["fee_fine"]));
                                $fee_perticular = $fee_perticular + ($numberOfDays * intval($row_fee["fee_fine"]));
                                $fine_perticular_amountArray[$Idno] = $fee_perticular;
                            }
                        }
                        $total_perticular_amountArray[$Idno] = $fee_perticular + $row_fee["fee_amount"];
                    }
                    $Idno++;
                }
            }
        }
        $total_remaining = $total_fine + ($total_fees - $total_paid);

        if (!empty($_POST["fine_amount"]))
            $fine_amount = $_POST["fine_amount"];
        if (!empty($_POST["rebate_amount"]))
            $rebate_amount = $_POST["rebate_amount"];
        for ($i = 0; $i < count($_POST["particular_paid_amount"]); $i++) {
            if (!empty($_POST["particular_paid_amount"][$i]))
                $total_amount = $total_amount + intval($_POST["particular_paid_amount"][$i]);
        }
        //Total Amount With Fee
        $total_amount = $total_amount + $fine_amount;
        //Total Amount With Rebate
        $total_amount = $total_amount - $rebate_amount;
        //Remaining Total
        $remaining_amount = $total_remaining - $total_amount;
        //Remaining Total Amount With Rebate
        $remaining_amount = $remaining_amount - $rebate_amount;
        //Fine Arrays
        $fine_perticular_amount = implode("|", $fine_perticular_amountArray);
        $total_perticular_amount = implode("|", $total_perticular_amountArray);
        //Set Negative Error
        if ($total_amount < 0 || $remaining_amount < 0 || $fine_perticular_amount < 0)
            $errorMessage .= " Connot Use Negative Values.";
        if ($total_amount > $total_remaining)
            $errorMessage .= " Your total amount Should be less than or equal to ~ $total_remaining.";
        //Complete Calculation
        $completeCalculationArray[] = $total_remaining;
        $completeCalculationArray[] = $total_amount;
        $completeCalculationArray[] = $remaining_amount;
        $completeCalculationArray[] = $fine_perticular_amount;
        $completeCalculationArray[] = $total_perticular_amount;
        $completeCalculationArray[] = $errorMessage;
        //Implode all the Calculations
        $completeCalculation = implode(",", $completeCalculationArray);
        echo $completeCalculation;
    }
    // fee Calculations Details End
    /* ------------------------------------------------ Fee Payment End ------------------------------------------------------- */

    // add exam form list
    if ($_GET["action"] == "fetch_exam_form") {

        $course_id = $_POST["course_id"];
        $academic_year = $_POST["academic_year"];
        $semester_id = $_POST["semester_id"];
        $amount = $_POST["amount"];
        $verified_by = $_POST["verified_by"];
        $subject_id = $_POST["subject_id"];

        $_SESSION["course_id"] = $course_id;
        $_SESSION["academic_year"] = $academic_year;
        $_SESSION["semester_id"] = $semester_id;
        $_SESSION["amount"] = $amount;
        $_SESSION["verified_by"] = $verified_by;

        $row = $_SESSION['user'];
        $admission_id = $row['admission_id'];

        $sql1 = "SELECT * FROM `tbl_allot_semester` WHERE `status` = '$visible' && `admission_id` = '$admission_id' && `course_id` = '" . $_SESSION["course_id"] . "' && `academic_year`= '$academic_year' && `semester_id`= '$semester_id'";
        $adresult = $con->query($sql1);
        $adrow = $adresult->fetch_assoc();

        $sql2 = "SELECT * FROM `tbl_examination_form` WHERE `status` = '$visible' && `course_id` = '" . $_SESSION["course_id"] . "' && `admission_id` = '$admission_id' && `semester_id`= '$semester_id' ";
        $depresult = $con->query($sql2);
        $deprow = $depresult->fetch_assoc();

        if ($deprow['easebuzzid'] == '' && $deprow['transactionid'] == '') {


            ?>
<form action="exam_confirm" method="post" enctype="multipart/form-data">
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">PERSONAL DETAILS</h3>
        </div>

        <div class="card-body table-responsive p-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">

                        <label>Registration Number</label>
                        <input id="" type="hidden" name="course_id" value="<?php echo $_SESSION['course_id'] ?>"
                            class=" form-control rounded-pill">
                        <input id="" type="hidden" name="academic_year" value="<?php echo $_SESSION['academic_year'] ?>"
                            class=" form-control rounded-pill">
                        <input id="" type="hidden" name="semester_id" value="<?php echo $_SESSION['semester_id'] ?>"
                            class=" form-control rounded-pill">
                        <input id="" type="hidden" name="amount" value="<?php echo $_SESSION['amount'] ?>"
                            class=" form-control rounded-pill">
                        <input id="" type="hidden" name="verified_by" value="<?php echo $_SESSION['verified_by'] ?>"
                            class=" form-control rounded-pill">
                        <input id="" type="hidden" name="admission_id"
                            value="<?php echo $_SESSION['user']['admission_id'] ?>" class=" form-control rounded-pill">
                        <input readonly id="" type="text" name="registration_no" class="form-control rounded-pill"
                            required value="<?php echo $adrow['reg_no'] ?>">
                    </div>

                    <div class=" col-4">
                        <label>Roll Number</label>
                        <input id="" type="text" name="roll_no" class="form-control rounded-pill"
                            value="<?php echo $adrow['roll_no'] ?>">
                    </div>

                    <div class=" col-4">
                        <label>Candidate's Name</label>
                        <input id="" type="text" name="candidate_name" class="form-control rounded-pill"
                            value="<?php echo $row['admission_first_name'] . " " . $row['admission_middle_name'] . " " . $row['admission_last_name'] ?>"
                            readonly>
                        <?php $_SESSION["candidate_name"] = $row['admission_first_name'] . " " . $row['admission_middle_name'] . " " . $row['admission_last_name']; ?>
                    </div>

                    <div class=" col-4">
                        <label>Father's Name</label>
                        <input id="" type="text" name="father_name" class="form-control rounded-pill"
                            value="<?php echo $row['admission_father_name'] ?>" readonly>
                        <?php $_SESSION["father_name"] = $row['admission_father_name']; ?>
                    </div>

                    <div class=" col-4">
                        <small class="text-red">(Do not use any special character like ., -, /, or symbol's)</small>
                        <label>Department / Specialisation</label>
                        <input id="" type="text" name="department" class="form-control rounded-pill" required
                            value="<?php echo $deprow['department'] ?>">
                    </div>

                    <div class=" col-4">
                        <label>Apaar ID</label>
                        <input id="" type="text" name="apaar_id" class="form-control rounded-pill" required>
                    </div>

                    <div class=" col-4">
                        <label>Candidate Signature ( <span class="text-danger">max 200kb</span> )</label>
                        <input type="file" onchange="image_check(this,200)" name="candidate_signature"
                            class="form-control rounded-pill" required>
                    </div>

                    <div class="col-4">
                        <label>Candidate Passport Photo ( <span class="text-danger">max 200kb</span> )</label>
                        <input type="file" onchange="image_check(this,200)" name="passport_photo"
                            class="form-control rounded-pill" required>
                    </div>

                    <div class="col-8">
                        <label>Passport Size Photograph</label><br>
                        <input type="hidden" name="passport_photo" class="form-control rounded-pill"
                            value="<?php echo $row["admission_profile_image"]; ?>">
                        <img class=" profile-user-img "
                            src=" ../images/student_images_new/<?php echo $row["admission_profile_image"]; ?>"
                            alt="Student profile picture">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">PERSONAL DETAILS</h3>
        </div>

        <div class="card-body table-responsive p-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <label>Gender</label>
                        <input id="" type="text" name="gender" class="form-control rounded-pill"
                            value="<?php echo strtoupper($row['admission_gender']) ?>" readonly>
                    </div>
                    <div class=" col-4">
                        <label>Date Of Birth</label>
                        <input id="" type="text" name="dob" class="form-control rounded-pill"
                            value="<?php echo date("d/m/Y", strtotime($row['admission_dob'])) ?>">
                    </div>
                    <div class=" col-4">
                        <label>Email Id (Student)</label>
                        <input id="" type="text" name="email_id" class="form-control rounded-pill"
                            value="<?php echo $row['admission_emailid_student'] ?>">
                        <?php $_SESSION["email_id"] = $row['admission_emailid_student']; ?>
                    </div>
                    <div class=" col-4">
                        <label>Mobile No.(01)</label>
                        <input id="" type="text" name="mobile_no1" class="form-control rounded-pill"
                            value="<?php echo $row['admission_mobile_student'] ?>">
                        <?php $_SESSION["mobile_no1"] = $row['admission_mobile_student']; ?>
                    </div>
                    <div class=" col-4">
                        <label>Mobile No.(02)</label>
                        <input id="" value="<?php echo $deprow['mobile_no2'] ?>" type="text" name="mobile_no2"
                            class="form-control rounded-pill">
                    </div>
                    <div class="col-4">
                        <label>Adhar No</label>
                        <input id="" type="hidden" name="adhar_no" class="form-control rounded-pill"
                            value="<?php echo $row['admission_aadhar_no'] ?>">
                        <input id="" type=" text" name="adhar_no" class="form-control rounded-pill"
                            value="<?php echo $row['admission_aadhar_no'] ?>">
                    </div>
                    <div class=" col-12">
                        <label>Correspondence Address (for all communication by the University):</label>
                        <input id="" type="hidden" name="address" class="form-control rounded-pill"
                            value="<?php echo $row['admission_residential_address'] ?>">
                        <input type=" text" id="address" name="address" class="form-control rounded-pill"
                            value="<?php echo $row['admission_residential_address'] ?>" style="height: 38px;">
                    </div>
                    <div class="col-4">
                        <label>Last Examination Passed & Year</label>
                        <input id="" value="<?= date('Y') - 1 ?>" type="text" name="last_exam_year"
                            class="form-control rounded-pill" required>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <table id="example1" class="table table-bordered table-striped" style="overflow-x:auto;">
        <thead>
            <tr>
                <th width="10%">S.No</th>
                <th width="20%">Paper Code</th>
                <th width="20%">Paper Name</th>
            </tr>
        </thead>
        <tbody>
            <?php

                        $sql = "SELECT * FROM `tbl_subjects`  WHERE `status` = '$visible' && course_id = '$course_id' && `semester_id` = '$semester_id' && `fee_academic_year`='$academic_year' AND (specialization_id = '" . $row['specialization_id'] . "' OR specialization_id = '" . $row['specialization_id_dual'] . "' OR COALESCE(specialization_id, '') = '') ORDER BY `subject_id` ASC ";
                        $row = $con->query($sql);
                        while ($row_course = $row->fetch_assoc()) {
                            ?>
            <tr>
                <td>
                    <?php echo $s_no; ?>
                </td>
                <td> <input type="text" name="paper_code" class="form-control rounded-pill"
                        value="<?php echo $row_course["subject_code"] ?>" readonly></td>
                <td> <input type=" text" name="paper_name" class="form-control rounded-pill"
                        value="<?php echo $row_course["subject_name"] ?>" readonly></td>
            </tr>
            <?php
                            $s_no++;
                        }
                        ?>
        </tbody>
    </table>
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Upload Documents*</h3>
        </div>

        <div class="card-body table-responsive p-0">
            <div class="card-body">
                <div class="row">
                    <div class=" col-md-4">
                        <label>Registration Slip ( <span class="text-danger">max 200kb</span> )</label>
                        <input type="file" onchange="image_check(this,200)" name="doc_reg"
                            class="form-control rounded-pill" required>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <p> <input type="checkbox" required> Declaration By the Student :</p>
    <p style="text-align:justify;">I hereby declare that I have read and understood the instructions
        given above. I also
        affirm that I have submitted all the required numbers of assignment as applicable for the
        aforesaid course
        filled in the examination form and my registration for the course is valid and not time barred.
        If any of my
        statements is found to be untrue, I will have no claim for appearing in the examination. I
        undertake that I
        shall abide by the rules and regulations of the University.</p>

    <tr>
        <td height="40" colspan="8" valign="middle" align="center" class="narmal">
            <input type="submit" name="submit" value="Next" class="btn btn-primary">
        </td>
    </tr>
</form>

<?php

        } else {
            ?>

<h2 class="text-center text-success">Your Examination Form Successfully Submited</h2>
<?php
        }
    }
    //add exam form Student list end



    // add Migration form list
    if ($_GET["action"] == "fetch_migration_form") {

        $course_id = $_POST["course_id"];
        $academic_year = $_POST["academic_year"];
        // $semester_id = $_POST["semester_id"];
        $amount = $_POST["amount"];
        $subject_id = $_POST["subject_id"];

        $_SESSION["course_id"] = $course_id;
        $_SESSION["academic_year"] = $academic_year;
        $_SESSION["semester_id"] = $semester_id;
        $_SESSION["amount"] = $amount;

        $row = $_SESSION['user'];
        $admission_id = $row['admission_id'];
        //    echo $admission_id;
        $sql1 = "SELECT * FROM `tbl_allot_semester` WHERE `status` = '$visible' && `admission_id` = '$admission_id' && `course_id` = '" . $_SESSION["course_id"] . "' && `academic_year`= '$academic_year'";
        $adresult = $con->query($sql1);
        $adrow = $adresult->fetch_assoc();


        $sql2 = "SELECT * FROM `tbl_migration_form` WHERE `status` = '$visible' && `course_id` = '" . $_SESSION["course_id"] . "' && `admission_id` = '$admission_id' ";
        $depresult = $con->query($sql2);
        $deprow = $depresult->fetch_assoc();

        // echo "<pre>";
        //     print_r($deprow);
        // echo "</pre>";
        if ($deprow['easebuzzid'] == '' && $deprow['transactionid'] == '') {

            $sql = "SELECT * FROM `tbl_university_details`
        WHERE `status` = '$visible' && university_details_id = '" . $row["admission_session"] . "'
        ORDER BY `university_details_id` DESC
        ";
            $result = $con->query($sql);
            $rows = $result->fetch_assoc();
            $academic_yearId = $rows["university_details_id"];

            $completeSessionStart = explode("-", $rows["university_details_academic_start_date"]);
            $completeSessionEnd = explode("-", $rows["university_details_academic_end_date"]);
            $completeSessionOnlyYear = $completeSessionStart[0] . "-" . $completeSessionEnd[0];
            // echo "<pre>";
            // print_r($row);
            // echo "</pre>";
            ?>


<form action="migration_confirm" method="post" enctype="multipart/form-data">
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Apply Migration Form </h3>
        </div>

        <div class="card-body table-responsive p-0">
            <div class="card-body">
                <div class="row">
                    <div class=" col-md-6">
                        <label>Name in <u>BLOCK</u> Letter:</label>
                        <input id="" type="text" name="candidate_name" class="form-control rounded-pill"
                            value="<?php echo $row['admission_first_name'] . " " . $row['admission_middle_name'] . " " . $row['admission_last_name'] ?>"
                            readonly required>
                        <?php $_SESSION["candidate_name"] = $row['admission_first_name'] . " " . $row['admission_middle_name'] . " " . $row['admission_last_name']; ?>
                    </div>

                    <div class=" col-md-6">
                        <label>Father's Name in <u>BLOCK</u> Letter:</label>
                        <input id="" type="text" name="father_name" class="form-control rounded-pill"
                            value="<?php echo $row['admission_father_name'] ?> " readonly required>
                        <?php $_SESSION["father_name"] = $row['admission_father_name']; ?>
                    </div>
                    <div class=" col-md-6">
                        <label>Mother's Name in <u>BLOCK</u> Letter:</label>
                        <input id="" type="text" name="mother_name" class="form-control rounded-pill"
                            value="<?php echo $row['admission_mother_name'] ?>" readonly required>
                        <?php $_SESSION["mother_name"] = $row['admission_mother_name']; ?>
                    </div>

                    <div class=" col-md-6">
                        <label>Date Of Birth:</label>
                        <input required id="" type="text" name="dob" class="form-control rounded-pill"
                            value="<?php echo date("d/m/Y", strtotime($row['admission_dob'])) ?>" readonly>
                    </div>
                    <div class=" col-md-6">
                        <label>Gender:</label>
                        <input required id="" type="text" name="gender" class="form-control rounded-pill"
                            value="<?php echo $row['admission_gender'] ?>" readonly>
                    </div>
                    <div class=" col-md-6">
                        <label>Mobile No.:</label>
                        <input required id="" type="text" name="mobile" class="form-control rounded-pill"
                            value="<?php echo $row['admission_mobile_student'] ?>" readonly>
                    </div>
                    <div class=" col-md-6">
                        <label>WhatsApp No.:</label>
                        <input id="" type="text" name="whatsapp" class="form-control rounded-pill"
                            value="<?php echo $row['admission_mobile_student'] ?>" readonly required>
                    </div>
                    <div class=" col-md-6">
                        <label>Email:</label>
                        <input id="" type="text" name="email_id" class="form-control rounded-pill"
                            value="<?php echo $row['admission_emailid_student'] ?>" readonly required>
                    </div>
                    <div class=" col-md-6">
                        <label>University Registration No.:</label>
                        <input id="" type="hidden" name="course_id" value="<?php echo $_SESSION['course_id'] ?>"
                            class=" form-control rounded-pill">
                        <input id="" type="hidden" name="academic_year" value="<?php echo $_SESSION['academic_year'] ?>"
                            class=" form-control rounded-pill">
                        <input id="" type="hidden" name="semester_id" value="<?php echo $_SESSION['semester_id'] ?>"
                            class=" form-control rounded-pill">
                        <input id="" type="hidden" name="amount" value="<?php echo $_SESSION['amount'] ?>"
                            class=" form-control rounded-pill">
                        <input id="" type="text" name="registration_no" class="form-control rounded-pill" required>
                    </div>
                    <div class=" col-md-6">
                        <label>Session:</label>
                        <input id="" type="text" name="session" class="form-control rounded-pill"
                            value="<?php echo $completeSessionOnlyYear; ?>" readonly required>
                    </div>
                    <div class=" col-md-6">
                        <label>Passing Year:</label>
                        <input id="" type="text" name="name_of_the_exam" class="form-control rounded-pill" value=""
                            required>
                    </div>
                    <div class=" col-md-6">
                        <label>Passed or Failed With Year:</label>
                        <select id="" name="passfail" class="form-control rounded-pill" required>
                            <option value="">Select</option>
                            <option value="Pass">Pass</option>
                            <option value="Incomplete">Incomplete</option>
                        </select>
                    </div>
                    <div class=" col-md-6">
                        <label>Semester:</label>
                        <select id="" name="semester" class="form-control rounded-pill" required>
                            <option value="">Select</option>
                            <option value="1st Semester">1st Semester</option>
                            <option value="2nd Semester">2nd Semester</option>
                            <option value="3rd Semester">3rd Semester</option>
                            <option value="4th Semester">4th Semester</option>
                            <option value="5th Semester">5th Semester</option>
                            <option value="6th Semester">6th Semester</option>
                            <option value="7th Semester">7th Semester</option>
                            <option value="8th Semester">8th Semester</option>
                            <option value="9th Semester">9th Semester</option>
                            <option value="10th Semester">10th Semester</option>
                        </select>
                    </div>

                    <div class=" col-md-6">
                        <label>Address:</label>
                        <input id="" type="textarea" name="address" class="form-control rounded-pill"
                            value="<?php echo $row['admission_residential_address'] ?>" readonly required>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Upload Documents*</h3>
        </div>

        <div class="card-body table-responsive p-0">
            <div class="card-body">
                <div class="row">
                    <div class=" col-md-4">
                        <label>Registration Slip ( <span class="text-danger">max 200kb</span> )</label>
                        <input type="file" onchange="image_check(this,200)" name="doc_reg"
                            class="form-control rounded-pill" required>
                    </div>
                    <div class="col-md-4">
                        <label>Upload Last Exam Marksheet( <span class="text-danger">max 200kb</span> )</label>
                        <input type="file" onchange="image_check(this,200)" name="doc_marksheet"
                            class="form-control rounded-pill" required>
                    </div>
                    <div class="col-md-4">
                        <label>Upload Last Exam Admit Card( <span class="text-danger">max 200kb</span> )</label>
                        <input type="file" onchange="image_check(this,200)" name="doc_admitcard"
                            class="form-control rounded-pill" required>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <p class='text-danger'><i><b>Enclosure:</b>Original Registration Slip; Xerox copy
            Final(Sem/Year)Admit Card & Marksheet.
        </i>
    </p>
    <p> <input type="checkbox" required> Declaration By the Student :</p>
    <p style="text-align:justify;">I hereby declare that I have read and understood the instructions given above. I
        also
        affirm that I have submitted all the required documents as applicable for the migration process. My
        registration
        for the current course is valid and not time-barred. If any of my statements are found to be untrue, I will
        have
        no claim for the migration process. I undertake that I shall abide by the rules and regulations of the
        University.</p>

    <tr>
        <td height="40" colspan="8" valign="middle" align="center" class="narmal">
            <input type="submit" name="submit" value="Next" class="btn btn-primary">
        </td>
    </tr>
</form>

<?php

        } else {
            ?>
<div class="alert alert-success text-center">
    <h5>Your Migration Form Application is Under Review</h5>
    <p>Please wait while we are reviewing your application. When approved, kindly bring the <b>Original Registration
            Slip</b> to collect the migration cum TC certificate from the <b>EXAMINATION DEPARTMENT.</b></p>
    <p class="text-danger" style="font-size: 17px;font-weight: 600;"><i><u><b>NOTE:</b> Please visit the university
                after 3 days of applying for
                the migration
                form.</u></i></p>
</div>

<!-- Verification Table -->
<div class="card card-secondary mt-3">
    <div class="card-header">
        <h3 class="card-title">Verification Status</h3>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Department</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                            // Fetch the verification details
                            $sql_status = "SELECT * FROM `tbl_migration_form` WHERE `admission_id` = '$admission_id' AND `course_id` = '" . $_SESSION["course_id"] . "'";
                            $status_result = $con->query($sql_status);
                            $status_row = $status_result->fetch_assoc();

                            // Define departments
                            $departments = [
                                'Admin Dept' => 'admin_dept',
                                'Finance Department' => 'finance_dept',
                                'Library' => 'library',
                                'IT Lab' => 'IT_lab',
                                'Dept Labs' => 'dept_labs'
                            ];

                            // Loop through departments and display status
                            foreach ($departments as $dept => $status_field) {
                                $status = $status_row[$status_field] ?? ''; // Get status from database, default to empty
                                if ($status === 'Approved') {
                                    $status_display = '<span style="color:green;">&#10004; Approved</span>'; // Green checkmark
                                } else {
                                    $status_display = '<span style="color:red;">Under Reviewing</span>'; // Red text
                                }
                                echo "<tr>
                                    <td>{$dept}</td>
                                    <td>{$status_display}</td>
                                  </tr>";
                            }
                            ?>
            </tbody>
        </table>
    </div>
</div>

<?php
        }
    }

    //add Migration form Student list end




    // add exam form list
    if ($_GET["action"] == "fetch_backlog_exam_form") {

        $course_id = $_POST["course_id"];
        $academic_year = $_POST["academic_year"];
        $semester_id = $_POST["semester_id"];
        $amount = $_POST["amount"];
        $subject_id = $_POST["subject_id"];

        $_SESSION["course_id"] = $course_id;
        $_SESSION["academic_year"] = $academic_year;
        $_SESSION["semester_id"] = $semester_id;
        $_SESSION["amount"] = $amount;

        $row = $_SESSION['user'];
        $admission_id = $row['admission_id'];

        $sql1 = "SELECT * FROM `tbl_allot_semester` WHERE `status` = '$visible' && `admission_id` = '$admission_id' && `course_id` = '" . $_SESSION["course_id"] . "' && `academic_year`= '$academic_year' && `semester_id`= '$semester_id'";
        $adresult = $con->query($sql1);
        $adrow = $adresult->fetch_assoc();
        $reg_no = $adrow['reg_no'];

        $fee = "SELECT `exam_fee` FROM tbl_backlogs WHERE `semester_id` = '$semester_id'";

        $sql3 = "SELECT * FROM `tbl_back_examination_form` WHERE `status` = '$visible' && `course_id` = '" . $_SESSION["course_id"] . "' && `admission_id` = '$admission_id' && `semester_id`= '$semester_id' ";
        $depresults = $con->query($sql3);
        $deprows = $depresults->fetch_assoc();


        if ($deprows['easebuzzid'] == '' && $deprows['transactionid'] == '') {


            ?>
<form action="backlog_exam_confirm" method="post" enctype="multipart/form-data">
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">PERSONAL DETAILS</h3>
        </div>

        <div class="card-body table-responsive p-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">

                        <label>Registration Number</label>
                        <input id="" type="hidden" name="course_id" value="<?php echo $_SESSION['course_id'] ?>"
                            class=" form-control rounded-pill">
                        <input id="" type="hidden" name="academic_year" value="<?php echo $_SESSION['academic_year'] ?>"
                            class=" form-control rounded-pill">
                        <input id="" type="hidden" name="semester_id" value="<?php echo $_SESSION['semester_id'] ?>"
                            class=" form-control rounded-pill">
                        <input id="" type="hidden" name="amount" value="<?php echo $_SESSION['amount'] ?>"
                            class=" form-control rounded-pill">
                        <input readonly id="" type="text" name="registration_no" class="form-control rounded-pill"
                            required value="<?php echo $adrow['reg_no'] ?>">
                    </div>

                    <div class=" col-4">
                        <label>Roll Number</label>
                        <input id="" type="text" name="roll_no" class="form-control rounded-pill"
                            value="<?php echo $adrow['roll_no'] ?>" readonly>
                    </div>

                    <div class=" col-4">
                        <label>Candidate's Name</label>
                        <input id="" type="text" name="candidate_name" class="form-control rounded-pill"
                            value="<?php echo $row['admission_first_name'] . " " . $row['admission_middle_name'] . " " . $row['admission_last_name'] ?>"
                            readonly>
                    </div>

                    <div class=" col-4">
                        <label>Father's Name</label>
                        <input id="" type="text" name="father_name" class="form-control rounded-pill"
                            value="<?php echo $row['admission_father_name'] ?>" readonly>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">PERSONAL DETAILS</h3>
        </div>

        <div class="card-body table-responsive p-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <label>Gender</label>
                        <input id="" type="text" name="gender" class="form-control rounded-pill"
                            value="<?php echo strtoupper($row['admission_gender']) ?>" readonly>
                    </div>
                    <div class=" col-4">
                        <label>Date Of Birth</label>
                        <input id="" type="text" name="dob" class="form-control rounded-pill"
                            value="<?php echo date("d/m/Y", strtotime($row['admission_dob'])) ?>" readonly>
                    </div>
                    <div class=" col-4">
                        <label>Email Id (Student)</label>
                        <input id="" type="text" name="email_id" class="form-control rounded-pill"
                            value="<?php echo $row['admission_emailid_student'] ?>" readonly>
                    </div>
                    <div class=" col-4">
                        <label>Mobile No.(01)</label>
                        <input id="" type="text" name="mobile_no1" class="form-control rounded-pill"
                            value="<?php echo $row['admission_mobile_student'] ?>" readonly>
                    </div>
                    <div class=" col-4">
                        <label>Mobile No.(02)</label>
                        <input id="" value="<?php echo $deprow['mobile_no2'] ?>" type="text" name="mobile_no2"
                            class="form-control rounded-pill">
                    </div>
                    <div class="col-4">
                        <label>Adhar No</label>
                        <input id="" type="hidden" name="adhar_no" class="form-control rounded-pill"
                            value="<?php echo $row['admission_aadhar_no'] ?>">
                        <input id="" type=" text" name="adhar_no" class="form-control rounded-pill"
                            value="<?php echo $row['admission_aadhar_no'] ?>" readonly>
                    </div>
                    <div class=" col-12">
                        <label>Correspondence Address (for all communication by the
                            University):</label>
                        <input id="" type="hidden" name="address" class="form-control rounded-pill"
                            value="<?php echo $row['admission_residential_address'] ?>" readonly>
                        <input type=" text" id="address" name="address" class="form-control rounded-pill"
                            value="<?php echo $row['admission_residential_address'] ?>" style="height: 38px;" readonly>
                    </div>
                    <div class="col-4">
                        <label>Last Examination Passed & Year</label>
                        <input id="" value="<?= date('Y') - 1 ?>" type="text" name="last_exam_year"
                            class="form-control rounded-pill" required readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <table id="example1" class="table table-bordered table-striped" style="overflow-x:auto;">
        <thead>
            <tr>
                <th width="5%"></th>
                <th width="10%">S.No</th>
                <th width="20%">Paper Code</th>
                <th width="20%">Paper Name</th>
            </tr>
        </thead>
        <tbody>
            <?php

                        $sql = "SELECT * FROM `tbl_subjects`  WHERE `status` = '$visible' && course_id = '$course_id' && `semester_id` = '$semester_id' && `fee_academic_year`='$academic_year' ORDER BY `subject_id` ASC ";
                        $row = $con->query($sql);
                        while ($row_course = $row->fetch_assoc()) {
                            $subject_id = $row_course['subject_id'];
                            $sql_sub_check = "SELECT * FROM `tbl_marks` WHERE `status` = '$visible' AND `reg_no` = '$reg_no' AND `subject_id` = '$subject_id'";
                            $row_sub_check = $con->query($sql_sub_check);
                            $result_sub_check = $row_sub_check->fetch_assoc();
                            //echo $row_sub_check;
            

                            $pass_marks = $row_course['pass_marks'];
                            $obtained_marks = $result_sub_check['internal_marks'] + $result_sub_check['external_marks'];
                            // Check if obtained marks are less than pass marks
                            // echo "<pre>";
                            // print_r($pass_marks);
                            // echo "</pre>";
                            if ($obtained_marks < $pass_marks) {
                                ?>
            <tr>
                <td>

                    <input type="checkbox" name="selected_subjects[]" value="1" data-exam-fee="500"
                        onclick="updateExamFee(this)">
                </td>
                <td>
                    <?php echo $s_no; ?>
                </td>
                <td> <input type="text" name="paper_code" class="form-control rounded-pill"
                        value="<?php echo $row_course["subject_code"] ?>" readonly></td>
                <td> <input type=" text" name="paper_name" class="form-control rounded-pill"
                        value="<?php echo $row_course["subject_name"] ?>" readonly></td>
            </tr>
            <?php
                            }
                            $s_no++;
                        }
                        ?>
        </tbody>
    </table>
    <!-- <div class="col-4">
        <label>Total Exam Fee</label>
        <input id="amount" type="text" name="exam_fee" class="form-control rounded-pill" readonly>
    </div> -->
    <script>
    function updateExamFee(checkbox) {
        var checkboxes = document.getElementsByName("selected_subjects[]");
        var totalExamFee = 0;

        // Iterate through all checkboxes to calculate the total exam fee
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                // Retrieve the exam fee from the data-exam-fee attribute
                var examFee = parseFloat(checkboxes[i].getAttribute("data-exam-fee"));

                // Log the exam fee value to debug
                console.log("Exam Fee for subject " + checkboxes[i].value + ": " + examFee);

                // Check if the parsed examFee is a valid number, if not, set to 0
                if (isNaN(examFee)) {
                    console.log("Invalid fee, setting to 0");
                    examFee = 0;
                }

                totalExamFee += examFee;
            }
        }

        // Log the total fee to debug
        console.log("Total Exam Fee: " + totalExamFee);

        // Update the total exam fee input field
        document.getElementById("amount").value = totalExamFee.toFixed(2); // Display the fee with two decimal places
    }
    </script>



    <p> <input type="checkbox" required> Declaration By the Student :</p>
    <p style="text-align:justify;">I hereby declare that I have read and understood the instructions
        given above. I also
        affirm that I have submitted all the required numbers of assignment as applicable for the
        aforesaid course
        filled in the examination form and my registration for the course is valid and not time
        barred.
        If any of my
        statements is found to be untrue, I will have no claim for appearing in the examination. I
        undertake that I
        shall abide by the rules and regulations of the University.</p>

    <tr>
        <td height="40" colspan="8" valign="middle" align="center" class="narmal">
            <input type="submit" name="submit" value="Next" class="btn btn-primary">
        </td>
    </tr>
</form>

<?php

        } else {
            ?>

<h2 class="text-center text-success">Your Examination Form Successfully Submited</h2>
<?php
        }
    }


    //add registration form Student list end

    // add registration form list

    // add registration form list

    if ($_GET["action"] == "fetch_reg_form") {

        $course_id = $_POST["course_id"];
        $academic_year = $_POST["academic_year"];
        $semester_id = $_POST["semester_id"];
        $amount = $_POST["amount"];
        $subject_id = $_POST["subject_id"];

        $_SESSION["course_id"] = $course_id;
        $_SESSION["academic_year"] = $academic_year;
        $_SESSION["semester_id"] = $semester_id;
        $_SESSION["amount"] = $amount;

        $row = $_SESSION['user'];
        $admission_id = $row['admission_id'];

        $sql1 = "SELECT * FROM `tbl_allot_semester` WHERE `status` = '$visible' && `admission_id` = '$admission_id' && `course_id` = '" . $_SESSION["course_id"] . "' && `academic_year`= '$academic_year' ";
        $adresult = $con->query($sql1);
        $adrow = $adresult->fetch_assoc();

        $sql2 = "SELECT * FROM `tbl_reg` WHERE `status` = '$visible' && `course_id` = '" . $_SESSION["course_id"] . "' && `admission_id` = '$admission_id' ";
        $depresult = $con->query($sql2);
        $deprow = $depresult->fetch_assoc();

        $lastNumber = intval(substr($adrow['reg_no'], -1));

        // Get the current year
        $currentYear = 24;
        // ------------------------select course using course_id--------------------------

        $sql_course = "SELECT * FROM `tbl_course`
                                       WHERE `status` = '$visible' && `course_id` = '$course_id';
                                       ";
        $result_course = $con->query($sql_course);
        $row_course = $result_course->fetch_assoc();
        // echo "<pre>";
        // print_r($row_course);
        // echo "</pre>";

        $course_code = $row_course['course_code'];

        if (strlen($course_code) == 1 && is_numeric($course_code)) {
            // Add '0' as a prefix
            $course_code = '0' . $course_code;
        }
        // echo "Visible: $visible, Course ID: " . $row["course_id"];
        $newNumber = $lastNumber + 1;
        $newRegNo = 'NSU' . $currentYear . $course_code . sprintf('%03d', $newNumber);

        if (strlen($course_code) == 1 && is_numeric($course_code)) {
            // Add '0' as a prefix
            $course_code = '0' . $course_code;
        }
        // echo "Visible: $visible, Course ID: " . $row["course_id"];
        $newNumber = $lastNumber + 1;
        $newRollNo = $currentYear . $course_code . sprintf('%03d', $newNumber);


        if ($deprow['easebuzzid'] == '' && $deprow['transactionid'] == '') {


            ?>
<form action="reg_confirm" method="post" enctype="multipart/form-data">
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">PERSONAL DETAILS</h3>
        </div>

        <div class="card-body table-responsive p-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">

                        <label>Registration Number</label>
                        <input id="" type="hidden" name="course_id" value="<?php echo $_SESSION['course_id'] ?>"
                            class=" form-control rounded-pill">
                        <input id="" type="hidden" name="academic_year" value="<?php echo $_SESSION['academic_year'] ?>"
                            class=" form-control rounded-pill">
                        <!-- <input id="" type="hidden" name="semester_id" value="<?php echo $_SESSION['semester_id'] ?>"
                            class=" form-control rounded-pill"> -->
                        <input id="" type="hidden" name="amount" value="<?php echo $_SESSION['amount'] ?>"
                            class=" form-control rounded-pill">
                        <input readonly id="" type=" text" name="registration_no" class="form-control rounded-pill"
                            required value="<?php echo $newRegNo ?>">
                    </div>

                    <div class="col-4">
                        <label>Roll Number</label>
                        <input id="" type="text" name="roll_no" class="form-control rounded-pill"
                            value="<?php echo $newRollNo ?>" readonly>
                    </div>

                    <div class=" col-4">
                        <label>Candidate's Name</label>
                        <input id="" type="text" name="candidate_name" class="form-control rounded-pill" readonly
                            value="<?php echo $row['admission_first_name'] . " " . $row['admission_middle_name'] . " " . $row['admission_last_name'] ?>">
                    </div>
                    <div class="col-4">
                        <label for="type">Type(Please select your type)</label>
                        <select id="type" name="type" class="form-control rounded-pill">
                            <option value="Regular">Regular</option>
                            <option value="Lateral">Lateral</option>
                        </select>
                    </div>

                    <div class=" col-4">
                        <label>Gender</label>
                        <input id="" type="text" name="gender" class="form-control rounded-pill"
                            value="<?php echo strtoupper($row['admission_gender']) ?>" readonly>
                    </div>
                    <div class=" col-4">
                        <label>Date Of Birth</label>
                        <input id="" type="text" name="dob" class="form-control rounded-pill"
                            value="<?php echo date("d/m/Y", strtotime($row['admission_dob'])) ?>">
                    </div>
                    <div class=" col-4">
                        <label>Category</label>
                        <input id="" type="text" name="category" class="form-control rounded-pill"
                            value="<?php echo $row['admission_category'] ?>">
                    </div>

                    <div class=" col-4">
                        <label>Father's Name</label>
                        <input id="" type="text" name="father_name" class="form-control rounded-pill"
                            value="<?php echo $row['admission_father_name'] ?>" readonly>
                    </div>
                    <div class=" col-4">
                        <label>Mothers's Name</label>
                        <input id="" type="text" name="mother_name" class="form-control rounded-pill"
                            value="<?php echo $row['admission_mother_name'] ?>" readonly>
                    </div>
                    <div class=" col-4">
                        <label>Residence Status</label>
                        <small class='text-muted'>(Village/Town/City)</small>
                        <input id="" type="text" name="residence_status" class="form-control rounded-pill">
                    </div>
                    <div class="col-4">
                        <label>Blood Group</label>
                        <input id="" type="text" name="blood" class="form-control rounded-pill"
                            value="<?php echo $row['admission_blood_group'] ?>">
                    </div>
                    <div class=" col-4">
                        <label>Marital Status</label>
                        <small class='text-muted'>(Married/Unmarried)</small>
                        <input id="" type="text" name="matrial_status" class="form-control rounded-pill">
                    </div>
                    <div class=" col-4">
                        <label>ABC ID</label>
                        <input id="" type="text" name="abc_id" class="form-control rounded-pill" required>
                    </div>

                    <div class="col-4">
                        <label>Candidate Signature ( <span class="text-danger">max 200kb</span>
                            )</label>
                        <input type="file" onchange="image_check(this,200)" name="candidate_signature"
                            class="form-control rounded-pill" required>
                    </div>

                    <div class="col-4">
                        <label>Candidate Passport Photo ( <span class="text-danger">max 200kb</span>
                            )</label><small class="text-danger">Should be in college uniform</small>
                        <br>
                        <input type="file" onchange="image_check(this,200)" name="passport_photo"
                            class="form-control rounded-pill" required>
                    </div>

                    <div class="col-8">
                        <label>Passport Size Photograph</label>

                        <br>
                        <input type="hidden" name="passport_photo" class="form-control rounded-pill"
                            value="<?php echo $row["admission_profile_image"]; ?>">
                        <img class=" profile-user-img "
                            src=" ../images/regstudent_images/<?php echo $row["admission_profile_image"]; ?>"
                            alt="Student profile picture">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Gaurdian & Parent Details</h3>
        </div>
        <p class='text-danger'>In case the candidate is in gradianship other that monther & father,
            specify
            name and gaurdianship</p>
        <div class="card-body table-responsive p-0">
            <div class="card-body">
                <div class="row">

                    <div class="col-4">
                        <label>Gaurdian Name</label>
                        <input id="" type="text" name="guardian_name" class="form-control rounded-pill">
                    </div>
                    <div class="col-4">
                        <label>Gaurdian Relationship</label>
                        <input id="" type="text" name="guardian_relation" class="form-control rounded-pill">
                    </div>
                    <div class="col-4">
                        <label>Father Occupation</label>
                        <input id="" type="text" name="father_occu" class="form-control rounded-pill">
                    </div>
                    <div class="col-4">
                        <label>Mother Occupation</label>
                        <input id="" type="text" name="mother_occu" class="form-control rounded-pill">
                    </div>
                    <div class="col-4">
                        <label>Father Occupation</label>
                        <input id="" type="text" name="father_edu" class="form-control rounded-pill">
                    </div>
                    <div class="col-4">
                        <label>Mother Occupation</label>
                        <input id="" type="text" name="mother_edu" class="form-control rounded-pill">
                    </div>
                    <div class="col-4">
                        <label>Mobile No.</label>
                        <input id="" type="text" name="mobile_no1" class="form-control rounded-pill"
                            value="<?php echo $row['admission_mobile_student'] ?>">
                    </div>
                    <div class=" col-4">
                        <label>Religion</label>
                        <input id="" type="text" name="religion" class="form-control rounded-pill"
                            value="<?php echo $row['admission_religion'] ?>">
                    </div>
                    <div class=" col-4">
                        <label>Nationality</label>
                        <input id="" type="text" name="nationality" class="form-control rounded-pill"
                            value="<?php echo $row['admission_nationality'] ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class=" card card-secondary">
        <div class="card-header">
            <h3 class="card-title">DETAILS OF EXAMINATION PASSED/APPEARED</h3>
        </div>

        <div class="card-body table-responsive p-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <label>Examination</label>
                        <input id="examination" type="text" name="texamination" class="form-control rounded-pill"
                            value="10th Secondary" readonly>
                    </div>
                    <div class="col-4">
                        <label>Year of Passing</label>
                        <input id="passing_year" type="text" name="tpassing_year" class="form-control rounded-pill"
                            value="">
                    </div>
                    <div class="col-4">
                        <label>School/College</label>
                        <input id="school_college" type="text" name="tschool_college" class="form-control rounded-pill"
                            value="">
                    </div>
                    <div class="col-4">
                        <label>Name of Board</label>
                        <input id="board_name" type="text" name="tboard_name" class="form-control rounded-pill"
                            value="">
                    </div>
                    <div class="col-4">
                        <label>Max. Marks</label>
                        <input id="max_marks" type="text" name="tmax_marks" class="form-control rounded-pill" value="">
                    </div>
                    <div class="col-4">
                        <label>Marks Obtained</label>
                        <input id="marks_obtained" type="text" name="tmarks_obtained" class="form-control rounded-pill"
                            value="">
                    </div>
                    <div class="col-4">
                        <label>% of Marks/Grade</label>
                        <input id="percentage_grade" type="text" name="tpercentage_grade"
                            class="form-control rounded-pill" value="">
                    </div>
                    <div class="col-4">
                        <label>Medium of Instruction</label>
                        <input id="medium_instruction" type="text" name="tmedium_instruction"
                            class="form-control rounded-pill" value="">
                    </div>
                    <div class="col-4">
                        <label>Discipline</label>
                        <input id="discipline" type="text" name="tdiscipline" class="form-control rounded-pill"
                            value="">
                    </div>

                </div>
                <hr>
                <div class="row">
                    <div class="col-4">
                        <label>Examination</label>
                        <input id="examination" type="text" name="twexamination" class="form-control rounded-pill"
                            value="12th Secondary" readonly>
                    </div>
                    <div class="col-4">
                        <label>Year of Passing</label>
                        <input id="passing_year" type="text" name="twpassing_year" class="form-control rounded-pill"
                            value="">
                    </div>
                    <div class="col-4">
                        <label>School/College</label>
                        <input id="school_college" type="text" name="twschool_college" class="form-control rounded-pill"
                            value="">
                    </div>
                    <div class="col-4">
                        <label>Name of Board</label>
                        <input id="board_name" type="text" name="twboard_name" class="form-control rounded-pill"
                            value="">
                    </div>
                    <div class="col-4">
                        <label>Max. Marks</label>
                        <input id="max_marks" type="text" name="twmax_marks" class="form-control rounded-pill" value="">
                    </div>
                    <div class="col-4">
                        <label>Marks Obtained</label>
                        <input id="marks_obtained" type="text" name="twmarks_obtained" class="form-control rounded-pill"
                            value="">
                    </div>
                    <div class="col-4">
                        <label>% of Marks/Grade</label>
                        <input id="percentage_grade" type="text" name="twpercentage_grade"
                            class="form-control rounded-pill" value="">
                    </div>
                    <div class="col-4">
                        <label>Medium of Instruction</label>
                        <input id="medium_instruction" type="text" name="twmedium_instruction"
                            class="form-control rounded-pill" value="">
                    </div>
                    <div class="col-4">
                        <label>Discipline</label>
                        <input id="discipline" type="text" name="twdiscipline" class="form-control rounded-pill"
                            value="">
                    </div>
                </div>
                <hr>
                <!-- ------------------------ -->
                <div class="row">
                    <div class="col-4">
                        <label>Examination</label>
                        <input id="examination" type="text" name="gexamination" class="form-control rounded-pill"
                            value="Graduation" readonly>
                    </div>
                    <div class="col-4">
                        <label>Year of Passing</label>
                        <input id="passing_year" type="text" name="gpassing_year" class="form-control rounded-pill"
                            value="">
                    </div>
                    <div class="col-4">
                        <label>School/College</label>
                        <input id="school_college" type="text" name="gschool_college" class="form-control rounded-pill"
                            value="">
                    </div>
                    <div class="col-4">
                        <label>Name of Board</label>
                        <input id="board_name" type="text" name="gboard_name" class="form-control rounded-pill"
                            value="">
                    </div>
                    <div class="col-4">
                        <label>Max. Marks</label>
                        <input id="max_marks" type="text" name="gmax_marks" class="form-control rounded-pill" value="">
                    </div>
                    <div class="col-4">
                        <label>Marks Obtained</label>
                        <input id="marks_obtained" type="text" name="gmarks_obtained" class="form-control rounded-pill"
                            value="">
                    </div>
                    <div class="col-4">
                        <label>% of Marks/Grade</label>
                        <input id="percentage_grade" type="text" name="gpercentage_grade"
                            class="form-control rounded-pill" value="">
                    </div>
                    <div class="col-4">
                        <label>Medium of Instruction</label>
                        <input id="medium_instruction" type="text" name="gmedium_instruction"
                            class="form-control rounded-pill" value="">
                    </div>
                    <div class="col-4">
                        <label>Discipline</label>
                        <input id="discipline" type="text" name="gdiscipline" class="form-control rounded-pill"
                            value="">
                    </div>
                </div>




                <div class="row">
                    <div class="col-4">
                        <label>Examination</label>
                        <input id="examination" type="text" name="postexamination" class="form-control rounded-pill"
                            value="Post Graduation" readonly>
                    </div>
                    <div class="col-4">
                        <label>Year of Passing</label>
                        <input id="passing_year" type="text" name="postpassing_year" class="form-control rounded-pill"
                            value="">
                    </div>
                    <div class="col-4">
                        <label>School/College</label>
                        <input id="school_college" type="text" name="postschool_college"
                            class="form-control rounded-pill" value="">
                    </div>
                    <div class="col-4">
                        <label>Name of Board</label>
                        <input id="board_name" type="text" name="postboard_name" class="form-control rounded-pill"
                            value="">
                    </div>
                    <div class="col-4">
                        <label>Max. Marks</label>
                        <input id="max_marks" type="text" name="postmax_marks" class="form-control rounded-pill"
                            value="">
                    </div>
                    <div class="col-4">
                        <label>Marks Obtained</label>
                        <input id="marks_obtained" type="text" name="postmarks_obtained"
                            class="form-control rounded-pill" value="">
                    </div>
                    <div class="col-4">
                        <label>% of Marks/Grade</label>
                        <input id="percentage_grade" type="text" name="postpercentage_grade"
                            class="form-control rounded-pill" value="">
                    </div>
                    <div class="col-4">
                        <label>Medium of Instruction</label>
                        <input id="medium_instruction" type="text" name="postmedium_instruction"
                            class="form-control rounded-pill" value="">
                    </div>
                    <div class="col-4">
                        <label>Discipline</label>
                        <input id="discipline" type="text" name="postdiscipline" class="form-control rounded-pill"
                            value="">
                    </div>
                </div>


            </div>
        </div>
    </div>

    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">ADDRESS</h3>
        </div>

        <div class="card-body table-responsive p-0">
            <div class="card-body">
                <div class="row">

                    <div class="col-12">
                        <label>Parmanent Address:</label>
                        <input id="" type="hidden" name="parnament_adr" class="form-control rounded-pill"
                            value="<?php echo $row['admission_residential_address'] ?>">
                        <input type=" text" id="address" name="parnament_adr" class="form-control rounded-pill"
                            value="<?php echo $row['admission_residential_address'] ?>" style="height: 38px;">
                    </div>
                    <div class="col-4">
                        <label>Dist</label>
                        <input id="" type="text" name="parnament_dist" class="form-control rounded-pill"
                            value="<?php echo $row['admission_district'] ?>">
                    </div>

                    <div class=" col-4">
                        <label>Pin No</label>
                        <input id="" type="text" name="parnament_pin" class="form-control rounded-pill"
                            value="<?php echo $row['admission_pin_code'] ?>">
                    </div>
                    <div class=" col-4">
                        <label>State</label>
                        <input id="" type="text" name="parnament_state" class="form-control rounded-pill"
                            value="<?php echo $row['admission_state'] ?>">
                    </div>
                    <div class=" col-4">
                        <label>Country</label>
                        <input id="" type="text" name="parnament_country" class="form-control rounded-pill">
                    </div>
                    <hr>
                    <div class="col-12">
                        <label>Correspondence Address:</label>

                        <input type="text" id="address" name="corr_adr" class="form-control rounded-pill"
                            style="height: 38px;">
                    </div>
                    <div class="col-4">
                        <label>Dist</label>
                        <input id="" type="text" name="corr_dist" class="form-control rounded-pill">
                    </div>

                    <div class="col-4">
                        <label>Pin No</label>
                        <input id="" type="text" name="corr_pin" class="form-control rounded-pill">
                    </div>
                    <div class="col-4">
                        <label>State</label>
                        <input id="" type="text" name="corr_state" class="form-control rounded-pill">
                    </div>
                    <div class="col-4">
                        <label>Country</label>
                        <input id="" type="text" name="corr_country" class="form-control rounded-pill">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">CONTACT</h3>
        </div>

        <div class="card-body table-responsive p-0">
            <div class="card-body">
                <div class="row">

                    <div class="col-4">
                        <label>Mobile No.</label>
                        <input id="" type="text" name="mobile_no1" class="form-control rounded-pill"
                            value="<?php echo $row['admission_mobile_student'] ?>">
                    </div>
                    <div class=" col-4">
                        <label>WhatsApp No</label>
                        <input id="" type="text" name="swhatsapp" class="form-control rounded-pill">
                    </div>
                    <div class="col-4">
                        <label>Email Id (Student)</label>
                        <input id="" type="text" name="email_id" class="form-control rounded-pill"
                            value="<?php echo $row['admission_emailid_student'] ?>">
                    </div>
                    <div class=" col-4">
                        <label>Parents Mobile No.</label>
                        <input id="" type="text" name="pmob" class="form-control rounded-pill"
                            value="<?php echo $row['admission_father_phoneno'] ?>">
                    </div>
                    <div class=" col-4">
                        <label>Parents WhatsApp No</label>
                        <input id="" type="text" name="pwhatsapp" class="form-control rounded-pill"
                            value="<?php echo $row['admission_father_whatsappno'] ?>">
                    </div>
                    <div class=" col-4">
                        <label> Email Id (Parent)</label>
                        <input id="" type="text" name="pmail" class="form-control rounded-pill"
                            value="<?php echo $row['admission_emailid_father'] ?>">
                    </div>



                </div>
            </div>
        </div>
    </div>
    <div class=" card card-secondary">
        <div class="card-header">
            <h3 class="card-title">OTHER DETAILS</h3>
        </div>

        <div class="card-body table-responsive p-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <label>Student's Adhar (UID) No.</label>
                        <input id="" type="hidden" name="adhar_no" class="form-control rounded-pill"
                            value="<?php echo $row['admission_aadhar_no'] ?>">
                        <input id="" type=" text" name="adhar_no" class="form-control rounded-pill"
                            value="<?php echo $row['admission_aadhar_no'] ?>">
                    </div>


                </div>
            </div>
        </div>
    </div>
    <div class=" card card-secondary">
        <div class="card-header">
            <h3 class="card-title">UPLOAD DOCUMENTS</h3>
        </div>

        <div class="card-body table-responsive p-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <label>10th(High School) Marksheet ( <span class="text-danger">max
                                200kb</span> )</label>
                        <input type="file" onchange="image_check(this,200)" name="10th_marksheet"
                            class="form-control rounded-pill" required>
                    </div>
                    <div class="col-4">
                        <label>10th(High School) Certificate ( <span class="text-danger">max
                                200kb</span> )</label>
                        <input type="file" onchange="image_check(this,200)" name="10th_certificate"
                            class="form-control rounded-pill" required>
                    </div>
                    <div class="col-4">
                        <label>12th Marksheet(Intermediate) ( <span class="text-danger">max
                                200kb</span> )</label>
                        <input type="file" onchange="image_check(this,200)" name="12th_marksheet"
                            class="form-control rounded-pill">
                    </div>
                    <div class="col-4">
                        <label>12th Certificate(Intermediate) ( <span class="text-danger">max
                                200kb</span> )</label>
                        <input type="file" onchange="image_check(this,200)" name="12th_certificate"
                            class="form-control rounded-pill">
                    </div>
                    <div class="col-4">
                        <label>Bachelor's Degree/Equivalent Examination Marksheet ( <span class="text-danger">max
                                200kb</span> )</label>
                        <input type="file" onchange="image_check(this,200)" name="bachelor_marksheet"
                            class="form-control rounded-pill">
                    </div>
                    <div class="col-4">
                        <label>Bachelor's Degree/Equivalent Degree ( <span class="text-danger">max
                                200kb</span> )</label>
                        <input type="file" onchange="image_check(this,200)" name="bachelor_certificate"
                            class="form-control rounded-pill">
                    </div>
                    <div class="col-4">
                        <label>Master's Degree/Equivalent Examination Marksheet ( <span class="text-danger">max
                                200kb</span> )</label>
                        <input type="file" onchange="image_check(this,200)" name="master_marksheet"
                            class="form-control rounded-pill">
                    </div>
                    <div class="col-4">
                        <label>Master's Degree/Equivalent Degree ( <span class="text-danger">max
                                200kb</span> )</label>
                        <input type="file" onchange="image_check(this,200)" name="master_certificate"
                            class="form-control rounded-pill">
                    </div>
                    <div class="col-4">
                        <label>Transfer certificate(College/School Leaving Certificate) ( <span class="text-danger">max
                                200kb</span> )</label>
                        <input type="file" onchange="image_check(this,200)" name="transfer_certificate"
                            class="form-control rounded-pill" required>
                    </div>
                    <div class="col-4">
                        <label>Migration Certificate ( <span class="text-danger">max
                                200kb</span> )</label>
                        <input type="file" onchange="image_check(this,200)" name="migration_certificate"
                            class="form-control rounded-pill" required>
                    </div>
                    <div class="col-4">
                        <label>Adhar (UID) Card ( <span class="text-danger">max
                                200kb</span> )</label>
                        <input type="file" onchange="image_check(this,200)" name="adhar_card"
                            class="form-control rounded-pill" required>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <p> <input type="checkbox"> Declaration By the Student :</p>
    <p style="text-align:justify;"><b><i>I solemnly affirm that
                the information furnished above is true and
                correct in
                all
                respect. I have no concealed any information. I
                undertake that if any information furnished
                herein is
                found to
                be incorrect or untrue, I shall be liable for
                criminal prosecution and also forgo my claim to
                admission
                along
                with the refund of the entire money deposited bt
                me, towards tuition fee&others statutory fees to
                the
                University. Further, my candidature for the
                examination/admission to the programme shall be
                loable for
                cancellation at any stage. I agree to abide by
                the rules and regulations of the
                university.</i></b></p>

    <tr>
        <td height="40" colspan="8" valign="middle" align="center" class="narmal">
            <input type="submit" name="submit" value="Next" class="btn btn-primary">
        </td>
    </tr>
</form>

<?php

        } else {
            ?>

<h2 class="text-center text-success">Your University Registration Form Successfully Submited</h2>
<div class="container">
    <!-- Print button with icon -->
    <?php
                // ----------------test for print-------------------------------------------------
                $sql3 = "SELECT * FROM `tbl_reg` WHERE `admission_id` = '" . $admission_id . "'
    ";
                $result = $con->query($sql3);
                $rowww = $result->fetch_assoc();

                // echo "<pre>";
                // print_r($rowww);
                // echo "</pre>";
                $admission_id = $rowww['admission_id'];
                $academic_year = $rowww['academic_year'];
                $course_id = $rowww['course_id'];
                // ----------------test for print-------------------------------------------------
                ?>
    <form action="print-registration.php" method="POST">
        <input type="hidden" name="academic_year" value="<?= $academic_year ?>">
        <input type="hidden" name="admission_id" value="<?= $admission_id ?>">
        <input type="hidden" name="course_id" value="<?= $course_id ?>">
        <button class="print-button" type="submit">
            <i class="fas fa-print"></i> Print Form
        </button>
    </form>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    integrity="sha512-rmpplb6dJ6t4k57ka6g7p+lWqrxu2lzA6L9gSoL8lHxQ+dpJJKaZI2OyA/d/fzqzV6zNucf2CYIclVX+VXYxpw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
/* Container for centering */
.container {
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Style your button here */
.print-button {
    display: inline-flex;
    align-items: center;
    padding: 10px;
    background-color: #3498db;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

/* Style the icon inside the button */
.print-button i {
    margin-right: 5px;
}
</style>
<?php
        }
    }


    if ($_GET["action"] == "fetch_registrationn_form") {
        $course_id = $_POST["course_id"];
        $academic_year = $_POST["academic_year"];
        $semester_id = $_POST["semester_id"];
        $amount = $_POST["amount"];
        $subject_id = $_POST["subject_id"];
        $program_type = $_POST["program_type"];

        $_SESSION["course_id"] = $course_id;
        $_SESSION["academic_year"] = $academic_year;
        $_SESSION["semester_id"] = $semester_id;
        $_SESSION["amount"] = $amount;

        $row = $_SESSION['user'];
        $admission_id = $row['admission_id'];

        $sql1 = "SELECT * FROM `tbl_allot_semester` WHERE `status` = '$visible' && `admission_id` = '$admission_id' && `course_id` = '" . $_SESSION["course_id"] . "' && `academic_year`= '$academic_year' ";
        $adresult = $con->query($sql1);
        $adrow = $adresult->fetch_assoc();

        $sql2 = "SELECT * FROM `tbl_registration_form` WHERE `status` = '$visible' && `course_id` = '" . $_SESSION["course_id"] . "' && `admission_id` = '$admission_id' ";
        $depresult = $con->query($sql2);
        $deprow = $depresult->fetch_assoc();

        // Query to get the last registration number from tbl_registration_form
        $sql_last_reg = "SELECT `registration_no` FROM `tbl_registration_form` 
WHERE `status` = '$visible' 
AND `course_id` = '" . $_SESSION["course_id"] . "' 
AND `academic_year` = '$academic_year' 
ORDER BY `registration_no` DESC LIMIT 1"; // Get the last registration number
        $last_reg_result = $con->query($sql_last_reg);
        $last_reg_row = $last_reg_result->fetch_assoc();

        $lastRegNo = $last_reg_row['registration_no'] ?? null; // Use null if no rows returned

        $lastNumber = $lastRegNo ? intval(substr($lastRegNo, -3)) : 0; // Assume the last 3 digits are the incrementing part

        // Get the current year
        // $currentYear = date('y');
        $currentYear = 24;
//chnages check
        // ------------------------select course using course_id--------------------------
        $sql_course = "SELECT * FROM `tbl_course`
WHERE `status` = '$visible' 
AND `course_id` = '$course_id'";
        $result_course = $con->query($sql_course);
        $row_course = $result_course->fetch_assoc();

        $course_code = $row_course['course_code'];

        if (strlen($course_code) == 1 && is_numeric($course_code)) {
            // Add '0' as a prefix
            $course_code = '0' . $course_code;
        }

        $newNumber = $lastNumber + 1; // Increment the last number
        $newRegNo = 'NSU' . $currentYear . $course_code . sprintf('%03d', $newNumber); // Format new registration number
        $newRollNo = $currentYear . $course_code . sprintf('%03d', $newNumber); // Format new roll number


        if ($deprow['easebuzzid'] == '' && $deprow['transactionid'] == '') {


            ?>
<div class="form-container" style="margin-top: -36px;">
    <!-- Progress Bar -->
    <div class="progress-bar">
        <div class="step active">1</div>
        <div class="line active"></div>
        <div class="step">2</div>
        <div class="line"></div>
        <div class="step">3</div>
    </div>

    <!-- Step Names -->
    <div class="step-name">
        <div class="name">Personal Details</div>
        <div class="name">Educational Details</div>
        <div class="name">Upload Documents</div>
    </div>
    <form action="registration_confirm" id="multiStepForm" method="post" enctype="multipart/form-data">
        <div class="step-content active">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">PERSONAL DETAILS</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <label>Registration Number</label>
                                <input readonly id="" type=" text" name="registration_no"
                                    class="form-control rounded-pill" required value="<?php echo $newRegNo ?>">
                            </div>

                            <div class="col-4">
                                <label>Roll Number</label>
                                <input id="" type="text" name="roll_no" class="form-control rounded-pill"
                                    value="<?php echo $newRollNo ?>" readonly>
                            </div>

                            <div class="col-4">
                                <input id="" type="hidden" name="course_id" value="<?php echo $_SESSION['course_id'] ?>"
                                    class=" form-control rounded-pill">
                                <input id="" type="hidden" name="academic_year"
                                    value="<?php echo $_SESSION['academic_year'] ?>" class=" form-control rounded-pill">
                                <input id="" type="hidden" name="amount" value="<?php echo $_SESSION['amount'] ?>"
                                    class=" form-control rounded-pill">
                                <label>Candidate's Name</label>
                                <input id="" type="text" name="candidate_name" class="form-control rounded-pill"
                                    value="<?php echo $row['admission_first_name'] . " " . $row['admission_middle_name'] . " " . $row['admission_last_name'] ?>"
                                    readonly>
                                <?php $_SESSION["candidate_name"] = $row['admission_first_name'] . " " . $row['admission_middle_name'] . " " . $row['admission_last_name']; ?>
                            </div>

                            <div class="col-4">
                                <label>Type</label>
                                <input id="" type="text" name="department" class="form-control rounded-pill"
                                    value="Regular" readonly>
                            </div>

                            <div class=" col-4">
                                <label>Category</label>
                                <input id="" type="text" name="category" class="form-control rounded-pill"
                                    value="<?php echo $row['admission_category'] ?>" readonly>
                            </div>

                            <div class=" col-4">
                                <label>Program Type</label>
                                <input id="" type="text" name="category" class="form-control rounded-pill"
                                    value="<?php echo $row['course_id'] ?>">
                            </div>


                            <div class=" col-4">
                                <label>Father's Name</label>
                                <input id="" type="text" name="father_name" class="form-control rounded-pill"
                                    value="<?php echo $row['admission_father_name'] ?>" readonly>
                                <?php $_SESSION["father_name"] = $row['admission_father_name']; ?>
                            </div>
                            <div class=" col-4">
                                <label>Mother's Name</label>
                                <input id="" type="text" name="mother_name" class="form-control rounded-pill"
                                    value="<?php echo $row['admission_mother_name'] ?>" readonly>
                            </div>

                            <div class="col-4">
                                <label>Gender</label>
                                <input id="" type="text" name="gender" class="form-control rounded-pill"
                                    value="<?php echo strtoupper($row['admission_gender']) ?>" readonly>
                            </div>
                            <div class=" col-4">
                                <label>Date Of Birth</label>
                                <input id="" type="text" name="dob" class="form-control rounded-pill"
                                    value="<?php echo date("d/m/Y", strtotime($row['admission_dob'])) ?>">
                            </div>

                            <div class=" col-4">
                                <label>Residence Status</label>
                                <small class='text-muted'>(Village/Town/City)</small>
                                <input id="" type="text" name="residence_status" class="form-control rounded-pill">
                            </div>
                            <div class="col-4">
                                <label>Blood Group</label>
                                <select name="blood" class="form-control rounded-pill">
                                    <option value="<?php echo $row['admission_blood_group'] ?>">
                                        <?php echo $row['admission_blood_group'] ?>
                                    </option>
                                    <option value="" disabled selected>Select Blood Group</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                </select>
                            </div>
                            <div class=" col-4">
                                <label>Marital Status</label>
                                <small class='text-muted'>(Married/Unmarried)</small>
                                <select name="matrial_status" class="form-control rounded-pill">
                                    <option value="" disabled selected>Select Marital Status</option>
                                    <option value="Married">Married</option>
                                    <option value="Unmarried">Unmarried</option>
                                </select>
                            </div>
                            <div class=" col-4">
                                <label>Apaar ID</label>
                                <input id="" type="text" name="abc_id" class="form-control rounded-pill" required>
                            </div>

                            <div class="col-4">
                                <label>Candidate Signature ( <span class="text-danger">max 200kb</span> )</label>
                                <input type="file" onchange="image_check(this, 200)" name="candidate_signature"
                                    class="form-control rounded-pill" required>
                            </div>

                            <style>
                            /* Modal overlay styling */
                            .modal-overlay {
                                display: none;
                                position: fixed;
                                top: 0;
                                left: 0;
                                width: 100%;
                                height: 100%;
                                background: rgba(0, 0, 0, 0.5);
                                /* Semi-transparent background */
                                z-index: 1000;
                                overflow: hidden;
                                /* Prevent background scrolling */
                            }

                            /* Modal content box styling */
                            .modal-content {
                                position: absolute;
                                top: 10%;
                                /* Align the modal at the top */
                                left: 50%;
                                transform: translateX(-50%);
                                /* Horizontally center the modal */
                                background: #fff;
                                padding: 20px;
                                width: 90%;
                                max-width: 500px;
                                /* Max width of modal */
                                border-radius: 8px;
                                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                                z-index: 1001;
                                /* Above the overlay */
                                text-align: left;
                                overflow-y: auto;
                                /* Add scrolling for smaller screens */
                                max-height: 90%;
                                /* Limit height for smaller devices */
                            }

                            /* Close button styling */
                            .modal-close {
                                position: absolute;
                                top: 10px;
                                right: 10px;
                                font-size: 18px;
                                font-weight: bold;
                                cursor: pointer;
                                color: #333;
                            }

                            .modal-close:hover {
                                color: red;
                            }

                            /* Responsive adjustments */
                            @media (max-width: 768px) {
                                .modal-content {
                                    top: 5%;
                                    /* Move modal closer to the top on smaller screens */
                                    width: 95%;
                                    /* Increase the modal width on smaller screens */
                                    padding: 15px;
                                    /* Adjust padding */
                                    max-width: 90%;
                                    /* Ensure modal is not too wide on smaller screens */
                                }
                            }

                            @media (max-width: 480px) {
                                .modal-content {
                                    top: 5%;
                                    /* Move modal even closer to the top on very small screens */
                                    width: 100%;
                                    /* Full width on very small screens */
                                    padding: 10px;
                                    /* Smaller padding */
                                    max-width: 100%;
                                    /* Full width for extremely small screens */
                                }

                                .modal-close {
                                    font-size: 16px;
                                    /* Smaller close button */
                                }
                            }
                            </style>

                            <div class="col-4">
                                <label>Candidate Passport Photo ( <span class="text-danger">max 200kb</span> )</label>
                                <small>
                                    <u> <a href="javascript:void(0);" class="text-danger"
                                            style="font-weight:600;font-style:italic;" onclick="openModal()">Click here
                                            for upload instructions</a></u>
                                </small>
                                <input type="file" onchange="image_check(this, 200); previewImage(this);"
                                    name="passport_photo" class="form-control rounded-pill" required>

                            </div>

                            <!-- Custom Modal -->
                            <div id="uploadInstructionsModal" class="modal-overlay">
                                <div class="modal-content">
                                    <span class="modal-close" onclick="closeModal()">&times;</span>
                                    <h3>Upload Instructions</h3>
                                    <p><strong class="text-danger">Important:</strong> Please ensure the uploaded image
                                        meets the
                                        following
                                        requirements:</p>
                                    <ul>
                                        <li>The image must be a passport-sized photo.</li>
                                        <li>Avoid uploading selfies or stylish photos.</li>
                                        <li>The background should be plain (preferably white).</li>
                                        <li>The file size should not exceed <strong>200kb</strong>.</li>
                                    </ul>
                                    <p>If the uploaded photo does not meet these guidelines, your University
                                        Registration Form will not be
                                        verified & Acceptable.</p>
                                    <p><b>Examples of Acceptable & Not Acceptable photos:</b></p>
                                    <div class="modal-images">
                                        <div>
                                            <img src="./images/acceptable-photo-sample-large.jpg" alt="Acceptable Photo"
                                                style="width: 100%;filter: invert(0);">

                                            <!-- <p>Acceptable</p> -->
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <script>
                            function openModal() {
                                const modal = document.getElementById('uploadInstructionsModal');
                                modal.style.display = 'block';
                                document.body.style.overflow = 'hidden'; // Disable scrolling on the background
                            }

                            function closeModal() {
                                const modal = document.getElementById('uploadInstructionsModal');
                                modal.style.display = 'none';
                                document.body.style.overflow = ''; // Enable scrolling on the background
                            }

                            /* Close modal when clicking outside of it */
                            window.onclick = function(event) {
                                const modal = document.getElementById('uploadInstructionsModal');
                                if (event.target === modal) {
                                    closeModal();
                                }
                            };
                            </script>

                            <div class="col-4">
                                <label>Passport Size Photograph</label><br>
                                <input type="hidden" name="passport_photo" class="form-control rounded-pill"
                                    value="<?php echo $row["admission_profile_image"]; ?>">
                                <img id="profileImagePreview" class="profile-user-img"
                                    src="../images/student_images_new/<?php echo $row["admission_profile_image"]; ?>"
                                    alt="Student profile picture">
                            </div>
                            <script>
                            function image_check(input, maxSizeKB) {
                                const file = input.files[0];
                                if (file && file.size / 1024 > maxSizeKB) {
                                    alert(`File size should be less than ${maxSizeKB}KB`);
                                    input.value = ''; // Reset the input
                                }
                            }

                            function previewImage(input) {
                                const file = input.files[0];
                                if (file) {
                                    const reader = new FileReader();
                                    reader.onload = function(e) {
                                        document.getElementById('profileImagePreview').src = e.target.result;
                                    };
                                    reader.readAsDataURL(file); // Read the file as a data URL
                                }
                            }
                            </script>
                            <div class="col-4">
                                <label>Mobile No.</label>
                                <input id="" type="text" name="mobile_no1" class="form-control rounded-pill"
                                    value="<?php echo $row['admission_mobile_student'] ?>" readonly>
                            </div>
                            <div class=" col-4">
                                <label>Religion</label>
                                <select id="" name="religion" class="form-control rounded-pill">
                                    <option value="<?php echo $row['admission_religion'] ?>">
                                        <?php echo $row['admission_religion'] ?>
                                    </option>
                                    <option value="" disabled selected>Select Religion</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Muslim">Muslim</option>
                                    <option value="Christian">Christian</option>
                                    <option value="Sikh">Sikh</option>
                                    <option value="Buddhist">Buddhist</option>
                                    <option value="Jain">Jain</option>
                                    <option value="Parsi">Parsi</option>
                                    <option value="Jewish">Jewish</option>
                                    <option value="Bahai">Bahai</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class=" col-4">
                                <label>Nationality</label>
                                <input id="" type="text" name="nationality" class="form-control rounded-pill"
                                    value="<?php echo $row['admission_nationality'] ?>" readonly>
                            </div>
                            <div class=" col-4">
                                <label>Email Id (Student)</label>
                                <input id="" type="text" name="email_id" class="form-control rounded-pill"
                                    value="<?php echo $row['admission_emailid_student'] ?>" readonly>
                                <?php $_SESSION["email_id"] = $row['admission_emailid_student']; ?>
                            </div>
                            <div class=" col-4">
                                <label>Mobile No.(01)</label>
                                <input id="" type="text" name="mobile_no1" class="form-control rounded-pill"
                                    value="<?php echo $row['admission_mobile_student'] ?>" readonly>
                                <?php $_SESSION["mobile_no1"] = $row['admission_mobile_student']; ?>
                            </div>
                            <div class=" col-4">
                                <label>Mobile No.(02)</label>
                                <input id="" value="<?php echo $deprow['mobile_no2'] ?>" type="text" name="mobile_no2"
                                    class="form-control rounded-pill">
                            </div>
                            <div class=" col-4">
                                <label>WhatsApp No</label>
                                <input id="" type="text" name="swhatsapp" class="form-control rounded-pill">
                            </div>
                            <div class=" col-4">
                                <label>Parents Mobile No.</label>
                                <input id="" type="text" name="pmob" class="form-control rounded-pill"
                                    value="<?php echo $row['admission_father_phoneno'] ?>">
                            </div>
                            <div class=" col-4">
                                <label>Parents WhatsApp No</label>
                                <input id="" type="text" name="pwhatsapp" class="form-control rounded-pill"
                                    value="<?php echo $row['admission_father_whatsappno'] ?>">
                            </div>
                            <div class=" col-4">
                                <label> Email Id (Parent)</label>
                                <input id="" type="text" name="pmail" class="form-control rounded-pill"
                                    value="<?php echo $row['admission_emailid_father'] ?>">
                            </div>
                            <div class="col-12">
                                <label>Student's Adhar (UID) No.</label>
                                <input id="" type="hidden" name="adhar_no" class="form-control rounded-pill"
                                    value="<?php echo $row['admission_aadhar_no'] ?>">
                                <input id="" type=" text" name="adhar_no" class="form-control rounded-pill"
                                    value="<?php echo $row['admission_aadhar_no'] ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">ADDRESS DETAILS</h3>
                </div>

                <div class="card-body table-responsive p-0">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-12">
                                <label>Parmanent Address:</label>
                                <input id="" type="hidden" name="parnament_adr" class="form-control rounded-pill"
                                    value="<?php echo $row['admission_residential_address'] ?>">
                                <input type=" text" id="address" name="parnament_adr" class="form-control rounded-pill"
                                    value="<?php echo $row['admission_residential_address'] ?>" readonly
                                    style="height: 38px;">
                            </div>
                            <div class="col-4">
                                <label>Dist</label>
                                <input id="" type="text" name="parnament_dist" class="form-control rounded-pill"
                                    value="<?php echo $row['admission_district'] ?>" readonly>
                            </div>

                            <div class=" col-4">
                                <label>Pin No</label>
                                <input id="" type="text" name="parnament_pin" class="form-control rounded-pill"
                                    value="<?php echo $row['admission_pin_code'] ?>" readonly>
                            </div>
                            <div class=" col-4">
                                <label>State</label>
                                <input id="" type="text" name="parnament_state" class="form-control rounded-pill"
                                    value="<?php echo $row['admission_state'] ?>" readonly>
                            </div>
                            <div class=" col-4">
                                <label>Country</label>
                                <input id="" type="text" name="parnament_country" class="form-control rounded-pill"
                                    readonly>
                            </div>
                            <hr>
                            <!-- <div class="col-12">
                                <label>Correspondence Address:</label>

                                <input type="text" id="address" name="corr_adr" class="form-control rounded-pill"
                                    style="height: 38px;">
                            </div>
                            <div class="col-4">
                                <label>Dist</label>
                                <input id="" type="text" name="corr_dist" class="form-control rounded-pill">
                            </div>

                            <div class="col-4">
                                <label>Pin No</label>
                                <input id="" type="text" name="corr_pin" class="form-control rounded-pill">
                            </div>
                            <div class="col-4">
                                <label>State</label>
                                <input id="" type="text" name="corr_state" class="form-control rounded-pill">
                            </div>
                            <div class="col-4">
                                <label>Country</label>
                                <input id="" type="text" name="corr_country" class="form-control rounded-pill">
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Gaurdian & Parent Details</h3>
                </div>

                <div class="card-body table-responsive p-0">
                    <div class="card-body">
                        <p class='text-danger' style="font-weight: 600;"><u>In Case The Candidate Is in Guardianship
                                Other Than Mother & Father,
                                Specify
                                Name and Guardianship.</u></p>
                        <div class="row">
                            <div class="col-4">
                                <label>Gaurdian Name</label>
                                <input id="" type="text" name="guardian_name" class="form-control rounded-pill">
                            </div>
                            <div class="col-4">
                                <label>Gaurdian Relationship</label>
                                <input id="" type="text" name="guardian_relation" class="form-control rounded-pill">
                            </div>
                            <div class="col-4">
                                <label>Father's Occupation</label>
                                <input id="" type="text" name="father_occu" class="form-control rounded-pill">
                            </div>
                            <div class="col-4">
                                <label>Mother's Occupation</label>
                                <input id="" type="text" name="mother_occu" class="form-control rounded-pill">
                            </div>
                            <div class="col-4">
                                <label>Father's Education</label>
                                <input id="" type="text" name="father_edu" class="form-control rounded-pill">
                            </div>
                            <div class="col-4">
                                <label>Mother's Education</label>
                                <input id="" type="text" name="mother_edu" class="form-control rounded-pill">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 2: Educational Details -->
        <div class="step-content">
            <div class=" card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">DETAILS OF EXAMINATION PASSED/APPEARED</h3>
                </div>

                <div class="card-body table-responsive p-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <label>Examination</label>
                                <input id="examination" type="text" name="texamination"
                                    class="form-control rounded-pill" value="10th Secondary" readonly>
                            </div>
                            <div class="col-4">
                                <label>Year of Passing</label>
                                <select id="passing_year" name="tpassing_year" class="form-control rounded-pill">
                                    <?php for ($i = date('Y'); $i >= 1950; $i--): ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="col-4">
                                <label>School/College</label>
                                <input id="school_college" type="text" name="tschool_college"
                                    class="form-control rounded-pill" value="">
                            </div>
                            <div class="col-4">
                                <label>Name of Board</label>
                                <input id="board_name" type="text" name="tboard_name" class="form-control rounded-pill"
                                    value="">
                            </div>
                            <div class="col-4">
                                <label>Max. Marks</label>
                                <input id="max_marks" type="text" name="tmax_marks" class="form-control rounded-pill"
                                    value="">
                            </div>
                            <div class="col-4">
                                <label>Marks Obtained</label>
                                <input id="marks_obtained" type="text" name="tmarks_obtained"
                                    class="form-control rounded-pill" value="">
                            </div>
                            <div class="col-4">
                                <label>% of Marks/Grade</label>
                                <input id="percentage_grade" type="text" name="tpercentage_grade"
                                    class="form-control rounded-pill" value="">
                            </div>
                            <div class="col-4">
                                <label>Medium of Instruction</label>
                                <input id="medium_instruction" type="text" name="tmedium_instruction"
                                    class="form-control rounded-pill" value="">
                            </div>
                            <div class="col-4">
                                <label>Discipline</label>
                                <input id="discipline" type="text" name="tdiscipline" class="form-control rounded-pill"
                                    value="">
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                <label>Examination</label>
                                <input id="examination" type="text" name="twexamination"
                                    class="form-control rounded-pill" value="12th Secondary" readonly>
                            </div>
                            <div class="col-4">
                                <label>Year of Passing</label>
                                <select id="passing_year" name="twpassing_year" class="form-control rounded-pill">
                                    <?php for ($i = date('Y'); $i >= 1950; $i--): ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="col-4">
                                <label>School/College</label>
                                <input id="school_college" type="text" name="twschool_college"
                                    class="form-control rounded-pill" value="">
                            </div>
                            <div class="col-4">
                                <label>Name of Board</label>
                                <input id="board_name" type="text" name="twboard_name" class="form-control rounded-pill"
                                    value="">
                            </div>
                            <div class="col-4">
                                <label>Max. Marks</label>
                                <input id="max_marks" type="text" name="twmax_marks" class="form-control rounded-pill"
                                    value="">
                            </div>
                            <div class="col-4">
                                <label>Marks Obtained</label>
                                <input id="marks_obtained" type="text" name="twmarks_obtained"
                                    class="form-control rounded-pill" value="">
                            </div>
                            <div class="col-4">
                                <label>% of Marks/Grade</label>
                                <input id="percentage_grade" type="text" name="twpercentage_grade"
                                    class="form-control rounded-pill" value="">
                            </div>
                            <div class="col-4">
                                <label>Medium of Instruction</label>
                                <input id="medium_instruction" type="text" name="twmedium_instruction"
                                    class="form-control rounded-pill" value="">
                            </div>
                            <div class="col-4">
                                <label>Discipline</label>
                                <input id="discipline" type="text" name="twdiscipline" class="form-control rounded-pill"
                                    value="">
                            </div>
                        </div>
                        <hr>
                        <!-- ------------------------ -->
                        <div class="row">
                            <div class="col-4">
                                <label>Examination</label>
                                <input id="examination" type="text" name="gexamination"
                                    class="form-control rounded-pill" value="Graduation" readonly>
                            </div>
                            <div class="col-4">
                                <label>Year of Passing</label>

                                <select id="passing_year" name="gpassing_year" class="form-control rounded-pill">
                                    <?php for ($i = date('Y'); $i >= 1950; $i--): ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="col-4">
                                <label>School/College</label>
                                <input id="school_college" type="text" name="gschool_college"
                                    class="form-control rounded-pill" value="">
                            </div>
                            <div class="col-4">
                                <label>Name of Board</label>
                                <input id="board_name" type="text" name="gboard_name" class="form-control rounded-pill"
                                    value="">
                            </div>
                            <div class="col-4">
                                <label>Max. Marks</label>
                                <input id="max_marks" type="text" name="gmax_marks" class="form-control rounded-pill"
                                    value="">
                            </div>
                            <div class="col-4">
                                <label>Marks Obtained</label>
                                <input id="marks_obtained" type="text" name="gmarks_obtained"
                                    class="form-control rounded-pill" value="">
                            </div>
                            <div class="col-4">
                                <label>% of Marks/Grade</label>
                                <input id="percentage_grade" type="text" name="gpercentage_grade"
                                    class="form-control rounded-pill" value="">
                            </div>
                            <div class="col-4">
                                <label>Medium of Instruction</label>
                                <input id="medium_instruction" type="text" name="gmedium_instruction"
                                    class="form-control rounded-pill" value="">
                            </div>
                            <div class="col-4">
                                <label>Discipline</label>
                                <input id="discipline" type="text" name="gdiscipline" class="form-control rounded-pill"
                                    value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label>Examination</label>
                                <input id="examination" type="text" name="postexamination"
                                    class="form-control rounded-pill" value="Post Graduation" readonly>
                            </div>
                            <div class="col-4">
                                <label>Year of Passing</label>
                                <select id="passing_year" name="postpassing_year" class="form-control rounded-pill">
                                    <?php for ($i = date('Y'); $i >= 1950; $i--): ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="col-4">
                                <label>School/College</label>
                                <input id="school_college" type="text" name="postschool_college"
                                    class="form-control rounded-pill" value="">
                            </div>
                            <div class="col-4">
                                <label>Name of Board</label>
                                <input id="board_name" type="text" name="postboard_name"
                                    class="form-control rounded-pill" value="">
                            </div>
                            <div class="col-4">
                                <label>Max. Marks</label>
                                <input id="max_marks" type="text" name="postmax_marks" class="form-control rounded-pill"
                                    value="">
                            </div>
                            <div class="col-4">
                                <label>Marks Obtained</label>
                                <input id="marks_obtained" type="text" name="postmarks_obtained"
                                    class="form-control rounded-pill" value="">
                            </div>
                            <div class="col-4">
                                <label>% of Marks/Grade</label>
                                <input id="percentage_grade" type="text" name="postpercentage_grade"
                                    class="form-control rounded-pill" value="">
                            </div>
                            <div class="col-4">
                                <label>Medium of Instruction</label>
                                <input id="medium_instruction" type="text" name="postmedium_instruction"
                                    class="form-control rounded-pill" value="">
                            </div>
                            <div class="col-4">
                                <label>Discipline</label>
                                <input id="discipline" type="text" name="postdiscipline"
                                    class="form-control rounded-pill" value="">
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <!-- Step 3: Upload Document -->
        <div class="step-content">
            <div class=" card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">UPLOAD DOCUMENTS</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <div class="card-body">
                        <div class="row">
                            <?php
                                        $query = "SELECT * FROM mandatory_documents WHERE program_type = '$program_type'";
                                        $data_result = mysqli_query($con, $query);

                                        if ($data_result) {
                                            if (mysqli_num_rows($data_result) > 0) {
                                                $data = mysqli_fetch_array($data_result);
                                                if ($data['ten_mark'] == 1) {
                                                    echo '<div class="col-4">
                                                <label>10th(High School) Marksheet ( <span class="text-danger">max
                                                        200kb</span> ) </label>
                                                <input type="file" onchange="image_check(this,200)" name="10th_marksheet"
                                                    class="form-control rounded-pill" required>
                                            </div>';
                                                }
                                                if ($data['ten_cert'] == 1) {
                                                    echo '<div class="col-4">
                                                <label>10th(High School) Certificate ( <span class="text-danger">max
                                                        200kb</span> )</label>
                                                <input type="file" onchange="image_check(this,200)" name="10th_certificate"
                                                    class="form-control rounded-pill" required>
                                            </div>';
                                                }
                                                if ($data['twelve_mark'] == 1) {
                                                    echo '<div class="col-4">
                                                <label>12th/Diploma Marksheet(Intermediate) ( <span class="text-danger">max
                                                        200kb</span> )</label>
                                                <input type="file" onchange="image_check(this,200)" name="12th_marksheet"
                                                    class="form-control rounded-pill" required>
                                            </div>';
                                                }
                                                if ($data['twelve_cert'] == 1) {
                                                    echo '<div class="col-4">
                                                <label>12th/Diploma Certificate(Intermediate) ( <span class="text-danger">max
                                                        200kb</span> )</label>
                                                <input type="file" onchange="image_check(this,200)" name="12th_certificate"
                                                    class="form-control rounded-pill" required>
                                            </div>';
                                                }
                                                if ($data['grad_mark'] == 1) {
                                                    echo '  <div class="col-4">
                                                        <label>Bachelor\'s Degree/Equivalent Examination Marksheet ( <span class="text-danger">max 200kb</span> )</label>
                                                        <input type="file" onchange="image_check(this,200)" name="bachelor_marksheet" class="form-control rounded-pill" required>
                                                    </div>';
                                                }
                                                if ($data['grad_cert'] == 1) {
                                                    echo '<div class="col-4">
                                                    <label>Bachelor\'s Degree/Equivalent Degree ( <span class="text-danger">max 200kb</span> )</label>
                                                    <input type="file" onchange="image_check(this,200)" name="bachelor_certificate" class="form-control rounded-pill" required>
                                                </div>';
                                                }
                                                if ($data['mas_mark'] == 1) {
                                                    echo '<div class="col-4">
                                                    <label>Master\'s Degree/Equivalent Examination Marksheet ( <span class="text-danger">max 200kb</span> )</label>
                                                    <input type="file" onchange="image_check(this,200)" name="master_marksheet" class="form-control rounded-pill" required>
                                                </div>';
                                                }
                                                if ($data['mas_cert'] == 1) {
                                                    echo ' 
                                                <div class="col-4">
                                                    <label>Master\'s Degree/Equivalent Degree ( <span class="text-danger">max 200kb</span> )</label>
                                                    <input type="file" onchange="image_check(this, 200)" name="master_certificate" class="form-control rounded-pill" required>
                                                </div>';
                                                }
                                                if ($data['transfer_cert'] == 1) {
                                                    echo ' 
                                                <div class="col-4">
                                                    <label>Transfer certificate(College/School Leaving Certificate) ( <span
                                                            class="text-danger">max
                                                            200kb</span> )</label>
                                                    <input type="file" onchange="image_check(this,200)" name="transfer_certificate"
                                                        class="form-control rounded-pill" required>
                                                </div>';
                                                }
                                                if ($data['migration_cert'] == 1) {
                                                    echo ' 
                                                 <div class="col-4">
                                                    <label>Migration Certificate ( <span class="text-danger">max
                                                            200kb</span> )</label>
                                                    <input type="file" onchange="image_check(this,200)" name="migration_certificate"
                                                        class="form-control rounded-pill" required>
                                                </div>';
                                                }
                                                if ($data['uid_card'] == 1) {
                                                    echo ' 
                                                 <div class="col-4">
                                                    <label>Student Adhar (UID) Card ( <span class="text-danger">max
                                                            200kb</span> )</label>
                                                    <input type="file" onchange="image_check(this,200)" name="adhar_card"
                                                        class="form-control rounded-pill" required>
                                                </div>';
                                                }
                                            } else {
                                                echo "No matching records found.";
                                            }
                                        } else {
                                            echo "Error in query: " . mysqli_error($con);
                                        }
                                        ?>
                        </div>
                    </div>
                </div>
            </div>
            <p> <input type="checkbox" required> Declaration By the Student :</p>
            <p style="font-weight: 600;text-align:justify;font-style: italic;">I hereby declare that I have read and
                understood the instructions
                given above. I also
                affirm that I have submitted all the required numbers of assignment as applicable for the
                aforesaid course
                filled in the examination form and my registration for the course is valid and not time barred.
                If any of my
                statements is found to be untrue, I will have no claim for appearing in the examination. I
                undertake that I
                shall abide by the rules and regulations of the University.</p>

            <tr>
                <td height="40" colspan="8" valign="middle" align="center" class="narmal">
                    <button type="submit" name="submit" class="btn btn-primary" style="float: right;">
                        <i class="fas fa-money-bill-wave"></i> Proceed to Pay
                    </button>
                </td>
            </tr>

        </div>
        <tr>
        </tr>

        <!-- Buttons -->
        <div class="button-group">
            <button type="button" class="prev-btn btn-sm" onclick="nextPrev(-1)">Previous</button>
            <button type="button" class="next-btn btn-sm" onclick="nextPrev(1)">Next</button>
            <!-- <button type="hidden" class="submit-btn">Submit</button> -->
        </div>
    </form>

</div>
<style>
* {
    box-sizing: border-box;
}

/* Progress bar */
.progress-bar {
    background-color: white !important;
    flex-direction: row !important;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
    position: relative;
}

.progress-bar .step {
    width: 40px;
    height: 40px;
    background-color: #e0e0e0;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #fff;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.progress-bar .step.active {
    background-color: #4CAF50;
}

.progress-bar .line {
    flex: 1;
    height: 4px;
    background-color: #e0e0e0;
    margin: 0 8px;
    transition: background-color 0.3s ease;
}

.progress-bar .line.active {
    background-color: #4CAF50;
}

/* Step Names */
.step-name {
    display: flex;
    justify-content: space-between;
    margin-top: 5px;
    font-size: 14px;
    color: #333;
}

.step-name div {
    transition: color 0.3s ease;
}

.step-name div.completed {
    color: #4CAF50;
    font-weight: bold;
}

/* Form Steps */
.step-content {
    display: none;
    opacity: 0;
    transform: translateX(50px);
    transition: opacity 0.5s ease, transform 0.5s ease;
}

.step-content.active {
    display: block;
    opacity: 1;
    transform: translateX(0);
}

.input-group {
    margin-bottom: 15px;
    text-align: left;
}

.input-group label {
    display: block;
    margin-bottom: 5px;
    font-size: 14px;
    color: #333;
}

.input-group input {
    width: 100%;
    padding: 10px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* Buttons */
.button-group {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

.button-group button {
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.button-group .prev-btn {
    background-color: #ccc;
    color: #333;
}

.button-group .next-btn,
.button-group .submit-btn {
    background-color: #4CAF50;
    color: white;
}
</style>
<script>
let currentStep = 0;
const steps = document.querySelectorAll('.step-content');
const progressSteps = document.querySelectorAll('.progress-bar .step');
const progressLines = document.querySelectorAll('.progress-bar .line');
const stepNames = document.querySelectorAll('.step-name .name');

function showStep(step) {
    steps.forEach((el, index) => {
        el.classList.toggle('active', index === step);
    });
    progressSteps.forEach((el, index) => {
        el.classList.toggle('active', index <= step);
    });
    progressLines.forEach((el, index) => {
        el.classList.toggle('active', index < step);
    });
    stepNames.forEach((el, index) => {
        el.classList.toggle('completed', index <= step);
    });
    document.querySelector('.prev-btn').style.display = step === 0 ? 'none' : 'inline';
    document.querySelector('.next-btn').style.display = step === steps.length - 1 ? 'none' : 'inline';
    document.querySelector('.submit-btn').style.display = step === steps.length - 1 ? 'inline' : 'none';
}

function nextPrev(n) {
    if (n === 1 && !validateForm()) return false;
    steps[currentStep].classList.remove('active');
    currentStep += n;
    if (currentStep >= steps.length) {
        document.getElementById("multiStepForm").submit();
        return false;
    }
    showStep(currentStep);
}

function validateForm() {
    const inputs = steps[currentStep].querySelectorAll('input');
    for (let input of inputs) {
        if (!input.checkValidity()) {
            input.reportValidity();
            return false;
        }
    }
    return true;
}

showStep(currentStep);
</script>

<?php

        } else {
            ?>

<h2 class="text-center text-success">Your University Registration Form Successfully Submited</h2>
<div class="container">
    <!-- Print button with icon -->
    <?php
                // ----------------test for print-------------------------------------------------
                $sql3 = "SELECT * FROM `tbl_registration_form` WHERE `admission_id` = '" . $admission_id . "'
    ";
                $result = $con->query($sql3);
                $rowww = $result->fetch_assoc();
                $admission_id = $rowww['admission_id'];
                $academic_year = $rowww['academic_year'];
                $course_id = $rowww['course_id'];
                // ----------------test for print-------------------------------------------------
                ?>
    <form action="print-registration.php" method="POST">
        <input type="hidden" name="academic_year" value="<?= $academic_year ?>">
        <input type="hidden" name="admission_id" value="<?= $admission_id ?>">
        <input type="hidden" name="course_id" value="<?= $course_id ?>">
        <button class="print-button" type="submit">
            <i class="fas fa-print"></i> Print Form
        </button>
    </form>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    integrity="sha512-rmpplb6dJ6t4k57ka6g7p+lWqrxu2lzA6L9gSoL8lHxQ+dpJJKaZI2OyA/d/fzqzV6zNucf2CYIclVX+VXYxpw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
/* Container for centering */
.container {
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Style your button here */
.print-button {
    display: inline-flex;
    align-items: center;
    padding: 10px;
    background-color: #3498db;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

/* Style the icon inside the button */
.print-button i {
    margin-right: 5px;
}
</style>
<?php
        }
    }
    /* ---------- All Admin(Backend) View Codes End ---------- */
    //Action Section End   
}
?>