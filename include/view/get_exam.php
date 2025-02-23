<?php
if ($_GET["action"] == "get_exam") {
    $course_id = $_POST["course_id"];
    $academic_year = $_POST["academic_year"];
    $semester_id = $_POST["semester_id"];
    ?>
<div class="row">
    <div class="col-2">
        <form method="POST" action="export-exam">
            <input type="hidden" name="course_id" value="<?php echo $course_id; ?>" />
            <input type="hidden" name="academic_year" value="<?php echo $academic_year; ?>" />
            <input type="hidden" name="semester_id" value="<?php echo $semester_id; ?>" />
            <button type="submit" name="export" class="btn btn-info btn-sm rounded-pill"> Export to CSV </button>
        </form>
    </div>
    <div class="col-2">
        <form method="POST" action="exam_form_print">
            <input type="hidden" name="course_id" value="<?php echo $course_id; ?>" />
            <input type="hidden" name="academic_year" value="<?php echo $academic_year; ?>" />
            <input type="hidden" name="semester_id" value="<?php echo $semester_id; ?>" />
            <button type="submit" class="btn btn-lg btn-warning rounded-pill btn-sm">Print All</button>
        </form>
    </div>
</div>
</div>
<form method="POST" action="approve-examform" class='mt-5'>
    <div style="margin-bottom: 20px;">
        <input type="submit" name="approvedAll" class="btn btn-lg btn-warning" style="font-size: 15px;"
            value="Approved Selected">
        <input type="submit" name="disapprovedAll" class="btn btn-lg btn-warning" style="font-size: 15px;"
            value="Dispproved Selected">
    </div>
    <table id="example1" class="table table-bordered table-striped table-responsive  " style="overflow-x:auto;">
        <thead>
            <tr>
                <th class="text-center">
                    <input type="checkbox" id="selectall" />
                </th>
                <th>S.No</th>
                <th>Course</th>
                <th>Semester</th>
                <th>Registration No</th>
                <th>Roll No</th>
                <th>Name</th>
                <th>Father Name</th>
                <th>Department</th>
                <th>Paid Amount</th>
                <th>Registration Slip</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM `tbl_examination_form` WHERE `status` = '$visible' &&
                                `academic_year` = '$academic_year' && `course_id` = '$course_id' && `semester_id`='$semester_id'";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
            <tr>
                <td class="text-center">
                    <input type="checkbox" class="name" name="chkl[]" value="<?= $row["exam_id"] ?>" />
                </td>
                <td>
                    <?php echo $s_no; ?>
                </td>
                <?php
                        $sql_course = "SELECT * FROM `tbl_course`
                                                       WHERE `status` = '$visible' && `course_id` = '" . $row["course_id"] . "';
                                                       ";
                        $result_course = $con->query($sql_course);
                        $row_course = $result_course->fetch_assoc();
                        ?>
                <td>
                    <?php echo $row_course["course_name"]; ?>
                </td>
                <?php
                        $sql_sem = "SELECT * FROM `tbl_semester`
                                                       WHERE `status` = '$visible' && `semester_id` = '" . $row["semester_id"] . "';
                                                       ";
                        $result_sem = $con->query($sql_sem);
                        $row_sem = $result_sem->fetch_assoc();
                        ?>
                <td>
                    <?php echo $row_sem["semester"]; ?>
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
                    <?php echo $row["father_name"]; ?>
                </td>
                <td>
                    <?php echo $row["department"]; ?>
                </td>
                <td>
                    <?php echo $row["amount"]; ?>
                </td>

                <td>
                    <img src="student/images/regslip/<?php echo $row["doc_reg"]; ?>" alt="Registration Document"
                        style="width: 100%;filter: invert(0);">
                </td>
                <td>
                    <?php echo $row["create_time"]; ?>
                </td>
                <td>
                    <?php if ($row["verified_by"] == 'Verified'): ?>
                    <span class="badge badge-success"><?php echo $row["verified_by"]; ?></span>
                    <?php else: ?>
                    <span class="badge badge-danger"><?php echo $row["verified_by"]; ?></span>
                    <?php endif; ?>
                </td>
                <td class="project-actions text-center">
                    <a class="btn btn-info btn-sm" id="see-button-<?= $row["exam_id"] ?>">
                        <i class="fas fa-eye">
                        </i>
                    </a>

</form>
<!-- Edit button -->
<!-- Edit button -->
<a class="btn btn-info btn-sm edit_exam" id="edit-button-<?= $row["exam_id"] ?>" data-toggle="modal"
    data-target="#editModal" data-exam-id="<?= $row['exam_id'] ?>">
    <i class="fas fa-pencil"></i>
</a>


<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Exam</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form or content for editing -->
                <form action="include/view/update_exam.php" method="POST" id="update_exam_form">
                    <input type="hidden" id="examid" name="exam_id" />

                    <!-- Student Name -->
                    <div class="form-group">
                        <label for="student_name">Student Name</label>
                        <input type="text" class="form-control" id="examName" name="exam_name" required>
                    </div>

                    <!-- Amount -->
                    <div class="form-group">
                        <label for="exam_amount">Amount</label>
                        <input type="text" class="form-control" id="exam_amount" name="exam_amount" required>
                    </div>

                    <!-- Transaction ID -->
                    <div class="form-group">
                        <label for="exam_t_id">Transaction ID</label>
                        <input type="text" class="form-control" id="exam_t_id" name="exam_t_id" required>
                    </div>

                    <!-- Easebuzz ID -->
                    <div class="form-group">
                        <label for="exam_easebuzz_id">Easebuzz ID</label>
                        <input type="text" class="form-control" id="exam_easebuzz_id" name="exam_easebuzz_id" required>
                    </div>

                    <!-- Modal footer with buttons -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Save changes">
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $(".edit_exam").on("click", function() {
            var examId = $(this).data("exam-id");
            $.ajax({
                url: 'include/view/get_exam_data.php',
                type: 'GET',
                data: {
                    exam_id: examId
                },
                success: function(response) {
                    var data = JSON.parse(response);

                    if (data.success) {
                        $('#examid').val(data.examData.exam_id);
                        $('#examName').val(data.examData.candidate_name);
                        $('#exam_amount').val(data.examData.amount);
                        $('#exam_t_id').val(data.examData.transactionid);
                        $('#exam_easebuzz_id').val(data.examData.easebuzzid);
                    } else {
                        alert("Error: " + data.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching exam data: ", error);
                }
            });
        });
    });
    </script>

</div>
</div>
<!-- Courses Edit Section End -->


</td>
</form>





<SCRIPT language="javascript">
$(function() {
    // add multiple select / deselect functionality
    $("#selectall").click(function() {
        $('.name').attr('checked', this.checked);
    });
    // if all checkbox are selected, then check the select all checkbox
    // and viceversa
    $(".name").click(function() {
        if ($(".name").length == $(".name:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }
    });
});
</SCRIPT>
<script>
$("#see-button-<?= $row["exam_id"] ?>").click(function() {
    $("#view_exam_lists").css("display", "block");
    $('#see-section').html(
        '<center id="see-loading"><img width="50px" src="images/ajax-loader.gif" alt="Loading..." /></center>'
    );
    var formData = {
        "action": "fetchExaminationForm",
        "id": "<?= $row["exam_id"] ?>"
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
if ($_GET["action"] == "fetchExaminationForm") {
    $id = $_GET["id"];
    $sql = "SELECT * FROM `tbl_examination_form` WHERE `status` = '$visible' && `exam_id` = '" . $_GET["id"] . "'
            ";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();
    // $verifiedStatus = $row["verified_by"] == 1 ? "Verified" : "Not Verified";
    ?>

<center>
    <h2 style="color: #c70013;font-weight: bolder;"><img src="images/nsu.png" style="width: 160px;
    margin-left: 0px;"><b style="font-size: 40;">NETAJI SUBHAS UNIVERSITY</b></h2>
    <h2 style="color: #055ac3fc;font-weight: bolder;margin-top: -60px;">EXAMINATION FORM</h2>
    <h6 style="margin-top: -5px;">For University Campus Programme. </h6>
</center>
<form id="view_exam_list_form" role="form" method="POST" class="form-horizontal">
    <div class="card-body" style="margin-bottom: 50px;">
        <div class="col-md-12" id="edit_error_section"></div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group mb-1">
                        <label>&nbsp;&nbsp; Reg No:&nbsp;&nbsp;</label>
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["registration_no"][0]))
                                    echo strtoupper($row["registration_no"])[0]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["registration_no"][1]))
                                    echo strtoupper($row["registration_no"])[1]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["registration_no"][2]))
                                    echo strtoupper($row["registration_no"])[2]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["registration_no"][3]))
                                    echo strtoupper($row["registration_no"])[3]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["registration_no"][4]))
                                    echo strtoupper($row["registration_no"])[4]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["registration_no"][5]))
                                    echo strtoupper($row["registration_no"])[5]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["registration_no"][6]))
                                    echo strtoupper($row["registration_no"])[6]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["registration_no"][7]))
                                    echo strtoupper($row["registration_no"])[7]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["registration_no"][8]))
                                    echo strtoupper($row["registration_no"])[8]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["registration_no"][9]))
                                    echo strtoupper($row["registration_no"])[9]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["registration_no"][10]))
                                    echo strtoupper($row["registration_no"])[10]; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <img src="<?= url('student/images/student_images_new/') ?><?php echo $row["passport_photo"]; ?>"
                        alt="" style="margin-top: -47px;height:143px;width:116px" />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                </div>
            </div>
            <div class="col-md-6" style="margin-top: -64px;">
                <div class="form-group">
                    <div class="input-group mb-1">
                        <label>&nbsp;&nbsp; Roll No:&nbsp;&nbsp;</label>
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["roll_no"][0]))
                                    echo strtoupper($row["roll_no"])[0]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["roll_no"][1]))
                                    echo strtoupper($row["roll_no"])[1]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["roll_no"][2]))
                                    echo strtoupper($row["roll_no"])[2]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["roll_no"][3]))
                                    echo strtoupper($row["roll_no"])[3]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["roll_no"][4]))
                                    echo strtoupper($row["roll_no"])[4]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["roll_no"][5]))
                                    echo strtoupper($row["roll_no"])[5]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["roll_no"][6]))
                                    echo strtoupper($row["roll_no"])[6]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["roll_no"][7]))
                                    echo strtoupper($row["roll_no"])[7]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["roll_no"][8]))
                                    echo strtoupper($row["roll_no"])[8]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["roll_no"][9]))
                                    echo strtoupper($row["roll_no"])[9]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["roll_no"][10]))
                                    echo strtoupper($row["roll_no"])[10]; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                </div>
            </div>
        </div>
        <p style="margin-top: -35px;">To, <br>
            The Controller of Examinations,<br>
            Netaji Subhas University,<br>
            Pokhari, Jamshedpur-(JH).
        </p>
        <p>Sir,</p>
        <p style="letter-spacing: 2px;">I <b
                style="-webkit-text-decoration-line: underline; /* Safari */text-decoration-line: underline;">
                <?php echo strtoupper($row["candidate_name"]); ?>,
            </b> Son/Daughter/Wife of <b
                style="-webkit-text-decoration-line: underline; /* Safari */text-decoration-line: underline;">
                <?php echo strtoupper($row["father_name"]); ?>
            </b>, request permission to appear </p>
        <div class="row">
            <div class="col-md-4">
                <label>
                    <center>Course</center>
                </label>
                <?php
                    $sql_course = "SELECT * FROM `tbl_course`
                               WHERE `status` = '$visible' && `course_id` = '" . $row["course_id"] . "';
                               ";
                    $result_course = $con->query($sql_course);
                    $row_course = $result_course->fetch_assoc();
                    ?>
                <input type="text" name="" id="" value="<?php echo $row_course["course_name"]; ?>" class="form-control">
            </div>
            <div class="col-md-4">
                <label>Department/Specialization</label>
                <input type="text" name="" id="" value="<?php echo strtoupper($row["department"]); ?>"
                    class="form-control">
            </div>
            <?php
                $sql_sem = "SELECT * FROM `tbl_semester`
                           WHERE `status` = '$visible' && `semester_id` = '" . $row["semester_id"] . "';
                           ";
                $result_sem = $con->query($sql_sem);
                $row_sem = $result_sem->fetch_assoc();
                ?>
            <div class="col-4">
                <label>Semester</label>
                <input type="text" name="" id="" value="<?php echo $row_sem["semester"]; ?>" class="form-control">
            </div>
            <p style="letter-spacing: 2px;">&nbsp;&nbsp;at the ensuing examination. I furnish my details as stated
                below: </p>
        </div>
        <header class="w3-container"
            style="background: #54a91f; color:white;width: 775px;border-top: 7px solid #e0811f;">
            <span onclick="document.getElementById('view_exam_lists').style.display='none'"
                class="w3-button w3-display-topright">&times;</span>
            <h2 align="center" style="font-size:18px;">Personal Details</h2>
        </header>
        <div class="row">
            <div class="col-md-12">
                <label>1. NAME OF THE STUDENT IN CAPITAL LETTERS: <br> (Leave one box vacant between First Name,
                    Middle
                    Name and Surname)</label>
                <div class="form-group">
                    <div class="input-group mb-1">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["candidate_name"][0]))
                                    echo strtoupper($row["candidate_name"])[0]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["candidate_name"][1]))
                                    echo strtoupper($row["candidate_name"])[1]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["candidate_name"][2]))
                                    echo strtoupper($row["candidate_name"])[2]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["candidate_name"][3]))
                                    echo strtoupper($row["candidate_name"])[3]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["candidate_name"][4]))
                                    echo strtoupper($row["candidate_name"])[4]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["candidate_name"][5]))
                                    echo strtoupper($row["candidate_name"])[5]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["candidate_name"][6]))
                                    echo strtoupper($row["candidate_name"])[6]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["candidate_name"][7]))
                                    echo strtoupper($row["candidate_name"])[7]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["candidate_name"][8]))
                                    echo strtoupper($row["candidate_name"])[8]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["candidate_name"][9]))
                                    echo strtoupper($row["candidate_name"])[9]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["candidate_name"][10]))
                                    echo strtoupper($row["candidate_name"])[10]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["candidate_name"][11]))
                                    echo strtoupper($row["candidate_name"])[11]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["candidate_name"][12]))
                                    echo strtoupper($row["candidate_name"])[12]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["candidate_name"][13]))
                                    echo strtoupper($row["candidate_name"])[13]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["candidate_name"][14]))
                                    echo strtoupper($row["candidate_name"])[14]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["candidate_name"][15]))
                                    echo strtoupper($row["candidate_name"])[15]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["candidate_name"][16]))
                                    echo strtoupper($row["candidate_name"])[16]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["candidate_name"][17]))
                                    echo strtoupper($row["candidate_name"])[17]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["candidate_name"][18]))
                                    echo strtoupper($row["candidate_name"])[18]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["candidate_name"][19]))
                                    echo strtoupper($row["candidate_name"])[19]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["candidate_name"][20]))
                                    echo strtoupper($row["candidate_name"])[20]; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <div class="input-group mb-1">
                        <label>2. GENDER:&nbsp; </label>
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["gender"][0]))
                                    echo strtoupper($row["gender"])[0]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["gender"][1]))
                                    echo strtoupper($row["gender"])[1]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["gender"][2]))
                                    echo strtoupper($row["gender"])[2]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["gender"][3]))
                                    echo strtoupper($row["gender"])[3]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["gender"][4]))
                                    echo strtoupper($row["gender"])[4]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["gender"][5]))
                                    echo strtoupper($row["gender"])[5]; ?>">

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">

                    <div class="input-group mb-1">
                        <label>&nbsp;&nbsp;3. Date Of Birth:&nbsp;&nbsp;</label>
                        <input id="" name="" class="form-control" value="<?php echo $row["dob"]; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <label>4. CORRESPONDENCE ADDRESS (for all communication by the University): </label>
                <div class="form-group">
                    <div class="input-group mb-1">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][0]))
                                    echo strtoupper($row["address"])[0]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][1]))
                                    echo strtoupper($row["address"])[1]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][2]))
                                    echo strtoupper($row["address"])[2]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][3]))
                                    echo strtoupper($row["address"])[3]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][4]))
                                    echo strtoupper($row["address"])[4]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][5]))
                                    echo strtoupper($row["address"])[5]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][6]))
                                    echo strtoupper($row["address"])[6]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][7]))
                                    echo strtoupper($row["address"])[7]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][8]))
                                    echo strtoupper($row["address"])[8]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][9]))
                                    echo strtoupper($row["address"])[9]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][10]))
                                    echo strtoupper($row["address"])[10]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][11]))
                                    echo strtoupper($row["address"])[11]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][12]))
                                    echo strtoupper($row["address"])[12]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][13]))
                                    echo strtoupper($row["address"])[13]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][14]))
                                    echo strtoupper($row["address"])[14]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][15]))
                                    echo strtoupper($row["address"])[15]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][16]))
                                    echo strtoupper($row["address"])[16]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][17]))
                                    echo strtoupper($row["address"])[17]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][18]))
                                    echo strtoupper($row["address"])[18]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][19]))
                                    echo strtoupper($row["address"])[19]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][20]))
                                    echo strtoupper($row["address"])[20]; ?>">
                    </div>
                    <div class="input-group mb-1">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][22]))
                                    echo strtoupper($row["address"])[22]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][23]))
                                    echo strtoupper($row["address"])[23]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][24]))
                                    echo strtoupper($row["address"])[24]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][25]))
                                    echo strtoupper($row["address"])[25]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][26]))
                                    echo strtoupper($row["address"])[26]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][27]))
                                    echo strtoupper($row["address"])[27]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][28]))
                                    echo strtoupper($row["address"])[28]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][29]))
                                    echo strtoupper($row["address"])[29]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][30]))
                                    echo strtoupper($row["address"])[30]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][31]))
                                    echo strtoupper($row["address"])[31]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][32]))
                                    echo strtoupper($row["address"])[32]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][33]))
                                    echo strtoupper($row["address"])[33]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][34]))
                                    echo strtoupper($row["address"])[34]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][35]))
                                    echo strtoupper($row["address"])[35]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][36]))
                                    echo strtoupper($row["address"])[36]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][37]))
                                    echo strtoupper($row["address"])[37]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][38]))
                                    echo strtoupper($row["address"])[38]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][39]))
                                    echo strtoupper($row["address"])[39]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][40]))
                                    echo strtoupper($row["address"])[40]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][41]))
                                    echo strtoupper($row["address"])[41]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][42]))
                                    echo strtoupper($row["address"])[42]; ?>">
                    </div>
                    <div class="input-group mb-1">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][43]))
                                    echo strtoupper($row["address"])[43]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][44]))
                                    echo strtoupper($row["address"])[44]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][45]))
                                    echo strtoupper($row["address"])[45]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][46]))
                                    echo strtoupper($row["address"])[46]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][47]))
                                    echo strtoupper($row["address"])[47]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][48]))
                                    echo strtoupper($row["address"])[48]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][49]))
                                    echo strtoupper($row["address"])[49]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][50]))
                                    echo strtoupper($row["address"])[50]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][51]))
                                    echo strtoupper($row["address"])[51]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][52]))
                                    echo strtoupper($row["address"])[52]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][53]))
                                    echo strtoupper($row["address"])[53]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][54]))
                                    echo strtoupper($row["address"])[54]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][55]))
                                    echo strtoupper($row["address"])[55]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][56]))
                                    echo strtoupper($row["address"])[56]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][57]))
                                    echo strtoupper($row["address"])[57]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][58]))
                                    echo strtoupper($row["address"])[58]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][59]))
                                    echo strtoupper($row["address"])[59]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][60]))
                                    echo strtoupper($row["address"])[60]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][61]))
                                    echo strtoupper($row["address"])[61]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][62]))
                                    echo strtoupper($row["address"])[62]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["address"][63]))
                                    echo strtoupper($row["address"])[63]; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <div class="input-group mb-1">
                        <label>&nbsp;&nbsp;5. LAST EXAMINATION PASSED & YEAR:&nbsp;&nbsp;</label>
                        <input id="" name="" value="<?php echo strtoupper($row["last_exam_year"]) ?>" type="text"
                            class="form-control ">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group mb-1">
                        <label>&nbsp;&nbsp;6. Email Address:&nbsp;&nbsp;</label>
                        <input id="" name="" value="<?php echo $row["email_id"]; ?>" type="text" class="form-control ">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group mb-1">
                        <label>&nbsp;&nbsp;Mobile No:(01)&nbsp;&nbsp;</label>
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["mobile_no1"][0]))
                                    echo $row["mobile_no1"][0]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["mobile_no1"][1]))
                                    echo $row["mobile_no1"][1]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["mobile_no1"][2]))
                                    echo $row["mobile_no1"][2]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["mobile_no1"][3]))
                                    echo $row["mobile_no1"][3]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["mobile_no1"][4]))
                                    echo $row["mobile_no1"][4]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["mobile_no1"][5]))
                                    echo $row["mobile_no1"][5]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["mobile_no1"][6]))
                                    echo $row["mobile_no1"][6]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["mobile_no1"][7]))
                                    echo $row["mobile_no1"][7]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["mobile_no1"][8]))
                                    echo $row["mobile_no1"][8]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["mobile_no1"][9]))
                                    echo $row["mobile_no1"][9]; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group mb-1">

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group mb-1">
                        <label>&nbsp;&nbsp;Mobile No:(02)&nbsp;&nbsp;</label>
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["mobile_no2"][0]))
                                    echo $row["mobile_no2"][0]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["mobile_no2"][1]))
                                    echo $row["mobile_no2"][1]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["mobile_no2"][2]))
                                    echo $row["mobile_no2"][2]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["mobile_no2"][3]))
                                    echo $row["mobile_no2"][3]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["mobile_no2"][4]))
                                    echo $row["mobile_no2"][4]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["mobile_no2"][5]))
                                    echo $row["mobile_no2"][5]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["mobile_no2"][6]))
                                    echo $row["mobile_no2"][6]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["mobile_no2"][7]))
                                    echo $row["mobile_no2"][7]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["mobile_no2"][8]))
                                    echo $row["mobile_no2"][8]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["mobile_no2"][9]))
                                    echo $row["mobile_no2"][9]; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <div class="input-group mb-1">
                        <label>&nbsp;&nbsp;AADHAR NO: &nbsp;&nbsp;</label>
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["adhar_no"][0]))
                                    echo $row["adhar_no"][0]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["adhar_no"][1]))
                                    echo $row["adhar_no"][1]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["adhar_no"][2]))
                                    echo $row["adhar_no"][2]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["adhar_no"][3]))
                                    echo $row["adhar_no"][3]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["adhar_no"][4]))
                                    echo $row["adhar_no"][4]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["adhar_no"][5]))
                                    echo $row["adhar_no"][5]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["adhar_no"][6]))
                                    echo $row["adhar_no"][6]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["adhar_no"][7]))
                                    echo $row["adhar_no"][7]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["adhar_no"][8]))
                                    echo $row["adhar_no"][8]; ?>">
                        <input id="" name="" type="text" class="form-control p-0 text-center otp-text remove-spin"
                            value="<?php if (isset($row["adhar_no"][9]))
                                    echo $row["mobile_no2"][9]; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <div class="input-group mb-1">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <div class="input-group mb-1">
                        <label>&nbsp;&nbsp;7. SUBJECT DETAILS:- &nbsp;&nbsp;</label>
                    </div>
                    <table border="1" style="width: 100%;">
                        <thead>
                            <tr>
                                <th scope="col">S.NO</th>
                                <th scope="col">PAPER CODE</th>
                                <th scope="col">PAPER NAME</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                //$subject_id = $_POST["subject_id"];                        
                                $sql_subject = "SELECT * FROM `tbl_subjects` WHERE course_id = '" . $row["course_id"] . "' && semester_id = '" . $row["semester_id"] . "' ORDER BY `subject_id` ASC ";
                                $result_subject = $con->query($sql_subject);
                                while ($row_subject = $result_subject->fetch_assoc()) {
                                    ?>
                            <tr>
                                <td>
                                    <?php echo $s_no; ?>
                                </td>
                                <td> <input type="text" name="paper_code" class="form-control"
                                        value="<?php echo $row_subject["subject_code"] ?>" readonly></td>
                                <td> <input type="text" name="paper_name" class="form-control"
                                        value="<?php echo $row_subject["subject_name"] ?>" readonly></td>
                            </tr>
                            <?php
                                    $s_no++;
                                }
                                ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <header class="w3-container"
                style="background: #54a91f; color:white;width: 775px;border-top: 7px solid #e0811f;">
                <span onclick="document.getElementById('view_exam_lists').style.display='none'"
                    class="w3-button w3-display-topright">&times;</span>
                <h2 align="center" style="font-size:18px;">BEFORE SUBMITTING THE EXAMINATION FORM PLEASE ENSURE
                    THAT:
                </h2>
            </header>
            <ul>
                <li>Registration is valid for only enrolled Course</li>
                <li>The enrolment number, subject code, papers’ name are correctly filled in the examination form.
                </li>
                <li>Examination fees once paid, not refundable / adjusted in any case. </li>
            </ul>
            <p>N.B: In case of non-compliance of any of the above conditions, candidature for appearing in the
                Examination will not be considered and no Admit Card will be issued. </p>
            <header class="w3-container"
                style="background: #54a91f; color:white;width: 775px;border-top: 7px solid #e0811f;">
                <span onclick="document.getElementById('view_exam_lists').style.display='none'"
                    class="w3-button w3-display-topright">&times;</span>
                <h2 align="center" style="font-size:18px;">INSTRUCTIONS FOR FILLING UP THE EXAMINATION FORM: </h2>
            </header>
            <ol>
                <li>Write correct subject code(s) as indicated in your Programme Guide / Syllabus. </li>
                <li>In case, wrong / invalid course or subject code is mentioned in examination form, the Admit Card
                    will not be issued.</li>
                <li>Submit examination form within the due date. </li>
                <li>It is advised to enclose photocopy of Admit Card / Mark sheet / Registration slip of the last
                    examination passed. </li>
            </ol>
            <header class="w3-container"
                style="background: #54a91f; color:white;width: 775px;border-top: 7px solid #e0811f;">
                <span onclick="document.getElementById('view_exam_lists').style.display='none'"
                    class="w3-button w3-display-topright">&times;</span>
                <h2 align="center" style="font-size:18px;">DECLARATION BY THE STUDENT </h2>
            </header>
            <p>
                I hereby declare that I have read and understood the instructions given above. I also affirm that I
                have
                submitted all the required numbers of assignment as applicable for the aforesaid course filled in
                the
                examination form and my registration for the course is valid and not time barred. If any of my
                statements is found to be untrue, I will have no claim for appearing in the examination. I undertake
                that I shall abide by the rules and regulations of the University.
            </p>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group mb-1">
                        <label>&nbsp;&nbsp;Date: &nbsp;&nbsp;</label>
                        <input type="text" value="<?php echo $row["create_time"] ?>" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group mb-1">
                        <center><img
                                src="<?= url('././student/images/student_sign_new/') ?><?php echo $row["candidate_signature"] ?>"
                                alt="" style="margin-top: 0px;width: 30%;" /></center>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group mb-1">
                        <label>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Signature Of the Student&nbsp;&nbsp;</label>
                    </div>
                </div>
            </div>
        </div>
        <hr style="border-top: 1px solid black;">
        <p>
            <center><u>For Office Use</u></center>
        </p>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group mb-1">
                        <input id="verified_by_display" name="verified_by_display" type="text"
                            class="form-control otp-text remove-spin text-danger"
                            value="<?php echo $row['verified_by']; ?>" style="font-weight: 600;" readonly>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group mb-1">
                        <input class="form-control otp-text remove-spin" id="hidden_verified_by"
                            name="hidden_verified_by" style="font-weight: 600;" type="text"
                            value="<?php echo $_SESSION["admin_name"]; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group mb-1">
                        <label>&nbsp;&nbsp;Verified By &nbsp;&nbsp;</label>
                    </div>
                    <button type="button" class="btn btn-success btn-sm" onclick="verifyForm()">Click to
                        Verify</button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group mb-1">
                        <label>&nbsp;&nbsp;(Seal and signature of HOD)&nbsp;&nbsp;</label>
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>
<?php
}
?>
<script type="text/javascript">
function verifyForm() {
    $.ajax({
        url: 'include/ajax/verified.php',
        type: 'POST',
        data: {
            'data': "<?= $row["exam_id"] ?>"
        },
        success: function(result) {
            document.getElementById('verified_by_display').innerHTML = result;
        }

    });
}
</script>