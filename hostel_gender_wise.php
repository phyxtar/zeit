<?php
$page_no = "17";
$page_no_inside = "17_5";
include_once "include/authentication.php";
include_once "include/head.php";
include_once "include/config.php";
include_once "include/function.php";
$msg = '';
?>

<link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/2.1.5/js/jquery.dataTables.min.js"></script>

<div class="main-panel">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Gender-wise Hostellers</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Gender-wise Hostellers</li>
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
                        <h3 class="card-title">Hostellers</h3>
                    </div>

                    <form role="form" method="POST" id="fetchHostellersData">
                        <div class="card-body" style="margin-top: 0px;">
                            <div class="row">
                                <div class="col-12" id="error_section"></div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Course Name</label>
                                        <select onchange="change_semester(this.value)" class="form-control rounded-pill"
                                            id="course_id" name="course_id">
                                            <option value="all">All</option>
                                            <?php
                                            $sql_course = "SELECT * FROM `tbl_course` WHERE `status` = '$visible' order by course_name asc;";
                                            $result_course = $con->query($sql_course);
                                            while ($row_course = $result_course->fetch_assoc()) {
                                                ?>
                                            <option value="<?php echo $row_course["course_id"]; ?>">
                                                <?php echo $row_course["course_name"]; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Academic Year</label>
                                        <select class="form-control rounded-pill" id="session" name="academic_year">
                                            <option value="0">All</option>
                                            <?php
                                            $sql_ac_year = "SELECT * FROM `tbl_university_details` WHERE `status` = '$visible';";
                                            $result_ac_year = $con->query($sql_ac_year);
                                            while ($row_ac_year = $result_ac_year->fetch_assoc()) {
                                                $completeSessionStart = explode("-", $row_ac_year["university_details_academic_start_date"]);
                                                $completeSessionEnd = explode("-", $row_ac_year["university_details_academic_end_date"]);
                                                $completeSessionOnlyYear = $completeSessionStart[0] . "-" . $completeSessionEnd[0];
                                                ?>
                                            <option value="<?php echo $row_ac_year["university_details_id"]; ?>">
                                                <?php echo $completeSessionOnlyYear; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select class="form-control rounded-pill" id="gender" name="gender">
                                            <option value="all">All</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-5">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control rounded-pill" id="status" name="status">
                                            <option value="all">All</option>
                                            <option value="yes">Active</option>
                                            <option value="no">Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-1" style="margin-top: 29px;">
                                    <button type="button" onclick="getHosttelersData();" id="fetchHostellersDataButton"
                                        class="btn btn-primary rounded-pill">Go</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="row">
                        <div class="col-10"></div>
                        <div class="col-2">
                            <form method="POST" action="/nsucms/export-list" onsubmit="exportHostellersData();">
                                <input type="hidden" id="eCourseId" name="course_id" value="" />
                                <input type="hidden" id="eSessionId" name="session_id" value="" />
                                <input type="hidden" id="eGender" name="gender" value="" />
                                <input type="hidden" id="eStatus" name="status" value="" />
                                <input type="hidden" name="action" value="export_hostellers_details" />
                                <button type="submit" class="btn btn-warning btn-sm" id="exportHostellersDataButton"
                                    style="padding: 8px;"><i class="fa fa-download"></i> Export</button>
                            </form>
                        </div>
                    </div>

                    <div class="col-12" id="loader_section"></div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="hello" class="table table-striped table-bordered" style="width:100%"
                                    role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Reg. No.</th>
                                            <th>Name</th>
                                            <th>Father's Name</th>
                                            <th>Course</th>
                                            <th>Session</th>
                                            <th>Gender</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>

                                    <tbody id="table-body">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="container"></div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>

    <?php include "include/foot.php" ?>

    <script>
    function getHosttelersData() {
        $('#loader_section').append(
            '<center id="loading"><img width="50px" src="/nsucms/images/ajax-loader.gif" alt="Currently loading" /></center>'
        );
        $('#fetchHostellersDataButton').prop('disabled', true);
        var course_id = document.getElementById("course_id").value;
        var session_id = document.getElementById("session").value;
        var gender = document.getElementById("gender").value;
        var status = document.getElementById("status").value;
        $.ajax({
            url: 'get_hosteller_data.php',
            type: 'POST',
            data: {
                'course_id': course_id,
                'session_id': session_id,
                'gender': gender,
                'status': status
            },
            success: function(result) {
                document.getElementById('table-body').innerHTML = result;

                // Initialize DataTable
                $('#hello').DataTable();

                $('#loading').fadeOut(500, function() {
                    $(this).remove();
                });
                $('#fetchHostellersDataButton').prop('disabled', false);
            }
        });
    }

    function exportHostellersData() {
        var course_id = document.getElementById("course_id").value;
        var session_id = document.getElementById("session").value;
        var gender = document.getElementById("gender").value;
        var status = document.getElementById("status").value;
        document.getElementById("eCourseId").value = course_id;
        document.getElementById("eSessionId").value = session_id;
        document.getElementById("eGender").value = gender;
        document.getElementById("eStatus").value = status;
    }
    </script>
</div>