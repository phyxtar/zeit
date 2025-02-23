<?php
//include_once  "../include/head.php";
include_once  __DIR__ . "../../../framwork/main.php";
$msg = '';
?>

<?php
if (isset($_POST['submit'])) {

        // echo "<pre>";
        // print_r($_POST);
       
        
        $staff_data = array();
        
        $staff_data['course_id'] = $_POST['course_id'];
        $staff_data['desg_id'] = $_POST['desg_id'];
        $staff_data['name'] = $_POST['name'];
        $staff_data['phone'] = $_POST['phone'];
        $staff_data['email'] = $_POST['email'];
        $staff_data['date_of_joining'] = $_POST['date_of_joining'];
        $staff_data['date_of_exit'] = $_POST['date_of_exit'];
        $staff_data['adhar_no'] = $_POST['adhar_no'];
        $staff_data['pan_no'] = $_POST['pan_no'];
        $staff_data['pf_acc'] = $_POST['pf_acc'];
        $staff_data['account_holder_name'] = $_POST['account_holder_name'];
        $staff_data['bank_name'] = $_POST['bank_name'];
        $staff_data['account_no'] = $_POST['account_no'];
        $staff_data['branch'] = $_POST['branch'];
        $staff_data['ifsc'] = $_POST['ifsc'];
        $staff_data['basic_salary'] = $_POST['basic_salary'];
        $staff_data['fooding_allowance'] = $_POST['fooding_allowance'];
        $staff_data['hra'] = $_POST['hra'];
        $staff_data['mobile_allowance'] = $_POST['mobile_allowance'];
        $staff_data['transbortation_allowance'] = $_POST['transbortation_allowance'];
        $staff_data['medical_allownce'] = $_POST['medical_allownce'];
        $staff_data['accomodation'] = $_POST['accomodation'];
        $staff_data['cut_from'] = $_POST['cut_from'];
        $staff_data['pf_emp'] = $_POST['pf_emp'];
        $staff_data['pf_cmp'] = $_POST['pf_cmp'];
        $staff_data['esic_emp'] = $_POST['esic_emp'];
        $staff_data['esic_cmp'] = $_POST['esic_cmp'];
        $staff_data['total_salary'] = $_POST['total_salary'];
        $staff_data['net_salary'] = $_POST['net_salary'];

        $staff_data['status'] = 1;

        // echo "<pre>";
        // print_r($staff_data);

        $staff_data['photo'] = file_upload($_FILES['photo'], "payroll/include/images", "1024");
        $staff_data['adhar_doc'] = file_upload($_FILES['adhar_doc'], "payroll/include/images", "1024"); 
        $staff_data['pancard_doc'] = file_upload($_FILES['pancard_doc'], "payroll/include/images", "1024"); 
        $staff_data['passbook_doc'] = file_upload($_FILES['passbook_doc'], "payroll/include/images", "1024"); 
        $staff_data['cancel_cheque'] = file_upload($_FILES['cancel_cheque'], "payroll/include/images", "1024"); 
        

        $result =  insertAll('tbl_staff', $staff_data);

        if ($result == "success") {
                $msg =  success_alert('Data Added Successfully');
                echo "<script> window.location.href = 'view_staff.php';</script>";

                //redirect('view_staff');
                //header('Location: view_staff.php');

                 //reload(1);
        } else {
                echo $msg = danger_alert($conn->error);
        }
}
?>


