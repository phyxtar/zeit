<?php
include_once "../../include/config.php";
include_once "../../framwork/main.php";
error_reporting(0);

if ($_GET["action"] == "fetch_fee_list_details") {
    $course_id = $_POST["course_id"];
    $academic_year = $_POST["academic_year"];
    $type = 'all';
    $s_no = 1;

    // Define the SQL query to fetch fee details, including fee_particulars and fee_amount
    if ($course_id == "all") {
        $sql = "SELECT 
                    fp.student_id,
                    CONCAT(la.admission_first_name, ' ', la.admission_middle_name, ' ', la.admission_last_name) AS student_name,
                    fee.fee_particulars,
                    fee.fee_amount,
                    SUM(fp.paid_amount) AS total_paid,
                    SUM(fp.rebate_amount) AS total_rebate,
                    SUM(fp.fine) AS total_fine,
                    SUM(fp.balance) AS total_balance
                FROM `tbl_fee_paid` fp
                LEFT JOIN `tbl_admission` la ON fp.student_id = la.admission_id
                LEFT JOIN `tbl_fee` fee ON fp.particular_id = fee.fee_id
                WHERE fp.status = '$visible' 
                    AND fp.university_details_id = '$academic_year'
                    AND la.stud_status = 1  -- Only active students
                GROUP BY fp.student_id, fee.fee_particulars, fee.fee_amount";
    } else {
        $sql = "SELECT 
                    fp.student_id,
                    CONCAT(la.admission_first_name, ' ', la.admission_middle_name, ' ', la.admission_last_name) AS student_name,
                    fee.fee_particulars,
                    fee.fee_amount,
                    SUM(fp.paid_amount) AS total_paid,
                    SUM(fp.rebate_amount) AS total_rebate,
                    SUM(fp.fine) AS total_fine,
                    SUM(fp.balance) AS total_balance
                FROM `tbl_fee_paid` fp
                LEFT JOIN `tbl_admission` la ON fp.student_id = la.admission_id
                LEFT JOIN `tbl_fee` fee ON fp.particular_id = fee.fee_id
                WHERE fp.status = '$visible' 
                    AND fp.university_details_id = '$academic_year' 
                    AND fp.course_id = '$course_id'
                    AND la.stud_status = 1  -- Only active students
                GROUP BY fp.student_id, fee.fee_particulars, fee.fee_amount";
    }

    // Execute the SQL query
    $result = $con->query($sql);

    // Initialize an array to hold student data
    $students = [];

    // Loop through the results and group fee particulars by student
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $student_id = $row['student_id'];
            if (!isset($students[$student_id])) {
                // If this is the first fee particular for this student, create a new entry
                $students[$student_id] = [
                    'student_name' => $row['student_name'],
                    'course_name' => "",  // Placeholder for course name
                    'fee_details' => []
                ];
            }

            // Fetch course name for this student (if it's not already fetched)
            if ($students[$student_id]['course_name'] == "") {
                $course_query = "SELECT course_name FROM tbl_course WHERE course_id = '$course_id'";
                $course_result = $con->query($course_query);
                if ($course_result->num_rows > 0) {
                    $course_row = $course_result->fetch_assoc();
                    $students[$student_id]['course_name'] = $course_row["course_name"];
                }
            }

            // Append the current fee particular to the student's fee details
            $students[$student_id]['fee_details'][] = [
                'fee_particulars' => $row['fee_particulars'],
                'fee_amount' => $row['fee_amount'],
                'total_paid' => $row['total_paid'],
                'total_rebate' => $row['total_rebate'],
                'total_fine' => $row['total_fine'],
                'total_balance' => $row['total_balance'],
            ];
        }
    }
