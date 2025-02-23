<?php 
 if ($_GET["action"] == "fetch_fee_card_details") {
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
                            <th>Cheque/DD/Online No</th>
                            <th>Payment Status</th>
                            <!--<th>Receipt Number</th>-->
                            <th>Payment Date</th>
                            <th>Student Name</th>
                            <th>Rebate On</th>
                            <th>Rebate Amount</th>
                            <th>Paid Amount</th>
                            <th>Balance Amount</th>
                            <!--<th class="project-actions text-center">Action </th>-->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $result->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $s_no; ?></td>
                                <td><?php echo date("Y-m-d"); ?></td>
                                <td><?php echo strtoupper($row["payment_mode"]); ?></td>
                                <td><?php echo strtoupper($row["transaction_no"]); ?></td>
                                <td class="<?php if ($row["payment_status"] == "cleared") echo "bg-green";
                                            if ($row["payment_status"] == "bounced") echo "bg-red";
                                            if ($row["payment_status"] == "pending") echo "bg-yellow";
                                            if ($row["payment_status"] == "refunded") echo "bg-orange" ?> "><?php echo strtoupper($row["payment_status"]); ?></td>
                                <!--<td><span class="text-red text-bold"><?php echo $row["receipt_no"] ?></span></td>-->
                                <td><span class="text-red text-bold"><?php echo $row["receipt_date"] ?></span></td>
                                <?php
                                $sql_student = "SELECT * FROM `tbl_admission`
                                                        WHERE `status` = '$visible' && `admission_id` = '" . $row["student_id"] . "'
                                                        ";
                                $result_student = $con->query($sql_student);
                                $row_student = $result_student->fetch_assoc();
                                ?>
                                <td><?php echo $row_student["admission_first_name"] . " " . $row_student["admission_middle_name"] . " " . $row_student["admission_last_name"] ?></td>
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
                                    <td><?php echo $rebate_for; ?></td>
                                    <td><?php echo $rebateAmountArray[0]; ?></td>
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
                                <td><?php echo $sumAmount + intval($row["fine"]); ?></td>
                                <td><?php echo $row["balance"] ?></td>
                                <!--<td class="project-actions text-center">-->
                                <!--    <form action="print" method="POST">-->
                                <!--        <input type="hidden" name="paidId" value="<?php echo $row["feepaid_id"]; ?>" />-->
                                <!--        <button type="submit" class="btn btn-warning btn-sm">-->
                                <!--            <i class="fas fa-print">-->
                                <!--            </i>-->
                                <!--            Print Receipt-->
                                <!--        </button>-->
                                <!--        <button type="button" class="btn btn-danger btn-sm" onclick="document.getElementById('delete_print_receipts<?php echo $row["feepaid_id"]; ?>').style.display='block'">-->
                                <!--            <i class="fas fa-trash">-->
                                <!--            </i>-->
                                <!--            Delete-->
                                <!--        </button>-->
                                <!--    </form>-->

                                <!--</td>-->

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