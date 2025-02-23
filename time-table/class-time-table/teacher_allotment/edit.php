<?php
include_once "../../../framwork/main.php";
include_once "../../../include/function.php";
$subject_id = $_GET['id'];
$visible = md5('visible');
$course = fetchResult('tbl_course', 'status="' . $visible . '"');
$acadmic_year = fetchResult('tbl_university_details', 'status="' . $visible . '"');
$subject = fetchRow('teacher_allot_tbl', ' `id`=' . $subject_id . '');
$all_staff = fetchResult('tbl_staff');



?>
<form action="" id="add_marks_edit">

    <div class="row">
        <div class="col-sm-6">
            <input type="hidden" name="id" id="" value="<?= $subject['id'] ?>">
            <label for="" class="text-capitalize form-label ">course</label>
            <select name="course_id" id="course_id1" class="form-control" onchange="change_semester1(this.value)">
                <option value="<?= $subject['course_id'] ?>"> <?= fetchRow('tbl_course', 'course_id=' . $subject['course_id'] . ' && status="' . $visible . '"')['course_name'] ?> </option>
                <?php while ($course_row = mysqli_fetch_assoc($course)) { ?>
                    <option value="<?= $course_row['course_id'] ?>">
                        <?= $course_row['course_name'] ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="col-sm-6">
            <label for="" class="text-capitalize form-label">fee_academic_year</label>
            <select onchange="showdesg1(this.value)" name="academic_year" id="session_id1" class="form-control">
                <option value="<?= $subject['academic_year'] ?>"> <?= fetchRow('tbl_university_details', 'university_details_id=' . $subject['academic_year'] . ' && status="' . $visible . '"')['academic_session'] ?> </option>

                </option> <?php while ($acadmic_year_row = mysqli_fetch_assoc($acadmic_year)) { ?>
                    <option value="<?= $acadmic_year_row['university_details_id'] ?>">
                        <?= $acadmic_year_row['academic_session'] ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="col-sm-6">
            <label for="" class="text-capitalize form-label">semester</label>
            <select name="semester_id" id="sem1" class="form-control">
                <option value="<?= $subject['semester_id'] ?>"> <?= fetchRow('tbl_semester', 'semester_id=' . $subject['semester_id'] . ' && status="' . $visible . '"')['semester'] ?> </option>
            </select>

        </div>
        <div class="col-sm-6">
            <label for="" class="text-capitalize form-label">Staff name</label>
            <select  name="staff_id" id="session_id1" class="form-control">
                <option value="<?= $subject['staff_id'] ?>"> <?= get_staff($subject['staff_id']) ?> </option>

                </option> <?php while ($staff_row = mysqli_fetch_assoc($all_staff)) { ?>
                    <option value="<?= $staff_row['id'] ?>">
                        <?= $staff_row['name'] ?>
                    </option>
                <?php } ?>
            </select>
        </div>


    </div>
    <hr>
    <div class=" text-center">
        <button onclick="ajaxCall('add_marks_edit','<?= url('time-table/class-time-table/teacher_allotment/update') ?>','add_marks_edit')" type="button" class="btn btn-primary btn-sm">Save changes</button>
    </div>
    </div>
</form>