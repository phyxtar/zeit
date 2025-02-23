<?php
//Courses Start
if ($_GET["action"] == "get_holiday") {
?>
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Name</th>
                <th>Holiday Date From</th>
                <th>Holiday Date To</th>
                <th class="project-actions text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM `tbl_holiday`
                                ORDER BY `id` ASC
                                ";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?php echo $s_no; ?></td>
                        <td><?php echo $row["h_name"] ?></td>
                        <td><?php echo $row["h_date_from"] ?></td>
                        <td><?php echo $row["h_date_to"] ?></td>
                        <td class="project-actions text-center">
                            <button class="btn btn-info btn-sm" onclick="document.getElementById('edit_holiday<?php echo $row["id"]; ?>').style.display='block'">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="document.getElementById('delete_holiday<?php echo $row["id"]; ?>').style.display='block'">
                                <i class="fas fa-trash">
                                </i>
                                Delete
                            </button>
                        </td>


                        <!-- Holiday Edit Section Start -->
                        <div id="edit_holiday<?php echo $row["id"]; ?>" class="w3-modal" style="z-index:2020;">
                            <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
                                <header class="w3-container" style="background:#343a40; color:white;">
                                    <span onclick="document.getElementById('edit_holiday<?php echo $row["id"]; ?>').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                                    <h2 align="center">Edit Holiday</h2>
                                </header>
                                <form id="edit_holiday_form<?php echo $row["id"]; ?>" role="form" method="POST">
                                    <div class="card-body">
                                        <div class="col-md-12" id="edit_error_section<?php echo $row["id"]; ?>"></div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Holiday Name</label>
                                                    <input type="text" name="edit_holiday_name" id="edit_holiday_name<?php echo $row["id"]; ?>" class="form-control" value="<?php echo $row["h_name"]; ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Holiday Date From</label>
                                                    <input type="date" name="edit_holiday_from" id="edit_holiday_from<?php echo $row["id"]; ?>" class="form-control" value="<?php echo $row["h_date_from"]; ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Holiday Date To</label>
                                                    <input type="date" name="edit_holiday_to" id="edit_holiday_to<?php echo $row["id"]; ?>" class="form-control" value="<?php echo $row["h_date_to"]; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <input type='hidden' name='edit_holiday_id' id="edit_holiday_id<?php echo $row["id"]; ?>" value='<?php echo $row["id"]; ?>' />
                                        <input type='hidden' name='action' id="action<?php echo $row["id"]; ?>" value='edit_holiday' />
                                        <div class="col-md-12" id="edit_loader_section<?php echo $row["id"]; ?>"></div>
                                        <button type="button" id="edit_holiday_button<?php echo $row["id"]; ?>" class="btn btn-primary mb-3">Update</button>
                                      
                                    </div>
                                </form>
                                <script>
                                $(function() {
                                    $('#edit_holiday_button<?php echo $row["id"]; ?>').click(function() {
                                        $('#edit_loader_section<?php echo $row["id"]; ?>').append('<center id="edit_loading"><img width="50px" src="images/ajax-loader.gif" alt="Currently loading" /></center>');
                                        $('#edit_holiday_button<?php echo $row["id"]; ?>').prop('disabled', true);
                                        var action = $("#action<?php echo $row["id"]; ?>").val();
                                        var edit_holiday_id = $("#edit_holiday_id<?php echo $row["id"]; ?>").val();
                                        var edit_holiday_name = $("#edit_holiday_name<?php echo $row["id"]; ?>").val();
                                        var edit_holiday_from = $("#edit_holiday_from<?php echo $row["id"]; ?>").val();
                                        var edit_holiday_to = $("#edit_holiday_to<?php echo $row["id"]; ?>").val();

                                        var dataString = 'action=' + action +
                                            '&edit_holiday_id=' + edit_holiday_id +
                                            '&edit_holiday_name=' + edit_holiday_name +
                                            '&edit_holiday_from=' + edit_holiday_from +
                                            '&edit_holiday_to=' + edit_holiday_to;

                                        $.ajax({
                                            url: 'include/view/edit_holiday.php',
                                            type: 'POST',
                                            data: dataString,
                                            success: function(result) {
                                                $('#edit_response').remove();

                                                if (result == "error") {
                                                    $('#edit_error_section<?php echo $row["id"]; ?>').append('<div id="edit_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong, please try again!!!</div></div>');
                                                }

                                                if (result == "success") {
                                                    $('#edit_error_section<?php echo $row["id"]; ?>').append('<div id="edit_response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Holiday Updated successfully!!!</div></div>');
                                                    showUpdatedData();
                                                }

                                                $('#edit_loading').fadeOut(500, function() {
                                                    $(this).remove();
                                                });
                                                $('#edit_holiday_button<?php echo $row["id"]; ?>').prop('disabled', false);
                                            }
                                        });

                                        function showUpdatedData() {
                                            $.ajax({
                                                url: 'include/view.php?action=get_holiday',
                                                type: 'GET',
                                                success: function(result) {
                                                    $("#data_table").html(result);
                                                }
                                            });
                                        }
                                    });
                                });
                            </script>
                            </div>
                        </div>
                        <!-- Holiday Edit Section End -->

                        <!-- Holiday delete Section Start -->
                        <div id="delete_holiday<?php echo $row["id"]; ?>" class="w3-modal" style="z-index:2020;">
                            <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
                                <header class="w3-container" style="background:#343a40; color:white;">
                                    <span onclick="document.getElementById('delete_holiday<?php echo $row["id"]; ?>').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                                    <h2 align="center">Are you sure???</h2>
                                </header>
                                <form id="delete_holiday_form<?php echo $row["id"]; ?>" role="form" method="POST">
                                    <div class="card-body">
                                        <div class="col-md-12" id="delete_error_section<?php echo $row["id"]; ?>"></div>
                                        <div class="col-md-12" align="center">
                                            <input type='hidden' name='delete_holiday_id' id="delete_holiday_id<?php echo $row["id"]; ?>" value='<?php echo $row["id"]; ?>' />
                                            <input type='hidden' name='action' id="action_delete<?php echo $row["id"]; ?>" value='delete_holiday' />
                                            <div class="col-md-12" id="delete_loader_section<?php echo $row["id"]; ?>"></div>
                                            <button type="button" id="delete_holiday_button<?php echo $row["id"]; ?>" class="btn btn-danger">Move To Trash</button>
                                            <button type="button" onclick="document.getElementById('delete_holiday<?php echo $row["id"]; ?>').style.display='none'" class="btn btn-primary">Cancel</button>
                                        </div>
                                        <!--<button type="reset" class="btn btn-danger">Reset</button>-->
                                    </div>
                                </form>
                                <script>
                                    $(function() {
                                        $('#delete_holiday_button<?php echo $row["id"]; ?>').click(function() {
                                            $('#delete_loader_section<?php echo $row["id"]; ?>').append('<center id = "delete_loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /><br/><br/></center>');
                                            $('#delete_holiday_button<?php echo $row["id"]; ?>').prop('disabled', true);
                                            var action = $("#action_delete<?php echo $row["id"]; ?>").val();
                                            var delete_holiday_id = $("#delete_holiday_id<?php echo $row["id"]; ?>").val();
                                            var dataString = 'action=' + action + '&delete_holiday_id=' + delete_holiday_id;

                                            $.ajax({
                                                url: 'include/controller.php',
                                                type: 'POST',
                                                data: dataString,
                                                success: function(result) {
                                                    // alert (result);
                                                    $('#delete_response').remove();
                                                    if (result == "error") {
                                                        $('#delete_error_section<?php echo $row["id"]; ?>').append('<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>');
                                                    }
                                                    if (result == "empty") {
                                                        $('#delete_error_section<?php echo $row["id"]; ?>').append('<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>');
                                                    }
                                                    if (result == "success") {
                                                        $('#delete_error_section<?php echo $row["id"]; ?>').append('<div id = "delete_response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Holiday Delete successfully!!!</div></div>');
                                                        
                                                        showDeletedData();

                                                        function showDeletedData() {
                                                            $.ajax({
                                                                url: 'include/view.php?action=get_holiday',
                                                                type: 'GET',
                                                                success: function(result) {
                                                                    $("#data_table").html(result);
                                                                }
                                                            });
                                                        }
                                                    }
                                                  
                                                }
                                            });
                                        });

                                    });
                                </script>
                            </div>
                        </div>
                        <!-- Holiday delete Section End -->
                    </tr>
            <?php
                    $s_no++;
                }
            } else
                echo '
                <div class="alert alert-warning alert-dismissible">
                    <i class="icon fas fa-exclamation-triangle"></i>  No data available now!!!
                </div>';
            ?>
        </tbody>
    </table>
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
<?php
}
//Courses End