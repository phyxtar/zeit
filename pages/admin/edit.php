<?php include_once "../../include/config.php";
include_once "../../framwork/main.php";
include_once "../../include/function.php";
$id = $_GET['id'];
$row = fetchRow('tbl_admin', '`status` = "' . $visible . '" && `admin_id`=' . $id . '');

$autority = $row["admin_permission"];
$allAutority = json_decode($autority);
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<form id="edit_admin_form" role="form" method="POST">
    <div class="card-body">
        <div class="col-md-12" id="edit_error_section"></div>
        <div class="row">
            <div class="col-6">
                <label> Name</label>
                <input type="text" name="edit_admin_name" id="edit_admin_name" class="form-control"
                    value="<?php echo $row["admin_name"]; ?>">
            </div>
            <div class="col-6">
                <label>User Name</label>
                <input readonly type="text" name="edit_admin_username" id="edit_admin_username" class="form-control"
                    value="<?php echo $row["admin_username"]; ?>">
            </div>

            <div class="col-6">
                <label>Email</label>
                <input type="text" name="edit_admin_email" id="edit_admin_email" class="form-control"
                    value="<?php echo $row["admin_email"]; ?>">
            </div>
            <div class="col-6">
                <label>Mobile</label>
                <input type="text" name="edit_admin_mobile" id="edit_admin_mobile" class="form-control"
                    value="<?php echo $row["admin_mobile"]; ?>">
            </div>
            <div class="col-6">
                <label>Password</label>
                <input type="hidden" name="admin_password" id="edit_admin_password" class="form-control"
                    value="<?php echo $row["admin_password"]; ?>">
                <input title="Password must 0-9,a-z ,A-Z ,[!@#$%^&*-] minimum 8 character"
                    pattern="^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$"
                    placeholder="Enter minimum 8 character password" type="text" name="edit_admin_password"
                    id="admin_password" class="form-control" value="">
            </div>
            <div class="col-6">
                <label>Admin Type</label>
                <select name="admin_type" id="admin_type" class="form-control text-capitalize"
                    onchange="toggleCourseField()">
                    <option selected disabled> <?php echo $row["admin_type"]; ?> </option>
                    <option value="superadmin">Super Admin</option>
                    <option value="admin">Admin</option>
                    <option value="subadmin">Sub Admin</option>
                    <option value="hod">HOD</option>
                    <option value="library">Library</option>
                    <option value="it_lab">IT Lab</option>
                    <option value="dept_lab">Dept. Lab</option>
                    <option value="staff">Staff</option>
                </select>
            </div>

            <div class="col-md-6" id="course_field" style="display:none;">
                <label>Course</label>
                <select class="form-control" name="hod_permission[]" multiple>
                    <option disabled>Select Course</option>
                    <?php
    $selected_courses = json_decode($row['hod_permission']); 
    $sql = "SELECT * FROM `tbl_course`";
    $result = $con->query($sql);
    
    while ($course = $result->fetch_assoc()) { 
        $selected = in_array($course["course_id"], $selected_courses) ? 'selected' : '';
    ?>
                    <option value="<?php echo $course["course_id"]; ?>" <?php echo $selected; ?>>
                        <?php echo $course["course_name"]; ?>
                    </option>
                    <?php } ?>
                </select>

            </div>
            <script>
            function toggleCourseField() {
                var adminType = document.getElementById('admin_type').value;
                var courseField = document.getElementById('course_field');
                if (adminType === 'hod') {
                    courseField.style.display = 'block';
                } else {
                    courseField.style.display = 'none';
                }
            }
            </script>
            <div class="col-12 mt-3">
                <br />
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Select Permissions</h3>
                    </div>
                    <div class="card-body">
                        <!-- Minimal style -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <div class="card card-warning">
                                        <div class="card-header">
                                            <h3 class="card-title">Administation</h3>
                                        </div>
                                        <div class="card-body">
                                            <!-- Minimal style -->
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox"
                                                                id="checkboxPrimary13_1<?php echo $row["admin_id"]; ?>"
                                                                name="permission_2[]" value="2_1" <?php if (isset($autority)) {
                                                                            $page_no_temp = 2;
                                                                            $flag = 0;
                                                                            if (isset($allAutority->$page_no_temp)) {
                                                                                $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                for ($i = 0; $i < count($subMenus); $i++) {
                                                                                    if ($subMenus[$i] == "2_1") {
                                                                                        echo "checked";
                                                                                        $flag++;
                                                                                        break;
                                                                                    }
                                                                                }
                                                                            }
                                                                        } ?>>
                                                            <label
                                                                for="checkboxPrimary13_1<?php echo $row["admin_id"]; ?>">Admin
                                                                List
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox"
                                                                id="checkboxPrimary13_4<?php echo $row["admin_id"]; ?>"
                                                                name="permission_2[]" value="2_4" <?php if (isset($autority)) {
                                                                            $page_no_temp = 2;
                                                                            $flag = 0;
                                                                            if (isset($allAutority->$page_no_temp)) {
                                                                                $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                for ($i = 0; $i < count($subMenus); $i++) {
                                                                                    if ($subMenus[$i] == "2_4") {
                                                                                        echo "checked";
                                                                                        $flag++;
                                                                                        break;
                                                                                    }
                                                                                }
                                                                            }
                                                                        } ?>>
                                                            <label
                                                                for="checkboxPrimary13_4<?php echo $row["admin_id"]; ?>">Edit
                                                                Admin
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox"
                                                                id="checkboxPrimary13_5<?php echo $row["admin_id"]; ?>"
                                                                name="permission_2[]" value="2_5" <?php if (isset($autority)) {
                                                                            $page_no_temp = 2;
                                                                            $flag = 0;
                                                                            if (isset($allAutority->$page_no_temp)) {
                                                                                $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                for ($i = 0; $i < count($subMenus); $i++) {
                                                                                    if ($subMenus[$i] == "2_5") {
                                                                                        echo "checked";
                                                                                        $flag++;
                                                                                        break;
                                                                                    }
                                                                                }
                                                                            }
                                                                        } ?>>
                                                            <label
                                                                for="checkboxPrimary13_5<?php echo $row["admin_id"]; ?>">Delete
                                                                Admin
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox"
                                                                id="checkboxPrimary13_2<?php echo $row["admin_id"]; ?>"
                                                                name="permission_2[]" value="2_2" <?php if (isset($autority)) {
                                                                            $page_no_temp = 2;
                                                                            $flag = 0;
                                                                            if (isset($allAutority->$page_no_temp)) {
                                                                                $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                for ($i = 0; $i < count($subMenus); $i++) {
                                                                                    if ($subMenus[$i] == "2_2") {
                                                                                        echo "checked";
                                                                                        $flag++;
                                                                                        break;
                                                                                    }
                                                                                }
                                                                            }
                                                                        } ?>>
                                                            <label
                                                                for="checkboxPrimary13_2<?php echo $row["admin_id"]; ?>">View
                                                                Leave Applications
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox"
                                                                id="checkboxPrimary13_2<?php echo $row["admin_id"]; ?>"
                                                                name="permission_2[]" value="2_6" <?php if (isset($autority)) {
                                                                            $page_no_temp = 2;
                                                                            $flag = 0;
                                                                            if (isset($allAutority->$page_no_temp)) {
                                                                                $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                for ($i = 0; $i < count($subMenus); $i++) {
                                                                                    if ($subMenus[$i] == "2_6") {
                                                                                        echo "checked";
                                                                                        $flag++;
                                                                                        break;
                                                                                    }
                                                                                }
                                                                            }
                                                                        } ?>>
                                                            <label
                                                                for="checkboxPrimary13_2<?php echo $row["admin_id"]; ?>">Leave
                                                                Approval
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox"
                                                                id="checkboxPrimary13_2<?php echo $row["admin_id"]; ?>"
                                                                name="permission_2[]" value="2_7" <?php if (isset($autority)) {
                                                                            $page_no_temp = 2;
                                                                            $flag = 0;
                                                                            if (isset($allAutority->$page_no_temp)) {
                                                                                $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                for ($i = 0; $i < count($subMenus); $i++) {
                                                                                    if ($subMenus[$i] == "2_7") {
                                                                                        echo "checked";
                                                                                        $flag++;
                                                                                        break;
                                                                                    }
                                                                                }
                                                                            }
                                                                        } ?>>
                                                            <label
                                                                for="checkboxPrimary13_2<?php echo $row["admin_id"]; ?>">Delete
                                                                Leave Applications
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox"
                                                                id="checkboxPrimary13_2<?php echo $row["admin_id"]; ?>"
                                                                name="permission_2[]" value="2_8" <?php if (isset($autority)) {
                                                                            $page_no_temp = 2;
                                                                            $flag = 0;
                                                                            if (isset($allAutority->$page_no_temp)) {
                                                                                $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                for ($i = 0; $i < count($subMenus); $i++) {
                                                                                    if ($subMenus[$i] == "2_8") {
                                                                                        echo "checked";
                                                                                        $flag++;
                                                                                        break;
                                                                                    }
                                                                                }
                                                                            }
                                                                        } ?>>
                                                            <label
                                                                for="checkboxPrimary13_2<?php echo $row["admin_id"]; ?>">Leave
                                                                Rejection
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox"
                                                                id="checkboxPrimary13_3<?php echo $row["admin_id"]; ?>"
                                                                name="permission_2[]" value="2_3" <?php if (isset($autority)) {
                                                                            $page_no_temp = 2;
                                                                            $flag = 0;
                                                                            if (isset($allAutority->$page_no_temp)) {
                                                                                $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                for ($i = 0; $i < count($subMenus); $i++) {
                                                                                    if ($subMenus[$i] == "2_3") {
                                                                                        echo "checked";
                                                                                        $flag++;
                                                                                        break;
                                                                                    }
                                                                                }
                                                                            }
                                                                        } ?>>
                                                            <label
                                                                for="checkboxPrimary13_3<?php echo $row["admin_id"]; ?>">View
                                                                Loan Applications
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox"
                                                                id="checkboxPrimary13_3<?php echo $row["admin_id"]; ?>"
                                                                name="permission_2[]" value="2_9" <?php if (isset($autority)) {
                                                                            $page_no_temp = 2;
                                                                            $flag = 0;
                                                                            if (isset($allAutority->$page_no_temp)) {
                                                                                $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                for ($i = 0; $i < count($subMenus); $i++) {
                                                                                    if ($subMenus[$i] == "2_9") {
                                                                                        echo "checked";
                                                                                        $flag++;
                                                                                        break;
                                                                                    }
                                                                                }
                                                                            }
                                                                        } ?>>
                                                            <label
                                                                for="checkboxPrimary13_3<?php echo $row["admin_id"]; ?>">Loan
                                                                Approval
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox"
                                                                id="checkboxPrimary13_3<?php echo $row["admin_id"]; ?>"
                                                                name="permission_2[]" value="2_10" <?php if (isset($autority)) {
                                                                            $page_no_temp = 2;
                                                                            $flag = 0;
                                                                            if (isset($allAutority->$page_no_temp)) {
                                                                                $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                for ($i = 0; $i < count($subMenus); $i++) {
                                                                                    if ($subMenus[$i] == "2_10") {
                                                                                        echo "checked";
                                                                                        $flag++;
                                                                                        break;
                                                                                    }
                                                                                }
                                                                            }
                                                                        } ?>>
                                                            <label
                                                                for="checkboxPrimary13_3<?php echo $row["admin_id"]; ?>">Delete
                                                                Loan Applications
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox"
                                                                id="checkboxPrimary13_3<?php echo $row["admin_id"]; ?>"
                                                                name="permission_2[]" value="2_11" <?php if (isset($autority)) {
                                                                            $page_no_temp = 2;
                                                                            $flag = 0;
                                                                            if (isset($allAutority->$page_no_temp)) {
                                                                                $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                for ($i = 0; $i < count($subMenus); $i++) {
                                                                                    if ($subMenus[$i] == "2_11") {
                                                                                        echo "checked";
                                                                                        $flag++;
                                                                                        break;
                                                                                    }
                                                                                }
                                                                            }
                                                                        } ?>>
                                                            <label
                                                                for="checkboxPrimary13_3<?php echo $row["admin_id"]; ?>">Loan
                                                                Rejection
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <div class="card card-warning">
                                        <div class="card-header">
                                            <h3 class="card-title">SetUp</h3>
                                        </div>
                                        <div class="card-body ">
                                            <!-- Minimal style -->
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary1_1"
                                                                name="permission_3[]" value="3_1"
                                                                <?= get_permission('3', '3_1') ?>>
                                                            <label for="checkboxPrimary1_1">University Details </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary1_2"
                                                                name="permission_3[]" value="3_2"
                                                                <?= get_permission('3', '3_2') ?>>
                                                            <label for="checkboxPrimary1_2">Courses </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary1_2"
                                                                name="permission_3[]" value="3_6"
                                                                <?= get_permission('3', '3_6') ?>>
                                                            <label for="checkboxPrimary1_2">Edit Courses</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary1_2"
                                                                name="permission_3[]" value="3_4"
                                                                <?= get_permission('3', '3_4') ?>>
                                                            <label for="checkboxPrimary1_2">Delete Courses </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary1_2"
                                                                name="permission_3[]" value="3_5"
                                                                <?= get_permission('3', '3_5') ?>>
                                                            <label for="checkboxPrimary1_2">Active Courses </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary1_2"
                                                                name="permission_3[]" value="3_3"
                                                                <?= get_permission('3', '3_3') ?>>
                                                            <label for="checkboxPrimary1_2">Mandatory Documents</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary1_2"
                                                                name="permission_3[]" value="3_7"
                                                                <?= get_permission('3', '3_7') ?>>
                                                            <label for="checkboxPrimary1_2">Edit Mandatory
                                                                Documents</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary1_2"
                                                                name="permission_3[]" value="3_8"
                                                                <?= get_permission('3', '3_8') ?>>
                                                            <label for="checkboxPrimary1_2">Delete Mandatory
                                                                Documents</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <div class="card card-warning">
                                        <div class="card-header">
                                            <h3 class="card-title">Front Office</h3>
                                        </div>
                                        <div class="card-body ">
                                            <!-- Minimal style -->
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary2_1"
                                                                name="permission_4[]" value="4_1"
                                                                <?= get_permission('4', '4_1') ?>>
                                                            <label for="checkboxPrimary2_1">View Prospectus </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary2_1"
                                                                name="permission_4[]" value="4_2"
                                                                <?= get_permission('4', '4_2') ?>>
                                                            <label for="checkboxPrimary2_1">Add Prospectus </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary2_1"
                                                                name="permission_4[]" value="4_3"
                                                                <?= get_permission('4', '4_3') ?>>
                                                            <label for="checkboxPrimary2_1">Edit Prospectus </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary2_1"
                                                                name="permission_4[]" value="4_4"
                                                                <?= get_permission('4', '4_4') ?>>
                                                            <label for="checkboxPrimary2_1">Delete Prospectus </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <div class="card card-warning">
                                        <div class="card-header">
                                            <h3 class="card-title">Admission</h3>
                                        </div>
                                        <div class="card-body ">
                                            <!-- Minimal style -->
                                            <div class="row">

                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary3_1"
                                                                name="permission_5[]" value="5_1"
                                                                <?= get_permission('5', '5_1') ?>>
                                                            <label for="checkboxPrimary3_1">Admission Form </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <div class="card card-warning">
                                        <div class="card-header">
                                            <h3 class="card-title">Student</h3>
                                        </div>
                                        <div class="card-body ">
                                            <!-- Minimal style -->
                                            <div class="row">

                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary4_1"
                                                                name="permission_6[]" value="6_4"
                                                                <?= get_permission('6', '6_4') ?>>
                                                            <label for="checkboxPrimary4_1">Student List </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary4_1"
                                                                name="permission_6[]" value="6_8"
                                                                <?= get_permission('6', '6_8') ?>>
                                                            <label for="checkboxPrimary4_1">Innactive All</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary4_1"
                                                                name="permission_6[]" value="6_9"
                                                                <?= get_permission('6', '6_9') ?>>
                                                            <label for="checkboxPrimary4_1">Completed Button</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary4_3"
                                                                name="permission_6[]" value="6_7"
                                                                <?= get_permission('6', '6_7') ?>>
                                                            <label for="checkboxPrimary4_3">Student List
                                                                Yearwise</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary4_2"
                                                                name="permission_6[]" value="6_5"
                                                                <?= get_permission('6', '6_5') ?>>
                                                            <label for="checkboxPrimary4_2">Student edit </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary6_1"
                                                                name="permission_6[]" value="6_1"
                                                                <?= get_permission('6', '6_1') ?>>
                                                            <label for="checkboxPrimary6_1">Student delete </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary6_2"
                                                                name="permission_6[]" value="6_2"
                                                                <?= get_permission('6', '6_2') ?>>
                                                            <label for="checkboxPrimary6_2">Student status </label>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary4_3"
                                                                name="permission_6[]" value="6_6"
                                                                <?= get_permission('6', '6_6') ?>>
                                                            <label for="checkboxPrimary4_3"> Archive Student </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <div class="card card-warning">
                                        <div class="card-header">
                                            <h3 class="card-title">Fee Payment</h3>
                                        </div>
                                        <div class="card-body ">
                                            <!-- Minimal style -->
                                            <div class="row">

                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary5_1"
                                                                name="permission_7[]" value="7_1"
                                                                <?= get_permission('7', '7_1') ?>>
                                                            <label for="checkboxPrimary5_1">Add Fees </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary5_2"
                                                                name="permission_7[]" value="7_4"
                                                                <?= get_permission('7', '7_4') ?>>
                                                            <label for="checkboxPrimary5_2">Fee Details </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary5_3"
                                                                name="permission_7[]" value="7_7"
                                                                <?= get_permission('7', '7_7') ?>>
                                                            <label for="checkboxPrimary5_3">Pay Fee </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary5_14"
                                                                name="permission_7[]" value="7_14"
                                                                <?= get_permission('7', '7_14') ?>>
                                                            <label for="checkboxPrimary5_14">Paid Info Refund</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary5_15"
                                                                name="permission_7[]" value="7_15"
                                                                <?= get_permission('7', '7_15') ?>>
                                                            <label for="checkboxPrimary5_15">Paid Info Delete</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary5_4"
                                                                name="permission_7[]" value="7_8"
                                                                <?= get_permission('7', '7_8') ?>>
                                                            <label for="checkboxPrimary5_4">Print Receipt </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary5_13"
                                                                name="permission_7[]" value="7_12"
                                                                <?= get_permission('7', '7_12') ?>>
                                                            <label for="checkboxPrimary5_13">Delete Receipt </label>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary5_11"
                                                                name="permission_7[]" value="7_13"
                                                                <?= get_permission('7', '7_13') ?>>
                                                            <label for="checkboxPrimary5_11">Print</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary5_5"
                                                                name="permission_7[]" value="7_9"
                                                                <?= get_permission('7', '7_9') ?>>
                                                            <label for="checkboxPrimary5_5">Dues / No Dues list</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary5_12"
                                                                name="permission_7[]" value="7_11"
                                                                <?= get_permission('7', '7_11') ?>>
                                                            <label for="checkboxPrimary5_12">Course & Year Wise Fee
                                                                Report </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary5_7"
                                                                name="permission_7[]" value="7_5"
                                                                <?= get_permission('7', '7_5') ?>>
                                                            <label for="checkboxPrimary5_7">Hostel Fee List</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary5_8"
                                                                name="permission_7[]" value="7_6"
                                                                <?= get_permission('7', '7_6') ?>>
                                                            <label for="checkboxPrimary5_8">Student Fee Card</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary5_6"
                                                                name="permission_7[]" value="7_10"
                                                                <?= get_permission('7', '7_10') ?>>
                                                            <label for="checkboxPrimary5_6">Datewise Fee Report </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <div class="card card-warning">
                                        <div class="card-header">
                                            <h3 class="card-title">Income / Expenses</h3>
                                        </div>
                                        <div class="card-body ">
                                            <!-- Minimal style -->
                                            <div class="row">

                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary6_1"
                                                                name="permission_8[]" value="8_1"
                                                                <?= get_permission('8', '8_1') ?>>
                                                            <label for="checkboxPrimary6_1">Extra Income </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary6_2"
                                                                name="permission_8[]" value="8_2"
                                                                <?= get_permission('8', '8_2') ?>>
                                                            <label for="checkboxPrimary6_2">Income </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary6_3"
                                                                name="permission_8[]" value="8_3"
                                                                <?= get_permission('8', '8_3') ?>>
                                                            <label for="checkboxPrimary6_3">Expenses </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary6_4"
                                                                name="permission_8[]" value="8_4"
                                                                <?= get_permission('8', '8_4') ?>>
                                                            <label for="checkboxPrimary6_4">Balance Sheet </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <div class="card card-warning">
                                        <div class="card-header">
                                            <h3 class="card-title">Nsuniv Informations</h3>
                                        </div>
                                        <div class="card-body ">
                                            <!-- Minimal style -->
                                            <div class="row">

                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary7_1"
                                                                name="permission_9[]" value="9_4"
                                                                <?= get_permission('9', '9_4') ?>>
                                                            <label for="checkboxPrimary7_1">Get Started Enquiry </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary7_2"
                                                                name="permission_9[]" value="9_2"
                                                                <?= get_permission('9', '9_2') ?>>
                                                            <label for="checkboxPrimary7_2">Prospectus Enquiry </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary7_3"
                                                                name="permission_9[]" value="9_3"
                                                                <?= get_permission('9', '9_3') ?>>
                                                            <label for="checkboxPrimary7_3">Admission Enquiry </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary7_4"
                                                                name="permission_9[]" value="9_5"
                                                                <?= get_permission('9', '9_5') ?>>
                                                            <label for="checkboxPrimary7_4">Notifications </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary7_5"
                                                                name="permission_9[]" value="9_6"
                                                                <?= get_permission('9', '9_6') ?>>
                                                            <label for="checkboxPrimary7_5">Files </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <div class="card card-warning">
                                        <div class="card-header">
                                            <h3 class="card-title">Students And Examination</h3>
                                        </div>
                                        <div class="card-body ">
                                            <!-- Minimal style -->
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary8_1"
                                                                name="permission_11[]" value="11_12"
                                                                <?= get_permission('11', '11_12') ?>>
                                                            <label for="checkboxPrimary8_1">Character Certificate
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary8_1"
                                                                name="permission_11[]" value="11_15"
                                                                <?= get_permission('11', '11_15') ?>>
                                                            <label for="checkboxPrimary8_1">Placement Form
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary8_1"
                                                                name="permission_11[]" value="11_14"
                                                                <?= get_permission('11', '11_14') ?>>
                                                            <label for="checkboxPrimary8_1">Placement Applied Std
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary8_1"
                                                                name="permission_11[]" value="11_1"
                                                                <?= get_permission('11', '11_1') ?>>
                                                            <label for="checkboxPrimary8_1">Add Semester </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary8_14"
                                                                name="permission_11[]" value="11_13"
                                                                <?= get_permission('11', '11_13') ?>>
                                                            <label for="checkboxPrimary8_14">Add Specialization </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary8_2"
                                                                name="permission_11[]" value="11_2"
                                                                <?= get_permission('11', '11_2') ?>>
                                                            <label for="checkboxPrimary8_2">Export Student </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary8_8"
                                                                name="permission_11[]" value="11_8"
                                                                <?= get_permission('11', '11_8') ?>>
                                                            <label for="checkboxPrimary8_8">Import Student </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary8_3"
                                                                name="permission_11[]" value="11_3"
                                                                <?= get_permission('11', '11_3') ?>>
                                                            <label for="checkboxPrimary8_3">Allocate Semester Before
                                                                2042
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary8_3"
                                                                name="permission_11[]" value="11_10"
                                                                <?= get_permission('11', '11_10') ?>>
                                                            <label for="checkboxPrimary8_3">Allocate Semester After
                                                                2042
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary8_4"
                                                                name="permission_11[]" value="11_4"
                                                                <?= get_permission('11', '11_4') ?>>
                                                            <label for="checkboxPrimary8_4">Add Subject </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary8_5"
                                                                name="permission_11[]" value="11_5"
                                                                <?= get_permission('11', '11_5') ?>>
                                                            <label for="checkboxPrimary8_5">Add Marks </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary8_5"
                                                                name="permission_11[]" value="11_13"
                                                                <?= get_permission('11', '11_13') ?>>
                                                            <label for="checkboxPrimary8_5">Add Marks Button</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary8_6"
                                                                name="permission_11[]" value="11_6"
                                                                <?= get_permission('11', '11_6') ?>>
                                                            <label for="checkboxPrimary8_6">Create Report </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary8_7"
                                                                name="permission_11[]" value="11_7"
                                                                <?= get_permission('11', '11_7') ?>>
                                                            <label for="checkboxPrimary8_7">Create Full Report </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary8_8"
                                                                name="permission_11[]" value="11_23"
                                                                <?= get_permission('11', '11_23') ?>>
                                                            <label for="checkboxPrimary8_8">Add Registration </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary8_8"
                                                                name="permission_11[]" value="11_11"
                                                                <?= get_permission('11', '11_11') ?>>
                                                            <label for="checkboxPrimary8_10">Backlogs Management
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary8_9"
                                                                name="permission_11[]" value="11_22"
                                                                <?= get_permission('11', '11_22') ?>>
                                                            <label for="checkboxPrimary8_9">Registered Student </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary8_11"
                                                                name="permission_11[]" value="11_30"
                                                                <?= get_permission('11', '11_30') ?>>
                                                            <label for="checkboxPrimary8_11">Migration Form </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary8_12"
                                                                name="permission_11[]" value="11_31"
                                                                <?= get_permission('11', '11_31') ?>>
                                                            <label for="checkboxPrimary8_12">Migration Form Applications
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary8_13"
                                                                name="permission_11[]" value="11_12"
                                                                <?= get_permission('11', '11_12') ?>>
                                                            <label for="checkboxPrimary8_13">Provisional Form
                                                                Applications </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <div class="card card-warning">
                                        <div class="card-header">
                                            <h3 class="card-title">Examination</h3>
                                        </div>
                                        <div class="card-body ">
                                            <!-- Minimal style -->
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary9_1"
                                                                name="permission_12[]" value="12_1"
                                                                <?= get_permission('12', '12_1') ?>>
                                                            <label for="checkboxPrimary9_1">Exam Form</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary9_2"
                                                                name="permission_12[]" value="12_2"
                                                                <?= get_permission('12', '12_2') ?>>
                                                            <label for="checkboxPrimary9_2">Student List (No Dues)
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary9_2"
                                                                name="permission_12[]" value="12_6"
                                                                <?= get_permission('12', '12_6') ?>>
                                                            <label for="checkboxPrimary9_2">Attendance
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <div class="card card-warning">
                                        <div class="card-header">
                                            <h3 class="card-title">Complaints From Student</h3>
                                        </div>
                                        <div class="card-body ">
                                            <!-- Minimal style -->
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary10_1"
                                                                name="permission_13[]" value="13_1"
                                                                <?= get_permission('13', '13_1') ?>>
                                                            <label for="checkboxPrimary10_1">Complaints</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <div class="card card-warning">
                                        <div class="card-header">
                                            <h3 class="card-title">Admit Card</h3>
                                        </div>
                                        <div class="card-body ">
                                            <!-- Minimal style -->
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary11_11"
                                                                name="permission_14[]" value="14_1"
                                                                <?= get_permission('14', '14_1') ?>>
                                                            <label for="checkboxPrimary11_11">Admit Card
                                                                Approval</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <div class="card card-warning">
                                        <div class="card-header">
                                            <h3 class="card-title">Time Table</h3>
                                        </div>
                                        <div class="card-body ">
                                            <!-- Minimal style -->
                                            <div class="row">

                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary11_2"
                                                                name="permission_15[]" value="15_2"
                                                                <?= get_permission('15', '15_2') ?>>
                                                            <label for="checkboxPrimary11_2"> Add Section</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary11_3"
                                                                name="permission_15[]" value="15_3"
                                                                <?= get_permission('15', '15_3') ?>>
                                                            <label for="checkboxPrimary11_3"> Add Subject</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary11_4"
                                                                name="permission_15[]" value="15_4"
                                                                <?= get_permission('15', '15_4') ?>>
                                                            <label for="checkboxPrimary11_4"> Teachers Allotment</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary11_1"
                                                                name="permission_15[]" value="15_1"
                                                                <?= get_permission('15', '15_1') ?>>
                                                            <label for="checkboxPrimary11_1">Course Wise Time
                                                                Table</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary11_5"
                                                                name="permission_15[]" value="15_5"
                                                                <?= get_permission('15', '15_5') ?>>
                                                            <label for="checkboxPrimary11_5"> Free Staff </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <div class="card card-warning">
                                        <div class="card-header">
                                            <h3 class="card-title">Hostel Management</h3>
                                        </div>
                                        <div class="card-body ">
                                            <!-- Minimal style -->
                                            <div class="row">

                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary17_1"
                                                                name="permission_17[]" value="17_0"
                                                                <?= get_permission('17', '17_0') ?>>
                                                            <label for="checkboxPrimary17_1">Hotel Join Date </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary17_2"
                                                                name="permission_17[]" value="17_1"
                                                                <?= get_permission('17', '17_1') ?>>
                                                            <label for="checkboxPrimary17_2"> Bulding Management</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary17_3"
                                                                name="permission_17[]" value="17_2"
                                                                <?= get_permission('17', '17_2') ?>>
                                                            <label for="checkboxPrimary17_3"> Room Management </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary17_4"
                                                                name="permission_17[]" value="17_3"
                                                                <?= get_permission('17', '17_3') ?>>
                                                            <label for="checkboxPrimary17_4"> Bed Management </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary17_5"
                                                                name="permission_17[]" value="17_4"
                                                                <?= get_permission('17', '17_4') ?>>
                                                            <label for="checkboxPrimary17_5"> Room Allotment </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary17_6"
                                                                name="permission_17[]" value="17_5"
                                                                <?= get_permission('17', '17_5') ?>>
                                                            <label for="checkboxPrimary17_6">Gender-wise Hostellers
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary17_7"
                                                                name="permission_17[]" value="17_35"
                                                                <?= get_permission('17', '17_35') ?>>
                                                            <label for="checkboxPrimary17_7">Hostel View Vacant
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <div class="card card-warning">
                                        <div class="card-header">
                                            <h3 class="card-title">Payroll Manegment</h3>
                                        </div>
                                        <div class="card-body ">
                                            <!-- Minimal style -->
                                            <div class="row">

                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary12_1"
                                                                name="permission_16[]" value="16_1"
                                                                <?= get_permission('16', '16_1') ?>>
                                                            <label for="checkboxPrimary12_1"> Employee Type </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary12_2"
                                                                name="permission_16[]" value="16_2"
                                                                <?= get_permission('16', '16_2') ?>>
                                                            <label for="checkboxPrimary12_2"> Employee Manegment
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary12_3"
                                                                name="permission_16[]" value="16_3"
                                                                <?= get_permission('16', '16_3') ?>>
                                                            <label for="checkboxPrimary12_3"> Holiday List
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary12_4"
                                                                name="permission_16[]" value="16_4"
                                                                <?= get_permission('16', '16_4') ?>>
                                                            <label for="checkboxPrimary12_4">Apply For Leave
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary12_5"
                                                                name="permission_16[]" value="16_5"
                                                                <?= get_permission('16', '16_5') ?>>
                                                            <label for="checkboxPrimary12_5">Employee Attendence
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary12_6"
                                                                name="permission_16[]" value="16_6"
                                                                <?= get_permission('16', '16_6') ?>>
                                                            <label for="checkboxPrimary12_6">Attendence Report
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary12_7"
                                                                name="permission_16[]" value="16_7"
                                                                <?= get_permission('16', '16_7') ?>>
                                                            <label for="checkboxPrimary12_7">Apply For Loan
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary12_8"
                                                                name="permission_16[]" value="16_8"
                                                                <?= get_permission('16', '16_8') ?>>
                                                            <label for="checkboxPrimary12_8">Pay Slip
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary12_9"
                                                                name="permission_16[]" value="16_9"
                                                                <?= get_permission('16', '16_9') ?>>
                                                            <label for="checkboxPrimary12_9">Leave Report
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary12_10"
                                                                name="permission_16[]" value="16_10"
                                                                <?= get_permission('16', '16_10') ?>>
                                                            <label for="checkboxPrimary12_10">Salary Reports
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <div class="card card-warning">
                                        <div class="card-header">
                                            <h3 class="card-title">AMS</h3>
                                        </div>
                                        <div class="card-body ">
                                            <!-- Minimal style -->
                                            <div class="row">

                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary12_1"
                                                                name="permission_18[]" value="18_2"
                                                                <?= get_permission('18', '18_2') ?>>
                                                            <label for="checkboxPrimary12_1"> AMS Students </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary12_2"
                                                                name="permission_18[]" value="18_5"
                                                                <?= get_permission('18', '18_5') ?>>
                                                            <label for="checkboxPrimary12_2">AMS Teachers
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary12_3"
                                                                name="permission_18[]" value="18_3"
                                                                <?= get_permission('18', '18_3') ?>>
                                                            <label for="checkboxPrimary12_3"> AMS Grade
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <!-- checkbox -->
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="checkboxPrimary12_4"
                                                                name="permission_18[]" value="18_4"
                                                                <?= get_permission('18', '18_4') ?>>
                                                            <label for="checkboxPrimary12_4">Manage Attendance
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <br />
            </div>
            <br>
            <input type='hidden' name='edit_admin_id' id="edit_admin_id" value='<?= $id ?>' />
            <input type='hidden' name='action' id="action" value='edit_admin' />
            <div class="col-md-12" id="edit_loader_section"></div>
            <button type="button"
                onclick="ajaxCall('edit_admin_form','<?= url('pages/admin/update', '') ?>','edit_admin_form')"
                id="edit_admin_button" class="btn btn-primary">Update</button>
        </div>
</form>