<script>
    // i have making the function for on which of the semester to getting the fine
    function fine_by_remain(particular_id) {
        var particular_fine_remaining_amount = document.getElementById("particular_fine_remaining[" + particular_id + "]").value
        $("#fine_amount").val(particular_fine_remaining_amount);
    }

    function difference(date1, date2) {
        //    date1 is the lastdate
        //  date2

        const date1utc = Date.UTC(date1.getFullYear(), date1.getMonth(), date1.getDate());
        const date2utc = Date.UTC(date2.getFullYear(), date2.getMonth(), date2.getDate());

        day = 1000 * 60 * 60 * 24;


        total_days = Math.floor((date2utc - date1utc) / day);
        if (date1.getTime() < date2.getTime()) {
            return total_days
        } else {
            return 0;
        }

    }


    function completeCalculation() {
        var total_calculated_fine1 = 0;
        var total_calculated_fine = 0;

        var particular_fine_remaining_amount = 0;
        var total_fine_calculated_after = 0;
        var total_calculated_fine = 0;
        var particular_id = 0;
        var totalPaid = 0;
        var totalParticular = 0;
        var fineAmount = 0;
        var rebateAmount = Number(document.getElementById("rebate_amount").value);
        if (rebateAmount > 0) {
            if (document.getElementById("rebate_from").value == "") {
                $("#rebate_amount").addClass("is-invalid");
                $("#rebateErr").html("~ Please select 'Rebate From'");
            } else {
                $("#rebate_amount").removeClass("is-invalid");
                $("#rebateErr").html("");
            }
        } else {
            $("#rebate_amount").removeClass("is-invalid");
            $("#rebateErr").html("");
        }
        var remainingAmount = 0;
        <?php
        $Idno = 0;
        foreach ($arrayTblFee as $arrayTblFeeUpdate) {
        ?>
            if (document.getElementById("particular_paid_amount[<?php echo $Idno; ?>]").value != "")
                totalParticular = totalParticular + parseInt(document.getElementById("particular_paid_amount[<?php echo $Idno; ?>]").value);
        <?php
            $Idno++;
        }
        ?>
        if (document.getElementById("fine_amount").value != 0)
            fineAmount = parseInt(document.getElementById("fine_amount").value);
        totalPaidd = totalPaid + parseInt(totalParticular);
        totalPaid = totalPaidd + parseInt(fineAmount);
        paymentDate = document.getElementById("paymentDate").value; // get payment date

        //get Last date by id
        <?php
        $Idno = 0;

        foreach ($arrayTblFee as $arrayTblFeeUpdate) {
        ?>
            if (document.getElementById("particular_paid_lastDate[<?php echo $Idno; ?>]").value != "")
                lastDate = document.getElementById("particular_paid_lastDate[<?php echo $Idno; ?>]").value;
            fineAmount = document.getElementById("particular_paid_fineAmount[<?php echo $Idno; ?>]").value;
            amountparticularafterpaying = document.getElementById("particular_paid_amount1[<?php echo $Idno; ?>]").value;
            particular_paid_id1 = document.getElementById("particular_paid_id[<?php echo $Idno; ?>]").value
            // calling fine calculator function
            finecalculator(lastDate, amountparticularafterpaying, particular_paid_id1)
        <?php
            $Idno++;
        } ?>

        // fine calculator function
        function finecalculator(lastDate, particular_paid_amount1, particular_id) {



            if (particular_paid_amount1 != 0) {
                // console.log(particular_paid_amount1)

                date1 = new Date(lastDate)
                date2 = new Date(paymentDate)
                //   console.log(lastDate)
                // console.log(paymentDate)

                noOfDays = difference(date1, date2);
                particular_fine_remaining_amount = (fineAmount * noOfDays)

                document.getElementById("particular_fine_remaining[" + particular_id + "]").value = particular_fine_remaining_amount
                document.getElementById("particular_fine_for_database[" + particular_id + "]").value = particular_fine_remaining_amount

                total_calculated_fine = total_calculated_fine + Number(particular_fine_remaining_amount)
                //    console.log(total_calculated_fine)
            } else {
                particular_fine_remaining_amount = Number(document.getElementById("particular_fine_remaining[" + particular_id + "]").value)
                total_calculated_fine1 = total_calculated_fine1 + Number(particular_fine_remaining_amount);

                // console.log(total_calculated_fine1)

            }
        }

        // Total fine
        total_fine_calculated_after = Number(total_calculated_fine1) + Number(total_calculated_fine);

        total_fine_paying = Number(document.getElementById("fine_amount").value);
        //console.log(total_fine_calculated_after);

        remainingAmount = parseInt(<?php echo $totalRemaining; ?>) - parseInt(totalPaidd) - parseInt(rebateAmount) + parseInt(total_fine_calculated_after) - parseInt(total_fine_paying);






        $("#total_amount").val(totalPaid);
        $("#remaining_amount").val(remainingAmount);
        if (0 > parseInt(remainingAmount)) {
            $("#remaining_amount").addClass("is-invalid");
            $("#remainingErr").html("~ Cannot use negative value, Remaining value must be 'greater than or equal to 0'");
            $("#totalErr").html("~ Total value must be 'less than or equal to <?php echo $totalRemainings; ?>'");
            $("#total_amount").addClass("is-invalid");
        } else {
            $("#remaining_amount").removeClass("is-invalid");
            $("#total_amount").removeClass("is-invalid");
            $("#remainingErr").html("");
            $("#totalErr").html("");
        }
    }
