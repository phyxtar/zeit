<?php
error_reporting(0);
$page_no = "4";
$page_no_inside = "4_2";
include "include/authentication.php";
$row = $_SESSION['user'];
$course_id = $row["admission_course_name"];
$academic_yearId = $_SESSION['user']["admission_session"];
$admission_id = $_SESSION['user']["admission_id"];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NETAJI SUBHAS UNIVERSITY | Update Apaar ID </title>
    <link rel="icon" href="images/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
    .form-control {
        font-weight: 900 !important;
        color: #ad183a !important;
        margin-bottom: 15px;
    }

    .responsive-container {
        width: 90%;
        max-width: 800px;
        margin: 0 auto;
        background-color: red;
        color: white;
        padding: 10px;
        text-align: center;
    }

    /* Responsive adjustments */
    @media (max-width: 600px) {
        .responsive-container {
            width: 95%;
            padding: 15px;
        }

        .responsive-container h1 {
            font-size: 1.5rem;
            /* Adjust the font size for smaller screens */
        }
    }
    </style>
</head>

<body class="hold-transition sidebar-mini" oncontextmenu="return false;">
    <?php include 'imp_notice.php'; ?>
    <div class="wrapper">

        <?php include 'include/navbar.php'; ?>
        <?php include 'include/aside.php'; ?>

        <div class="content-wrapper">
            <div class="container mt-4">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-12">
                        <!-- Notice Message -->
                        <div class="alert alert-info text-center">
                            <strong>Important Notice:</strong> Please ensure you have completed the examination form
                            before updating your Apaar ID. Failure to do so will render the update invalid.
                        </div>



                        <?php
            include "include/authentication.php";
            $admission_id = $_SESSION['user']["admission_id"];

            // Fetch current Apaar ID
            $query = "SELECT apaar_id FROM tbl_examination_form WHERE admission_id = '$admission_id'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $existing_apaar_id = $row['apaar_id'] ?? ''; 
            ?>

                        <form action="" method="POST" class="p-3 border rounded shadow-sm bg-white">
                            <div class="form-group">
                                <label for="apaar_id">Enter Apaar ID:</label>
                                <input placeholder='Enter Apaar ID' type="text" class="form-control" name="apaar_id"
                                    id="apaar_id" value="<?php echo htmlspecialchars($existing_apaar_id); ?>" required>
                            </div>
                            <button type="submit" name="update_apaar" class="btn btn-primary btn-block">Update</button>
                        </form>

                        <?php
            if (isset($_POST['update_apaar'])) {
                $new_apaar_id = $_POST['apaar_id'];

                if (!empty($existing_apaar_id)) {
                    echo "<div class='alert alert-warning mt-3 text-center'>Apaar ID already exists: <strong>$existing_apaar_id</strong></div>";
                } else {
                    $update_query = "UPDATE tbl_examination_form SET apaar_id='$new_apaar_id' WHERE admission_id='$admission_id'";
                    if (mysqli_query($conn, $update_query)) {
                        echo "<div class='alert alert-success mt-3 text-center'>Apaar ID updated successfully!</div>";
                    } else {
                        echo "<div class='alert alert-danger mt-3 text-center'>Error updating Apaar ID: " . mysqli_error($conn) . "</div>";
                    }
                }
            }
            ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="plugins/jquery/jquery.min.js">
    </script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <script src="plugins/select2/js/select2.full.min.js"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <!-- InputMask -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
    <!-- date-range-picker -->
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap color picker -->
    <script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Bootstrap Switch -->
    <script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- Page script -->
    <script>
    document.onkeydown = function(e) {
        if (event.keyCode == 123) {
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
    </script>
</body>

</html>