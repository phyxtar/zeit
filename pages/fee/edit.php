<?php
include_once "../../include/config.php";
include_once "../../framwork/main.php";

$id = $_GET['id'];
$row = fetchRow('tbl_fee', ' fee_id=' . $id . ' && status="' . $visible . '"')
?>
<form id="edit_fee_form" role="form" method="POST">
    <div class="card-body">
        <div class="col-md-12" id="edit_error_section"></div>
        <div class="row">
            <input type="hidden" name="fee_id" value="<?= $id ?>">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Course Name</label>
                    <select name="course_id" id="edit_fee_course_name" class="form-control">
                        <?php
                        $sql_c = "SELECT * FROM `tbl_course` WHERE `status` = '$visible' ";
                        $result_c = $con->query($sql_c);
                        while ($row_c = $result_c->fetch_assoc()) {
                        ?>
                            <option value="<?php echo $row_c["course_id"]; ?>" <?php if ($row_c["course_id"] == $row["course_id"]) echo 'selected'; ?>><?php echo $row_c["course_name"]; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Particular</label>
                    <input required max="20" type="text" name="fee_particulars" id="edit_fee_particulars" class="form-control" value="<?php echo $row["fee_particulars"]; ?>">
                </div>

                <div class="form-group">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Amount</label>
                    <input type="text" name="fee_amount" id="edit_fee_amount" class="form-control" value="<?php echo $row["fee_amount"]; ?>">
                </div>

            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Fine</label>
                    <input type="text" name="fee_fine" id="edit_fee_fine" class="form-control" value="<?php echo $row["fee_fine"]; ?>">
                </div>

            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Fee Last Date</label>
                    <input type="date" name="fee_lastdate" class="form-control" value="<?php echo $row["fee_lastdate"]; ?>">
                </div>

            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>
                        Applicable Date</label>
                    <input type="date" name="applicable" class="form-control" value="<?php echo $row["applicable"]; ?>">
                </div>

            </div>
        </div>

        <button type="button" onclick="ajaxCall('edit_fee_form','<?= url('pages/fee/update') ?>','edit_fee_form')" id="edit_admin_button" class="btn btn-primary">Update</button>
    </div>
</form>