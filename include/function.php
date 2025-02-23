<?php
function get_branch($id)
{
    return fetchRow('tbl_branch', 'id=' . $id . '')['branch_name'];
}

function get_course($id)
{
    return fetchRow('tbl_course', 'course_id=' . $id . '')['course_name'];
}

function get_session($id)
{
    $row_ac_year = fetchRow('tbl_university_details', 'university_details_id=' . $id . '');
    return date("Y", strtotime($row_ac_year["university_details_academic_start_date"])) . ' - ' . date("Y", strtotime($row_ac_year["university_details_academic_end_date"]));
}

function get_staff($id)
{
    return fetchRow('tbl_staff', 'id=' . $id . '')['name'];
}


// all function for income data show 


function get_rebate($paid_id)
{

    $income_data = fetchRow('tbl_fee_paid', ' feepaid_id="' . $paid_id . '"')['rebate_amount'];
}

function get_paid_amount($paid_id)
{
}

function get_particular($paid_id)
{
}

function get_building($id)
{
    return fetchRow('hostel_building', 'id=' . $id . '')['name'];
}

function get_permission($page_no_temp, $page, $admin_id = 0)
{
    global $visible;
    if ($admin_id == 0) {
        global $id;
    } else {
        $id = $admin_id;
    }
    $row = fetchRow('tbl_admin', '`status` = "' . $visible . '" && `admin_id`=' . $id . '');
    $autority = $row["admin_permission"];
    $allAutority = json_decode($autority);

    if (isset($autority)) {

        $flag = 0;
        if (isset($allAutority->$page_no_temp)) {
            $subMenus = explode("||", $allAutority->$page_no_temp);
            for ($i = 0; $i < count($subMenus); $i++) {
                if ($subMenus[$i] == $page) {
                    $flag = "checked";
                    break;
                }
            }
        }
    }
    return $flag;
}
// getting the total fee amount from fee paid table 
function get_paid_amount_year($start, $end)
{
    global $visible;
    $total_fee = 0;

    $result = fetchResult('tbl_fee_paid', ' cash_date BETWEEN "' . $start . '" AND "' . $end . '" && `status`="' . $visible . '"');
    while ($fee = mysqli_fetch_assoc($result)) {
        $after_expoide_id = explode(",", $fee['particular_id']);
        $after_PaidAmount = explode(",", $fee["paid_amount"]);

        for ($i = 0; $i < count($after_expoide_id); $i++) {
            if ($after_PaidAmount[$i] != '') {
                $total_fee = $total_fee + $after_PaidAmount[$i];
            }
        }
    }
    return   $total_fee;
}

// getting the fine year wise
function get_paid_fine_year($start, $end)
{
    global $visible;
    $total_fine = get_sum('tbl_fee_paid', 'fine', ' cash_date BETWEEN "' . $start . '" AND "' . $end . '" && `status`="' . $visible . '"');
    return   round($total_fine);
}

function get_prospectus_amount_year($start, $end)
{
    global $visible;
    $prospectus_rate = get_sum('tbl_prospectus', 'prospectus_rate', ' transaction_date BETWEEN "' . $start . '" AND "' . $end . '" && `status`="' . $visible . '"');
    return  round($prospectus_rate);
}
function get_exam_form_amount($start, $end)
{
    global $visible;
    $total_exam_form_amount = get_sum('tbl_examination_form', 'amount', ' created_time BETWEEN "' . $start . '" AND "' . $end . '" && `status`="' . $visible . '"');
    return  round($total_exam_form_amount);
}

function get_extra_income($start, $end)
{
    global $visible;
    $extra_income = get_sum('tbl_extra_income', 'amount', ' received_date BETWEEN "' . $start . '" AND "' . $end . '" && `status`="' . $visible . '"');
    return  round($extra_income);
}
function overall_income($start, $end)
{
    $paid_fine = get_paid_fine_year($start, $end);
    $prospectus_amount = get_prospectus_amount_year($start, $end);
    $paid_amount = get_paid_amount_year($start, $end);
    $extra_income = get_extra_income($start, $end);
    $exam_form_amount = get_exam_form_amount($start, $end);
    $overall_total = $paid_fine + $prospectus_amount  + $paid_amount + $extra_income + $exam_form_amount;
    return $overall_total;
}

function get_particular_name($particular_id)
{
    global $visible;
    $data = fetchRow('tbl_fee', ' status = "' . $visible . '" && fee_id="' . $particular_id . '"');
    return $data['fee_particulars'];
}
