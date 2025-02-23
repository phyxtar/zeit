<?php
$page_no = "17";
$page_no_inside = "17_36";
include_once "include/authentication.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NETAJI SUBHAS UNIVERSITY | Hostel Vacant List </title>
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
    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"
        integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>

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
                            <h1> Hostel Vacant List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active"> Hostel Vacant List </li>
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
                            <h3 class="card-title"> Hostel Vacant List</h3>
                        </div>
                        <form role="form" method="POST" id="fetchDataForm">
                            <div class="card-body" style="margin-top: 0px;">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Building</label>
                                            <select class="form-control rounded-pill" id="building" name="building">
                                                <!-- Options will be populated here via AJAX -->
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Floor</label>
                                            <select class="form-control rounded-pill" id="floor" name="floor">
                                                <!-- Options will be populated here based on selected building -->
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-1" style="margin-top: 29px;">
                                        <button type="submit" id="fetchDataButton"
                                            class="btn btn-primary rounded-pill">Go</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="col-12" id="loader_section"></div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive" id="data_table">

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
    $(document).ready(function() {
        // Populate the building dropdown when the page loads
        $.ajax({
            url: 'fetch_buildings.php', // The PHP script that fetches the building data
            type: 'GET',
            success: function(data) {
                $('#building').html(data); // Insert the fetched options into the dropdown
            },
            error: function() {
                $('#building').html(
                    '<option value="">Error loading buildings</option>'); // Handle errors
            }
        });

        // Event listener for when the building dropdown value changes
        $('#building').change(function() {
            var building_id = $(this).val(); // Get selected building ID
            $.ajax({
                url: 'fetch_floors.php', // The PHP script that fetches the floor data
                type: 'POST',
                data: {
                    building_id: building_id
                },
                success: function(data) {
                    $('#floor').html(data); // Insert the fetched options into the dropdown
                },
                error: function() {
                    $('#floor').html(
                        '<option value="">Error loading floors</option>'); // Handle errors
                }
            });
        });
    });
    // Handle form submission
    $('#fetchDataForm').submit(function(event) {
        event.preventDefault(); // Prevent the default form submission

        var building = $('#building').val();
        var floor = $('#floor').val();

        if (!building || !floor) {
            $('#error_section').html(
                '<div class="alert alert-danger">Please select both building and floor.</div>');
            return;
        }

        $('#loader_section').html(
            '<center id="loading"><img width="50px" src="images/ajax-loader.gif" alt="Currently loading" /></center>'
        );
        $('#fetchDataButton').prop('disabled', true);

        $.ajax({
            url: 'fetch_data.php', // Update this URL to your data fetching script
            type: 'POST',
            data: {
                building: building,
                floor: floor
            },
            success: function(result) {
                $('#data_table').html(result);
                $('#loading').fadeOut(500, function() {
                    $(this).remove();
                });
                $('#fetchDataButton').prop('disabled', false);
            },
            error: function() {
                $('#data_table').html('<div class="alert alert-danger">Error fetching data.</div>');
                $('#loading').fadeOut(500, function() {
                    $(this).remove();
                });
                $('#fetchDataButton').prop('disabled', false);
            }
        });
    });
    </script>
    <script>
    // Existing form submission code
    $('#fetchFeeDataForm').submit(function(event) {
    $('#loader_section').append(
        '<center id = "loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /></center>'
    );
    $('#fetchFeeDataButton').prop('disabled', true);
    $.ajax({
        url: 'pages/course_wise_fee_reports/vacant_list?action=vacant_list',
        type: 'POST',
        data: $('#fetchFeeDataForm').serializeArray(),
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
            $('#fetchFeeDataButton').prop('disabled', false);
        }
    });
    event.preventDefault();
    });
    });

    function change_semester(semester) {
        $.ajax({
            url: 'include/ajax/add_semester.php',
            type: 'POST',
            data: {
                'data': semester
            },
            success: function(result) {
                document.getElementById('session_id').innerHTML = result;
            }
        });
    }
    </script>
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

</body>

</html>