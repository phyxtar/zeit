<?php
                            $id = $row['admission_id'];
                            $fee_status_data = fetchRow('tbl_fee_status', ' admission_id=' . $id . '');

                            // Initialize variable to check if the first installment fee is paid
                            $first_semester_fee_paid = false;

                            foreach ($arrayTblFee as $arrayTblFeeUpdate) {
                                if ($arrayTblFeeUpdate->fee_particulars === '1st Installment Fee') {
                                    if (((int) $arrayTblFeeUpdate->fee_remaining - (int) $arrayTblFeeUpdate->fee_rebate) === 0) {
                                        $first_semester_fee_paid = true;
                                        break; // Exit the loop once found
                                    }
                                }
                            }

                            // Determine reg_status and update or insert in the database accordingly
                            if ($first_semester_fee_paid) {
                                $reg_status = "Approve";

                                // Check if the record exists
                                if ($fee_status_data) {
                                    // Update the existing record
                                    $update_status = "UPDATE `tbl_fee_status` 
                              SET `reg_status` = 'Approve' 
                              WHERE `admission_id` = '" . $id . "'";
                                    $result_update = $con->query($update_status);

                                    // Check if the update was successful
                                    if (!$result_update) {
                                        error_log("Database Update Error for admission_id {$id}: " . $con->error);
                                    }
                                } else {
                                    // Insert a new record if it doesn't exist
                                    $insert_status = "INSERT INTO `tbl_fee_status` (`admission_id`, `reg_status`) 
                              VALUES ('" . $id . "', 'Approve')";
                                    $result_insert = $con->query($insert_status);

                                    // Check if the insert was successful
                                    if (!$result_insert) {
                                        error_log("Database Insert Error for admission_id {$id}: " . $con->error);
                                    }
                                }
                            } else {
                                // If not approved, check existing status
                                if ($fee_status_data) {
                                    $reg_status = $fee_status_data['reg_status'];
                                } else {
                                    $reg_status = "Not Approve";

                                    // Insert a new record if it doesn't exist
                                    $insert_status = "INSERT INTO `tbl_fee_status` (`admission_id`, `reg_status`) 
                              VALUES ('" . $id . "', 'Not Approve')";
                                    $result_insert = $con->query($insert_status);

                                    // Check if the insert was successful
                                    if (!$result_insert) {
                                        error_log("Database Insert Error for admission_id {$id}: " . $con->error);
                                    }
                                }
                            }
                            ?>