<?php
include_once "../../../framwork/main.php";

$subject_id = $_GET['id'];
$visible = md5('visible');
$course = fetchResult('tbl_course', 'status="' . $visible . '"');
$spec = fetchResult('tbl_specialization', 'status="' . $visible . '"');
$acadmic_year = fetchResult('tbl_university_details', 'status="' . $visible . '"');
$subject = fetchRow('tbl_subjects', 'status="' . $visible . '" && `subject_id`=' . $subject_id . '');



?>
<!-- <input type="text"> -->

<form action="" id="add_marks_edit">

    <div class="row">
        <div class="col-sm-6">
            <input type="hidden" name="subject_id" id="" value="<?= $subject['subject_id'] ?>">
            <label for="" class="text-capitalize form-label ">course</label>
            <select name="course_id" id="course_id1" class="form-control" onchange="change_semester1(this.value)">
                <option value="<?= $subject['course_id'] ?>">
                    <?= fetchRow('tbl_course', 'course_id=' . $subject['course_id'] . ' && status="' . $visible . '"')['course_name'] ?>
                </option>
                <?php while ($course_row = mysqli_fetch_assoc($course)) { ?>
                <option value="<?= $course_row['course_id'] ?>">
                    <?= $course_row['course_name'] ?>
                </option>
                <?php } ?>
            </select>
        </div>

        <div class="col-sm-6">
            <label for="" class="text-capitalize form-label">fee_academic_year</label>
            <select onchange="showdesg1(this.value)" name="fee_academic_year" id="session_id1" class="form-control">
                <option value="<?= $subject['fee_academic_year'] ?>">
                    <?= fetchRow('tbl_university_details', 'university_details_id=' . $subject['fee_academic_year'] . ' && status="' . $visible . '"')['academic_session'] ?>
                </option>

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
                <option value="<?= $subject['semester_id'] ?>">
                    <?= fetchRow('tbl_semester', 'semester_id=' . $subject['semester_id'] . ' && status="' . $visible . '"')['semester'] ?>
                </option>
            </select>

        </div>
        <div class="col-sm-6">
            <label for="" class="text-capitalize form-label">subject name</label>
            <input type="text" name="subject_name" id="" value="<?= $subject['subject_name']  ?>" class="form-control"
                placeholder="Enter Subject code">
        </div>
        <div class="col-sm-6">
            <label for="" class="text-capitalize form-label">subject code</label>
            <input type="text" name="subject_code" id="" value="<?= $subject['subject_code']  ?>" class="form-control"
                placeholder="Enter Subject code">
        </div>
        <div class="col-sm-6">
            <label for="" class="text-capitalize form-label">specialization</label>
            <select name="specialization_id" id="specialization_id" class="form-control">
                <option value="" <?= empty($subject['specialization_id']) ? 'selected' : '' ?>></option>
                <option value="<?= $subject['specialization_id'] ?>">
                    <?= fetchRow('tbl_specialization', 'id=' . $subject['specialization_id'] . ' && status="' . $visible . '"')['sp_name'] ?>
                </option>
                <?php while ($spec_row = mysqli_fetch_assoc($spec)) { ?>
                <option value="<?= $spec_row['id'] ?>">
                    <?= $spec_row['sp_name'] ?>
                </option>
                <?php } ?>
            </select>
        </div>
        <div class="col-sm-6">
            <label for="" class="text-capitalize form-label">date of examination</label>
            <input type="date" name="date_of_examination" id="" value="<?= $subject['date_of_examination']  ?>"
                class="form-control" placeholder="">
        </div>
        <div class="col-sm-6">
            <label for="" class="text-capitalize form-label">full marks</label>
            <input type="text" name="full_marks" id="" value="<?= $subject['full_marks']  ?>" class="form-control"
                placeholder="">
        </div>

        <div class="col-sm-6">
            <label for="" class="text-capitalize form-label">pass_marks</label>
            <input type="text" name="pass_marks" id="" value="<?= $subject['pass_marks']  ?>" class="form-control"
                placeholder="">
        </div>
        <div class="col-sm-6">
            <label for="" class="text-capitalize form-label">credit</label>
            <input type="text" name="credit" id="" value="<?= $subject['credit']  ?>" class="form-control"
                placeholder="">
        </div>
    </div>
    <hr>
    <div class=" text-center">
        <button
            onclick="ajaxCall('add_marks_edit','<?= url('include/controller/Edit/add_marks_update') ?>','add_marks_edit')"
            type="button" class="btn btn-primary btn-sm">Save changes</button>
    </div>
    </div>
</form>