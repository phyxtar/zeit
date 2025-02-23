<?php
error_reporting(0);
include("include/authentication.php"); // Assuming the database connection is handled here.

if ($_GET["action"] == "get_registration_form") {
    $course_id = $_POST["course_id"];
    $academic_year = $_POST["academic_year"];
    $semester_id = $_POST["semester_id"]; // Ensure you have the semester ID if required.
    $admin_id = $_SESSION['admin_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <title>Registration Form</title>
</head>
<style>
/* Style for DataTable buttons */
.dt-button {
    background-color: #4CAF50;
    /* Green background */
    color: white;
    /* White text */
    border: none;
    /* No border */
    padding: 10px 15px;
    /* Button padding */
    font-size: 14px;
    /* Font size */
    border-radius: 5px;
    /* Rounded corners */
    cursor: pointer;
    /* Pointer cursor */
    margin-right: 5px;
    /* Add spacing between buttons */
}

.dt-button:hover {
    background-color: #45a049;
    /* Darker green on hover */
}
</style>

<body>
    <div class="row">
        <div class="col-md-12 d-flex justify-content-between">
            <div>
                <button id="approve-selected" class="btn btn-warning mb-2">Approve Selected</button>
                <button id="disapprove-selected" class="btn btn-danger mb-2">Disapprove Selected</button>
            </div>
            <div>
                <form method="POST" action="registration_slip_all">
                    <input type="hidden" name="course_id" value="<?= $course_id; ?>" />
                    <input type="hidden" name="academic_year" value="<?= $academic_year; ?>" />
                    <input type="hidden" name="semester_id" value="<?= $semester_id; ?>" />
                    <button type="submit" name="printall" class="btn btn-info">Print All</button>
                </form>
            </div>
        </div>
    </div>

    <table id="example1" class="table table-bordered table-striped table-responsive">
        <thead>
            <tr>
                <th><input type="checkbox" id="select-all"></th>
                <th>S.No</th>
                <th>Course</th>
                <th>Registration No</th>
                <th>Roll No</th>
                <th>Name</th>
                <th>Mobile No</th>
                <th>Father Name</th>
                <th>Paid Amount</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM `tbl_registration_form` WHERE `course_id` = '$course_id' AND `academic_year` = '$academic_year'";
            $result = $con->query($sql);
            $s_no = 1;

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $course_query = "SELECT course_name FROM `tbl_course` WHERE `course_id` = '" . $row["course_id"] . "'";
                    $course_result = $con->query($course_query);
                    $course_name = $course_result->num_rows > 0 ? $course_result->fetch_assoc()["course_name"] : "N/A";
            ?>
            <tr>
                <td><input type="checkbox" class="select-student" value="<?= $row['registration_id']; ?>"></td>
                <td><?= $s_no++; ?></td>
                <td><?= $course_name; ?></td>
                <td><?= $row["registration_no"]; ?></td>
                <td><?= $row["roll_no"]; ?></td>
                <td><?= $row["candidate_name"]; ?></td>
                <td><?= $row["mobile_no1"]; ?></td>
                <td><?= $row["father_name"]; ?></td>
                <td><?= $row["amount"]; ?></td>
                <td><?= $row["create_time"]; ?></td>
                <td>
                    <button class="btn btn-sm <?= $row['reg_status'] == 'Approve' ? 'btn-success' : 'btn-warning'; ?>"
                        id="status-btn-<?= $row['registration_id']; ?>"
                        onclick="toggleStatus(<?= $row['registration_id']; ?>)">
                        <?= $row['reg_status'] == 'Approve' ? 'Approved' : 'Not Approved'; ?>
                    </button>
                </td>
                <td class="d-flex">
                    <button type="button" class="btn btn-sm btn-success mx-1"
                        onclick="window.open('print_reg.php?admission_id=<?= $row['admission_id']; ?>', '_blank')"
                        title="Print Registration">
                        <i class="fas fa-print"></i>
                    </button>
                    <!-- <button type="button" class="btn btn-warning btn-sm mx-1"
                        onclick="showDocumentModal('<?= $row['admission_id']; ?>')" title="View Document">
                        <i class="fas fa-eye"></i>
                    </button> -->
                    <button type="button" class="btn btn-warning btn-sm mx-1"
                        onclick="window.location.href='download_all_documents.php?admission_id=<?= $row['admission_id']; ?>'"
                        title="Download Documents">
                        <i class="fas fa-download"></i>
                    </button>
                    <?php
                    $admin_id = $_SESSION['admin_id'];
                    if ($admin_id == 94) {
                    ?>
                    <button class="btn btn-info btn-sm" type="button" data-toggle="modal"
                        data-target="#edit_reg<?= $row['admission_id'] ?>">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <?php
                    }
                    ?>

                    <div id="edit_reg<?php echo $row["admission_id"]; ?>" class="w3-modal" style="z-index:2020;">
                        <div class="w3-modal-content w3-animate-top w3-card-4" style="width:60%">
                            <header class="w3-container" style="background:#343a40; color:white;">
                                <button data-dismiss="modal" aria-label="Close"
                                    class="  w3-button w3-display-topright">&times;</button>
                                <h2 align="center">Edit Registration</h2>
                            </header>
                            <form id="edit_reg<?php echo $row['admission_id']; ?>" role="form" method="POST"
                                action="include/view/edit_reg_form.php">
                                <div class="card-body">
                                    <?php
                                        $reg_id = $row['admission_id'];
                                        $sql_reg = "SELECT * FROM `tbl_registration_form` WHERE `admission_id` = '$reg_id'";
                                        $query_reg = mysqli_query($con, $sql_reg);
                                        $row_reg = $query_reg->fetch_assoc();
                                    ?>
                                    <input type="hidden" id="edit_reg_id" name="edit_reg_id"
                                        value="<?= $row['admission_id']; ?>">
                                    <div class="row">
                                        <!-- Student Name -->
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Student Name</label>
                                                <input type="text" name="edit_candidate_name" id="edit_candidate_name"
                                                    class="form-control" value="<?= $row_reg["candidate_name"]; ?>">
                                            </div>
                                        </div>
                                        <!-- Student Name -->
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Student Roll No</label>
                                                <input type="text" name="edit_candidate_roll" id="edit_candidate_roll"
                                                    class="form-control" value="<?= $row_reg["roll_no"]; ?>">
                                            </div>
                                        </div>
                                         <!-- Student Name -->
                                         <div class="col-4">
                                            <div class="form-group">
                                                <label>Student Reg No</label>
                                                <input type="text" name="edit_candidate_reg" id="edit_candidate_reg"
                                                    class="form-control" value="<?= $row_reg["registration_no"]; ?>">
                                            </div>
                                        </div>
                                        <!-- Father Name -->
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Father Name</label>
                                                <input type="text" name="edit_father_name" id="edit_father_name"
                                                    class="form-control" value="<?= $row_reg["father_name"]; ?>">
                                            </div>
                                        </div>
                                        <!-- Mother Name -->
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Mother Name</label>
                                                <input type="text" name="edit_mother_name" id="edit_mother_name"
                                                    class="form-control" value="<?= $row_reg["mother_name"]; ?>">
                                            </div>
                                        </div>
                                        <!-- ABC ID -->
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>ABC ID</label>
                                                <input type="text" name="edit_abc_id" id="edit_abc_id"
                                                    class="form-control" value="<?= $row_reg["abc_id"]; ?>">
                                            </div>
                                        </div>
                                        <!-- DOB -->
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>DOB</label>
                                                <input type="text" name="edit_dob" id="edit_dob" class="form-control"
                                                    value="<?= $row_reg["dob"]; ?>">
                                            </div>
                                        </div>
                                        <!-- Amount -->
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Amount</label>
                                                <input type="text" name="edit_amount" id="edit_amount"
                                                    class="form-control" value="<?= $row_reg["amount"]; ?>">
                                            </div>
                                        </div>
                                        <!-- Transaction ID -->
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Transaction ID</label>
                                                <input type="text" name="edit_transactionid" id="edit_transactionid"
                                                    class="form-control" value="<?= $row_reg["transactionid"]; ?>">
                                            </div>
                                        </div>
                                        <!-- Easebuzz ID -->
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Easebuzz ID</label>
                                                <input type="text" name="edit_easebuzzid" id="edit_easebuzzid"
                                                    class="form-control" value="<?= $row_reg["easebuzzid"]; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hidden Action -->
                                    <input type="hidden" name="action" value="edit_reg_form">
                                    <!-- Submit Button -->
                                    <button type="submit" id="edit_reg_button<?php echo $row['admission_id']; ?>"
                                        class="btn btn-primary mb-3">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>


                </td>
            </tr>
            <?php }
            } ?>
        </tbody>
    </table>
    <script>
    $(document).ready(function() {
        // Initialize DataTable with buttons
        var table = $('#example1').DataTable({
            dom: 'Bfrtip', // Enables the use of buttons
            buttons: [{
                    extend: 'copy',
                    text: 'Copy'
                },
                {
                    extend: 'csv',
                    text: 'Export CSV'
                },
                {
                    extend: 'excel',
                    text: 'Export Excel'
                },
                {
                    extend: 'pdf',
                    text: 'Export PDF'
                },
                {
                    extend: 'print',
                    text: 'Print'
                }
            ],
            // initComplete: function() {
            //     // Automatically trigger the export to Excel
            //     this.api().buttons(2).trigger();
            // }
        });

        // Select all functionality for checkboxes
        $('#select-all').click(function() {
            $('.select-student').prop('checked', this.checked);
        });
    });
    </script>
    <script>
    $(document).ready(function() {

        $('#approve-selected, #disapprove-selected').click(function() {
            const action = this.id === 'approve-selected' ? 'approve' : 'disapprove';
            const selected = $('.select-student:checked').map(function() {
                return $(this).val();
            }).get();

            if (selected.length === 0) {
                alert('Please select at least one student.');
                return;
            }

            $.post(`${action}_multiple.php`, {
                registration_ids: selected
            }, function(response) {
                if (response.trim() === 'success') location.reload();
                else alert(`Failed to ${action} selected students: ` + response);
            }).fail(() => alert('Failed to process request.'));
        });
    });

    function toggleStatus(registration_id) {
        $.post('updatereg_status.php', {
            registration_id
        }, function(response) {
            const btn = $(`#status-btn-${registration_id}`);
            if (response.trim() === 'Approve') {
                btn.removeClass('btn-warning').addClass('btn-success').text('Approved');
            } else if (response.trim() === 'Not Approve') {
                btn.removeClass('btn-success').addClass('btn-warning').text('Not Approved');
            } else {
                alert('Failed to update status.');
            }
        }).fail(() => alert('Failed to update status.'));
    }
    </script>
</body>

</html>
<?php
}
?>