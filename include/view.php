<?php
//Starting Session
if (empty(session_start()))
    session_start();
//DataBase Connectivity
include "config.php";
include "db_class.php";
include "../framwork/main.php";
// Setting Time Zone in India Standard Timing
$random_number = rand(111111, 999999); // Random Number
$s_no = 1; //Serial Number
$visible = md5("visible");
$trash = md5("trash");
date_default_timezone_set("Asia/Calcutta");
$date_variable_today_month_year_with_timing = date("d M, Y. h:i A");
//All File Directries Start
$university_logos_dir = "../images/university_logos";
$admission_profile_image_dir = "images/student_images";
$certificates = "images/student_certificates";
//Creating Object NSUNIV
// $objectDefault = new DBEVAL();
// $objectDefault->sql = "";
// $objectDefault->hostName = "";
// $objectDefault->password = "";
// $objectDefault->dbName =   "";
// $objectDefault->new_db("localhost", "root", "", "nsucms_demo_nsuniv");
//Creating Object NSUCMS
$objectSecond = new DBEVAL();
$objectSecond->sql = "";
$objectSecond->hostName = "";
$objectSecond->userName = "";
$objectSecond->password = "";
$objectSecond->dbName = "";
$objectSecond->new_db("localhost", "root", "", "zeit");
//All File Directries End
if (isset($_GET["action"])) {
    //Action Section Start
    /* ---------- All Admin(Backend) View Codes Start ---------- */

    /* ---------- All View Codes Start ------------------------- */
    //University Details Start
    if ($_GET["action"] == "get_university_details") {
        ?>
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Name</th>
            <th>Financial Year</th>
            <th>Academic Year</th>
            <th>Address </th>
        </tr>
    </thead>
    <tbody>
        <?php
                $sql = "SELECT * FROM `tbl_university_details`
                                WHERE `status` = '$visible'
                                ORDER BY `university_details_id` DESC
                                ";
                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
        <tr>
            <td>
                <?php echo $s_no; ?>
            </td>
            <td>
                <?php echo $row["university_details_university_name"]; ?>
            </td>
            <td>
                <?php echo date("d/m/Y", strtotime($row["university_details_financial_start_date"])); ?> To
                <?php echo date("d/m/Y", strtotime($row["university_details_financial_end_date"])); ?>
            </td>
            <td>
                <?php echo date("d/m/Y", strtotime($row["university_details_academic_start_date"])); ?> To
                <?php echo date("d/m/Y", strtotime($row["university_details_academic_end_date"])); ?>
            </td>
            <td>
                <?php echo $row["university_details_address"]; ?>
                Phone :
                <?php echo $row["university_details_contact"]; ?>
                Email:
                <?php echo $row["university_details_email"]; ?>
            </td>
        </tr>
        <?php
                        $s_no++;
                    }
                } else
                    echo '
                                <div class="alert alert-warning alert-dismissible">
                                    <i class="icon fas fa-exclamation-triangle"></i>  No data available now!!!
                                </div>';
                ?>
