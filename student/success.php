<?php
// include file
session_start();
include_once('easebuzz//easebuzz-lib/easebuzz_payment_gateway.php');
include_once('include/config.php');
include "../framwork/main.php";
$visible = md5("visible");
date_default_timezone_set("Asia/Calcutta");
$date_variable_today_month_year_with_timing = date("d M, Y. h:i A");
// salt for testing env
//   $SALT = "M87TPWFJ44";

// 	//live
$SALT = "LNRNU85EPI";
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
//print_r($result);
$result = json_decode($result, true);

//echo "<h1>EaseBuzz</h1>"; 
$chk_tx = $result["data"]["status"];

$txn_id = $result["data"]["txnid"];
$transation = fetchRow('tbl_fee_paid', '`transaction_no`=' . $txn_id . '');

if ($chk_tx == "success" && $transation == '') {
    $student_id = $result["data"]["productinfo"];
    $student_data = fetchRow('tbl_admission', '`admission_id`=' . $student_id . '');
    $academicYear = $student_data['admission_session'];
    $course_id = $student_data['admission_course_name'];
    $txn_id = $result["data"]["txnid"];
    $bank_name = $result["data"]["bank_name"];
    $txn_date = $result["data"]["addedon"];
    $PaymentMode = "Online";
    $cashDepositTo = "NA";
    $paidDate = date('Y-m-d');
    $paymentDate = date('Y-m-d');
    $university_details_id = $student_data['admission_session'];
    $all_fee_amount =  $result["data"]["udf1"];
    $all_fee_id = $result["data"]["udf2"];
    $all_fine_amount = $result["data"]["udf3"];
  
    // getting the student details form admission tables
    // fee paid
    $fee_paid = array();
    $fee_paid['student_id'] = $student_id;
    $fee_paid['course_id'] = $course_id;

    $fee_paid['rebate_amount'] = '0';
    $fee_paid['extra_fine'] = '0';
    $fee_paid['balance'] = '0';
    $fee_paid['payment_mode'] = $PaymentMode;
    $fee_paid['cash_deposit_to'] = $cashDepositTo;
    $fee_paid['cash_date'] = $paymentDate;
    $fee_paid['notes'] = 'payment Done';
    $fee_paid['receipt_date'] = $paymentDate;
    $fee_paid['bank_name'] = $bank_name;
    $fee_paid['transaction_no'] = $txn_id;
    $fee_paid['transaction_date'] = $txn_date;

    $fee_paid['paid_on'] = $paymentDate;
    $fee_paid['university_details_id'] = $university_details_id;
    $fee_paid['fee_paid_time'] = $date_variable_today_month_year_with_timing;

    $fee_paid['payment_status'] = 'cleared';
    $fee_paid['print_generated_by'] = "Student: " . $student_data['admission_first_name'] . " " . $student_data['admission_middle_name'];
    $fee_paid['status'] = $visible;

    // for income table insertion
    $all_fee_amount_explode = explode(',', $all_fee_amount);
    $all_fee_id_explode = explode(',', $all_fee_id);
    $all_fine_amount_explode = explode(',', $all_fine_amount);

    for ($i = 0; $i < count($all_fee_amount_explode); $i++) {
        if ($all_fee_amount_explode[$i] > 0 && $all_fee_amount_explode[$i] != '') {
            // inserting the data into tbl fee paid
            $receipt_no = fetchRow("tbl_fee_paid", ' 1 ORDER BY feepaid_id DESC')['feepaid_id'];
            $fine_amount=$all_fine_amount_explode[$i];
            $fee_paid['fine'] = $fine_amount;
            $fee_paid['remaining_fine'] = $fine_amount;
            $fee_paid['receipt_no'] = 'NSU_' . ($receipt_no + 1);
            $fee_paid['particular_id'] = $all_fee_id_explode[$i];
            $fee_paid['paid_amount'] = $all_fee_amount_explode[$i];
            // $fee_paid_id = insertGetId('tbl_fee_paid', $fee_paid, 'feepaid_id');

            $income = array();
            $income['reg_no'] = $student_id . "(Reg No)";
            $income['course'] = $course_id;
            $income['academic_year'] = $university_details_id;
            $income['received_date'] = $paymentDate;
            $income['particulars'] = fetchRow('tbl_fee', '`fee_id`=' . $all_fee_id_explode[$i] . '')['fee_particulars'];
            $income['amount'] = $all_fee_amount_explode[$i];
            $income['payment_mode'] = $PaymentMode;
            $income['check_no'] = '0';
            $income['bank_name'] = $bank_name;
            $income['income_from'] = 'Fee';
            $income['post_at'] = $paymentDate;
            $income['table_name'] = 'fee_paid';
            $income['table_id'] = $fee_paid_id;

            // $final_result =  insertAll('tbl_income', $income);
        }
    }

    $result = $easebuzzObj->transactionAPI($_POST);
}
if ($chk_tx == "success") {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>NETAJI SUBHAS UNIVERSITY | Student Fee Details </title>
        <!-- Fav Icon -->
        <link rel="icon" href="images/logo.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Select2 -->
        <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
        <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/adminlte.min.css">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    </head>

    <body class="hold-transition sidebar-mini">
        <div class="wrapper">

            <?php include 'include/navbar.php'; ?>
            <?php include 'include/aside.php'; ?>
            <style type="text/css" media="print">
                @page {
                    size: auto;
                    /* auto is the initial value */
                    margin: 0;
                    /* this affects the margin in the printer settings */
                }
            </style>

            <div class="page-wrapper" id="div1">
                <section class="inner-banner" style="background: url('assets/images/header-bg.png'); background-position:top; background-size:cover;">
                </section>
                <!-- end inner-banner -->
                <section class="course">
                    <div class="container">
                        <div class="sec-title text-center mb-3 aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000">
                            <h2>Payment Details</h2>
                            <div class="divider"> <span class="fa fa-mortar-board"></span> </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-8 col-md-12">

                                <div class="career-form p-5 aos-init aos-animate" data-aos="zoom-in" data-aos-duration="1000">
                                    <div class="border-line"></div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="">Registration No</label>
                                            <input name="" class="form-control" value="<?php echo $_SESSION['registrationNumber'] ?>" type="text" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Email Address</label>
                                            <input id="placement_contact_email" value="<?php echo $_SESSION['admission_emailid_student'] ?>" class="form-control" placeholder="Enter Email" type="email" readonly>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="">Phone Number</label>
                                            <input id="placement_contact_phone" value="<?php echo $_SESSION['admission_mobile_student'] ?>" class="form-control" placeholder="Enter Number" type="text" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Enquiry</label>
                                            <input value="Fee" class="form-control" placeholder="" type="text" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="">Amount</label>
                                            <input id="placement_contact_phone" value="<?php echo $result["data"]["amount"]; ?>" class="form-control" placeholder="Enter Number" type="text" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Transaction ID</label>
                                            <input value="<?php echo $result["data"]["txnid"]; ?>" class="form-control" placeholder="Enter Designation" type="text" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row">



                                        <div class="form-group col-md-6">
                                            <label for="">Easebuzz ID</label>
                                            <input type="text" value="<?php echo $result["data"]["easepayid"]; ?>" class="form-control" placeholder="Request For Information" readonly>
                                        </div>
                                    </div>
                                    <button onclick="printContent('div1')" style="float:right;">Print</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <script type="text/javascript">
                function printContent(e1) {
                    var restorepage = document.body.innerHTML;
                    var printContent = document.getElementById(e1).innerHTML;
                    document.body.innerHTML = printContent;
                    window.print();
                    document.body.innerHTML = restorepage;
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
        <?php include_once('include/footer.php'); ?>
        </div>
    </body>