               <!-- if student are rejoin to the hostel then this information will show -->
               <?php
                                                $query = ' SELECT * FROM `tbl_student_hostel_leave` WHERE `student_id`=' . $row['admission_id'] . '  && `re_join_date`!="" order by id desc';
                                                $hostel_date_result = mysqli_fetch_array(mysqli_query($con, $query));
                                                if ($hostel_date_result != '') {
                                                ?>
                                                    <script>
                                                        alert(' <?= $row["admission_first_name"] . " " . $row["admission_last_name"]; ?> has rejoined hostel on <?= date('d-m-Y', strtotime($hostel_date_result['re_join_date']))  ?>  Previous HOSTEL FEES details are as below \n\n  As Rejoing date is after the previous fees addition to the portal you need to first make an update to the last hostel fees   ');
                                                    </script>

                                                <?php } ?>
                                                <h5>Pay Remaining<b><a href="javascript:void(0);"> Fee</a></b></h5>
                                                <p id="errorMessage" class="text-red"></p>
                                                <table class="table table-bordered table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>S.No</th>
                                                            <th>Particulars</th>
                                                            <th>Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $tmpSNo = 1;
                                                        $Idno = 0;

                                                        foreach ($arrayTblFee as $arrayTblFeeUpdate) {

                                                        ?>
                                                            <tr>
                                                                <td><?php echo $tmpSNo; ?></td>
                                                                <td><?php echo $arrayTblFeeUpdate->fee_particulars; ?></td>
                                                                <td>


                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">&#8377;</span>
                                                                        </div>
                                                                        <input id="particular_paid_amount[<?php echo $Idno; ?>]" name="particular_paid_amount[<?php echo $Idno; ?>]" min="0" max="<?php //echo (($arrayTblFeeUpdate->fee_remaining) - ($arrayTblFeeUpdate->fee_rebate)); 
                                                                                                                                                                                                    ?>" type="number" class="form-control" onKeyup="completeCalculation();" onClick="completeCalculation();" onChange="completeCalculation();" onBlur="completeCalculation();" <?php if ((($arrayTblFeeUpdate->fee_remaining) - ($arrayTblFeeUpdate->fee_rebate)) == 0) echo "readonly"; ?>>

                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                            $Idno++;
                                                            $tmpSNo++;
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $tmpSNo; ?></td>
                                                            <td>Fine</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">&#8377;</span>
                                                                    </div>
                                                                    <input value="<?php echo $totalFine ?>" id="fine_amount1" name="fine_amount" min="0" max="<?php echo $totalFine; ?>" type="hidden">
                                                                    <input value="" id="fine_amount" name="fine_amount" min="0" max="<?php echo $totalFine; ?>" type="number" class="form-control" onKeyup="completeCalculation();" onClick="completeCalculation();" onChange="completeCalculation();" onBlur="completeCalculation();" <?php if ($totalFine == 0) echo "readonly"; ?>>

                                                                    <div class="input-group-prepend">
                                                                        <select id="fine_from" onchange="fine_by_remain(this.value)" name="fine_from" class="btn btn-default btn-block form-control">
                                                                            <option selected disabled>Fine For</option>
                                                                            <?php
                                                                            foreach ($arrayTblFee as $arrayTblFeeUpdate) {
                                                                            ?>
                                                                                <option value="<?php echo $arrayTblFeeUpdate->fee_id; ?>">For - <?php echo $arrayTblFeeUpdate->fee_particulars; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo ++$tmpSNo; ?></td>
                                                            <td>Extra Fine</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">&#8377;</span>
                                                                    </div>
                                                                    <input id="extra_fine" name="extra_fine" min="0" max="" type="number" class="form-control">
                                                                    <div class="input-group-prepend">
                                                                        <input type="text" name="extra_fine_description" placeholder="Extra Fine Description" class="form-control" style="border: 2px solid #dc3545; width: 400px" />
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo ++$tmpSNo; ?></td>
                                                            <td>Rebate</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">&#8377;</span>
                                                                    </div>
                                                                    <input id="rebate_amount" name="rebate_amount" min="0" max="" type="number" class="form-control" onKeyup="completeCalculation();" onClick="completeCalculation();" onChange="completeCalculation();" onBlur="completeCalculation();">
                                                                    <div class="input-group-prepend">
                                                                        <select id="rebate_from" name="rebate_from" class="btn btn-default btn-block form-control" onKeyup="completeCalculation();" onClick="completeCalculation();" onChange="completeCalculation();" onBlur="completeCalculation();">
                                                                            <option value="">Rebate From</option>
                                                                            <?php
                                                                            foreach ($arrayTblFee as $arrayTblFeeUpdate) {
                                                                            ?>
                                                                                <option value="<?php echo $arrayTblFeeUpdate->fee_id; ?>">From - <?php echo $arrayTblFeeUpdate->fee_particulars; ?></option>
                                                                            <?php } ?>
                                                                            <option value="fine">From - Fine</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <small class="text-red" id="rebateErr"></small>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td class="text-right text-bold">Total</td>
                                                            <td class="text-bold">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">&#8377;</span>
                                                                    </div>
                                                                    <input id="total_amount" name="total_amount" min="0" max="<?php echo $totalRemainings ?>" type="number" class="form-control" readonly>
                                                                </div>
                                                                <small class="text-red" id="totalErr"></small>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td class="text-right text-bold">Remaining</td>
                                                            <td class="text-bold">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">&#8377;</span>
                                                                    </div>
                                                                    <input id="remaining_amount" name="remaining_amount" min="0" value="<?php echo $totalRemainings ?>" type="number" style="font-weight: 900;color: #dc3545;" class="form-control" readonly>
                                                                </div>
                                                                <small class="text-red" id="remainingErr"></small>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>