<?php
$page_no = "16";
$page_no_inside = "16_2";
include_once "../include/authentication.php";
include_once "../include/head.php";
include_once "../include/config.php";
//include __DIR__ . "../../../framwork/main.php";
$msg = '';
$staff_id = $_GET['id'];
$visible = md5("visible");

//Get class Name
$row =  fetchRow('tbl_staff', '`id`=' . $staff_id . '');

?>



<div class="main-panel">
        <div class="content-wrapper">
                <section class="content-header">
                        <div class="container-fluid">
                                <div class="row mb-2">
                                        <div class="col-sm-6">
                                                <h1>Employee Management</h1>
                                        </div>

                                        <div class="col-sm-6">
                                                <ol class="breadcrumb float-sm-right">
                                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                                        <li class="breadcrumb-item active">Employee Management</li>
                                                </ol>
                                        </div>
                                </div>
                        </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
                        <div class="container-fluid">
                                <!-- SELECT2 EXAMPLE -->
                                <div class="card card-default">
                                        <div class="card-header">
                                                <h3 class="card-title">Edit Employee</h3>
                                                <?= $msg ?>
                                        </div>
                                        <form action="update.php" role="form" method="POST" enctype="multipart/form-data">

                                                <div class="card-body">
                                                        <div class="row">
                                                                <div class="col-md-12" id="error_section"></div>
                                                                <input type="hidden" name="id" value="<?= $staff_id; ?>">

                                                                <div class="col-4">
                                                                        <label>Select Course</label>

                                                                        <select name="course_id" class="form-control">
                                                            <?php
                                                            $sql_c = "SELECT * FROM `tbl_course`
                                                                                       WHERE `status` = '$visible';
                                                                                       ";
                                                            $result_c = $con->query($sql_c);
                                                            while ($row_c = $result_c->fetch_assoc()) {
                                                            ?>
                                                                <option value="<?php echo $row_c["course_id"]; ?>" <?php if ($row_c["course_id"] == $row["course_id"]) echo 'selected'; ?>><?php echo $row_c["course_name"]; ?></option>
                                                            <?php } ?>
                                                        </select>

                                                                        <!-- <select name="course_id" class="form-control">
                                                                                <option value="">Select Course</option>
                                                                                <?php
                                                                                $sql = "SELECT * FROM `tbl_course`";
                                                                                $result = $con->query($sql);
                                                                                while ($course_row = $result->fetch_assoc()) { ?>
                                                                                        <option value="<?= $course_row['course_id'] ?>"><?= $course_row['course_name'] ?></option>

                                                                                <?php } ?>
                                                                        </select> -->
                                                                </div>



                                                                <div class="col-4">
                                                                        <label>Select Employee Type</label>

                                                                        <select name="desg_id" class="form-control">
                                                                                <option value="">Select</option>
                                                            <?php
                                                            $sql_c = "SELECT * FROM `tbl_designation`
                                                                                      
                                                                                       ";
                                                            $result_c = $con->query($sql_c);
                                                            while ($row_c = $result_c->fetch_assoc()) {
                                                            ?>
                                                                <option value="<?php echo $row_c["id"]; ?>" <?php if ($row_c["id"] == $row["desg_id"]) echo 'selected'; ?>><?php echo $row_c["designation"]; ?></option>
                                                            <?php } ?>
                                                        </select>

                                                                        <!-- <select name="course_id" class="form-control">
                                                                                <option value="">Select Course</option>
                                                                                <?php
                                                                                $sql = "SELECT * FROM `tbl_designation`";
                                                                                $result = $con->query($sql);
                                                                                while ($course_row = $result->fetch_assoc()) { ?>
                                                                                        <option value="<?= $course_row['id'] ?>"><?= $course_row['designation'] ?></option>

                                                                                <?php } ?>
                                                                        </select> -->
                                                                </div>


                                                                <div class="col-4">
                                                                        <label>Name</label>
                                                                        <input type="text" class="form-control" name="name" value="<?= $row['name'] ?>">
                                                                </div>

                                                                <div class="col-4">
                                                                        <label>Phone No.</label>
                                                                        <input type="text" class="form-control" id="" name="phone" value="<?= $row['phone'] ?>">

                                                                </div>

                                                                <div class="col-4">
                                                                        <label>Email</label>
                                                                        <input type="text" class="form-control" name="email" value="<?= $row['email'] ?>">
                                                                </div>

                                                                 <div class="col-4">
                                                                        <label for=""><strong>Profile Image:</strong></label>
                                                                        <input class="form-control" name="photo" id="image" type="file">

                                                                </div>
                                                                 <div class="col-4">
                                                                        <img src="../../payroll/include/images/<?= $row['photo'] ?>" id="photoBrowser" style="margin-top:17px;margin-left:4px;border:solid 1px lightgray" width="120" height="120">
                                                                </div> 

                                                                <div class="col-4">
                                                                        <label for=""><strong>Date of Joining:</strong></label>
                                                                        <input class="form-control" name="date_of_joining" id="" type="date" value="<?= $row['date_of_joining'] ?>">
                                                                </div>

                                                                <div class="col-4">
                                                                        <label for=""><strong>Date of Leaving:</strong></label>
                                                                        <input class="form-control" name="date_of_exit" id="" type="date" value="<?= $row['date_of_exit'] ?>">
                                                                </div>



                                                        </div>
                                                </div>
                               

                                <div class="card card-secondary">
                                        <div class="card-header">
                                                <h3 class="card-title">Documents</h3>
                                        </div>

                                        <div class="card-body table-responsive p-0">
                                                <div class="card-body">
                                                        <div class="row">
                                                                <div class="col-4">
                                                                        <label>Adhar No</label>
                                                                        <input id="" type="text" name="adhar_no" class="form-control" value="<?= $row['adhar_no'] ?>">
                                                                </div>
                                                                <div class="col-4">
                                                                        <label>Adhar Doc.</label>
                                                                        <input id="" type="file" name="adhar_doc" class="form-control">
                                                                </div>

                                                                <div class="col-4">
                                                                        <img src="../../payroll/include/images/<?= $row['adhar_doc'] ?>" id="photoBrowser" style="margin-top:17px;margin-left:4px;border:solid 1px lightgray" width="120" height="120">
                                                                </div> 
                                                                <div class="col-4">
                                                                        <label>Pan No.</label>
                                                                        <input id="" type="text" name="pan_no" class="form-control" value="<?= $row['pan_no'] ?>">
                                                                </div>
                                                                <div class="col-4">
                                                                        <label>Pan Card Doc.</label>
                                                                        <input type="file" name="pancard_doc" class="form-control">
                                                                </div>

                                                                <div class="col-4">
                                                                        <img src="../../payroll/include/images/<?= $row['pancard_doc'] ?>" id="photoBrowser" style="margin-top:17px;margin-left:4px;border:solid 1px lightgray" width="120" height="120">
                                                                </div> 

                                                                 <div class="col-4">
                                                                        <label>Passbook Doc.</label>
                                                                        <input id="" type="file" name="passbook_doc" class="form-control">
                                                                </div>
                                                                <div class="col-4">
                                                                        <img src="../../payroll/include/images/<?= $row['passbook_doc'] ?>" id="photoBrowser" style="margin-top:17px;margin-left:4px;border:solid 1px lightgray" width="120" height="120">
                                                                </div> 
                                                                <div class="col-4">
                                                                        <label>PF Account No.</label>
                                                                        <input type="text" name="pf_acc" class="form-control" value="<?= $row['pf_acc'] ?>">
                                                                </div>

                                                                <div class="col-4">
                                                                        <label>Cancel Cheque or Passbook Front Page</label>
                                                                        <input id="" type="file" name="passbook_doc" class="form-control">
                                                                </div>
                                                                <div class="col-4">
                                                                        <img src="../../payroll/include/images/<?= $row['passbook_doc'] ?>" id="photoBrowser" style="margin-top:17px;margin-left:4px;border:solid 1px lightgray" width="120" height="120">
                                                                </div> 

                                                              
                                                                

                                                        </div>
                                                </div>
                                        </div>
                                </div>


                                <div class="card card-secondary">
                                        <div class="card-header">
                                                <h3 class="card-title">Financial Details</h3>
                                        </div>

                                        <div class="card-body table-responsive p-0">
                                                <div class="card-body">
                                                        <div class="row">
                                                                <div class="col-4">
                                                                        <label>Basic Salary</label>
                                                                        <input id="basic_salary" type="number" onkeyup="cal();" name="basic_salary" class="form-control">
                                                                </div>
                                                                <div class="col-4">
                                                                        <label>Fooding Allowance</label>
                                                                        <input id="fooding_allowance" type="number" name="fooding_allowance" class="form-control" onkeyup="cal();">
                                                                </div>
                                                                <div class="col-4">
                                                                        <label>House Rent Allowance</label>
                                                                        <input id="hra" type="number" name="hra" class="form-control" onkeyup="cal();">
                                                                </div>
                                                                <div class="col-4">
                                                                        <label>Mobile Allowance</label>
                                                                        <input type="number" id="mobile_allowance"  name="mobile_allowance" class="form-control" onkeyup="cal();">
                                                                </div> 
                                                                <div class="col-4">
                                                                        <label>Transportation Allowance</label>
                                                                        <input id="transbortation_allowance" type="number" name="transbortation_allowance" class="form-control" onkeyup="cal();">
                                                                </div>
                                                                <div class="col-4">
                                                                        <label>Medical Allowance</label>
                                                                        <input type="number" id="medical_allownce"  name="medical_allownce" class="form-control" onkeyup="cal();">
                                                                </div>

                                                                <div class="col-4">
                                                                        <label>Accomodation</label>
                                                                        <input type="number" id="accomodation" name="accomodation" class="form-control" onkeyup="cal();">
                                                                </div>


                                                                <div class="col-4">
                                                                        <label>Deduct From</label>
                                                                        <select name="cut_from" id="cut_from" class="form-control" data-title="Select" data-style="btn-default btn-outline" data-menu-style="dropdown-blue" onkeyup="cal_pf_amount();">
                                                                         <option value="basic_salary">Basic Salary</option>
                                                                         <option value="total_salary">Gross Salary</option>
                                                                    </select>   
                                                                </div>

                                                                <div class="col-md-4">
                                        <div id="response" class="form-group">
                                            <label for=""><strong>Employee PF Contribution (in %):</strong></label>
                                        <div class="input-group mb-3">
                                          <input class="form-control" name="pf_emp" id="pf_emp" type="number" min="1" max="100" step=".001"  onkeyup="cal_pf_amount()">
                                           <input class="form-control ml-3" name="pf_emp_amt" id="pf_emp_amt"  readonly="">
                                        </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div id="response" class="form-group">
                                            <label for=""><strong>Company PF Contribution (in %):</strong></label>
                                            <div class="input-group mb-3">
                                          <input class="form-control" name="pf_cmp" id="pf_cmp" type="number" step=".001"  onkeyup="cal_pf_amount()">
                                        <input class="form-control ml-3" name="pf_cmp_amt" id="pf_cmp_amt"  readonly="">
                                        </div>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div id="response" class="form-group">
                                            <label for=""><strong>Employee ESIC Contribution (in %):</strong></label>
                                            <div class="input-group mb-3">
                                          <input class="form-control" name="esic_emp" id="esic_emp" type="number" step=".001" onkeyup="cal_pf_amount()">
                                        <input class="form-control ml-3" name="esic_emp_amt" id="esic_emp_amt" readonly="">
                                        </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div id="response" class="form-group">
                                            <label for=""><strong>Company ESIC Contribution (in %):</strong></label>
                                            <div class="input-group mb-3">
                                          <input class="form-control" name="esic_cmp" id="esic_cmp" type="number"  step=".001" onkeyup="cal_pf_amount()">
                                        <input class="form-control ml-3" name="esic_cmp_amt" id="esic_cmp_amt"  readonly="">
                                        </div>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div id="response" class="form-group">
                                            <label for="empTotalSalary"><strong>Total Salary:</strong></label>
                                            <input class="form-control" name="total_salary" id="total_salary" type="text">
                                        </div>
                                    </div>
                                     <div class="col-md-4">
                                        <div id="response" class="form-group">
                                            <label for="empTotalSalary"><strong>Net Salary:</strong></label>
                                            <input class="form-control" name="net_salary" id="net_salary"  type="text">
                                        </div>
                                    </div>
                                                                

                                                        </div>
                                                </div>
                                        </div>
                                </div>  


                                <div class="card card-secondary">
                                        <div class="card-header">
                                                <h3 class="card-title">Bank Details</h3>
                                        </div>

                                        <div class="card-body table-responsive p-0">
                                                <div class="card-body">
                                                        <div class="row">
                                                                <div class="col-4">
                                                                        <label>Account Holder Name</label>
                                                                        <input id="" type="text" name="account_holder_name" class="form-control" value="<?= $row['account_holder_name'] ?>">

                                                                </div>
                                                                <div class="col-4">
                                                                        <label>Bank Name</label>
                                                                        <input id="" type="text" name="bank_name" class="form-control" value="<?= $row['bank_name'] ?>">
                                                                </div>
                                                                <div class="col-4">
                                                                        <label>Account No.</label>
                                                                        <input id="" type="text" name="account_no" class="form-control" value="<?= $row['account_no'] ?>">
                                                                </div>
                                                                <div class="col-4">
                                                                        <label>Branch</label>
                                                                        <input type="text" name="branch" class="form-control" value="<?= $row['branch'] ?>">
                                                                </div>

                                                                <div class="col-4">
                                                                        <label>IFSC Code</label>
                                                                        <input type="text" name="ifsc" class="form-control" value="<?= $row['ifsc'] ?>">
                                                                </div>
                                                              
                                                              
                                                                

                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                                                                
                       
                       
                        </div>
                        <center><input type="submit" name="submit" value="Update" class="btn btn-primary"></center><br>
 
                    </div>

</form>




                                <div class="col-md-12">
                                        <div id="loader_section"></div>
                                </div>




                </section>
                <!-- /.content -->


        </div>
</div>





<!-- /.card-header -->





<?php include "../include/foot.php" ?>