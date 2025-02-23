<?php
if (isset($_GET["action"]) && $_GET["action"] == "get_amsteacher") {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher List</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <table id="example1" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Teacher Name</th>
                <th>Address</th>
                <th>Email Id</th>
                <th>Qualification</th>
                <th>Date Of Joining</th>
                <th>Assigned Classroom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <?php
        $sql = "SELECT ts.*, ts.teacher_grade_id, tg.grade_name 
                FROM tbl_teacher ts 
                LEFT JOIN tbl_grade tg 
                ON FIND_IN_SET(tg.grade_id, ts.teacher_grade_id) > 0";
        $result = $con->query($sql);
        $s_no = 1;
        ?>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $grades = [];
                    if (!empty($row["teacher_grade_id"])) {
                        $grade_ids = explode(',', $row["teacher_grade_id"]); 
                        foreach ($grade_ids as $grade_id) {
                            $grade_query = "SELECT grade_name FROM tbl_grade WHERE grade_id = '$grade_id'";
                            $grade_result = $con->query($grade_query);
                            if ($grade_result->num_rows > 0) {
                                while ($grade_row = $grade_result->fetch_assoc()) {
                                    $grades[] = $grade_row['grade_name']; 
                                }
                            }
                        }
                    }
                    $grade_names = implode(', ', $grades); 
            ?>
            <tr>
                <td><?php echo $s_no; ?></td>
                <td><?php echo htmlspecialchars($row["teacher_name"]); ?></td>
                <td><?php echo htmlspecialchars($row["teacher_address"]); ?></td>
                <td><?php echo htmlspecialchars($row["teacher_emailid"]); ?></td>
                <td><?php echo htmlspecialchars($row["teacher_qualification"]); ?></td>
                <td><?php echo htmlspecialchars($row["teacher_doj"]); ?></td>
                <td><span class="badge bg-warning"><?php echo htmlspecialchars($grade_names); ?></span></td>
                <td>
                    <button class="btn btn-primary btn-sm edit-btn" data-id="<?php echo $row['teacher_id']; ?>">
                        <i class="fas fa-edit"></i>
                    </button>
                    <a class="btn btn-danger btn-sm" href="include/view/delete_ams_teacher.php?id=<?=$row['teacher_id']?>" onclick="return confirm('Are you sure you want to delete this teacher?');">
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
            <td colspan="7" class="text-center">
                <div class="alert alert-warning alert-dismissible">
                    <i class="icon fas fa-exclamation-triangle"></i> No data available now!!!
                </div>
            </td>
        </tr>';
    }
    ?>
        </tbody>
    </table>
    <!-- Edit Teacher Modal -->
    <div class="modal fade" id="editTeacherModal" tabindex="-1" aria-labelledby="editTeacherModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTeacherModalLabel">Edit Teacher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editTeacherForm">
                        <input type="hidden" id="teacher_id" name="teacher_id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="teacher_name" class="form-label">Teacher Name</label>
                                    <input type="text" class="form-control" id="teacher_name" name="teacher_name"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="teacher_address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="teacher_address" name="teacher_address"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="teacher_emailid" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="teacher_emailid" name="teacher_emailid"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="teacher_qualification" class="form-label">Qualification</label>
                                    <input type="text" class="form-control" id="teacher_qualification"
                                        name="teacher_qualification" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="teacher_doj" class="form-label">Date of Joining</label>
                                    <input type="date" class="form-control" id="teacher_doj" name="teacher_doj"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="teacher_grade_id" class="form-label">Assigned Classroom Grade</label>
                            <select class="form-control" id="teacher_grade_id" name="teacher_grade_id[]" multiple
                                required>
                                <?php
                            $grade_query = "SELECT grade_id, grade_name FROM tbl_grade";
                            $grade_result = $con->query($grade_query);
                            while ($grade_row = $grade_result->fetch_assoc()) {
                                echo "<option value='" . $grade_row['grade_id'] . "'>" . htmlspecialchars($grade_row['grade_name']) . "</option>";
                            }
                            ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    $(document).ready(function() {
        $(".edit-btn").on("click", function() {
            const teacherId = $(this).data("id");
            $.ajax({
                url: "get_teacher_details.php", 
                method: "POST",
                data: {
                    id: teacherId
                },
                dataType: "json",
                success: function(response) {
                    $("#teacher_id").val(response.teacher_id);
                    $("#teacher_name").val(response.teacher_name);
                    $("#teacher_address").val(response.teacher_address);
                    $("#teacher_emailid").val(response.teacher_emailid);
                    $("#teacher_qualification").val(response.teacher_qualification);
                    $("#teacher_doj").val(response.teacher_doj);
                    const assignedGrades = response.teacher_grade_id.split(
                        ',');
                    $("#teacher_grade_id").val(
                        assignedGrades); 
                    $("#editTeacherModal").modal("show");
                },
                error: function() {
                    alert("Failed to fetch teacher details.");
                }
            });
        });
        $("#editTeacherForm").on("submit", function(e) {
            e.preventDefault();
            $.ajax({
                url: "update_teacher_details.php",
                method: "POST",
                data: $(this).serialize(), 
                success: function(response) {
                    alert(response); 
                    location.reload(); 
                },
                error: function() {
                    alert("Failed to update teacher details.");
                }
            });
        });
    });
    </script>
 <script>
    $(document).ready(function() {
        $("#example1").DataTable({
            "paging": true,
            "searching": true,
            "ordering": true, 
            "info": true,
            "autoWidth": false, 
        });
    });
    </script>
</body>

</html>
<?php
}
// Courses End
?>