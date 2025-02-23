<?php
error_reporting(0);
if ($_GET["action"] == "get_reg") {
    $course_id = $_POST["course_id"];
    $academic_year = $_POST["academic_year"];
    $course_id = $_POST["course_id"];
    $academic_year = $_POST["academic_year"];
    ?>
<div class="row">
</div>
</div>
<table id="example1" class="table table-bordered table-striped table-responsive  " style="overflow-x:auto;">
    <thead>
        <tr>
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
            $sql = "SELECT * FROM `tbl_registration_form` WHERE `course_id` = '$course_id' && `academic_year` = '$academic_year' && `status` = '$visible'";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
        <tr>
            <td>
                <?php echo $s_no; ?>
            </td>
            <?php
                       
                        $sql_course = "SELECT * FROM `tbl_course`
               WHERE `status` = '$visible' AND `course_id` = '" . $row["course_id"] . "'";
                        $result_course = $con->query($sql_course);

                        if ($result_course->num_rows > 0) {
                            $row_course = $result_course->fetch_assoc();
                            $course_name = $row_course["course_name"];
                        } else {
                            // Handle the case where no matching course is found
                            $course_name = "N/A";
                        }
                        ?>
            <td>
                <?php echo $course_name; ?>

            </td>
            <td>
                <?php echo $row["registration_no"]; ?>
            </td>
            <td>
                <?php echo $row["roll_no"]; ?>
            </td>
            <td>
                <?php echo $row["candidate_name"]; ?>
            </td>
            <td>
                <?php echo $row["mobile_no1"]; ?>
            </td>
            <td>
                <?php echo $row["father_name"]; ?>
            </td>

            <td>
                <?php echo $row["amount"]; ?>
            </td>
            <td>
                <?php echo $row["create_time"]; ?>
            </td>
            <td>
                <?php if ($row["reg_status"] == "Approved") { ?>
                <button class="btn btn-sm btn-success toggle-status" data-id="<?php echo $row['reg_id']; ?>"
                    data-status="Approved">
                    Approved
                </button>
                <?php } else { ?>
                <button class="btn btn-sm btn-warning toggle-status" data-id="<?php echo $row['reg_id']; ?>"
                    data-status="Not Approved">
                    Not Approved
                </button>
                <?php } ?>
            </td>
            <script>
            $(document).ready(function() {
                // Handle status toggle
                $(".toggle-status").click(function() {
                    var button = $(this); // The button clicked
                    var reg_id = button.data("id"); // Get the registration ID
                    var current_status = button.data("status"); // Get the current status

                    // Determine the new status based on the current one
                    var new_status = (current_status == "Approved") ? "Not Approved" : "Approved";

                    // Send the AJAX request to update the status in the database
                    $.ajax({
                        url: 'updatereg_status.php', // You will need to create this file
                        type: 'POST',
                        data: {
                            reg_id: reg_id,
                            reg_status: new_status
                        },
                        success: function(response) {
                            if (response == "success") {
                                // Update the button text and class
                                button.text(new_status);
                                button.data("status",
                                    new_status); // Update the button data-status

                                // Change button class based on the new status
                                if (new_status == "Approved") {
                                    button.removeClass("btn-warning").addClass(
                                        "btn-success");
                                } else {
                                    button.removeClass("btn-success").addClass(
                                        "btn-warning");
                                }
                            } else {
                                alert("Error updating status. Please try again.");
                            }
                        }
                    });
                });
            });
            </script>



            <td class="project-actions text-center d-flex">
                <button type="button" class="btn btn-sm btn-success mx-1"
                    onclick="window.open('print_reg.php?admission_id=<?php echo $row['admission_id']; ?>', '_blank')">
                    <i class="fas fa-print"></i>
                </button>
            </td>

            <script>
            $("#see-button-<?= $row["exam_id"] ?>").click(function() {
                $("#view_exam_lists").css("display", "block");
                $('#see-section').html(
                    '<center id="see-loading"><img width="50px" src="images/ajax-loader.gif" alt="Loading..." /></center>'
                );
                var formData = {
                    "action": "fetchExaminationForms",
                    "id": "<?= $row["reg_id"] ?>"
                };
                $.ajax({
                    url: 'include/view.php',
                    type: 'GET',
                    data: formData,
                    success: function(data) {
                        $('#see-loading').fadeOut(500, function() {
                            $(this).remove();
                            $('#see-section').html(data);
                        });
                    }
                });
            });
            </script>


        </tr>
        <?php
                    $s_no++;
                }
            } else
                echo '
                                <div class="alert alert-warning alert-dismissible">
                                    <i class="icon fas fa-exclamation-triangle"></i>  No data available now!!!
                                </div>';
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
}