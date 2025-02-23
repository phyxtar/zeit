<?php
$visible = md5('visible');
include '../../include/config.php';
$spec = $_POST['data'];
?>
<option value="">Select</option>
<?php
$sql_spec = "SELECT * FROM `tbl_specialization`
WHERE `status` = '$visible' && `course_id` = '$spec'";
$result_spec = $con->query($sql_spec);

if (mysqli_num_rows($result_spec) > 0) {
    while ($row_spec = $result_spec->fetch_assoc()) {
        ?>
        
        <option value="<?php echo $row_spec["id"]; ?>"><?php echo $row_spec["sp_name"]; ?></option>
    <?php }
}
?>