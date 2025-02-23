<?php
include __DIR__ . "../../../framwork/main.php";
$msg = '';
?>

<?php
if (isset($_POST['submit'])) {
        // echo '<pre>';
        // print_r($_POST);
        $staff_data = array();
        $staff_data['id'] = $_POST['id'];
        $staff_data['course_id'] = $_POST['course_id'];
        $staff_data['desg_id'] = $_POST['desg_id'];
        $staff_data['name'] = $_POST['name'];
        $staff_data['phone'] = $_POST['phone'];
        $staff_data['email'] = $_POST['email'];
        $staff_data['date_of_joining'] = $_POST['date_of_joining'];
        $staff_data['date_of_exit'] = $_POST['date_of_exit'];
        // $staff_data['photo'] = $_POST['photo'];
        $staff_data['adhar_no'] = $_POST['adhar_no'];
        // $staff_data['adhar_doc'] = $_POST['adhar_doc'];
        $staff_data['pan_no'] = $_POST['pan_no'];
        // $staff_data['pancard_doc'] = $_POST['pancard_doc'];
        // $staff_data['passbook_doc'] = $_POST['passbook_doc'];
        $staff_data['pf_acc'] = $_POST['pf_acc'];
        $staff_data['account_holder_name'] = $_POST['account_holder_name'];
        $staff_data['bank_name'] = $_POST['bank_name'];
        $staff_data['account_no'] = $_POST['account_no'];
        $staff_data['branch'] = $_POST['branch'];
        $staff_data['ifsc'] = $_POST['ifsc'];
        $staff_data['status'] = 1;

        // echo "<pre>";
        // print_r($staff_data);
       

        if(!empty($_FILES['photo']['name'])){
           $staff_data['photo'] = file_upload($_FILES['photo'], "payroll/include/images", "1024");
             

        }
        if(!empty($_FILES['adhar_doc']['name'])){
        $staff_data['adhar_doc'] = file_upload($_FILES['adhar_doc'], "payroll/include/images", "1024"); 
        }
        if(!empty($_FILES['pancard_doc']['name'])){
        $staff_data['pancard_doc'] = file_upload($_FILES['pancard_doc'], "payroll/include/images", "1024");
         }
        if (!empty($_FILES['passbook_doc']['name'])) {
          $staff_data['passbook_doc'] = file_upload($_FILES['passbook_doc'], "payroll/include/images", "1024");
        }
        
        $result =  updateAll('tbl_staff', $staff_data, ' id=' . $_POST['id'] . '');
        



        if ($result == "success") {
                $msg =  success_alert('Data Updated Successfully');
                echo "<script> window.location.href = 'view_staff.php';</script>";

                
        } else {
                echo $msg = danger_alert($conn->error);
        }

       
}
?>


