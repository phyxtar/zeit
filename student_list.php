<?php
$page_no = "6";
$page_no_inside = "6_4";
include_once "include/authentication.php";
include_once "include/head.php";
include_once "include/PHPExcel/PHPExcel.php";

// Fetch admin details
$logger_username = $_SESSION["logger_username"];
$sql_admin = "SELECT admin_type, hod_permission FROM tbl_admin WHERE admin_username = '$logger_username'";
$result_admin = $con->query($sql_admin);
$admin_data = $result_admin->fetch_assoc();
$admin_type = $admin_data['admin_type'];
$hod_permission = $admin_data['hod_permission'];

// Adjust SQL query based on admin type
$sql_course = "SELECT * FROM `tbl_course` WHERE `status` = '$visible' ";
if ($admin_type == 'hod') {
    $hod_permission_array = json_decode($hod_permission, true);
    $hod_permission_list = implode(",", $hod_permission_array);
    $sql_course .= "AND `course_id` IN ($hod_permission_list) ";
}
$sql_course .= "ORDER BY `course_name` ASC";
$result_course = $con->query($sql_course);

if (isset($_POST["import_spec"])) {

    if ($_FILES['importExcelFile']['error'] == 0) {
        $inputFileName = $_FILES['importExcelFile']['tmp_name'];

        // Load the file
        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($inputFileName);

        // Get worksheet dimensions
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        // Prepare the SQL query to update both columns
        $stmt = $con->prepare("UPDATE `tbl_admission` 
                               SET `specialization_id` = ?, `specialization_id_dual` = ? 
                               WHERE `admission_id` = ?");

        for ($i = 5; $i <= $highestRow; $i++) {
            // Read data from columns C (admission_id), F (specialization_id), and G (specialization_id_dual)
            $data = $sheet->rangeToArray(
                'C' . $i . ':G' . $i,
                NULL,
                TRUE,
                FALSE
            );

            // Check and handle blank fields for specialization_id and specialization_id_dual
            $specialization_id = !empty($data[0][3]) ? $data[0][3] : NULL;
            $specialization_id_dual = !empty($data[0][4]) ? $data[0][4] : NULL;

            if (!empty($data[0][0])) {
                // Bind the parameters: specialization_id, specialization_id_dual, and admission_id
                $stmt->bind_param("ssi", $specialization_id, $specialization_id_dual, $data[0][0]);
                $stmt->execute();
            }
        }
    } else {
        echo "File upload failed! Error: " . $_FILES['importExcelFile']['error'];
    }
}
?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php include_once 'include/navbar.php'; ?>
        <?php include_once 'include/aside.php'; ?>

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Student List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Student List</li>
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
                            <h3 class="card-title">Student List</h3>

                        </div>
                        <form class="form-horizontal" id="" action="" method="post" enctype="multipart/form-data">
                            <div class="input-row" style="margin-top: 5px">
                                <label class="col-md-3 control-label">&nbsp;Choose Excel
                                    File</label> <input type="file" name="importExcelFile" />
                                <input type="submit" name="import_spec" class="btn btn-success btn-sm" value="Import" />
                            </div>
                        </form>
                        <form role="form" method="POST" id="fetchStudentDataForm">
                            <div class="card-body" style="margin-top: 0px;">
                                <div class="row">
                                    <div class="col-12" id="error_section"></div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label>Course Name</label>
                                            <select class="form-control" name="course_id" id="course_id"
                                                onchange="change_semester(this.value); change_spec(this.value);">
                                                <option value="0">Select Course</option>
                                                <?php while ($row_course = $result_course->fetch_assoc()) { ?>
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
                                            <select class="form-control" multiple id="session_check"
                                                name="academic_year[]" onclick="multiselect(this)">
                                                <option value="all">All</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-1" style="margin-top: 29px;">
                                        <button type="submit" id="fetchStudentDataButton"
                                            class="btn btn-primary">Go</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="col-12" id="loader_section"></div>
                        <!-- /.card-header -->
                        <div class="card-body" id="data_table">

                        </div>
                    </div>

                </div>

        </div>
        </section>
        <!-- /.content -->
    </div>

    <?php include_once 'include/foot.php';
    include_once 'framwork/ajax/method.php'
        ?>
    <script>
        $(document).ready(function () {
            $('#fetchStudentDataForm').submit(function (event) {
                $('#loader_section').append(
                    '<center id = "loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /></center>'
                );
                $('#fetchStudentDataButton').prop('disabled', true);
                $.ajax({
                    url: 'pages/student/view.php?action=fetch_student_list_details',
                    type: 'POST',
                    data: $('#fetchStudentDataForm').serializeArray(),
                    success: function (result) {
                        $('#response').remove();
                        if (result == 0) {
                            $('#error_section').append(
                                '<div id = "response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Please select Academic Year!!!</div></div>'
                            );
                        } else {
                            $('#data_table').append('<div id = "response">' + result +
                                '</div>');
                        }
                        $('#loading').fadeOut(500, function () {
                            $(this).remove();
                        });
                        $('#fetchStudentDataButton').prop('disabled', false);
                    }
                });
                event.preventDefault();
            });
        });
    </script>
    <script>
        function change_semester(semester) {
            $.ajax({
                url: 'include/ajax/add_semester_for_student.php',
                type: 'POST',
                data: {
                    'data': semester
                },
                success: function (result) {
                    document.getElementById('session_check').innerHTML = result;
                }

            });
        }
    </script>
</body>

</html>