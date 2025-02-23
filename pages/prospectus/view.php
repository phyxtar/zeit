<?php
include_once "../../framwork/main.php";
include_once "../../include/config.php";
include_once "../../include/db_class.php";
include_once "../../include/function.php";

$objectSecond = new DBEVAL();

if ($_GET["action"] == "get_nsuniv_prospectus_enquiry") {
    $objectSecond->update("tbl_alert", "`prospectus_enquiry` = '0' WHERE `id`='1'");
    $objectSecond->sql = "";
    $start = intval($_POST["start"]);
    $lenghtOfData = intval($_POST["lenghtOfData"]);

?>
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Prospectus No</th>
                <th>Course</th>
                <th>Session</th>
                <th>Name</th>
                <th>Phone No</th>
                <th>Referred By</th>
                <th>Payment Status</th>
                <th>Timing</th>
                <th class="project-actions text-center">Action </th>
            </tr>
        </thead>
        <tbody>
            <?php
            $objectSecond->select("tbl_prospectus");
            if (strtolower($lenghtOfData) == "all") {
                $objectSecond->where(" 1 ORDER BY `id` DESC ");
                $s_no = 1;
            } else if ($start == 1) {
                $objectSecond->where(" 1 ORDER BY `id` DESC LIMIT " . $lenghtOfData);
                $s_no = $start;
            } else {
                $objectSecond->where(" 1 ORDER BY `id` DESC LIMIT " . $start . ", " . $lenghtOfData);
                $s_no = ++$start;
            }
            $result = $objectSecond->get();
            if ($result->num_rows > 0) {
                while ($row = $objectSecond->get_row()) {
            ?>
                    <tr>
                        <td><?php echo $s_no; ?></td>
                        <td style="color:#8a0410;"><b><?php if ($row["prospectus_no"] != "") echo $row["prospectus_no"];
                                                        else echo "Please Give Prospectus No"; ?></b></td>
                        <td><?php echo get_course($row["prospectus_course_name"]) ?></td>
                        <td><?php echo get_session($row["prospectus_session"]) ?></td>
                        <td><?php echo $row["prospectus_applicant_name"] ?></td>
                        <td><?php echo $row["mobile"] ?></td>
                        <td><?php echo $row["revert_by"] ?></td>
                        <td><?= $row["payment_status"] == '' ? 'No' : $row["payment_status"] ?></td>
                        <td><?php echo $row["post_at"] ?></td>
                        <td class="project-actions text-center">
                            <button class="btn btn-info btn-sm" onclick="document.getElementById('view_university_prospectus_enquiry<?php echo $row["id"]; ?>').style.display='block'">
                                <i class="fas fa-eye">
                                </i>
                                View
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="document.getElementById('delete_university_prospectus_enquiry<?php echo $row["id"]; ?>').style.display='block'">
                                <i class="fas fa-trash">
                                </i>
                                Delete
                            </button>
                        </td>

                        <!-- View Section Start -->
                        <div id="view_university_prospectus_enquiry<?php echo $row["id"]; ?>" class="w3-modal" style="z-index:2020;">
                            <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%; margin-bottom:50px;">
                                <header class="w3-container" style="background:#343a40; color:white;">
                                    <span onclick="document.getElementById('view_university_prospectus_enquiry<?php echo $row["id"]; ?>').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                                    <h2 align="center">View Details</h2>
                                </header>
                                <form role="form" method="POST">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Prospectus No</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" id="unversity_prospectus_number<?php echo $row["id"] ?>" name="unversity_prospectus_number" class="form-control" value="<?php echo $row["prospectus_no"] ?>">
                                                        <input type="hidden" id="prospectus_course_name<?php echo $row["id"] ?>" name="prospectus_course_name" class="form-control" value="<?php echo $row["prospectus_course_name"] ?>">
                                                        <input type="hidden" id="prospectus_rate<?php echo $row["id"] ?>" name="prospectus_rate" class="form-control" value="<?php echo $row["prospectus_rate"] ?>">
                                                        <input type="hidden" id="post_at<?php echo $row["id"] ?>" name="post_at" class="form-control" value="<?php echo $row["post_at"] ?>">
                                                        <input type="hidden" id="unversity_prospectus_id<?php echo $row["id"] ?>" name="unversity_prospectus_id" class="form-control" value="<?php echo $row["id"] ?>">
                                                        <input type="hidden" id="action_prospectus_enquiry<?php echo $row["id"] ?>" name="action" class="form-control" value="update_prospectus_enquiry">
                                                        <div class="input-group-prepend">
                                                            <button id="update_prospectus<?php echo $row["id"] ?>" type="button" class="btn btn-info"><span id="update_loader_section<?php echo $row["id"] ?>"></span>Update</button>
                                                        </div>

                                                    </div>
                                                    <?php if ($row["prospectus_no"] == "") { ?>
                                                        <small id="update_error_section<?php echo $row["id"] ?>" style="color:#8a0410;">Please Add a Prospectus Number.</small>
                                                    <?php } else { ?>
                                                        <small id="update_error_section<?php echo $row["id"] ?>" style="color:#8a0410;"></small>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Prospectus Amount</label>
                                                    <input type="text" class="form-control" name="prospectus_rate" value="<?php echo $row["prospectus_rate"] ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Course</label>
                                                    <input type="text" class="form-control" name="prospectus_course_name" value="<?php echo $row["prospectus_course_name"] ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Applicant Name</label>
                                                    <input type="text" class="form-control" value="<?php echo $row["prospectus_applicant_name"] ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Father Name</label>
                                                    <input type="text" class="form-control" value="<?php echo $row["prospectus_applicant_name"] ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Email Id</label>
                                                    <input type="text" class="form-control" value="<?php echo $row["prospectus_emailid"] ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone No</label>
                                                    <input type="text" class="form-control" value="<?php echo $row["mobile"] ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Country</label>
                                                    <input type="text" class="form-control" value="<?php echo $row["prospectus_country"] ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>State</label>
                                                    <input type="text" class="form-control" value="<?php echo $row["prospectus_state"] ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>City</label>
                                                    <input type="text" class="form-control" value="<?php echo $row["prospectus_city"] ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <textarea class="form-control" readonly><?php echo $row["prospectus_address"] ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Payment Mode</label>
                                                    <input type="text" class="form-control" value="<?php echo $row["prospectus_payment_mode"] ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Bank Name</label>
                                                    <input type="text" class="form-control" value="<?php echo $row["bank_name"] ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Transaction No</label>
                                                    <input type="text" class="form-control" value="<?php echo $row["transaction_no"] ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Transaction Date</label>
                                                    <input type="text" class="form-control" value="<?php echo $row["transaction_date"] ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Timing</label>
                                                    <input type="text" class="form-control" value="<?php echo $row["post_at"] ?>" readonly>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                                <script>
                                    $(function() {

                                        $('#update_prospectus<?php echo $row["id"]; ?>').click(function() {
                                            $('#update_loader_section<?php echo $row["id"]; ?>').append('<img id = "update_loading" width="20px" src = "images/ajax-loader.gif" alt="Currently loading" /> ');
                                            $('#update_prospectus<?php echo $row["id"]; ?>').prop('disabled', true);

                                            var prosprectus_number = $("#unversity_prospectus_number<?php echo $row["id"]; ?>").val();
                                            var prospectus_course_name = $("#prospectus_course_name<?php echo $row["id"]; ?>").val();
                                            var prospectus_rate = $("#prospectus_rate<?php echo $row["id"]; ?>").val();
                                            var post_at = $("#post_at<?php echo $row["id"]; ?>").val();
                                            var prosprectus_id = $("#unversity_prospectus_id<?php echo $row["id"]; ?>").val();
                                            var action = $("#action_prospectus_enquiry<?php echo $row["id"]; ?>").val();
                                            var dataString = 'action=' + action + '&prosprectus_id=' + prosprectus_id + '&prosprectus_number=' + prosprectus_number + '&prospectus_course_name=' + prospectus_course_name + '&prospectus_rate=' + prospectus_rate + '&post_at=' + post_at;

                                            $.ajax({
                                                url: 'include/controller.php',
                                                type: 'POST',
                                                data: dataString,
                                                success: function(result) {
                                                    //                                                                console.log(dataString);
                                                    //                                                                console.log(result);
                                                    $('#update_response').remove();
                                                    if (result == "error") {
                                                        $('#update_error_section<?php echo $row["id"]; ?>').html('<b>Something went wrong please try again!!!</b>');
                                                    }
                                                    if (result == "empty") {
                                                        $('#update_error_section<?php echo $row["id"]; ?>').html('<b>Please Enter Prospectus Number!!!</b>');
                                                    }
                                                    if (result == "exsits") {
                                                        $('#update_error_section<?php echo $row["id"]; ?>').html('<b>Prospectus Number Already Exsits!!!</b>');
                                                    }
                                                    if (result == "success") {
                                                        $('#update_error_section<?php echo $row["id"]; ?>').html('<b>Prospectus Number Added successfully!!!</b>');
                                                        showDeletedData(5, 1);

                                                        function showDeletedData(lenghtOfData, paginationNumber) {
                                                            $('#data_table').append('<center><img id = "dynamicChangeLoader" width="50px" src = "images/ajax-loader.gif" alt="Loading..." /></center>');
                                                            $('#dynamicChangeLimit').addClass("disableAll");
                                                            $('#data_table').addClass("disableAll");
                                                            $('#dynamicChangePaginations').addClass("disableAll");
                                                            $('.pagiNation').addClass("disableAll");
                                                            $(".pagiNation").removeClass("btn-danger");
                                                            $(".pagiNation").addClass("btn-default");
                                                            $("#option1").removeClass("btn-default");
                                                            $("#option1").addClass("btn-danger");
                                                            var start = 1;
                                                            if (paginationNumber == 1)
                                                                start = paginationNumber;
                                                            else
                                                                start = Number(lenghtOfData) * (Number(paginationNumber) - 1);
                                                            console.log(start + ", " + lenghtOfData);
                                                            $.ajax({
                                                                url: 'include/view.php?action=get_nsuniv_prospectus_enquiry',
                                                                type: 'POST',
                                                                data: {
                                                                    action: "get_nsuniv_prospectus_enquiry",
                                                                    start: start,
                                                                    lenghtOfData: lenghtOfData
                                                                },
                                                                success: function(result) {
                                                                    $("#data_table").html(result);
                                                                    $('#dynamicChangeLimit').removeClass("disableAll");
                                                                    $('#data_table').removeClass("disableAll");
                                                                    $('#dynamicChangePaginations').removeClass("disableAll");
                                                                    $('.pagiNation').removeClass("disableAll");
                                                                }
                                                            });
                                                        }
                                                    }
                                                    $('#update_loading').fadeOut(500, function() {
                                                        $(this).remove();
                                                        $('#update_prospectus<?php echo $row["id"]; ?>').prop('disabled', false);
                                                    });
                                                }
                                            });
                                        });

                                    });
                                </script>
                            </div>
                        </div>
                        <!-- View Section End -->

                        <!-- Delete Section Start -->
                        <div id="delete_university_prospectus_enquiry<?php echo $row["id"]; ?>" class="w3-modal" style="z-index:2020;">
                            <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
                                <header class="w3-container" style="background:#343a40; color:white;">
                                    <span onclick="document.getElementById('delete_university_prospectus_enquiry<?php echo $row["id"]; ?>').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                                    <h2 align="center">Are you sure???</h2>
                                </header>
                                <form id="delete_university_prospectus_enquiry_form<?php echo $row["id"]; ?>" role="form" method="POST">
                                    <div class="card-body">
                                        <div class="col-md-12" id="delete_error_section<?php echo $row["id"]; ?>"></div>
                                        <div class="col-md-12" align="center">
                                            <input type='hidden' name='delete_id' id="delete_id<?php echo $row["id"]; ?>" value='<?php echo $row["id"]; ?>' />
                                            <input type='hidden' name='action' id="action_delete<?php echo $row["id"]; ?>" value='delete_university_prospectus_enquiry' />
                                            <div class="col-md-12" id="delete_loader_section<?php echo $row["id"]; ?>"></div>
                                            <button type="button" id="delete_university_prospectus_enquiry_button<?php echo $row["id"]; ?>" class="btn btn-danger">Move To Trash</button>
                                            <button type="button" onclick="document.getElementById('delete_university_prospectus_enquiry<?php echo $row["id"]; ?>').style.display='none'" class="btn btn-primary">Cancel</button>
                                        </div>

                                        <!--<button type="reset" class="btn btn-danger">Reset</button>-->
                                    </div>
                                </form>
                                <script>
                                    $(function() {

                                        $('#delete_university_prospectus_enquiry_button<?php echo $row["id"]; ?>').click(function() {
                                            $('#delete_loader_section<?php echo $row["id"]; ?>').append('<center id = "delete_loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /><br/><br/></center>');
                                            $('#delete_university_prospectus_enquiry_button<?php echo $row["id"]; ?>').prop('disabled', true);
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
                                                        $('#delete_error_section<?php echo $row["id"]; ?>').append('<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>');
                                                    }
                                                    if (result == "empty") {
                                                        $('#delete_error_section<?php echo $row["id"]; ?>').append('<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>');
                                                    }
                                                    if (result == "success") {
                                                        $('#delete_error_section<?php echo $row["id"]; ?>').append('<div id = "delete_response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Enquiry Delete successfully!!!</div></div>');
                                                        showDeletedData(5, 1);

                                                        function showDeletedData(lenghtOfData, paginationNumber) {
                                                            $('#data_table').append('<center><img id = "dynamicChangeLoader" width="50px" src = "images/ajax-loader.gif" alt="Loading..." /></center>');
                                                            $('#dynamicChangeLimit').addClass("disableAll");
                                                            $('#data_table').addClass("disableAll");
                                                            $('#dynamicChangePaginations').addClass("disableAll");
                                                            $('.pagiNation').addClass("disableAll");
                                                            $(".pagiNation").removeClass("btn-danger");
                                                            $(".pagiNation").addClass("btn-default");
                                                            $("#option1").removeClass("btn-default");
                                                            $("#option1").addClass("btn-danger");
                                                            var start = 1;
                                                            if (paginationNumber == 1)
                                                                start = paginationNumber;
                                                            else
                                                                start = Number(lenghtOfData) * (Number(paginationNumber) - 1);
                                                            console.log(start + ", " + lenghtOfData);
                                                            $.ajax({
                                                                url: 'include/view.php?action=get_nsuniv_prospectus_enquiry',
                                                                type: 'POST',
                                                                data: {
                                                                    action: "get_nsuniv_prospectus_enquiry",
                                                                    start: start,
                                                                    lenghtOfData: lenghtOfData
                                                                },
                                                                success: function(result) {
                                                                    $("#data_table").html(result);
                                                                    $('#dynamicChangeLimit').removeClass("disableAll");
                                                                    $('#data_table').removeClass("disableAll");
                                                                    $('#dynamicChangePaginations').removeClass("disableAll");
                                                                    $('.pagiNation').removeClass("disableAll");
                                                                }
                                                            });
                                                        }
                                                    }
                                                    $('#delete_loading').fadeOut(500, function() {
                                                        $(this).remove();
                                                        $('#delete_university_prospectus_enquiry_button<?php echo $row["id"]; ?>').prop('disabled', false);
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
            $("#example1").DataTable({
                "paging": false
            });
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
?>