</script>

<script>
    $(document).ready(function() {
        $('#PayFeeForm').submit(function(event) {
            $('#PayText').hide();
            $('#loader_section_on_pay_fee').append('<img id = "loading" width="30px" src = "images/ajax-loader.gif" alt="Currently loading" />');
            $('#PayFeeButton').prop('disabled', true);
            $.ajax({
                url: 'include/controller.php',
                type: 'POST',
                data: $('#PayFeeForm').serializeArray(),
                success: function(result) {
                    $('#response_on_pay_fee').remove();
                    if (result == "success") {
                        $('#error_on_pay_fee').append('<div id = "response_on_pay_fee"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Fee Paid Successfully!!!</div></div>');
                        $('#PayFeeForm')[0].reset();
                        $('#loading').fadeOut(1000, function() {
                            $(this).remove();
                            $('#PayText').show();
                            $('#PayFeeButton').prop('disabled', false);
                            console.log($('#fetchStudentDataForm').serializeArray())
                            $.ajax({
                                url: 'pages/pay_fee/pay?action=fetch_student_fee_details',
                                type: 'POST',
                                data: $('#fetchStudentDataForm').serializeArray(),
                                success: function(result) {


                                    //$("#data_table").html(result);

                                    $('#response').remove();

                                    if (result == 10) {
                                        $('#error_section').append('<div id = "response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Please enter Registration Number!!!</div></div>');
                                    } else if (result == 1) {
                                        $('#error_section').append('<div id = "response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Please select Academic Year!!!</div></div>');
                                    } else {
                                        // $('#fetchStudentDataForm')[0].reset();
                                        $('#data_table').append('<div id = "response">' + result + '</div>');
                                    }
                                    $('#loading').fadeOut(500, function() {
                                        $(this).remove();
                                    });
                                    $('#fetchStudentDataButton').prop('disabled', false);

                                }
                            });
                        });
                    } else
                        $('#error_on_pay_fee').append('<div id = "response_on_pay_fee">' + result + '</div>');
                    $('#loading').fadeOut(500, function() {
                        $(this).remove();
                        $('#PayText').show();
                        $('#PayFeeButton').prop('disabled', false);
                    });
                }
            });
            event.preventDefault();
        });
    });
</script>