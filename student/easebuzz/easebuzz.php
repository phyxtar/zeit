<?php
// include file
include_once('easebuzz-lib/easebuzz_payment_gateway.php');
include_once "../../framwork/main.php";
include_once "../../include/function.php";

if (isset($_GET) && $_GET['api_name'] == 'initiate_payment') {
    if($_SESSION['total_amount']<=0){
        redirect('student/payfee');
    }
    $transation_id = $_POST['txnid'];
    $firstname = $_SESSION['user']['admission_first_name'] . ' ' . $_SESSION['user']['admission_middle_name'] . ' ' . $_SESSION['user']['admission_last_name'];
    $admission_id = $_SESSION['user']['admission_id'];
    $course_name = $_SESSION["course_name"];
    $email = $_SESSION["admission_emailid_student"];
    $phone = $_SESSION["admission_mobile_student"];
    $reg_no = $_SESSION['user']['admission_id'];
    $furl = "https://nsucms.in/nsucms/student/success";
    $surl = $furl;
    $particular_remaining_amount_session = implode(',', $_SESSION['particular_remaining_amount_session']);
    $particular_paid_id_seesion = implode(',', $_SESSION['particular_paid_id_seesion']);
    $particular_fine_session =  implode(',', $_SESSION['particular_fine_session']);

    if ($_SERVER['HTTP_HOST'] == 'localhost') {
        $amount = '1.0';
        global $project_name;
        $furl = "http://localhost/".$project_name."/student/success";
        $surl = $furl;
    } else {
        $amount = $_SESSION['total_amount'] . '.0';
    }

    $course_name_in_string = get_course($_SESSION['user']['admission_course_name']);
    $session_name_in_string = get_session($_SESSION['user']['admission_session']);


    $postData = array(
        "txnid" => "$transation_id",
        "amount" => "$amount",
        "firstname" => "$firstname",
        "email" => "$email",
        "phone" => "$phone",
        "productinfo" => "$reg_no",
        "surl" => "$surl",
        "furl" => "$furl",
        "udf1" => "$particular_remaining_amount_session",
        "udf2" => "$particular_paid_id_seesion",
        "udf3" => "$particular_fine_session",
        "udf4" => "$course_name_in_string",
        "udf5" => "$session_name_in_string",
        "udf6" => "student_semester_fee",
        "udf7" => "$admission_id",
        "address1" => "aaa",
        "address2" => "aaa",
        "city" => "aaaa",
        "state" => "aaaa",
        "country" => "aaaa",
        "zipcode" => "123123",

    );

    // print_r($postData);

     /*
        * There are three approch to call easebuzz API.
        *
        * 1. using hidden api_name which is $_POST from form.
        * 2. using pass api_name into URL.
        * 3. using extract html file name then based on file name call API.
        *
        */

    // first way
    // $apiname = trim(htmlentities($_POST['api_name'], ENT_QUOTES));

    // second way
    $apiname = trim(htmlentities($_GET['api_name'], ENT_QUOTES));

    // third way
    // $url_link = $_SERVER['HTTP_REFERER'];
    // $apiname = explode('.', ( end( explode( '/',$url_link) ) ) )[0];
    // $apiname = trim(htmlentities($apiname, ENT_QUOTES));


    /*
        * Based on API call change the Merchant key and salt key for testing(initiate payment).
        */
    // $MERCHANT_KEY = "2PBP7IABZ2"; //setup test enviroment
    // $SALT = "DAH88E3UWQ"; //setup test enviroment
    // $ENV = "test";    // setup test enviroment (testpay.easebuzz.in). 

    $MERCHANT_KEY = "VNQSM82SAE";
     $SALT = "LNRNU85EPI";
     $ENV = "prod";   // setup production enviroment (pay.easebuzz.in).

    $easebuzzObj = new Easebuzz($MERCHANT_KEY, $SALT, $ENV);

    // print_r("*********test1");

    if ($apiname === "initiate_payment") {

        /*  Very Important Notes
            * 
            * Post Data should be below format.
            *
                Array ( [txnid] => T3SAT0B5OL [amount] => 100.0 [firstname] => jitendra [email] => test@gmail.com [phone] => 1231231235 [productinfo] => Laptop [surl] => http://localhost:3000/response.php [furl] => http://localhost:3000/response.php [udf1] => aaaa [udf2] => aa [udf3] => aaaa [udf4] => aaaa [udf5] => aaaa [address1] => aaaa [address2] => aaaa [city] => aaaa [state] => aaaa [country] => aaaa [zipcode] => 123123 ) 
            */

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