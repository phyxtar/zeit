<div class="col-md-4">
    <!-- Profile Image -->
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            <div class="text-center">
                <?php
                if (!empty($row["admission_profile_image"])) {
                ?>
                <img class="profile-user-img "
                    src="images/student_images/<?php echo $row["admission_profile_image"]; ?>"
                    alt="Student profile picture">
                <?php
                } else if (strtolower($row["admission_gender"]) == "female") {
                ?>
                <img class="profile-user-img img-fluid img-circle" src="images/womenIcon.png"
                    alt="Student profile picture">
                <?php } else {   ?>
                <img class="profile-user-img img-fluid img-circle" src="images/menIcon.png"
                    alt="Student profile picture">
                <?php } ?>
            </div>

            <h3 class="profile-username text-center">
                <?php echo $row["admission_first_name"] . " " . $row["admission_last_name"]; ?></h3>
            <?php
            $completeSessionStart = explode("-", $row["university_details_academic_start_date"]);
            $completeSessionEnd = explode("-", $row["university_details_academic_end_date"]);
            $completeSessionOnlyYear = $completeSessionStart[0] . "-" . $completeSessionEnd[0];
            ?>
            <p class="text-muted text-center">( <?php echo $row["course_name"] . " | " . $completeSessionOnlyYear; ?> )
            </p>

            <p>
                <b>Reg. No</b> <a class="float-right"><?php echo $row["admission_id"]; ?></a></br>
                <b>Course Name</b> <a class="float-right"><?php echo $row["course_name"]; ?></a></br>
                <b>Session</b> <a class="float-right"><?php echo $completeSessionOnlyYear; ?></a></br>
                <b>Hostel</b> <a class="float-right"><?php echo $row["admission_hostel"]; ?></a></br>
                <b>User Name</b> <a class="float-right"><?php echo $row["admission_username"]; ?></a></br>
                <b>Hostel Join Date</b> <a class="float-right"><?php echo $row["hostel_join_date"]; ?></a></br>
                <b>Hotel Leave Date</b> <a class="float-right"><?php echo $row["hostel_leave_date"]; ?></a></br>
                <b>Status</b> <span
                    class="badge <?php echo $row["stud_status"] == 0 ? "badge-danger" : "badge-success"; ?> float-right"><?php echo $row["stud_status"] == 0 ? "Inactive" : "Active"; ?></span>
            </p>

        </div>
        <!-- /.card-body -->
    </div>
</div>
<div class="col-md-4">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">About <?php echo $row["admission_first_name"]; ?></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <strong><i class="fas fa-user mr-1"></i> Personal Details</strong>
            <p class="text-muted">
                <b>Name - </b><?php echo $row["admission_first_name"] . " " . $row["admission_last_name"]; ?><br />
                <b>Gender - </b><?php echo $row["admission_gender"]; ?><br />
                <b>DOB - </b><?php echo $row["admission_dob"]; ?><br />
                <b> Nationality - </b><?php echo $row["admission_nationality"]; ?><br />
                <b> Blood Group - </b><?php echo $row["admission_blood_group"]; ?><br />
                <b> Email - </b><?php echo $row["admission_emailid_student"]; ?><br />
                <b>Contact No - </b><?php echo $row["admission_mobile_student"]; ?><br />
                <b>Father's Name - </b><?php echo $row["admission_father_name"]; ?><br />
                <b>Father's Email - </b><?php echo $row["admission_emailid_father"]; ?><br />
                <b>Father's Contact - </b><?php echo $row["admission_father_phoneno"]; ?><br />
                <b>Father's Whatsapp - </b><?php echo $row["admission_father_whatsappno"]; ?><br />
                <b> Mother's Name - </b><?php echo $row["admission_mother_name"]; ?><br />
            </p>
        </div>
    </div>
</div>
<div class="col-md-4">
    <!-- About Me Box -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">More Informations</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <h6><i class="fas fa-book mr-1"></i> Educational Details (10th)</h6>
            <p class="text-muted">
                University - <?php echo $row["admission_high_school_board_university"]; ?><br />
                College - <?php echo $row["admission_high_school_college_name"]; ?><br />
                Passing Year - <?php echo $row["admission_high_school_passing_year"]; ?><br />
                Percentage - <?php echo $row["admission_high_school_per"]; ?> %<br />
            </p>

            <h6><i class="fas fa-map-marker-alt mr-1"></i> Location</h6>
            <p class="text-muted">
                <?php echo $row["admission_residential_address"]; ?>,<br />
                <?php echo $row["admission_city"]; ?>, </br><?php echo $row["admission_state"]; ?><br />
                <?php echo $row["admission_district"]; ?>,<br />
                <?php echo $row["admission_pin_code"]; ?><br />
            </p>
        </div>
        <!-- /.card-body -->

    </div>
    <!-- /.card-body -->
</div>