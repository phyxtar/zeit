<?php
$page_no = "11";
$page_no_inside = "11_10";
include_once "include/authentication.php";
include "./include/config.php";
// update_status.php

if (isset($_GET['update_id'])) {
    $id = $_GET['update_id'];
    // echo $id;

    // Perform the update query
    $sql = "UPDATE tbl_sign SET `status` = 'inactive' WHERE id = $id";


    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NETAJI SUBHAS UNIVERSITY | Student List </title>
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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
    </script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#signTable').DataTable();
        });
    </script>
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
        table,
        th,
        td {
            border-collapse: collapse;
        }
    </style>
</head>


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
                            <h1>Upload Sign</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Upload Sign</li>
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
                            <h3 class="card-title">Upload Sign</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                            </div>
                        </div>
                        <form role="form" action="./include/uploadsign.php" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12" id="error_section"></div>

                                    <!-- ---------------------------------------------Registrar start------------------------------------ -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Designation</label>
                                            <input type="text" value="1" name="des_id_r" hidden>
                                            <input type="text" id="designation" name="designation_r" class="form-control" value="Registrar" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" id="name" name="name_r" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Sign</label>
                                            <input type="file" id="image" name="image_r" class="form-control" onchange="previewImage(event)">

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <img id="preview-res" src="#" alt="Image Preview" style="max-width: 100px; max-height: 100px;"><br><br>
                                        </div>
                                    </div>
                                    <!-- ---------------------------------------------Registrar end here------------------------------------ -->
                                    <!-- ---------------------------------------------C-O-E start------------------------------------ -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Designation</label>
                                            <input type="text" value="2" name="des_id_c" hidden>
                                            <input type="text" id="designation" value="Controller of Examination" name="designation_c" class="form-control" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" id="name" name="name_c" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Sign</label>
                                            <input type="file" id="image" name="image_c" class="form-control" onchange="previewImage2(event)">

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <img id="preview-coe" src="#" alt="Image Preview" style="max-width: 100px; max-height: 100px;"><br><br>
                                        </div>
                                    </div>
                                    <!-- ---------------------------------------------C-O-E end here------------------------------------ -->
                                    <!-- ---------------------------------------------VC start------------------------------------ -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Designation</label>
                                            <input type="text" value="3" name="des_id_vc" hidden>
                                            <input type="text" id="designation" value="V.C." name="designation_vc" class="form-control" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" id="name" name="name_vc" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Sign</label>
                                            <input type="file" id="image" name="image_vc" class="form-control" onchange="previewImage3(event)">

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <img id="preview3" src="#" alt="Image Preview" style="max-width: 100px; max-height: 100px;"><br><br>
                                        </div>
                                    </div>
                                    <!-- ---------------------------------------------VC end------------------------------------ -->
                                    <!-- ---------------------------------------------Pro VC start------------------------------------ -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Designation</label>
                                            <input type="text" value="4" name="des_id_pvc" hidden>
                                            <input type="text" id="designation" value="Pro V.C." name="designation_pvc" class="form-control" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" id="name" name="name_pvc" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Sign</label>
                                            <input type="file" id="image" name="image_pvc" class="form-control" onchange="previewImage4(event)">

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <img id="preview4" src="#" alt="Image Preview" style="max-width: 100px; max-height: 100px;"><br><br>
                                        </div>
                                    </div>
                                    <!-- ---------------------------------------------Pro VC end------------------------------------ -->
                                    <!-- ---------------------------------------------Chancellor start------------------------------------ -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Designation</label>
                                            <input type="text" value="5" name="des_id_ch" hidden>
                                            <input type="text" id="designation" value="Chancellor" name="designation_ch" class="form-control" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" id="name" name="name_ch" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Sign</label>
                                            <input type="file" id="image" name="image_ch" class="form-control" onchange="previewImage5(event)">

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <img id="preview5" src="#" alt="Image Preview" style="max-width: 100px; max-height: 100px;"><br><br>
                                        </div>
                                    </div>
                                    <!-- ---------------------------------------------Chancellor end------------------------------------ -->
                                    <!-- ---------------------------------------------Administrator Officer start------------------------------------ -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Designation</label>
                                            <input type="text" value="6" name="des_id_a" hidden>
                                            <input type="text" id="designation" value="Administrative Officer" name="designation_a" class="form-control" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" id="name" name="name_a" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Sign</label>
                                            <input type="file" id="image" name="image_a" class="form-control" onchange="previewImage6(event)">

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <img id="preview6" src="#" alt="Image Preview" style="max-width: 100px; max-height: 100px;"><br><br>
                                        </div>
                                    </div>
                                    <!-- ---------------------------------------------Administrator Officer end------------------------------------ -->
                                    <!-- ---------------------------------------------------Tabulator start --------------------------------------- -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Designation</label>
                                            <input type="text" value="7" name="des_id_t" hidden>
                                            <input type="text" id="designation" value="Tabulator" name="designation_t" class="form-control" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" id="name" name="name_t" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Sign</label>
                                            <input type="file" id="image" name="image_t" class="form-control" onchange="previewImage7(event)">

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <img id="preview7" src="#" alt="Image Preview" style="max-width: 100px; max-height: 100px;"><br><br>
                                        </div>
                                    </div>
                                    <!-- ---------------------------------------------------Tabulator end --------------------------------------- -->
                                    <!-- ---------------------------------------------------Principal start --------------------------------------- -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Designation</label>
                                            <input type="text" value="8" name="des_id_p" hidden>
                                            <input type="text" id="designation" value="Principal" name="designation_p" class="form-control" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" id="name" name="name_p" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Sign</label>
                                            <input type="file" id="image" name="image_p" class="form-control" onchange="previewImage8(event)">

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <img id="preview8" src="#" alt="Image Preview" style="max-width: 100px; max-height: 100px;"><br><br>
                                        </div>
                                    </div>
                                    <!-- ---------------------------------------------------Principal end --------------------------------------- -->
                                    <!-- ---------------------------------------------------OSD start --------------------------------------- -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Designation</label>
                                            <input type="text" value="9" name="des_id_o" hidden>
                                            <input type="text" id="designation" value="OSD" name="designation_o" class="form-control" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" id="name" name="name_o" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Sign</label>
                                            <input type="file" id="image" name="image_o" class="form-control" onchange="previewImage9(event)">

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <img id="preview9" src="#" alt="Image Preview" style="max-width: 100px; max-height: 100px;"><br><br>
                                        </div>
                                    </div>
                                    <!-- ---------------------------------------------------OSD end --------------------------------------- -->
                                    <div class="col-md-12">
                                        <div id="loader_section"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="submit" value="upload" class="btn btn-primary">
                                        <button type="reset" class="btn btn-primary">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="col-12" id="loader_section"></div>
                        <!-- /.card-header -->
                        <div class="card-body" id="data_table">
                            <table id="signTable" class="table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Signature</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $counter = 1;


                                    $sql = "SELECT * FROM tbl_sign where `status` = 'active'";
                                    $result = $conn->query($sql);

                                    if ($result && $result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $des_id = $row['des_id'];
                                            echo "<tr>
                        <td>" . $counter . "</td>
                        <td>" . $row["name"] . "</td>
                        <td>" . $row["designation"] . "</td>
                        <td><img src='data:image/jpeg;base64," . base64_encode($row["image_data"]) . "' alt='Uploaded Image' width='50' height='50'></td>
                        <td><a id='update_id' onclick='updateStatus()' href='upload_sign.php?update_id=$des_id; '><i class='fas fa-trash-alt' style='color: red;'></i></a></td>
                        </tr>";
                                            $counter++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>0 results</td></tr>";
                                    }

                                    $conn->close();
                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
        </div>
        </section>



        <!-- /.content -->
    </div>

    <?php include_once 'include/footer.php'; ?>

    <aside class="control-sidebar control-sidebar-dark">
    </aside>
    </div>

    <script src="plugins/jquery/jquery.min.js"></script>
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
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>



    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        function previewImage2(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview-coe');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        function previewImage3(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview3');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        function previewImage4(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview4');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        function previewImage5(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview5');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        function previewImage6(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview6');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        function previewImage7(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview7');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        function previewImage8(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview8');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        function previewImage9(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview9');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview-res');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    <script>
        function updateStatus() {
            // Assuming you have an ID or some data attribute to identify the row to update
            var rowId = // Get the row ID here;

                // Send an asynchronous request to update the status
                fetch('update_status.php?id=' + rowId)
                .then(response => {
                    if (response.ok) {
                        // Update the UI or perform any necessary actions on success
                        console.log('Status updated successfully');
                        // You can refresh the table or update UI accordingly
                    } else {
                        console.error('Error updating status');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#fetchStudentDataForm').submit(function(event) {
                $('#loader_section').append(
                    '<center id = "loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /></center>'
                );
                $('#fetchStudentDataButton').prop('disabled', true);
                $.ajax({
                    url: 'include/view.php?action=fetch_provisional',
                    type: 'POST',
                    data: $('#fetchStudentDataForm').serializeArray(),
                    success: function(result) {
                        $('#response').remove();
                        if (result == 0) {
                            $('#error_section').append(
                                '<div id = "response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Please select Academic Year!!!</div></div>'
                            );
                        } else {
                            $('#data_table').append('<div id = "response">' + result +
                                '</div>');
                        }
                        $('#loading').fadeOut(500, function() {
                            $(this).remove();
                        });
                        $('#fetchStudentDataButton').prop('disabled', false);
                    }
                });
                event.preventDefault();
            });
        });
    </script>

</body>

</html>