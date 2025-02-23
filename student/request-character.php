<?php 
    $page_no = "5";
    $page_no_inside = "5_2";
    include "include/authentication.php"; 
	$sql = "SELECT * FROM `tbl_admission` WHERE `status` = '$visible' && `admission_username` = '".$_SESSION["logger_username1"]."'";
	$result = $con->query($sql);
	$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NETAJI SUBHAS UNIVERSITY | Character Certificate </title>
    <!-- Fav Icon -->
    <link rel="icon" href="images/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>


<?php
$admission_id = $_SESSION['user']['admission_id'];

// Fetch reg_no from tbl_allot_semester
$sql = "SELECT * FROM `tbl_allot_semester` WHERE `admission_id` = '$admission_id' AND `status` = '$visible'";
$result = $con->query($sql);
$row = $result->fetch_assoc();
$reg_no = $row['reg_no'];
$roll_no = $row['roll_no'];
$course_id = $row['course_id'];
$academic_year = $row['academic_year'];
// echo $reg_no;

// Fetch course name from tbl_course
$sql_course = "SELECT course_name FROM `tbl_course` WHERE `course_id` = '$course_id' AND `status` = '$visible'";
$result_course = $con->query($sql_course);
$row_course = $result_course->fetch_assoc();
$course_name = $row_course['course_name'];
// echo $course_name;

// Fetch session from tbl_university_details
$sql_session = "SELECT academic_session FROM `tbl_university_details` WHERE `university_details_id` = '$academic_year' AND `status` = '$visible'";
$result_session = $con->query($sql_session);
$row_session = $result_session->fetch_assoc();
$session = $row_session['academic_session'];
// echo $session;
//   echo "<pre>";
//             print_r($_SESSION['user']);
//         echo "</pre>";
?>

<body class="hold-transition sidebar-mini">
    <?php include 'imp_notice.php'; ?>
    <div class="wrapper">

        <?php include 'include/navbar.php'; ?>
        <?php include 'include/aside.php'; ?>

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Character Certificate </h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Character Certificate</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" id="data_table">

                                <div class="text-center">
                                    <?php
    $admission_id = $_SESSION['user']['admission_id'];
    $sql_check = "SELECT * FROM `tbl_character` WHERE `student_id` = '$admission_id'";
    $result_check = $con->query($sql_check);
    if ($result_check->num_rows == 0) {
    ?>
                                    <p class="text-danger"><b>NOTE:</b> You can request for Character certificate only
                                        once, when you have successfully completed all your semester examinations.</p>
                                    <form id="provisionalForm" method="POST">
                                        <input type="hidden" name="student_id"
                                            value="<?php echo $_SESSION['user']['admission_id']; ?>">
                                        <input type="hidden" name="session" value="<?php echo $session; ?>">
                                        <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
                                        <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
                                        <input type="hidden" name="reg_no" value="<?php echo $reg_no; ?>">
                                        <input type="hidden" name="roll_no" value="<?php echo $roll_no; ?>">
                                        <input type="hidden" name="date_and_time"
                                            value="<?php echo date('Y-m-d H:i:s'); ?>">
                                        <input type="hidden" name="status" value="pending">
                                        <button type="submit" class="btn btn-warning">Request For Character
                                            Certificate</button>

                                    </form>
                                    <?php
    } else {
        $row = $result_check->fetch_assoc();
        if ($row['status'] == 'pending') {
            echo '<p id="successMessage" class="text-success">
    <b>Thank you for applying!</b><br>
    Your request has been successfully submitted. Please wait while we process your character certificate.<br><br>
    <b><i>Note: Once your character certificate is approved and ready, you will receive a notification below. You can then collect it from the Examination Department.</i></b>
</p>';
        }  else {
            echo '<p class="text-warning">Your request status: ' . $row['status'] . '</p>';
        }
    }
    ?>
                                </div>


                            </div>

                            <script>
                            document.getElementById('provisionalForm').addEventListener('submit', function(e) {
                                e.preventDefault();

                                var formData = new FormData(this);

                                fetch('', {
                                        method: 'POST',
                                        body: formData
                                    })
                                    .then(response => response.text())
                                    .then(data => {
                                        document.getElementById('provisionalForm').style.display = 'none';
                                        document.getElementById('successMessage').style.display = 'block';
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                    });
                            });
                            </script>

                            <script>
                            document.getElementById('provisionalForm').addEventListener('submit', function(e) {
                                e.preventDefault();

                                var formData = new FormData(this);

                                fetch('', {
                                        method: 'POST',
                                        body: formData
                                    })
                                    .then(response => response.text())
                                    .then(data => {
                                        alert('Character certificate request submitted successfully.');
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                    });
                            });
                            </script>

                            <?php
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                $student_id = $_POST['student_id'];
                                $session = $_POST['session'];
                                $course_id = $_POST['course_id'];
                                $reg_id = $_POST['reg_id'];
                                $roll_no = $_POST['roll_no'];
                                $date_and_time = $_POST['date_and_time'];
                                $status = $_POST['status'];

                                $sql_provisional = "INSERT INTO `tbl_character` (`student_id`, `session`, `course_id`,`reg_no`,`roll_no`, `date_and_time`, `status`) VALUES ('$student_id', '$session', '$course_id','$reg_no','$roll_no', '$date_and_time', '$status')";
                                if ($con->query($sql_provisional) === TRUE) {
                                    echo "<script>alert('Character certificate request submitted successfully.');</script>";
                                } else {
                                    echo "<script>alert('Error: " . $sql_provisional . "<br>" . $con->error . "');</script>";
                                }
                            }
                            ?>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
        </div>
        <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

    <?php include 'include/footer.php'; ?>

    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <script src="plugins/select2/js/select2.full.min.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- page script -->
    <script>
    $(function() {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
    });
    </script>
    <script>
    document.onkeydown = function(e) {
        if (e.keyCode == 123) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
            return false;
        }

        if (e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
            return false;
        }

        if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
            return false;
        }
    }

    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
    });
    </script>
</body>

</html>