?>

    <!-- DataTables and Search -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Styling for Table -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        table {
            width: 100%;
            margin: 0 auto;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #6c757d;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 12px;
        }

        /* .btn-primary {
        background-color: #28a745;
        border: none;
    } */
        .btn-warning {
            background-color: #ffc107;
            border: none;
        }

        .btn-sm:hover {
            opacity: 0.8;
        }
    </style>

    <!-- Table for displaying fee details -->
    <table id="example1" class="table table-bordered table-striped display" style="width:100%;">
        <thead>
            <tr>
                <th width="5%">S.No</th>
                <th width="10%">Reg. No</th>
                <th width="10%">Student Name</th>
                <th width="10%">Course</th>
                <th>Fee Details</th>
                <th>Regn Status</th> <!-- Added Regn Status column -->
                <th>Exam Status</th> <!-- Added Exam Status column -->
            </tr>
        </thead>
        <tbody id="myTable">
            <?php
            $s_no = 1;
            foreach ($students as $student_id => $student_data) {
                // Fetching reg_status and exam_status from tbl_fee_status for each student
                $status_query = "SELECT reg_status, exam_status FROM tbl_fee_status WHERE admission_id = '$student_id' LIMIT 1";
                $status_result = $con->query($status_query);
                $status_row = $status_result->fetch_assoc();
                $reg_status = $status_row['reg_status'] ?? 'Not Found';
                $exam_status = $status_row['exam_status'] ?? 'Not Found';
            ?>
                <tr>
                    <td><?php echo $s_no++; ?></td>
                    <td><?php echo $student_id; ?></td>
                    <td>
                        <?php echo $student_data['student_name']; ?>
                        <br>
                        <?php
                        // Fetch stud_status for the student
                        $status_query = "SELECT stud_status FROM tbl_admission WHERE admission_id = '$student_id'";
                        $status_result = $con->query($status_query);
                        if ($status_result->num_rows > 0) {
                            $status_row = $status_result->fetch_assoc();
                            echo ($status_row['stud_status'] == 1 ? '<span class="badge badge-success">Active</span>' : 'Inactive');
                        } else {
                            echo "Status: Not Found";
                        }
                        ?>
                    </td>
                    <td><?php echo $student_data['course_name']; ?></td>
                    <td>
                        <!-- Nested Table for Fee Details -->
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Fee Particulars</th>
                                    <th>Amount</th>
                                    <th>Paid</th>
                                    <th>Rebate</th>
                                    <th>Fine</th>
                                    <th>Balance</th>
                                    <th>Fee Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $fee_sno = 1;
                                foreach ($student_data['fee_details'] as $fee) {
                                    $total_paid = $fee['total_paid'] + $fee['total_rebate'] - $fee['total_fine'];
                                    $status = ($total_paid >= $fee['fee_amount']) ? 'No Dues' : 'Dues';
                                ?>
                                    <tr>
                                        <td><?php echo $fee_sno++; ?></td>
                                        <td><?php echo $fee['fee_particulars']; ?></td>
                                        <td><?php echo $fee['fee_amount']; ?></td>
                                        <td><?php echo $fee['total_paid']; ?></td>
                                        <td><?php echo $fee['total_rebate']; ?></td>
                                        <td><?php echo $fee['total_fine']; ?></td>
                                        <td><?php echo $fee['total_balance']; ?></td>
                                        <td>
                                            <?php
                                            if ($status == 'No Dues') {
                                                echo '<button type="button" class="btn btn-primary btn-sm">No Dues</button>';
                                            } else {
                                                echo '<button type="button" class="btn btn-warning btn-sm">Dues</button>';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </td>
                    <!-- Dynamic buttons for Regn and Exam Status -->
                    <td>
                        <button id="reg_status<?= $student_id ?>"
                            onclick="change_status_reg(<?= $student_id ?>, '<?= $reg_status ?>')"
                            class="btn btn-<?= $reg_status == 'Approve' ? 'success' : 'danger' ?> btn-sm">
                            <i id="reg_status-fa<?= $student_id ?>" class="fas fa-user-<?= $reg_status == 'Approve' ? 'check' : 'times' ?>"></i>
                        </button>
                    </td>
                    <td>
                        <button id="exam_status<?= $student_id ?>"
                            onclick="change_status_exam(<?= $student_id ?>, '<?= $exam_status ?>')"
                            class="btn btn-<?= $exam_status == 'Approve' ? 'success' : 'danger' ?> btn-sm">
                            <i id="exam_status-fa<?= $student_id ?>" class="fas fa-user-<?= $exam_status == 'Approve' ? 'check' : 'times' ?>"></i>
                        </button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#example1').DataTable({
                "paging": false, // Disable pagination
                "searching": true,
                "ordering": false,
                "info": true
            });
        });

        // JavaScript function to handle status change for Regn
        function change_status_reg(admission_id, current_status) {
            var new_status = (current_status == 'Approve') ? 'Reject' : 'Approve';
            // Update the button styles and icon dynamically
            var status_btn = $("#reg_status" + admission_id);
            var status_icon = $("#reg_status-fa" + admission_id);

            if (new_status == 'Approve') {
                status_btn.removeClass('btn-danger').addClass('btn-success');
                status_icon.removeClass('fa-times').addClass('fa-check');
            } else {
                status_btn.removeClass('btn-success').addClass('btn-danger');
                status_icon.removeClass('fa-check').addClass('fa-times');
            }

            // Optionally, make an AJAX request to update the status in the database
            $.post('update_status.php', {
                admission_id: admission_id,
                status_type: 'reg_status',
                status: new_status
            });
        }

        // JavaScript function to handle status change for Exam
        function change_status_exam(admission_id, current_status) {
            var new_status = (current_status == 'Approve') ? 'Reject' : 'Approve';
            // Update the button styles and icon dynamically
            var status_btn = $("#exam_status" + admission_id);
            var status_icon = $("#exam_status-fa" + admission_id);

            if (new_status == 'Approve') {
                status_btn.removeClass('btn-danger').addClass('btn-success');
                status_icon.removeClass('fa-times').addClass('fa-check');
            } else {
                status_btn.removeClass('btn-success').addClass('btn-danger');
                status_icon.removeClass('fa-check').addClass('fa-times');
            }

            // Optionally, make an AJAX request to update the status in the database
            $.post('update_status.php', {
                admission_id: admission_id,
                status_type: 'exam_status',
                status: new_status
            });
        }
    </script>
<?php } ?>