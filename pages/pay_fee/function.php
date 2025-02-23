<?php

function rebate_fine_calculator_by_particular($con, $visible, $studentRegistrationNo, $particular_id)
{
    $fine = 0; //fine variable is used for calculating the total fine for a particular id 

    $sqlTblFeePaid = "SELECT *
            FROM `tbl_fee_paid`
            WHERE `status` = '$visible' AND `student_id` = '$studentRegistrationNo' AND `payment_status` IN ('cleared', 'pending')
            AND rebate_amount!='' ORDER BY `rebate_amount` ASC ";
    $resultTblFeePaid = $con->query($sqlTblFeePaid);

    if ($resultTblFeePaid->num_rows > 0) {

        while ($rowTblFeePaid = $resultTblFeePaid->fetch_assoc()) {

            if ($rowTblFeePaid['rebate_amount'] > 0) {

                $after_expoide_id = explode(",", $rowTblFeePaid['particular_id']);
                $after_PaidAmount = explode(",", $rowTblFeePaid["paid_amount"]);
                // echo "<pre>";
                //  print_r($after_expoide_id);
                for ($i = 0; $i < count($after_expoide_id); $i++) {
                    if ($after_PaidAmount[$i] != '') {
                        if ($particular_id == $after_expoide_id[$i]) {
                            $rebate_fine =  explode(",", $rowTblFeePaid['rebate_amount']);
                            if ($rebate_fine[1] === 'fine') {
                                $fine = $fine + $rebate_fine[0];
                            }
                        }
                    }
                }
            }
        }
    }
    return $fine;
}


function remaining_fine_calculator_by_particular($con, $visible, $studentRegistrationNo, $particular_id)
{
    $fine = 0; //fine variable is used for calculating the total fine for a particular id 

    $sqlTblFeePaid = "SELECT *
            FROM `tbl_fee_paid`
            WHERE `status` = '$visible' AND `student_id` = '$studentRegistrationNo' AND `payment_status` IN ('cleared', 'pending')
            AND remaining_fine!='' ORDER BY `remaining_fine` ASC ";
    $resultTblFeePaid = $con->query($sqlTblFeePaid);

    if ($resultTblFeePaid->num_rows > 0) {

        while ($rowTblFeePaid = $resultTblFeePaid->fetch_assoc()) {

            if ($rowTblFeePaid['remaining_fine'] > 0) {

                $after_expoide_id = explode(",", $rowTblFeePaid['particular_id']);
                $after_PaidAmount = explode(",", $rowTblFeePaid["paid_amount"]);
                for ($i = 0; $i < count($after_expoide_id); $i++) {
                    if ($after_PaidAmount[$i] != '') {
                        if ($particular_id == $after_expoide_id[$i]) {
                            $fine = $rowTblFeePaid['remaining_fine'];
                        }
                    }
                }
            }
        }
    }
    return $fine;
}



//  this function is making for finding the particular paid  fine amount
//  $con -> is the connection object for making the connection with the database
// $student-> visible is the md5 of string "visible"
// $studentRegistration -> number is the student id actully it is stored into the tbl_admission table the id name is 
// student_id
// $particular_id is the main variable for finding the fine for particular send the particulr id and function return for the particular id 
// have any paid fine amount or not if any amout have then return the amount if or it simply retern 0

function fine_calculator_by_particular($con, $visible, $studentRegistrationNo, $particular_id)
{
    $fine = 0; //fine variable is used for calculating the total fine for a particular id 

    $sqlTblFeePaid = "SELECT *
            FROM `tbl_fee_paid`
            WHERE `status` = '$visible' AND `student_id` = '$studentRegistrationNo' AND `payment_status` IN ('cleared', 'pending')
            AND fine!=''";
    $resultTblFeePaid = $con->query($sqlTblFeePaid);

    if ($resultTblFeePaid->num_rows > 0) {

        while ($rowTblFeePaid = $resultTblFeePaid->fetch_assoc()) {

            if ($rowTblFeePaid['fine'] > 0) {

                $after_expoide_id = explode(",", $rowTblFeePaid['particular_id']);
                $after_PaidAmount = explode(",", $rowTblFeePaid["paid_amount"]);

                for ($i = 0; $i < count($after_expoide_id); $i++) {
                    if ($after_PaidAmount[$i] != '') {
                        if ($particular_id == $after_expoide_id[$i]) {
                            $fine = $fine + $rowTblFeePaid['fine'];
                        }
                    }
                }
            }
        }
    }
    return $fine;
}

// fine calculting total
// this function is the so easy function in this function taking 3 arguments
//  $con -> is the connection object for making the connection with the database
// $student-> visible is the md5 of string "visible"
// $studentRegistration -> number is the student id actully it is stored into the tbl_admission table the id name is 
// student_id
function fine_calculator_by_total($con, $visible, $studentRegistrationNo)
{
    $fine = 0; //fine variable is used for calculating the total fine for a particular student 

    $sqlTblFeePaid = "SELECT SUM(fine) as fine
                FROM `tbl_fee_paid`
                WHERE `status` = '$visible' AND `student_id` = '$studentRegistrationNo' AND `payment_status` IN ('cleared', 'pending')
                AND fine!=''";
    $resultTblFeePaid = $con->query($sqlTblFeePaid);

    if ($resultTblFeePaid->num_rows > 0) {
        $rowTblFeePaid = $resultTblFeePaid->fetch_assoc();
        $fine = $rowTblFeePaid['fine'];
    }
    return $fine;
}


function is_hostel_fee_paid($particular_id)
{
    $fine = 0; //fine variable is used for calculating the total fine for a particular id 
    global $con;
    global $studentRegistrationNo;
    global $visible;

    $sqlTblFeePaid = "SELECT *
            FROM `tbl_fee_paid`
            WHERE `status` = '$visible' AND `student_id` = '$studentRegistrationNo' AND `particular_id`  LIKE '%" . $particular_id . "%' AND `payment_status` IN ('cleared', 'pending')";
    $resultTblFeePaid = $con->query($sqlTblFeePaid);

    if ($resultTblFeePaid->num_rows > 0) {

        while ($rowTblFeePaid = $resultTblFeePaid->fetch_assoc()) {
            $after_expoide_id = explode(",", $rowTblFeePaid['particular_id']);
            $after_PaidAmount = explode(",", $rowTblFeePaid["paid_amount"]);

            for ($i = 0; $i < count($after_expoide_id); $i++) {
                if ($after_PaidAmount[$i] > 0) {
                    if ($particular_id == $after_expoide_id[$i]) {
                        $fine = $fine + $after_PaidAmount[$i];
                    }
                }
            }
        }
    }
    return $fine;
}

function is_hostel_leave_date()
{
    global $con;
    global $studentRegistrationNo;
    global $visible;
    $sqlTblFeePaid = "SELECT *
            FROM `tbl_admission`
            WHERE `status` = '$visible' AND `admission_id` = '$studentRegistrationNo' && `hostel_leave_date`!='' && `hostel_leave_date`!='0000-00-00' ";
    $resultTblFeePaid = $con->query($sqlTblFeePaid);
    if ($resultTblFeePaid->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}
