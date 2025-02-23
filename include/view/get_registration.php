<?php
if ($_GET["action"] == "get_registration") {
    $course_id =   $_POST['course_id'];
    $academic_year = $_POST['academic_year'];
    // $id =  $_POST['id'];
?>
<table id="dtHorizontalExample" class="table table-bordered table-striped">
    <thead>
        <tr>

            <th>S.No</th>
            <th>Course</th>
            <th>Session</th>
            <th>Reg Fee</th>
            <th>Reg Fine</th>
            <th>Reg Fee Last Date</th>
            <th>Fee Status</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if(!empty($course_id) && !empty($academic_year) ){
            $sql = "SELECT * FROM `tbl_reg_semester` WHERE `status` = '$visible' &&  `course_id`='$course_id' && `fee_academic_year`='$academic_year'
                                ORDER BY `id` ASC
                                ";
            $result = $con->query($sql);
            }else{
                $sql = "SELECT * FROM `tbl_reg_semester` WHERE `status` = '$visible' ORDER BY `id` ASC
                ";
            $result = $con->query($sql);
            }
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
        <tr>
            <td><?php echo $s_no; ?></td>
            <?php
                        $sql_course = "SELECT * FROM `tbl_course`
                                                       WHERE `status` = '$visible' && `course_id` = '" . $row["course_id"] . "';
                                                       ";
                        $result_course = $con->query($sql_course);
                        $row_course = $result_course->fetch_assoc();
                        ?>
            <td><?php echo $row_course["course_name"]; ?></td>
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
            <td><?php echo $completeSessionOnlyYear; ?></td>

            <?php
                        $sql_sem = "SELECT * FROM `tbl_reg_semester`
                                                       WHERE `status` = '$visible' && `id` = '" . $row["id"] . "';
                                                       ";
                        $result_sem = $con->query($sql_sem);
                        $row_sem = $result_sem->fetch_assoc();
                        ?>
            <td><?php echo $row_sem["reg_fee"] ?></td>
            <td><?php echo $row_sem["reg_fine"] ?></td>
            <td><?php echo $row_sem["reg_fee_last_date"] ?></td>
            <td><?php echo $row_sem["regfee_status"] ?></td>
            <td><?php echo $row["examname"]; ?></td>
            <td class="project-actions text-center">
                <button class="btn btn-info btn-sm"
                    onclick="document.getElementById('edit_reg_list<?php echo $row["id"]; ?>').style.display='block'">
                    <i class="fas fa-pencil-alt">
                    </i>
                </button>
                <button class="btn btn-danger btn-sm"
                    onclick="document.getElementById('delete_get_registration<?php echo $row["id"]; ?>').style.display='block'">
                    <i class="fas fa-trash">
                    </i>
                </button>
            </td>

            <!-- Semester list Edit Section Start -->
            <div id="edit_reg_list<?php echo $row["id"]; ?>" class="w3-modal" style="z-index:2020;">
                <div class="w3-modal-content w3-animate-top w3-card-4" style="width:55%">
                    <header class="w3-container" style="background:#343a40; color:white;">
                        <span
                            onclick="document.getElementById('edit_reg_list<?php echo $row["id"]; ?>').style.display='none'"
                            class="w3-button w3-display-topright">&times;</span>
                        <h2 align="center">Edit Registration</h2>
                    </header>
                    <form id="edit_reg_list_form<?php echo $row["id"]; ?>" role="form" method="POST">
                        <div class="card-body">
                            <div class="col-md-12" id="edit_error_section<?php echo $row["id"]; ?>"></div>
                            <div class="row">

                                <div class="col-4">
                                    <label>Course</label>
                                    <select name="course_id" id="course_id<?php echo $row["id"]; ?>"
                                        class="form-control select2" style="width: 100%;">
                                        <?php
                                                    $sql_course = "SELECT * FROM `tbl_course`
                                                                                                       WHERE `status` = '$visible'
                                                                                                       ";
                                                    $result_course = $con->query($sql_course);
                                                    while ($row_course = $result_course->fetch_assoc()) {
                                                    ?>
                                        <option value="<?php echo $row_course["course_id"]; ?>"
                                            <?php if ($row_course["course_id"] == $row["course_id"]) echo 'selected'; ?>>
                                            <?php echo $row_course["course_name"]; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label>Academic Year</label>
                                    <select name="fee_academic_year" id="fee_academic_year<?php echo $row["id"]; ?>"
                                        class="form-control select2" style="width: 100%;">
                                        <?php
                                                    $sql_ac_year = "SELECT * FROM `tbl_university_details`
                                                                                                       WHERE `status` = '$visible';
                                                                                                       ";
                                                    $result_ac_year = $con->query($sql_ac_year);
                                                    while ($row_ac_year = $result_ac_year->fetch_assoc()) {
                                                    ?>
                                        <option value="<?php echo $row_ac_year["university_details_id"]; ?>"
                                            <?php if ($row_ac_year["university_details_id"] == $row["fee_academic_year"]) echo 'selected'; ?>>
                                            <?php echo $row_ac_year["university_details_academic_start_date"]; ?> to
                                            <?php echo $row_ac_year["university_details_academic_end_date"]; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label>Registration Fee</label>
                                    <input type="text" name="reg_fee" id="reg_fee<?php echo $row["id"]; ?>"
                                        value="<?php echo $row["reg_fee"]; ?>" class="form-control" required>
                                </div>

                                <div class="col-4">
                                    <label>Registration Fine</label>
                                    <input type="text" name="reg_fine" id="reg_fine<?php echo $row["id"]; ?>"
                                        value="<?php echo $row["reg_fine"]; ?>" class="form-control" required>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for=""> Registration Form Start Date </label>
                                        <input class="form-control" type="date"
                                            id="form_start_date<?php echo $row["id"]; ?>"
                                            value="<?php echo $row["form_start_date"]; ?>" name="form_start_date">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <label>Registration Fee Last Date</label>
                                    <input type="date" name="reg_fee_last_date"
                                        id="reg_fee_last_date<?php echo $row["id"]; ?>"
                                        value="<?php echo $row["reg_fee_last_date"]; ?>" class="form-control">
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for=""> Registration Form End Date </label>
                                        <input class="form-control" type="date"
                                            id="form_close_date<?php echo $row["id"]; ?>"
                                            value="<?php echo $row["form_close_date"]; ?>" name="form_close_date">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label>Fee Status</label>
                                    <select name="regfee_status" id="regfee_status<?php echo $row["id"]; ?>"
                                        class="form-control">
                                        <option value="<?php echo $row["regfee_status"]; ?>">
                                            <?php echo $row["regfee_status"]; ?></option>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label> Name</label>
                                    <input type="text" name="examname" id="examname<?php echo $row["id"]; ?>"
                                        value="<?php echo $row["examname"]; ?>" class="form-control">
                                </div>



                            </div><br>
                            <input type='hidden' name='edit_id' id="edit_id<?php echo $row["id"]; ?>"
                                value='<?php echo $row["id"]; ?>' />
                            <input type='hidden' name='action' id="action<?php echo $row["id"]; ?>"
                                value='edit_reg_list' />
                            <div class="col-md-12" id="edit_loader_section<?php echo $row["id"]; ?>"></div>
                            <button type="button" id="edit_reg_list_button<?php echo $row["id"]; ?>"
                                class="btn btn-primary">Update</button>
                            <!--<button type="reset" class="btn btn-danger">Reset</button>-->
                        </div>
                    </form>
                    <script>
                    $(function() {

                        $('#edit_reg_list_button<?php echo $row["id"]; ?>').click(function() {
                            $('#edit_loader_section<?php echo $row["id"]; ?>').append(
                                '<center id = "edit_loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /></center>'
                            );
                            $('#edit_reg_list_button<?php echo $row["id"]; ?>').prop(
                                'disabled', true);
                            var action = $("#action<?php echo $row["id"]; ?>").val();
                            var edit_id = $("#edit_id<?php echo $row["id"]; ?>").val();
                            var course_id = $("#course_id<?php echo $row["id"]; ?>").val();

                            var fee_academic_year = $(
                                "#fee_academic_year<?php echo $row["id"]; ?>").val();
                            var reg_fee = $("#reg_fee<?php echo $row["id"]; ?>").val();
                            var reg_fine = $("#reg_fine<?php echo $row["id"]; ?>").val();
                            var reg_fee_last_date = $(
                                "#reg_fee_last_date<?php echo $row["id"]; ?>").val();
                            var regfee_status = $("#regfee_status<?php echo $row["id"]; ?>")
                                .val();
                            var examname = $("#examname<?php echo $row["id"]; ?>").val();

                            var form_start_date = $(
                                "#form_start_date<?php echo $row["id"]; ?>").val();
                            var form_close_date = $(
                                "#form_close_date<?php echo $row["id"]; ?>").val();

                            var dataString = 'action=' + action + '&edit_id=' + edit_id +
                                '&course_id=' + course_id + '&fee_academic_year=' + fee_academic_year +
                                '&reg_fee=' + reg_fee + '&reg_fine=' + reg_fine +
                                '&reg_fee_last_date=' + reg_fee_last_date + '&regfee_status=' +
                                regfee_status + '&examname=' + examname + '&form_start_date=' +
                                form_start_date + '&form_close_date=' + form_close_date;

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
                                                url: 'include/view.php?action=get_registration',
                                                type: 'POST',
                                                data: $('#fetchStudentDataForm')
                                                    .serializeArray(),
                                                success: function(result) {
                                                    $('#response').remove();
                                                    if (result == 0) {
                                                        $('#error_section')
                                                            .append(
                                                                '<div id = "response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Please select Academic Year!!!</div></div>'
                                                            );
                                                    } else {
                                                        $("#data_table").html(
                                                            result);
                                                    }
                                                    $('#loading').fadeOut(500,
                                                        function() {
                                                            $(this)
                                                                .remove();
                                                        });
                                                    $('#fetchStudentDataButton')
                                                        .prop('disabled',
                                                            false);
                                                }
                                            });
                                        }
                                    }
                                    $('#edit_loading').fadeOut(500, function() {
                                        $(this).remove();
                                    });
                                    $('#edit_reg_list_button<?php echo $row["id"]; ?>')
                                        .prop('disabled', false);
                                }

                            });
                        });

                    });
                    </script>
                </div>
            </div>
            <!-- Semester list Edit Section End -->
            <!-- Semester delete Section Start -->
            <div id="delete_get_registration<?php echo $row["id"]; ?>" class="w3-modal" style="z-index:2020;">
                <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
                    <header class="w3-container" style="background:#343a40; color:white;">
                        <span
                            onclick="document.getElementById('delete_get_registration<?php echo $row["id"]; ?>').style.display='none'"
                            class="w3-button w3-display-topright">&times;</span>
                        <h2 align="center">Are you sure???</h2>
                    </header>
                    <form id="delete_semester_form<?php echo $row["id"]; ?>" role="form" method="POST">
                        <div class="card-body">
                            <div class="col-md-12" id="delete_error_section<?php echo $row["id"]; ?>"></div>
                            <div class="col-md-12" align="center">
                                <input type='hidden' name='id' id="id<?php echo $row["id"]; ?>"
                                    value='<?php echo $row["id"]; ?>' />
                                <input type='hidden' name='action' id="action_delete<?php echo $row["id"]; ?>"
                                    value='delete_get_registration' />
                                <div class="col-md-12" id="delete_loader_section<?php echo $row["id"]; ?>">
                                </div>
                                <button type="button" id="delete_semester_button<?php echo $row["id"]; ?>"
                                    class="btn btn-danger">Move To Trash</button>
                                <button type="button"
                                    onclick="document.getElementById('delete_get_registration<?php echo $row["id"]; ?>').style.display='none'"
                                    class="btn btn-primary">Cancel</button>
                            </div>

                            <!--<button type="reset" class="btn btn-danger">Reset</button>-->
                        </div>
                    </form>
                    <script>
                    $(function() {

                        $('#delete_semester_button<?php echo $row["id"]; ?>').click(function() {
                            $('#delete_loader_section<?php echo $row["id"]; ?>').append(
                                '<center id = "delete_loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /><br/><br/></center>'
                            );
                            $('#delete_semester_button<?php echo $row["id"]; ?>').prop(
                                'disabled', true);
                            var action = $("#action_delete<?php echo $row["id"]; ?>").val();
                            var id = $("#id<?php echo $row["id"]; ?>").val();
                            var dataString = 'action=' + action + '&id=' + id;

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
                                                '<div id = "delete_response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Delete successfully!!!</div></div>'
                                            );
                                        showDeletedData();

                                        function showDeletedData() {
                                            $.ajax({
                                                url: 'include/view.php?action=get_registration',
                                                type: 'POST',
                                                data: $('#fetchStudentDataForm')
                                                    .serializeArray(),
                                                success: function(result) {
                                                    $('#response').remove();
                                                    if (result == 0) {
                                                        $('#error_section')
                                                            .append(
                                                                '<div id = "response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Please select Academic Year!!!</div></div>'
                                                            );
                                                    } else {
                                                        $("#data_table").html(
                                                            result);
                                                    }
                                                    $('#loading').fadeOut(500,
                                                        function() {
                                                            $(this)
                                                                .remove();
                                                        });
                                                    $('#fetchStudentDataButton')
                                                        .prop('disabled',
                                                            false);
                                                }
                                            });
                                        }
                                    }
                                    $('#delete_loading').fadeOut(500, function() {
                                        $(this).remove();
                                    });
                                    $('#delete_semester_button<?php echo $row["id"]; ?>')
                                        .prop('disabled', false);
                                }

                            });
                        });

                    });
                    </script>
                </div>
            </div>
            <!-- Semester delete Section End -->

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
}
?>