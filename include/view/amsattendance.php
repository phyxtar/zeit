<?php
// Include database connection
// include 'include/authentication.php';

// Courses Start
if (isset($_GET["action"]) && $_GET["action"] == "get_attendance") {
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
    <!-- Include DataTable CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <!-- Include FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    /* Modal Style */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
        /* Dark background */
    }

    .modal-content {
        background-color: #fefefe;
        margin: 10% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 40%;
        border-radius: 10px;
    }

    .modal-header {
        background-color: #007bff;
        color: white;
        padding: 10px;
        border-radius: 10px 10px 0 0;
    }

    .modal-footer {
        padding: 10px;
        text-align: right;
        border-radius: 0 0 10px 10px;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
    }

    button[type="submit"] {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: #0056b3;
    }

    label {
        font-weight: bold;
    }

    /* Modal Style */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .header-pop {
        background-color: currentColor;
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 40%;
        border-radius: 8px;
        /* Optional: for rounded corners */
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        /* Optional: add shadow */
    }

    .close {
        color: red;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    /* Optional: Style for the message container */
    #modalMessage {
        color: green;
        text-align: center;
        margin-bottom: 10px;
        font-weight: bold;
    }

    button[type="submit"] {
        background-color: #4CAF50;
        /* Green */
        color: white;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
    }

    button[type="submit"]:hover {
        background-color: #45a049;
    }

    input[type="text"] {
        padding: 8px;
        width: 100%;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    </style>
</head>

<body>
    <?php
    if (isset($_GET['status'])) {
        $status = $_GET['status'];
        if ($status == 'success') {
            echo '<div class="alert alert-success">Grade deleted successfully!</div>';
        } elseif ($status == 'error') {
            echo '<div class="alert alert-danger">Failed to delete grade. Please try again.</div>';
        }
    }
    ?>
    <table id="example1" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Grade ID</th>
                <th>Grade</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM `tbl_attendance`";
            $result = $con->query($sql);
            $s_no = 1; // Initialize serial number
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $s_no; ?></td>

                <td><?php echo htmlspecialchars($row["student_id"]); ?></td>

                <td>
                    <!-- Edit Button with Icon and Text -->
                    <button type="button" class="btn btn-primary btn-sm" title="Edit"
                        onclick="openEditModal('<?php echo $row['grade_id']; ?>', '<?php echo htmlspecialchars($row['grade_name']); ?>')">
                        <i class="fas fa-edit"></i> Edit
                    </button>

                    <!-- Delete Button with Icon and Text -->
                    <a href="delete_grade.php?id=<?php echo $row['grade_id']; ?>" class="btn btn-danger btn-sm"
                        title="Delete" onclick="return confirm('Are you sure you want to delete this grade?');">
                        <i class="fas fa-trash-alt"></i> Delete
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

    <!-- Modal for Editing Grade -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <div class='header-pop'>
                <span class="close " onclick="closeModal()">&times;</span>
                <h2 style="color: white;text-align: center;">Edit Grade</h2>
            </div>
            <!-- Message container for success or error message -->


            <form id="editGradeForm" style="margin: 10px;">
                <input type="hidden" id="grade_id" name="grade_id">
                <label for="grade_name">Grade Name:</label>
                <input type="text" id="grade_name" name="grade_name" required>
                <button type="submit" class='btn btn-sm'>Update</button>
            </form>
            <div id="modalMessage" style="text-align: center; margin-bottom: 10px; font-weight: bold;"></div>
        </div>
    </div>






    <!-- Include jQuery and DataTable JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script>
    $(document).ready(function() {
        // Initialize DataTable
        $("#example1").DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "pageLength": 50,
            "lengthMenu": [10, 25, 50, 100]
        });
    });

    // Function to open the modal
    function openEditModal(gradeId, gradeName) {
        // Set the values in the modal fields
        document.getElementById('grade_id').value = gradeId;
        document.getElementById('grade_name').value = gradeName;

        // Display the modal
        document.getElementById('editModal').style.display = "block";
    }

    // Function to close the modal
    function closeModal() {
        document.getElementById('editModal').style.display = "none";
    }

    // Handle form submission to update the grade
    $('#editGradeForm').submit(function(e) {
        e.preventDefault();

        var gradeId = $('#grade_id').val();
        var gradeName = $('#grade_name').val();

        // Send AJAX request to update grade name
        $.ajax({
            url: 'update_grade.php',
            type: 'POST',
            data: {
                grade_id: gradeId,
                grade_name: gradeName
            },
            success: function(response) {
                var message = "";
                var messageColor = "green";

                if (response == 'success') {
                    message = 'Grade name updated successfully!';
                } else {
                    message = 'Failed to update grade name.';
                    messageColor = "red";
                }

                // Display the message inside the modal
                $('#modalMessage').text(message).css('color', messageColor);

                // Optionally, close the modal after showing the message
                setTimeout(function() {
                    closeModal();
                    location.reload(); // Reload the page to reflect changes
                }, 2000); // Close the modal after 2 seconds
            }
        });
    });
    </script>
</body>

</html>
<?php
}
// Courses End
?>