</table>
<script>
$(function() {
    $("#example1").DataTable();
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
    });
});
</script>
<?php
    }
    //University Details End



    //Nsuniv Get Started Enquiry Start
    if ($_GET["action"] == "get_nsuniv-admission-enquiry") {
        $objectSecond->update("tbl_alert", "`get_started_enquiry` = '0' WHERE `id`='1'");
        $objectSecond->sql = "";
        ?>
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Seleted Course</th>
            <th>Applicant Name</th>
            <th>Email</th>
            <th>Phone No</th>
            <th>Referred By</th>
            <th>State</th>
            <th>City</th>
            <th>Last Qualification</th>
            <th>Timing</th>
            <th class="project-actions text-center">Action </th>
        </tr>
    </thead>
    <tbody>
        <?php
                $objectDefault->select("admission_enquiry_tbl");
                $objectDefault->where("`is_deleted` = '0' ORDER BY `id` DESC");
                $result = $objectDefault->get();

                if ($result->num_rows > 0) {
                    while ($row = $objectDefault->get_row()) {
                        ?>
        <tr>
            <td>
                <?php echo $s_no; ?>
            </td>
            <td>
                <?php echo $row["admission_course"] ?>
            </td>
            <td>
                <?php echo $row["admission_name"] ?>
            </td>
            <td>
                <?php echo $row["admission_email"] ?>
            </td>
            <td>
                <?php echo $row["admission_phone"] ?>
            </td>
            <td>
                <?php echo $row["revert_by"] ?>
            </td>
            <td>
                <?php echo $row["admission_state"] ?>
            </td>
            <td>
                <?php echo $row["admission_city"] ?>
            </td>
            <td>
                <?php echo $row["admission_last_qualify"] ?>
            </td>
            <td>
                <?php echo $row["time"] ?>
            </td>
            <td class="project-actions text-center">
                <button class="btn btn-danger btn-sm"
                    onclick="document.getElementById('delete_university_get_enquiry<?php echo $row["id"]; ?>').style.display='block'">
                    <i class="fas fa-trash">
                    </i>
                    Delete
                </button>
            </td>

            <!-- Delete Section Start -->
            <div id="delete_university_get_enquiry<?php echo $row["id"]; ?>" class="w3-modal" style="z-index:2020;">
                <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
                    <header class="w3-container" style="background:#343a40; color:white;">
                        <span
                            onclick="document.getElementById('delete_university_get_enquiry<?php echo $row["id"]; ?>').style.display='none'"
                            class="w3-button w3-display-topright">&times;</span>
                        <h2 align="center">Are you sure???</h2>
                    </header>
                    <form id="delete_university_get_enquiry_form<?php echo $row["id"]; ?>" role="form" method="POST">
                        <div class="card-body">
                            <div class="col-md-12" id="delete_error_section<?php echo $row["id"]; ?>"></div>
                            <div class="col-md-12" align="center">
                                <input type='hidden' name='delete_id' id="delete_id<?php echo $row["id"]; ?>"
                                    value='<?php echo $row["id"]; ?>' />
                                <input type='hidden' name='action' id="action_delete<?php echo $row["id"]; ?>"
                                    value='delete_university_get_enquiry' />
                                <div class="col-md-12" id="delete_loader_section<?php echo $row["id"]; ?>"></div>
                                <button type="button" id="delete_university_get_enquiry_button<?php echo $row["id"]; ?>"
                                    class="btn btn-danger">Move To Trash</button>
                                <button type="button"
                                    onclick="document.getElementById('delete_university_get_enquiry<?php echo $row["id"]; ?>').style.display='none'"
                                    class="btn btn-primary">Cancel</button>
                            </div>

                            <!--<button type="reset" class="btn btn-danger">Reset</button>-->
                        </div>
                    </form>
                    <script>
                    $(function() {

                        $('#delete_university_get_enquiry_button<?php echo $row["id"]; ?>').click(function() {
                            $('#delete_loader_section<?php echo $row["id"]; ?>').append(
                                '<center id = "delete_loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /><br/><br/></center>'
                            );
                            $('#delete_university_get_enquiry_button<?php echo $row["id"]; ?>').prop(
                                'disabled', true);
                            var action = $("#action_delete<?php echo $row["id"]; ?>").val();
                            var delete_id = $("#delete_id<?php echo $row["id"]; ?>").val();
                            var dataString = 'action=' + action + '&delete_id=' + delete_id;

                            $.ajax({
                                url: 'include/controller.php',
                                type: 'POST',
                                data: dataString,
                                success: function(result) {
                                    //                                                                console.log(dataString);
                                    //                                                                console.log(result);
                                    $('#delete_response').remove();
                                    if (result == "error") {
                                        $('#delete_error_section<?php echo $row["id"]; ?>')
                                            .append(
                                                '<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                            );
                                    }
                                    if (result == "empty") {
                                        $('#delete_error_section<?php echo $row["id"]; ?>')
                                            .append(
                                                '<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                            );
                                    }
                                    if (result == "success") {
                                        $('#delete_error_section<?php echo $row["id"]; ?>')
                                            .append(
                                                '<div id = "delete_response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Enquiry Delete successfully!!!</div></div>'
                                            );
                                        showDeletedData();

                                        function showDeletedData() {
                                            $.ajax({
                                                url: 'include/view.php?action=get_nsuniv_get_enquiry',
                                                type: 'GET',
                                                success: function(result) {
                                                    $("#data_table").html(
                                                        result);
                                                }
                                            });
                                        }
                                    }
                                    $('#delete_loading').fadeOut(500, function() {
                                        $(this).remove();
                                        $('#delete_university_get_enquiry_button<?php echo $row["id"]; ?>')
                                            .prop('disabled', false);
                                    });
                                }

                            });
                        });

                    });
                    </script>
                </div>
            </div>
            <!-- Delete Section End -->
        </tr>
        <?php
                        $s_no++;
                    }
                } else
                    echo '
                                <div class="alert alert-warning alert-dismissible">
                                    <i class="icon fas fa-exclamation-triangle"></i>  No data available now!!!
                                </div>';
                ?>
    </tbody>
</table>
<script>
$(function() {
    $("#example1").DataTable();
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
    });
});
</script>
<?php
    }
    //Nsuniv Get Started Enquiry End


    // Student Examination  fee start
    include "view/fetch_student_examfee_details.php";
    //Student  Examination fee End

    include './view/holiday_view.php';

    include './view/leave_application_view.php';

    include './view/loan_application_view.php';

    include './view/course_view.php';
    include './view/amsstudent.php';
    include './view/amsteacher.php';
    include './view/amsgrade.php';
    include './view/amsattendance.php';
    //Subject Start
    if ($_GET["action"] == "get_subjects") {
        ?>
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Course Name</th>
            <th>Subject Code</th>
            <th>Subject Name</th>
            <th class="project-actions text-center">Action </th>
        </tr>
    </thead>
    <tbody>
        <?php
                $sql = "SELECT * FROM `tbl_subject`
                                WHERE `status` = '$visible'
                                ORDER BY `subject_id` DESC
                                ";
                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
        <tr>
            <td>
                <?php echo $s_no; ?>
            </td>
            <?php
                            $sql_course = "SELECT * FROM `tbl_course`
                                                       WHERE `status` = '$visible' && `course_id` = '" . $row["subject_course_name"] . "';
                                                       ";
                            $result_course = $con->query($sql_course);
                            $row_course = $result_course->fetch_assoc();
                            ?>
            <td>
                <?php echo $row_course["course_name"]; ?>
            </td>
            <td>
                <?php echo $row["subject_code"] ?>
            </td>
            <td>
                <?php echo $row["subject_name"] ?>
            </td>
            <td class="project-actions text-center">
                <button class="btn btn-info btn-sm"
                    onclick="document.getElementById('edit_subjects<?php echo $row["subject_id"]; ?>').style.display='block'">
                    <i class="fas fa-pencil-alt">
                    </i>
                    Edit
                </button>
                <button class="btn btn-danger btn-sm"
                    onclick="document.getElementById('delete_subjects<?php echo $row["subject_id"]; ?>').style.display='block'">
                    <i class="fas fa-trash">
                    </i>
                    Delete
                </button>
            </td>

            <!-- Subjects Edit Section Start -->
            <div id="edit_subjects<?php echo $row["subject_id"]; ?>" class="w3-modal" style="z-index:2020;">
                <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
                    <header class="w3-container" style="background:#343a40; color:white;">
                        <span
                            onclick="document.getElementById('edit_subjects<?php echo $row["subject_id"]; ?>').style.display='none'"
                            class="w3-button w3-display-topright">&times;</span>
                        <h2 align="center">Edit Subject</h2>
                    </header>
                    <form id="edit_subject_form<?php echo $row["subject_id"]; ?>" role="form" method="POST">
                        <div class="card-body">
                            <div class="col-md-12" id="edit_error_section<?php echo $row["subject_id"]; ?>"></div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Course Name</label>
                                    <select name="edit_subject_course_name"
                                        id="edit_subject_course_name<?php echo $row["subject_id"]; ?>"
                                        class="form-control select2" style="width: 100%;">
                                        <?php
                                                        $sql_course = "SELECT * FROM `tbl_course`
                                                                               WHERE `status` = '$visible'
                                                                               ";
                                                        $result_course = $con->query($sql_course);
                                                        while ($row_course = $result_course->fetch_assoc()) {
                                                            ?>
                                        <option value="<?php echo $row_course["course_id"]; ?>" <?php if ($row_course["course_id"] == $row["subject_course_name"])
                                                                   echo 'selected'; ?>>
                                            <?php echo $row_course["course_name"]; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Subject Code</label>
                                    <input type="text" name="edit_subject_code"
                                        id="edit_subject_code<?php echo $row["subject_id"]; ?>" class="form-control"
                                        value="<?php echo $row["subject_code"]; ?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Subject Name</label>
                                    <input type="text" name="edit_subject_name"
                                        id="edit_subject_name<?php echo $row["subject_id"]; ?>" class="form-control"
                                        value="<?php echo $row["subject_name"]; ?>">
                                </div>

                            </div>
                            <input type='hidden' name='edit_subject_id'
                                id="edit_subject_id<?php echo $row["subject_id"]; ?>"
                                value='<?php echo $row["subject_id"]; ?>' />
                            <input type='hidden' name='action' id="action<?php echo $row["subject_id"]; ?>"
                                value='edit_subjects' />
                            <div class="col-md-12" id="edit_loader_section<?php echo $row["subject_id"]; ?>"></div>
                            <button type="button" id="edit_subject_button<?php echo $row["subject_id"]; ?>"
                                class="btn btn-primary">Update</button>
                            <!--<button type="reset" class="btn btn-danger">Reset</button>-->
                        </div>
                    </form>
                    <script>
                    $(function() {

                        $('#edit_subject_button<?php echo $row["subject_id"]; ?>').click(function() {
                            $('#edit_loader_section<?php echo $row["subject_id"]; ?>').append(
                                '<center id = "edit_loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /></center>'
                            );
                            $('#edit_subject_button<?php echo $row["subject_id"]; ?>').prop('disabled',
                                true);
                            var action = $("#action<?php echo $row["subject_id"]; ?>").val();
                            var edit_subject_id = $("#edit_subject_id<?php echo $row["subject_id"]; ?>")
                                .val();
                            var edit_subject_course_name = $(
                                "#edit_subject_course_name<?php echo $row["subject_id"]; ?>").val();
                            var edit_subject_code = $(
                                "#edit_subject_code<?php echo $row["subject_id"]; ?>").val();
                            var edit_subject_name = $(
                                "#edit_subject_name<?php echo $row["subject_id"]; ?>").val();
                            var dataString = 'action=' + action + '&edit_subject_id=' +
                                edit_subject_id + '&edit_subject_course_name=' +
                                edit_subject_course_name + '&edit_subject_code=' + edit_subject_code +
                                '&edit_subject_name=' + edit_subject_name;

                            $.ajax({
                                url: 'include/controller.php',
                                type: 'POST',
                                data: dataString,
                                success: function(result) {
                                    $('#edit_response').remove();
                                    if (result == "exsits") {
                                        $('#edit_error_section<?php echo $row["subject_id"]; ?>')
                                            .append(
                                                '<div id = "edit_response"><div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-exclamation-triangle"></i> This Subject Code already exsits!!!</div></div>'
                                            );
                                    }
                                    if (result == "error") {
                                        $('#edit_error_section<?php echo $row["subject_id"]; ?>')
                                            .append(
                                                '<div id = "edit_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                            );
                                    }
                                    if (result == "empty") {
                                        $('#edit_error_section<?php echo $row["subject_id"]; ?>')
                                            .append(
                                                '<div id = "edit_response"><div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-exclamation-triangle"></i>  Please fill out All Required fields!!!</div></div>'
                                            );
                                    }
                                    if (result == "success") {
                                        $('#edit_error_section<?php echo $row["subject_id"]; ?>')
                                            .append(
                                                '<div id = "edit_response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Subject Updated successfully!!!</div></div>'
                                            );
                                        showUpdatedData();

                                        function showUpdatedData() {
                                            $.ajax({
                                                url: 'include/view.php?action=get_subjects',
                                                type: 'GET',
                                                success: function(result) {
                                                    $("#data_table").html(
                                                        result);
                                                }
                                            });
                                        }
                                    }
                                    $('#edit_loading').fadeOut(500, function() {
                                        $(this).remove();
                                    });
                                    $('#edit_subject_button<?php echo $row["subject_id"]; ?>')
                                        .prop('disabled', false);
                                }

                            });
                        });

                    });
                    </script>
                </div>
            </div>
            <!-- Subjects Edit Section End -->

            <!-- Subjects delete Section Start -->
            <div id="delete_subjects<?php echo $row["subject_id"]; ?>" class="w3-modal" style="z-index:2020;">
                <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
                    <header class="w3-container" style="background:#343a40; color:white;">
                        <span
                            onclick="document.getElementById('delete_subjects<?php echo $row["subject_id"]; ?>').style.display='none'"
                            class="w3-button w3-display-topright">&times;</span>
                        <h2 align="center">Are you sure???</h2>
                    </header>
                    <form id="delete_subject_form<?php echo $row["subject_id"]; ?>" role="form" method="POST">
                        <div class="card-body">
                            <div class="col-md-12" id="delete_error_section<?php echo $row["subject_id"]; ?>"></div>
                            <div class="col-md-12" align="center">
                                <input type='hidden' name='delete_subject_id'
                                    id="delete_subject_id<?php echo $row["subject_id"]; ?>"
                                    value='<?php echo $row["subject_id"]; ?>' />
                                <input type='hidden' name='action' id="action_delete<?php echo $row["subject_id"]; ?>"
                                    value='delete_subjects' />
                                <div class="col-md-12" id="delete_loader_section<?php echo $row["subject_id"]; ?>">
                                </div>
                                <button type="button" id="delete_subject_button<?php echo $row["subject_id"]; ?>"
                                    class="btn btn-danger">Move To Trash</button>
                                <button type="button"
                                    onclick="document.getElementById('delete_subjects<?php echo $row["subject_id"]; ?>').style.display='none'"
                                    class="btn btn-primary">Cancel</button>
                            </div>

                            <!--<button type="reset" class="btn btn-danger">Reset</button>-->
                        </div>
                    </form>
                    <script>
                    $(function() {

                        $('#delete_subject_button<?php echo $row["subject_id"]; ?>').click(function() {
                            $('#delete_loader_section<?php echo $row["subject_id"]; ?>').append(
                                '<center id = "delete_loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /><br/><br/></center>'
                            );
                            $('#delete_subject_button<?php echo $row["subject_id"]; ?>').prop(
                                'disabled', true);
                            var action = $("#action_delete<?php echo $row["subject_id"]; ?>").val();
                            var delete_subject_id = $(
                                "#delete_subject_id<?php echo $row["subject_id"]; ?>").val();
                            var dataString = 'action=' + action + '&delete_subject_id=' +
                                delete_subject_id;

                            $.ajax({
                                url: 'include/controller.php',
                                type: 'POST',
                                data: dataString,
                                success: function(result) {
                                    $('#delete_response').remove();
                                    if (result == "error") {
                                        $('#delete_error_section<?php echo $row["subject_id"]; ?>')
                                            .append(
                                                '<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                            );
                                    }
                                    if (result == "empty") {
                                        $('#delete_error_section<?php echo $row["subject_id"]; ?>')
                                            .append(
                                                '<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                            );
                                    }
                                    if (result == "success") {
                                        $('#delete_error_section<?php echo $row["subject_id"]; ?>')
                                            .append(
                                                '<div id = "delete_response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Subject Delete successfully!!!</div></div>'
                                            );
                                        showDeletedData();

                                        function showDeletedData() {
                                            $.ajax({
                                                url: 'include/view.php?action=get_subjects',
                                                type: 'GET',
                                                success: function(result) {
                                                    $("#data_table").html(
                                                        result);
                                                }
                                            });
                                        }
                                    }
                                    $('#delete_loading').fadeOut(500, function() {
                                        $(this).remove();
                                    });
                                    $('#delete_subject_button<?php echo $row["subject_id"]; ?>')
                                        .prop('disabled', false);
                                }

                            });
                        });

                    });
                    </script>
                </div>
            </div>
            <!-- Subjects delete Section End -->
        </tr>
        <?php
                        $s_no++;
                    }
                } else
                    echo '
                                <div class="alert alert-warning alert-dismissible">
                                    <i class="icon fas fa-exclamation-triangle"></i>  No data available now!!!
                                </div>';
                ?>
    </tbody>
</table>
<script>
$(function() {
    $("#example1").DataTable();
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
    });
});
</script>
<?php
    }
    //Subject End
    //All Deleted Lists Start
    if ($_GET["action"] == "get_trash") {
        ?>
<!-- Deleted Items From Course Start -->
<label style="color:red;"> Course Deleted List </label>
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Course Name</th>
            <th class="project-actions text-center">Action </th>
        </tr>
    </thead>
    <tbody>
        <?php
                $sql = "SELECT * FROM `tbl_course`
                                WHERE `status` = '$trash'
                                ORDER BY `course_id` DESC
                                ";
                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
        <tr>
            <td>
                <?php echo $s_no; ?>
            </td>
            <td>
                <?php echo $row["course_name"]; ?>
            </td>
            <td class="project-actions text-center">
                <button class="btn btn-primary btn-sm"
                    onclick="document.getElementById('trase_courses_restore<?php echo $row["course_id"]; ?>').style.display='block'">
                    <i class="far fa-circle nav-icon">
                    </i>
                    Restore
                </button>
                <button class="btn btn-danger btn-sm"
                    onclick="document.getElementById('trase_courses_delete<?php echo $row["course_id"]; ?>').style.display='block'">
                    <i class="fas fa-trash nav-icon">
                    </i>
                    Delete
                </button>
            </td>

            <!-- Courses delete Section Start -->
            <div id="trase_courses_delete<?php echo $row["course_id"]; ?>" class="w3-modal" style="z-index:2020;">
                <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
                    <header class="w3-container" style="background:#343a40; color:white;">
                        <span
                            onclick="document.getElementById('trase_courses_delete<?php echo $row["course_id"]; ?>').style.display='none'"
                            class="w3-button w3-display-topright">&times;</span>
                        <h2 align="center">Are you sure???</h2>
                    </header>
                    <form id="trase_courses_delete_form<?php echo $row["course_id"]; ?>" role="form" method="POST">
                        <div class="card-body">
                            <div class="col-md-12"
                                id="trase_courses_delete_error_section<?php echo $row["course_id"]; ?>"></div>
                            <div class="col-md-12" align="center">
                                <input type='hidden' name='action'
                                    id="action_trase_courses_delete<?php echo $row["course_id"]; ?>"
                                    value='trash_delete' />
                                <input type='hidden' name='action_tbl'
                                    id="action_trase_courses_delete_tbl<?php echo $row["course_id"]; ?>"
                                    value='tbl_course' />
                                <input type='hidden' name='delete_id'
                                    id="trase_courses_delete_course_id<?php echo $row["course_id"]; ?>"
                                    value='<?php echo $row["course_id"]; ?>' />
                                <div class="col-md-12"
                                    id="trase_courses_delete_loader_section<?php echo $row["course_id"]; ?>"></div>
                                <button type="button"
                                    id="trase_courses_delete_course_button<?php echo $row["course_id"]; ?>"
                                    class="btn btn-danger">Delete Permanently</button>
                                <button type="button"
                                    onclick="document.getElementById('trase_courses_delete<?php echo $row["course_id"]; ?>').style.display='none'"
                                    class="btn btn-primary">Cancel</button>
                            </div>
                        </div>
                    </form>
                    <script>
                    $(function() {

                        $('#trase_courses_delete_course_button<?php echo $row["course_id"]; ?>').click(
                            function() {
                                $('#trase_courses_delete_loader_section<?php echo $row["course_id"]; ?>')
                                    .append(
                                        '<center id = "delete_loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /><br/><br/></center>'
                                    );
                                $('#trase_courses_delete_course_button<?php echo $row["course_id"]; ?>')
                                    .prop('disabled', true);

                                var action = $(
                                        "#action_trase_courses_delete<?php echo $row["course_id"]; ?>")
                                    .val();
                                var action_tbl = $(
                                        "#action_trase_courses_delete_tbl<?php echo $row["course_id"]; ?>")
                                    .val();
                                var delete_id = $(
                                        "#trase_courses_delete_course_id<?php echo $row["course_id"]; ?>")
                                    .val();
                                var dataString = 'action=' + action + '&action_tbl=' + action_tbl +
                                    '&delete_id=' + delete_id;

                                $.ajax({
                                    url: 'include/controller.php',
                                    type: 'POST',
                                    data: dataString,
                                    success: function(result) {
                                        $('#delete_response').remove();
                                        if (result == "error") {
                                            $('#trase_courses_delete_error_section<?php echo $row["course_id"]; ?>')
                                                .append(
                                                    '<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                                );
                                        }
                                        if (result == "empty") {
                                            $('#trase_courses_delete_error_section<?php echo $row["course_id"]; ?>')
                                                .append(
                                                    '<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                                );
                                        }
                                        if (result == "success") {
                                            $('#trase_courses_delete_error_section<?php echo $row["course_id"]; ?>')
                                                .append(
                                                    '<div id = "delete_response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Course Delete successfully!!!</div></div>'
                                                );
                                            showDeletedData();

                                            function showDeletedData() {
                                                $.ajax({
                                                    url: 'include/view.php?action=get_trash',
                                                    type: 'GET',
                                                    success: function(result) {
                                                        $("#data_table").html(
                                                            result);
                                                    }
                                                });
                                            }
                                        }
                                        $('#delete_loading').fadeOut(500, function() {
                                            $(this).remove();
                                        });
                                        $('#trase_courses_delete_course_button<?php echo $row["course_id"]; ?>')
                                            .prop('disabled', false);
                                    }

                                });
                            });

                    });
                    </script>
                </div>
            </div>
            <!-- Courses delete Section End -->
            <!-- Courses restore Section Start -->
            <div id="trase_courses_restore<?php echo $row["course_id"]; ?>" class="w3-modal" style="z-index:2020;">
                <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
                    <header class="w3-container" style="background:#343a40; color:white;">
                        <span
                            onclick="document.getElementById('trase_courses_restore<?php echo $row["course_id"]; ?>').style.display='none'"
                            class="w3-button w3-display-topright">&times;</span>
                        <h2 align="center">Are you sure???</h2>
                    </header>
                    <form id="trase_courses_restore_form<?php echo $row["course_id"]; ?>" role="form" method="POST">
                        <div class="card-body">
                            <div class="col-md-12"
                                id="trase_courses_restore_error_section<?php echo $row["course_id"]; ?>"></div>
                            <div class="col-md-12" align="center">
                                <input type='hidden' name='action'
                                    id="action_trase_courses_restore<?php echo $row["course_id"]; ?>"
                                    value='trash_restore' />
                                <input type='hidden' name='action_tbl'
                                    id="action_trase_courses_restore_tbl<?php echo $row["course_id"]; ?>"
                                    value='tbl_course' />
                                <input type='hidden' name='restore_id'
                                    id="trase_courses_restore_course_id<?php echo $row["course_id"]; ?>"
                                    value='<?php echo $row["course_id"]; ?>' />
                                <div class="col-md-12"
                                    id="trase_courses_restore_loader_section<?php echo $row["course_id"]; ?>"></div>
                                <button type="button"
                                    id="trase_courses_restore_course_button<?php echo $row["course_id"]; ?>"
                                    class="btn btn-danger">Restore Now</button>
                                <button type="button"
                                    onclick="document.getElementById('trase_courses_restore<?php echo $row["course_id"]; ?>').style.display='none'"
                                    class="btn btn-primary">Cancel</button>
                            </div>
                        </div>
                    </form>
                    <script>
                    $(function() {

                        $('#trase_courses_restore_course_button<?php echo $row["course_id"]; ?>').click(
                            function() {
                                $('#trase_courses_restore_loader_section<?php echo $row["course_id"]; ?>')
                                    .append(
                                        '<center id = "restore_loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /><br/><br/></center>'
                                    );
                                $('#trase_courses_restore_course_button<?php echo $row["course_id"]; ?>')
                                    .prop('disabled', true);

                                var action = $(
                                        "#action_trase_courses_restore<?php echo $row["course_id"]; ?>")
                                    .val();
                                var action_tbl = $(
                                        "#action_trase_courses_restore_tbl<?php echo $row["course_id"]; ?>")
                                    .val();
                                var restore_id = $(
                                        "#trase_courses_restore_course_id<?php echo $row["course_id"]; ?>")
                                    .val();
                                var dataString = 'action=' + action + '&action_tbl=' + action_tbl +
                                    '&restore_id=' + restore_id;

                                $.ajax({
                                    url: 'include/controller.php',
                                    type: 'POST',
                                    data: dataString,
                                    success: function(result) {
                                        $('#restore_response').remove();
                                        if (result == "error") {
                                            $('#trase_courses_restore_error_section<?php echo $row["course_id"]; ?>')
                                                .append(
                                                    '<div id = "restore_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                                );
                                        }
                                        if (result == "empty") {
                                            $('#trase_courses_restore_error_section<?php echo $row["course_id"]; ?>')
                                                .append(
                                                    '<div id = "restore_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                                );
                                        }
                                        if (result == "success") {
                                            $('#trase_courses_restore_error_section<?php echo $row["course_id"]; ?>')
                                                .append(
                                                    '<div id = "restore_response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Course Restore successfully!!!</div></div>'
                                                );
                                            showRestoredData();

                                            function showRestoredData() {
                                                $.ajax({
                                                    url: 'include/view.php?action=get_trash',
                                                    type: 'GET',
                                                    success: function(result) {
                                                        $("#data_table").html(
                                                            result);
                                                    }
                                                });
                                            }
                                        }
                                        $('#restore_loading').fadeOut(500, function() {
                                            $(this).remove();
                                        });
                                        $('#trase_courses_restore_course_button<?php echo $row["course_id"]; ?>')
                                            .prop('disabled', false);
                                    }

                                });
                            });

                    });
                    </script>
                </div>
            </div>
            <!-- Courses restore Section End -->
        </tr>
        <?php
                        $s_no++;
                    }
                } else
                    echo '
                                <div class="alert alert-warning alert-dismissible">
                                    <i class="icon fas fa-exclamation-triangle"></i>  No Any Deleted Items Now!!!
                                </div>';
                ?>
    </tbody>
</table>
<script>
$(function() {
    $("#example1").DataTable();
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
    });
});
</script>
<!-- Deleted Items From Course End -->
<br /><br />
<!-- Deleted Items From Subject Start -->
<label style="color:red;"> Subject Deleted List </label>
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Course Name</th>
            <th>Subject Code</th>
            <th>Subject Name</th>
            <th class="project-actions text-center">Action </th>
        </tr>
    </thead>
    <tbody>
        <?php
                $sql = "SELECT * FROM `tbl_subject`
                                WHERE `status` = '$trash'
                                ORDER BY `subject_id` DESC
                                ";
                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
        <tr>
            <td>
                <?php echo $s_no; ?>
            </td>
            <?php
                            $sql_course = "SELECT * FROM `tbl_course`
                                                       WHERE `status` = '$visible' && `course_id` = '" . $row["subject_course_name"] . "';
                                                       ";
                            $result_course = $con->query($sql_course);
                            $row_course = $result_course->fetch_assoc();
                            ?>
            <td>
                <?php echo $row_course["course_name"]; ?>
            </td>
            <td>
                <?php echo $row["subject_code"] ?>
            </td>
            <td>
                <?php echo $row["subject_name"] ?>
            </td>
            <td class="project-actions text-center">
                <button class="btn btn-primary btn-sm"
                    onclick="document.getElementById('trase_subjects_restore<?php echo $row["subject_id"]; ?>').style.display='block'">
                    <i class="far fa-circle nav-icon">
                    </i>
                    Restore
                </button>
                <button class="btn btn-danger btn-sm"
                    onclick="document.getElementById('trase_subjects_delete<?php echo $row["subject_id"]; ?>').style.display='block'">
                    <i class="fas fa-trash nav-icon">
                    </i>
                    Delete
                </button>
            </td>

            <!-- Subjects delete Section Start -->
            <div id="trase_subjects_delete<?php echo $row["subject_id"]; ?>" class="w3-modal" style="z-index:2020;">
                <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
                    <header class="w3-container" style="background:#343a40; color:white;">
                        <span
                            onclick="document.getElementById('trase_subjects_delete<?php echo $row["subject_id"]; ?>').style.display='none'"
                            class="w3-button w3-display-topright">&times;</span>
                        <h2 align="center">Are you sure???</h2>
                    </header>
                    <form id="trase_subjects_delete_form<?php echo $row["subject_id"]; ?>" role="form" method="POST">
                        <div class="card-body">
                            <div class="col-md-12"
                                id="trase_subjects_delete_error_section<?php echo $row["subject_id"]; ?>"></div>
                            <div class="col-md-12" align="center">
                                <input type='hidden' name='action'
                                    id="action_trase_subjects_delete<?php echo $row["subject_id"]; ?>"
                                    value='trash_delete' />
                                <input type='hidden' name='action_tbl'
                                    id="action_trase_subjects_delete_tbl<?php echo $row["subject_id"]; ?>"
                                    value='tbl_subject' />
                                <input type='hidden' name='delete_id'
                                    id="trase_subjects_delete_subject_id<?php echo $row["subject_id"]; ?>"
                                    value='<?php echo $row["subject_id"]; ?>' />
                                <div class="col-md-12"
                                    id="trase_subjects_delete_loader_section<?php echo $row["subject_id"]; ?>"></div>
                                <button type="button"
                                    id="trase_subjects_delete_subject_button<?php echo $row["subject_id"]; ?>"
                                    class="btn btn-danger">Delete Permanently</button>
                                <button type="button"
                                    onclick="document.getElementById('trase_subjects_delete<?php echo $row["subject_id"]; ?>').style.display='none'"
                                    class="btn btn-primary">Cancel</button>
                            </div>
                        </div>
                    </form>
                    <script>
                    $(function() {

                        $('#trase_subjects_delete_subject_button<?php echo $row["subject_id"]; ?>').click(
                            function() {
                                $('#trase_subjects_delete_loader_section<?php echo $row["subject_id"]; ?>')
                                    .append(
                                        '<center id = "delete_loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /><br/><br/></center>'
                                    );
                                $('#trase_subjects_delete_subject_button<?php echo $row["subject_id"]; ?>')
                                    .prop('disabled', true);

                                var action = $(
                                        "#action_trase_subjects_delete<?php echo $row["subject_id"]; ?>")
                                    .val();
                                var action_tbl = $(
                                    "#action_trase_subjects_delete_tbl<?php echo $row["subject_id"]; ?>"
                                ).val();
                                var delete_id = $(
                                    "#trase_subjects_delete_subject_id<?php echo $row["subject_id"]; ?>"
                                ).val();
                                var dataString = 'action=' + action + '&action_tbl=' + action_tbl +
                                    '&delete_id=' + delete_id;

                                $.ajax({
                                    url: 'include/controller.php',
                                    type: 'POST',
                                    data: dataString,
                                    success: function(result) {
                                        $('#delete_response').remove();
                                        if (result == "error") {
                                            $('#trase_subjects_delete_error_section<?php echo $row["subject_id"]; ?>')
                                                .append(
                                                    '<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                                );
                                        }
                                        if (result == "empty") {
                                            $('#trase_subjects_delete_error_section<?php echo $row["subject_id"]; ?>')
                                                .append(
                                                    '<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                                );
                                        }
                                        if (result == "success") {
                                            $('#trase_subjects_delete_error_section<?php echo $row["subject_id"]; ?>')
                                                .append(
                                                    '<div id = "delete_response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Subject Delete successfully!!!</div></div>'
                                                );
                                            showDeletedData();

                                            function showDeletedData() {
                                                $.ajax({
                                                    url: 'include/view.php?action=get_trash',
                                                    type: 'GET',
                                                    success: function(result) {
                                                        $("#data_table").html(
                                                            result);
                                                    }
                                                });
                                            }
                                        }
                                        $('#delete_loading').fadeOut(500, function() {
                                            $(this).remove();
                                        });
                                        $('#trase_subjects_delete_subject_button<?php echo $row["subject_id"]; ?>')
                                            .prop('disabled', false);
                                    }

                                });
                            });

                    });
                    </script>
                </div>
            </div>
            <!-- Subjects delete Section End -->
            <!-- Subjects restore Section Start -->
            <div id="trase_subjects_restore<?php echo $row["subject_id"]; ?>" class="w3-modal" style="z-index:2020;">
                <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
                    <header class="w3-container" style="background:#343a40; color:white;">
                        <span
                            onclick="document.getElementById('trase_subjects_restore<?php echo $row["subject_id"]; ?>').style.display='none'"
                            class="w3-button w3-display-topright">&times;</span>
                        <h2 align="center">Are you sure???</h2>
                    </header>
                    <form id="trase_subjects_restore_form<?php echo $row["subject_id"]; ?>" role="form" method="POST">
                        <div class="card-body">
                            <div class="col-md-12"
                                id="trase_subjects_restore_error_section<?php echo $row["subject_id"]; ?>"></div>
                            <div class="col-md-12" align="center">
                                <input type='hidden' name='action'
                                    id="action_trase_subjects_restore<?php echo $row["subject_id"]; ?>"
                                    value='trash_restore' />
                                <input type='hidden' name='action_tbl'
                                    id="action_trase_subjects_restore_tbl<?php echo $row["subject_id"]; ?>"
                                    value='tbl_subject' />
                                <input type='hidden' name='restore_id'
                                    id="trase_subjects_restore_subject_id<?php echo $row["subject_id"]; ?>"
                                    value='<?php echo $row["subject_id"]; ?>' />
                                <div class="col-md-12"
                                    id="trase_subjects_restore_loader_section<?php echo $row["subject_id"]; ?>"></div>
                                <button type="button"
                                    id="trase_subjects_restore_subject_button<?php echo $row["subject_id"]; ?>"
                                    class="btn btn-danger">Restore Now</button>
                                <button type="button"
                                    onclick="document.getElementById('trase_subjects_restore<?php echo $row["subject_id"]; ?>').style.display='none'"
                                    class="btn btn-primary">Cancel</button>
                            </div>
                        </div>
                    </form>
                    <script>
                    $(function() {

                        $('#trase_subjects_restore_subject_button<?php echo $row["subject_id"]; ?>').click(
                            function() {
                                $('#trase_subjects_restore_loader_section<?php echo $row["subject_id"]; ?>')
                                    .append(
                                        '<center id = "restore_loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /><br/><br/></center>'
                                    );
                                $('#trase_subjects_restore_subject_button<?php echo $row["subject_id"]; ?>')
                                    .prop('disabled', true);

                                var action = $(
                                        "#action_trase_subjects_restore<?php echo $row["subject_id"]; ?>")
                                    .val();
                                var action_tbl = $(
                                    "#action_trase_subjects_restore_tbl<?php echo $row["subject_id"]; ?>"
                                ).val();
                                var restore_id = $(
                                    "#trase_subjects_restore_subject_id<?php echo $row["subject_id"]; ?>"
                                ).val();
                                var dataString = 'action=' + action + '&action_tbl=' + action_tbl +
                                    '&restore_id=' + restore_id;

                                $.ajax({
                                    url: 'include/controller.php',
                                    type: 'POST',
                                    data: dataString,
                                    success: function(result) {
                                        $('#restore_response').remove();
                                        if (result == "error") {
                                            $('#trase_subjects_restore_error_section<?php echo $row["subject_id"]; ?>')
                                                .append(
                                                    '<div id = "restore_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                                );
                                        }
                                        if (result == "empty") {
                                            $('#trase_subjects_restore_error_section<?php echo $row["subject_id"]; ?>')
                                                .append(
                                                    '<div id = "restore_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                                );
                                        }
                                        if (result == "success") {
                                            $('#trase_subjects_restore_error_section<?php echo $row["subject_id"]; ?>')
                                                .append(
                                                    '<div id = "restore_response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Subject Restore successfully!!!</div></div>'
                                                );
                                            showRestoredData();

                                            function showRestoredData() {
                                                $.ajax({
                                                    url: 'include/view.php?action=get_trash',
                                                    type: 'GET',
                                                    success: function(result) {
                                                        $("#data_table").html(
                                                            result);
                                                    }
                                                });
                                            }
                                        }
                                        $('#restore_loading').fadeOut(500, function() {
                                            $(this).remove();
                                        });
                                        $('#trase_subjects_restore_subject_button<?php echo $row["subject_id"]; ?>')
                                            .prop('disabled', false);
                                    }

                                });
                            });

                    });
                    </script>
                </div>
            </div>
            <!-- Subjects restore Section End -->
        </tr>
        <?php
                        $s_no++;
                    }
                } else
                    echo '
                                <div class="alert alert-warning alert-dismissible">
                                    <i class="icon fas fa-exclamation-triangle"></i>  No Any Deleted Items Now!!!
                                </div>';
                ?>
    </tbody>
</table>
<script>
$(function() {
    $("#example1").DataTable();
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
    });
});
</script>
<!-- Deleted Items From Subject End -->
<!-- Deleted Items From prospectus Start -->
<label style="color:red;"> Prospectus Deleted List </label>
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Prospectus No</th>
            <th class="project-actions text-center">Action </th>
        </tr>
    </thead>
    <tbody>
        <?php
                $sql = "SELECT * FROM `tbl_prospectus`
                                WHERE `status` = '$trash'
                                ORDER BY `id` DESC
                                ";
                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
        <tr>
            <td>
                <?php echo $s_no; ?>
            </td>
            <td>
                <?php echo $row["prospectus_no"]; ?>
            </td>
            <td class="project-actions text-center">
                <button class="btn btn-primary btn-sm"
                    onclick="document.getElementById('trase_prospectus_restore<?php echo $row["id"]; ?>').style.display='block'">
                    <i class="far fa-circle nav-icon">
                    </i>
                    Restore
                </button>
                <button class="btn btn-danger btn-sm"
                    onclick="document.getElementById('trase_prospectus_delete<?php echo $row["id"]; ?>').style.display='block'">
                    <i class="fas fa-trash nav-icon">
                    </i>
                    Delete
                </button>
            </td>

            <!-- prospectus delete Section Start -->
            <div id="trase_prospectus_delete<?php echo $row["id"]; ?>" class="w3-modal" style="z-index:2020;">
                <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
                    <header class="w3-container" style="background:#343a40; color:white;">
                        <span
                            onclick="document.getElementById('trase_prospectus_delete<?php echo $row["id"]; ?>').style.display='none'"
                            class="w3-button w3-display-topright">&times;</span>
                        <h2 align="center">Are you sure???</h2>
                    </header>
                    <form id="trase_prospectus_delete_form<?php echo $row["id"]; ?>" role="form" method="POST">
                        <div class="card-body">
                            <div class="col-md-12" id="trase_prospectus_delete_error_section<?php echo $row["id"]; ?>">
                            </div>
                            <div class="col-md-12" align="center">
                                <input type='hidden' name='action'
                                    id="action_trase_prospectus_delete<?php echo $row["id"]; ?>" value='trash_delete' />
                                <input type='hidden' name='action_tbl'
                                    id="action_trase_prospectus_delete_tbl<?php echo $row["id"]; ?>"
                                    value='tbl_prospectus' />
                                <input type='hidden' name='delete_id'
                                    id="trase_prospectus_delete_id<?php echo $row["id"]; ?>"
                                    value='<?php echo $row["id"]; ?>' />
                                <div class="col-md-12"
                                    id="trase_prospectus_delete_loader_section<?php echo $row["id"]; ?>"></div>
                                <button type="button"
                                    id="trase_prospectus_delete_prospectus_button<?php echo $row["id"]; ?>"
                                    class="btn btn-danger">Delete Permanently</button>
                                <button type="button"
                                    onclick="document.getElementById('trase_prospectus_delete<?php echo $row["id"]; ?>').style.display='none'"
                                    class="btn btn-primary">Cancel</button>
                            </div>
                        </div>
                    </form>
                    <script>
                    $(function() {

                        $('#trase_prospectus_delete_prospectus_button<?php echo $row["id"]; ?>').click(
                            function() {
                                $('#trase_prospectus_delete_loader_section<?php echo $row["id"]; ?>')
                                    .append(
                                        '<center id = "delete_loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /><br/><br/></center>'
                                    );
                                $('#trase_prospectus_delete_prospectus_button<?php echo $row["id"]; ?>')
                                    .prop('disabled', true);

                                var action = $("#action_trase_prospectus_delete<?php echo $row["id"]; ?>")
                                    .val();
                                var action_tbl = $(
                                        "#action_trase_prospectus_delete_tbl<?php echo $row["id"]; ?>")
                                    .val();
                                var delete_id = $("#trase_prospectus_delete_id<?php echo $row["id"]; ?>")
                                    .val();
                                var dataString = 'action=' + action + '&action_tbl=' + action_tbl +
                                    '&delete_id=' + delete_id;

                                $.ajax({
                                    url: 'include/controller.php',
                                    type: 'POST',
                                    data: dataString,
                                    success: function(result) {
                                        $('#delete_response').remove();
                                        if (result == "error") {
                                            $('#trase_prospectus_delete_error_section<?php echo $row["id"]; ?>')
                                                .append(
                                                    '<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                                );
                                        }
                                        if (result == "empty") {
                                            $('#trase_prospectus_delete_error_section<?php echo $row["id"]; ?>')
                                                .append(
                                                    '<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                                );
                                        }
                                        if (result == "success") {
                                            $('#trase_prospectus_delete_error_section<?php echo $row["id"]; ?>')
                                                .append(
                                                    '<div id = "delete_response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Course Delete successfully!!!</div></div>'
                                                );
                                            showDeletedData();

                                            function showDeletedData() {
                                                $.ajax({
                                                    url: 'include/view.php?action=get_trash',
                                                    type: 'GET',
                                                    success: function(result) {
                                                        $("#data_table").html(
                                                            result);
                                                    }
                                                });
                                            }
                                        }
                                        $('#delete_loading').fadeOut(500, function() {
                                            $(this).remove();
                                        });
                                        $('#trase_prospectus_delete_prospectus_button<?php echo $row["id"]; ?>')
                                            .prop('disabled', false);
                                    }

                                });
                            });

                    });
                    </script>
                </div>
            </div>
            <!-- prospectus delete Section End -->
            <!-- prospectus restore Section Start -->
            <div id="trase_prospectus_restore<?php echo $row["id"]; ?>" class="w3-modal" style="z-index:2020;">
                <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
                    <header class="w3-container" style="background:#343a40; color:white;">
                        <span
                            onclick="document.getElementById('trase_prospectus_restore<?php echo $row["id"]; ?>').style.display='none'"
                            class="w3-button w3-display-topright">&times;</span>
                        <h2 align="center">Are you sure???</h2>
                    </header>
                    <form id="trase_prospectus_restore_form<?php echo $row["id"]; ?>" role="form" method="POST">
                        <div class="card-body">
                            <div class="col-md-12" id="trase_prospectus_restore_error_section<?php echo $row["id"]; ?>">
                            </div>
                            <div class="col-md-12" align="center">
                                <input type='hidden' name='action'
                                    id="action_trase_prospectus_restore<?php echo $row["id"]; ?>"
                                    value='trash_restore' />
                                <input type='hidden' name='action_tbl'
                                    id="action_trase_prospectus_restore_tbl<?php echo $row["id"]; ?>"
                                    value='tbl_prospectus' />
                                <input type='hidden' name='restore_id'
                                    id="trase_prospectus_restore_id<?php echo $row["id"]; ?>"
                                    value='<?php echo $row["id"]; ?>' />
                                <div class="col-md-12"
                                    id="trase_prospectus_restore_loader_section<?php echo $row["id"]; ?>"></div>
                                <button type="button"
                                    id="trase_prospectus_restore_course_button<?php echo $row["id"]; ?>"
                                    class="btn btn-danger">Restore Now</button>
                                <button type="button"
                                    onclick="document.getElementById('trase_prospectus_restore<?php echo $row["id"]; ?>').style.display='none'"
                                    class="btn btn-primary">Cancel</button>
                            </div>
                        </div>
                    </form>
                    <script>
                    $(function() {

                        $('#trase_prospectus_restore_prospectus_button<?php echo $row["id"]; ?>').click(
                            function() {
                                $('#trase_prospectus_restore_loader_section<?php echo $row["id"]; ?>')
                                    .append(
                                        '<center id = "restore_loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /><br/><br/></center>'
                                    );
                                $('#trase_prospectus_restore_prospectus_button<?php echo $row["id"]; ?>')
                                    .prop('disabled', true);

                                var action = $("#action_trase_prospectus_restore<?php echo $row["id"]; ?>")
                                    .val();
                                var action_tbl = $(
                                        "#action_trase_prospectus_restore_tbl<?php echo $row["id"]; ?>")
                                    .val();
                                var restore_id = $("#trase_prospectus_restore_id<?php echo $row["id"]; ?>")
                                    .val();
                                var dataString = 'action=' + action + '&action_tbl=' + action_tbl +
                                    '&restore_id=' + restore_id;

                                $.ajax({
                                    url: 'include/controller.php',
                                    type: 'POST',
                                    data: dataString,
                                    success: function(result) {
                                        $('#restore_response').remove();
                                        if (result == "error") {
                                            $('#trase_prospectus_restore_error_section<?php echo $row["id"]; ?>')
                                                .append(
                                                    '<div id = "restore_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                                );
                                        }
                                        if (result == "empty") {
                                            $('#trase_prospectus_restore_error_section<?php echo $row["id"]; ?>')
                                                .append(
                                                    '<div id = "restore_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                                );
                                        }
                                        if (result == "success") {
                                            $('#trase_prospectus_restore_error_section<?php echo $row["id"]; ?>')
                                                .append(
                                                    '<div id = "restore_response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Course Restore successfully!!!</div></div>'
                                                );
                                            showRestoredData();

                                            function showRestoredData() {
                                                $.ajax({
                                                    url: 'include/view.php?action=get_trash',
                                                    type: 'GET',
                                                    success: function(result) {
                                                        $("#data_table").html(
                                                            result);
                                                    }
                                                });
                                            }
                                        }
                                        $('#restore_loading').fadeOut(500, function() {
                                            $(this).remove();
                                        });
                                        $('#trase_prospectus_restore_prospectus_button<?php echo $row["id"]; ?>')
                                            .prop('disabled', false);
                                    }

                                });
                            });

                    });
                    </script>
                </div>
            </div>
            <!-- prospectus restore Section End -->
        </tr>
        <?php
                        $s_no++;
                    }
                } else
                    echo '
                                <div class="alert alert-warning alert-dismissible">
                                    <i class="icon fas fa-exclamation-triangle"></i>  No Any Deleted Items Now!!!
                                </div>';
                ?>
    </tbody>
</table>
<script>
$(function() {
    $("#example1").DataTable();
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
    });
});
</script>
<!-- Deleted Items From prospectus End -->
<?php
    }
    //All Deleted Lists End
    /* ---------- All View Codes End ------------------------- */
    /* ---------- All Fetch Codes Start ---------------------- */
    //Fetching Precious Fees Due Dates Start
    if ($_GET["action"] == "fetch_previous_due_date") {
        $data = $_GET["data"];
        $sql = "SELECT * FROM `tbl_fee_due_date`
                    WHERE `status` = '$visible' && `fee_due_date_academic_year` = '$data'
                    ";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $months = explode(",", $row["fee_due_date_month_array"]);
            $dates = explode(",", $row["fee_due_date_month_date"]);
            ?>
<div class="row">
    <?php
                for ($i = 0; $i < count($months); $i++) {
                    ?>
    <div class="col-md-3">
        <div class="form-group">
            <label>
                <?php echo $months[$i]; ?>
            </label>
            <input type="date" name="<?php echo strtolower($months[$i]); ?>_date" class="form-control"
                value="<?php echo $dates[$i]; ?>">
        </div>
    </div>
    <?php } ?>
</div>
<?php
        } else {
            echo "nodata";
        }
    }
    //Fetching Precious Fees Due Dates Start


    if ($_GET["action"] == "fetch_examfees") {
        $data = $_POST["data"];

        // $page_no = "7";
        // $autority = json_decode($_SESSION["authority"],true);
        // $permissionVal=explode('||',$autority[$page_no]);
        // $superadmin = $_SESSION["logger_type"];


        ?>
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Course Name</th>
            <th>Particulars</th>
            <th>Amount</th>
            <th>Fine</th>
            <th>Fee Last Date</th>
            <th>Status</th>
            <th class="project-actions text-center">Action </th>
        </tr>
    </thead>
    <tbody>
        <?php
                $sql = "SELECT * FROM `tbl_examination_fee`
                                WHERE `status` = '$visible' && `exfee_academic_year` = '$data'
                                ORDER BY `course_id` ASC
                                ";
                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
        <tr>
            <td>
                <?php echo $s_no; ?>
            </td>
            <?php
                            $sql_course = "SELECT * FROM `tbl_course`
                                                       WHERE `status` = '$visible' && `course_id` = '" . $row["course_id"] . "';
                                                       ";
                            $result_course = $con->query($sql_course);
                            $row_course = $result_course->fetch_assoc();
                            ?>
            <td>
                <?php echo $row_course["course_name"]; ?>
            </td>
            <td>
                <?php echo $row["exfee_particulars"] ?>
            </td>
            <td>
                <?php echo $row["exfee_amount"] ?>
            </td>
            <td>
                <?php echo $row["exfee_fine"] ?>
            </td>
            <td>
                <?php echo date("d-m-Y", strtotime($row["exfee_lastdate"])) ?>
            </td>
            <td> <button type="button" id="edit_examfee_status_button<?php echo $row["exfee_id"]; ?>" class="btn <?php if ($row["exfee_astatus"] == "Active")
                                   echo "btn-primary";
                               else
                                   echo "btn-warning" ?> btn-sm"><span
                        id="loader_id<?php echo $row["exfee_id"]; ?>"></span>
                    <?php echo $row["exfee_astatus"] ?>
                </button></td>
            <td class="project-actions text-center">
                <?php
                                // if ((in_array('7_2',$permissionVal))   ||   ($_SESSION["logger_type"] == 'admin')){
                
                                ?>

                <button class="btn btn-info btn-sm"
                    onclick="document.getElementById('edit_examfees<?php echo $row["exfee_id"]; ?>').style.display='block'">
                    <i class="fas fa-pencil-alt">
                    </i>
                    Edit
                </button>

                <?php //}  
                                                ?>



                <?php
                                //if ((in_array('7_3',$permissionVal))   ||   ($_SESSION["logger_type"] == 'admin')){
                
                                ?>

                <button class="btn btn-danger btn-sm"
                    onclick="document.getElementById('delete_examfees<?php echo $row["exfee_id"]; ?>').style.display='block'">
                    <i class="fas fa-trash">
                    </i>
                    Delete
                </button>
                <?php //}  
                                                ?>

            </td>

            <!-- Fees Edit Section Start -->
            <div id="edit_examfees<?php echo $row["exfee_id"]; ?>" class="w3-modal" style="z-index:2020;">
                <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
                    <header class="w3-container" style="background:#343a40; color:white;">
                        <span
                            onclick="document.getElementById('edit_examfees<?php echo $row["exfee_id"]; ?>').style.display='none'"
                            class="w3-button w3-display-topright">&times;</span>
                        <h2 align="center">Edit Examination Fee</h2>
                    </header>
                    <form id="edit_fee_form<?php echo $row["exfee_id"]; ?>" role="form" method="POST">
                        <div class="card-body">
                            <div class="col-md-12" id="edit_error_section<?php echo $row["exfee_id"]; ?>"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Course Name</label>
                                        <select name="" id="edit_examfee_course_name<?php echo $row["exfee_id"]; ?>"
                                            class="form-control">
                                            <?php
                                                            $sql_c = "SELECT * FROM `tbl_course`
                                                                                       WHERE `status` = '$visible';
                                                                                       ";
                                                            $result_c = $con->query($sql_c);
                                                            while ($row_c = $result_c->fetch_assoc()) {
                                                                ?>
                                            <option value="<?php echo $row_c["course_id"]; ?>" <?php if ($row_c["course_id"] == $row_course["course_id"])
                                                                       echo 'selected'; ?>>
                                                <?php echo $row_c["course_name"]; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Particular</label>
                                        <input type="text" name=""
                                            id="edit_examfee_particulars<?php echo $row["exfee_id"]; ?>"
                                            class="form-control" value="<?php echo $row["exfee_particulars"]; ?>">
                                    </div>

                                    <div class="form-group">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="text" name=""
                                            id="edit_examfee_amount<?php echo $row["exfee_id"]; ?>" class="form-control"
                                            value="<?php echo $row["exfee_amount"]; ?>">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Fine</label>
                                        <input type="text" name="" id="edit_examfee_fine<?php echo $row["exfee_id"]; ?>"
                                            class="form-control" value="<?php echo $row["exfee_fine"]; ?>">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Fee Last Date</label>
                                        <input type="date" name=""
                                            id="edit_examfee_latedate<?php echo $row["exfee_id"]; ?>"
                                            class="form-control" value="<?php echo $row["exfee_lastdate"]; ?>">
                                    </div>

                                </div>

                            </div>
                            <input type='hidden' name='edit_examfee_id'
                                id="edit_examfee_id<?php echo $row["exfee_id"]; ?>"
                                value='<?php echo $row["exfee_id"]; ?>' />
                            <input type='hidden' name='edit_examfee_status'
                                id="edit_examfee_status<?php echo $row["exfee_id"]; ?>"
                                value='<?php echo $row["exfee_astatus"] ?>' />
                            <input type='hidden' name='action' id="action<?php echo $row["exfee_id"]; ?>"
                                value='edit_examfees' />
                            <div class="col-md-12" id="edit_loader_section<?php echo $row["exfee_id"]; ?>"></div>
                            <button type="button" id="edit_examfee_button<?php echo $row["exfee_id"]; ?>"
                                class="btn btn-primary">Update</button>
                            <!--<button type="reset" class="btn btn-danger">Reset</button>-->
                        </div>
                    </form>
                    <script>
                    $(function() {
                        $('#edit_examfee_status_button<?php echo $row["exfee_id"]; ?>').click(function() {
                            $('#loader_id<?php echo $row["exfee_id"]; ?>').append(
                                '<img id = "edit_load" width="20px" src = "images/ajax-loader.gif" alt="Currently loading" />'
                            );
                            $('#edit_examfee_status_button<?php echo $row["exfee_id"]; ?>').prop(
                                'disabled', true);
                            var action = $("#action<?php echo $row["exfee_id"]; ?>").val();
                            var edit_examfee_id = $("#edit_examfee_id<?php echo $row["exfee_id"]; ?>")
                                .val();
                            var edit_examfee_status = $(
                                "#edit_examfee_status<?php echo $row["exfee_id"]; ?>").val();

                            var dataString = 'action=' + action + '&edit_examfee_id=' +
                                edit_examfee_id + '&edit_examfee_status=' + edit_examfee_status;

                            $.ajax({
                                url: 'include/controller.php',
                                type: 'POST',
                                data: dataString,
                                success: function(result) {
                                    console.log(result);
                                    showUpdatedData();

                                    function showUpdatedData() {
                                        $.ajax({
                                            url: 'include/view.php?action=fetch_examfees',
                                            type: 'POST',
                                            data: $('#feeDetailsForm')
                                                .serializeArray(),
                                            success: function(result) {
                                                $('#response').remove();
                                                $('#data_table').append(
                                                    '<div id = "response">' +
                                                    result + '</div>');
                                            }
                                        });
                                    }
                                    $('#loader_id<?php echo $row["exfee_id"]; ?>').fadeOut(
                                        500,
                                        function() {
                                            $(this).remove();
                                            $('#edit_examfee_status_button<?php echo $row["exfee_id"]; ?>')
                                                .prop('disabled', false);
                                        });

                                }

                            });

                        });
                        $('#edit_examfee_button<?php echo $row["exfee_id"]; ?>').click(function() {
                            $('#edit_loader_section<?php echo $row["exfee_id"]; ?>').append(
                                '<center id = "edit_loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /></center>'
                            );
                            $('#edit_examfee_button<?php echo $row["exfee_id"]; ?>').prop('disabled',
                                true);
                            var action = $("#action<?php echo $row["exfee_id"]; ?>").val();
                            var edit_examfee_id = $("#edit_examfee_id<?php echo $row["exfee_id"]; ?>")
                                .val();
                            var edit_examfee_course_name = $(
                                "#edit_examfee_course_name<?php echo $row["exfee_id"]; ?>").val();
                            var edit_examfee_particulars = $(
                                "#edit_examfee_particulars<?php echo $row["exfee_id"]; ?>").val();
                            var edit_examfee_amount = $(
                                "#edit_examfee_amount<?php echo $row["exfee_id"]; ?>").val();
                            var edit_examfee_fine = $(
                                "#edit_examfee_fine<?php echo $row["exfee_id"]; ?>").val();
                            var edit_examfee_latedate = $(
                                "#edit_examfee_latedate<?php echo $row["exfee_id"]; ?>").val();

                            var dataString = 'action=' + action + '&edit_examfee_id=' +
                                edit_examfee_id + '&edit_examfee_course_name=' +
                                edit_examfee_course_name + '&edit_examfee_particulars=' +
                                edit_examfee_particulars + '&edit_examfee_amount=' +
                                edit_examfee_amount + '&edit_examfee_fine=' + edit_examfee_fine +
                                '&edit_examfee_latedate=' + edit_examfee_latedate;

                            $.ajax({
                                url: 'include/controller.php',
                                type: 'POST',
                                data: dataString,
                                success: function(result) {
                                    $('#edit_response').remove();
                                    if (result == "exsits") {
                                        $('#edit_error_section<?php echo $row["exfee_id"]; ?>')
                                            .append(
                                                '<div id = "edit_response"><div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-exclamation-triangle"></i> This Fee Details have already exsits!!!</div></div>'
                                            );
                                    }
                                    if (result == "error") {
                                        $('#edit_error_section<?php echo $row["exfee_id"]; ?>')
                                            .append(
                                                '<div id = "edit_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                            );
                                    }
                                    if (result == "empty") {
                                        $('#edit_error_section<?php echo $row["exfee_id"]; ?>')
                                            .append(
                                                '<div id = "edit_response"><div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-exclamation-triangle"></i>  Please fill out required Fields!!!</div></div>'
                                            );
                                    }
                                    if (result == "success") {
                                        $('#edit_error_section<?php echo $row["exfee_id"]; ?>')
                                            .append(
                                                '<div id = "edit_response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Fee Details Updated successfully!!!</div></div>'
                                            );
                                        showUpdatedData();

                                        function showUpdatedData() {
                                            $.ajax({
                                                url: 'include/view.php?action=fetch_examfees',
                                                type: 'POST',
                                                data: $('#feeDetailsForm')
                                                    .serializeArray(),
                                                success: function(result) {
                                                    $('#response').remove();
                                                    $('#data_table').append(
                                                        '<div id = "response">' +
                                                        result + '</div>');
                                                }
                                            });
                                        }
                                    }
                                    $('#edit_loading').fadeOut(500, function() {
                                        $(this).remove();
                                    });
                                    $('#edit_examfee_button<?php echo $row["exfee_id"]; ?>')
                                        .prop('disabled', false);
                                }

                            });

                        });

                    });
                    </script>
                </div>
            </div>
            <!-- Fees Edit Section End -->

            <!-- Fees delete Section Start -->
            <div id="delete_examfees<?php echo $row["exfee_id"]; ?>" class="w3-modal" style="z-index:2020;">
                <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
                    <header class="w3-container" style="background:#343a40; color:white;">
                        <span
                            onclick="document.getElementById('delete_examfees<?php echo $row["exfee_id"]; ?>').style.display='none'"
                            class="w3-button w3-display-topright">&times;</span>
                        <h2 align="center">Are you sure???</h2>
                    </header>
                    <form id="delete_fee_form<?php echo $row["exfee_id"]; ?>" role="form" method="POST">
                        <div class="card-body">
                            <div class="col-md-12" id="delete_error_section<?php echo $row["exfee_id"]; ?>"></div>
                            <div class="col-md-12" align="center">
                                <input type='hidden' name='delete_examfee_id'
                                    id="delete_examfee_id<?php echo $row["exfee_id"]; ?>"
                                    value='<?php echo $row["exfee_id"]; ?>' />
                                <input type='hidden' name='action' id="action_delete<?php echo $row["exfee_id"]; ?>"
                                    value='delete_examfees' />
                                <div class="col-md-12" id="delete_loader_section<?php echo $row["exfee_id"]; ?>"></div>
                                <button type="button" id="delete_examfee_button<?php echo $row["exfee_id"]; ?>"
                                    class="btn btn-danger">Move To Trash</button>
                                <button type="button"
                                    onclick="document.getElementById('delete_examfees<?php echo $row["exfee_id"]; ?>').style.display='none'"
                                    class="btn btn-primary">Cancel</button>
                            </div>
                        </div>
                    </form>

                    <script>
                    $(function() {
                        $('#delete_examfee_button<?php echo $row["exfee_id"]; ?>').click(function() {
                            $('#delete_loader_section<?php echo $row["exfee_id"]; ?>').append(
                                '<center id = "delete_loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /><br/><br/></center>'
                            );
                            $('#delete_examfee_button<?php echo $row["exfee_id"]; ?>').prop('disabled',
                                true);
                            var action = $("#action_delete<?php echo $row["exfee_id"]; ?>").val();
                            var delete_examfee_id = $(
                                "#delete_examfee_id<?php echo $row["exfee_id"]; ?>").val();
                            var dataString = 'action=' + action + '&delete_examfee_id=' +
                                delete_examfee_id;

                            $.ajax({
                                url: 'include/controller.php',
                                type: 'POST',
                                data: dataString,
                                success: function(result) {
                                    $('#delete_response').remove();
                                    if (result == "error") {
                                        $('#delete_error_section<?php echo $row["exfee_id"]; ?>')
                                            .append(
                                                '<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                            );
                                    }
                                    if (result == "empty") {
                                        $('#delete_error_section<?php echo $row["exfee_id"]; ?>')
                                            .append(
                                                '<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                            );
                                    }
                                    if (result == "success") {
                                        $('#delete_error_section<?php echo $row["exfee_id"]; ?>')
                                            .append(
                                                '<div id = "delete_response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Exam Fee Delete successfully!!!</div></div>'
                                            );
                                        showUpdatedData();

                                        function showUpdatedData() {
                                            $.ajax({
                                                url: 'include/view.php?action=fetch_examfees',
                                                type: 'POST',
                                                data: $('#feeDetailsForm')
                                                    .serializeArray(),
                                                success: function(result) {
                                                    $('#response').remove();
                                                    $('#data_table').append(
                                                        '<div id = "response">' +
                                                        result + '</div>');
                                                }
                                            });
                                        }
                                    }
                                    console.log(result);
                                    $('#delete_loading').fadeOut(500, function() {
                                        $(this).remove();
                                    });
                                    $('#delete_examfee_button<?php echo $row["exfee_id"]; ?>')
                                        .prop('disabled', false);
                                }

                            });
                        });

                    });
                    </script>
                </div>
            </div>
            <!-- Fees delete Section End -->
        </tr>
        <?php
                        $s_no++;
                    }
                } else
                    echo '
                                <div class="alert alert-warning alert-dismissible">
                                    <i class="icon fas fa-exclamation-triangle"></i>  No data available now!!!
                                </div>';
                ?>
    </tbody>
</table>
<script>
$(function() {
    $("#example1").DataTable();
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
    });
});
</script>
<?php
    }
    //Fetching Precious Fees Due Dates Start
    include 'view/student_list.php';
    //Fetching Precious Fees Due Dates end
    include "view/get_specialization.php";

    //Fetching Previous Fees Due Dates Start
    /* ------------------------------------------------- Fee Payment Start -------------------------------------------------- */
    include 'view/payment.php';
    /* ------------------------------------------------- Fee Payment end -------------------------------------------------- */

    //  fee Calculations Details start
    if ($_GET["action"] == "completeCalculationForFees") {
        $completeCalculationArray = array();
        $totalAmountArry = array();
        $totalPerticularArry = array();
        $completeCalculation = "";
        $paid_perticular_amount = 0;
        $remaining_perticular_amount = 0;
        $fine_perticular_amount = 0;
        $total_perticular_amount = 0;
        $total_paid_perticular_amount = 0;
        $total_remaining_perticular_amount = 0;
        $total_fine_perticular_amount = 0;
        $total_total_perticular_amount = 0;
        $particular_paid_amount = 0;
        $fine_amount = 0;
        $rebate_amount = 0;
        $total_amount = 0;
        $remaining_amount = 0;
        $last_fine = 0;
        $errorMessage = "";
        $registrationNumber = $_POST["registrationNumber"];
        $academicYear = $_POST["academicYear"];
        $courseId = $_POST["courseId"];
        $hostelCheck = $_POST["hostelCheck"];
        $paymentDate = $_POST["paymentDate"];
        $sql_paid = "SELECT * FROM `tbl_fee_paid`
                        WHERE `status` = '$visible' && `student_id` = '$registrationNumber' && `university_details_id` = '$academicYear'
                        ";
        $result_paid = $con->query($sql_paid);
        while ($row_paid = $result_paid->fetch_assoc()) {
            $last_balance = $row_paid["balance"];
            $last_fine = intval($row_paid["fine"]);
            $amountsPaid = explode(",", $row_paid["paid_amount"]);
            $totalPerticularArry = explode(",", $row_paid["particular_id"]);
            $totalAmountVal = 0;
            for ($i = 0; $i < count($amountsPaid); $i++) {
                if (!isset($totalAmountArry[$i]) && empty($totalAmountArry[$i]))
                    $totalAmountArry[$i] = 0;
                $totalAmountArry[$i] = $totalAmountArry[$i] + intval($amountsPaid[$i]);
            }
            if ($last_balance == 0)
                $submitClose = "";
        }
        $sql_fee = "SELECT * FROM `tbl_fee`
                        WHERE `status` = '$visible' && `course_id` = '$courseId' && `fee_academic_year` = '$academicYear'
                       ";
        $result_fee = $con->query($sql_fee);
        $sno = 0;
        $Idno = 0;
        $total_fees = 0;
        $total_paid = 0;
        $total_remaining = 0;
        $total_fine = 0;
        while ($row_fee = $result_fee->fetch_assoc()) {
            $fee_perticular = 0;
            if (strtolower($hostelCheck) == "yes") {
                $sno++;
                $total_fees = $total_fees + $row_fee["fee_amount"];
                $fine_perticular_amountArray[$Idno] = 0;
                $total_perticular_amountArray[$Idno] = 0;
                if (isset($totalAmountArry[$Idno])) {
                    $total_paid = $total_paid + $totalAmountArry[$Idno];
                    if ($totalAmountArry[$Idno] == $row_fee["fee_amount"]) {
                        $total_fine = $total_fine + 0;
                        $fee_perticular = 0;
                        $fine_perticular_amountArray[$Idno] = $fee_perticular;
                        $total_perticular_amountArray[$Idno] = $fee_perticular;
                    } else {
                        $beforeDate = date($row_fee["fee_lastdate"]);
                        if ($paymentDate > $beforeDate) {
                            if ($row_fee["fee_astatus"] == "Active") {
                                $numberOfDays = (strtotime($paymentDate) - strtotime($beforeDate)) / 60 / 60 / 24;
                                $total_fine = $total_fine + ($numberOfDays * intval($row_fee["fee_fine"]));
                                $fee_perticular = $fee_perticular + ($numberOfDays * intval($row_fee["fee_fine"]));
                                $fine_perticular_amountArray[$Idno] = $fee_perticular;
                            }
                        }
                        $total_perticular_amountArray[$Idno] = $row_fee["fee_amount"] + ($fee_perticular + $totalAmountArry[$Idno]);
                    }
                } else {
                    $beforeDate = date($row_fee["fee_lastdate"]);
                    if ($paymentDate > $beforeDate) {
                        if ($row_fee["fee_astatus"] == "Active") {
                            $numberOfDays = (strtotime($paymentDate) - strtotime($beforeDate)) / 60 / 60 / 24;
                            $total_fine = $total_fine + ($numberOfDays * intval($row_fee["fee_fine"]));
                            $fee_perticular = $fee_perticular + ($numberOfDays * intval($row_fee["fee_fine"]));
                            $fine_perticular_amountArray[$Idno] = $fee_perticular;
                        }
                    }
                    $total_perticular_amountArray[$Idno] = $fee_perticular + $row_fee["fee_amount"];
                }
                $Idno++;
            } else {
                if (strtolower($row_fee["fee_particulars"]) != "hostel fee") {
                    $sno++;
                    $total_fees = $total_fees + $row_fee["fee_amount"];
                    $fine_perticular_amountArray[$Idno] = 0;
                    if (isset($totalAmountArry[$Idno])) {
                        $total_paid = $total_paid + $totalAmountArry[$Idno];
                        if ($totalAmountArry[$Idno] == $row_fee["fee_amount"]) {
                            $total_fine = $total_fine + 0;
                            $fee_perticular = 0;
                            $fine_perticular_amountArray[$Idno] = $fee_perticular;
                            $total_perticular_amountArray[$Idno] = $fee_perticular;
                        } else {
                            $beforeDate = date($row_fee["fee_lastdate"]);
                            if ($paymentDate > $beforeDate) {
                                if ($row_fee["fee_astatus"] == "Active") {
                                    $numberOfDays = (strtotime($paymentDate) - strtotime($beforeDate)) / 60 / 60 / 24;
                                    $total_fine = $total_fine + ($numberOfDays * intval($row_fee["fee_fine"]));
                                    $fee_perticular = $numberOfDays * intval($row_fee["fee_fine"]);
                                    $fine_perticular_amountArray[$Idno] = $fee_perticular;
                                    $total_perticular_amountArray[$Idno] = $fee_perticular + $totalAmountArry[$Idno];
                                }
                            }
                            $total_perticular_amountArray[$Idno] = $row_fee["fee_amount"] + ($fee_perticular + $totalAmountArry[$Idno]);
                        }
                    } else {
                        $beforeDate = date($row_fee["fee_lastdate"]);
                        if ($paymentDate > $beforeDate) {
                            if ($row_fee["fee_astatus"] == "Active") {
                                $numberOfDays = (strtotime($paymentDate) - strtotime($beforeDate)) / 60 / 60 / 24;
                                $total_fine = $total_fine + ($numberOfDays * intval($row_fee["fee_fine"]));
                                $fee_perticular = $fee_perticular + ($numberOfDays * intval($row_fee["fee_fine"]));
                                $fine_perticular_amountArray[$Idno] = $fee_perticular;
                            }
                        }
                        $total_perticular_amountArray[$Idno] = $fee_perticular + $row_fee["fee_amount"];
                    }
                    $Idno++;
                }
            }
        }
        $total_remaining = $total_fine + ($total_fees - $total_paid);

        if (!empty($_POST["fine_amount"]))
            $fine_amount = $_POST["fine_amount"];
        if (!empty($_POST["rebate_amount"]))
            $rebate_amount = $_POST["rebate_amount"];
        for ($i = 0; $i < count($_POST["particular_paid_amount"]); $i++) {
            if (!empty($_POST["particular_paid_amount"][$i]))
                $total_amount = $total_amount + intval($_POST["particular_paid_amount"][$i]);
        }
        //Total Amount With Fee
        $total_amount = $total_amount + $fine_amount;
        //Total Amount With Rebate
        $total_amount = $total_amount - $rebate_amount;
        //Remaining Total
        $remaining_amount = $total_remaining - $total_amount;
        //Remaining Total Amount With Rebate
        $remaining_amount = $remaining_amount - $rebate_amount;
        //Fine Arrays
        $fine_perticular_amount = implode("|", $fine_perticular_amountArray);
        $total_perticular_amount = implode("|", $total_perticular_amountArray);
        //Set Negative Error
        if ($total_amount < 0 || $remaining_amount < 0 || $fine_perticular_amount < 0)
            $errorMessage .= " Connot Use Negative Values.";
        if ($total_amount > $total_remaining)
            $errorMessage .= " Your total amount Should be less than or equal to ~ $total_remaining.";
        //Complete Calculation
        $completeCalculationArray[] = $total_remaining;
        $completeCalculationArray[] = $total_amount;
        $completeCalculationArray[] = $remaining_amount;
        $completeCalculationArray[] = $fine_perticular_amount;
        $completeCalculationArray[] = $total_perticular_amount;
        $completeCalculationArray[] = $errorMessage;
        //Implode all the Calculations
        $completeCalculation = implode(",", $completeCalculationArray);
        echo $completeCalculation;
    }
    // fee Calculations Details End
    /* ------------------------------------------------ Fee Payment End ------------------------------------------------------- */

    //  Hostel Fee List start

    include './view/hostel_fees.php';



    //Fetching course & year Exam wise fee report Start
    if ($_GET["action"] == "fetch_examfee_list_details") {
        $course_id = $_POST["course_id"];
        $academic_year = $_POST["academic_year"];

        //echo "<pre>"; 
        //print_r($_POST); exit;         
        ?>
<div class="card">
    <div class="card-header">
        <form method="POST" action="export_exam_course_yearwise.php">
            <input type="hidden" name="course_id" value="<?= $course_id ?>" />
            <input type="hidden" name="academic_year" value="<?= $academic_year ?>" />
            <input type="hidden" name="action" value="export_examfees_details" />
            <button type="submit" class="btn btn-warning float-right"><i class="fa fa-download"></i> Export All</button>
        </form>
    </div>
</div>
<table id="example1" class="table table-bordered table-striped" style="overflow-x:auto;">
    <!-- <table id="dtHorizontalExample" class="table table-bordered table-striped">-->
    <thead>
        <tr>
            <th width="10%">S.No</th>
            <th width="10%">Reg. No</th>
            <th width="10%">Course</th>
            <th width="10%">Students Name</th>
            <th width="10%">Fees Detail</th>
        </tr>
    </thead>
    <tbody>
        <?php
                if ($course_id == "all")
                    $sql = "SELECT * FROM `tbl_admission`
                                    WHERE `status` = '$visible' && `admission_session` = '$academic_year' && `stud_status` = 1
                                    ORDER BY `admission_id` ASC
                                    ";
                else
                    $sql = "SELECT * FROM `tbl_admission`
                                    WHERE `status` = '$visible' && `admission_session` = '$academic_year' && `admission_course_name` = '$course_id'  && `stud_status` = 1
                                    ORDER BY `admission_id` ASC
                                    ";
                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
        <tr>
            <td>
                <?php echo $s_no; ?>
            </td>
            <?php
                            $sql_course = "SELECT * FROM `tbl_course`
                                                       WHERE `status` = '$visible' && `course_id` = '" . $row["admission_course_name"] . "';
                                                       ";
                            $result_course = $con->query($sql_course);
                            $row_course = $result_course->fetch_assoc();
                            ?>
            <td>
                <?php echo $row["admission_id"] ?>
            </td>
            <td>
                <?php echo $row_course["course_name"] ?>
            </td>
            <td>
                <?php echo $row["admission_first_name"] ?>
                <?php echo $row["admission_middle_name"] ?>
                <?php echo $row["admission_last_name"] ?>
            </td>
            <td>
                <table>
                    <thead>
                        <tr>
                            <th width="10%">S.No</th>
                            <th width="10%">Particular Name</th>
                            <th width="10%">Amount</th>
                            <th width="10%">Paid</th>
                            <!-- <th width="10%">Rebate</th> -->
                            <th width="10%">Fine</th>
                            <!-- <th width="10%">Balance</th> -->
                            <th width="10%">Fee Status</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                                        $query = "SELECT * FROM `tbl_examfee_paid`  WHERE `status` = '$visible' AND `student_id` = '" . $row["admission_id"] . "' AND `payment_status` IN ('cleared', 'pending')";
                                        $results = mysqli_query($con, $query) or die("database error:" . mysqli_error($con));
                                        $allOrders = array();
                                        while ($order = mysqli_fetch_assoc($results)) {
                                            $no = 1;
                                            $allOrders[] = $order;
                                        }

                                        // $sqlTblFeePaid = "SELECT *
                                        // FROM `tbl_examfee_paid`
                                        // WHERE `status` = '$visible' AND `student_id` = '".$studentRegistrationNo."' AND `payment_status` IN ('cleared', 'pending')
                                        // ";
                        
                                        $tmpSNo = 1;
                                        // $total_exam_fee = 0;            
                                        // $total_paid_amount = 0;            
                                        // $total_fine = 0;            
                                        // $grand_total = 0;            
                                        foreach ($allOrders as $order) {
                                            // echo "<pre>";
                                            // print_r($order); 
                                            if ($order["paid_amount"] != "") {
                                                ?>

                        <tr>
                            <td>
                                <?php echo $tmpSNo; ?>
                            </td>


                            <?php
                                                    $sql_course = "SELECT * FROM `tbl_examination_fee` WHERE `exfee_id` = '" . $order["particular_id"] . "'";
                                                    $result_fee = $con->query($sql_course);
                                                    $row_fee = $result_fee->fetch_assoc();
                                                    ?>

                            <td>
                                <?php echo $row_fee['exfee_particulars']; ?>
                            </td>
                            <td>&#8377;
                                <?php echo $row_fee['exfee_amount']; ?>
                            </td>
                            <td>&#8377;
                                <?php echo $order['paid_amount']; ?>
                            </td>
                            <td>&#8377;
                                <?php echo $order['extra_fine']; ?>
                            </td>

                            <?php
                                                    $sqlTblFeeStatus = "SELECT *
                                                                        FROM `tbl_examfee_status`
                                                                        WHERE `particular_id` = '" . $row_fee['exfee_id'] . "' AND `admission_id` = '" . $row["admission_id"] . "' AND `course_id` = '" . $row["admission_course_name"] . "' AND `academic_year` = '" . $row["admission_session"] . "'
                                                                        ";
                                                    $resultTblFeeStatus = $con->query($sqlTblFeeStatus);
                                                    if ($resultTblFeeStatus->num_rows > 0) {
                                                        $rowTblFeeStatus = $resultTblFeeStatus->fetch_assoc();
                                                        if (strtolower($rowTblFeeStatus["fee_status"]) == "dues") {
                                                            ?>
                            <td> <button type="button"
                                    id="edit_examfee_status_button<?= $row_fee['exfee_id'] . "_" . $s_no ?>"
                                    class="btn btn-warning btn-sm"><span
                                        id="loader_id<?= $row_fee['exfee_id'] . "_" . $s_no ?>"></span> Dues</button>
                            </td>
                            <!--<td><button type="button" class="btn btn-danger"><?= $rowTblFeeStatus["fee_status"] ?></button></td>-->
                            <?php
                                                        } else {
                                                            ?>
                            <td> <button type="button"
                                    id="edit_examfee_status_button<?= $row_fee['exfee_id'] . "_" . $s_no ?>"
                                    class="btn btn-primary btn-sm"><span
                                        id="loader_id<?= $row_fee['exfee_id'] . "_" . $s_no ?>"></span> No Dues</button>
                            </td>
                            <?php
                                                        }
                                                    } else {
                                                        ?>
                            <td> <button type="button"
                                    id="edit_examfee_status_button<?= $row_fee['exfee_id'] . "_" . $s_no ?>"
                                    class="btn btn-warning btn-sm"><span
                                        id="loader_id<?= $row_fee['exfee_id'] . "_" . $s_no ?>"></span> Dues</button>
                            </td>
                            <?php } ?>
                        </tr>

                        <input type="hidden" id="particular_id<?= $row_fee['exfee_id'] . "_" . $s_no ?>"
                            value="<?= $row_fee['exfee_id'] ?>">
                        <input type="hidden" id="admission_id<?= $row_fee['exfee_id'] . "_" . $s_no ?>"
                            value="<?= $row["admission_id"] ?>">
                        <input type="hidden" id="course_id<?= $row_fee['exfee_id'] . "_" . $s_no ?>"
                            value="<?= $row["admission_course_name"] ?>">
                        <input type="hidden" id="academic_year<?= $row_fee['exfee_id'] . "_" . $s_no ?>"
                            value="<?= $row["admission_session"] ?>">

                        <script>
                        $(function() {
                            $('#edit_examfee_status_button<?= $row_fee['exfee_id'] . "_" . $s_no ?>').click(
                                function() {
                                    $('#loader_id<?= $row_fee['exfee_id'] . "_" . $s_no ?>').append(
                                        '<img id = "edit_load" width="20px" src = "images/ajax-loader.gif" alt="Currently loading" />'
                                    );
                                    $('#edit_fee_status_button<?= $row_fee['exfee_id'] . "_" . $s_no ?>')
                                        .prop('disabled', true);

                                    var dataString = "action=checkExamStatus&particular_id=" + $(
                                            "#particular_id<?= $row_fee['exfee_id'] . "_" . $s_no ?>")
                                        .val() + "&admission_id=" + $(
                                            "#admission_id<?= $row_fee['exfee_id'] . "_" . $s_no ?>")
                                        .val() + "&course_id=" + $(
                                            "#course_id<?= $row_fee['exfee_id'] . "_" . $s_no ?>").val() +
                                        "&academic_year=" + $(
                                            "#academic_year<?= $row_fee['exfee_id'] . "_" . $s_no ?>")
                                        .val();

                                    $.ajax({
                                        url: 'include/controller.php',
                                        type: 'POST',
                                        data: dataString,
                                        success: function(result) {
                                            console.log(result);
                                            if (result == "success")
                                                showUpdatedData();

                                            function showUpdatedData() {
                                                $.ajax({
                                                    url: 'include/view.php?action=fetch_examfee_list_details',
                                                    type: 'POST',
                                                    data: $('#fetchFeeDataForm')
                                                        .serializeArray(),
                                                    success: function(result) {
                                                        $('#response').remove();
                                                        $('#data_table').html(
                                                            '<div id = "response">' +
                                                            result + '</div>');
                                                    }
                                                });
                                            }
                                            $('#loader_id<?= $row_fee['exfee_id'] . "_" . $s_no ?>')
                                                .fadeOut(500, function() {
                                                    $(this).remove();
                                                    $('#edit_examfee_status_button<?= $row_fee['exfee_id'] . "_" . $s_no ?>')
                                                        .prop('disabled', false);
                                                });

                                        }

                                    });
                                });

                        });
                        </script>



                        <?php
                                                $tmpSNo++;
                                            }
                                        }
                                        ?>


                    </tbody>
                </table>
            </td>
        </tr>
        <?php
                        $s_no++;
                    }
                } else
                    echo '
                                <div class="alert alert-warning alert-dismissible">
                                    <i class="icon fas fa-exclamation-triangle"></i>  No data available now!!!
                                </div>';
                ?>
    </tbody>
