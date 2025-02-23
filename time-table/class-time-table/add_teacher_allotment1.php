<?php



$page_no = "15";
$page_no_inside = "15_4";
include_once "../include/authentication.php";
include_once "../include/head.php";
include_once "../include/config.php";


$sql = "SELECT * FROM `tbl_course`";
$courseresult = $con->query($sql);

$sql = "SELECT * FROM `time_tbl_subject`";
$subresult = $con->query($sql);
$msg = '';
if (isset($_POST['staff_id']) && $_POST['staff_id'] != '') {
        for ($i = 0; $i < count($_POST['course_id']); $i++) {

                $data['staff_id'] = $_POST['staff_id'];
                $data['course_id'] = $_POST['course_id'][$i];
                $data['subject_id'] = $_POST['subject_id'][$i];
                $data['academic_year'] = $_POST['academic_year'][$i];
                $data['semester_id'] = $_POST['semester_id'][$i];
                $result = insertAll('teacher_allot_tbl', $data);
        }
        if ($result == "success") {
                $msg =  success_alert('Data Added Successfully');
                reload(1);
        } else {
                echo $msg = danger_alert($conn->error);
        }
}




?>



<div class="main-panel">
        <div class="content-wrapper">
                <section class="content-header">
                        <div class="container-fluid">
                                <div class="row mb-2">
                                        <div class="col-sm-6">
                                                <!-- <h1>Teacher Allotment</h1> -->
                                        </div>

                                        <div class="col-sm-6">
                                                <ol class="breadcrumb float-sm-right">
                                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                                        <li class="breadcrumb-item active">Teacher Allotment</li>
                                                </ol>
                                        </div>
                                </div>
                        </div><!-- /.container-fluid -->
                </section>


                <!-- Main content -->
                <section class="content">
                        <div class="container-fluid">
                                <!-- SELECT2 EXAMPLE -->
                                <div class="card card-default">
                                        <div class="card-header">
                                                <h3 class="card-title">Add Teacher Allotment</h3>
                                                <?= $msg ?>
                                        </div>
                                        <form action="" role="form" method="POST" id="">
                                                <div class="card-body">
                                                        <div class="row">
                                                                <div class="col-md-12" id="error_section"></div>
                                                                <div class="col-3">
                                                                        <label>Faculty</label>
                                                                        <select name="staff_id" class="form-control select2" id="staff">
                                                                                <!-- <select name="staff_id" id="staff" data-live-search="true" data-live-search-style="startsWith" class="selectpicker"> -->
                                                                                <?php
                                                                                $sql_staff = "SELECT * FROM `tbl_staff` WHERE `desg_id` = '1'";
                                                                                $res = $con->query($sql_staff);

                                                                                ?>

                                                                                <option value="">Select Faculty</option>
                                                                                <?php
                                                                                while ($staff_row = $res->fetch_assoc()) {
                                                                                        echo '<option value="' . $staff_row['id'] . '">' . $staff_row['name'] . '</option>';

                                                                                ?>

                                                                                <?php } ?>
                                                                        </select>

                                                                </div>
                                                        </div>

                                                        <div id="dynamic_field" class="col-md-12">
                                                                <div class="col-md-4">
                                                                        <label>Course</label>
                                                                        <!-- <select name="course_id[]" style="width:100%;" data-live-search="true" data-live-search-style="startsWith" class="selectpicker"> -->
                                                                        <select name="course_id" class="form-control select2">

                                                                                <option value="">Select Course</option>
                                                                                <?php
                                                                                $sql = "SELECT * FROM `tbl_course`";
                                                                                $result = $con->query($sql);
                                                                                while ($course_row = $result->fetch_assoc()) { ?>
                                                                                        <option value="<?= $course_row['course_id'] ?>"><?= $course_row['course_name'] ?></option>

                                                                                <?php } ?>
                                                                        </select>

                                                                </div>
                                                        </div>

                                                        <div class="col-md-4" id="">
                                                                <label>Subject</label>
                                                                <!-- <select name="subject_id[]" data-live-search="true" data-live-search-style="startsWith" class="selectpicker"> -->
                                                                <select name="subject_id[]" class="form-control select2">


                                                                        <option value="">Select Subject</option>
                                                                        <?php
                                                                        $sql = "SELECT * FROM `time_tbl_subject`";
                                                                        $result = $con->query($sql);
                                                                        while ($sub_row = $result->fetch_assoc()) { ?>
                                                                                <option value="<?= $sub_row['id'] ?>"><?= $sub_row['subject_name'] ?></option>

                                                                        <?php } ?>
                                                                </select>

                                                        </div>

                                                        <div class="col-md-3">
                                                                <label>Action</label><br>
                                                                <button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                        </div>

                                                </div>



                                </div>
                                <input type="submit" name="staff_allot" value="Submit" class="btn btn-primary">
                        </div>



                        </form>
        </div>

</div>

</div>
</section>
<!-- /.content -->


</div>
</div>



<?php include "../include/foot.php" ?>



<?php include "../../framwork/ajax/method.php";
?>
<script type="text/javascript">
        $('.select2').select2();

        $(document).ready(function() {


                var i = 1;

                $('#add').click(function() {
                        i++;
                        $('#dynamic_field').append(
                                '<div class="col-md-4" id="rowdata">' +
                                '<label>Course</label>' +
                                '<select name="course_id[]" class="form-control select2">' +
                                '<option value="">Select Course</option>' +
                                '<?php while ($row = mysqli_fetch_array($courseresult)) { ?>' +
                                '<option value="<?php echo $row['course_id'] ?>"><?php echo $row['course_name'] ?></option>' +
                                '<?php } ?>' +
                                '</select>' +
                                '</div>' +
                                '<div class="col-md-4">' +
                                '<label>Subject</label>' +
                                '<select name="subject_id[]" class="form-control select2">' +
                                '<option value="">Select Subject</option>' +
                                '<?php while ($sub_row = mysqli_fetch_array($subresult)) { ?>' +
                                '<option value="<?php echo $sub_row['id'] ?>"><?php echo $sub_row['subject_name'] ?></option>' +
                                '<?php } ?>' +
                                '</select>' +
                                '</div>' +
                                '<div class="col-md-3"><label>action</label><br><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></div></div></div>'

                        );



                        $(document).on('click', '.btn_remove', function() {
                                var button_id = $(this).attr("id");
                                //$('#rowdata' + button_id + '').remove();
                                $(this).closest("#rowdata").remove();
                        });

                });

        });

        $('.select2').select2();



        function get_subject_bycourseid(cid) {
                $.ajax({
                        url: '<?= url('time-table/class-time-table/get_subject_bycourseid') ?>',
                        type: 'POST',
                        data: {
                                'cid': cid
                        },
                        success: function(result) {
                                document.getElementById('subject').innerHTML = result;
                        }

                });
        }




        function myFunction() {
                $.ajax({
                        url: '<?= url('time-table/class-time-table/get_coursedata') ?>',
                        type: 'POST',
                        data: {

                        },
                        success: function(result) {
                                document.getElementById('subject').innerHTML = result;
                        }

                });
        }





        //         var select_box_element = document.querySelector('#select_box');

        //          dselect(select_box_element, {
        //          search: true
        // });
</script>