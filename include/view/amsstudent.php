<?php
// Include database connection
// include 'include/authentication.php';

// Courses Start
if (isset($_GET["action"]) && $_GET["action"] == "get_Student") {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <!-- Include DataTable CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <!-- Include FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

<body>
    <style>

    </style>
    <table id="example1" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Student Name</th>
                <th>Roll No.</th>
                <th>Parent Mob. No.</th>
                <th>Alt No.</th>
                <th>Date Of Birth</th>
                <th>Grade</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "
            SELECT 
                ts.*, 
                tg.grade_name 
            FROM 
                tbl_students ts 
            LEFT JOIN 
                tbl_grade tg 
            ON 
                ts.student_grade_id = tg.grade_id
        ";
            $result = $con->query($sql);
            $s_no = 1; 
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $s_no; ?></td>
                <td><?php echo htmlspecialchars($row["student_name"]); ?></td>
                <td><?php echo htmlspecialchars($row["student_roll_number"]); ?></td>
                <td><?php echo htmlspecialchars($row["parent_mob_no_1"]); ?></td>
                <td><?php echo htmlspecialchars($row["parent_mob_no_2"]); ?></td>
                <td><?php echo htmlspecialchars($row["student_dob"]); ?></td>
                <td><?php echo htmlspecialchars($row["grade_name"]); ?></td>

                <td>
                    <a href="javascript:void(0);" class="btn btn-info btn-sm edit-btn"
                        data-id="<?= $row['student_id'] ?>" data-name="<?= htmlspecialchars($row['student_name']) ?>"
                        data-roll="<?= htmlspecialchars($row['student_roll_number']) ?>"
                        data-mob1="<?= htmlspecialchars($row['parent_mob_no_1']) ?>"
                        data-mob2="<?= htmlspecialchars($row['parent_mob_no_2']) ?>"
                        data-dob="<?= htmlspecialchars($row['student_dob']) ?>"
                        data-grade="<?= htmlspecialchars($row['student_grade_id']) ?>">
                        <i class="fas fa-edit"></i> Edit
                    </a>

                    <a href="delete_amsstudents.php?id=<?= $row['student_id'] ?>" class="btn btn-danger btn-sm"
                        onclick="return confirm('Are you sure you want to delete this student?');">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            <?php
                    $s_no++;
                }
            } else {
                echo '
                <tr>
                    <td colspan="3" class="text-center">
                        <div class="alert alert-warning alert-dismissible">
                            <i class="icon fas fa-exclamation-triangle"></i> No data available now!!!
                        </div>
                    </td>
                </tr>';
            }
            ?>
        </tbody>
    </table>
    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST">
                        <input type="hidden" name="student_id" id="student_id">
                        <div class="form-group">
                            <label for="student_name">Student Name:</label>
                            <input type="text" class="form-control" id="student_name" name="student_name" required>
                        </div>
                        <div class="form-group">
                            <label for="student_roll_number">Roll No.:</label>
                            <input type="text" class="form-control" id="student_roll_number" name="student_roll_number"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="parent_mob_no_1">Parent Mob. No.:</label>
                            <input type="text" class="form-control" id="parent_mob_no_1" name="parent_mob_no_1"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="parent_mob_no_2">Alt No.:</label>
                            <input type="text" class="form-control" id="parent_mob_no_2" name="parent_mob_no_2">
                        </div>
                        <div class="form-group">
                            <label for="student_dob">Date Of Birth:</label>
                            <input type="text" class="form-control" id="student_dob" name="student_dob" required>
                        </div>
                        <div class="form-group">
                            <label for="student_grade_id">Grade:</label>
                            <select class="form-control" id="student_grade_id" name="student_grade_id" required>
                                <!-- Grade options will be populated dynamically using PHP -->
                                <?php
                            $grade_sql = "SELECT * FROM tbl_grade";
                            $grade_result = $con->query($grade_sql);
                            while ($grade = $grade_result->fetch_assoc()) {
                                echo "<option value='{$grade['grade_id']}'>{$grade['grade_name']}</option>";
                            }
                            ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Student</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Include jQuery and DataTable JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <!-- Include Bootstrap JS (add this line) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <script>
    $(document).ready(function() {
        // Initialize DataTable with options
        $("#example1").DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true, // Enable column sorting
            "info": true, // Show table info
            "autoWidth": false, // Auto adjust column width
            "pageLength": 50, // Set default number of rows per page to 50
            "lengthMenu": [10, 25, 50, 100] // Options for rows per page
        });
    });

    $(document).ready(function() {
        // Delegate the event for dynamically loaded content (after pagination)
        $('#example1').on('click', '.edit-btn', function() {
            var studentId = $(this).data('id');
            var studentName = $(this).data('name');
            var studentRoll = $(this).data('roll');
            var parentMob1 = $(this).data('mob1');
            var parentMob2 = $(this).data('mob2');
            var studentDob = $(this).data('dob');
            var gradeId = $(this).data('grade');

            // Populate the modal fields
            $('#student_id').val(studentId);
            $('#student_name').val(studentName);
            $('#student_roll_number').val(studentRoll);
            $('#parent_mob_no_1').val(parentMob1);
            $('#parent_mob_no_2').val(parentMob2);
            $('#student_dob').val(studentDob);
            $('#student_grade_id').val(gradeId);

            // Show the modal
            $('#editModal').modal('show');
        });

        // Submit the form with AJAX
        $('#editForm').submit(function(e) {
            e.preventDefault(); // Prevent the form from submitting normally

            var formData = $(this).serialize(); // Collect form data

            $.ajax({
                url: 'update_amsstudent.php', // This is the PHP script that will handle the update
                type: 'POST',
                data: formData,
                success: function(response) {
                    alert(response); // Show success message or handle accordingly
                    $('#editModal').modal('hide'); // Hide the modal
                    location.reload(); // Reload the page to see updated data
                },
                error: function() {
                    alert('Error updating student data');
                }
            });
        });
    });
    </script>
</body>

</html>
<?php
}
// Courses End
?>