</table>

<?php
    }
    //Fetching course & year wise exam fee report end



    //  fee receipt start
    if ($_GET["action"] == "fetch_receipt_details") {
        $studentRegistrationNo = $_POST["studentRegistrationNo"];
        if (!empty($studentRegistrationNo)) {
            $sql = "SELECT * FROM `tbl_fee_paid`
                        WHERE `status` = '$visible' && `student_id` = '$studentRegistrationNo' && `payment_status` != 'deleted'
                        ORDER BY `feepaid_id` DESC
                        ";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                ?>
<div class="col-md-12">
    <form action="print?studentId=<?php echo $studentRegistrationNo; ?>" method="POST" align="right">
        <input type="hidden" name="studentId" value="<?php echo $studentRegistrationNo; ?>" />
        <input type="hidden" name="action" value="printAllReceipts" />
        <button type="submit" class="btn btn-warning btn-md">
            <i class="fas fa-print">
            </i>
            Student Fee Card
        </button>
    </form>
</div>
<div class="col-md-12 card-body table-responsive">
    <table id="example1" class="table table-bordered table-striped table-responsiv">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Date</th>
                <th>Payment Mode</th>
                <th>Payment Status</th>
                <th>Receipt Number</th>
                <th>Payment Date</th>
                <th>Student Name</th>
                <th>Rebate On</th>
                <th>Rebate Amount</th>
                <th>Paid Amount</th>
                <th>Balance Amount</th>
                <th>Receipt Generated By</th>
                <th class="project-actions text-center">Action </th>
            </tr>
        </thead>
        <tbody>
            <?php
                            while ($row = $result->fetch_assoc()) {
                                ?>
            <tr>
                <td>
                    <?php echo $s_no; ?>
                </td>
                <td>
                    <?php echo date("Y-m-d"); ?>
                </td>
                <td>
                    <?php echo strtoupper($row["payment_mode"]); ?>
                </td>
                <td class="<?php if ($row["payment_status"] == "cleared")
                                        echo "bg-green";
                                    if ($row["payment_status"] == "bounced")
                                        echo "bg-red";
                                    if ($row["payment_status"] == "pending")
                                        echo "bg-yellow";
                                    if ($row["payment_status"] == "refunded")
                                        echo "bg-orange" ?> ">
                    <?php echo strtoupper($row["payment_status"]); ?>
                </td>
                <td><span class="text-red text-bold">
                        <?php echo $row["receipt_no"] ?>
                    </span></td>
                <td><span class="text-red text-bold">
                        <?php echo $row["receipt_date"] ?>
                    </span></td>
                <?php
                                    $sql_student = "SELECT * FROM `tbl_admission`
                                                            WHERE `status` = '$visible' && `admission_id` = '" . $row["student_id"] . "'
                                                            ";
                                    $result_student = $con->query($sql_student);
                                    $row_student = $result_student->fetch_assoc();
                                    ?>
                <td>
                    <?php echo $row_student["admission_first_name"] . " " . $row_student["admission_middle_name"] . " " . $row_student["admission_last_name"] ?>
                </td>
                <?php
                                    if ($row["rebate_amount"] != "") {
                                        $rebateAmountArray = explode(",", $row["rebate_amount"]);
                                        if ($rebateAmountArray[1] == "fine")
                                            $rebate_for = "FINE";
                                        else {
                                            $sql_feeFor = "SELECT * FROM `tbl_fee`
                                                                    WHERE `status` = '$visible' && `fee_id` = '" . $rebateAmountArray[1] . "'
                                                                    ";
                                            $result_feeFor = $con->query($sql_feeFor);
                                            $row_feeFor = $result_feeFor->fetch_assoc();
                                            $rebate_for = $row_feeFor["fee_particulars"];
                                        }
                                        ?>
                <td>
                    <?php echo $rebate_for; ?>
                </td>
                <td>
                    <?php echo $rebateAmountArray[0]; ?>
                </td>
                <?php
                                    } else {
                                        ?>
                <td></td>
                <td></td>
                <?php
                                    }

                                    ?>
                <?php
                                    $sumAmount = 0;
                                    $amountsPaid = explode(",", $row["paid_amount"]);
                                    for ($i = 0; $i < count($amountsPaid); $i++) {
                                        $sumAmount = $sumAmount + intval($amountsPaid[$i]);
                                    }
                                    unset($amountsPaid);
                                    ?>
                <td>
                    <?php echo $sumAmount + intval($row["fine"]); ?>
                </td>
                <td>
                    <?php echo $row["balance"] ?>
                </td>
                <td>
                    <?php echo $row["print_generated_by"] ?>
                </td>
                <td class="project-actions text-center">
                    <form action="print" method="POST" target="_blank">
                        <input type="hidden" name="paidId" value="<?php echo $row["feepaid_id"]; ?>" />
                        <button type="submit" class="btn btn-warning btn-sm">
                            <i class="fas fa-print">
                            </i>
                            Print Receipt
                        </button>
                    </form>

                    <?php
                        $permissions = json_decode($_SESSION["authority"], true); 
                        $loggedInUserType = $_SESSION['logger_type']; 

                        if ((isset($permissions['7']) && in_array('7_12', explode('||', $permissions['7']))) || $loggedInUserType == 'admin') {
                            ?>
                    <button type="button" class="btn btn-danger btn-sm"
                        onclick="document.getElementById('delete_print_receipts<?php echo $row["feepaid_id"]; ?>').style.display='block'">
                        <i class="fas fa-trash">
                        </i>
                        Delete
                    </button>

                    <?php
                        }
                        ?>

                </td>

                <!-- Fees delete Section Start -->
                <div id="delete_print_receipts<?php echo $row["feepaid_id"]; ?>" class="w3-modal" style="z-index:2020;">
                    <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
                        <header class="w3-container" style="background:#343a40; color:white;">
                            <span
                                onclick="document.getElementById('delete_print_receipts<?php echo $row["feepaid_id"]; ?>').style.display='none'"
                                class="w3-button w3-display-topright">&times;</span>
                            <h2 align="center">Are you sure???</h2>
                        </header>
                        <form id="delete_print_receipt_form<?php echo $row["feepaid_id"]; ?>" role="form" method="POST">
                            <div class="card-body">
                                <div class="col-md-12" id="delete_error_section<?php echo $row["feepaid_id"]; ?>"></div>
                                <div class="col-md-12" align="center">
                                    <input type='hidden' name='delete_feepaid_id'
                                        id="delete_feepaid_id<?php echo $row["feepaid_id"]; ?>"
                                        value='<?php echo $row["feepaid_id"]; ?>' />
                                    <input type='hidden' name='action'
                                        id="action_delete<?php echo $row["feepaid_id"]; ?>"
                                        value='delete_print_receipts' />
                                    <div class="col-md-12" id="delete_loader_section<?php echo $row["feepaid_id"]; ?>">
                                    </div>
                                    <button type="button"
                                        id="delete_print_receipt_button<?php echo $row["feepaid_id"]; ?>"
                                        class="btn btn-danger">Move To Trash</button>
                                    <button type="button"
                                        onclick="document.getElementById('delete_print_receipts<?php echo $row["feepaid_id"]; ?>').style.display='none'"
                                        class="btn btn-primary">Cancel</button>
                                </div>
                            </div>
                        </form>

                        <script>
                        $(function() {
                            $('#delete_print_receipt_button<?php echo $row["feepaid_id"]; ?>').click(
                                function() {
                                    $('#delete_loader_section<?php echo $row["feepaid_id"]; ?>').append(
                                        '<center id = "delete_loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /><br/><br/></center>'
                                    );
                                    $('#delete_print_receipt_button<?php echo $row["feepaid_id"]; ?>').prop(
                                        'disabled', true);
                                    var action = $("#action_delete<?php echo $row["feepaid_id"]; ?>").val();
                                    var delete_feepaid_id = $(
                                        "#delete_feepaid_id<?php echo $row["feepaid_id"]; ?>").val();
                                    var dataString = 'action=' + action + '&delete_feepaid_id=' +
                                        delete_feepaid_id;

                                    $.ajax({
                                        url: 'include/controller.php',
                                        type: 'POST',
                                        data: dataString,
                                        success: function(result) {
                                            $('#delete_response').remove();
                                            if (result == "error") {
                                                $('#delete_error_section<?php echo $row["feepaid_id"]; ?>')
                                                    .append(
                                                        '<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                                    );
                                            }
                                            if (result == "empty") {
                                                $('#delete_error_section<?php echo $row["feepaid_id"]; ?>')
                                                    .append(
                                                        '<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                                    );
                                            }
                                            if (result == "success") {
                                                $('#delete_error_section<?php echo $row["feepaid_id"]; ?>')
                                                    .append(
                                                        '<div id = "delete_response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Fee Delete successfully!!!</div></div>'
                                                    );
                                                showUpdatedData();

                                                function showUpdatedData() {
                                                    $.ajax({
                                                        url: 'include/view.php?action=fetch_receipt_details',
                                                        type: 'POST',
                                                        data: $('#fetchStudentDataForm')
                                                            .serializeArray(),
                                                        success: function(result) {
                                                            $('#response').remove();
                                                            $('#data_table').append(
                                                                '<div id = "response">' +
                                                                result +
                                                                '</div>');
                                                        }
                                                    });
                                                }
                                            }
                                            console.log(result);
                                            $('#delete_loading').fadeOut(500, function() {
                                                $(this).remove();
                                            });
                                            $('#delete_print_receipt_button<?php echo $row["feepaid_id"]; ?>')
                                                .prop('disabled', false);
                                        }

                                    });
                                });

                        });
                        </script>
                    </div>
                </div>
                <!-- Fees delete Section End -->
            </tr>
            <?php
                                $s_no++;
                            }
                            ?>
        </tbody>
    </table>
</div>
<script>
$(function() {
    $("#example1").DataTable();
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
    });
});
</script>
<?php
            } else
                echo '
                            <div class="col-md-12"><div class="alert alert-warning alert-dismissible">
                                <i class="icon fas fa-exclamation-triangle"></i>  No data available now!!!
                            </div></div>';
        } else
            echo "0";
    }
    // fee receipt End


    //  fee Prospectus Details start
    if ($_GET["action"] == "fetch_prospectus_info") {
        $form_no = $_POST["add_admission_form_no"];
        if (!empty($form_no)) {
            $sql = "SELECT * FROM `tbl_prospectus`
                        WHERE `status` = '$visible' && `prospectus_no` = '$form_no'
                        ";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $nameFull = explode(" ", $row["prospectus_applicant_name"]);
                $completeInfo[] = $nameFull[0];
                if (isset($nameFull[1]))
                    $completeInfo[] = $nameFull[1];
                else
                    $completeInfo[] = "";
                $completeInfo[] = $row["prospectus_program_type"];
                $completeInfo[] = $row["prospectus_gender"];
                $completeInfo[] = $row["prospectus_father_name"];
                $completeInfo[] = $row["prospectus_address"];
                $completeInfo[] = $row["prospectus_country"];
                $completeInfo[] = $row["prospectus_state"];
                $completeInfo[] = $row["prospectus_city"];
                $completeInfo[] = $row["prospectus_postal_code"];
                $completeInfo[] = $row["prospectus_emailid"];
                $completeInfo[] = $row["prospectus_dob"];
                $completeInfo[] = $row["mobile"];
                $completeInfo[] = $row["prospectus_course_name"];
                $completeInfo[] = $row["prospectus_session"];
                $completeInfo[] = $row["prospectus_mother_name"];
                $info = implode("|||", $completeInfo);
                echo $info;
            } else
                echo "";
        } else
            echo "";
    }
    // fee Prospectus Details End

    //Extra Income Start
    if ($_GET["action"] == "get_extra_income") {
        ?>
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Received Date</th>
            <th>Particulars</th>
            <th>Amount</th>
            <th>Payment Mode</th>
            <th>Bank Name</th>
            <th>Transaction No</th>
            <th>Received From</th>
            <th>Remarks</th>
            <th class="project-actions text-center">Action </th>
        </tr>
    </thead>
    <tbody>
        <?php
                $sql = "SELECT * FROM `tbl_extra_income`
                                WHERE `status` = '$visible'
                                ORDER BY `id` DESC
                                ";
                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
        <tr>
            <td>
                <?php echo $s_no; ?>
            </td>
            <td>
                <?php echo $row["received_date"]; ?>
            </td>
            <td>
                <?php echo $row["particulars"]; ?>
            </td>
            <td>
                <?php echo $row["amount"]; ?>
            </td>
            <td>
                <?php echo $row["payment_mode"]; ?>
            </td>
            <td>
                <?php echo $row["bank_name"]; ?>
            </td>
            <td>
                <?php echo $row["account_number"]; ?>
            </td>
            <td>
                <?php echo $row["received_from"]; ?>
            </td>
            <td>
                <?php echo $row["remarks"]; ?>
            </td>
            <td class="project-actions text-center">
                <button class="btn btn-info btn-sm"
                    onclick="document.getElementById('edit_extra_income<?php echo $row["id"]; ?>').style.display='block'">
                    <i class="fas fa-pencil-alt">
                    </i>
                    Edit
                </button>
                <button class="btn btn-danger btn-sm"
                    onclick="document.getElementById('delete_extra_income<?php echo $row["id"]; ?>').style.display='block'">
                    <i class="fas fa-trash">
                    </i>
                    Delete
                </button>
            </td>

            <!-- Extra Income Edit Section Start -->
            <div id="edit_extra_income<?php echo $row["id"]; ?>" class="w3-modal" style="z-index:2020;">
                <div class="w3-modal-content w3-animate-top w3-card-4" style="width:55%">
                    <header class="w3-container" style="background:#343a40; color:white;">
                        <span
                            onclick="document.getElementById('edit_extra_income<?php echo $row["id"]; ?>').style.display='none'"
                            class="w3-button w3-display-topright">&times;</span>
                        <h2 align="center">Edit Extra Income</h2>
                    </header>
                    <form id="edit_extra_income_form<?php echo $row["id"]; ?>" role="form" method="POST">
                        <div class="card-body">
                            <div class="col-md-12" id="edit_error_section<?php echo $row["id"]; ?>"></div>
                            <div class="row">

                                <div class="col-4">
                                    <label>Received Date</label>
                                    <input type="date" name="received_date" id="received_date<?php echo $row["id"]; ?>"
                                        value="<?php echo $row["received_date"]; ?>" class="form-control" required>
                                </div>
                                <div class="col-4">
                                    <label>Particulars</label>
                                    <input type="text" name="particulars" id="particulars<?php echo $row["id"]; ?>"
                                        value="<?php echo $row["particulars"]; ?>" class="form-control" required>
                                </div>
                                <div class="col-4">
                                    <label>Amount</label>
                                    <input type="text" name="amount" id="amount<?php echo $row["id"]; ?>"
                                        value="<?php echo $row["amount"]; ?>" class="form-control" required>
                                </div>
                                <div class="col-4">
                                    <label>Received From</label>
                                    <input type="text" name="received_from" id="received_from<?php echo $row["id"]; ?>"
                                        value="<?php echo $row["received_from"]; ?>" class="form-control" required>
                                </div>

                                <div class="col-4">
                                    <label>Remarks</label>
                                    <textarea name="remarks" id="remarks<?php echo $row["id"]; ?>"
                                        value="<?php echo $row["remarks"]; ?>" class="form-control"
                                        style="height:38px;"><?php echo $row["remarks"]; ?></textarea>
                                </div>
                                <div class="col-4">
                                    <label>Payment Mode</label>
                                    <select name="payment_mode" id="payment_mode<?php echo $row["id"]; ?>"
                                        class="form-control" onchange="PaymentModeSelect(this.value);">
                                        <option value="<?php echo $row["payment_mode"]; ?>">
                                            <?php echo $row["payment_mode"]; ?>
                                        </option>
                                        <option value="Cash">Cash</option>
                                        <option value="DD">DD</option>
                                        <option value="Cheque">Cheque</option>
                                        <option value="Online">Online</option>
                                        <option value="NEFT/IMPS/RTGS">NEFT/IMPS/RTGS</option>
                                    </select>
                                </div>
                                <div class="col-4" id="bankName_div" style="display:none">
                                    <label>Bank Name</label>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input name="bank_name" id="bank_name<?php echo $row["id"]; ?>"
                                                value="<?php echo $row["bank_name"]; ?>" type="text"
                                                class="form-control" />
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="col-4" id="chequeNo_div" style="display:none">
                                    <label>Cheque/DD/NEFT No</label>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input id="account_number<?php echo $row["id"]; ?>"
                                                value="<?php echo $row["account_number"]; ?>" name="account_number"
                                                type="text" class="form-control" />
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="col-4" id="receiptDate_div" style="display:none">
                                    <label>Cash/Cheque/DD/NEFT Date</label>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input id="branch_name<?php echo $row["id"]; ?>"
                                                value="<?php echo $row["branch_name"]; ?>" name="branch_name"
                                                type="date" class="form-control" />
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <script>
                                function PaymentModeSelect(PaymentMode) {
                                    var bankName_div = document.getElementById('bankName_div');
                                    var chequeNo_div = document.getElementById('chequeNo_div');
                                    var receiptDate_div = document.getElementById('receiptDate_div');
                                    if (PaymentMode == "Cash") {
                                        // cash_div.style.display = "block";
                                        bankName_div.style.display = "none";
                                        chequeNo_div.style.display = "none";
                                        receiptDate_div.style.display = "block";
                                    } else if (PaymentMode == "Cheque" || PaymentMode == "DD" || PaymentMode ==
                                        "Online" || PaymentMode == "NEFT/IMPS/RTGS") {
                                        bankName_div.style.display = "block";
                                        chequeNo_div.style.display = "block";
                                        receiptDate_div.style.display = "block";
                                    } else {
                                        bankName_div.style.display = "none";
                                        chequeNo_div.style.display = "none";
                                        receiptDate_div.style.display = "none";
                                    }
                                }
                                </script>
                                <!-- <script>
                                                        function changeMode(str){
                                                            if (str == 'Cheque' || str == 'DD' || str == 'Online' || str == 'NEFT/RTGS/IMPS'){
                                                                document.getElementById('bank').style.display = "block";
                                                            } else {
                                                                document.getElementById('bank').style.display = "none";
                                                            }
                                                        }
                                                    </script>
                                                    <div style='display:none;' id="bank" >                  
                                                      <div class="row">
                                                     <div class="col-4">  
                                                     <label>Account Number</label>
                                                      <input type="text"  name="account_number"  id="account_number<?php echo $row["id"]; ?>" value="<?php echo $row["account_number"]; ?>" class="form-control" style="width: 86%;">               
                                                    </div>
                                                          <div class="col-4">  
                                                     <label>Bank Name</label>
                                                      <input type="text"  name="bank_name"  id="bank_name<?php echo $row["id"]; ?>" value="<?php echo $row["bank_name"]; ?>" class="form-control" style="width: 86%;">              
                                                    </div>
                                                          <div class="col-4">  
                                                     <label>Branch Name</label>
                                                      <input type="text"  name="branch_name"  id="branch_name<?php echo $row["id"]; ?>" value="<?php echo $row["branch_name"]; ?>" class="form-control" style="width: 86%;">                
                                                    </div>
                                                          <div class="col-4">  
                                                     <label>Ifsc Code</label>
                                                      <input type="text"  name="ifsc_code"  id="ifsc_code<?php echo $row["id"]; ?>" value="<?php echo $row["ifsc_code"]; ?>" class="form-control" style="width: 86%;">              
                                                    </div>
                                                     <div class="col-4">  
                                                     <label>Cheque/DD/NEFT No</label>
                                                      <input type="text"  name="transaction_no" id="transaction_no<?php echo $row["id"]; ?>" value="<?php echo $row["transaction_no"]; ?>"  class="form-control" style="width: 86%;">               
                                                    </div>
                                                    </div>
                                                    </div>-->

                            </div>
                            <input type='hidden' name='edit_id' id="edit_id<?php echo $row["id"]; ?>"
                                value='<?php echo $row["id"]; ?>' />
                            <input type='hidden' name='action' id="action<?php echo $row["id"]; ?>"
                                value='edit_extra_income' />
                            <div class="col-md-12" id="edit_loader_section<?php echo $row["id"]; ?>"></div>
                            <button type="button" id="edit_extra_income_button<?php echo $row["id"]; ?>"
                                class="btn btn-primary">Update</button>
                            <!--<button type="reset" class="btn btn-danger">Reset</button>-->
                        </div>
                    </form>
                    <script>
                    $(function() {

                        $('#edit_extra_income_button<?php echo $row["id"]; ?>').click(function() {
                            $('#edit_loader_section<?php echo $row["id"]; ?>').append(
                                '<center id = "edit_loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /></center>'
                            );
                            $('#edit_extra_income_button<?php echo $row["id"]; ?>').prop('disabled',
                                true);
                            var action = $("#action<?php echo $row["id"]; ?>").val();
                            var edit_id = $("#edit_id<?php echo $row["id"]; ?>").val();
                            var received_date = $("#received_date<?php echo $row["id"]; ?>").val();
                            var particulars = $("#particulars<?php echo $row["id"]; ?>").val();
                            var amount = $("#amount<?php echo $row["id"]; ?>").val();
                            var payment_mode = $("#payment_mode<?php echo $row["id"]; ?>").val();
                            var account_number = $("#account_number<?php echo $row["id"]; ?>").val();
                            var bank_name = $("#bank_name<?php echo $row["id"]; ?>").val();
                            var branch_name = $("#branch_name<?php echo $row["id"]; ?>").val();
                            var ifsc_code = $("#ifsc_code<?php echo $row["id"]; ?>").val();
                            var transaction_no = $("#transaction_no<?php echo $row["id"]; ?>").val();
                            var received_from = $("#received_from<?php echo $row["id"]; ?>").val();
                            var remarks = $("#remarks<?php echo $row["id"]; ?>").val();

                            var dataString = 'action=' + action + '&edit_id=' + edit_id +
                                '&received_date=' + received_date + '&particulars=' + particulars +
                                '&amount=' + amount + '&payment_mode=' + payment_mode +
                                '&account_number=' + account_number + '&bank_name=' + bank_name +
                                '&branch_name=' + branch_name + '&ifsc_code=' + ifsc_code +
                                '&transaction_no=' + transaction_no + '&received_from=' +
                                received_from + '&remarks=' + remarks;

                            $.ajax({
                                url: 'include/controller.php',
                                type: 'POST',
                                data: dataString,
                                success: function(result) {
                                    $('#edit_response').remove();
                                    if (result == "exsits") {
                                        $('#edit_error_section<?php echo $row["id"]; ?>')
                                            .append(
                                                '<div id = "edit_response"><div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-exclamation-triangle"></i> This No have already exsits!!!</div></div>'
                                            );
                                    }
                                    if (result == "error") {
                                        $('#edit_error_section<?php echo $row["id"]; ?>')
                                            .append(
                                                '<div id = "edit_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                            );
                                    }
                                    if (result == "empty") {
                                        $('#edit_error_section<?php echo $row["id"]; ?>')
                                            .append(
                                                '<div id = "edit_response"><div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-exclamation-triangle"></i>  Please fill out Prospectus No!!!</div></div>'
                                            );
                                    }
                                    if (result == "success") {
                                        $('#edit_error_section<?php echo $row["id"]; ?>')
                                            .append(
                                                '<div id = "edit_response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i>  Updated successfully!!!</div></div>'
                                            );
                                        showUpdatedData();

                                        function showUpdatedData() {
                                            $.ajax({
                                                url: 'include/view.php?action=get_extra_income',
                                                type: 'GET',
                                                success: function(result) {
                                                    $("#data_table").html(
                                                        result);
                                                }
                                            });
                                        }
                                    }
                                    $('#edit_loading').fadeOut(500, function() {
                                        $(this).remove();
                                    });
                                    $('#edit_extra_income_button<?php echo $row["id"]; ?>')
                                        .prop('disabled', false);
                                }

                            });
                        });

                    });
                    </script>
                </div>
            </div>
            <!-- extra income Edit Section End -->

            <!-- Extra income delete Section Start -->
            <div id="delete_extra_income<?php echo $row["id"]; ?>" class="w3-modal" style="z-index:2020;">
                <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
                    <header class="w3-container" style="background:#343a40; color:white;">
                        <span
                            onclick="document.getElementById('delete_extra_income<?php echo $row["id"]; ?>').style.display='none'"
                            class="w3-button w3-display-topright">&times;</span>
                        <h2 align="center">Are you sure???</h2>
                    </header>
                    <form id="delete_extra_income_form<?php echo $row["id"]; ?>" role="form" method="POST">
                        <div class="card-body">
                            <div class="col-md-12" id="delete_error_section<?php echo $row["id"]; ?>"></div>
                            <div class="col-md-12" align="center">
                                <input type='hidden' name='delete_id' id="delete_id<?php echo $row["id"]; ?>"
                                    value='<?php echo $row["id"]; ?>' />
                                <input type='hidden' name='action' id="action_delete<?php echo $row["id"]; ?>"
                                    value='delete_extra_income' />
                                <div class="col-md-12" id="delete_loader_section<?php echo $row["id"]; ?>"></div>
                                <button type="button" id="delete_extra_income_button<?php echo $row["id"]; ?>"
                                    class="btn btn-danger">Move To Trash</button>
                                <button type="button"
                                    onclick="document.getElementById('delete_extra_income<?php echo $row["id"]; ?>').style.display='none'"
                                    class="btn btn-primary">Cancel</button>
                            </div>

                            <!--<button type="reset" class="btn btn-danger">Reset</button>-->
                        </div>
                    </form>
                    <script>
                    $(function() {

                        $('#delete_extra_income_button<?php echo $row["id"]; ?>').click(function() {
                            $('#delete_loader_section<?php echo $row["id"]; ?>').append(
                                '<center id = "delete_loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /><br/><br/></center>'
                            );
                            $('#delete_extra_income_button<?php echo $row["id"]; ?>').prop('disabled',
                                true);
                            var action = $("#action_delete<?php echo $row["id"]; ?>").val();
                            var delete_id = $("#delete_id<?php echo $row["id"]; ?>").val();
                            var dataString = 'action=' + action + '&delete_id=' + delete_id;

                            $.ajax({
                                url: 'include/controller.php',
                                type: 'POST',
                                data: dataString,
                                success: function(result) {
                                    $('#delete_response').remove();
                                    if (result == "error") {
                                        $('#delete_error_section<?php echo $row["id"]; ?>')
                                            .append(
                                                '<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                            );
                                    }
                                    if (result == "empty") {
                                        $('#delete_error_section<?php echo $row["id"]; ?>')
                                            .append(
                                                '<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                            );
                                    }
                                    if (result == "success") {
                                        $('#delete_error_section<?php echo $row["id"]; ?>')
                                            .append(
                                                '<div id = "delete_response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i>Delete successfully!!!</div></div>'
                                            );
                                        showDeletedData();

                                        function showDeletedData() {
                                            $.ajax({
                                                url: 'include/view.php?action=get_extra_income',
                                                type: 'GET',
                                                success: function(result) {
                                                    $("#data_table").html(
                                                        result);
                                                }
                                            });
                                        }
                                    }
                                    $('#delete_loading').fadeOut(500, function() {
                                        $(this).remove();
                                    });
                                    $('#delete_extra_income_button<?php echo $row["id"]; ?>')
                                        .prop('disabled', false);
                                }

                            });
                        });

                    });
                    </script>
                </div>
            </div>
            <!-- Extra_income delete Section End -->
        </tr>
        <?php
                        $s_no++;
                    }
                } else
                    echo '
                                <div class="alert alert-warning alert-dismissible">
                                    <i class="icon fas fa-exclamation-triangle"></i>  No data available now!!!
                                </div>';
                ?>
    </tbody>
</table>
<script>
$(function() {
    $("#example1").DataTable();
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
    });
});
</script>
<?php
    }
    //Extra_income End

    //Expenses Start
    if ($_GET["action"] == "get_expenses") {
        ?>
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Payment Date</th>
            <th>Particulars</th>
            <th>Amount</th>
            <th>Payment Mode</th>
            <th>Paid To</th>
            <th>Remarks</th>
            <th class="project-actions text-center">Action </th>
        </tr>
    </thead>
    <tbody>
        <?php
                $sql = "SELECT * FROM `tbl_expenses`
                                WHERE `status` = '$visible'
                                ORDER BY `id` DESC
                                ";
                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
        <tr>
            <td>
                <?php echo $s_no; ?>
            </td>
            <td>
                <?php echo $row["payment_date"]; ?>
            </td>
            <td>
                <?php echo $row["particulars"]; ?>
            </td>
            <td>
                <?php echo $row["amount"]; ?>
            </td>
            <td>
                <?php echo $row["payment_mode"]; ?>
            </td>
            <td>
                <?php echo $row["paid_to"]; ?>
            </td>
            <td>
                <?php echo $row["remarks"]; ?>
            </td>
            <td class="project-actions text-center">
                <button class="btn btn-info btn-sm"
                    onclick="document.getElementById('edit_expenses<?php echo $row["id"]; ?>').style.display='block'">
                    <i class="fas fa-pencil-alt">
                    </i>
                    Edit
                </button>
                <button class="btn btn-danger btn-sm"
                    onclick="document.getElementById('delete_expenses<?php echo $row["id"]; ?>').style.display='block'">
                    <i class="fas fa-trash">
                    </i>
                    Delete
                </button>
            </td>

            <!-- Expenses Edit Section Start -->
            <div id="edit_expenses<?php echo $row["id"]; ?>" class="w3-modal" style="z-index:2020;">
                <div class="w3-modal-content w3-animate-top w3-card-4" style="width:55%">
                    <header class="w3-container" style="background:#343a40; color:white;">
                        <span
                            onclick="document.getElementById('edit_expenses<?php echo $row["id"]; ?>').style.display='none'"
                            class="w3-button w3-display-topright">&times;</span>
                        <h2 align="center">Edit Expenses</h2>
                    </header>
                    <form id="edit_expenses_form<?php echo $row["id"]; ?>" role="form" method="POST">
                        <div class="card-body">
                            <div class="col-md-12" id="edit_error_section<?php echo $row["id"]; ?>"></div>
                            <div class="row">

                                <div class="col-4">
                                    <label>Payment Date</label>
                                    <input type="date" name="payment_date" id="payment_date<?php echo $row["id"]; ?>"
                                        value="<?php echo $row["payment_date"]; ?>" class="form-control" required>
                                </div>
                                <div class="col-4">
                                    <label>Particulars (Paid For)</label>
                                    <input type="text" name="particulars" id="particulars<?php echo $row["id"]; ?>"
                                        value="<?php echo $row["particulars"]; ?>" class="form-control" required>
                                </div>
                                <div class="col-4">
                                    <label>Amount</label>
                                    <input type="text" name="amount" id="amount<?php echo $row["id"]; ?>"
                                        value="<?php echo $row["amount"]; ?>" class="form-control" required>
                                </div>
                                <div class="col-4">
                                    <label>Paid To</label>
                                    <input type="text" name="paid_to" id="paid_to<?php echo $row["id"]; ?>"
                                        value="<?php echo $row["paid_to"]; ?>" class="form-control" required>
                                </div>

                                <div class="col-4">
                                    <label>Remarks</label>
                                    <textarea name="remarks" id="remarks<?php echo $row["id"]; ?>"
                                        value="<?php echo $row["remarks"]; ?>" class="form-control"
                                        style="height:38px;"><?php echo $row["remarks"]; ?></textarea>
                                </div>
                                <div class="col-4">
                                    <label>Payment Mode</label>
                                    <select name="payment_mode" id="payment_mode<?php echo $row["id"]; ?>"
                                        class="form-control" onchange="changeMode(this.value);">
                                        <option value="<?php echo $row["payment_mode"]; ?>">
                                            <?php echo $row["payment_mode"]; ?>
                                        </option>
                                        <option value="Cash">Cash</option>
                                        <option value="DD">DD</option>
                                        <option value="Cheque">Cheque</option>
                                        <option value="Online">Online</option>
                                        <option value="NEFT/IMPS/RTGS">NEFT/IMPS/RTGS</option>
                                    </select>
                                </div>
                                <script>
                                function changeMode(str) {
                                    if (str == 'Cheque' || str == 'DD' || str == 'Online' || str == 'NEFT/IMPS/RTGS') {
                                        document.getElementById('bank').style.display = "block";
                                    } else {
                                        document.getElementById('bank').style.display = "none";
                                    }
                                }
                                </script>
                                <div style='display:none;' id="bank">
                                    <div class="row">
                                        <div class="col-4">
                                            <label>Account Number</label>
                                            <input type="text" name="account_number"
                                                id="account_number<?php echo $row["id"]; ?>"
                                                value="<?php echo $row["account_number"]; ?>" class="form-control"
                                                style="width: 86%;">
                                        </div>
                                        <div class="col-4">
                                            <label>Bank Name</label>
                                            <input type="text" name="bank_name" id="bank_name<?php echo $row["id"]; ?>"
                                                value="<?php echo $row["bank_name"]; ?>" class="form-control"
                                                style="width: 86%;">
                                        </div>
                                        <div class="col-4">
                                            <label>Branch Name</label>
                                            <input type="text" name="branch_name"
                                                id="branch_name<?php echo $row["id"]; ?>"
                                                value="<?php echo $row["branch_name"]; ?>" class="form-control"
                                                style="width: 86%;">
                                        </div>
                                        <div class="col-4">
                                            <label>Ifsc Code</label>
                                            <input type="text" name="ifsc_code" id="ifsc_code<?php echo $row["id"]; ?>"
                                                value="<?php echo $row["ifsc_code"]; ?>" class="form-control"
                                                style="width: 86%;">
                                        </div>
                                        <div class="col-4">
                                            <label>Cheque/DD/NEFT No</label>
                                            <input type="text" name="transaction_no"
                                                id="transaction_no<?php echo $row["id"]; ?>"
                                                value="<?php echo $row["transaction_no"]; ?>" class="form-control"
                                                style="width: 86%;">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <input type='hidden' name='edit_id' id="edit_id<?php echo $row["id"]; ?>"
                                value='<?php echo $row["id"]; ?>' />
                            <input type='hidden' name='action' id="action<?php echo $row["id"]; ?>"
                                value='edit_expenses' />
                            <div class="col-md-12" id="edit_loader_section<?php echo $row["id"]; ?>"></div>
                            <button type="button" id="edit_expenses_button<?php echo $row["id"]; ?>"
                                class="btn btn-primary">Update</button>
                            <!--<button type="reset" class="btn btn-danger">Reset</button>-->
                        </div>
                    </form>
                    <script>
                    $(function() {

                        $('#edit_expenses_button<?php echo $row["id"]; ?>').click(function() {
                            $('#edit_loader_section<?php echo $row["id"]; ?>').append(
                                '<center id = "edit_loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /></center>'
                            );
                            $('#edit_expenses_button<?php echo $row["id"]; ?>').prop('disabled', true);
                            var action = $("#action<?php echo $row["id"]; ?>").val();
                            var edit_id = $("#edit_id<?php echo $row["id"]; ?>").val();
                            var payment_date = $("#payment_date<?php echo $row["id"]; ?>").val();
                            var particulars = $("#particulars<?php echo $row["id"]; ?>").val();
                            var amount = $("#amount<?php echo $row["id"]; ?>").val();
                            var payment_mode = $("#payment_mode<?php echo $row["id"]; ?>").val();
                            var account_number = $("#account_number<?php echo $row["id"]; ?>").val();
                            var bank_name = $("#bank_name<?php echo $row["id"]; ?>").val();
                            var branch_name = $("#branch_name<?php echo $row["id"]; ?>").val();
                            var ifsc_code = $("#ifsc_code<?php echo $row["id"]; ?>").val();
                            var transaction_no = $("#transaction_no<?php echo $row["id"]; ?>").val();
                            var paid_to = $("#paid_to<?php echo $row["id"]; ?>").val();
                            var remarks = $("#remarks<?php echo $row["id"]; ?>").val();

                            var dataString = 'action=' + action + '&edit_id=' + edit_id +
                                '&payment_date=' + payment_date + '&particulars=' + particulars +
                                '&amount=' + amount + '&payment_mode=' + payment_mode +
                                '&account_number=' + account_number + '&bank_name=' + bank_name +
                                '&branch_name=' + branch_name + '&ifsc_code=' + ifsc_code +
                                '&transaction_no=' + transaction_no + '&paid_to=' + paid_to +
                                '&remarks=' + remarks;

                            $.ajax({
                                url: 'include/controller.php',
                                type: 'POST',
                                data: dataString,
                                success: function(result) {
                                    $('#edit_response').remove();
                                    if (result == "exsits") {
                                        $('#edit_error_section<?php echo $row["id"]; ?>')
                                            .append(
                                                '<div id = "edit_response"><div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-exclamation-triangle"></i> This No have already exsits!!!</div></div>'
                                            );
                                    }
                                    if (result == "error") {
                                        $('#edit_error_section<?php echo $row["id"]; ?>')
                                            .append(
                                                '<div id = "edit_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                            );
                                    }
                                    if (result == "empty") {
                                        $('#edit_error_section<?php echo $row["id"]; ?>')
                                            .append(
                                                '<div id = "edit_response"><div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-exclamation-triangle"></i>  Please fill out Prospectus No!!!</div></div>'
                                            );
                                    }
                                    if (result == "success") {
                                        $('#edit_error_section<?php echo $row["id"]; ?>')
                                            .append(
                                                '<div id = "edit_response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i>  Updated successfully!!!</div></div>'
                                            );
                                        showUpdatedData();

                                        function showUpdatedData() {
                                            $.ajax({
                                                url: 'include/view.php?action=get_expenses',
                                                type: 'GET',
                                                success: function(result) {
                                                    $("#data_table").html(
                                                        result);
                                                }
                                            });
                                        }
                                    }
                                    $('#edit_loading').fadeOut(500, function() {
                                        $(this).remove();
                                    });
                                    $('#edit_expenses_button<?php echo $row["id"]; ?>')
                                        .prop('disabled', false);
                                }

                            });
                        });

                    });
                    </script>
                </div>
            </div>
            <!-- Expenses Edit Section End -->

            <!-- Expenses delete Section Start -->
            <div id="delete_expenses<?php echo $row["id"]; ?>" class="w3-modal" style="z-index:2020;">
                <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
                    <header class="w3-container" style="background:#343a40; color:white;">
                        <span
                            onclick="document.getElementById('delete_expenses<?php echo $row["id"]; ?>').style.display='none'"
                            class="w3-button w3-display-topright">&times;</span>
                        <h2 align="center">Are you sure???</h2>
                    </header>
                    <form id="delete_expenses_form<?php echo $row["id"]; ?>" role="form" method="POST">
                        <div class="card-body">
                            <div class="col-md-12" id="delete_error_section<?php echo $row["id"]; ?>"></div>
                            <div class="col-md-12" align="center">
                                <input type='hidden' name='delete_id' id="delete_id<?php echo $row["id"]; ?>"
                                    value='<?php echo $row["id"]; ?>' />
                                <input type='hidden' name='action' id="action_delete<?php echo $row["id"]; ?>"
                                    value='delete_expenses' />
                                <div class="col-md-12" id="delete_loader_section<?php echo $row["id"]; ?>"></div>
                                <button type="button" id="delete_expenses_button<?php echo $row["id"]; ?>"
                                    class="btn btn-danger">Move To Trash</button>
                                <button type="button"
                                    onclick="document.getElementById('delete_expenses<?php echo $row["id"]; ?>').style.display='none'"
                                    class="btn btn-primary">Cancel</button>
                            </div>

                            <!--<button type="reset" class="btn btn-danger">Reset</button>-->
                        </div>
                    </form>
                    <script>
                    $(function() {

                        $('#delete_expenses_button<?php echo $row["id"]; ?>').click(function() {
                            $('#delete_loader_section<?php echo $row["id"]; ?>').append(
                                '<center id = "delete_loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /><br/><br/></center>'
                            );
                            $('#delete_expenses_button<?php echo $row["id"]; ?>').prop('disabled',
                                true);
                            var action = $("#action_delete<?php echo $row["id"]; ?>").val();
                            var delete_id = $("#delete_id<?php echo $row["id"]; ?>").val();
                            var dataString = 'action=' + action + '&delete_id=' + delete_id;

                            $.ajax({
                                url: 'include/controller.php',
                                type: 'POST',
                                data: dataString,
                                success: function(result) {
                                    $('#delete_response').remove();
                                    if (result == "error") {
                                        $('#delete_error_section<?php echo $row["id"]; ?>')
                                            .append(
                                                '<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                            );
                                    }
                                    if (result == "empty") {
                                        $('#delete_error_section<?php echo $row["id"]; ?>')
                                            .append(
                                                '<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                            );
                                    }
                                    if (result == "success") {
                                        $('#delete_error_section<?php echo $row["id"]; ?>')
                                            .append(
                                                '<div id = "delete_response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i>Delete successfully!!!</div></div>'
                                            );
                                        showDeletedData();

                                        function showDeletedData() {
                                            $.ajax({
                                                url: 'include/view.php?action=get_expenses',
                                                type: 'GET',
                                                success: function(result) {
                                                    $("#data_table").html(
                                                        result);
                                                }
                                            });
                                        }
                                    }
                                    $('#delete_loading').fadeOut(500, function() {
                                        $(this).remove();
                                    });
                                    $('#delete_expenses_button<?php echo $row["id"]; ?>')
                                        .prop('disabled', false);
                                }

                            });
                        });

                    });
                    </script>
                </div>
            </div>
            <!-- Expenses delete Section End -->
        </tr>
        <?php
                        $s_no++;
                    }
                } else
                    echo '
                                <div class="alert alert-warning alert-dismissible">
                                    <i class="icon fas fa-exclamation-triangle"></i>  No data available now!!!
                                </div>';
                ?>
    </tbody>
</table>
<script>
$(function() {
    $("#example1").DataTable();
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
    });
});
</script>
<?php
    }
    //Expenses End
    //Admin List Start
    include 'view/admin.php';
    //Admin list End

    //Nsuniv Home Enquiry Start
    if ($_GET["action"] == "get_nsuniv_home_enquiry") {
        ?>
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Name</th>
            <th>Phone No</th>
            <th>Timing</th>
            <th class="project-actions text-center">Action </th>
        </tr>
    </thead>
    <tbody>
        <?php
                $objectDefault->select("admission_enquiry_tbl");
                $objectDefault->where("`is_deleted` = '0' ORDER BY `id` DESC");
                $result = $objectDefault->get();
                if ($result->num_rows > 0) {
                    while ($row = $objectDefault->get_row()) {
                        ?>
        <tr>
            <td>
                <?php echo $s_no; ?>
            </td>
            <td>
                <?php echo $row["admission_name"] ?>
            </td>
            <td>
                <?php echo $row["admission_phone"] ?>
            </td>
            <td>
                <?php echo $row["time"] ?>
            </td>
            <td class="project-actions text-center">
                <button class="btn btn-info btn-sm"
                    onclick="document.getElementById('view_university_home_enquiry<?php echo $row["id"]; ?>').style.display='block'">
                    <i class="fas fa-eye">
                    </i>
                    View
                </button>
                <button class="btn btn-danger btn-sm"
                    onclick="document.getElementById('delete_university_home_enquiry<?php echo $row["id"]; ?>').style.display='block'">
                    <i class="fas fa-trash">
                    </i>
                    Delete
                </button>
            </td>

            <!-- View Section Start -->
            <div id="view_university_home_enquiry<?php echo $row["id"]; ?>" class="w3-modal" style="z-index:2020;">
                <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
                    <header class="w3-container" style="background:#343a40; color:white;">
                        <span
                            onclick="document.getElementById('view_university_home_enquiry<?php echo $row["id"]; ?>').style.display='none'"
                            class="w3-button w3-display-topright">&times;</span>
                        <h2 align="center">View Details</h2>
                    </header>
                    <form role="form" method="POST">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Course</label>
                                        <input type="text" class="form-control"
                                            value="<?php echo $row["admission_course"] ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control"
                                            value="<?php echo $row["admission_name"] ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email Id</label>
                                        <input type="text" class="form-control"
                                            value="<?php echo $row["admission_email"] ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone No</label>
                                        <input type="text" class="form-control"
                                            value="<?php echo $row["admission_phone"] ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>State</label>
                                        <input type="text" class="form-control"
                                            value="<?php echo $row["admission_state"] ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input type="text" class="form-control"
                                            value="<?php echo $row["admission_city"] ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last Qualification</label>
                                        <input type="text" class="form-control"
                                            value="<?php echo $row["admission_last_qualify"] ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Timing</label>
                                        <input type="text" class="form-control" value="<?php echo $row["time"] ?>"
                                            readonly>
                                    </div>
                                    <div class="form-group">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- View Section End -->

            <!-- Delete Section Start -->
            <div id="delete_university_home_enquiry<?php echo $row["id"]; ?>" class="w3-modal" style="z-index:2020;">
                <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
                    <header class="w3-container" style="background:#343a40; color:white;">
                        <span
                            onclick="document.getElementById('delete_university_home_enquiry<?php echo $row["id"]; ?>').style.display='none'"
                            class="w3-button w3-display-topright">&times;</span>
                        <h2 align="center">Are you sure???</h2>
                    </header>
                    <form id="delete_university_home_enquiry_form<?php echo $row["id"]; ?>" role="form" method="POST">
                        <div class="card-body">
                            <div class="col-md-12" id="delete_error_section<?php echo $row["id"]; ?>"></div>
                            <div class="col-md-12" align="center">
                                <input type='hidden' name='delete_id' id="delete_id<?php echo $row["id"]; ?>"
                                    value='<?php echo $row["id"]; ?>' />
                                <input type='hidden' name='action' id="action_delete<?php echo $row["id"]; ?>"
                                    value='delete_university_home_enquiry' />
                                <div class="col-md-12" id="delete_loader_section<?php echo $row["id"]; ?>"></div>
                                <button type="button"
                                    id="delete_university_home_enquiry_button<?php echo $row["id"]; ?>"
                                    class="btn btn-danger">Move To Trash</button>
                                <button type="button"
                                    onclick="document.getElementById('delete_university_home_enquiry<?php echo $row["id"]; ?>').style.display='none'"
                                    class="btn btn-primary">Cancel</button>
                            </div>

                            <!--<button type="reset" class="btn btn-danger">Reset</button>-->
                        </div>
                    </form>
                    <script>
                    $(function() {

                        $('#delete_university_home_enquiry_button<?php echo $row["id"]; ?>').click(function() {
                            $('#delete_loader_section<?php echo $row["id"]; ?>').append(
                                '<center id = "delete_loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /><br/><br/></center>'
                            );
                            $('#delete_university_home_enquiry_button<?php echo $row["id"]; ?>').prop(
                                'disabled', true);
                            var action = $("#action_delete<?php echo $row["id"]; ?>").val();
                            var delete_id = $("#delete_id<?php echo $row["id"]; ?>").val();
                            var dataString = 'action=' + action + '&delete_id=' + delete_id;

                            $.ajax({
                                url: 'include/controller.php',
                                type: 'POST',
                                data: dataString,
                                success: function(result) {
                                    //                                                                console.log(dataString);
                                    //                                                                console.log(result);
                                    $('#delete_response').remove();
                                    if (result == "error") {
                                        $('#delete_error_section<?php echo $row["id"]; ?>')
                                            .append(
                                                '<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                            );
                                    }
                                    if (result == "empty") {
                                        $('#delete_error_section<?php echo $row["id"]; ?>')
                                            .append(
                                                '<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                            );
                                    }
                                    if (result == "success") {
                                        $('#delete_error_section<?php echo $row["id"]; ?>')
                                            .append(
                                                '<div id = "delete_response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Enquiry Delete successfully!!!</div></div>'
                                            );
                                        showDeletedData();

                                        function showDeletedData() {
                                            $.ajax({
                                                url: 'include/view.php?action=get_nsuniv_home_enquiry',
                                                type: 'GET',
                                                success: function(result) {
                                                    $("#data_table").html(
                                                        result);
                                                }
                                            });
                                        }
                                    }
                                    $('#delete_loading').fadeOut(500, function() {
                                        $(this).remove();
                                        $('#delete_university_home_enquiry_button<?php echo $row["id"]; ?>')
                                            .prop('disabled', false);
                                    });
                                }

                            });
                        });

                    });
                    </script>
                </div>
            </div>
            <!-- Delete Section End -->
        </tr>
        <?php
                        $s_no++;
                    }
                } else
                    echo '
                                <div class="alert alert-warning alert-dismissible">
                                    <i class="icon fas fa-exclamation-triangle"></i>  No data available now!!!
                                </div>';
                ?>
    </tbody>
</table>
<script>
$(function() {
    $("#example1").DataTable();
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
    });
});
</script>
<?php
    }
    //Nsuniv Home Enquiry End
    //Nsuniv Prospectus Enquiry Start

    //Nsuniv Prospectus Enquiry End
    //Nsuniv Get Started Enquiry Start
    if ($_GET["action"] == "get_nsuniv_get_enquiry") {
        $objectSecond->update("tbl_alert", "`get_started_enquiry` = '0' WHERE `id`='1'");
        $objectSecond->sql = "";
        ?>
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Seleted Course</th>
            <th>Applicant Name</th>
            <th>Email</th>
            <th>Phone No</th>
            <th>Referred By</th>
            <th>State</th>
            <th>City</th>
            <th>Last Qualification</th>
            <th>Timing</th>
            <th class="project-actions text-center">Action </th>
        </tr>
    </thead>
    <tbody>
        <?php
                $objectDefault->select("admission_enquiry_tbl");
                $objectDefault->where("`is_deleted` = '1' ORDER BY `id` DESC");
                //$objectDefault->where("`admission_city` = 'jamshedpur'");
                $result = $objectDefault->get();
                //print_r($result); exit();
                //if($result->num_rows > 0){
                while ($row = $objectDefault->get_row()) {
                    ?>
        <tr>
            <td>
                <?php echo $s_no; ?>
            </td>
            <td>
                <?php echo $row["admission_course"] ?>
            </td>
            <td>
                <?php echo $row["admission_name"] ?>
            </td>
            <td>
                <?php echo $row["admission_email"] ?>
            </td>
            <td>
                <?php echo $row["admission_phone"] ?>
            </td>
            <td>
                <?php echo $row["revert_by"] ?>
            </td>
            <td>
                <?php echo $row["admission_state"] ?>
            </td>
            <td>
                <?php echo $row["admission_city"] ?>
            </td>
            <td>
                <?php echo $row["admission_last_qualify"] ?>
            </td>
            <td>
                <?php echo $row["time"] ?>
            </td>
            <td class="project-actions text-center">
                <button class="btn btn-danger btn-sm"
                    onclick="document.getElementById('delete_university_get_enquiry<?php echo $row["id"]; ?>').style.display='block'">
                    <i class="fas fa-trash">
                    </i>
                    Delete
                </button>
            </td>

            <!-- Delete Section Start -->
            <div id="delete_university_get_enquiry<?php echo $row["id"]; ?>" class="w3-modal" style="z-index:2020;">
                <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
                    <header class="w3-container" style="background:#343a40; color:white;">
                        <span
                            onclick="document.getElementById('delete_university_get_enquiry<?php echo $row["id"]; ?>').style.display='none'"
                            class="w3-button w3-display-topright">&times;</span>
                        <h2 align="center">Are you sure???</h2>
                    </header>
                    <form id="delete_university_get_enquiry_form<?php echo $row["id"]; ?>" role="form" method="POST">
                        <div class="card-body">
                            <div class="col-md-12" id="delete_error_section<?php echo $row["id"]; ?>"></div>
                            <div class="col-md-12" align="center">
                                <input type='hidden' name='delete_id' id="delete_id<?php echo $row["id"]; ?>"
                                    value='<?php echo $row["id"]; ?>' />
                                <input type='hidden' name='action' id="action_delete<?php echo $row["id"]; ?>"
                                    value='delete_university_get_enquiry' />
                                <div class="col-md-12" id="delete_loader_section<?php echo $row["id"]; ?>"></div>
                                <button type="button" id="delete_university_get_enquiry_button<?php echo $row["id"]; ?>"
                                    class="btn btn-danger">Move To Trash</button>
                                <button type="button"
                                    onclick="document.getElementById('delete_university_get_enquiry<?php echo $row["id"]; ?>').style.display='none'"
                                    class="btn btn-primary">Cancel</button>
                            </div>

                            <!--<button type="reset" class="btn btn-danger">Reset</button>-->
                        </div>
                    </form>
                    <script>
                    $(function() {

                        $('#delete_university_get_enquiry_button<?php echo $row["id"]; ?>').click(function() {
                            $('#delete_loader_section<?php echo $row["id"]; ?>').append(
                                '<center id = "delete_loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /><br/><br/></center>'
                            );
                            $('#delete_university_get_enquiry_button<?php echo $row["id"]; ?>').prop(
                                'disabled', true);
                            var action = $("#action_delete<?php echo $row["id"]; ?>").val();
                            var delete_id = $("#delete_id<?php echo $row["id"]; ?>").val();
                            var dataString = 'action=' + action + '&delete_id=' + delete_id;

                            $.ajax({
                                url: 'include/controller.php',
                                type: 'POST',
                                data: dataString,
                                success: function(result) {
                                    //                                                                console.log(dataString);
                                    //                                                                console.log(result);
                                    $('#delete_response').remove();
                                    if (result == "error") {
                                        $('#delete_error_section<?php echo $row["id"]; ?>')
                                            .append(
                                                '<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                            );
                                    }
                                    if (result == "empty") {
                                        $('#delete_error_section<?php echo $row["id"]; ?>')
                                            .append(
                                                '<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                            );
                                    }
                                    if (result == "success") {
                                        $('#delete_error_section<?php echo $row["id"]; ?>')
                                            .append(
                                                '<div id = "delete_response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Enquiry Delete successfully!!!</div></div>'
                                            );
                                        showDeletedData();

                                        function showDeletedData() {
                                            $.ajax({
                                                url: 'include/view.php?action=get_nsuniv_get_enquiry',
                                                type: 'GET',
                                                success: function(result) {
                                                    $("#data_table").html(
                                                        result);
                                                }
                                            });
                                        }
                                    }
                                    $('#delete_loading').fadeOut(500, function() {
                                        $(this).remove();
                                        $('#delete_university_get_enquiry_button<?php echo $row["id"]; ?>')
                                            .prop('disabled', false);
                                    });
                                }

                            });
                        });

                    });
                    </script>
                </div>
            </div>
            <!-- Delete Section End -->
        </tr>
        <?php
                    $s_no++;
                }
                /*} else
                            echo '
                                <div class="alert alert-warning alert-dismissible">
                                    <i class="icon fas fa-exclamation-triangle"></i>  No data available now!!!
                                </div>';
                                */
                ?>
    </tbody>
</table>
<script>
$(function() {
    $("#example1").DataTable();
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
    });
});
</script>
<?php
    }
    //Nsuniv Get Started Enquiry End

    //Nsuniv Online Admission Start
    if ($_GET["action"] == "get_nsuniv_admission_enquiry") {
        $objectSecond->update("tbl_alert", "`admission_enquiry` = '0' WHERE `id`='1'");
        $objectSecond->sql = "";
        ?>
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Name</th>
            <th>Course</th>
            <th>Phone No</th>
            <th>Timing</th>
            <th>Status</th>
            <th class="project-actions text-center">Action </th>
        </tr>
    </thead>
    <tbody>
        <?php
                $objectSecond->select("tbl_admission");
                $objectSecond->where("`status` = '$visible' && `type` = 'online_admission' ORDER BY `admission_id` DESC");
                $result = $objectSecond->get();
                if ($result->num_rows > 0) {
                    while ($row = $objectSecond->get_row()) {
                        ?>
        <tr>
            <td>
                <?php echo $s_no; ?>
            </td>
            <td>
                <?php echo $row["admission_first_name"] ?>
                <?php echo $row["admission_middle_name"] ?>
                <?php echo $row["admission_last_name"] ?>
            </td>
            <?php $sql_course = "SELECT * FROM `tbl_course`
                                                       WHERE `status` = '$visible' && `course_id` = '" . $row["admission_course_name"] . "';
                                                       ";
                            $result_course = $con->query($sql_course);
                            $row_course = $result_course->fetch_assoc();
                            ?>
            <td>
                <?php echo $row_course["course_name"]; ?>
            </td>
            <td>
                <?php echo $row["admission_mobile_student"] ?>
            </td>
            <td>
                <?php echo $row["post_at"] ?>
            </td>
            <td>
                <?php echo $row["approval"] ?>
            </td>
            <td class="project-actions text-center">
                <button class="btn btn-info btn-sm"
                    onclick="document.getElementById('view_student_lists<?php echo $row["admission_id"]; ?>').style.display='block'">
                    <i class="fas fa-eye">
                    </i>

                </button>
                <a href="edit_student?id=<?php echo $row['admission_id']; ?>"><button
                        class="update btn btn-warning btn-sm"><i class="fas fa-pencil-alt">
                        </i>
                        </span></button></a>
                <button class="btn btn-danger btn-sm"
                    onclick="document.getElementById('delete_student_lists<?php echo $row["admission_id"]; ?>').style.display='block'">
                    <i class="fas fa-trash">
                    </i>

                </button>
            </td>

            <!-- Online Student List view Section Start -->
            <div id="view_student_lists<?php echo $row["admission_id"]; ?>" class="w3-modal" style="z-index:2020;">
                <div class="w3-modal-content w3-animate-top w3-card-4" style="width:70%">
                    <header class="w3-container" style="background:#343a40; color:white;">
                        <span
                            onclick="document.getElementById('view_student_lists<?php echo $row["admission_id"]; ?>').style.display='none'"
                            class="w3-button w3-display-topright">&times;</span>
                        <h2 align="center">Student Details</h2>
                    </header>
                    <form id="view_student_list_form<?php echo $row["admission_id"]; ?>" role="form" method="POST">
                        <div class="card-body" style="margin-bottom: 50px;">
                            <div class="col-md-12" id="edit_error_section<?php echo $row["admission_id"]; ?>"></div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Registration Number</label>
                                        <input type="text" name=""
                                            id="edit_student_list_reg_no<?php echo $row["admission_id"]; ?>"
                                            class="form-control" value="<?php echo $row["admission_id"]; ?>" readonly />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Prospectus Number</label>
                                        <input type="text" name=""
                                            id="edit_student_list_reg_no<?php echo $row["admission_id"]; ?>"
                                            class="form-control" value="<?php echo $row["admission_form_no"]; ?>"
                                            readonly />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Admission Number</label>
                                        <input type="text" name=""
                                            id="edit_student_list_admission_no<?php echo $row["admission_id"]; ?>"
                                            class="form-control" value="<?php echo $row["admission_no"]; ?>" readonly />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Course Name</label>
                                        <select name=""
                                            id="edit_student_list_course_name<?php echo $row["admission_id"]; ?>"
                                            class="form-control" readonly>
                                            <?php
                                                            $sql_c = "SELECT * FROM `tbl_course`
                                                                                       WHERE `status` = '$visible';
                                                                                       ";
                                                            $result_c = $con->query($sql_c);
                                                            while ($row_c = $result_c->fetch_assoc()) {
                                                                ?>
                                            <option value="<?php echo $row_c["course_id"]; ?>" <?php if ($row_c["course_id"] == $row_course["course_id"])
                                                                       echo 'selected'; ?>>
                                                <?php echo $row_c["course_name"]; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Session</label>
                                        <select name=""
                                            id="edit_student_list_session<?php echo $row["admission_id"]; ?>"
                                            class="form-control" readonly>
                                            <?php
                                                            $sql_c = "SELECT * FROM `tbl_university_details`
                                                                                       WHERE `status` = '$visible';
                                                                                       ";
                                                            $result_c = $con->query($sql_c);
                                                            while ($row_c = $result_c->fetch_assoc()) {
                                                                ?>
                                            <option value="<?php echo $row_c["university_details_id"]; ?>" <?php if ($row_c["university_details_id"] == $row["admission_session"])
                                                                       echo 'selected'; ?>>
                                                <?php echo $row_c["university_details_academic_start_date"]; ?> to
                                                <?php echo $row_c["university_details_academic_end_date"]; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Student Name</label>
                                        <input type="text" name=""
                                            id="edit_student_list_first_name<?php echo $row["admission_id"]; ?>"
                                            class="form-control"
                                            value="<?php echo $row["admission_first_name"]; ?>&nbsp;&nbsp;<?php echo $row["admission_middle_name"]; ?>&nbsp;&nbsp;<?php echo $row["admission_last_name"]; ?>"
                                            readonly />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>DOB</label>
                                        <input type="text" name=""
                                            id="edit_student_list_contact_no<?php echo $row["admission_id"]; ?>"
                                            class="form-control" value="<?php echo $row["admission_dob"]; ?>"
                                            readonly />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Nationality</label>
                                        <input type="text" name=""
                                            id="edit_student_list_contact_no<?php echo $row["admission_id"]; ?>"
                                            class="form-control" value="<?php echo $row["admission_nationality"]; ?>"
                                            readonly />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Adhar No</label>
                                        <input type="text" name=""
                                            id="edit_student_list_contact_no<?php echo $row["admission_id"]; ?>"
                                            class="form-control" value="<?php echo $row["admission_aadhar_no"]; ?>"
                                            readonly />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Date Of Admission</label>
                                        <input type="text" name=""
                                            id="edit_student_list_contact_no<?php echo $row["admission_id"]; ?>"
                                            class="form-control" value="<?php echo $row["date_of_admission"]; ?>"
                                            readonly />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Category</label>
                                        <input type="text" name=""
                                            id="edit_student_list_contact_no<?php echo $row["admission_id"]; ?>"
                                            class="form-control" value="<?php echo $row["admission_category"]; ?>"
                                            readonly />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <input type="text" name=""
                                            id="edit_student_list_contact_no<?php echo $row["admission_id"]; ?>"
                                            class="form-control" value="<?php echo $row["admission_gender"]; ?>"
                                            readonly />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name=""
                                            id="edit_student_list_contact_no<?php echo $row["admission_id"]; ?>"
                                            class="form-control" value="<?php echo $row["admission_username"]; ?>"
                                            readonly />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="text" name=""
                                            id="edit_student_list_contact_no<?php echo $row["admission_id"]; ?>"
                                            class="form-control" value="<?php echo $row["admission_password"]; ?>"
                                            readonly />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Blood Group</label>
                                        <input type="text" name=""
                                            id="edit_student_list_contact_no<?php echo $row["admission_id"]; ?>"
                                            class="form-control" value="<?php echo $row["admission_blood_group"]; ?>"
                                            readonly />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Hostel</label>
                                        <input type="text" name=""
                                            id="edit_student_list_email<?php echo $row["admission_id"]; ?>"
                                            class="form-control" value="<?php echo $row["admission_hostel"]; ?>"
                                            readonly />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Transport</label>
                                        <input type="text" name=""
                                            id="edit_student_list_email<?php echo $row["admission_id"]; ?>"
                                            class="form-control" value="<?php echo $row["admission_transport"]; ?>"
                                            readonly />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <img src="images/student_images/<?php echo $row["admission_profile_image"]; ?>"
                                            style="height:100%">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Student Contact No</label>
                                        <input type="text" name=""
                                            id="edit_student_list_fathers_contact<?php echo $row["admission_id"]; ?>"
                                            class="form-control" value="<?php echo $row["admission_mobile_student"]; ?>"
                                            readonly />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Student EmailID</label>
                                        <input type="text" name=""
                                            id="edit_student_list_fathers_contact<?php echo $row["admission_id"]; ?>"
                                            class="form-control"
                                            value="<?php echo $row["admission_emailid_student"]; ?>" readonly />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Father's Name</label>
                                        <input type="text" name=""
                                            id="edit_student_list_fathers_name<?php echo $row["admission_id"]; ?>"
                                            class="form-control" value="<?php echo $row["admission_father_name"]; ?>"
                                            readonly />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Father Contact No</label>
                                        <input type="text" name=""
                                            id="edit_student_list_fathers_contact<?php echo $row["admission_id"]; ?>"
                                            class="form-control" value="<?php echo $row["admission_father_phoneno"]; ?>"
                                            readonly />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Mother's Name</label>
                                        <input type="text" name=""
                                            id="edit_student_list_fathers_name<?php echo $row["admission_id"]; ?>"
                                            class="form-control" value="<?php echo $row["admission_mother_name"]; ?>"
                                            readonly />
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <!-- online student list view Section End -->

            <!-- delete Section Start -->
            <div id="delete_student_lists<?php echo $row["admission_id"]; ?>" class="w3-modal" style="z-index:2020;">
                <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
                    <header class="w3-container" style="background:#343a40; color:white;">
                        <span
                            onclick="document.getElementById('delete_student_lists<?php echo $row["admission_id"]; ?>').style.display='none'"
                            class="w3-button w3-display-topright">&times;</span>
                        <h2 align="center">Are you sure???</h2>
                    </header>
                    <form id="delete_student_list_form<?php echo $row["admission_id"]; ?>" role="form" method="POST">
                        <div class="card-body">
                            <div class="col-md-12" id="delete_error_section<?php echo $row["admission_id"]; ?>"></div>
                            <div class="col-md-12" align="center">
                                <input type='hidden' name='delete_admission_id'
                                    id="delete_admission_id<?php echo $row["admission_id"]; ?>"
                                    value='<?php echo $row["admission_id"]; ?>' />
                                <input type='hidden' name='action' id="action_delete<?php echo $row["admission_id"]; ?>"
                                    value='delete_student_lists' />
                                <div class="col-md-12" id="delete_loader_section<?php echo $row["admission_id"]; ?>">
                                </div>
                                <button type="button" id="delete_student_list_button<?php echo $row["admission_id"]; ?>"
                                    class="btn btn-danger">Move To Trash</button>
                                <button type="button"
                                    onclick="document.getElementById('delete_student_lists<?php echo $row["admission_id"]; ?>').style.display='none'"
                                    class="btn btn-primary">Cancel</button>
                            </div>
                        </div>
                    </form>

                    <script>
                    $(function() {
                        $('#delete_student_list_button<?php echo $row["admission_id"]; ?>').click(function() {
                            $('#delete_loader_section<?php echo $row["admission_id"]; ?>').append(
                                '<center id = "delete_loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /><br/><br/></center>'
                            );
                            $('#delete_student_list_button<?php echo $row["admission_id"]; ?>').prop(
                                'disabled', true);
                            var action = $("#action_delete<?php echo $row["admission_id"]; ?>").val();
                            var delete_admission_id = $(
                                "#delete_admission_id<?php echo $row["admission_id"]; ?>").val();
                            var dataString = 'action=' + action + '&delete_admission_id=' +
                                delete_admission_id;

                            $.ajax({
                                url: 'include/controller.php',
                                type: 'POST',
                                data: dataString,
                                success: function(result) {
                                    $('#delete_response').remove();
                                    if (result == "error") {
                                        $('#delete_error_section<?php echo $row["admission_id"]; ?>')
                                            .append(
                                                '<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                            );
                                    }
                                    if (result == "empty") {
                                        $('#delete_error_section<?php echo $row["admission_id"]; ?>')
                                            .append(
                                                '<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                            );
                                    }
                                    if (result == "success") {
                                        $('#delete_error_section<?php echo $row["admission_id"]; ?>')
                                            .append(
                                                '<div id = "delete_response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Fee Delete successfully!!!</div></div>'
                                            );
                                        showUpdatedData();

                                        function showUpdatedData() {
                                            $.ajax({
                                                url: 'include/view.php?action=fetch_student_list_details',
                                                type: 'POST',
                                                data: $('#fetchStudentDataForm')
                                                    .serializeArray(),
                                                success: function(result) {
                                                    $('#response').remove();
                                                    $('#data_table').append(
                                                        '<div id = "response">' +
                                                        result + '</div>');
                                                }
                                            });
                                        }
                                    }
                                    console.log(result);
                                    $('#delete_loading').fadeOut(500, function() {
                                        $(this).remove();
                                    });
                                    $('#delete_student_list_button<?php echo $row["admission_id"]; ?>')
                                        .prop('disabled', false);
                                }

                            });
                        });

                    });
                    </script>
                </div>
            </div>
            <!-- Delete Section End -->
        </tr>
        <?php
                        $s_no++;
                    }
                } else
                    echo '
                                <div class="alert alert-warning alert-dismissible">
                                    <i class="icon fas fa-exclamation-triangle"></i>  No data available now!!!
                                </div>';
                ?>
    </tbody>
</table>
<script>
$(function() {
    $("#example1").DataTable();
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
    });
});
</script>
<?php
    }
    //Nsuniv Online Admission  End

    //Nsuniv All Notification Start
    if ($_GET["action"] == "get_all_nsuniv_notifications") {
        $total_Notifications = 0;
        $objectSecond->select("tbl_alert");
        $objectSecond->where("`id` = '1'");
        $result = $objectSecond->get();
        if ($result->num_rows > 0) {
            $row = $objectSecond->get_row();
            $total_Notifications = $total_Notifications + $row["prospectus_enquiry"];
            $total_Notifications = $total_Notifications + $row["admission_enquiry"];
            $total_Notifications = $total_Notifications + $row["get_started_enquiry"];
            echo $total_Notifications;
        } else {
            echo $total_Notifications;
        }
    }
    //Nsuniv Prospectus Notification Start
    if ($_GET["action"] == "get_all_nsuniv_prospectus_notifications") {
        $total_Notifications = 0;
        $objectSecond->select("tbl_alert");
        $objectSecond->where("`id` = '1'");
        $result = $objectSecond->get();
        if ($result->num_rows > 0) {
            $row = $objectSecond->get_row();
            $total_Notifications = $total_Notifications + $row["prospectus_enquiry"];
            echo $total_Notifications;
        } else {
            echo $total_Notifications;
        }
    }
    //Nsuniv Prospectus Notification End
    //Nsuniv Admission Notification Start
    if ($_GET["action"] == "get_all_nsuniv_admission_notifications") {
        $total_Notifications = 0;
        $objectSecond->select("tbl_alert");
        $objectSecond->where("`id` = '1'");
        $result = $objectSecond->get();
        if ($result->num_rows > 0) {
            $row = $objectSecond->get_row();
            $total_Notifications = $total_Notifications + $row["admission_enquiry"];
            echo $total_Notifications;
        } else {
            echo $total_Notifications;
        }
    }
    //Nsuniv Admission Notification End
    //Nsuniv Get Started Notification Start
    if ($_GET["action"] == "get_all_nsuniv_get_started_notifications") {
        $total_Notifications = 0;
        $objectSecond->select("tbl_alert");
        $objectSecond->where("`id` = '1'");
        $result = $objectSecond->get();
        if ($result->num_rows > 0) {
            $row = $objectSecond->get_row();
            $total_Notifications = $total_Notifications + $row["get_started_enquiry"];
            echo $total_Notifications;
        } else {
            echo $total_Notifications;
        }
    }
    //Nsuniv Get Started Notification End

    //Nsuniv Notification Start
    if ($_GET["action"] == "get_nsuniv_notifications") {
        ?>
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Theme</th>
            <th>Notification</th>
            <th class="project-actions text-center">Action </th>
        </tr>
    </thead>
    <tbody>
        <?php
                $objectDefault->select("notification_tbl");
                $objectDefault->where("`status` = '$visible' && `visibility` = 'active' ORDER BY `id` DESC");
                $result = $objectDefault->get();
                if ($result->num_rows > 0) {
                    while ($row = $objectDefault->get_row()) {
                        switch ($row["theme"]) {
                            case "error":
                                $bgTheme = "Main Red Theme";
                                break;
                            case "success":
                                $bgTheme = "Main Blue Theme";
                                break;
                            case "info":
                                $bgTheme = "Slider Blue Theme";
                                break;
                            case "warning":
                                $bgTheme = "Warning Theme";
                                break;
                            default:
                                $bgTheme = "No theme";
                                break;
                        }
                        ?>
        <tr>
            <td>
                <?php echo $s_no; ?>
            </td>
            <td>
                <?php echo $bgTheme; ?>
            </td>
            <td>
                <?php echo $row["notification"]; ?>
            </td>
            <td class="project-actions text-center">
                <button class="btn btn-danger btn-sm"
                    onclick="document.getElementById('delete_university_home_enquiry<?php echo $row["id"]; ?>').style.display='block'">
                    <i class="fas fa-trash">
                    </i>
                    Delete
                </button>
            </td>

            <!-- Delete Section Start -->
            <div id="delete_university_home_enquiry<?php echo $row["id"]; ?>" class="w3-modal" style="z-index:2020;">
                <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
                    <header class="w3-container" style="background:#343a40; color:white;">
                        <span
                            onclick="document.getElementById('delete_university_home_enquiry<?php echo $row["id"]; ?>').style.display='none'"
                            class="w3-button w3-display-topright">&times;</span>
                        <h2 align="center">Are you sure???</h2>
                    </header>
                    <form id="delete_university_home_enquiry_form<?php echo $row["id"]; ?>" role="form" method="POST">
                        <div class="card-body">
                            <div class="col-md-12" id="delete_error_section<?php echo $row["id"]; ?>"></div>
                            <div class="col-md-12" align="center">
                                <input type='hidden' name='delete_id' id="delete_id<?php echo $row["id"]; ?>"
                                    value='<?php echo $row["id"]; ?>' />
                                <input type='hidden' name='action' id="action_delete<?php echo $row["id"]; ?>"
                                    value='delete_university_notification' />
                                <div class="col-md-12" id="delete_loader_section<?php echo $row["id"]; ?>"></div>
                                <button type="button"
                                    id="delete_university_home_enquiry_button<?php echo $row["id"]; ?>"
                                    class="btn btn-danger">Move To Trash</button>
                                <button type="button"
                                    onclick="document.getElementById('delete_university_home_enquiry<?php echo $row["id"]; ?>').style.display='none'"
                                    class="btn btn-primary">Cancel</button>
                            </div>

                            <!--<button type="reset" class="btn btn-danger">Reset</button>-->
                        </div>
                    </form>
                    <script>
                    $(function() {

                        $('#delete_university_home_enquiry_button<?php echo $row["id"]; ?>').click(function() {
                            $('#delete_loader_section<?php echo $row["id"]; ?>').append(
                                '<center id = "delete_loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /><br/><br/></center>'
                            );
                            $('#delete_university_home_enquiry_button<?php echo $row["id"]; ?>').prop(
                                'disabled', true);
                            var action = $("#action_delete<?php echo $row["id"]; ?>").val();
                            var delete_id = $("#delete_id<?php echo $row["id"]; ?>").val();
                            var dataString = 'action=' + action + '&delete_id=' + delete_id;

                            $.ajax({
                                url: 'include/controller.php',
                                type: 'POST',
                                data: dataString,
                                success: function(result) {
                                    //                                                                console.log(dataString);
                                    //                                                                console.log(result);
                                    $('#delete_response').remove();
                                    if (result == "error") {
                                        $('#delete_error_section<?php echo $row["id"]; ?>')
                                            .append(
                                                '<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                            );
                                    }
                                    if (result == "empty") {
                                        $('#delete_error_section<?php echo $row["id"]; ?>')
                                            .append(
                                                '<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                            );
                                    }
                                    if (result == "success") {
                                        $('#delete_error_section<?php echo $row["id"]; ?>')
                                            .append(
                                                '<div id = "delete_response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Notification Delete successfully!!!</div></div>'
                                            );
                                        showDeletedData();

                                        function showDeletedData() {
                                            $.ajax({
                                                url: 'include/view.php?action=get_nsuniv_notifications',
                                                type: 'GET',
                                                success: function(result) {
                                                    $("#data_table").html(
                                                        result);
                                                }
                                            });
                                        }
                                    }
                                    $('#delete_loading').fadeOut(500, function() {
                                        $(this).remove();
                                        $('#delete_university_home_enquiry_button<?php echo $row["id"]; ?>')
                                            .prop('disabled', false);
                                    });
                                }

                            });
                        });

                    });
                    </script>
                </div>
            </div>
            <!-- Delete Section End -->
        </tr>
        <?php
                        $s_no++;
                    }
                } else
                    echo '
                                <div class="alert alert-warning alert-dismissible">
                                    <i class="icon fas fa-exclamation-triangle"></i>  No data available now!!!
                                </div>';
                ?>
    </tbody>
</table>
<script>
$(function() {
    $("#example1").DataTable();
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
    });
});
</script>
<?php
    }
    //Nsuniv Notification End
    /* ---------- All Fetch Codes End ------------------------ */

    //Fetching course & year wise fee report Start
    include 'view/fetch_course_wise_fee_report.php';
    //Fetching course & year wise fee report end

    // add marks Student list
    include "view/add_marks.php";
    //add marks Student list end

    //Fetching migration form
    if ($_GET["action"] == "fetch_migration_view")   {
        $course_id = $_POST["course_id"];
        $academic_year = $_POST["academic_year"];
        $admin_id = $_SESSION['admin_id'];
        if ($academic_year != 0) {
            ?>


<table id="migrationFormTable" class="table table-bordered table-striped">

    <thead>
        <tr>
            <th rowspan="2">S.No</th>
            <th rowspan="2">Admission No</th>
            <th rowspan="2">Student Name</th>
            <th rowspan="2">Course</th>
            <th rowspan="2">University Regn No</th>
            <th rowspan="2">Semester</th>
            <th rowspan="2">Passed or Failed</th>
            <th rowspan="2">Passing Year</th>
            <th rowspan="2">Session</th>
            <th rowspan="2">Application Date</th>
            <th rowspan="2">Payment Status</th>
            <th rowspan="2">View Document</th>
            <th colspan="6" class="text-center">Clearance From</th>

        </tr>
        <tr>
            <th>Library</th>
            <th>Admin Dept</th>
            <th>Finance Dept</th>
            <th>HOD's</th>
            <th>IT Lab</th>
            <th>Print Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
                                            
                                             $s_no = 1;
                                            $sql = "SELECT * FROM `tbl_migration_form` WHERE `status` = '$visible' AND `course_id` = $course_id AND `academic_year` = $academic_year";
                                            $result = $con->query($sql); 

                                            if ($result->num_rows > 0) {
                                             
                                                while ($row = $result->fetch_assoc()) {
                                                    $admission_id =  $row["admission_id"];
                                                    $sql_name = "SELECT * FROM `tbl_admission` WHERE `status` = '$visible' AND `admission_id` = '$admission_id'";
                                                    $result_name = $con->query($sql_name);
                                                    $row_name = $result_name->fetch_assoc();

                                                    $course_id = $row["course_id"];
                                                    $sql_course = "SELECT * FROM `tbl_course` WHERE `status` = '$visible' AND `course_id` = '$course_id'";
                                                    $result_course = $con->query($sql_course);
                                                    $row_course = $result_course->fetch_assoc();

                                                    $sql_admin = "SELECT admin_type FROM tbl_admin WHERE admin_id = '$admin_id'";
                                                    $result_admin = $con->query($sql_admin);
                                                    $admin = $result_admin->fetch_assoc();
                                                    $admin_type = $admin['admin_type'];
                                                    ?>
        <tr class="text-center">
            <td><?php echo $s_no; ?></td>
            <td><?php echo $row["admission_id"]; ?></td>
            <td><?php echo $row_name["admission_first_name"] . " " . $row_name["admission_middle_name"] . " " . $row_name["admission_last_name"]; ?>
            </td>
            <td><?php echo $row_course["course_name"]; ?></td>
            <td><?php echo $row["registration_no"]; ?></td>
            <td><?php echo $row["semester"]; ?></td>
            <td><?php echo $row["passfail"]; ?></td>
            <td><?php echo $row["name_of_the_exam"]; ?></td>
            <td><?php echo $row["session"]; ?></td>
            <td><?php echo $row["create_time"]; ?></td>
            <td>
                <?php if ($row["amount"] == 0 || is_null($row["amount"])) { ?>
                <span class="badge badge-warning">Pending</span>
                <?php } else { ?>
                <span class="badge badge-success">Paid</span>
                <?php } ?>
            </td>
            <td>
                <button type="button" class="btn btn-warning btn-sm"
                    onclick="showDocumentModal('<?php echo $row['admission_id']; ?>')">
                    <i class="fas fa-eye"></i>
                </button>
            </td>
            <script>
            function showDocumentModal(admissionId) {
                // Fetch document data using AJAX
                fetch('view_document.php?admission_id=' + admissionId)
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            alert(data.error);
                        } else {
                            // Update modal content with document images
                            document.getElementById('doc_reg_img').src = data
                                .doc_reg;
                            document.getElementById('doc_marksheet_img').src =
                                data.doc_marksheet;
                            document.getElementById('doc_admitcard_img').src =
                                data.doc_admitcard;

                            // Show the modal
                            $('#documentModal').modal('show');
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching document data:', error);
                    });
            }
            </script>



            <div class="modal fade" id="documentModal" tabindex="-1" aria-labelledby="documentModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="documentModalLabel">View
                                Documents</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Registration Slip:</strong></p>
                            <img id="doc_reg_img" src="#" alt="Registration Document"
                                style="max-width: 100%; height: auto;">

                            <p><strong>Marksheet :</strong></p>
                            <img id="doc_marksheet_img" src="#" alt="Marksheet Document"
                                style="max-width: 100%; height: auto;">

                            <p><strong>Admit Card:</strong></p>
                            <img id="doc_admitcard_img" src="#" alt="Admit Card Document"
                                style="max-width: 100%; height: auto;">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <td>
                <button type="button" class="status-btn-lib btn btn-sm" data-id="<?php echo $row['admission_id']; ?>">
                    <?php echo ($row['library'] === 'Approved') ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>';
                                                                if ($row['library'] === 'Approved' && ($row["lib_approvedby"] != null or $row["lib_approvedby"] != '')) {
                                                                    echo "Approved By" . " " . $row["lib_approvedby"];
                                                                }
                                                                ?>
                </button>
            </td>
            <td>
                <button type="button" class="status-btn-admin btn btn-sm" data-id="<?php echo $row['admission_id']; ?>">
                    <?php echo ($row['admin_dept'] === 'Approved') ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>';
                                                                if ($row['admin_dept'] === 'Approved' && ($row["admin_approvedby"] != null or $row["admin_approvedby"] != '')) {
                                                                    echo "Approved By" . " " . $row["admin_approvedby"];
                                                                }
                                                                ?>
                </button>
            </td>
            <td>
                <button type="button" class="status-btn-finance btn btn-sm"
                    data-id="<?php echo $row['admission_id']; ?>">
                    <?php echo ($row['finance_dept'] === 'Approved') ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>';
                                                                if ($row['finance_dept'] === 'Approved' && ($row["finance_approvedby"] != null or $row["finance_approvedby"] != '')) {
                                                                    echo "Approved By" . " " . $row["finance_approvedby"];
                                                                }
                                                                ?>
                </button>
            </td>
            <td>
                <button type="button" class="status-btn-deptlab btn btn-sm"
                    data-id="<?php echo $row['admission_id']; ?>">
                    <?php echo ($row['dept_labs'] === 'Approved') ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>';
                                                                if ($row['dept_labs'] === 'Approved' && ($row["dept_approvedby"] != null or $row["dept_approvedby"] != '')) {
                                                                    echo "Approved By" . " " . $row["dept_approvedby"];
                                                                }
                                                                ?>
                </button>
            </td>

            <td>
                <button type="button" class="status-btn-it btn btn-sm" data-id="<?php echo $row['admission_id']; ?>">
                    <?php echo ($row['IT_lab'] === 'Approved') ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>';
                                                                if ($row['IT_lab'] === 'Approved' && ($row["it_approvedby"] != null or $row["it_approvedby"] != '')) {
                                                                    echo "Approved By" . " " . $row["it_approvedby"];
                                                                }
                                                                ?>
                </button>
            </td>
            <td>
                <?php
                                                            // Check if admin_id is set and equals 94
                                                            $admin_id = $_SESSION['admin_id'];
                                                            if ($admin_id == 94) {
                                                                ?>
                <button type="button" class="btn btn-sm btn-primary"
                    onclick="window.open('print_migration.php?admission_id=<?php echo $row['admission_id']; ?>', '_blank')">
                    <i class="fas fa-print"></i>
                </button>

                <?php
                                                            }
                                                            ?>
            </td>
            <td>
                <?php
                                                            if ($admin_id == 94) {
                                                                ?>
                <button class="btn btn-info btn-sm" type="button" data-toggle="modal"
                    data-target="#edit_migration<?= $row['migration_id'] ?>">
                    <i class="fas fa-pencil-alt"></i> Edit
                </button>
                <?php
                                                            }
                                                            ?>
            </td>

            <div id="edit_migration<?php echo $row["migration_id"]; ?>" class="w3-modal" style="z-index:2020;">
                <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
                    <header class="w3-container" style="background:#343a40; color:white;">
                        <button data-dismiss="modal" aria-label="Close"
                            class="  w3-button w3-display-topright">&times;</button>
                        <h2 align="center">Edit Migration</h2>
                    </header>
                    <form id="edit_migration<?php echo $row["migration_id"]; ?>" role="form" method="POST"
                        action="update_migration.php">
                        <div class="card-body">
                            <?php
                                                                $m_id = $row['migration_id'];
                                                                $sql_reg = "SELECT * FROM `tbl_migration_form` WHERE `migration_id` = '$m_id'";
                                                                $query_reg = mysqli_query($con, $sql_reg);
                                                                $row_reg = $query_reg->fetch_assoc();
                                                                ?>

                            <input type="hidden" name="edit_migration_id" value="<?= $row['migration_id']; ?>">

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Student Name</label>
                                        <input type="text" name="edit_candidate_name" class="form-control"
                                            value="<?= $row_reg["candidate_name"]; ?>">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>S/o / D/o / W/o</label>
                                        <input type="text" name="edit_father_name" class="form-control"
                                            value="<?= $row_reg["father_name"]; ?>">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>DOB</label>
                                        <input type="text" name="edit_dob" class="form-control"
                                            value="<?= $row_reg["dob"]; ?>">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="edit_email_id" class="form-control"
                                            value="<?= $row_reg["email_id"]; ?>">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Semester</label>
                                        <input type="text" name="edit_semester" class="form-control"
                                            value="<?= $row_reg["semester"]; ?>">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Pass or Fail</label>
                                        <input type="text" name="edit_passfail" class="form-control"
                                            value="<?= $row_reg["passfail"]; ?>">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Passing Year</label>
                                        <input type="text" name="edit_name_of_the_exam" class="form-control"
                                            value="<?= $row_reg["name_of_the_exam"]; ?>">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Course</label>
                                        <select name="edit_course_name" class="form-control" required>
                                            <?php
                                                                                if ($course_id != '') {
                                                                                    $sql_course = "SELECT * FROM `tbl_course` WHERE `course_id` = '" . $row['course_id'] . "'";
                                                                                    $query_course = mysqli_query($con, $sql_course);
                                                                                    $row_course = $query_course->fetch_assoc();
                                                                                ?>
                                            <option value="<?php echo $row_course['course_id']; ?>">
                                                <?php echo $row_course['course_name']; ?></option>
                                            <?php } else { ?>
                                            <option value="">-Select-</option>
                                            <?php } ?>

                                            <?php
                                                                                $sql_course = "SELECT * FROM tbl_course";
                                                                                $query_course = mysqli_query($con, $sql_course);
                                                                                while ($row_course = mysqli_fetch_array($query_course)) {
                                                                                ?>
                                            <option value="<?php echo $row_course['course_id']; ?>">
                                                <?php echo $row_course['course_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Registration No.</label>
                                        <input type="text" name="edit_registration_no" class="form-control"
                                            value="<?= $row_reg["registration_no"]; ?>">
                                    </div>
                                </div>
                            </div>

                            <input type='hidden' name='edit_course_id' value='<?php echo $row["course_id"]; ?>'>
                            <input type='hidden' name='action' value='edit_migrations'>

                            <button type="submit" class="btn btn-primary mb-3">Update</button>
                        </div>
                    </form>
                </div>
            </div>

            <?php
                                                        $s_no++;
                                                }
                                            } else {
                                                echo '<tr><td colspan="13" class="text-center">No data available now!!!</td></tr>';
                                            }
                                            ?>
        </tr>
    </tbody>
</table>

<script>
$(document).ready(function() {
    // Initialize the DataTable
    var table = $('#migrationFormTable').DataTable({
        scrollX: true,
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
    });

    // Handle status button click
    $('#migrationFormTable').on('click', '.status-btn', function() {
        var button = $(this);
        var admission_id = button.data('id');
        $.ajax({
            url: 'update_status.php', // The URL of the PHP script that will update the status
            type: 'POST',
            data: {
                admission_id: admission_id
            },
            dataType: 'json',
            success: function(response) {
                if (response.new_status) {
                    // Update the button text based on the new status
                    button.text(response.new_status);

                    // Update the cell content in the DataTable
                    var row = table.row(button.parents(
                        'tr'));
                    var cellIndex = table.cell(button
                            .parents('td')).index()
                        .column; // Get cell index
                    table.cell(row, cellIndex).data(
                        response.new_status).draw(
                        false);
                } else {
                    alert(response.error);
                }
            }
        });
    });

    $('#migrationFormTable').on('click', '.status-btn-lib', function() {
        var button = $(this);
        var admission_id = button.data('id');
        $.ajax({
            url: 'update_status2.php', // The URL of the PHP script that will update the status
            type: 'POST',
            data: {
                admission_id: admission_id
            },
            dataType: 'json',
            success: function(response) {
                if (response.new_status) {
                    // Update the button text based on the new status
                    button.text(response.new_status);

                    // Update the cell content in the DataTable
                    var row = table.row(button.parents(
                        'tr'));
                    var cellIndex = table.cell(button
                            .parents('td')).index()
                        .column; // Get cell index
                    table.cell(row, cellIndex).data(
                        response.new_status).draw(
                        false);
                } else {
                    alert(response.error);
                }
            }
        });
    });

    $('#migrationFormTable').on('click', '.status-btn-admin', function() {
        var button = $(this);
        var admission_id = button.data('id');
        $.ajax({
            url: 'update_status3.php', // The URL of the PHP script that will update the status
            type: 'POST',
            data: {
                admission_id: admission_id
            },
            dataType: 'json',
            success: function(response) {
                if (response.new_status) {
                    // Update the button text based on the new status
                    button.text(response.new_status);

                    // Update the cell content in the DataTable
                    var row = table.row(button.parents(
                        'tr'));
                    var cellIndex = table.cell(button
                            .parents('td')).index()
                        .column; // Get cell index
                    table.cell(row, cellIndex).data(
                        response.new_status).draw(
                        false);
                } else {
                    alert(response.error);
                }
            }
        });
    });

    $('#migrationFormTable').on('click', '.status-btn-finance', function() {
        var button = $(this);
        var admission_id = button.data('id');
        $.ajax({
            url: 'update_status4.php', // The URL of the PHP script that will update the status
            type: 'POST',
            data: {
                admission_id: admission_id
            },
            dataType: 'json',
            success: function(response) {
                if (response.new_status) {
                    // Update the button text based on the new status
                    button.text(response.new_status);

                    // Update the cell content in the DataTable
                    var row = table.row(button.parents(
                        'tr'));
                    var cellIndex = table.cell(button
                            .parents('td')).index()
                        .column; // Get cell index
                    table.cell(row, cellIndex).data(
                        response.new_status).draw(
                        false);
                } else {
                    alert(response.error);
                }
            }
        });
    });
    $('#migrationFormTable').on('click', '.status-btn-deptlab', function() {
        var button = $(this);
        var admission_id = button.data('id');
        $.ajax({
            url: 'update_status5.php', // The URL of the PHP script that will update the status
            type: 'POST',
            data: {
                admission_id: admission_id
            },
            dataType: 'json',
            success: function(response) {
                if (response.new_status) {
                    // Update the button text based on the new status
                    button.text(response.new_status);

                    // Update the cell content in the DataTable
                    var row = table.row(button.parents(
                        'tr'));
                    var cellIndex = table.cell(button
                            .parents('td')).index()
                        .column; // Get cell index
                    table.cell(row, cellIndex).data(
                        response.new_status).draw(
                        false);
                } else {
                    alert(response.error);
                }
            }
        });
    });
    $('#migrationFormTable').on('click', '.status-btn-it', function() {
        var button = $(this);
        var admission_id = button.data('id');
        $.ajax({
            url: 'update_status6.php', // The URL of the PHP script that will update the status
            type: 'POST',
            data: {
                admission_id: admission_id
            },
            dataType: 'json',
            success: function(response) {
                if (response.new_status) {
                    // Update the button text based on the new status
                    button.text(response.new_status);

                    // Update the cell content in the DataTable
                    var row = table.row(button.parents(
                        'tr'));
                    var cellIndex = table.cell(button
                            .parents('td')).index()
                        .column; // Get cell index
                    table.cell(row, cellIndex).data(
                        response.new_status).draw(
                        false);
                } else {
                    alert(response.error);
                }
            }
        });
    });
});
</script>

<?php
        } else
        echo "0";
    } 
    //end migration form


    //Fetching student list for create marksheet Start
    if ($_GET["action"] == "fetch_student") {
        $course_id = $_POST["course_id"];
        $academic_year = $_POST["academic_year"];
        $semester_id = $_POST["semester_id"];
        if ($academic_year != 0) {
            ?>
<div class="card-header card-warning">
    <form method="POST" action="print_all_report">
        <input type="hidden" name="course_id" value="<?php echo $course_id; ?>" />
        <input type="hidden" name="academic_year" value="<?php echo $academic_year; ?>" />
        <input type="hidden" name="semester_id" value="<?php echo $semester_id; ?>" />
        <button type="submit" class="btn btn-lg btn-warning pull-right float-right">Print All</button>
    </form>
</div>
<table id="dtHorizontalExample" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="10%">S.No</th>
            <th width="10%">Reg. No</th>
            <th width="10%">Student Name</th>
            <th width="10%">Course</th>
            <th width="10%">Semester</th>
            <th width="10%">Marks</th>
            <th width="10%">Result</th>
            <th width="10%">Promote</th>
            <th width="10%">Percentage(%)</th>
            <th class="project-actions text-center">Action </th>
            <th class="project-actions text-center">Action </th>
        </tr>
    </thead>
    <tbody>
        <?php
                    $sql = "SELECT * FROM `tbl_allot_semester`
                                    INNER JOIN `tbl_admission` ON `tbl_allot_semester`.`admission_id` = `tbl_admission`.`admission_id`
                                    WHERE  `tbl_allot_semester`.`status` = '$visible' && `tbl_allot_semester`.`academic_year` = '$academic_year' && `tbl_allot_semester`.`course_id` = '$course_id' && `tbl_allot_semester`.`semester_id` = '$semester_id' ORDER BY `tbl_allot_semester`.`reg_no` ASC
                                    
                                    ";
                    $result = $con->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
        <tr>
            <td>
                <?php echo $s_no; ?>
            </td>
            <?php
                                $sql_course = "SELECT * FROM `tbl_course`
                                                       WHERE `status` = '$visible' && `course_id` = '" . $row["course_id"] . "';
                                                       ";
                                $result_course = $con->query($sql_course);
                                $row_course = $result_course->fetch_assoc();
                                ?>
            <td>
                <?php echo $row["reg_no"] ?>
            </td>
            <!-- <td></td>-->
            <td>
                <?php echo $row["admission_first_name"] ?>
            </td>
            <td>
                <?php echo $row_course["course_name"]; ?>
            </td>
            <?php
                                $sql_semester = "SELECT * FROM `tbl_semester`
                                                       WHERE `status` = '$visible' && `semester_id` = '" . $row["semester_id"] . "';
                                                       ";
                                $result_semester = $con->query($sql_semester);
                                $row_semester = $result_semester->fetch_assoc();
                                ?>
            <td>
                <?php echo $row_semester["semester"]; ?>
            </td>
            <!--<td><?php //echo $row["admission_mobile_student"]; 
                                                    ?></td>  -->
            <td>
                <table>
                    <thead>
                        <tr>
                            <th width="10%">Subject Name</th>
                            <th width="10%">Full Marks</th>
                            <th width="10%">Pass Marks</th>
                            <th width="10%">Internal Marks</th>
                            <th width="10%">External Marks</th>
                            <th width="10%">Practical Marks</th>
                            <th width="10%">Total Marks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                            $sql_get = "SELECT * FROM `tbl_marks` 
                                                            INNER JOIN `tbl_subjects` ON `tbl_marks`.`subject_id` = `tbl_subjects`.`subject_id`
                                                            WHERE `tbl_marks`.`status` = '$visible' && `tbl_subjects`.`status` = '$visible' && `tbl_marks`.`semester_id` = '" . $row["semester_id"] . "' && `tbl_marks`.`course_id` = '" . $row["course_id"] . "' && `tbl_marks`.`fee_academic_year` = '" . $row["admission_session"] . "' &&  `tbl_marks`.`reg_no` = '" . $row["reg_no"] . "' 
                                                            ORDER BY `tbl_subjects`.`subject_id` ASC";
                                            $row_get = $con->query($sql_get);
                                            $sum = 0;
                                            $sum1 = 0;
                                            $sum2 = 0;
                                            $divnum = 0;
                                            $passmarks_total = 0;
                                            $full_marks = 0;
                                            while ($rows = $row_get->fetch_assoc()) {
                                                $sum += $rows["internal_marks"];
                                                $sum1 += $rows["external_marks"];
                                                $sum3 += $rows["practical_marks"];
                                                $sum2 += $rows["internal_marks"] + $rows["external_marks"];
                                                $passmarks_total = $passmarks_total + $rows["pass_marks"];
                                                $full_marks += $rows["full_marks"];
                                                ?>
                        <tr>
                            <td width="10%">
                                <?php echo $rows["subject_name"] ?>
                            </td>
                            <td width="10%">
                                <?php echo $rows["full_marks"] ?>
                            </td>
                            <td width="10%">
                                <?php echo $rows["pass_marks"] ?>
                            </td>
                            <td width="10%">
                                <?php echo $rows["internal_marks"] ?>
                            </td>
                            <td width="10%">
                                <?php echo $rows["external_marks"] ?>
                            </td>
                            <td width="10%">
                                <?php echo $rows["practical_marks"] ?>
                            </td>
                            <?php $sum_total = $rows["internal_marks"] + $rows["external_marks"]; ?>
                            <td width="10%">
                                <?php echo $sum_total; ?>
                            </td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Total</td>
                            <td>
                                <?php echo $sum; ?>
                            </td>
                            <td>
                                <?php echo $sum1; ?>
                            </td>
                            <td>
                                <?php echo $sum3; ?>
                            </td>
                            <td>
                                <?php echo $sum2; ?>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </td>
            <td>
                <?php
                                    if ($sum2 >= $passmarks_total) {
                                        $resultVar = "PASS";
                                        echo "<b style='color: #28a745!important;'>Pass</b>";
                                    } else {
                                        echo "<b style='color: #b42a16!important;'>Fail</b>";
                                        $resultVar = "FAIL";
                                    }
                                    ?>
            </td>

            <td>
                <?php if ($sum2 <= $passmarks_total) { ?>
                <form action=""><a href="tbl?id=<?php echo $row["reg_no"] ?>">Click to Promote</a>
                    <?php } ?>
            </td>

            <td>
                <?php $divnum = ($sum2) / ($full_marks) * 100;
                                    echo number_format($divnum, 2); ?> %
            </td>
            <td style="display:flex;">
                <form action="" style="display:flex;">
                    <a target="_blank" href="print_marksheet?id=<?php echo $row["allot_id"]  ?>">Generate
                        Marksheet Report</a>

                    <a style="" class='px-3' target="_blank"
                        href="consolidated_marksheet?id=<?php echo $row["allot_id"] ?>">Generate
                        Consolidated
                        Marksheet</a>
            </td>
            <td>
                <form action=""><a
                        href="marksheet_print?course=<?php echo $row["course_id"]; ?>&session=<?php echo $row["university_details_id"]; ?>&semester=<?php echo $row["semester_id"]; ?>">All
                        Report</a>

                </form>
            </td>
        </tr>
        <?php
                            $s_no++;
                        }
                    } else
                        echo '
                                <div class="alert alert-warning alert-dismissible">
                                    <i class="icon fas fa-exclamation-triangle"></i>  No data available now!!!
                                </div>';
                    ?>

    </tbody>
</table>
<script>
$(document).ready(function() {
    $('#dtHorizontalExample').DataTable({
        "scrollX": true
    });
    $('.dataTables_length').addClass('bs-select');
});
</script>
<?php
        } else
            echo "0";
    }
    //Fetching student list for create marksheet end    


    if ($_GET["action"] == "fetch_student_for_studentsite") {
        $course_id = $_POST["course_id"];
        $academic_year = $_POST["academic_year"];
        $semester_id = $_POST["semester_id"];
        $admissionid = $_POST['admission_id'];
        if ($academic_year != 0) {
            ?>

<table id="dtHorizontalExample" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="10%">Reg. No</th>
            <th width="30%">Student Name</th>
            <th width="25%">Course</th>
            <th width="15%">Semester</th>
            <th class="project-actions text-center">Action </th>
        </tr>
    </thead>
    <tbody>
        <?php
                    $sql = "SELECT * FROM `tbl_allot_semester`
                                    INNER JOIN `tbl_admission` ON `tbl_allot_semester`.`admission_id` = `tbl_admission`.`admission_id`
                                    WHERE  `tbl_allot_semester`.`status` = '$visible' && `tbl_allot_semester`.`academic_year` = '$academic_year' && `tbl_allot_semester`.`course_id` = '$course_id' && `tbl_allot_semester`.`semester_id` = '$semester_id' && `tbl_allot_semester`.`admission_id` = '$admissionid'
                                    ";
                    $result = $con->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
        <tr>
            <?php
                                $sql_course = "SELECT * FROM `tbl_course`
                                                       WHERE `status` = '$visible' && `course_id` = '" . $row["course_id"] . "';
                                                       ";
                                $result_course = $con->query($sql_course);
                                $row_course = $result_course->fetch_assoc();
                                ?>
            <td>
                <?php echo $row["reg_no"] ?>
            </td>
            <!-- <td></td>-->
            <td>
                <?php echo $row["admission_first_name"] ." ". $row["admission_last_name"] ?>
            </td>
            <td>
                <?php echo $row_course["course_name"]; ?>
            </td>
            <?php
                                $sql_semester = "SELECT * FROM `tbl_semester`
                                                       WHERE `status` = '$visible' && `semester_id` = '" . $row["semester_id"] . "';
                                                       ";
                                $result_semester = $con->query($sql_semester);
                                $row_semester = $result_semester->fetch_assoc();
                                ?>
            <td>
                <?php echo $row_semester["semester"]; ?>
            </td>
            <!--<td><?php //echo $row["admission_mobile_student"]; 
                                                    ?></td>  -->
            <td style="display:flex;">
                <form action="" style="display:flex;">
                    <a target="_blank" href="marksheet?id=<?php echo $row["allot_id"]  ?>">Generate
                        Marksheet Report</a>
            </td>
        </tr>
        <?php
                        }
                    } else
                        echo '
                                <div class="alert alert-warning alert-dismissible">
                                    <i class="icon fas fa-exclamation-triangle"></i>  No data available now!!!
                                </div>';
                    ?>

    </tbody>
</table>
<!-- <script>
$(document).ready(function() {
    $('#dtHorizontalExample').DataTable({
        "scrollX": true
    });
    $('.dataTables_length').addClass('bs-select');
});
</script> -->
<?php
        } else
            echo "0";
    }
    //Fetching student list for create marksheet end

    //Allocate semester to student Start
    if ($_GET["action"] == "fetch_student_semester") {
        $course_id = $_POST["course_id"];
        $academic_year = $_POST["academic_year"];
        if ($academic_year != 0) {
            ?>
<table id="example1" class="table table-bordered table-striped" style="overflow-x:auto;">
    <form role="form" method="POST" id="add_marks_form1">

        <thead>
            <tr>
                <th width="10%">S.No </th>
                <th width="10%">Reg. No</th>
                <th width="10%">Student Name</th>
                <th width="10%">Course</th>
                <th width="10%">Contact</th>
                <th width="10%">Session</th>
                <th class="project-actions text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                        if ($course_id == "all")
                            $sql = "SELECT * FROM `tbl_admission`
                                    WHERE `status` = '$visible' && `admission_session` = '$academic_year'
                                    ORDER BY `admission_id` ASC
                                    ";
                        else
                            $sql = "SELECT * FROM `tbl_admission`
                                    WHERE `status` = '$visible' && `admission_session` = '$academic_year' && `admission_course_name` = '$course_id'
                                    ORDER BY `admission_id` ASC
                                    ";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
            <tr>
                <td>
                    <?php echo $s_no; ?>
                </td>
                <?php
                                    $sql_course = "SELECT * FROM `tbl_course`
                                                       WHERE `status` = '$visible' && `course_id` = '" . $row["admission_course_name"] . "';
                                                       ";
                                    $result_course = $con->query($sql_course);
                                    $row_course = $result_course->fetch_assoc();
                                    ?>
                <td>
                    <?php echo $row["admission_id"] ?>
                </td>
                <td>
                    <?php echo $row["admission_first_name"] ?>
                    <?php echo $row["admission_middle_name"] ?>
                    <?php echo $row["admission_last_name"] ?>
                </td>
                <td>
                    <?php echo $row_course["course_name"]; ?>
                </td>
                <td>
                    <?php echo $row["admission_mobile_student"]; ?>
                </td>
                <?php
                                    $sql_ac_year = "SELECT * FROM `tbl_university_details`
                                                    WHERE university_details_id = '" . $row["admission_session"] . "';";
                                    $result_ac_year = $con->query($sql_ac_year);
                                    $row_ac_year = $result_ac_year->fetch_assoc(); ?>
                <td>
                    <option value="<?php echo $row_ac_year["university_details_id"]; ?>">
                        <?php echo date("d/m/Y", strtotime($row_ac_year["university_details_academic_start_date"])) . " to " . date("d/m/Y", strtotime($row_ac_year["university_details_academic_end_date"])); ?>
                    </option>
                </td>

                <td>
                    <select class="form-control" name="semester_id">
                        <?php
                                            $sql_course = "SELECT * FROM `tbl_semester`
                                                                   WHERE `course_id` = '" . $row["admission_course_name"] . "';
                                                                   ";
                                            $result_course = $con->query($sql_course);
                                            while ($row_course = $result_course->fetch_assoc()) {
                                                ?>
                        <option value="<?php echo $row_course["semester_id"]; ?>">
                            <?php echo $row_course["semester"]; ?>
                        </option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <?php
                                $s_no++;
                            }
                        } else
                            echo '
                                <div class="alert alert-warning alert-dismissible">
                                    <i class="icon fas fa-exclamation-triangle"></i>  No data available now!!!
                                </div>';
                        ?>
            <tr>
                <td height="40" colspan="8" valign="middle" align="center" class="narmal">
                    <input type='hidden' name='action' value='add_sem' />
                    <div class="col-md-12" id="loader_section"></div>
                    <button type="button" id="add_marks_button1" class="btn btn-primary">Add</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                </td>
            </tr>
        </tbody>

        <div class="col-12" id="error_section"></div>
    </form>
</table>
<?php
        } else
            echo "0";
        ?>
