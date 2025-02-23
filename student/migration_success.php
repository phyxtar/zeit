<?php
// include file
session_start();
include_once('easebuzz/easebuzz-lib/easebuzz_payment_gateway.php');
include_once('include/config.php');
include "../framwork/main.php";
include "./include/message.php";
date_default_timezone_set("Asia/Calcutta");
$date_variable_today_month_year_with_timing = date("d M, Y. h:i A");
$visible = md5("visible");
// salt for testing env
// $SALT = "M87TPWFJ44";
// $SALT = "DAH88E3UWQ"; //test


//live
 $SALT = "LNRNU85EPI";
//test
//$SALT = "DAH88E3UWQ";
?>
<?php

// Decode Jeson
ini_set("error_reporting", "off");
//include_once('easebuzz-lib/easebuzz_payment_gateway.php');
/*
Enter The SALT 
*/
//$SALT = "M87TPWFJ44";
$easebuzzObj = new Easebuzz($MERCHANT_KEY = null, $SALT, $ENV = null);
//	print_r($_POST);
//echo "<br>";
//	echo $_POST['bank_ref_num'];
$result = $easebuzzObj->easebuzzResponse($_POST);
/*
$result jeson Data
*/
$result = json_decode($result, true);

//echo "<h1>EaseBuzz</h1>"; 
$chk_tx = $result["data"]["status"];


//echo $chk;

if ($chk_tx == "success") {

    $student = array();
    $student['admission_id'] = $result['data']['udf1'];
    // $student['semester_id'] = $result['data']['udf2'];
    $student['transactionid'] = $result['data']['txnid'];
    $student['easebuzzid'] = $result['data']['easepayid'];
    $student['amount'] = $result['data']['net_amount_debit'];
    $student['update_time'] = $result['data']['addedon'];
    $PaymentMode = "Online";
    $cashDepositTo = "University Office";
    $txn_id = $result["data"]["txnid"];
    $bank_name = $result["data"]["bank_name"];
    $txn_date = $result["data"]["addedon"];

    $payment_success = updateAll('tbl_migration_form', $student, '`admission_id`=' . $student['admission_id']  . '');
    if ($payment_success == "success") {

        $_SESSION = fetchRow('tbl_migration_form', '`admission_id`=' . $student['admission_id'] . '');
        $student_msg = "Dear " . $_SESSION["candidate_name"] . ", Thank you for the payment, towards your Migration Form. Regards NSU";
        sendMessage($mobile, $student_msg);

        $student_data = fetchRow('tbl_admission', '`admission_id`=' . $student['admission_id'] . '');

        $income = array();
        $income['reg_no'] = $student['admission_id'] . "(Reg No)";
        $income['course'] = $student_data['admission_course_name'];
        $income['academic_year'] = $student_data['admission_session'];
        $income['received_date'] = $student['update_time'];
        $income['particulars'] = "Migration Form";
        $income['amount'] = $student['amount'];
        $income['payment_mode'] = $PaymentMode;
        $income['check_no'] = '0';
        $income['bank_name'] = $bank_name;
        $income['income_from'] = 'Migration Application Form';
        $income['post_at'] = $paymentDate;
        $income['table_name'] = 'tbl_migration_form';
        $income['table_id'] = $_SESSION['migration_id'];
        $final_result = insertAll('tbl_income', $income);

    }


    ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NETAJI SUBHAS UNIVERSITY | Migration Application Form Details </title>
    <!-- Fav Icon -->
    <link rel="icon" href="images/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <style>
    .main-footer {
        margin-left: 0px !important;
    }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div style="margin-left: 30%;">
        <img style="position: absolute; opacity: 0.2;" class="img-fluid" src="images/logo.png" alt="">
    </div>
    <div class="wrapper">
        <div class="page-wrapper" id="div1">



            <!-- end inner-banner -->
            <section class="course mt-5">
                <div class="container">
                    <div class="sec-title text-center mb-3 aos-init aos-animate" data-aos="fade-up"
                        data-aos-duration="1000">
                        <h2>Migration Form Fee Payment Details</h2>
                        <div class="divider"> <span class="fa fa-mortar-board"></span> </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-12">

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">Registration No</label>
                                    <input name="" class="form-control"
                                        value="<?php echo $_SESSION['registration_no'] ?>" type="text" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Email Address</label>
                                    <input id="placement_contact_email" value="<?php echo $_SESSION['email_id'] ?>"
                                        class="form-control" placeholder="Enter Email" type="email" readonly>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="">Course </label>
                                    <input id="placement_contact_phone"
                                        value="<?= fetchRow('tbl_course', '`course_id`=' . $_SESSION['course_id'] . '')['course_name'] ?>"
                                        class="form-control" placeholder="Enter Number" type="text" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Session</label>
                                    <input
                                        value="<?= fetchRow('tbl_university_details', '`university_details_id`=' . $_SESSION['academic_year'] . '')['academic_session'] ?>"
                                        class="form-control" placeholder="" type="text" readonly>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="">Phone Number</label>
                                    <input id="placement_contact_phone" value="<?php echo $_SESSION['mobile'] ?>"
                                        class="form-control" placeholder="Enter Number" type="text" readonly>
                                </div>


                                <div class="form-group col-md-6">
                                    <label for="">Amount</label>
                                    <input id="placement_contact_phone" value="<?php echo $_SESSION["amount"]; ?>"
                                        class="form-control" placeholder="Enter Number" type="text" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Transaction ID</label>
                                    <input value="<?php echo $_SESSION["transactionid"]; ?>" class="form-control"
                                        placeholder="Enter Designation" type="text" readonly>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="">Easebuzz ID</label>
                                    <input type="text" value="<?php echo $_SESSION["easebuzzid"]; ?>"
                                        class="form-control" placeholder="Request For Information" readonly>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </section>

        </div>

        <script type="text/javascript">
        function printContent(e) {
            e.style.display = "none"
            print();
            location.replace(window.location.href)
        }
        </script>

        <?php
} elseif ($chk_tx == "userCancelled") {
    # code...
    echo "<hr>";
    echo "<br> Transaction Details:-";
    echo "<br> Status    :" . $result["data"]["status"];
    echo "<br> Name      :" . $result["data"]["firstname"];
    echo "<br> Name On Card     :" . $result["data"]["name_on_card"];
    echo "<br> Email     :" . $result["data"]["email"];
    echo "<br> Amount    :" . $result["data"]["amount"];
    echo "<br> Transaction Id    :" . $result["data"]["txnid"];
    echo "<br> EaseBuzz Pay Id    :" . $result["data"]["easepayid"];
} else {
    /*
 // Failure  Code..
  As Per Your Need
 */
    echo "<hr>";
    echo "<br> Transaction Details ";
    echo '<p><font color="red">';
    echo "<br> <b>Error    :" . $result["data"]["error_Message"] . "</b>";
    echo "</font></p>";
}
?>
        <div class="text-center mb-4 mt-3">
            <button onclick="printContent(this)" id="print" class="text-center btn btn-sm btn-primary">Print</button>
        </div>
        <div class="text-center">
            <?php include_once('include/footer.php'); ?>
        </div>
    </div>

</body>