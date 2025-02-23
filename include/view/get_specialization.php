<?php
if ($_GET["action"] == "get_specialization") {
    $course_id =   $_POST['course_id'];
    // $specialization_id =  $_POST['specialization_id'];
?>
    <table id="dtHorizontalExample" class="table table-bordered table-striped" >
        <thead>
            <tr>

                <th>S.No</th>
                <th>Course</th>
                <th>Specialization</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM `tbl_specialization` WHERE `status` = '$visible' &&  `course_id`='$course_id'
                                ORDER BY `sp_name` ASC
                                ";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?php echo $s_no; ?></td>
                        <td><?php echo $row["course_name"]; ?></td>
                        <td><?php echo $row['sp_name']; ?></td>
                        <td class="project-actions text-center">
                            <button class="btn btn-info btn-sm" onclick="document.getElementById('edit_specialization_edit<?php echo $row["id"]; ?>').style.display='block'">
                                <i class="fas fa-pencil-alt">
                                </i>
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="document.getElementById('delete_get_specialization<?php echo $row["id"]; ?>').style.display='block'">
                                <i class="fas fa-trash">
                                </i>
                            </button>
                        </td>

                        <!-- specialization list Edit Section Start -->
                        <div id="edit_specialization_edit<?php echo $row["id"]; ?>" class="w3-modal" style="z-index:2020;">
                            <div class="w3-modal-content w3-animate-top w3-card-4" style="width:55%">
                                <header class="w3-container" style="background:#343a40; color:white;">
                                    <span onclick="document.getElementById('edit_specialization_edit<?php echo $row["id"]; ?>').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                                    <h2 align="center">Edit Specialization</h2>
                                </header>
                                <form id="edit_specialization_edit_form<?php echo $row["id"]; ?>" role="form" method="POST">
                                    <div class="card-body">
                                        <div class="col-md-12" id="edit_error_section<?php echo $row["id"]; ?>"></div>
                                        <div class="row">

                                            <div class="col-4">
                                                <label>Course</label>
                                                <select name="course_id" id="course_id<?php echo $row["id"]; ?>" class="form-control select2" style="width: 100%;">
                                                    <?php
                                                    $sql_course = "SELECT * FROM `tbl_course`
                                                                                                       WHERE `status` = '$visible'
                                                                                                       ";
                                                    $result_course = $con->query($sql_course);
                                                    while ($row_course = $result_course->fetch_assoc()) {
                                                    ?>
                                                        <option value="<?php echo $row_course["course_id"]; ?>" <?php if ($row_course["course_id"] == $row["course_id"]) echo 'selected'; ?>><?php echo $row_course["course_name"]; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <label>Specialization</label>
                                                <input type="text" name="specialization" id="specialization<?php echo $row["id"]; ?>" value="<?php echo $row["sp_name"]; ?>" class="form-control" required>
                                            </div>
                                            
                                        </div><br>
                                        <input type='hidden' name='edit_id' id="edit_id<?php echo $row["id"]; ?>" value='<?php echo $row["id"]; ?>' />
                                        <input type='hidden' name='action' id="action<?php echo $row["id"]; ?>" value='edit_specialization_edit' />
                                        <div class="col-md-12" id="edit_loader_section<?php echo $row["id"]; ?>"></div>
                                        <button type="button" id="edit_specialization_edit_button<?php echo $row["id"]; ?>" class="btn btn-primary">Update</button>
                                        <!--<button type="reset" class="btn btn-danger">Reset</button>-->
                                    </div>
                                </form>
                                <script>
                                    $(function() {

                                        $('#edit_specialization_edit_button<?php echo $row["id"]; ?>').click(function() {
                                            $('#edit_loader_section<?php echo $row["id"]; ?>').append('<center id = "edit_loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /></center>');
                                            $('#edit_specialization_edit_button<?php echo $row["id"]; ?>').prop('disabled', true);
                                            var action = $("#action<?php echo $row["id"]; ?>").val();
                                            var edit_id = $("#edit_id<?php echo $row["id"]; ?>").val();
                                            var course_id = $("#course_id<?php echo $row["id"]; ?>").val();
                                            var specialization = $("#specialization<?php echo $row["id"]; ?>").val();
                                            // var fee_academic_year = $("#fee_academic_year<?php echo $row["id"]; ?>").val();
                                            // var exam_fee = $("#exam_fee<?php echo $row["id"]; ?>").val();
                                            // var exam_fine = $("#exam_fine<?php echo $row["id"]; ?>").val();
                                            // var exam_fee_last_date = $("#exam_fee_last_date<?php echo $row["id"]; ?>").val();
                                            // var fee_status = $("#fee_status<?php echo $row["id"]; ?>").val();
                                            // var examname = $("#examname<?php echo $row["id"]; ?>").val();
                                            // var name_of_school = $("#name_of_school<?php echo $row["id"]; ?>").val();
                                            // var examination_month = $("#examination_month<?php echo $row["id"]; ?>").val();
                                            // var date_of_result = $("#date_of_result<?php echo $row["id"]; ?>").val();
                                            // var exam_reporting_time = $("#exam_reporting_time<?php echo $row["id"]; ?>").val();
                                            // var time_of_examination = $("#time_of_examination<?php echo $row["id"]; ?>").val();
                                            // var time_of_dispersal = $("#time_of_dispersal<?php echo $row["id"]; ?>").val();
                                            // var form_start_date = $("#form_start_date<?php echo $row["id"]; ?>").val();
                                            // var form_close_date = $("#form_close_date<?php echo $row["id"]; ?>").val();

                                            var dataString = 'action=' + action + '&edit_id=' + edit_id + '&course_id=' + course_id + '&specialization=' + specialization;

                                            $.ajax({
                                                url: 'include/controller.php',
                                                type: 'POST',
                                                data: dataString,
                                                success: function(result) {
                                                    $('#edit_response').remove();
                                                    if (result == "exsits") {
                                                        $('#edit_error_section<?php echo $row["id"]; ?>').append('<div id = "edit_response"><div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-exclamation-triangle"></i> This No have already exsits!!!</div></div>');
                                                    }
                                                    if (result == "error") {
                                                        $('#edit_error_section<?php echo $row["id"]; ?>').append('<div id = "edit_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>');
                                                    }
                                                    if (result == "empty") {
                                                        $('#edit_error_section<?php echo $row["id"]; ?>').append('<div id = "edit_response"><div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-exclamation-triangle"></i>  Please fill out Prospectus No!!!</div></div>');
                                                    }
                                                    if (result == "success") {
                                                        $('#edit_error_section<?php echo $row["id"]; ?>').append('<div id = "edit_response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i>  Updated successfully!!!</div></div>');
                                                        showUpdatedData();

                                                        function showUpdatedData() {
                                                            $.ajax({
                                                                url: 'include/view.php?action=get_specialization',
                                                                type: 'POST',
                                                                data: $('#fetchStudentDataForm').serializeArray(),
                                                                success: function(result) {
                                                                    $('#response').remove();
                                                                    if (result == 0) {
                                                                        $('#error_section').append('<div id = "response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Please select Academic Year!!!</div></div>');
                                                                    } else {
                                                                        $("#data_table").html(result);
                                                                    }
                                                                    $('#loading').fadeOut(500, function() {
                                                                        $(this).remove();
                                                                    });
                                                                    $('#fetchStudentDataButton').prop('disabled', false);
                                                                }
                                                            });
                                                        }
                                                    }
                                                    $('#edit_loading').fadeOut(500, function() {
                                                        $(this).remove();
                                                    });
                                                    $('#edit_specialization_edit_button<?php echo $row["id"]; ?>').prop('disabled', false);
                                                }

                                            });
                                        });

                                    });
                                </script>
                            </div>
                        </div>
                        <!-- specialization list Edit Section End -->
                        <!-- specialization delete Section Start -->
                        <div id="delete_get_specialization<?php echo $row["id"]; ?>" class="w3-modal" style="z-index:2020;">
                            <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
                                <header class="w3-container" style="background:#343a40; color:white;">
                                    <span onclick="document.getElementById('delete_get_specialization<?php echo $row["id"]; ?>').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                                    <h2 align="center">Are you sure???</h2>
                                </header>
                                <form id="delete_specialization_form<?php echo $row["id"]; ?>" role="form" method="POST">
                                    <div class="card-body">
                                        <div class="col-md-12" id="delete_error_section<?php echo $row["id"]; ?>"></div>
                                        <div class="col-md-12" align="center">
                                            <input type='hidden' name='specialization_id' id="specialization_id<?php echo $row["id"]; ?>" value='<?php echo $row["id"]; ?>' />
                                            <input type='hidden' name='action' id="action_delete<?php echo $row["id"]; ?>" value='delete_get_specialization' />
                                            <div class="col-md-12" id="delete_loader_section<?php echo $row["id"]; ?>"></div>
                                            <button type="button" id="delete_specialization_button<?php echo $row["id"]; ?>" class="btn btn-danger">Move To Trash</button>
                                            <button type="button" onclick="document.getElementById('delete_get_specialization<?php echo $row["id"]; ?>').style.display='none'" class="btn btn-primary">Cancel</button>
                                        </div>

                                        <!--<button type="reset" class="btn btn-danger">Reset</button>-->
                                    </div>
                                </form>
                                <script>
                                    $(function() {

                                        $('#delete_specialization_button<?php echo $row["id"]; ?>').click(function() {
                                            $('#delete_loader_section<?php echo $row["id"]; ?>').append('<center id = "delete_loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /><br/><br/></center>');
                                            $('#delete_specialization_button<?php echo $row["id"]; ?>').prop('disabled', true);
                                            var action = $("#action_delete<?php echo $row["id"]; ?>").val();
                                            var specialization_id = $("#specialization_id<?php echo $row["id"]; ?>").val();
                                            var dataString = 'action=' + action + '&specialization_id=' + specialization_id;

                                            $.ajax({
                                                url: 'include/controller.php',
                                                type: 'POST',
                                                data: dataString,
                                                success: function(result) {
                                                    $('#delete_response').remove();
                                                    if (result == "error") {
                                                        $('#delete_error_section<?php echo $row["id"]; ?>').append('<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>');
                                                    }
                                                    if (result == "empty") {
                                                        $('#delete_error_section<?php echo $row["id"]; ?>').append('<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>');
                                                    }
                                                    if (result == "success") {
                                                        $('#delete_error_section<?php echo $row["id"]; ?>').append('<div id = "delete_response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Delete successfully!!!</div></div>');
                                                        showDeletedData();

                                                        function showDeletedData() {
                                                            $.ajax({
                                                                url: 'include/view.php?action=get_specialization',
                                                                type: 'POST',
                                                                data: $('#fetchStudentDataForm').serializeArray(),
                                                                success: function(result) {
                                                                    $('#response').remove();
                                                                    if (result == 0) {
                                                                        $('#error_section').append('<div id = "response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Please select Academic Year!!!</div></div>');
                                                                    } else {
                                                                        $("#data_table").html(result);
                                                                    }
                                                                    $('#loading').fadeOut(500, function() {
                                                                        $(this).remove();
                                                                    });
                                                                    $('#fetchStudentDataButton').prop('disabled', false);
                                                                }
                                                            });
                                                        }
                                                    }
                                                    $('#delete_loading').fadeOut(500, function() {
                                                        $(this).remove();
                                                    });
                                                    $('#delete_specialization_button<?php echo $row["id"]; ?>').prop('disabled', false);
                                                }

                                            });
                                        });

                                    });
                                </script>
                            </div>
                        </div>
                        <!-- specialization delete Section End -->

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