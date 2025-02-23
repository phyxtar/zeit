<?php   //Starting Session
include_once "./framwork/main.php";
$visible = md5("visible");
$s_no = 1;
if ($_GET["action"] == "fetch_student_semester") {
    $course_id = $_POST["course_id"];
    $academic_year = $_POST["academic_year"];
    //$semester_id = $_POST["semester_id"];

    if ($academic_year != 0) {
        ?>
<style>
#editModal {
    font-family: Arial, sans-serif;
}

.modal-content {
    padding: 20px;
    background-color: #fefefe;
    border: 1px solid #888;
    width: 300px;
    margin: 0 auto;
    border-radius: 5px;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.close {
    color: #aaa;
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

input[type="text"] {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 5px;
    border: 1px solid #ccc;
    border-radius: 3px;
    box-sizing: border-box;
}

.custom-class {
    width: 100%;
    padding: 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #45a049;
}
</style>



<form action="allot1.php" method="post" enctype="multipart/form-data">


    <table id="example1" class="table table-bordered table-striped table-responsive" style="overflow-x:auto;">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Student Id</th>
                <th>Student&nbsp;Reg&nbsp;No</th>
                <th>Student Name</th>
                <th>Father Name</th>
                <th>Course</th>
                <th>Session</th>
                <th>Student&nbsp;Allot Roll No</th>
                <th>Section</th>
                <th class="project-actions text-center">Allot&nbsp;Semester
                    <select class="form-control" onchange="change_all_semester(this)">
                        <option selected disabled>- Select Semester -</option>
                        <?php
                                $get_semester = "SELECT * FROM `tbl_semester`
													   WHERE `status`='$visible' && `course_id` = '" . $course_id . "' && `fee_academic_year`='" . $academic_year . "';
													   ";
                                $semester = $con->query($get_semester);
                                while ($semester_row = $semester->fetch_assoc()) {
                                    ?>
                        <option value="<?= $semester_row["semester_id"]; ?>"><?= $semester_row["semester"]; ?></option>
                        <?php } ?>
                    </select>
                </th>
                <th><button
                        onclick='delete_student("include/controller/delete/semester_allot_deleteAll?academic_year=<?= $academic_year ?>&course_id=<?= $course_id ?>&semester_id=<?= $semester_id ?>","success<?= $academic_year ?>")'
                        class="btn btn-danger" id="success<?= $row["allot_id"] ?>" type="button"> <i
                            class="fas fa-trash-alt"></i></button>
                    Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                    $query = "SELECT *
                    FROM `tbl_registration_form`
                    WHERE `course_id` = '$course_id' AND `academic_year` = '$academic_year'";

          $result = $con->query($query);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
            <tr>
                <td><?= $s_no; ?></td>
                <td><?= $row["admission_id"] ?></td>
                <input type="hidden" name="admission_id[]" class="form-control" value="<?= $row["admission_id"] ?>">
                <?php
                                $sql_reg = "SELECT * FROM `tbl_admission`
                                                       WHERE `status` = '$visible' && `admission_id` = '" . $row["admission_id"] . "';
                                                       ";
                                $result_reg = $con->query($sql_reg);
                                $row_reg = $result_reg->fetch_assoc();
                                ?>
                <td> <input type="text" name="reg_no[]" class="form-control" value="<?= $row["registration_no"] ?>"
                        readonly>
                </td>
                <td><?= $row_reg["admission_first_name"] . " " . $row_reg['admission_middle_name'] . $row_reg['admission_last_name'] ?>
                </td>
                <td><?= $row_reg["admission_father_name"] ?></td>
                <?php
                                $sql_course = "SELECT * FROM `tbl_course`
                                                       WHERE `status` = '$visible' && `course_id` = '" . $row["course_id"] . "';
                                                       ";
                                $result_course = $con->query($sql_course);
                                $row_course = $result_course->fetch_assoc();
                                ?>

                <?php
                                $sql_ac_year = "SELECT * FROM `tbl_university_details`
                                                    WHERE `university_details_id` = '" . $academic_year . "';";
                                $result_ac_year = $con->query($sql_ac_year);
                                $row_ac_year = $result_ac_year->fetch_assoc(); ?>
                <?php
                                $completeSessionStart = explode("-", $row_ac_year["university_details_academic_start_date"]);
                                $completeSessionEnd = explode("-", $row_ac_year["university_details_academic_end_date"]);
                                $completeSessionOnlyYear = $completeSessionStart[0] . "-" . $completeSessionEnd[0];
                                ?>
                <input type="hidden" name="course_id[]" value="<?= $row["course_id"]; ?>">
                <input type="hidden" name="academic_year[]" value="<?= $row_ac_year["university_details_id"]; ?>">

                <td><?= $row_course["course_name"]; ?></td>
                <!-- <td></td>-->

                <td>
                    <?= $completeSessionOnlyYear ?>
                </td>
                <td> <input type="text" name="roll_no[]" class="form-control" value="<?= $row["roll_no"] ?>" readonly>
                </td>
                <td> A</td>

                <td>
                    <?php
                                    $sql_course = "SELECT * FROM `tbl_semester`
													   WHERE `semester_id` = '" . $row["semester_id"] . "';
													   ";
                                    $result_course = $con->query($sql_course);
                                    $row_course = $result_course->fetch_assoc();
                                    ?>
                    <select class="form-control semester_name" name="semester_id[]">
                        <option value="<?= $row["semester_id"]; ?>"><?= $row_course["semester"]; ?></option>
                        <?php
                                        $get_semester = "SELECT * FROM `tbl_semester`
                                                            WHERE `status`='$visible' && `course_id` = '" . $course_id . "' && `fee_academic_year`='" . $academic_year . "';
                                                            ";
                                        $semester = $con->query($get_semester);
                                        while ($semester_row = $semester->fetch_assoc()) {
                                            ?>
                        <option value="<?= $semester_row["semester_id"]; ?>"><?= $semester_row["semester"]; ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td style="justify-content: space-between;display: flex;">
                    <!-- <button onclick='openEditModal(<?= $row["allot_id"] ?>, "<?= $row["reg_no"] ?>")'
                        class="btn btn-warning" type="button">
                        <i class="fas fa-edit"></i>
                    </button> -->
                    <button
                        onclick='delete_student("include/controller/delete/semester_allot_delete?id=<?= $row["allot_id"] ?>","success<?= $row["allot_id"] ?>")'
                        class="btn btn-danger" id="success<?= $row["allot_id"] ?>" type="button"> <i
                            class="fas fa-trash-alt"></i></button>
                </td>
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
            <tr>
                <td height="40" colspan="8" valign="middle" align="center" class="narmal">
                    <input type="submit" name="submit" value="Submit" class="btn btn-primary">

                </td>
            </tr>
        </tbody>

        <div class="col-12" id="error_section"></div>
    </table>
</form>

<?php
    } else
        echo "0";
}
?>

<div id="editModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <form id="editForm" method="post" enctype="multipart/form-data">
            <input type="hidden" id="editAllotId" name="allot_id">
            <!-- Input field for updating reg_no -->
            <label for="editRegNo">Enter New Registration No:</label>
            <input type="text" id="editRegNo" name="reg_no" required>
            <input type="submit" name="submit" onclick="submitEditForm()" value="Submit"
                class="btn btn-primary custom-class">
        </form>
    </div>
</div>

<script src="framwork/ajax/method.js"></script>
<script>
function openEditModal(allot_id, reg_no) {
    // Set the allot_id value in the hidden input field
    document.getElementById('editAllotId').value = allot_id;
    // Set the current reg_no value in the input field
    document.getElementById('editRegNo').value = reg_no;
    // Show the modal
    document.getElementById('editModal').style.display = 'block';
}

function closeModal() {
    // Hide the modal
    document.getElementById('editModal').style.display = 'none';
}

function submitEditForm() {
    var allot_id = document.getElementById('editAllotId').value;
    var new_reg_no = document.getElementById('editRegNo').value;

    var params = "allot_id=" + allot_id + "&reg_no=" + new_reg_no;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
            closeModal();
        }
    };
    xhttp.open("POST", "allot1.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(params);
}

function change_all_semester(semster) {
    var all_semester = document.getElementsByClassName('semester_name');
    for (i = 0; i < all_semester.length; i++) {
        all_semester[i][semster.selectedIndex].selected = "true"
    }
}

function delete_student(url_name, target_id) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(target_id).innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", url_name, true);
    xhttp.send();
}
</script>