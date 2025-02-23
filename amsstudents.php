<?php
$page_no = "18";
$page_no_inside = "18_2";
include_once "include/authentication.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NETAJI SUBHAS UNIVERSITY | Students</title>
    <link rel="icon" href="images/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include_once 'include/navbar.php'; ?>
        <?php include_once 'include/aside.php'; ?>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>AMS Student List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">AMS Student</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="float-sm-right">
                                    <button type="button" class="btn btn-primary"
                                        onclick="showModal('add_courses_with_excel')">
                                        <i class="fa fa-upload"></i> Import
                                    </button>
                                    <button type="button" class="btn btn-success" onclick="showModal('add_amsstudent')">
                                        Add Student
                                    </button>
                                </div>
                            </div>
                            <div class="card-body" id="data_table">
                                <!-- Dynamic content from the database -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Import Students Modal -->
            <div id="add_courses_with_excel" class="w3-modal" style="z-index:2020;">
                <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
                    <header class="w3-container" style="background:#343a40; color:white;">
                        <span onclick="hideModal('add_courses_with_excel')"
                            class="w3-button w3-display-topright">&times;</span>
                        <h2 align="center">Import Students via CSV</h2>
                    </header>
                    <div class="card-body">
                        <div class="form-group">
                            <a href="import_students.csv" download class="" style="font-weight: 600;">Download Sample
                                CSV</a>
                        </div>
                        <form id="import_csv_form" enctype="multipart/form-data" method="POST">
                            <div class="form-group">
                                <label>Select CSV File</label>
                                <input type="file" name="csv_file" class="form-control" accept=".csv" required>
                            </div>
                            <button type="button" id="import_csv_button" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Add Student Modal -->
            <div id="add_amsstudent" class="w3-modal" style="z-index:2020;">
                <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
                    <header class="w3-container" style="background:#343a40; color:white;">
                        <span onclick="hideModal('add_amsstudent')" class="w3-button w3-display-topright">&times;</span>
                        <h2 align="center">Add Student</h2>
                    </header>
                    <form action="include/controller/add_amsstudent.php" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Student Name</label>
                                <input type="text" name="add_student_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Student Roll No.</label>
                                <input type="text" name="add_roll_no" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Parent Mob No.</label>
                                <input type="text" name="add_parent_no" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Alt No.</label>
                                <input type="text" name="add_alt_no" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Date Of Birth</label>
                                <input type="date" name="add_dob" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Select Grade</label>
                                <select name="add_grade" class="form-control" required>
                                    <option value="">Select Grade</option>
                                    <?php
                                    $sql = "SELECT * FROM `tbl_grade`";
                                    $result = $con->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<option value="' . htmlspecialchars($row["grade_id"]) . '">' . htmlspecialchars($row["grade_name"]) . '</option>';
                                        }
                                    } else {
                                        echo '<option value="">No Grades available</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <input type="hidden" name="action" value="add_amsstudent">
                            <input class="btn btn-primary" type="submit" value="Submit">
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php include_once 'include/footer.php'; ?>

        <aside class="control-sidebar control-sidebar-dark"></aside>
    </div>

    <!-- Scripts -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <script src="dist/js/adminlte.min.js"></script>

    <script>
    $(function() {
        loadStudentTable();
        $('#import_csv_button').click(function() {
            handleFormSubmission('#import_csv_form', 'import_student.php', true);
        });
    });

    function loadStudentTable() {
        $.ajax({
            url: 'include/view.php?action=get_Student',
            method: 'GET',
            success: function(result) {
                $("#data_table").html(result);
            }
        });
    }

    function handleFormSubmission(formId, url, isFile = false) {
        const formData = isFile ? new FormData($(formId)[0]) : $(formId).serialize();
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: !isFile,
            contentType: isFile ? false : 'application/x-www-form-urlencoded',
            success: function(result) {
                alert(result);
                loadStudentTable();
                $(formId)[0].reset();
            }
        });
    }

    function showModal(id) {
        document.getElementById(id).style.display = 'block';
    }

    function hideModal(id) {
        document.getElementById(id).style.display = 'none';
    }
    </script>
</body>

</html>