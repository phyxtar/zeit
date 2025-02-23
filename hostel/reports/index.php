<?php
$page_no = "17";
$page_no_inside = "17_4";
include_once "../include/authentication.php";
include_once "../include/head.php";
include_once "../include/config.php";
//include_once __DIR__ . "../../../framwork/main.php";
$msg = '';


$building = fetchResult('hostel_building');
?>

<div class="main-panel">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Hostel Allotment System</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Hostel Allotment System</li>
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
                        <h3 class="card-title"> Hostel Allotment System</h3>
                        <?= $msg ?>
                    </div>

                    <form method="POST" id="form_id">
                        <div class="card-body" style="margin-top: 0px;">
                            <div class="row">
                                <div class="col-12" id="error_section"></div>
                                <div class="col-5">
                                    <div class="form-group">
                                        <label>Course Name</label>
                                        <select class="form-control" id="course_id" name="course_id" onchange="change_semester(this.value)">
                                            <option value="0">Select Course</option>
                                            <?php
                                            $sql_course = "SELECT * FROM `tbl_course`
                                                                   WHERE `status` = '$visible';
                                                                   ";
                                            $result_course = $con->query($sql_course);
                                            while ($row_course = $result_course->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $row_course["course_id"]; ?>"><?php echo $row_course["course_name"]; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-5">
                                    <div class="form-group">
                                        <label>Academic Year</label>
                                        <select class="form-control" onchange="showdesg(this.value)" id="session_id" name="academic_year">
                                            <option value="0">Select Academic Year</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-1" style="margin-top: 29px;">
                                    <button type="button" onclick="ajaxCall('form_id', 'get_student', 'success')" class="btn btn-primary">Go</button>
                                </div>

                                <span class="col-12 " id="success"></span>
                            </div>
                        </div>
                    </form>



        </section>
        <!-- /.content -->

    </div>
</div>

<!-- /.card-header -->

<?php
include_once "../../framwork/ajax/method.php";
include "../include/foot.php" ?>
<script>
    function change_semester(semester) {
        $.ajax({
            url: '<?= url('include/ajax/add_semester.php') ?>',
            type: 'POST',
            data: {
                'data': semester
            },
            success: function(result) {
                document.getElementById('session_id').innerHTML = result;
            }

        });
    }

    function showdesg(session) {
        var dept = document.getElementById('course_id').value;
        $.ajax({
            url: '<?= url('ajaxdata.php') ?>',
            type: 'POST',
            data: {
                'depart': dept,
                'session': session
            },
            success: function(data) {
                $("#sem").html(data);
            },
        });

    }
</script>

<script>
    function bed_check(position) {
        var building = document.getElementsByClassName('building')[position]
        var floor = document.getElementsByClassName('floor')[position]
        var room = document.getElementsByClassName('room')[position]
        var bed = document.getElementsByClassName('bed')[position]

    }

    function check_bed1(check_floor, check_room, check_bed) {
        var error = false
        var building = document.getElementsByClassName('building')
        var floor = document.getElementsByClassName('floor')
        var room = document.getElementsByClassName('room')
        var bed = document.getElementsByClassName('bed')
        for (i = 0; i < bed.length; i++) {
            var options_tag = bed[i];
            for (j = 0; j < options_tag.length; j++) {
                console.log(options_tag[j]);
            }

        }

    }
</script>

<style>
    th,
    td {
        font-size: 12px !important;
        padding: 5px !important;
    }
</style>