<div class="row">
    <div class="col-md-3">
        <label>Payment Mode</label>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-university"></i></span>
                </div>
                <select id="PaymentMode" name="PaymentMode" class="form-control" onchange="PaymentModeSelect(this.value);">
                    <option value="0">Select</option>
                    <option value="Cash">Cash</option>
                    <option value="Cheque">Cheque</option>
                    <option value="DD">DD</option>
                    <option value="Online">Online</option>
                    <option value="NEFT/IMPS/RTGS">NEFT/IMPS/RTGS</option>
                </select>
            </div>
            <!-- /.input group -->
        </div>
    </div>
    <div class="col-md-3" id="cash_div" style="display:none">
        <label>Cash Deposit To</label>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-money-check"></i></span>
                </div>
                <select id="cashDepositTo" name="cashDepositTo" class="form-control">
                    <option value="0">Select</option>
                    <option value="University Office">University Office</option>
                    <option value="Deposit to Bank">Deposit to Bank</option>
                    <option value="City Office">City Office</option>
                </select>
            </div>
            <!-- /.input group -->
        </div>
    </div>
    <div class="col-md-3" id="bankName_div" style="display:none">
        <label>Bank Name</label>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-money-check"></i></span>
                </div>
                <input id="bankName" name="bankName" type="text" class="form-control" />
            </div>
            <!-- /.input group -->
        </div>
    </div>
    <div class="col-md-4" id="chequeNo_div" style="display:none">
        <label>Cheque/DD/NEFT/IMPS/RTGS No</label>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-cash-register"></i></span>
                </div>
                <input id="chequeAndOthersNumber" name="chequeAndOthersNumber" type="text" class="form-control" />
            </div>
            <!-- /.input group -->
        </div>
    </div>
    <div class="col-md-4" id="receiptDate_div" style="display:none">
        <label>Receipt Date</label>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                </div>
                <input id="paidDate" name="paidDate" type="date" class="form-control datepicker " value="<?php echo date("Y-m-d"); ?>" />
            </div>
            <!-- /.input group -->
        </div>
    </div>
    <div class="col-md-6" id="notes_div" style="display:none">
        <label>Notes</label>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-sticky-note"></i></span>
                </div>
                <textarea id="NotesByAdmin" name="NotesByAdmin" type="text" class="form-control"></textarea>
            </div>
            <!-- /.input group -->
        </div>
    </div>
    <div class="col-md-12"></div>
    <div class="col-md-12" id="error_on_pay_fee" style="margin-top:20px;"></div>
    <div class="col-md-3" id="pay_div" style="display:none; margin-top:20px;">
        <div class="form-group">
            <div class="input-group">
                <input type="hidden" name="action" value="pay_fees" />
                <button id="PayFeeButton" name="PayFeeButton" class="btn btn-primary btn-lg btn-block"><span id="loader_section_on_pay_fee"></span> <span id="PayText">Pay</span></button>
            </div>
            <!-- /.input group -->
        </div>
    </div>
    <div class="col-md-3" id="reset_div" style="margin-top:20px;">
        <div class="form-group">
            <div class="input-group">
                <button class="btn btn-danger btn-lg btn-block" type="reset" onclick="return confirm('Are you sure you want to reset all Informations???');">Reset</button>
            </div>
            <!-- /.input group -->
        </div>
    </div>


</div>

<script>
    function PaymentModeSelect(PaymentMode) {
        var cash_div = document.getElementById('cash_div');
        var bankName_div = document.getElementById('bankName_div');
        var chequeNo_div = document.getElementById('chequeNo_div');
        var receiptDate_div = document.getElementById('receiptDate_div');
        var notes_div = document.getElementById('notes_div');
        var pay_div = document.getElementById('pay_div');
        if (PaymentMode == "Cash") {
            cash_div.style.display = "block";
            bankName_div.style.display = "none";
            chequeNo_div.style.display = "none";
            receiptDate_div.style.display = "block";
            notes_div.style.display = "block";
            pay_div.style.display = "block";
        } else if (PaymentMode == "Cheque" || PaymentMode == "DD" || PaymentMode == "Online" || PaymentMode == "NEFT/IMPS/RTGS") {
            cash_div.style.display = "none";
            bankName_div.style.display = "block";
            chequeNo_div.style.display = "block";
            receiptDate_div.style.display = "block";
            notes_div.style.display = "block";
            pay_div.style.display = "block";
        } else {
            cash_div.style.display = "none";
            bankName_div.style.display = "none";
            chequeNo_div.style.display = "none";
            receiptDate_div.style.display = "none";
            notes_div.style.display = "none";
            pay_div.style.display = "none";
        }
    }
</script>