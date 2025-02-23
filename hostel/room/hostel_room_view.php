<?php
include_once "../include/authentication.php";
include_once "../include/head.php";
include_once "../include/config.php";
include_once "../../include/function.php";
$msg = '';

?>

<div class="main-panel">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Room List</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Room List</li>
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
                        <h3 class="card-title">Room List</b></h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                    class="fas fa-remove"></i></button>
                        </div>
                    </div>
                    <form action="#" role="form" method="POST" id="hostel_room_view">
                        <!-- /.card-header -->
                        <div class="row">
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="float-sm-right">
                                            <a href="add" class="btn btn-success">Add Room</a>
                                        </div>
                                        <?= $msg ?>

                                    </div>
                                    <div class="card-body">

                                        <div id="demo">
                                            <div class="table-responsive">
                                                <table id="example1" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>S No</th>
                                                            <th>Building</th>
                                                            <th>Floor No</th>
                                                            <th>No of Room</th>
                                                            <th>Start From</th>
                                                            <th>Ended</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $s_no = 1;
                                                        $sql = "SELECT * FROM `hostel_room`";
                                                        $result = $con->query($sql);

                                                        if ($result->num_rows > 0) {
                                                            while ($row = $result->fetch_assoc()) {


                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $s_no; ?></td>
                                                                    <td><?php echo get_building($row["building_id"]) ?></td>
                                                                    <td><?= $row['floor_no'] ?></td>
                                                                    <td><?php echo $row["total_room"] ?></td>
                                                                    <td><?php echo $row["start"] ?></td>
                                                                    <td><?php echo $row["end"] ?></td>
                                                                    <td> <button type="button"
                                                                            id="change<?php echo $row["id"]; ?>" class="btn <?php if ($row["status"] == 1)
                                                                                   echo "btn-primary";
                                                                               else
                                                                                   echo "btn-warning" ?> btn-sm"><span
                                                                                    id="loader_id<?php echo $row["id"]; ?>"></span>
                                                                            <?php if ($row["status"] == 1)
                                                                                echo "Active";
                                                                            else
                                                                                echo "Not Active" ?></button>
                                                                        </td>
                                                                        <input type='hidden' name='change_status'
                                                                            id="change<?php echo $row["id"]; ?>"
                                                                        value='<?php echo $row["status"] ?>' />
                                                                    <script>
                                                                        $(function () {
                                                                            $('#change<?php echo $row["id"]; ?>').click(function () {
                                                                                $('#loader_id<?php echo $row["id"]; ?>').append('<img id = "edit_load" width="20px" src = "../../images/ajax-loader.gif" alt="Currently loading" />');
                                                                                $('#change<?php echo $row["id"]; ?>').prop('disabled', true);
                                                                                var action = "change_status";
                                                                                var id = '<?php echo $row["id"]; ?>';
                                                                                var change_status = '<?php echo $row["status"]; ?>';

                                                                                var dataString = 'action=' + action + '&id=' + id + '&change_status=' + change_status;

                                                                                $.ajax({
                                                                                    url: 'change.php',
                                                                                    type: 'POST',
                                                                                    data: dataString,
                                                                                    success: function (result) {
                                                                                        console.log(result);
                                                                                        if (result == "success")
                                                                                            showUpdatedData();

                                                                                        function showUpdatedData() {
                                                                                            $.ajax({
                                                                                                url: 'hostel_room_view.php',
                                                                                                type: 'POST',
                                                                                                data: $('#hostel_room_view').serializeArray(),
                                                                                                success: function (result) {
                                                                                                    $('#response').remove();
                                                                                                    $('#example1').append('<div id = "response">' + result + '</div>');
                                                                                                }
                                                                                            });
                                                                                        }
                                                                                        window.location.replace(window.location.href);
                                                                                        $('#loader_id<?php echo $row["id"]; ?>  ').fadeOut(500, function () {
                                                                                            $(this).remove();
                                                                                            $('#change<?php echo $row["id"]; ?>').prop('disabled', false);
                                                                                        });

                                                                                    }

                                                                                });

                                                                            });
                                                                        });
                                                                    </script>
                                                                </tr>

                                                                <?php
                                                                $s_no++;
                                                            }
                                                        } ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- /.card-body -->

                </div>
            </div>
        </section>
        <!-- /.content -->

    </div>

    <?php include "../include/foot.php" ?>