<!-- /.tab-pane -->
<div class="tab-pane" id="paidfee">
    <!-- The timeline -->
    <div class="timeline timeline-inverse">
        <?php
        $sql_paid_time = "SELECT * FROM `tbl_fee_paid`
                                                        WHERE `status` = '$visible' && `student_id` = '$studentRegistrationNo' && `payment_status` != 'deleted'
                                                        ORDER BY `feepaid_id` DESC
                                                        ";
        $result_paid_time = $con->query($sql_paid_time);
        if ($result_paid_time->num_rows > 0) {
            while ($row_paid_time = $result_paid_time->fetch_assoc()) {
                $allPerticulars = explode(",", $row_paid_time["paid_amount"]);
                $all_particular_id = explode(",", $row_paid_time["particular_id"]);
                $totalPerticular = 0;
                for ($i = 0; $i < count($allPerticulars); $i++){
                    if($allPerticulars[$i]>0){
                    $totalPerticular = $totalPerticular + intval($allPerticulars[$i]);
                    $particular_name=   get_particular_name($all_particular_id[$i]);
                    }

                }
                $totalAmount = $totalPerticular + intval($row_paid_time["fine"]) - intval($row_paid_time["rebate_amount"]);

        ?>
                <!-- Timeline Section Start -- >
                                           timeline time label -->
                <div class="time-label">
                    <span class="bg-success">
                        <?php echo date("d M, Y", strtotime($row_paid_time["receipt_date"])); ?>
                    </span>
                </div>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <div>
                    <i class="fas fa-money-check bg-info"></i>

                    <div id="fee_Status_section_full<?php echo $row_paid_time["feepaid_id"]; ?>" class="timeline-item" style="background-color:<?php if (strtolower($row_paid_time["payment_status"]) == "bounced") echo '#ffcccb';
                                                                                                                                                if (strtolower($row_paid_time["payment_status"]) == "pending") echo '#ffffed';
                                                                                                                                                if (strtolower($row_paid_time["payment_status"]) == "refunded") echo '#ffa7a7'; ?>;">
                        <span class="time"><i class="far fa-clock"></i> <?php echo $row_paid_time["fee_paid_time"]; ?> </span>

                        <h3 class="timeline-header"><a href="javascript:void(0);">Payment Information</a></h3>

                        <div class="timeline-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>PartiCular Name</th>
                                        <th>Total Perticular</th>
                                        <th>Fine</th>
                                        <th>Extra Fine</th>
                                        <th>Rebate</th>
                                        <th>Total Paid</th>
                                        <th><span class="text-red">Remaining</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>&#8377;<?= $particular_name ?> </td>
                                        <td>&#8377; <?php echo number_format(intval($totalPerticular)); ?></td>
                                        <td>&#8377; <?php echo number_format(intval($row_paid_time["fine"])); ?></td>
                                        <?php
                                        $show_extra_fine = 0;
                                        $show_extra_fine_msg = "";
                                        if (!empty($row_paid_time["extra_fine"])) {
                                            $show_extra = explode("|separator|", $row_paid_time["extra_fine"]);
                                            $show_extra_fine = $show_extra[0];
                                            if (isset($show_extra[1])) {
                                                $show_extra_fine_msg = $show_extra[1];
                                            }
                                        }
                                        ?>
                                        <?php
                                        if (empty($show_extra_fine_msg)) :
                                        ?>
                                            <td>&#8377; <?php echo number_format(intval($show_extra_fine)); ?></td>
                                        <?php
                                        else :
                                        ?>
                                            <td>&#8377; <?php echo number_format(intval($show_extra_fine)); ?> <br /> <small class="text-danger"><?= htmlspecialchars_decode($show_extra_fine_msg) ?></small></td>
                                        <?php
                                        endif;
                                        ?>
                                        <td>&#8377; <?php echo number_format(intval($row_paid_time["rebate_amount"])); ?></td>
                                        <td>&#8377; <?php echo number_format(intval($totalAmount) + intval($row_paid_time["rebate_amount"]) + intval($show_extra_fine)); ?></td>
                                        <td>&#8377; <?php echo number_format(intval($row_paid_time["balance"])); ?></td>
                                    </tr>
                                </tbody>
                            </table>

                            <h5 class="timeline-header"><a href="javascript:void(0);">Payment Mode</a> ~ <?php echo $row_paid_time["payment_mode"]; ?></h5>
                            <h5 class="timeline-header"><a href="javascript:void(0);">Payment Status</a> ~ <span id="fee_Status_section<?php echo $row_paid_time["feepaid_id"]; ?>"><span class="<?php if (strtolower($row_paid_time["payment_status"]) == "bounced") echo 'bg-danger';
                                                                                                                                                                                                    if (strtolower($row_paid_time["payment_status"]) == "refunded") echo 'bg-danger';
                                                                                                                                                                                                    else if (strtolower($row_paid_time["payment_status"]) == "pending") echo 'bg-warning'; ?>"><?php echo strtoupper($row_paid_time["payment_status"]); ?></span></span> </h5>
                        </div>
                        <div class="timeline-footer" align="right">
                            <h5 class="timeline-header"><a href="javascript:void(0);">Give Status Here</a></h5>
                            <?php if ($row_paid_time["payment_status"] == "refunded") { ?>
                                <a onclick="statusChange('<?php echo $row_paid_time['feepaid_id']; ?>' ,'cleared')" class="btn btn-info btn-sm">Add this Fee</a>
                                <a onclick="statusChange('<?php echo $row_paid_time['feepaid_id']; ?>' ,'deleted')" class="btn btn-danger btn-sm">Delete</a>
                            <?php } else {
                            ?>

                            <?php
                                $permissions = json_decode($_SESSION["authority"], true); 
                                $loggedInUserType = $_SESSION['logger_type']; 

                                if ((isset($permissions['7']) && in_array('7_14', explode('||', $permissions['7']))) || $loggedInUserType == 'admin') {
                                    ?>
                                     <a onclick="statusChange('<?php echo $row_paid_time['feepaid_id']; ?>' ,'refunded')" class="btn btn-info btn-sm">Refund</a>
                                    <?php
                            }
                            ?>
                            <?php
                                $permissions = json_decode($_SESSION["authority"], true); 
                                $loggedInUserType = $_SESSION['logger_type']; 

                                if ((isset($permissions['7']) && in_array('7_15', explode('||', $permissions['7']))) || $loggedInUserType == 'admin') {
                                    ?>
                                     <a onclick="statusChange('<?php echo $row_paid_time['feepaid_id']; ?>' ,'deleted')" class="btn btn-danger btn-sm">Delete</a>
                                    <?php
                            }
                            ?>
                            <?php
                            } ?>
                            <?php if ($row_paid_time["payment_mode"] == "Cheque") { ?>
                                <a onclick="statusChange('<?php echo $row_paid_time['feepaid_id']; ?>' ,'cleared')" class="btn btn-success btn-sm">Cleared</a>
                                <a onclick="statusChange('<?php echo $row_paid_time['feepaid_id']; ?>' ,'pending')" class="btn btn-warning btn-sm">Pending</a>
                                <a onclick="statusChange('<?php echo $row_paid_time['feepaid_id']; ?>' ,'bounced')" class="btn btn-danger btn-sm">Bounced</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <!-- END timeline item -->
                <!-- Timeline Section End -->
            <?php }
        } else {
            ?>
            <center><b class="text-red">No any Payment Yet!!!</b></center>
        <?php
        } ?>
        <div>
            <i class="fas fa-money-bill-alt bg-danger"></i>
        </div>
        <script>
            function statusChange(feepaid_id, statusUpdate) {
                $('#paidfee').css("opacity", "0.4");
                $('#paidfee').css("pointer-events", "none");
                var action = "change_Fee_Status";
                var dataString = 'action=' + action + '&feepaid_id=' + feepaid_id + '&status=' + statusUpdate;
                $.ajax({
                    url: 'include/controller.php',
                    type: 'POST',
                    data: dataString,
                    success: function(result) {
                        if (result != "error" && result != "empty") {
                            console.log(result);
                            var fullinfo = result.split(',');
                            $('#fee_Status_section' + feepaid_id).html(fullinfo[0]);
                            $('#fee_Status_section_full' + feepaid_id).css("background-color", fullinfo[1]);
                            $.ajax({
                                url: 'pages/pay_fee/pay?action=fetch_student_fee_details',
                                type: 'POST',
                                data: $('#fetchStudentDataForm').serializeArray(),
                                success: function(result) {
                                    //$("#data_table").html(result);
                                    $('#response').remove();
                                    if (result == 0) {
                                        $('#error_section').append('<div id = "response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Please enter Registration Number!!!</div></div>');
                                    } else if (result == 1) {
                                        $('#error_section').append('<div id = "response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Please select Academic Year!!!</div></div>');
                                    } else {
                                        //$('#fetchStudentDataForm')[0].reset();
                                        $('#data_table').append('<div id = "response">' + result + '</div>');
                                    }
                                    $('#loading').fadeOut(500, function() {
                                        $(this).remove();
                                    });
                                    $('#fetchStudentDataButton').prop('disabled', false);
                                }
                            });
                        }
                    }
                });
            }
        </script>
    </div>
</div>
<!-- /.tab-pane -->