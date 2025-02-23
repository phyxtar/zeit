<?php
error_reporting(0);
include "../../framwork/main.php";
include_once "../../include/config.php";
$s_no = 1;

if ($_GET["action"] == "get_admin") {
    include_once "../../framwork/ajax/method.php";

    ?>


<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email ID</th>
            <th>Contact</th>
            <th>User Type</th>
            <th class="project-actions text-center">Action </th>
        </tr>
    </thead>
    <tbody>
        <?php
            $sql = "SELECT * FROM `tbl_admin`
                                WHERE `status` = '$visible' 
                                ORDER BY `admin_id` ASC
                                ";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
        <tr>
            <td>
                <?php echo $s_no; ?>
            </td>
            <td>
                <?php echo $row["admin_name"]; ?>
            </td>
            <td>
                <?php echo $row["admin_username"]; ?>
            </td>
            <td>
                <?php echo $row["admin_email"]; ?>
            </td>
            <td>
                <?php echo $row["admin_mobile"]; ?>
            </td>
            <td>
                <?php echo $row["admin_type"]; ?>
            </td>
            <td class="project-actions text-center">
                <?php
                $permissions = json_decode($_SESSION["authority"], true); 
                $loggedInUserType = $_SESSION['logger_type']; 

                if ((isset($permissions['2']) && in_array('2_4', explode('||', $permissions['2']))) || $loggedInUserType == 'admin') {
                    ?>
                    <button onclick="editForm('<?= url('pages/admin/edit') ?>', <?= $row['admin_id'] ?>, 'edit_form')"
                        type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModalCenter">
                        <i class="fas fa-edit"></i>
                    </button>
                    <?php
                }
                ?>

            <?php
                $permissions = json_decode($_SESSION["authority"], true); 
                $loggedInUserType = $_SESSION['logger_type']; 

                if ((isset($permissions['2']) && in_array('2_5', explode('||', $permissions['2']))) || $loggedInUserType == 'admin') {
                    ?>
                    <button id="success<?= $s_no ?>" class="btn btn-danger btn-sm"
                        onclick="deleteForm('<?= url('pages/admin/delete') ?>', '<?= $row['admin_id'] ?>', 'success<?= $s_no ?>')">
                        <i class="fas fa-trash"></i>
                    </button>
                    <?php
                }
                ?>
            </td>
        </tr>
        <?php
                    $s_no++;
                }
            } else {
                echo '
                                <div class="alert alert-warning alert-dismissible">
                                    <i class="icon fas fa-exclamation-triangle"></i>  No data available now!!!
                                </div>';
            }

            ?>
    </tbody>
</table>
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
} ?>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <header class="container" style="background:#343a40; color:white;">
                <button type="button" class="close pt-2 p-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h2 align="center">Edit Admin Details</h2>
            </header>

            <div class="modal-body" id="edit_form">
            </div>

        </div>
    </div>
</div>