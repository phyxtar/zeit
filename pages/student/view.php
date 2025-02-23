<?php
include_once "../../include/config.php";
include_once "../../framwork/main.php";
include_once "../../include/function.php";

if ($_GET["action"] == "fetch_student_list_details") {
    $course_id = $_POST["course_id"];

    if ($_POST["academic_year"][0] != '') {
        $academic_year = implode(',', $_POST["academic_year"]);
    } else {
        $academic_year = $_POST["academic_year"][0];
    }

    if ($course_id != 'all' && $academic_year != 'all') {
        $result = fetchResult('tbl_admission', ' `status` = "' . $visible . '" && `admission_session` IN (' . $academic_year . ') && `admission_course_name` = "' . $course_id . '" ORDER BY `admission_id` DESC');
        $active_student = get_count('tbl_admission', 'admission_id', ' `status` = "' . $visible . '" && `admission_session` IN (' . $academic_year . ') && `admission_course_name` = "' . $course_id . '" && stud_status=1   ORDER BY `admission_id` DESC');
        $hoster_student = get_count('tbl_admission', 'admission_id', ' `status` = "' . $visible . '" && `admission_session` IN  (' . $academic_year . ') && `admission_course_name` = "' . $course_id . '" && admission_hostel="Yes" ORDER BY  `admission_id` DESC');
        $active_hoster_student = get_count('tbl_admission', 'admission_id', ' `status` = "' . $visible . '" && `admission_session` IN  (' . $academic_year . ') && `admission_course_name` = "' . $course_id . '" && admission_hostel="Yes" && stud_status=1 && hostel_leave_date="" ORDER BY  `admission_id` DESC');
        $completed_student = get_count('tbl_admission', 'admission_id', ' `status` = "' . $visible . '" && `admission_session` IN  (' . $academic_year . ') && `admission_course_name` = "' . $course_id . '" && completed=1 && stud_status=1 ORDER BY  `admission_id` DESC');
    } else {
        $result = fetchResult('tbl_admission', ' `status` = "' . $visible . '"');
        $active_student = get_count('tbl_admission', 'admission_id', ' `status` = "' . $visible . '" && stud_status=1   ORDER BY `admission_id` DESC');
        $hoster_student = get_count('tbl_admission', 'admission_id', ' `status` = "' . $visible . '" &&  admission_hostel="Yes" ORDER BY  `admission_id` DESC');
        $active_hoster_student = get_count('tbl_admission', 'admission_id', ' `status` = "' . $visible . '" &&  admission_hostel="Yes" && stud_status=1 && hostel_leave_date="" ORDER BY  `admission_id` DESC');
        $completed_student = get_count('tbl_admission', 'admission_id', ' `status` = "' . $visible . '" &&   completed=1 && stud_status=1 ORDER BY  `admission_id` DESC');
    }
    $s_no = 1;

    ?>
    <div class="row mb-2">
        <div class="col-sm-8">
            <span class="btn btn-primary btn-sm"><i class="fas fa-users-class"></i> Total Student -
                <?= mysqli_num_rows($result) ?> </span>
            <span class="btn btn-sm btn-success"> <i class="fas fa-user-check"></i> Active Student -
                <?= (int) $active_student - (int) $completed_student ?> </span>
            <span class="btn btn-sm btn-danger"> <i class="fas fa-user-times"></i> Inactive Student -
                <?= (int) mysqli_num_rows($result) - (int) $active_student ?> </span>
            <span class="btn btn-sm btn-success"> <i class="fas fa-building"></i> completed Student -
                <?= $completed_student ?> </span>
            <hr>
            <span class="btn btn-sm btn-info"> <i class="fas fa-building"></i> Hosteler - <?= $hoster_student ?> </span>
            <span class="btn btn-sm btn-secondary"> <i class="fas fa-building"></i> Actve Hosteler -
                <?= $active_hoster_student ?> </span>
            <span class="btn btn-sm btn-danger"> <i class="fas fa-building"></i> InActive Hosteler -
                <?= (int) $hoster_student - (int) $active_hoster_student ?> </span>

            <hr>

            <form method="POST" action="export-list">
                <input type="hidden" name="course_id" value="<?php echo $course_id; ?>" />
                <input type="hidden" name="academic_year" value="<?php echo $academic_year; ?>" />
                <input type="hidden" name="action" value="export_student_specialization" />
                <button type="submit" class="btn btn-warning  btn-sm" style="margin-top: 5px; float: right;"><i
                        class="fa fa-download"></i> Export with Specialization</button>
            </form>
        </div>
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-8">

                    <?php
                    $permissions = json_decode($_SESSION["authority"], true);
                    $loggedInUserType = $_SESSION['logger_type'];

                    if ((isset($permissions['6']) && in_array('6_8', explode('||', $permissions['6']))) || $loggedInUserType == 'admin') {
                        ?>
                        <button onclick=" ajaxCall('form_data', '<?= url('pages/student/inactive') ?>', 'success')"
                            type="button" id="success" class="btn btn-danger  btn-sm"><i class="fas fa-users"></i> Inactive
                            All </button>
                        <?php
                    }
                    ?>


                    <?php
                    $permissions = json_decode($_SESSION["authority"], true);
                    $loggedInUserType = $_SESSION['logger_type'];

                    if ((isset($permissions['6']) && in_array('6_9', explode('||', $permissions['6']))) || $loggedInUserType == 'admin') {
                        ?>
                        <button onclick=" ajaxCall('completed', '<?= url('pages/student/completed') ?>', 'success1')"
                            type="button" id="success1" class="btn btn-info  btn-sm"><i class="fas fa-users"></i> Completed
                        </button>
                        <?php
                    }
                    ?>
                    <!-- <?php if ($_SESSION["admin"]['admin_type'] == "superadmin") {
                        if (is_numeric($academic_year)) { ?> -->

                            <!-- <form id="form_data">
                    <input type="hidden" name="course_id" value="<?php echo $course_id; ?>" />
                    <input type="hidden" name="academic_year" value="<?php echo $academic_year; ?>" />
                    <button onclick=" ajaxCall('form_data', '<?= url('pages/student/inactive') ?>', 'success')"
                        type="button" id="success" class="btn btn-danger  btn-sm"><i class="fas fa-users"></i> Inactive
                        All </button>
                    <button onclick=" ajaxCall('completed', '<?= url('pages/student/completed') ?>', 'success1')"
                        type="button" id="success1" class="btn btn-info  btn-sm"><i class="fas fa-users"></i> Completed
                    </button>
                </form> -->

                            <!-- <?php
                        }
                    } else {
                        if (get_permission('6', '6_2', $_SESSION["admin_id"]) === "checked") {
                            if (is_numeric($academic_year)) {
                                ?>
                <form id="form_data">
                    <input type="hidden" name="course_id" value="<?php echo $course_id; ?>" />
                    <input type="hidden" name="academic_year" value="<?php echo $academic_year; ?>" />
                    <button onclick=" ajaxCall('form_data', '<?= url('pages/student/inactive') ?>', 'success')"
                        type="button" id="success" class="btn btn-danger  btn-sm"><i class="fas fa-users"></i>
                        InactiveAll </button>
                    <button onclick=" ajaxCall('completed', '<?= url('pages/student/completed') ?>', 'success1')"
                        type="button" id="success1" class="btn btn-info  btn-sm"><i class="fas fa-users"></i> Completed
                    </button>

                </form>

                <?php }
                        }
                    } ?> -->
                </div>
                <div class="col-sm-4">
                    <form method="POST" action="export-list">
                        <input type="hidden" name="course_id" value="<?php echo $course_id; ?>" />
                        <input type="hidden" name="academic_year" value="<?php echo $academic_year; ?>" />
                        <input type="hidden" name="action" value="export_student_details" />
                        <button type="submit" class="btn btn-warning  btn-sm"><i class="fa fa-download"></i> Export
                            All</button>
                    </form>
                    <form method="POST" action="export_to_pdf.php" class='mt-2'>
                        <input type="hidden" name="course_id" value="<?php echo $course_id; ?>" />
                        <input type="hidden" name="academic_year" value="<?php echo $academic_year; ?>" />
                        <input type="hidden" name="action" value="export_student_pdf" />
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa fa-file-pdf"></i> Export PDF
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <form id="completed" action="#">

        <table id="example1" class="table table-bordered table-striped table-responsive" style="overflow-x:auto;">
            <thead>
                <tr>
                    <th width="10%"> <input onclick="selectall()" type="checkbox"></th>
                    <th width="10%">Reg. No</th>
                    <th width="10%">Student Name</th>
                    <th width="10%">Course</th>
                    <th width="10%">Specialization</th>
                    <th width="10%">Dual Specialization</th>
                    <th width="10%">Hostel</th>
                    <th width="10%">Father Name</th>
                    <th width="10%">Mother Name</th>
                    <th width="10%">Student Contact No.</th>
                    <th width="10%">Father Contact No.</th>
                    <th width="10%">DOB</th>
                    <th width="10%">Gender</th>
                    <th width="10%">Student Image</th>
                    <th class="project-actions text-center">Action </th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $s_no; ?> <input class="allcheck" name="student_id[]" value="<?= $row['admission_id'] ?>"
                                    type="checkbox">
                            </td>
                            <?php
                            $sql_course = "SELECT * FROM `tbl_course`
                                                   WHERE `status` = '$visible' && `course_id` = '" . $row["admission_course_name"] . "';
                                                   ";
                            $result_course = $con->query($sql_course);
                            $row_course = $result_course->fetch_assoc();



                            ?>
                            <td><?php echo $row["admission_id"] ?></td>
                            <td><?php echo $row["admission_first_name"] ?>             <?php echo $row["admission_middle_name"] ?>
                                <?php echo $row["admission_last_name"] ?>
                            </td>
                            <td><?php echo $row_course["course_name"]; ?></td>
                            <td>
                                <?php
                                $spec_name = "SELECT * FROM `tbl_specialization` WHERE `id` = '". $row['specialization_id'] ."'";
                                $result_spec_name = $con->query($spec_name);
                                $row_spec_name = $result_spec_name->fetch_assoc();
                                echo $row_spec_name['sp_name'];
                                ?>
                            </td>
                            <td>
                            <?php
                                $spec_name = "SELECT * FROM `tbl_specialization` WHERE `id` = '". $row['specialization_id_dual'] ."'";
                                $result_spec_name = $con->query($spec_name);
                                $row_spec_name = $result_spec_name->fetch_assoc();
                                echo $row_spec_name['sp_name'];
                                ?>
                            </td>
                            <td><?php echo $row["admission_hostel"]; ?></td>
                            <td><?php echo $row["admission_father_name"] ?></td>
                            <td><?php echo $row["admission_mother_name"] ?></td>
                            <td><?php echo $row["admission_mobile_student"]; ?></td>
                            <td><?php echo $row["admission_father_phoneno"]; ?></td>
                            <td><?php echo date("d-m-Y", strtotime($row["admission_dob"])); ?></td>
                            <td><?php echo $row["admission_gender"]; ?></td>
                            <td><img style="width: 100px;filter: invert(0);height: 100px;"
                                    src="images/student_images/<?php echo $row["admission_profile_image"]; ?> "
                                    alt="Student Profile Image"></td>
                            <?php

                            if ($_SESSION["admin"]['admin_type'] == "superadmin") { ?>
                                <td class="project-actions text-center ">
                                    <button
                                        onclick="editForm('<?= url('pages/student/show') ?>',<?= $row['admission_id'] ?>,'edit_form')"
                                        type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#exampleModalCenter">
                                        <i class="fas fa-eye">
                                        </i>
                                    </button>

                                    <a target="_blank" href="edit_student?id=<?php echo $row['admission_id']; ?>"
                                        class="update btn btn-warning btn-sm"><i class="fas fa-edit">
                                        </i>
                                        </span></a>
                                    <button id="success<?= $s_no ?>" class="btn btn-danger btn-sm"
                                        onclick="deleteForm('<?= url('pages/student/delete') ?>', '<?= $row['admission_id'] ?>', 'success<?= $s_no ?>')">
                                        <i class="fas fa-trash">
                                        </i>
                                    </button>
                                    <button id="active<?= $s_no ?>"
                                        onclick="changeStatus('<?= url('pages/student/status') ?>', '<?= $row['admission_id'] ?>','active<?= $s_no ?>')"
                                        class="btn btn-<?= ($row['stud_status'] == 1 ? 'success' : 'danger') ?> btn-sm"><?= ($row['stud_status'] == 1 ? '<i class="fas fa-user-check"></i>' : '<i class="fas fa-user-times"></i>') ?></button>
                                    <button
                                        class="btn btn-<?= ($row['completed'] == 1 ? 'success' : '') ?> btn-sm"><?= ($row['completed'] == 1 ? 'completed' : '') ?></button>
                                    <!-- Document Status Button -->
                                    <button id="docButton<?= $row['admission_id'] ?>"
                                        class="btn mt-1 btn-<?= ($row['doc_status'] == 1 ? 'danger' : 'success') ?> btn-sm"
                                        title="<?= ($row['doc_status'] == 1 ? 'Document Pending' : 'Document Clear') ?>"
                                        onclick="toggleDocStatus(event, '<?= url('pages/student/toggleDocStatus.php') ?>', '<?= $row['admission_id'] ?>')">
                                        <i class="fas fa-file-exclamation text-white"></i>
                                    </button>

                                    <!-- DocView Button -->
                                    <button id="viewDoc<?= $row['admission_id'] ?>" class="btn mt-1 btn-info btn-sm"
                                        title="View Document" onclick="showDocView('<?= $row['admission_id'] ?>')">
                                        View Doc
                                    </button>
                                    <!-- Document View Modal -->
                                    <div class="modal fade" id="docViewModal" tabindex="-1" role="dialog"
                                        aria-labelledby="docViewModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="docViewModalLabel">Document Details</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <iframe id="docViewFrame" src="" style="width:100%; height:500px;"
                                                        frameborder="0"></iframe>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        function showDocView(admissionId) {
                                            // Set the src attribute of the iframe to the document URL
                                            var url = '<?= url('pages/student/viewDocument') ?>?id=' + admissionId;
                                            document.getElementById('docViewFrame').src = url;

                                            // Show the modal
                                            $('#docViewModal').modal('show');
                                        }
                                    </script>


                                    <script>
                                        function toggleDocStatus(event, url, admission_id) {
                                            event.preventDefault(); // Prevent default action (e.g., scrolling to top)

                                            // Send an AJAX request using fetch to update the doc_status in the backend
                                            fetch(url + '?id=' + admission_id, {
                                                method: 'POST'
                                            })
                                                .then(response => response.json()) // Expect JSON response
                                                .then(data => {
                                                    if (data.success) {
                                                        // Get the button element using the unique ID
                                                        var button = document.getElementById('docButton' + admission_id);

                                                        // Update the button based on the new status
                                                        if (data.new_status == 1) {
                                                            button.className = 'btn mt-1 btn-danger btn-sm';
                                                            button.title = 'Document Pending';
                                                        } else {
                                                            button.className = 'btn mt-1 btn-success btn-sm';
                                                            button.title = 'Document Clear';
                                                        }
                                                    } else {
                                                        console.error('Error updating status:', data.error);
                                                        alert('Failed to update document status.');
                                                    }
                                                })
                                                .catch(error => {
                                                    console.error('Error:', error);
                                                    alert('An error occurred while updating the status.');
                                                });

                                            // Prevent page refresh
                                            return false;
                                        }
                                    </script>

                                </td>
                            <?php } else { ?>
                                <td class="project-actions text-center ">

                                    <button
                                        onclick="editForm('<?= url('pages/student/show') ?>',<?= $row['admission_id'] ?>,'edit_form')"
                                        type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#exampleModalCenter">
                                        <i class="fas fa-eye">
                                        </i>
                                    </button>
                                    <?php
                                    if (get_permission('6', '6_5', $_SESSION["admin_id"]) === "checked") { ?>
                                        <a target="_blank" class="btn btn-warning btn-sm"
                                            href="edit_student?id=<?php echo $row['admission_id']; ?>"><i class="fas fa-edit">
                                            </i>
                                        </a>
                                    <?php }
                                    if (get_permission('6', '6_1', $_SESSION["admin_id"]) === "checked") { ?>
                                        <button id="success<?= $s_no ?>" class="btn btn-danger btn-sm"
                                            onclick="deleteForm('<?= url('pages/student/delete') ?>', '<?= $row['admission_id'] ?>', 'success<?= $s_no ?>')">
                                            <i class="fas fa-trash">
                                            </i>
                                        </button>
                                    <?php }
                                    if (get_permission('6', '6_2', $_SESSION["admin_id"]) === "checked") { ?>
                                        <button id="active<?= $s_no ?>"
                                            onclick="changeStatus('<?= url('pages/student/status') ?>', '<?= $row['admission_id'] ?>','active<?= $s_no ?>')"
                                            class="btn btn-<?= ($row['stud_status'] == 1 ? 'success' : 'danger') ?> btn-sm"><?= ($row['stud_status'] == 1 ? '<i class="fas fa-user-check"></i>' : '<i class="fas fa-user-times"></i>') ?></button>
                                    <?php } ?>
                                </td>
                            <?php } ?>
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
    </form>

    <script>
        $(function () {

            $('#example1').DataTable({
                aLengthMenu: [
                    [25, 50, 100, 200, -1],
                    [25, 50, 100, 200, "All"]
                ],

            });

        });
    </script>
    <?php
    include_once "../../framwork/ajax/method.php";
}
?>

<!-- Button trigger modal -->

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
        <div class="modal-content">
            <header class="container" style="background:#343a40; color:white;">
                <button type="button" class="close pt-2 p-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h2 align="center"> Student Details</h2>
            </header>

            <div class="modal-body" id="edit_form">
            </div>
        </div>
    </div>
</div>
<script>
    function selectall() {
        var allcheck = document.getElementsByClassName('allcheck');
        console.log(allcheck);
        for (i = 0; i < allcheck.length; i++) {
            document.getElementsByClassName('allcheck')[i].checked = "true"
        }
    }
</script>