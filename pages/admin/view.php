<?php
error_reporting(0);
include "../../framwork/main.php";
include_once "../../include/config.php";
$s_no = 1;

if ($_GET["action"] == "get_admin") {
    include_once "../../framwork/ajax/method.php";

    ?>


<table id="example1" class="table table-striped">
    <thead>
        <tr>
            <th>User ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>User Type</th>
            <th>Department</th>
            <th>Join Date</th>
            <th>Last Login</th>
            <th>Status</th>
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
                <?php echo $row["user_id"]; ?>
            </td>
            <td>
                <?php echo $row["admin_name"]; ?>
            </td>
            <td>
                <?php echo $row["admin_email"]; ?>
            </td>
            <td>
    <?php
    $badgeColor = '#000'; // Default color (black)
    
    if (isset($row["admin_type"])) {
        switch ($row["admin_type"]) {
            case 'superadmin': // If stored as 'superadmin'
                $badgeColor = '#FF0004'; // Red
                break;
            case 'employee': 
                $badgeColor = '#23c6c8'; // Teal
                break;
            case 'customer':
                $badgeColor = '#f8ac59'; // Orange
                break;
            default:
                $badgeColor = '#000000'; // Black for unknown types
        }
    }
    ?>
    <span class="badge" style="background-color: <?php echo htmlspecialchars($badgeColor); ?>; color: white;">
        <?php echo htmlspecialchars($row["admin_type"] ?? 'Unknown'); ?>
    </span>
</td>

            <td>
                <?php echo $row["department"]; ?>
            </td>
            <td>
                <?php echo $row["join_date"]; ?>
            </td>
            <td>
                <?php echo $row["last_login"]; ?>
            </td>
            <td>
                <?php 
                if($row["status"] == "46cf0e59759c9b7f1112ca4b174343ef") {
                    echo '<span class="badge badge-primary">Active</span>';
                } else {
                    echo '<span class="badge badge-danger">Inactive</span>';
                }
                ?>
            </td>
            <td class="project-actions text-center">
                <?php
                $permissions = json_decode($_SESSION["authority"], true); 
                $loggedInUserType = $_SESSION['logger_type']; 

                // View button
                if ((isset($permissions['2']) && in_array('2_3', explode('||', $permissions['2']))) || $loggedInUserType == 'admin') {
                    ?>
                    <button onclick="viewForm('<?= url('pages/admin/view-details') ?>', <?= $row['admin_id'] ?>, 'view_form')"
                        type="button" style="background-color: #23c6c8; color:white;" class="btn btn-sm" data-toggle="modal" data-target="#viewModal">
                        <i class="fas fa-eye"></i>
                    </button>
                    <?php
                }

                // Edit button
                if ((isset($permissions['2']) && in_array('2_4', explode('||', $permissions['2']))) || $loggedInUserType == 'admin') {
                    ?>
                    <button onclick="editForm('<?= url('pages/admin/edit') ?>', <?= $row['admin_id'] ?>, 'edit_form')"
                        type="button" style="background-color: #f8ac59; color:white;" class="btn btn-sm" data-toggle="modal" data-target="#exampleModalCenter">
                        <i class="fas fa-edit"></i>
                    </button>
                    <?php
                }

                // Delete button 
                if ((isset($permissions['2']) && in_array('2_5', explode('||', $permissions['2']))) || $loggedInUserType == 'admin') {
                    ?>
                    <button style="background-color: #FF0004; color:white;" id="success<?= $s_no ?>" class="btn btn-sm"
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
<style>
    .page-item.active .page-link {
    z-index: 1;
    color: #fff;
    background-color: #ff0004 !important;
    border-color: #ff0004 !important;
}
</style>
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