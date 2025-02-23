<?php
$page_no = "16";
$page_no_inside = "16_5";
include_once "include/authentication.php";
include_once "include/head.php";
?>
<link href="https://cdn.datatables.net/v/dt/dt-2.1.2/datatables.min.css" rel="stylesheet">
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include_once 'include/navbar.php'; ?>
        <?php include_once 'include/aside.php'; ?>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Employee Attendence</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Employee Attendence</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Employee Attendence</h3>
                        </div>
                        <form role="form" method="POST" id="">
                        <div class="card-body" style="margin-top: 0px;">
                            <div class="row">
                                <div class="col-12" id="error_section"></div>
                                <div class="col-5">
                                    <div class="form-group">
                                        <label>Select Month</label>
                                        <input type="month" name="selected_month" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-1" style="margin-top: 29px;">
                                    <button type="submit" class="btn btn-primary">Go</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['selected_month'])) {
                        $selected_month = $_POST['selected_month'];
                        $date = new DateTime($selected_month);
                        $days_in_month = $date->format('t'); 

                        $sql = "SELECT * FROM `tbl_staff`";
                        $result = $con->query($sql);
                        $teachers = [];
                        while ($row = $result->fetch_assoc()) {
                            $teachers[] = $row;
                        }

                        $holiday_sql = "SELECT * FROM `tbl_holiday`";
                        $holiday_result = $con->query($holiday_sql);
                        $holidays = [];
                        while ($holiday_row = $holiday_result->fetch_assoc()) {
                            $holidays[] = $holiday_row;
                        }

                        $attendance_sql = "SELECT * FROM `tbl_teacher_attendence` WHERE month = ?";
                        $stmt = $con->prepare($attendance_sql);
                        $stmt->bind_param('s', $selected_month);
                        $stmt->execute();
                        $attendance_result = $stmt->get_result();
                        $attendance_data = [];
                        while ($attendance_row = $attendance_result->fetch_assoc()) {
                            $dates = json_decode($attendance_row['date'], true);
                            $statuses = json_decode($attendance_row['status'], true);
                            foreach ($dates as $index => $date) {
                                $attendance_data[$attendance_row['staff_id']][$date] = $statuses[$index];
                            }
                        }
                        ?>
                        <section class="content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <form id="attendanceForm" action="add_teacher_attendence.php" method="POST">
                                                <input type="hidden" name="selected_month" value="<?= htmlspecialchars($selected_month) ?>">
                                                <input type="hidden" name="days_in_month" value="<?= $days_in_month ?>">
                                                <input type="hidden" name="teacher_data" id="teacherData">
                                                <table class="table table-bordered table-responsive table-striped p-2" id="example1">
                                                    <thead>
                                                        <tr>
                                                            <th>Teacher Name</th>
                                                            <?php for ($day = 1; $day <= $days_in_month; $day++) { ?>
                                                                <th><?= $day ?></th>
                                                            <?php } ?>
                                                            <th>Report</th>
                                                            <th>Action</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($teachers as $teacher) { 
                                                            $total_present = 0;
                                                            $total_absent = 0;
                                                            $total_working_days = 0;
                                                            $teacher_id = $teacher['id'];
                                                            ?>
                                                            <tr>
                                                                <td><?= htmlspecialchars($teacher['name']) ?>
                                                                    <input type="hidden" name="employee_id[<?= $teacher_id ?>]" value="<?= htmlspecialchars($teacher_id) ?>">
                                                                </td>
                                                                <?php for ($day = 1; $day <= $days_in_month; $day++) {
                                                                    $current_date = new DateTime($selected_month . '-' . $day);
                                                                    $is_sunday = $current_date->format('N') == 7;

                                                                    $is_holiday = false;
                                                                    foreach ($holidays as $holiday) {
                                                                        $holiday_start = new DateTime($holiday['h_date_from']);
                                                                        $holiday_end = new DateTime($holiday['h_date_to']);
                                                                        if ($current_date >= $holiday_start && $current_date <= $holiday_end) {
                                                                            $is_holiday = true;
                                                                            break;
                                                                        }
                                                                    }

                                                                    if (!$is_sunday && !$is_holiday) {
                                                                        $total_working_days++;
                                                                    }

                                                                    $attendance_key = "attendance[$teacher_id][day$day]";
                                                                    $attendance_status = isset($attendance_data[$teacher_id][$attendance_key]) ? $attendance_data[$teacher_id][$attendance_key] : '';
                                                                    ?>
                                                                    <td>
                                                                        <?php if ($is_sunday) { ?>
                                                                            <span class="text-danger text-bold">S</span>
                                                                            <input type="hidden" name="attendance[<?= $teacher_id ?>][day<?= $day ?>]" value="sunday">
                                                                        <?php } elseif ($is_holiday) { ?>
                                                                            <span class="text-danger text-bold">H</span>
                                                                            <input type="hidden" name="attendance[<?= $teacher_id ?>][day<?= $day ?>]" value="holiday">
                                                                        <?php } else { ?>
                                                                            <select name="attendance[<?= $teacher_id ?>][day<?= $day ?>]" class="attendance-select">
                                                                                <option value="" hidden>-S-</option>
                                                                                <option value="present" <?= $attendance_status == 'present' ? 'selected' : '' ?>>P</option>
                                                                                <option value="absent" <?= $attendance_status == 'absent' ? 'selected' : '' ?>>A</option>
                                                                            </select>
                                                                        <?php } ?>
                                                                    </td>
                                                                <?php } ?>
                                                                <td id="report<?= $teacher_id ?>">
                                                                    TD: <?= $days_in_month ?><br>
                                                                    WD: <?= $total_working_days ?><br>
                                                                    TP: <span id="presentCount<?= $teacher_id ?>">0</span><br>
                                                                    TA: <span id="absentCount<?= $teacher_id ?>">0</span><br>
                                                                </td>

                                                                <td>
                                                                <input type="number" class="form-control form-control-sm mb-1" placeholder="P Days" id="inputPresent<?= $teacher_id ?>" name="inputPresent[<?= $teacher_id ?>]" min="0" max="<?= $total_working_days ?>" onchange="setDays(<?= $teacher_id ?>, 'present', this.value)">
                                                                <input type="number" class="form-control form-control form-control-sm" placeholder="A Days" id="inputAbsent<?= $teacher_id ?>" name="inputAbsent[<?= $teacher_id ?>]" min="0" max="<?= $total_working_days ?>" onchange="setDays(<?= $teacher_id ?>, 'absent', this.value)">
                                                                </td>

                                                                <td class="d-flex justify-content-around">
                                                                    <button type="button" class="btn btn-primary btn-sm" onclick="markAllDays(<?= $teacher_id ?>, 'present')">P All</button>
                                                                    <button type="button" class="btn btn-danger btn-sm mx-2" onclick="markAllDays(<?= $teacher_id ?>, 'absent')">A All</button>
                                                                    <button type="button" id="saveBtn<?= $teacher_id ?>" class="btn btn-success btn-sm" onclick="submitAttendance(<?= $teacher_id ?>)">Save</button>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </form>
                    
                                            <script>
                                                function setDays(teacherId, status, days) {
                                                    const selects = document.querySelectorAll(`[name^="attendance[${teacherId}]"]`);
                                                    let count = 0;
                                                    selects.forEach(select => {
                                                        if (count < days && select.tagName === 'SELECT') {
                                                            select.value = status;
                                                            count++;
                                                        }
                                                    });
                                                    updateReport(teacherId);
                                                }

                                                function updateReport(teacherId) {
                                                    let presentCount = 0;
                                                    let absentCount = 0;

                                                    const selects = document.querySelectorAll(`[name^="attendance[${teacherId}]"]`);
                                                    selects.forEach(select => {
                                                        if (select.tagName === 'SELECT') {
                                                            if (select.value === 'present') {
                                                                presentCount++;
                                                            } else if (select.value === 'absent') {
                                                                absentCount++;
                                                            }
                                                        }
                                                    });

                                                    document.getElementById(`presentCount${teacherId}`).textContent = presentCount;
                                                    document.getElementById(`absentCount${teacherId}`).textContent = absentCount;
                                                }
                                                const savedTeachers = new Set();

                                                function markAllDays(teacherId, status) {
                                                    const selects = document.querySelectorAll(`[name^="attendance[${teacherId}]"]`);
                                                    selects.forEach(select => {
                                                        if (select.tagName === 'SELECT') {
                                                            select.value = status;
                                                        }
                                                    });
                                                    updateReport(teacherId);
                                                }

                                                function submitAttendance(teacherId) {
                                                    if (savedTeachers.has(teacherId)) {
                                                        return;  
                                                    }

                                                    let attendanceData = {};
                                                    const inputs = document.querySelectorAll(`[name^="attendance[${teacherId}]"]`);
                                                    inputs.forEach(input => {
                                                        if (input.type === 'hidden' || input.value) {
                                                            const name = input.name;
                                                            const value = input.value;
                                                            attendanceData[name] = value;
                                                        }
                                                    });
                                                    const teacherDataInput = document.getElementById('teacherData');
                                                    teacherDataInput.value = JSON.stringify({
                                                        teacher_id: teacherId,
                                                        attendance: attendanceData
                                                    });

                                                    document.getElementById('attendanceForm').submit();
                                                    savedTeachers.add(teacherId);
                                                }

                                                function updateReport(teacherId) {
                                                    let presentCount = 0;
                                                    let absentCount = 0;

                                                    const selects = document.querySelectorAll(`[name^="attendance[${teacherId}]"]`);
                                                    selects.forEach(select => {
                                                        if (select.tagName === 'SELECT') {
                                                            if (select.value === 'present') {
                                                                presentCount++;
                                                            } else if (select.value === 'absent') {
                                                                absentCount++;
                                                            }
                                                        }
                                                    });

                                                    document.getElementById(`presentCount${teacherId}`).textContent = presentCount;
                                                    document.getElementById(`absentCount${teacherId}`).textContent = absentCount;
                                                }

                                                document.querySelectorAll('.attendance-select').forEach(select => {
                                                    select.addEventListener('change', event => {
                                                        const teacherId = event.target.name.match(/\d+/)[0];
                                                        updateReport(teacherId);
                                                    });
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    <?php } ?>
                    </div>
                </div>
        </div>
        </section>
    </div>

    <script src="https://cdn.datatables.net/v/dt/dt-2.1.2/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $(function () {
            $('#example1').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });
    </script>
    <?php 
    include_once 'include/foot.php';
    include_once 'framwork/ajax/method.php'
    ?>
</body>
</html>
