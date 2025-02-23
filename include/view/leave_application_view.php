<?php
if ($_GET["action"] == "get_leave_application") {
?>
    <table id="leave_application_table" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Teacher Name</th>
                <th>Leave From</th>
                <th>Leave To</th>
                <th>Reason For Leave</th>
                <th>Leave Type</th>
                <th class="project-actions text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM `tbl_apply_leave` ORDER BY `id` ASC";
            $result = $con->query($sql);
            $s_no = 1;
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $buttonLabel = empty($row['why_rejected']) ? 'Reject' : 'Rejected';
                    $buttonClass = empty($row['why_rejected']) ? 'btn-secondary' : 'btn-danger';
            ?>
                    <tr>
                        <td><?php echo $s_no; ?></td>
                        <td><?php echo ucwords($row["added_by"]) ?></td>
                        <td><?php echo $row["from_date"] ?></td>
                        <td><?php echo $row["to_date"] ?></td>
                        <td><?php echo $row["reason"] ?></td>
                        <td><?php echo $row["leave_type"] ?></td>
                        <td class="project-actions text-center">

                        <?php
                        $permissions = json_decode($_SESSION["authority"], true); 
                        $loggedInUserType = $_SESSION['logger_type']; 

                        if ((isset($permissions['2']) && in_array('2_6', explode('||', $permissions['2']))) || $loggedInUserType == 'admin') {
                            ?>
                            <button type="button"
                                class="status-btn btn btn-sm <?php echo ($row['status'] === 'Approved') ? 'btn-success' : 'btn-warning'; ?>"
                                data-id="<?php echo $row['id']; ?>">
                                <?php echo $row["status"]; ?>
                            </button>
                            <?php
                        }
                        ?>

                        <?php
                        $permissions = json_decode($_SESSION["authority"], true); 
                        $loggedInUserType = $_SESSION['logger_type']; 

                        if ((isset($permissions['2']) && in_array('2_8', explode('||', $permissions['2']))) || $loggedInUserType == 'admin') {
                            ?>
                             <button class="btn btn-sm <?php echo $buttonClass; ?> reject-btn" id="rejectButton" onclick="showModal(this)" data-id="<?php echo $row['id']; ?>">
                                <?php echo $buttonLabel; ?>
                            </button>
                            <?php
                        }
                        ?>

                        <?php
                        $permissions = json_decode($_SESSION["authority"], true); 
                        $loggedInUserType = $_SESSION['logger_type']; 

                        if ((isset($permissions['2']) && in_array('2_7', explode('||', $permissions['2']))) || $loggedInUserType == 'admin') {
                            ?>
                            <button class="btn btn-danger btn-sm" onclick="document.getElementById('delete_leave_app<?php echo $row["id"]; ?>').style.display='block'">
                                <i class="fas fa-trash"></i>
                            </button>
                            <?php
                        }
                        ?>

                               <!-- Leave delete Section Start -->
                               <div id="delete_leave_app<?php echo $row["id"]; ?>" class="w3-modal" style="z-index:2020;">
                                <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
                                    <header class="w3-container" style="background:#343a40; color:white;">
                                        <span onclick="document.getElementById('delete_leave_app<?php echo $row["id"]; ?>').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                                        <h2 align="center">Are you sure???</h2>
                                    </header>
                                    <form id="delete_leave_app_form<?php echo $row["id"]; ?>" role="form" method="POST">
                                        <div class="card-body">
                                            <div class="col-md-12" id="delete_error_section<?php echo $row["id"]; ?>"></div>
                                            <div class="col-md-12" align="center">
                                                <input type='hidden' name='delete_leave_app_id' id="delete_leave_app_id<?php echo $row["id"]; ?>" value='<?php echo $row["id"]; ?>' />
                                                <input type='hidden' name='action' id="action_delete<?php echo $row["id"]; ?>" value='delete_leave_applications' />
                                                <div class="col-md-12" id="delete_loader_section<?php echo $row["id"]; ?>"></div>
                                                <button type="button" id="delete_leave_app_button<?php echo $row["id"]; ?>" class="btn btn-danger">Move To Trash</button>
                                                <button type="button" onclick="document.getElementById('delete_leave_app<?php echo $row["id"]; ?>').style.display='none'" class="btn btn-primary">Cancel</button>
                                            </div>
                                            <!--<button type="reset" class="btn btn-danger">Reset</button>-->
                                        </div>
                                    </form>
                                    <script>
                                        $(function() {
                                            $('#delete_leave_app_button<?php echo $row["id"]; ?>').click(function() {
                                                $('#delete_loader_section<?php echo $row["id"]; ?>').append('<center id = "delete_loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /><br/><br/></center>');
                                                $('#delete_leave_app_button<?php echo $row["id"]; ?>').prop('disabled', true);
                                                var action = $("#action_delete<?php echo $row["id"]; ?>").val();
                                                var delete_leave_app_id = $("#delete_leave_app_id<?php echo $row["id"]; ?>").val();
                                                var dataString = 'action=' + action + '&delete_leave_app_id=' + delete_leave_app_id;

                                                $.ajax({
                                                    url: 'leave_applications_delete.php',
                                                    type: 'POST',
                                                    data: dataString,
                                                    success: function(result) {
                                                        // alert (result);
                                                        $('#delete_response').remove();
                                                        if (result == "error") {
                                                            $('#delete_error_section<?php echo $row["id"]; ?>').append('<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>');
                                                        }
                                                        if (result == "empty") {
                                                            $('#delete_error_section<?php echo $row["id"]; ?>').append('<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>');
                                                        }
                                                        if (result == "success") {
                                                            $('#delete_error_section<?php echo $row["id"]; ?>').append('<div id = "delete_response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Leave Application Delete successfully!!!</div></div>');
                                                            
                                                            showDeletedData();

                                                            function showDeletedData() {
                                                                $.ajax({
                                                                    url: 'include/view.php?action=get_leave_application',
                                                                    type: 'GET',
                                                                    success: function(result) {
                                                                        $("#data_table").html(result);
                                                                    }
                                                                });
                                                            }
                                                        }
                                                    
                                                    }
                                                });
                                            });

                                        });
                                    </script>
                                </div>
                            </div>
                            <!-- leave delete Section End -->
                             
                            <div id="add_rejection_reason" class="w3-modal" style="z-index:2020;">
                                <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
                                    <header class="w3-container" style="background:#343a40; color:white;">
                                        <span onclick="document.getElementById('add_rejection_reason').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                                        <h2 align="center">Add Rejection Reason</h2>
                                    </header>
                                    <form id="rejectionForm" action="send_rejection.php" method="POST">
                                        <div class="card-body">
                                            <label for="leave" class="form-label">Rejection reason</label>
                                            <textarea class="form-control" id="leave" name="rejection_reason" rows="3" placeholder="Write your reason..." required></textarea>
                                            <input type="hidden" id="teacher_id" name="teacher_id">
                                        </div>
                                        <div class="d-flex justify-content-left ml-3">
                                            <input type="submit" value="Reject" class="btn btn-danger my-2">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
            <?php
                    $s_no++;
                }
            } else {
                echo '
                <div class="alert alert-warning alert-dismissible">
                    <i class="icon fas fa-exclamation-triangle"></i>  No data available now!!!
                </div>';
            }
            ?>
        </tbody>
    </table>

    <script>
        function showModal(button) {
            var leaveId = button.getAttribute('data-id');
            document.getElementById('teacher_id').value = leaveId;
            document.getElementById('add_rejection_reason').style.display = 'block';
        }

        $(document).ready(function() {
            $('form#rejectionForm').on('submit', function(event) {
                event.preventDefault();

                var form = $(this);
                var teacherId = $('#teacher_id').val();

                $.ajax({
                    url: 'send_rejection.php',
                    type: 'POST',
                    data: form.serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            window.location.reload();
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function() {
                        alert('An error occurred while processing your request.');
                    }
                });
            });

            var table = $('#leave_application_table').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });


            $('#leave_application_table').on('click', '.status-btn', function() {
                var button = $(this);
                var teacher_id = button.data('id');
                $.ajax({
                    url: 'process_rejection.php',
                    type: 'POST',
                    data: {
                        teacher_id: teacher_id
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.new_status) {
                            button.text(response.new_status);
                            window.location.reload();
                        } else {
                            alert(response.error);
                        }
                    }
                });
            });

            $('#leave_application_table').on('click', '.reject-btn', function() {
                var button = $(this);
                var teacher_id = button.data('id');
                $.ajax({
                    url: 'update_reject_btn.php',
                    type: 'POST',
                    data: {
                        teacher_id: teacher_id
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                    }
                });
            });
        });
    </script>
<?php
}
?>