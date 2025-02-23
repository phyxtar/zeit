<?php
include '../../framwork/main.php';
$data = json_encode($_POST);
$visible = md5('visible');
$date_variable_today_month_year_with_timing = date("d M, Y. h:i A");
$result['data'] = json_decode($data, true);
$chk_tx = $result["data"]["status"];
$txnid = $result["data"]["txnid"];
$transation = fetchRow('tbl_fee_paid', '`transaction_no`=' . $txnid . '');
$transation_from = $result["data"]["udf6"];

if ($transation == '' && $transation_from=='student_semester_fee') {
    //echo $chk;
    // $success = false;
    if ($chk_tx == "success") {
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
        $fee_paid['remaining_fine'] = $fine_amount;
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
                // here i have inserting the fine into the database
                $fine_amount = $all_fine_amount_explode[$i];
                $fee_paid['fine'] = $fine_amount;
                $fee_paid['remaining_fine'] = $fine_amount;
                // fine insertion end here
                $fee_paid['receipt_no'] = 'NSU_' . ($receipt_no + 1);
                $fee_paid['particular_id'] = $all_fee_id_explode[$i];
                $fee_paid['paid_amount'] = $all_fee_amount_explode[$i];
                $fee_paid_id = insertGetId('tbl_fee_paid', $fee_paid, 'feepaid_id');

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
                $final_result =  insertAll('tbl_income', $income);
            }
        }
    }
}