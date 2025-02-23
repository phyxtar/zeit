<?php
include "config.php";
?>


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">

    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">PERSONAL DETAILS</h3>
        </div>

        <div class="card-body table-responsive p-0">
            <div class="card-body">
                <div class="row">

                    <div class="col-4">

                        <label>Registration Number <small>(To be filled by the office)</small></label>
                        <input id="" type="text" name="reg_id" value="" class="form-control rounded-pill">

                    </div>

                    <div class="col-4">
                        <label>Roll Number <small>(To be filled by the candidate)</small></label>
                        <input id="" type="text" name="roll_no" class="form-control rounded-pill" value="">
                    </div>

                    <div class="col-4">
                        <label>Candidate's Name</label>
                        <input id="" type="text" name="candidate_name" class="form-control rounded-pill" value=""
                            readonly>
                    </div>
                    <div class="col-4">
                        <label>Date of Birth</label>
                        <input id="" type="text" name="DOB" class="form-control rounded-pill" value="" readonly>
                    </div>
                    <div class="col-4">
                        <label>Gender</label>
                        <input id="" type="text" name="gender" class="form-control rounded-pill" value="" readonly>
                    </div>

                    <div class="col-4">
                        <label>Father's Name</label>
                        <input id="" type="text" name="father_name" class="form-control rounded-pill" value="" readonly>
                    </div>
                    <div class="col-4">
                        <label>Mother's Name</label>
                        <input id="" type="text" name="mother_name" class="form-control rounded-pill" value="" readonly>
                    </div>
                    <div class="col-4">
                        <label>Candidate Signature ( <span class="text-danger">max 200kb</span> )</label>
                        <input type="file" onchange="image_check(this,200)" name="candidate_signature"
                            class="form-control rounded-pill" required>
                    </div>

                    <div class="col-4">
                        <label>Candidate Passport Photo ( <span class="text-danger">max 200kb</span> )</label>
                        <input type="file" onchange="image_check(this,200)" name="passport_photo"
                            class="form-control rounded-pill" required>
                    </div>

                    <div class="col-8">
                        <label>Passport Size Photograph</label><br>
                        <input type="hidden" name="passport_photo" class="form-control rounded-pill"
                            value="<?php echo $row["admission_profile_image"]; ?>">
                        <img class="profile-user-img "
                            src="../images/student_images/<?php echo $row["admission_profile_image"]; ?>"
                            alt="Student profile picture">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">PERSONAL DETAILS</h3>
        </div>

        <div class="card-body table-responsive p-0">
            <div class="card-body">
                <small>In case the candidate is in guardianship other than mother and father, specify name and
                    relation.</small>
                <div class="row">

                    <div class="col-6">
                        <label>Name</label>
                        <input id="" type="text" name="guardians_name" class="form-control rounded-pill" value="">
                    </div>
                    <div class="col-6">
                        <label>Relationship</label>
                        <input id="" type="text" name="guardians_relation" class="form-control rounded-pill" value="">
                    </div>

                </div>
                <small>Parent Guardians Occupation:</small>
                <div class="row">
                    <div class="col-6">
                        <label>Father</label>
                        <input id="" type="text" name="father_occu" class="form-control rounded-pill" value="">
                    </div>
                    <div class="col-6">
                        <label>Mother</label>
                        <input id="" type="text" name="mother_occu" class="form-control rounded-pill" value="">
                    </div>
                </div>
                <small>Parent Guardians Education:</small>
                <div class="row">
                    <div class="col-6">
                        <label>Father</label>
                        <input id="" type="text" name="father_edu" class="form-control rounded-pill" value="">
                    </div>
                    <div class="col-6">
                        <label>Mother</label>
                        <input id="" type="text" name="mother_edu" class="form-control rounded-pill" value="">
                    </div>
                </div>

                <div class="row">
                    <div class="col-4">
                        <label>Religion</label>
                        <input id="" type="text" name="religion" class="form-control rounded-pill" value="">
                    </div>
                    <div class="col-4">
                        <label>Nationality</label>
                        <input id="" type="text" name="nationality" class="form-control rounded-pill" value="">
                    </div>
                </div>
            </div>
        </div>
        <p> <input type="checkbox" required> Declaration By the Student :</p>
        <p style="text-align:justify;">I hereby declare that I have read and understood the instructions given above. I
            also
            affirm that I have submitted all the required numbers of assignment as applicable for the aforesaid course
            filled in the examination form and my registration for the course is valid and not time barred. If any of my
            statements is found to be untrue, I will have no claim for appearing in the examination. I undertake that I
            shall abide by the rules and regulations of the University.</p>

        <tr>
            <td height="40" colspan="8" valign="middle" align="center" class="narmal">
                <input type="submit" name="submit" value="Next" class="btn btn-primary">
            </td>
        </tr>
</form>