<?php
include_once "../../include/config.php";
include_once "../../framwork/main.php";
include_once "../../include/function.php";
$id = $_GET['id'];
$sql = "SELECT * FROM `tbl_admission`
                WHERE `status` = '$visible' && `admission_id` = '$id'
                ORDER BY `admission_id` ASC
                ";
$result = $con->query($sql);
$row = mysqli_fetch_assoc($result);
?>
<form id="view_student_list_form" role="form" method="POST">
    <div class="card-body" style="margin-bottom: 50px;">
        <div class="col-md-12" id="edit_error_section"></div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Registration Number</label>
                    <input type="text" name="" id="edit_student_list_reg_no" class="form-control" value="" readonly />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Prospectus Number</label>
                    <input type="text" name="" id="edit_student_list_reg_no" class="form-control"
                        value="<?php echo $row["admission_form_no"]; ?>" readonly />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Admission Number</label>
                    <input type="text" name="" id="edit_student_list_admission_no" class="form-control"
                        value="<?php echo $row["admission_no"]; ?>" readonly />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Course Name</label>
                    <select name="" id="edit_student_list_course_name" class="form-control" readonly>

                        <option> <?= get_course($row["admission_course_name"]) ?> </option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Session</label>
                    <select name="" id="edit_student_list_session" class="form-control" readonly>
                        <option> <?= get_session($row["admission_session"]) ?> </option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Student Name</label>
                    <input type="text" name="" id="edit_student_list_first_name" class="form-control"
                        value="<?php echo $row["admission_first_name"]; ?>&nbsp;&nbsp;<?php echo $row["admission_middle_name"]; ?>&nbsp;&nbsp;<?php echo $row["admission_last_name"]; ?>"
                        readonly />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>DOB</label>
                    <input type="text" name="" id="edit_student_list_contact_no" class="form-control"
                        value="<?php echo $row["admission_dob"]; ?>" readonly />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Nationality</label>
                    <input type="text" name="" id="edit_student_list_contact_no" class="form-control"
                        value="<?php echo $row["admission_nationality"]; ?>" readonly />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Adhar No</label>
                    <input type="text" name="" id="edit_student_list_contact_no" class="form-control"
                        value="<?php echo $row["admission_aadhar_no"]; ?>" readonly />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Date Of Admission</label>
                    <input type="text" name="" id="edit_student_list_contact_no" class="form-control"
                        value="<?php echo $row["date_of_admission"]; ?>" readonly />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Category</label>
                    <input type="text" name="" id="edit_student_list_contact_no" class="form-control"
                        value="<?php echo $row["admission_category"]; ?>" readonly />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Gender</label>
                    <input type="text" name="" id="edit_student_list_contact_no" class="form-control"
                        value="<?php echo $row["admission_gender"]; ?>" readonly />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="" id="edit_student_list_contact_no" class="form-control"
                        value="<?php echo $row["admission_username"]; ?>" readonly />
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>Blood Group</label>
                    <input type="text" name="" id="edit_student_list_contact_no" class="form-control"
                        value="<?php echo $row["admission_blood_group"]; ?>" readonly />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Hostel</label>
                    <input type="text" name="" id="edit_student_list_email" class="form-control"
                        value="<?php echo $row["admission_hostel"]; ?>" readonly />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Transport</label>
                    <input type="text" name="" id="edit_student_list_email" class="form-control"
                        value="<?php echo $row["admission_transport"]; ?>" readonly />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Image</label>
                    <img src="images/student_images/<?php echo $row["admission_profile_image"]; ?>"
                        style="width: 100px;filter: invert(0);height: 100px;">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Student Contact No</label>
                    <input type="text" name="" id="edit_student_list_fathers_contact" class="form-control"
                        value="<?php echo $row["admission_mobile_student"]; ?>" readonly />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Student EmailID</label>
                    <input type="text" name="" id="edit_student_list_fathers_contact" class="form-control"
                        value="<?php echo $row["admission_emailid_student"]; ?>" readonly />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Father's Name</label>
                    <input type="text" name="" id="edit_student_list_fathers_name" class="form-control"
                        value="<?php echo $row["admission_father_name"]; ?>" readonly />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Father Contact No</label>
                    <input type="text" name="" id="edit_student_list_fathers_contact" class="form-control"
                        value="<?php echo $row["admission_father_phoneno"]; ?>" readonly />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Mother's Name</label>
                    <input type="text" name="" id="edit_student_list_fathers_name" class="form-control"
                        value="<?php echo $row["admission_mother_name"]; ?>" readonly />
                </div>
            </div>

        </div>
    </div>
</form>