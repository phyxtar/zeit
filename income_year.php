<?php
$page_no = "8";
$page_no_inside = "8_5";
include_once "include/authentication.php";
include_once "include/head.php";
?>
<!DOCTYPE html>
<html>


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
                            <h1>Income Year wise List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Income Year wise List</li>
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
                            <h3 class="card-title">Income Year wise List</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                            </div>
                        </div>
                        <form role="form" method="POST" id="fetchStudentDataForm">
                            <div class="card-body" style="margin-top: 0px;">
                                <div class="row">
                                    <div class="col-12" id="error_section"></div>
                                    <div class="col-5">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label> Start Date</label>
                                                    <input type="date" name="start" class="form-control form-control-sm ">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label> End Date</label>
                                                    <input type="date" name="end" class="form-control form-control-sm ">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label> Year</label>
                                            <select class="form-control" multiple id="session_check" name="year[]" onclick="multiselect(this)">
                                                <?php for ($i = date('Y'); $i >= 2017; $i--) { ?>
                                                    <option value="<?= $i ?>"> <?= $i ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-1" style="margin-top: 29px;">
                                        <button type="submit" id="fetchStudentDataButton" class="btn btn-primary">Go</button>
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
            </section>
            <!-- /.content -->
        </div>
        <?php
        include_once 'framwork/ajax/method.php';
        include_once "include/foot.php";
        ?>



        <script>
            $(document).ready(function() {
                $('#fetchStudentDataForm').submit(function(event) {
                    $('#loader_section').append('<center id = "loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /></center>');
                    $('#fetchStudentDataButton').prop('disabled', true);
                    $.ajax({
                        url: 'pages/income/income_year.php?action=income_year',
                        type: 'POST',
                        data: $('#fetchStudentDataForm').serializeArray(),
                        success: function(result) {
                            $('#response').remove();
                            if (result == 0) {
                                $('#error_section').append('<div id = "response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Please select Academic Year!!!</div></div>');
                            } else {
                                $('#data_table').append('<div id = "response">' + result + '</div>');
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
        <style>
            select.form-control[multiple],
            select.form-control[size] {
                height: 30px;
            }
        </style>


</body>

</html>