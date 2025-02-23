<?php
// include file

include_once ('easebuzz-lib/easebuzz_payment_gateway.php');
session_start();

include_once "../../framwork/main.php";
include_once "../../include/function.php";

if (!empty($_POST) && (sizeof($_POST) > 0)) {
    $apiname = trim(htmlentities($_GET['api_name'], ENT_QUOTES));
    $MERCHANT_KEY = "VNQSM82SAE";
    $SALT = "LNRNU85EPI";
    $ENV = "prod";   // setup production enviroment (pay.easebuzz.in).


    // $MERCHANT_KEY = "2PBP7IABZ2";
    // $SALT = "DAH88E3UWQ";
    // $ENV = "text";   // setup TEST++++++++++ enviroment (TEXT.easebuzz.in).

    $easebuzzObj = new Easebuzz($MERCHANT_KEY, $SALT, $ENV);
    $transation_id = $_SESSION['txn_no'];
    if ($_SERVER['HTTP_HOST'] == "localhost") {
        $amount = $_SESSION['amount'] . ".00";
        $furl = "http://localhost/nsucms-aws-latest/student/migration_success";
        $surl = $furl;
    } else {
        $amount = $_SESSION['amount'] . ".00";
        $furl = "https://nsucms.in/nsucms/student/migration_success";
        $surl = $furl;
    }

    $firstname = $_SESSION['migration']['candidate_name'];
    $email = $_SESSION['migration']['email_id'];
    $phone_no = $_SESSION['migration']['mobile'];
    $firstname = $_SESSION['migration']['candidate_name'];
    $email = $_SESSION['migration']['email_id'];
    $phone_no = $_SESSION['migration']['mobile'];

    $admission_id = $_SESSION['migration']['admission_id'];
     $migration_id = $_SESSION['migration']['migration_id'];
    $admission_id = $_SESSION['user']['admission_id'];
    $migration_id = $_SESSION['migration']['migration'];
    $course_name_in_string = get_course($_SESSION['user']['admission_course_name']);
    $session_name_in_string = get_session($_SESSION['user']['admission_session']);



    if ($apiname === "initiate_payment") {
        $postData = array(
            "txnid" => "$transation_id",
            "amount" => "$amount",
            "firstname" => "$firstname",
            "email" => "$email",
            "phone" => "$phone_no",
            "productinfo" => "$admission_id",
            "surl" => "$furl",
            "furl" => "$surl",
            "udf1" => "$admission_id",
            "udf2" => "",
            "udf3" => "",
            "udf4" => "$course_name_in_string",
            "udf5" => "$session_name_in_string",
            "udf6" => "Migration_Form_fee",
            "udf7" => "",
            "address1" => "aaaa",
            "address2" => "aaaa",
            "city" => "aaaa",
            "state" => "aaaa",
            "country" => "aaaa",
            "zipcode" => "123123"
        );

        $easebuzzObj->initiatePaymentAPI($postData);
    } else if ($apiname === "transaction") {

        /*  Very Important Notes
            * 
            * Post Data should be below format.
            *
                Array ( [txnid] => TZIF0SS24C [amount] => 1.03 [email] => test@gmail.com [phone] => 1231231235 )
            */
        $result = $easebuzzObj->transactionAPI($postData);

        easebuzzAPIResponse($result);
    } else if ($apiname === "transaction_date" || $apiname === "transaction_date_api") {

        /*  Very Important Notes
            * 
            * Post Data should be below format.
            *
                Array ( [merchant_email] => jitendra@gmail.com [transaction_date] => 06-06-2018 )
            */
        $result = $easebuzzObj->transactionDateAPI($postData);

        easebuzzAPIResponse($result);
    } else if ($apiname === "refund") {

        /*  Very Important Notes
            * 
            * Post Data should be below format.
            *
                Array ( [txnid] => ASD20088 [refund_amount] => 1.03 [phone] => 1231231235 [email] => test@gmail.com [amount] => 1.03 )
            */
        $result = $easebuzzObj->refundAPI($postData);

        easebuzzAPIResponse($result);
    } else if ($apiname === "payout") {

        /*  Very Important Notes
            * 
            * Post Data should be below format.
            *
               Array ( [merchant_email] => jitendra@gmail.com [payout_date] => 08-06-2018 )
            */
        $result = $easebuzzObj->payoutAPI($postData);

        easebuzzAPIResponse($result);
    } else {

        echo '<h1>You called wrong API, Pleae try again</h1>';
    }
} else {
    echo '<h1>Please fill all mandatory fields.</h1>';
}


/*
 *  Show All API Response except initiate Payment API
 */
function easebuzzAPIResponse($data)
{
    print_r($data);
}