<script>
$(function() {

    $('#add_marks_button1').click(function() {
        $('#loader_section').append(
            '<center id = "loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /></center>'
        );
        $('#add_marks_button1').prop('disabled', true);
        $.ajax({
            url: 'include/controller.php',
            type: 'POST',
            data: $('#add_marks_form1').serializeArray(),
            success: function(result) {
                $('#response').remove();
                if (result == "courseempty")
                    $('#error_section').append(
                        '<div id = "response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Please First Add Courses!!!</div></div>'
                    );
                if (result == "empty")
                    $('#error_section').append(
                        '<div id = "response"><div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-exclamation-triangle"></i>  Please fill out all required fields!!!</div></div>'
                    );
                if (result == "error")
                    $('#error_section').append(
                        '<div id = "response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                    );
                if (result == "success") {
                    $('#add_marks_form1')[0].reset();
                    $('#error_section').append(
                        '<div id = "response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Fees added successfully!!!</div></div>'
                    );
                }
                if (result == "update") {
                    $('#add_marks_form1')[0].reset();
                    $('#error_section').append(
                        '<div id = "response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Fees updated successfully!!!</div></div>'
                    );
                }
                console.log(result);
                $('#loading').fadeOut(500, function() {
                    $(this).remove();
                });
                $('#add_marks_button1').prop('disabled', false);
            }

        });
    });

});
</script>
<?php }
    //Allocate semester to student list end
    //Fetching student list for create complete marksheet Start
    include "view/fetch_student_allreport.php";
    include "view/fetch_provisional.php";
    include "view/fetch_migration.php";  
    //Fetching student list for create complete marksheet end
    //Student Start
    if ($_GET["action"] == "get_student") {
        $course_id = $_POST["course_id"];
        //$academic_year = $_POST["academic_year"];
        $semester_id = $_POST["semester_id"];

        ?>
<form method="POST" action="delete_importstudent">
    <div style="margin-bottom: 20px;">
        <input type="submit" name="deleteAll" class="btn btn-lg btn-warning" style="font-size: 15px;"
            value="Delete All">
    </div>
    <table id="dtHorizontalExample" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-center">
                    <input type="checkbox" id="selectall" />
                </th>
                <th>S.No</th>
                <th>Admission Reg No</th>
                <th>Name</th>
                <th>Course</th>
                <th>Semester</th>
                <th>Marksheet Serial No</th>
                <th>Marksheet Reg No</th>
                <th>Marksheet Roll No</th>
                <th>Examination Type</th>
                <!--<th class="project-actions text-center">Action </th>-->
            </tr>
        </thead>
        <tbody>
            <?php
                    $sql = "SELECT * FROM `tbl_admission_details` WHERE `status` = '$visible' 
                                && `course_id` = '$course_id' && `semester_id` = '$semester_id'
                                ORDER BY `admission_id` ASC
                                ";

                    $result = $con->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
            <tr>
                <td class="text-center">
                    <input type="checkbox" class="name" name="chkl[]" value="<?= $row["admission_details_id"] ?>" />
                </td>
                <td>
                    <?php echo $s_no; ?>
                </td>
                <td>
                    <?php echo $row["admission_id"]; ?>
                </td>
                <td>
                    <?php echo $row["student_name"]; ?>
                </td>
                <?php
                                $sql_course = "SELECT * FROM `tbl_course`
                                                       WHERE `status` = '$visible' && `course_id` = '" . $row["course_id"] . "';
                                                       ";
                                $result_course = $con->query($sql_course);
                                $row_course = $result_course->fetch_assoc();
                                ?>
                <td>
                    <?php echo $row_course["course_name"]; ?>
                </td>
                <?php
                                $sql_sem = "SELECT * FROM `tbl_semester`
                                                       WHERE `status` = '$visible' && `semester_id` = '" . $row["semester_id"] . "';
                                                       ";
                                $result_sem = $con->query($sql_sem);
                                $row_sem = $result_sem->fetch_assoc();
                                ?>
                <td>
                    <?php echo $row_sem["semester"] ?>
                </td>
                <td>
                    <?php echo $row["serial_no"]; ?>
                </td>
                <td>
                    <?php echo $row["reg_no"]; ?>
                </td>
                <td>
                    <?php echo $row["roll_no"]; ?>
                </td>

                <td>
                    <?php echo $row["type"] ?>
                </td>
                <!--<td class="project-actions text-center">
                <button class="btn btn-info btn-sm" onclick="document.getElementById('edit_get_student<?php echo $row["admission_details_id"]; ?>').style.display='block'">
                    <i class="fas fa-pencil-alt">
                    </i>
                    
                </button>
               <button class="btn btn-danger btn-sm" onclick="document.getElementById('delete_get_student<?php echo $row["admission_details_id"]; ?>').style.display='block'">
                    <i class="fas fa-trash">
                    </i>
                    
                </button>
            </td>-->

                <!-- Student Edit Section Start -->
                <div id="edit_get_student<?php echo $row["admission_details_id"]; ?>" class="w3-modal"
                    style="z-index:2020;">
                    <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
                        <header class="w3-container" style="background:#343a40; color:white;">
                            <span
                                onclick="document.getElementById('edit_get_student<?php echo $row["admission_details_id"]; ?>').style.display='none'"
                                class="w3-button w3-display-topright">&times;</span>
                            <h2 align="center">Edit Student</h2>
                        </header>
                        <form id="edit_get_student_form<?php echo $row["admission_details_id"]; ?>" role="form"
                            method="POST">
                            <div class="card-body">
                                <div class="col-md-12"
                                    id="edit_error_section<?php echo $row["admission_details_id"]; ?>"></div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>CMS Reg No</label>
                                        <input type="text" name="admission_id"
                                            id="admission_id<?php echo $row["admission_details_id"]; ?>"
                                            class="form-control" value="<?php echo $row["admission_id"]; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Serial No</label>
                                        <input type="text" name="serial_no"
                                            id="serial_no<?php echo $row["admission_details_id"]; ?>"
                                            class="form-control" value="<?php echo $row["serial_no"]; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Course Name</label>
                                        <select name="course_id"
                                            id="course_id<?php echo $row["admission_details_id"]; ?>"
                                            class="form-control select2" style="width: 100%;">
                                            <?php
                                                            $sql_course = "SELECT * FROM `tbl_course`
                                                                               WHERE `status` = '$visible'
                                                                               ";
                                                            $result_course = $con->query($sql_course);
                                                            while ($row_course = $result_course->fetch_assoc()) {
                                                                ?>
                                            <option value="<?php echo $row_course["course_id"]; ?>" <?php if ($row_course["course_id"] == $row["course_id"])
                                                                       echo 'selected'; ?>>
                                                <?php echo $row_course["course_name"]; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Semester</label>
                                        <?php
                                                        $sql_sem = "SELECT * FROM `tbl_semester`
                                                                               WHERE `status` = '$visible' && `semester_id` = '" . $row["semester_id"] . "';
                                                                               ";
                                                        $result_sem = $con->query($sql_sem);
                                                        $row_sem = $result_sem->fetch_assoc();
                                                        ?>
                                        <input type="hidden" name="semester_id"
                                            id="semester_id<?php echo $row["admission_details_id"]; ?>"
                                            class="form-control" value="<?php echo $row["semester_id"]; ?>">
                                        <input type="text" name="semester_id" class="form-control"
                                            value="<?php echo $row_sem["semester"]; ?>">

                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Reg No</label>
                                        <input type="text" name="reg_no"
                                            id="reg_no<?php echo $row["admission_details_id"]; ?>" class="form-control"
                                            value="<?php echo $row["reg_no"]; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Roll No</label>
                                        <input type="text" name="roll_no"
                                            id="roll_no<?php echo $row["admission_details_id"]; ?>" class="form-control"
                                            value="<?php echo $row["roll_no"]; ?>">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Type</label>
                                        <input type="text" name="type"
                                            id="type<?php echo $row["admission_details_id"]; ?>" class="form-control"
                                            value="<?php echo $row["type"]; ?>">
                                    </div>

                                </div>
                                <input type='hidden' name='admission_details_id'
                                    id="admission_details_id<?php echo $row["admission_details_id"]; ?>"
                                    value='<?php echo $row["admission_details_id"]; ?>' />
                                <input type='hidden' name='action'
                                    id="action<?php echo $row["admission_details_id"]; ?>" value='edit_get_student' />
                                <div class="col-md-12"
                                    id="edit_loader_section<?php echo $row["admission_details_id"]; ?>"></div>
                                <button type="button"
                                    id="edit_student_button<?php echo $row["admission_details_id"]; ?>"
                                    class="btn btn-primary">Update</button>
                            </div>
                        </form>
                        <script>
                        $(function() {

                            $('#edit_student_button<?php echo $row["admission_details_id"]; ?>').click(
                                function() {
                                    $('#edit_loader_section<?php echo $row["admission_details_id"]; ?>')
                                        .append(
                                            '<center id = "edit_loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /></center>'
                                        );
                                    $('#edit_student_button<?php echo $row["admission_details_id"]; ?>')
                                        .prop('disabled', true);
                                    var action = $("#action<?php echo $row["admission_details_id"]; ?>")
                                        .val();
                                    var admission_details_id = $(
                                        "#admission_details_id<?php echo $row["admission_details_id"]; ?>"
                                    ).val();
                                    var admission_id = $(
                                            "#admission_id<?php echo $row["admission_details_id"]; ?>")
                                        .val();
                                    var serial_no = $(
                                        "#serial_no<?php echo $row["admission_details_id"]; ?>").val();
                                    var course_id = $(
                                        "#course_id<?php echo $row["admission_details_id"]; ?>").val();
                                    var semester_id = $(
                                        "#semester_id<?php echo $row["admission_details_id"]; ?>").val();
                                    var reg_no = $("#reg_no<?php echo $row["admission_details_id"]; ?>")
                                        .val();
                                    var roll_no = $("#roll_no<?php echo $row["admission_details_id"]; ?>")
                                        .val();
                                    var type = $("#type<?php echo $row["admission_details_id"]; ?>").val();
                                    var dataString = 'action=' + action + '&admission_details_id=' +
                                        admission_details_id + '&admission_id=' + admission_id +
                                        '&serial_no=' + serial_no + '&course_id=' + course_id +
                                        '&semester_id=' + semester_id + '&reg_no=' + reg_no + '&roll_no=' +
                                        roll_no + '&type=' + type;

                                    $.ajax({
                                        url: 'include/controller.php',
                                        type: 'POST',
                                        data: dataString,
                                        success: function(result) {
                                            $('#edit_response').remove();
                                            if (result == "exsits") {
                                                $('#edit_error_section<?php echo $row["admission_details_id"]; ?>')
                                                    .append(
                                                        '<div id = "edit_response"><div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-exclamation-triangle"></i> This Subject Code already exsits!!!</div></div>'
                                                    );
                                            }
                                            if (result == "error") {
                                                $('#edit_error_section<?php echo $row["admission_details_id"]; ?>')
                                                    .append(
                                                        '<div id = "edit_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                                    );
                                            }
                                            if (result == "empty") {
                                                $('#edit_error_section<?php echo $row["admission_details_id"]; ?>')
                                                    .append(
                                                        '<div id = "edit_response"><div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-exclamation-triangle"></i>  Please fill out All Required fields!!!</div></div>'
                                                    );
                                            }
                                            if (result == "success") {
                                                $('#edit_error_section<?php echo $row["admission_details_id"]; ?>')
                                                    .append(
                                                        '<div id = "edit_response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i>  Updated successfully!!!</div></div>'
                                                    );
                                                showUpdatedData();

                                                function showUpdatedData() {
                                                    $.ajax({
                                                        url: 'include/view.php?action=get_student',
                                                        type: 'GET',
                                                        success: function(result) {
                                                            $("#data_table").html(
                                                                result);
                                                        }
                                                    });
                                                }
                                            }
                                            $('#edit_loading').fadeOut(500, function() {
                                                $(this).remove();
                                            });
                                            $('#edit_student_button<?php echo $row["admission_details_id"]; ?>')
                                                .prop('disabled', false);
                                        }

                                    });
                                });

                        });
                        </script>
                    </div>
                </div>
                <!-- Student Edit Section End -->

                <!-- Student delete Section Start -->
                <div id="delete_get_student<?php echo $row["admission_details_id"]; ?>" class="w3-modal"
                    style="z-index:2020;">
                    <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
                        <header class="w3-container" style="background:#343a40; color:white;">
                            <span
                                onclick="document.getElementById('delete_get_student<?php echo $row["admission_details_id"]; ?>').style.display='none'"
                                class="w3-button w3-display-topright">&times;</span>
                            <h2 align="center">Are you sure???</h2>
                        </header>
                        <form id="delete_student_form<?php echo $row["admission_details_id"]; ?>" role="form"
                            method="POST">
                            <div class="card-body">
                                <div class="col-md-12"
                                    id="delete_error_section<?php echo $row["admission_details_id"]; ?>"></div>
                                <div class="col-md-12" align="center">
                                    <input type='hidden' name='admission_details_id'
                                        id="admission_details_id<?php echo $row["admission_details_id"]; ?>"
                                        value='<?php echo $row["admission_details_id"]; ?>' />
                                    <input type='hidden' name='action'
                                        id="action_delete<?php echo $row["admission_details_id"]; ?>"
                                        value='delete_get_student' />
                                    <div class="col-md-12"
                                        id="delete_loader_section<?php echo $row["admission_details_id"]; ?>"></div>
                                    <button type="button"
                                        id="delete_student_button<?php echo $row["admission_details_id"]; ?>"
                                        class="btn btn-danger">Move To Trash</button>
                                    <button type="button"
                                        onclick="document.getElementById('delete_get_student<?php echo $row["admission_details_id"]; ?>').style.display='none'"
                                        class="btn btn-primary">Cancel</button>
                                </div>

                            </div>
                        </form>
                        <script>
                        $(function() {

                            $('#delete_student_button<?php echo $row["admission_details_id"]; ?>').click(
                                function() {
                                    $('#delete_loader_section<?php echo $row["admission_details_id"]; ?>')
                                        .append(
                                            '<center id = "delete_loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /><br/><br/></center>'
                                        );
                                    $('#delete_student_button<?php echo $row["admission_details_id"]; ?>')
                                        .prop('disabled', true);
                                    var action = $(
                                            "#action_delete<?php echo $row["admission_details_id"]; ?>")
                                        .val();
                                    var admission_details_id = $(
                                        "#admission_details_id<?php echo $row["admission_details_id"]; ?>"
                                    ).val();
                                    var dataString = 'action=' + action + '&admission_details_id=' +
                                        admission_details_id;

                                    $.ajax({
                                        url: 'include/controller.php',
                                        type: 'POST',
                                        data: dataString,
                                        success: function(result) {
                                            $('#delete_response').remove();
                                            if (result == "error") {
                                                $('#delete_error_section<?php echo $row["admission_details_id"]; ?>')
                                                    .append(
                                                        '<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                                    );
                                            }
                                            if (result == "empty") {
                                                $('#delete_error_section<?php echo $row["admission_details_id"]; ?>')
                                                    .append(
                                                        '<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                                    );
                                            }
                                            if (result == "success") {
                                                $('#delete_error_section<?php echo $row["admission_details_id"]; ?>')
                                                    .append(
                                                        '<div id = "delete_response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Student Delete successfully!!!</div></div>'
                                                    );
                                                showDeletedData();

                                                function showDeletedData() {
                                                    $.ajax({
                                                        url: 'include/view.php?action=get_student',
                                                        type: 'GET',
                                                        success: function(result) {
                                                            $("#data_table").html(
                                                                result);
                                                        }
                                                    });
                                                }
                                            }
                                            $('#delete_loading').fadeOut(500, function() {
                                                $(this).remove();
                                            });
                                            $('#delete_student_button<?php echo $row["admission_details_id"]; ?>')
                                                .prop('disabled', false);
                                        }

                                    });
                                });

                        });
                        </script>
                    </div>
                </div>
                <!-- Student delete Section End -->
            </tr>
            <?php
                            $s_no++;
                        }
                    } else
                        echo '
                                <div class="alert alert-warning alert-dismissible">
                                    <i class="icon fas fa-exclamation-triangle"></i>  No data available now!!!
                                </div>';
                    ?>
        </tbody>
    </table>
</form>
<script>
$(document).ready(function() {
    $('#dtHorizontalExample').DataTable({
        "scrollX": true
    });
    $('.dataTables_length').addClass('bs-select');
});
</script>
<SCRIPT language="javascript">
$(function() {
    // add multiple select / deselect functionality
    $("#selectall").click(function() {
        $('.name').attr('checked', this.checked);
    });
    // if all checkbox are selected, then check the select all checkbox
    // and viceversa
    $(".name").click(function() {
        if ($(".name").length == $(".name:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }
    });
});
</SCRIPT>
<?php
    }
    //Student End               
    //Get Semester Start
    include "view/get_semester.php";
    include "view/get_backlog.php";
    include "view/get_migration.php";
    include "view/get_registration.php";
    include "view/placement_comp_list.php";
    //Get Semester End  
    //Get Sub Start
    if ($_GET["action"] == "get_sub") {
        $course_id = $_POST["course_id"];
        $semester_id = $_POST["semester_id"];
        $academic_year = $_POST["academic_year"];
        $subject_id = $_POST["subject_id"];
        ?>
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Course</th>
            <th>Session</th>
            <th>Semester</th>
            <th>Subject Name</th>
            <th>Subject Code</th>
            <th>Date Of Examination</th>
            <th>Full Marks</th>
            <th>Pass Marks</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
                $sql = "SELECT * FROM `tbl_subjects` WHERE `status` = '$visible' 
                        && course_id = '$course_id' && semester_id = '$semester_id' 
                        && fee_academic_year = '$academic_year' ORDER BY `subject_id` ASC";
                // echo $sql;exit();
                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
        <tr>
            <td>
                <?php echo $s_no; ?>
            </td>
            <?php
                            $sql_course = "SELECT * FROM `tbl_course`
                                                       WHERE `status` = '$visible' && `course_id` = '" . $row["course_id"] . "';
                                                       ";
                            $result_course = $con->query($sql_course);
                            $row_course = $result_course->fetch_assoc();
                            ?>
            <td>
                <?php echo $row_course["course_name"]; ?>
            </td>
            <?php
                            $sql_ac_year = "SELECT * FROM `tbl_university_details`
                                                   WHERE `status` = '$visible' && `university_details_id` = '" . $row["fee_academic_year"] . "';
                                                   ";
                            $result_ac_year = $con->query($sql_ac_year);
                            $row_ac_year = $result_ac_year->fetch_assoc();
                            ?>
            <?php
                            $completeSessionStart = explode("-", $row_ac_year["university_details_academic_start_date"]);
                            $completeSessionEnd = explode("-", $row_ac_year["university_details_academic_end_date"]);
                            $completeSessionOnlyYear = $completeSessionStart[0] . "-" . $completeSessionEnd[0];
                            ?>
            <td>
                <?php echo $completeSessionOnlyYear; ?>
            </td>

            <?php
                            $sql_sem = "SELECT * FROM `tbl_semester`
                                                       WHERE `status` = '$visible' && `semester_id` = '" . $row["semester_id"] . "';
                                                       ";
                            $result_sem = $con->query($sql_sem);
                            $row_sem = $result_sem->fetch_assoc();
                            ?>
            <td>
                <?php echo $row_sem["semester"] ?>
            </td>

            <td>
                <?php echo $row["subject_name"]; ?>
            </td>
            <td>
                <?php echo $row["subject_code"]; ?>
            </td>
            <td>
                <?php echo $row["date_of_examination"] ?>
            </td>
            <td>
                <?php echo $row["full_marks"] ?>
            </td>
            <td>
                <?php echo $row["pass_marks"] ?>
            </td>
            <td class="project-actions text-center">
                <button class="btn btn-info btn-sm"
                    onclick="document.getElementById('edit_subject_list<?php echo $row["subject_id"]; ?>').style.display='block'">
                    <i class="fas fa-pencil-alt">
                    </i>
                </button>
                <button class="btn btn-danger btn-sm"
                    onclick="document.getElementById('delete_get_subject<?php echo $row["subject_id"]; ?>').style.display='block'">
                    <i class="fas fa-trash">
                    </i>
                </button>
            </td>
            <!-- subject list Edit Section Start -->
            <div id="edit_subject_list<?php echo $row["subject_id"]; ?>" class="w3-modal" style="z-index:2020;">
                <div class="w3-modal-content w3-animate-top w3-card-4" style="width:55%">
                    <header class="w3-container" style="background:#343a40; color:white;">
                        <span
                            onclick="document.getElementById('edit_subject_list<?php echo $row["subject_id"]; ?>').style.display='none'"
                            class="w3-button w3-display-topright">&times;</span>
                        <h2 align="center">Edit Subject</h2>
                    </header>
                    <form id="edit_subject_list_form<?php echo $row["subject_id"]; ?>" role="form" method="POST">
                        <div class="card-body">
                            <div class="col-md-12" id="edit_error_section<?php echo $row["subject_id"]; ?>"></div>
                            <div class="row">

                                <div class="col-4">
                                    <label>Course</label>
                                    <select name="course_id" id="course_id<?php echo $row["subject_id"]; ?>"
                                        class="form-control select2" style="width: 100%;">
                                        <?php
                                                        $sql_course = "SELECT * FROM `tbl_course`
                                                                                                       WHERE `status` = '$visible'
                                                                                                       ";
                                                        $result_course = $con->query($sql_course);
                                                        while ($row_course = $result_course->fetch_assoc()) {
                                                            ?>
                                        <option value="<?php echo $row_course["course_id"]; ?>" <?php if ($row_course["course_id"] == $row["course_id"])
                                                                   echo 'selected'; ?>>
                                            <?php echo $row_course["course_name"]; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label>Semester</label>
                                    <select name="semester_id" id="semester_id<?php echo $row["subject_id"]; ?>"
                                        class="form-control select2" style="width: 100%;">
                                        <?php
                                                        $sql_semester = "SELECT * FROM `tbl_semester`
                                                                                                       WHERE `status` = '$visible'
                                                                                                       ";
                                                        $result_semester = $con->query($sql_semester);
                                                        while ($row_semester = $result_semester->fetch_assoc()) {
                                                            ?>
                                        <option value="<?php echo $row_semester["semester_id"]; ?>" <?php if ($row_semester["semester_id"] == $row["semester_id"])
                                                                   echo 'selected'; ?>>
                                            <?php echo $row_semester["semester"]; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label>Academic Year</label>
                                    <select name="fee_academic_year"
                                        id="fee_academic_year<?php echo $row["subject_id"]; ?>"
                                        class="form-control select2" style="width: 100%;">
                                        <?php
                                                        $sql_ac_year = "SELECT * FROM `tbl_university_details`
                                                                                                       WHERE `status` = '$visible';
                                                                                                       ";
                                                        $result_ac_year = $con->query($sql_ac_year);
                                                        while ($row_ac_year = $result_ac_year->fetch_assoc()) {
                                                            ?>
                                        <option value="<?php echo $row_ac_year["university_details_id"]; ?>" <?php if ($row_ac_year["university_details_id"] == $row["fee_academic_year"])
                                                                   echo 'selected'; ?>>
                                            <?php echo $row_ac_year["university_details_academic_start_date"]; ?> to
                                            <?php echo $row_ac_year["university_details_academic_end_date"]; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label>Subject Name</label>
                                    <input type="text" name="subject_name"
                                        id="subject_name<?php echo $row["subject_id"]; ?>"
                                        value="<?php echo $row["subject_name"]; ?>" class="form-control" required>
                                </div>

                                <div class="col-4">
                                    <label>Subject Code</label>
                                    <input type="text" name="subject_code"
                                        id="subject_code<?php echo $row["subject_id"]; ?>"
                                        value="<?php echo $row["subject_code"]; ?>" class="form-control" required>
                                </div>
                                <div class="col-4">
                                    <label>Date Of Examination</label>
                                    <input type="date" name="date_of_examination"
                                        id="date_of_examination<?php echo $row["subject_id"]; ?>"
                                        value="<?php echo $row["date_of_examination"]; ?>" class="form-control">
                                </div>
                                <div class="col-4">
                                    <label>Full Marks</label>
                                    <input type="text" name="full_marks"
                                        id="full_marks<?php echo $row["subject_id"]; ?>"
                                        value="<?php echo $row["full_marks"]; ?>" class="form-control">
                                </div>
                                <div class="col-4">
                                    <label>Pass Marks</label>
                                    <input type="text" name="pass_marks"
                                        id="pass_marks<?php echo $row["subject_id"]; ?>"
                                        value="<?php echo $row["pass_marks"]; ?>" class="form-control">
                                </div>

                            </div><br>
                            <input type='hidden' name='edit_id' id="edit_id<?php echo $row["subject_id"]; ?>"
                                value='<?php echo $row["subject_id"]; ?>' />
                            <input type='hidden' name='action' id="action<?php echo $row["subject_id"]; ?>"
                                value='edit_subject_list' />
                            <div class="col-md-12" id="edit_loader_section<?php echo $row["subject_id"]; ?>"></div>
                            <button type="button" id="edit_subject_list_button<?php echo $row["subject_id"]; ?>"
                                class="btn btn-primary">Update</button>
                            <!--<button type="reset" class="btn btn-danger">Reset</button>-->
                        </div>
                    </form>
                    <script>
                    $(function() {

                        $('#edit_subject_list_button<?php echo $row["subject_id"]; ?>').click(function() {
                            $('#edit_loader_section<?php echo $row["subject_id"]; ?>').append(
                                '<center id = "edit_loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /></center>'
                            );
                            $('#edit_subject_list_button<?php echo $row["subject_id"]; ?>').prop(
                                'disabled', true);
                            var action = $("#action<?php echo $row["subject_id"]; ?>").val();
                            var edit_id = $("#edit_id<?php echo $row["subject_id"]; ?>").val();
                            var course_id = $("#course_id<?php echo $row["subject_id"]; ?>").val();
                            var semester_id = $("#semester_id<?php echo $row["subject_id"]; ?>").val();
                            var fee_academic_year = $(
                                "#fee_academic_year<?php echo $row["subject_id"]; ?>").val();
                            var subject_name = $("#subject_name<?php echo $row["subject_id"]; ?>")
                                .val();
                            var subject_code = $("#subject_code<?php echo $row["subject_id"]; ?>")
                                .val();
                            var date_of_examination = $(
                                "#date_of_examination<?php echo $row["subject_id"]; ?>").val();
                            var full_marks = $("#full_marks<?php echo $row["subject_id"]; ?>").val();
                            var pass_marks = $("#pass_marks<?php echo $row["subject_id"]; ?>").val();

                            var dataString = 'action=' + action + '&edit_id=' + edit_id +
                                '&course_id=' + course_id + '&semester_id=' + semester_id +
                                '&fee_academic_year=' + fee_academic_year + '&subject_name=' +
                                subject_name + '&subject_code=' + subject_code +
                                '&date_of_examination=' + date_of_examination + '&full_marks=' +
                                full_marks + '&pass_marks=' + pass_marks;

                            $.ajax({
                                url: 'include/controller.php',
                                type: 'POST',
                                data: dataString,
                                success: function(result) {
                                    $('#edit_response').remove();
                                    if (result == "exsits") {
                                        $('#edit_error_section<?php echo $row["subject_id"]; ?>')
                                            .append(
                                                '<div id = "edit_response"><div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-exclamation-triangle"></i> This No have already exsits!!!</div></div>'
                                            );
                                    }
                                    if (result == "error") {
                                        $('#edit_error_section<?php echo $row["subject_id"]; ?>')
                                            .append(
                                                '<div id = "edit_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                            );
                                    }
                                    if (result == "empty") {
                                        $('#edit_error_section<?php echo $row["subject_id"]; ?>')
                                            .append(
                                                '<div id = "edit_response"><div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-exclamation-triangle"></i>  Please fill out Prospectus No!!!</div></div>'
                                            );
                                    }
                                    if (result == "success") {
                                        $('#edit_error_section<?php echo $row["subject_id"]; ?>')
                                            .append(
                                                '<div id = "edit_response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i>  Updated successfully!!!</div></div>'
                                            );
                                        showUpdatedData();

                                        function showUpdatedData() {
                                            $.ajax({
                                                url: 'include/view.php?action=get_sub',
                                                type: 'GET',
                                                success: function(result) {
                                                    $("#data_table").html(
                                                        result);
                                                }
                                            });
                                        }
                                    }
                                    $('#edit_loading').fadeOut(500, function() {
                                        $(this).remove();
                                    });
                                    $('#edit_subject_list_button<?php echo $row["subject_id"]; ?>')
                                        .prop('disabled', false);
                                }

                            });
                        });

                    });
                    </script>
                </div>
            </div>
            <!-- Subject list Edit Section End -->
            <!-- Subject delete Section Start -->
            <div id="delete_get_subject<?php echo $row["subject_id"]; ?>" class="w3-modal" style="z-index:2020;">
                <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
                    <header class="w3-container" style="background:#343a40; color:white;">
                        <span
                            onclick="document.getElementById('delete_get_subject<?php echo $row["subject_id"]; ?>').style.display='none'"
                            class="w3-button w3-display-topright">&times;</span>
                        <h2 align="center">Are you sure???</h2>
                    </header>
                    <form id="delete_student_form<?php echo $row["subject_id"]; ?>" role="form" method="POST">
                        <div class="card-body">
                            <div class="col-md-12" id="delete_error_section<?php echo $row["subject_id"]; ?>"></div>
                            <div class="col-md-12" align="center">
                                <input type='hidden' name='subject_id' id="subject_id<?php echo $row["subject_id"]; ?>"
                                    value='<?php echo $row["subject_id"]; ?>' />
                                <input type='hidden' name='action' id="action_delete<?php echo $row["subject_id"]; ?>"
                                    value='delete_get_subject' />
                                <div class="col-md-12" id="delete_loader_section<?php echo $row["subject_id"]; ?>">
                                </div>
                                <button type="button" id="delete_student_button<?php echo $row["subject_id"]; ?>"
                                    class="btn btn-danger">Move To Trash</button>
                                <button type="button"
                                    onclick="document.getElementById('delete_get_subject<?php echo $row["subject_id"]; ?>').style.display='none'"
                                    class="btn btn-primary">Cancel</button>
                            </div>

                            <!--<button type="reset" class="btn btn-danger">Reset</button>-->
                        </div>
                    </form>
                    <script>
                    $(function() {

                        $('#delete_student_button<?php echo $row["subject_id"]; ?>').click(function() {
                            $('#delete_loader_section<?php echo $row["subject_id"]; ?>').append(
                                '<center id = "delete_loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /><br/><br/></center>'
                            );
                            $('#delete_student_button<?php echo $row["subject_id"]; ?>').prop(
                                'disabled', true);
                            var action = $("#action_delete<?php echo $row["subject_id"]; ?>").val();
                            var subject_id = $("#subject_id<?php echo $row["subject_id"]; ?>").val();
                            var dataString = 'action=' + action + '&subject_id=' + subject_id;

                            $.ajax({
                                url: 'include/controller.php',
                                type: 'POST',
                                data: dataString,
                                success: function(result) {
                                    $('#delete_response').remove();
                                    if (result == "error") {
                                        $('#delete_error_section<?php echo $row["subject_id"]; ?>')
                                            .append(
                                                '<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                            );
                                    }
                                    if (result == "empty") {
                                        $('#delete_error_section<?php echo $row["subject_id"]; ?>')
                                            .append(
                                                '<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                            );
                                    }
                                    if (result == "success") {
                                        $('#delete_error_section<?php echo $row["subject_id"]; ?>')
                                            .append(
                                                '<div id = "delete_response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Delete successfully!!!</div></div>'
                                            );
                                        showDeletedData();

                                        function showDeletedData() {
                                            $.ajax({
                                                url: 'include/view.php?action=get_sub',
                                                type: 'GET',
                                                success: function(result) {
                                                    $("#data_table").html(
                                                        result);
                                                }
                                            });
                                        }
                                    }
                                    $('#delete_loading').fadeOut(500, function() {
                                        $(this).remove();
                                    });
                                    $('#delete_student_button<?php echo $row["subject_id"]; ?>')
                                        .prop('disabled', false);
                                }

                            });
                        });

                    });
                    </script>
                </div>
            </div>
            <!-- Subject delete Section End -->
        </tr>
        <?php
                        $s_no++;
                    }
                } else
                    echo '
                                <div class="alert alert-warning alert-dismissible">
                                    <i class="icon fas fa-exclamation-triangle"></i>  No data available now!!!
                                </div>';
                ?>
    </tbody>
</table>
<script>
$(function() {
    $("#example1").DataTable();
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
    });
});
</script>
<?php
    }
    //Get Sub End
    //Fetching student details for marksheet end
    include "view/fetch_student_details_for_marksheet.php";
    //Fetching student details for marksheet end
    //Get Exam List
    include "view/get_exam.php";
    include "view/get_migration_list.php";
    include "view/get_reg.php";
    include "view/get_registration_form.php";
    //Get Exam List
    //Fetching student list no dues details  Start
    if ($_GET["action"] == "fetch_studentlist_nodues_details") {
        $course_id = $_POST["course_id"];
        $academic_year = $_POST["academic_year"];
        ?>
<form method="POST" action="approve">
    <div style="margin-bottom: 20px;">
        <input type="submit" name="approvedAll" class="btn btn-lg btn-warning" style="font-size: 15px;"
            value="Approved Selected">
        <input type="submit" name="disapprovedAll" class="btn btn-lg btn-warning" style="font-size: 15px;"
            value="Dispproved Selected">
    </div>
    <table id="example1" class="table table-bordered table-striped" style="overflow-x:auto;">
        <thead>
            <tr>
                <th class="text-center">
                    <input type="checkbox" id="selectall" />
                </th>
                <th width="10%">S.No</th>
                <th width="10%">Reg. No</th>
                <th width="10%">Course</th>
                <th width="10%">Session</th>
                <th width="10%">Student Name</th>
                <th width="10%">Fee Status</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
                    if ($course_id == "all")
                        $sql = "SELECT * FROM `tbl_fee_status`
                                    WHERE `fee_status` = 'No Dues' AND `course_id` = '" . $course_id . "' AND `academic_year` = '" . $academic_year . "'
                                    ";
                    else
                        $sql = "SELECT * FROM `tbl_fee_status`
                                    WHERE `fee_status` = 'No Dues' AND `course_id` = '" . $course_id . "' AND `academic_year` = '" . $academic_year . "'
                                    ";
                    $result = $con->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
            <tr>
                <td class="text-center">
                    <input type="checkbox" class="name" name="chkl[]" value="<?= $row["fee_status_id"] ?>" />
                </td>
                <td>
                    <?php echo $s_no; ?>
                </td>
                <?php
                                $sql_course = "SELECT * FROM `tbl_admission`
                                                       WHERE `status` = '$visible' && `admission_id` = '" . $row["admission_id"] . "' ;
                                                       ";
                                $result_course = $con->query($sql_course);
                                $row_course = $result_course->fetch_assoc();
                                ?>
                <td>
                    <?php echo $row["admission_id"] ?>
                </td>
                <?php
                                $sql_c = "SELECT * FROM `tbl_course`
                                                       WHERE `status` = '$visible' && `course_id` = '" . $row_course["admission_course_name"] . "' ;
                                                       ";
                                $result_c = $con->query($sql_c);
                                $row_c = $result_c->fetch_assoc();
                                ?>
                <td>
                    <?php echo $row_c["course_name"] ?>
                </td>
                <?php
                                $sql_year = "SELECT * FROM `tbl_university_details`
                                                       WHERE `status` = '$visible' && `university_details_id` = '" . $row_course["admission_session"] . "' ;
                                                       ";
                                $result_year = $con->query($sql_year);
                                $row_year = $result_year->fetch_assoc();
                                ?>
                <td>
                    <?php echo $row_year["academic_session"] ?>
                </td>
                <td>
                    <?php echo $row_course["admission_first_name"] ?>
                    <?php echo $row_course["admission_middle_name"] ?>
                    <?php echo $row_course["admission_last_name"] ?>
                </td>
                <td>
                    <?php echo $row["fee_status"] ?>
                </td>
                <td> <button type="button" id="edit_exam_status_button<?php echo $row["fee_status_id"]; ?>" class="btn <?php if ($row["exam_status"] == "Approve")
                                       echo "btn-primary";
                                   else
                                       echo "btn-warning" ?> btn-sm"><span
                            id="loader_id<?php echo $row["fee_status_id"]; ?>"></span>
                        <?php if ($row["exam_status"] == "Approve")
                                            echo "Approve";
                                        else
                                            echo "Not Approve" ?>
                    </button>
                </td>
            </tr>
            <input type='hidden' name='exam_status' id="exam_status<?php echo $row["fee_status_id"]; ?>"
                value='<?php echo $row["exam_status"] ?>' />
            <script>
            $(function() {
                $('#edit_exam_status_button<?php echo $row["fee_status_id"]; ?>').click(function() {
                    $('#loader_id<?php echo $row["fee_status_id"]; ?>').append(
                        '<img id = "edit_load" width="20px" src = "images/ajax-loader.gif" alt="Currently loading" />'
                    );
                    $('#edit_exam_status_button<?php echo $row["fee_status_id"]; ?>').prop('disabled',
                        true);
                    var action = "examStatus";
                    var fee_status_id = '<?php echo $row["fee_status_id"]; ?>';
                    var exam_status = '<?php echo $row["fee_status_id"]; ?>';

                    var dataString = 'action=' + action + '&fee_status_id=' + fee_status_id +
                        '&exam_status=' + exam_status;

                    $.ajax({
                        url: 'include/controller.php',
                        type: 'POST',
                        data: dataString,
                        success: function(result) {
                            console.log(result);
                            if (result == "success")
                                showUpdatedData();

                            function showUpdatedData() {
                                $.ajax({
                                    url: 'include/view.php?action=fetch_studentlist_nodues_details',
                                    type: 'POST',
                                    data: $('#fetchFeeDataForm').serializeArray(),
                                    success: function(result) {
                                        $('#response').remove();
                                        $('#data_table').append(
                                            '<div id = "response">' +
                                            result + '</div>');
                                    }
                                });
                            }
                            $('#loader_id<?php echo $row["fee_status_id"]; ?>').fadeOut(500,
                                function() {
                                    $(this).remove();
                                    $('#edit_exam_status_button<?php echo $row["fee_status_id"]; ?>')
                                        .prop('disabled', false);
                                });

                        }

                    });

                });
            });
            </script>
            <?php
                            $s_no++;
                        }
                    } else
                        echo '
                                <div class="alert alert-warning alert-dismissible">
                                    <i class="icon fas fa-exclamation-triangle"></i>  No data available now!!!
                                </div>';
                    ?>
        </tbody>
    </table>
</form>
<script>
$(function() {
    $("#example1").DataTable();
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
    });
});
</script>
<SCRIPT language="javascript">
$(function() {

    // add multiple select / deselect functionality

    $("#selectall").click(function() {

        $('.name').attr('checked', this.checked);

    });



    // if all checkbox are selected, then check the select all checkbox

    // and viceversa

    $(".name").click(function() {



        if ($(".name").length == $(".name:checked").length) {

            $("#selectall").attr("checked", "checked");

        } else {

            $("#selectall").removeAttr("checked");

        }



    });

});
</SCRIPT>
<?php
    }
    //Fetching student list no dues details end
    //complaint Start
    if ($_GET["action"] == "get_complaint") {
        ?>
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Reg No</th>
            <th>Subject</th>
            <th>Message</th>
            <th> Date</th>
            <th class="project-actions text-center">Action </th>
        </tr>
    </thead>
    <tbody>
        <?php
                $sql = "SELECT * FROM `tbl_complaint`
                                        WHERE `status` = '$visible'
                                        ORDER BY `complaint_id` DESC
                                        ";
                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
        <tr>
            <td>
                <?php echo $s_no; ?>
            </td>
            <td>
                <?php echo $row["admission_id"]; ?>
            </td>
            <td>
                <?php echo $row["subject"]; ?>
            </td>
            <td>
                <?php echo $row["message"]; ?>
            </td>
            <td>
                <?php echo $row["create_time"]; ?>
            </td>
            <td class="project-actions text-center">
                <button class="btn btn-danger btn-sm"
                    onclick="document.getElementById('delete_complaint<?php echo $row["complaint_id"]; ?>').style.display='block'">
                    <i class="fas fa-trash">
                    </i>
                    Delete
                </button>
            </td>

            <!-- Complaint delete Section Start -->
            <div id="delete_complaint<?php echo $row["complaint_id"]; ?>" class="w3-modal" style="z-index:2020;">
                <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
                    <header class="w3-container" style="background:#343a40; color:white;">
                        <span
                            onclick="document.getElementById('delete_complaint<?php echo $row["complaint_id"]; ?>').style.display='none'"
                            class="w3-button w3-display-topright">&times;</span>
                        <h2 align="center">Are you sure???</h2>
                    </header>
                    <form id="delete_complaint_form<?php echo $row["complaint_id"]; ?>" role="form" method="POST">
                        <div class="card-body">
                            <div class="col-md-12" id="delete_error_section<?php echo $row["complaint_id"]; ?>"></div>
                            <div class="col-md-12" align="center">
                                <input type='hidden' name='delete_id' id="delete_id<?php echo $row["complaint_id"]; ?>"
                                    value='<?php echo $row["complaint_id"]; ?>' />
                                <input type='hidden' name='action' id="action_delete<?php echo $row["complaint_id"]; ?>"
                                    value='delete_complaint' />
                                <div class="col-md-12" id="delete_loader_section<?php echo $row["complaint_id"]; ?>">
                                </div>
                                <button type="button" id="delete_complaint_button<?php echo $row["complaint_id"]; ?>"
                                    class="btn btn-danger">Move To Trash</button>
                                <button type="button"
                                    onclick="document.getElementById('delete_complaint<?php echo $row["complaint_id"]; ?>').style.display='none'"
                                    class="btn btn-primary">Cancel</button>
                            </div>

                            <!--<button type="reset" class="btn btn-danger">Reset</button>-->
                        </div>
                    </form>
                    <script>
                    $(function() {

                        $('#delete_complaint_button<?php echo $row["complaint_id"]; ?>').click(function() {
                            $('#delete_loader_section<?php echo $row["complaint_id"]; ?>').append(
                                '<center id = "delete_loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /><br/><br/></center>'
                            );
                            $('#delete_complaint_button<?php echo $row["complaint_id"]; ?>').prop(
                                'disabled', true);
                            var action = $("#action_delete<?php echo $row["complaint_id"]; ?>").val();
                            var delete_id = $("#delete_id<?php echo $row["complaint_id"]; ?>").val();
                            var dataString = 'action=' + action + '&delete_id=' + delete_id;

                            $.ajax({
                                url: 'include/controller.php',
                                type: 'POST',
                                data: dataString,
                                success: function(result) {
                                    $('#delete_response').remove();
                                    if (result == "error") {
                                        $('#delete_error_section<?php echo $row["complaint_id"]; ?>')
                                            .append(
                                                '<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                            );
                                    }
                                    if (result == "empty") {
                                        $('#delete_error_section<?php echo $row["complaint_id"]; ?>')
                                            .append(
                                                '<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                            );
                                    }
                                    if (result == "success") {
                                        $('#delete_error_section<?php echo $row["complaint_id"]; ?>')
                                            .append(
                                                '<div id = "delete_response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i>Delete successfully!!!</div></div>'
                                            );
                                        showDeletedData();

                                        function showDeletedData() {
                                            $.ajax({
                                                url: 'include/view.php?action=get_complaint',
                                                type: 'GET',
                                                success: function(result) {
                                                    $("#data_table").html(
                                                        result);
                                                }
                                            });
                                        }
                                    }
                                    $('#delete_loading').fadeOut(500, function() {
                                        $(this).remove();
                                    });
                                    $('#delete_complaint_button<?php echo $row["complaint_id"]; ?>')
                                        .prop('disabled', false);
                                }

                            });
                        });

                    });
                    </script>
                </div>
            </div>
            <!-- Complaint delete Section End -->
        </tr>
        <?php
                        $s_no++;
                    }
                } else
                    echo '
                                        <div class="alert alert-warning alert-dismissible">
                                            <i class="icon fas fa-exclamation-triangle"></i>  No data available now!!!
                                        </div>';
                ?>
    </tbody>
</table>
<script>
$(function() {
    $("#example1").DataTable();
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
    });
});
</script>
<?php
    }
    //complaint End

    // Student Fee Card start
    include "view/fee_card_details.php";
    //Student Fee Card End
    //Fetching student Marks for delete all end
    include "view/fetch_student_marks.php";
    //Fetching student Marks for delete all end
    //Student admit card Start
    include './view/admit_card_approve.php';
    
    //Students admit card End
    /* ---------- All Admin(Backend) View Codes End ---------- */
    //Action Section End   
}
?>