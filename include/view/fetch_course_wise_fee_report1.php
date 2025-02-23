<?php
  if ($_GET["action"] == "fetch_fee_list_details") {
    $course_id = $_POST["course_id"];
    $academic_year = $_POST["academic_year"];
?>

    <div class="card">
        <div class="card-header">
            <form method="POST" action="export_course_yearwise.php">
                <input type="hidden" name="course_id" value="<?= $course_id ?>" />
                <input type="hidden" name="academic_year" value="<?= $academic_year ?>" />
                <input type="hidden" name="action" value="export_fees_details" />
                <button type="submit" class="btn btn-warning float-right"><i class="fa fa-download"></i> Export All</button>
            </form>
        </div>
    </div>
    <table id="example1" class="table table-bordered table-striped display" style="width:100%;">
        <!--<table id="example" class="table table-bordered table-striped display" style="width:100%;">-->
        <!-- <table id="dtHorizontalExample" class="table table-bordered table-striped">-->
        <thead>
            <tr>
                <th width="10%">S.Nos</th>
                <th width="10%">Reg. No</th>
                <th width="10%">Course</th>
                <th width="10%">Student Name</th>
                <th width="10%">Fees Details</th>
                <th width="10%">Status</th>
            </tr>
        </thead>
        <tbody id="myTable">
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
                        <td><?php echo $s_no; ?></td>
                        <?php
                        $sql_course = "SELECT * FROM `tbl_course`
                                                   WHERE `status` = '$visible' && `course_id` = '" . $row["admission_course_name"] . "';
                                                   ";
                        $result_course = $con->query($sql_course);
                        $row_course = $result_course->fetch_assoc();
                        ?>
                        <td><?php echo $row["admission_id"] ?></td>
                        <td><?php echo $row_course["course_name"] ?></td>
                        <td><?php echo $row["admission_first_name"] ?> <?php echo $row["admission_middle_name"] ?> <?php echo $row["admission_last_name"] ?></td>
                        <td>
                            <table>
                                <thead>
                                    <tr>
                                        <th width="10%">S.No</th>
                                        <th width="10%">Particular Name</th>
                                        <th width="10%">Amount </th>
                                        <th width="10%">Paid</th>
                                        <th width="10%">Rebate</th>
                                        <th width="10%">Fine</th>
                                        <th width="10%">Balance</th>
                                        <th width="10%">Fee Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $arrayFee = array(); //In Amount or In Number
                                    $arrayFine = array(); //In Amount or In Number
                                    $arrayRemaining = array(); //In Amount or In Number
                                    $arrayRebate = array(); //In Amount or In Number
                                    $totalFee = 0; //In Amount or In Number
                                    $totalFine = 0; //In Amount or In Number
                                    $totalRemaining = 0; //In Amount or In Number
                                    $totalRemainings = 0; //In Amount or In Number
                                    $totalRebate = 0; //In Amount or In Number
                                    $totalPaid = 0; //In Amount or In Number
                                    //String Variables
                                    $arrayPerticular = array();
                                    $arrayTblFee = array();
                                    $objTblFee = "";
                                    //Checking If Hostel If Available Or Not
                                    if (strtolower($row["admission_hostel"]) == "yes")
                                        $sqlTblFee = "SELECT *
                                                             FROM `tbl_fee`
                                                             WHERE `status` = '$visible' AND `course_id` = '" . $row["admission_course_name"] . "' AND `fee_academic_year` = '" . $row["admission_session"] . "' ORDER BY `fee_particulars` ASC
                                                             ";
                                    else
                                        $sqlTblFee = "SELECT *
                                                             FROM `tbl_fee`
                                                             WHERE `status` = '$visible' AND `course_id` = '" . $row["admission_course_name"] . "' AND `fee_academic_year` = '" . $row["admission_session"] . "' AND `fee_particulars` NOT IN ('HOSTEL FEE', 'hostel fee', 'Hostel Fee', 'HOSTELS FEES', 'hostels fees', 'Hostels Fees', 'HOSTELS FEE', 'hostels fee', 'Hostels Fee', 'HOSTEL FEES', 'hostel fees', 'Hostel Fees', '1st Year Hostel Fee', '1ST YEAR HOSTEL FEE', '2nd Year Hostel Fee', '2ND YEAR HOSTEL FEE', '3rd Year Hostel Fee', '3RD YEAR HOSTEL FEE', '4th Year Hostel Fee', '4TH YEAR HOSTEL FEE', '5th Year Hostel Fee', '5TH YEAR HOSTEL FEE', '6th Year Hostel Fee', '6TH YEAR HOSTEL FEE','Caution Fee','caution fee','caution','Caution') ORDER BY `fee_particulars` ASC
                                                             ";
                                    $resultTblFee = $con->query($sqlTblFee);
                                    if ($resultTblFee->num_rows > 0)
                                        while ($rowTblFee = $resultTblFee->fetch_assoc()) {
                                            $totalFee = $totalFee + intval($rowTblFee["fee_amount"]);
                                            if (strtotime(date($rowTblFee["fee_lastdate"])) < strtotime(date("Y-m-d")))
                                                $noOfDays = (strtotime(date("Y-m-d")) - strtotime(date($rowTblFee["fee_lastdate"]))) / 60 / 60 / 24;
                                            else
                                                $noOfDays = 0;
                                            if ($rowTblFee["fee_astatus"] == "Active")
                                                $fine_particular = $rowTblFee["fee_fine"];
                                            else
                                                $fine_particular = 0;
                                            $completeArray = array(
                                                "fee_id" => $rowTblFee["fee_id"],
                                                "fee_particulars" => $rowTblFee["fee_particulars"],
                                                "fee_amount" => $rowTblFee["fee_amount"],
                                                "fee_paid" => 0,
                                                "fee_fine" => $fine_particular,
                                                "fee_rebate" => 0,
                                                "fee_remaining" => $rowTblFee["fee_amount"],
                                                "fee_fine_days" => $noOfDays
                                            );
                                            array_push($arrayTblFee, $completeArray);
                                        }
                                    $arrayTblFee = json_decode(json_encode($arrayTblFee));
                                    $sqlTblFeePaid = "SELECT *
                                                             FROM `tbl_fee_paid`
                                                             WHERE `status` = '$visible' AND `student_id` = '" . $row["admission_id"] . "' AND `payment_status` IN ('cleared', 'pending')
                                                             ";
                                    $resultTblFeePaid = $con->query($sqlTblFeePaid);
                                    if ($resultTblFeePaid->num_rows > 0)
                                        while ($rowTblFeePaid = $resultTblFeePaid->fetch_assoc()) {
                                            $arrayPaidId = explode(",", $rowTblFeePaid["particular_id"]);
                                            $arrayPaidAmount = explode(",", $rowTblFeePaid["paid_amount"]);
                                            for ($i = 0; $i < count($arrayPaidId); $i++) {
                                                foreach ($arrayTblFee as $arrayTblFeeUpdate) {
                                                    if ($arrayTblFeeUpdate->fee_id == $arrayPaidId[$i]) {
                                                        $totalPaid = $totalPaid + intval($arrayPaidAmount[$i]);
                                                        if ($rowTblFeePaid["rebate_amount"] != "") {
                                                            $arrayRebateAmount = explode(",", $rowTblFeePaid["rebate_amount"]);
                                                            if ($arrayTblFeeUpdate->fee_id == intval($arrayRebateAmount[1])) {
                                                                $totalRebate = $totalRebate + intval($arrayRebateAmount[0]);
                                                                $arrayTblFeeUpdate->fee_rebate = $arrayTblFeeUpdate->fee_rebate + intval($arrayRebateAmount[0]);
                                                            }
                                                        }
                                                        $arrayTblFeeUpdate->fee_paid = $arrayTblFeeUpdate->fee_paid + intval($arrayPaidAmount[$i]);
                                                        $arrayTblFeeUpdate->fee_remaining = $arrayTblFeeUpdate->fee_remaining - intval($arrayPaidAmount[$i]);
                                                    }
                                                }
                                            }
                                        }
                                    $tmpSNo = 1;
                                    foreach ($arrayTblFee as $arrayTblFeeUpdate) {
                                        if ((($arrayTblFeeUpdate->fee_remaining) - ($arrayTblFeeUpdate->fee_rebate)) == 0) {
                                            $totalRemainings = $totalRemainings + 0;
                                            $totalRemaining = $totalRemaining + 0;
                                            $totalFine = $totalFine + 0;
                                        } else {
                                            $totalRemainings = $totalRemainings + (($arrayTblFeeUpdate->fee_remaining) + (($arrayTblFeeUpdate->fee_fine) * ($arrayTblFeeUpdate->fee_fine_days)) - ($arrayTblFeeUpdate->fee_rebate));
                                            $totalRemaining = $totalRemaining + (($arrayTblFeeUpdate->fee_remaining) - ($arrayTblFeeUpdate->fee_rebate));
                                            $totalFine = $totalFine + (($arrayTblFeeUpdate->fee_fine) * ($arrayTblFeeUpdate->fee_fine_days));
                                        }

                                    ?>
                                        <tr>
                                            <td><?php echo $tmpSNo; ?></td>
                                            <td><?php echo $arrayTblFeeUpdate->fee_particulars; ?></td>
                                            <td>&#8377; <?php echo number_format($arrayTblFeeUpdate->fee_amount); ?></td>
                                            <td>&#8377; <?php echo number_format($arrayTblFeeUpdate->fee_paid); ?></td>
                                            <td>&#8377; <?php echo number_format($arrayTblFeeUpdate->fee_rebate); ?></td>
                                            <?php
                                            if ((($arrayTblFeeUpdate->fee_remaining) - ($arrayTblFeeUpdate->fee_rebate)) == 0) {
                                            ?>
                                                <td>&#8377; <?php echo 0; ?></td>
                                                <td>&#8377; <?php echo 0; ?></td>
                                                <?php
                                                $sqlTblFeeStatus = "SELECT *
                                                                                     FROM `tbl_fee_status`
                                                                                     WHERE `particular_id` = '" . $arrayTblFeeUpdate->fee_id . "' AND `admission_id` = '" . $row["admission_id"] . "' AND `course_id` = '" . $row["admission_course_name"] . "' AND `academic_year` = '" . $row["admission_session"] . "'
                                                                                     ";
                                                $resultTblFeeStatus = $con->query($sqlTblFeeStatus);
                                                if ($resultTblFeeStatus->num_rows > 0) {
                                                    $rowTblFeeStatus = $resultTblFeeStatus->fetch_assoc();
                                                    if (strtolower($rowTblFeeStatus["fee_status"]) == "dues") {
                                                ?>
                                                        <td> <button type="button" id="edit_fee_status_button<?= $arrayTblFeeUpdate->fee_id . "_" . $s_no ?>" class="btn btn-warning btn-sm"><span id="loader_id<?= $arrayTblFeeUpdate->fee_id . "_" . $s_no ?>"></span> Dues</button></td>
                                                        <!--<td><button type="button" class="btn btn-danger"><?= $rowTblFeeStatus["fee_status"] ?></button></td>-->
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <td> <button type="button" id="edit_fee_status_button<?= $arrayTblFeeUpdate->fee_id . "_" . $s_no ?>" class="btn btn-primary btn-sm"><span id="loader_id<?= $arrayTblFeeUpdate->fee_id . "_" . $s_no ?>"></span> No Dues</button></td>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <td> <button type="button" id="edit_fee_status_button<?= $arrayTblFeeUpdate->fee_id . "_" . $s_no ?>" class="btn btn-warning btn-sm"><span id="loader_id<?= $arrayTblFeeUpdate->fee_id . "_" . $s_no ?>"></span> Dues</button></td>
                                                <?php }
                                            } else {
                                                ?>
                                                <td>&#8377; <?php echo number_format(($arrayTblFeeUpdate->fee_fine) * ($arrayTblFeeUpdate->fee_fine_days)); ?></td>
                                                <!--<td>&#8377; <?php echo number_format(($arrayTblFeeUpdate->fee_remaining) - ($arrayTblFeeUpdate->fee_rebate)); ?></td>-->
                                                <td><span class="text-red text-bold">&#8377; <?php echo number_format(($arrayTblFeeUpdate->fee_remaining) + (($arrayTblFeeUpdate->fee_fine) * ($arrayTblFeeUpdate->fee_fine_days)) - ($arrayTblFeeUpdate->fee_rebate)); ?></span></td>
                                                <?php
                                                $sqlTblFeeStatus = "SELECT *
                                                                                             FROM `tbl_fee_status`
                                                                                             WHERE `particular_id` = '" . $arrayTblFeeUpdate->fee_id . "' AND `admission_id` = '" . $row["admission_id"] . "' AND `course_id` = '" . $row["admission_course_name"] . "' AND `academic_year` = '" . $row["admission_session"] . "'
                                                                                             ";
                                                $resultTblFeeStatus = $con->query($sqlTblFeeStatus);
                                                if ($resultTblFeeStatus->num_rows > 0) {
                                                    $rowTblFeeStatus = $resultTblFeeStatus->fetch_assoc();
                                                    if (strtolower($rowTblFeeStatus["fee_status"]) == "dues") {
                                                ?>
                                                        <td> <button type="button" id="edit_fee_status_button<?= $arrayTblFeeUpdate->fee_id . "_" . $s_no ?>" class="btn btn-warning btn-sm"><span id="loader_id<?= $arrayTblFeeUpdate->fee_id . "_" . $s_no ?>"></span> Dues</button></td>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <td> <button type="button" id="edit_fee_status_button<?= $arrayTblFeeUpdate->fee_id . "_" . $s_no ?>" class="btn btn-primary btn-sm"><span id="loader_id<?= $arrayTblFeeUpdate->fee_id . "_" . $s_no ?>"></span> No Dues</button></td>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <td> <button type="button" id="edit_fee_status_button<?= $arrayTblFeeUpdate->fee_id . "_" . $s_no ?>" class="btn btn-warning btn-sm"><span id="loader_id<?= $arrayTblFeeUpdate->fee_id . "_" . $s_no ?>"></span> Dues</button></td>



                                            <?php
                                                }
                                            } ?>
                                        </tr>
                                        <input type="hidden" id="particular_id<?= $arrayTblFeeUpdate->fee_id . "_" . $s_no ?>" value="<?= $arrayTblFeeUpdate->fee_id ?>">
                                        <input type="hidden" id="admission_id<?= $arrayTblFeeUpdate->fee_id . "_" . $s_no ?>" value="<?= $row["admission_id"] ?>">
                                        <input type="hidden" id="course_id<?= $arrayTblFeeUpdate->fee_id . "_" . $s_no ?>" value="<?= $row["admission_course_name"] ?>">
                                        <input type="hidden" id="academic_year<?= $arrayTblFeeUpdate->fee_id . "_" . $s_no ?>" value="<?= $row["admission_session"] ?>">

                                        <script>
                                            $(function() {
                                                $('#edit_fee_status_button<?= $arrayTblFeeUpdate->fee_id . "_" . $s_no ?>').click(function() {
                                                    $('#loader_id<?= $arrayTblFeeUpdate->fee_id . "_" . $s_no ?>').append('<img id = "edit_load" width="20px" src = "images/ajax-loader.gif" alt="Currently loading" />');
                                                    $('#edit_fee_status_button<?= $arrayTblFeeUpdate->fee_id . "_" . $s_no ?>').prop('disabled', true);

                                                    var dataString = "action=checkStatus&particular_id=" + $("#particular_id<?= $arrayTblFeeUpdate->fee_id . "_" . $s_no ?>").val() + "&admission_id=" + $("#admission_id<?= $arrayTblFeeUpdate->fee_id . "_" . $s_no ?>").val() + "&course_id=" + $("#course_id<?= $arrayTblFeeUpdate->fee_id . "_" . $s_no ?>").val() + "&academic_year=" + $("#academic_year<?= $arrayTblFeeUpdate->fee_id . "_" . $s_no ?>").val();

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
                                                                    url: 'include/view.php?action=fetch_fee_list_details',
                                                                    type: 'POST',
                                                                    data: $('#fetchFeeDataForm').serializeArray(),
                                                                    success: function(result) {
                                                                        $('#response').remove();
                                                                        $('#data_table').html('<div id = "response">' + result + '</div>');
                                                                    }
                                                                });
                                                            }
                                                            $('#loader_id<?= $arrayTblFeeUpdate->fee_id . "_" . $s_no ?>').fadeOut(500, function() {
                                                                $(this).remove();
                                                                $('#edit_fee_status_button<?= $arrayTblFeeUpdate->fee_id . "_" . $s_no ?>').prop('disabled', false);
                                                            });

                                                        }

                                                    });
                                                });

                                            });
                                        </script>
                                    <?php
                                        $tmpSNo++;
                                    }
                                    ?>

                                </tbody>
                            </table>
                        <td> <button type="button" id="edit_exam_status_button<?php echo $rowTblFeeStatus["fee_status_id"]; ?>" class="btn <?php if ($rowTblFeeStatus["exam_status"] == "Approve") echo "btn-primary";
                                                                                                                                            else echo "btn-warning" ?> btn-sm"><span id="loader_id<?php echo $rowTblFeeStatus["fee_status_id"]; ?>"></span> <?php if ($rowTblFeeStatus["exam_status"] == "Approve") echo "Approve";
                                                                                                                                                                                                                                                                                                                                        else echo "Not Approve" ?></button></td>
                        <input type='hidden' name='exam_status' id="exam_status<?php echo $rowTblFeeStatus["fee_status_id"]; ?>" value='<?php echo $rowTblFeeStatus["exam_status"] ?>' />
                        <input type='hidden' name='admission_id' id="admission_id<?php echo $row["admission_id"]; ?>" value='<?php echo $row["admission_id"] ?>' />

                        <script>
                            $(function() {
                                $('#edit_exam_status_button<?php echo $rowTblFeeStatus["fee_status_id"]; ?>').click(function() {
                                    $('#loader_id<?php echo $rowTblFeeStatus["fee_status_id"]; ?>').append('<img id = "edit_load" width="20px" src = "images/ajax-loader.gif" alt="Currently loading" />');
                                    $('#edit_exam_status_button<?php echo $rowTblFeeStatus["fee_status_id"]; ?>').prop('disabled', true);
                                    var action = "examStatus";
                                    var admission_id = '<?php echo $row["admission_id"]; ?>';
                                    var fee_status_id = '<?php echo $rowTblFeeStatus["fee_status_id"]; ?>';
                                    var exam_status = '<?php echo $rowTblFeeStatus["fee_status_id"]; ?>';

                                    var dataString = 'action=' + action + '&admission_id=' + admission_id + '&fee_status_id=' + fee_status_id + '&exam_status=' + exam_status;

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
                                                    url: 'include/view.php?action=fetch_fee_list_details',
                                                    type: 'POST',
                                                    data: $('#fetchFeeDataForm').serializeArray(),
                                                    success: function(result) {
                                                        $('#response').remove();
                                                        $('#data_table').append('<div id = "response">' + result + '</div>');
                                                    }

                                                });

                                            }
                                            $('#loader_id<?php echo $rowTblFeeStatus["fee_status_id"]; ?>').fadeOut(500, function() {
                                                $(this).remove();
                                                $('#edit_exam_status_button<?php echo $rowTblFeeStatus["fee_status_id"]; ?>').prop('disabled', false);
                                            });

                                        }

                                    });

                                });
                            });
                        </script>
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
?>