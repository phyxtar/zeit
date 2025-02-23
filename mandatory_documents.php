<?php
error_reporting(0);
$page_no = "3";
$page_no_inside = "3_3";
include_once "include/authentication.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NETAJI SUBHAS UNIVERSITY | Mandatory Documents </title>
    <link rel="icon" href="images/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
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
                            <h1>Mandatory Documents</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Mandatory Documents</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Mandatory Documents</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                        class="fas fa-remove"></i></button>
                            </div>
                        </div>
                        <form role="form" method="POST" action="submit_documents.php">
                            <div class="card-body">
                                <table class="table table-bordered" id="dynamic_field" style="overflow-y:auto;">
                                    <thead>
                                        <tr>
                                            <th data-field="S.NO" data-sortable="true" rowspan="2" width="2%">S.NO</th>
                                            <th data-field="Particulars" data-sortable="true" rowspan="2">Program Type</th>
                                            <th rowspan="2">10th Mark.</th>
                                            <th rowspan="2">10th Cert.</th>
                                            <th rowspan="2">12th Mark.</th>
                                            <th rowspan="2">12th Cert.</th>
                                            <th rowspan="2">Gra. Mark.</th>
                                            <th rowspan="2">Gra. Cert.</th>
                                            <th rowspan="2">Mas. Mark.</th>
                                            <th rowspan="2">Mas. Cert.</th>
                                            <th rowspan="2">Trans. Cert.</th>
                                            <th rowspan="2">Mig. Cert.</th>
                                            <th rowspan="2">UID</th>
                                            <th rowspan="2">F's UID</th>
                                            <th rowspan="2">Caste Cert.</th>
                                            <th rowspan="2">Resid. Cert.</th>
                                            <th rowspan="2" width="3%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="text" id="slno1" value="1" readonly class="form-control" style="border:none;" />
                                            </td>
                                            <td>
                                            <select name="docs[0][program_type]" class="form-control" id="programType" required>
                                                <option value="" hidden>Select Program Type</option>
                                                <option value="Graduate Programs">Graduate Programs</option>
                                                <option value="Post Graduate Programs">Post Graduate Programs</option>
                                                <option value="Doctrate Programs">Doctrate Programs</option>
                                                <option value="Diploma Programs">Diploma Programs</option>
                                                <option value="Value Added Course">Value Added Course</option>
                                            </select>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="docs[0][10th_mark]" style="transform: scale(1.6);">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="docs[0][10th_cert]" style="transform: scale(1.6);">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="docs[0][12th_mark]" style="transform: scale(1.6);">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="docs[0][12th_cert]" style="transform: scale(1.6);">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="docs[0][gra_mark]" style="transform: scale(1.6);">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="docs[0][gra_cert]" style="transform: scale(1.6);">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="docs[0][mas_mark]" style="transform: scale(1.6);">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="docs[0][mas_cert]" style="transform: scale(1.6);">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="docs[0][transfer_cert]" style="transform: scale(1.6);">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="docs[0][migration_cert]" style="transform: scale(1.6);">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="docs[0][uid_card]" style="transform: scale(1.6);">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="docs[0][f_uid_card]" style="transform: scale(1.6);">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="docs[0][cast_cert]" style="transform: scale(1.6);">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="docs[0][res_cert]" style="transform: scale(1.6);">
                                            </td>
                                            <td>
                                                <button type="button" name="add" id="add" class="btn btn-success">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                                <input type='hidden' name='action' value='add_fees' />
                                <div class="col-md-12" id="loader_section"></div>
                                <button type="submit" id="add_fee_button" class="btn btn-primary">Add</button>
                                <button type="reset" class="btn btn-danger">Reset</button>
                            </div>
                        </form>
                </div>
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="card card-default">
                        <div class="card-header">
                            <div class="card-body">
                                <table class="table table-bordered" style="overflow-y:auto;">
                                    <thead>
                                        <tr>
                                            <th data-field="S.NO" data-sortable="true" rowspan="2">S.NO</th>
                                            <th data-field="Particulars" data-sortable="true" rowspan="2" width="5%">Program Type</th>
                                            <th rowspan="2">10th Mark.</th>
                                            <th rowspan="2">10th Cert.</th>
                                            <th rowspan="2">12th Mark.</th>
                                            <th rowspan="2">12th Cert.</th>
                                            <th rowspan="2">Gra. Mark.</th>
                                            <th rowspan="2">Gra. Cert.</th>
                                            <th rowspan="2">Mas. Mark.</th>
                                            <th rowspan="2">Mas. Cert.</th>
                                            <th rowspan="2">Trans. Cert.</th>
                                            <th rowspan="2">Migr. Cert.</th>
                                            <th rowspan="2">UID</th>
                                            <th rowspan="2">F's UID</th>
                                            <th rowspan="2">Caste Cert.</th>
                                            <th rowspan="2">Resid. Cert.</th>
                                            <th rowspan="2" width='9%'>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $sql = "SELECT * FROM `mandatory_documents`
                                                            ORDER BY `id` ASC
                                                            ";
                                        $result = $con->query($sql);
                                        if ($result->num_rows > 0) {
                                            $s_no = 1;
                                            while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td width="5%">
                                                <?php echo $s_no; ?>
                                            </td>
                                            <td width="25%">
                                                <?php echo $row["program_type"] ?>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="ten_mark_<?php echo $row["id"]; ?>" style="transform: scale(1.6);" <?php echo $row["ten_mark"] ? 'checked' : ''; ?>>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="ten_cert_<?php echo $row["id"]; ?>" style="transform: scale(1.6);" <?php echo $row["ten_cert"] ? 'checked' : ''; ?>>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="twelve_mark_<?php echo $row["id"]; ?>" style="transform: scale(1.6);" <?php echo $row["twelve_mark"] ? 'checked' : ''; ?>>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="twelve_cert_<?php echo $row["id"]; ?>" style="transform: scale(1.6);" <?php echo $row["twelve_cert"] ? 'checked' : ''; ?>>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="grad_mark_<?php echo $row["id"]; ?>" style="transform: scale(1.6);" <?php echo $row["grad_mark"] ? 'checked' : ''; ?>>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="grad_cert_<?php echo $row["id"]; ?>" style="transform: scale(1.6);" <?php echo $row["grad_cert"] ? 'checked' : ''; ?>>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="mas_mark_<?php echo $row["id"]; ?>" style="transform: scale(1.6);" <?php echo $row["mas_mark"] ? 'checked' : ''; ?>>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="mas_cert_<?php echo $row["id"]; ?>" style="transform: scale(1.6);" <?php echo $row["mas_cert"] ? 'checked' : ''; ?>>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="transfer_cert_<?php echo $row["id"]; ?>" style="transform: scale(1.6);" <?php echo $row["transfer_cert"] ? 'checked' : ''; ?>>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="migration_cert_<?php echo $row["id"]; ?>" style="transform: scale(1.6);" <?php echo $row["migration_cert"] ? 'checked' : ''; ?>>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="uid_card_<?php echo $row["id"]; ?>" style="transform: scale(1.6);" <?php echo $row["uid_card"] ? 'checked' : ''; ?>>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="f_uid_card<?php echo $row["id"]; ?>" style="transform: scale(1.6);" <?php echo $row["father_uid_card"] ? 'checked' : ''; ?>>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="cast_cert<?php echo $row["id"]; ?>" style="transform: scale(1.6);" <?php echo $row["cast_cert"] ? 'checked' : ''; ?>>
                                            </td>
                                            <td>
                                                <input type="checkbox" id="res_cert<?php echo $row["id"]; ?>" style="transform: scale(1.6);" <?php echo $row["res_cert"] ? 'checked' : ''; ?>>
                                            </td>
                                            <td>
                                                <?php
                                                $permissions = json_decode($_SESSION["authority"], true); 
                                                $loggedInUserType = $_SESSION['logger_type']; 

                                                if ((isset($permissions['3']) && in_array('3_7', explode('||', $permissions['3']))) || $loggedInUserType == 'admin') {
                                                    ?>
                                                     <button class="btn btn-success btn-sm" onclick="updateProgramType(<?php echo $row['id']; ?>)">
                                                    <i class="fas fa-check"></i> 
                                                </button>
                                                    <?php
                                                }
                                                ?>
                                                <?php
                                                $permissions = json_decode($_SESSION["authority"], true); 
                                                $loggedInUserType = $_SESSION['logger_type']; 

                                                if ((isset($permissions['3']) && in_array('3_8', explode('||', $permissions['3']))) || $loggedInUserType == 'admin') {
                                                    ?>
                                                     <button class="btn btn-danger btn-sm" onclick="document.getElementById('delete_program_type<?php echo $row["id"]; ?>').style.display='block'">
                                                    <i class="fas fa-trash">
                                                    </i>
                                                    </button>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                            <!-- Program Type delete Section Start -->
                                            <div id="delete_program_type<?php echo $row["id"]; ?>" class="w3-modal" style="z-index:2020;">
                                                <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
                                                    <header class="w3-container" style="background:#343a40; color:white;">
                                                        <span onclick="document.getElementById('delete_program_type<?php echo $row["id"]; ?>').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                                                        <h2 align="center">Are you sure???</h2>
                                                    </header>
                                                    <form id="delete_holiday_form<?php echo $row["id"]; ?>" role="form" method="POST">
                                                        <div class="card-body">
                                                            <div class="col-md-12" id="delete_error_section<?php echo $row["id"]; ?>"></div>
                                                            <div class="col-md-12" align="center">
                                                                <input type='hidden' name='delete_program_type_id' id="delete_program_type_id<?php echo $row["id"]; ?>" value='<?php echo $row["id"]; ?>' />
                                                                <input type='hidden' name='action' id="action_delete<?php echo $row["id"]; ?>" value='delete_program_type' />
                                                                <div class="col-md-12" id="delete_loader_section<?php echo $row["id"]; ?>"></div>
                                                                <button type="button" id="delete_program_type_button<?php echo $row["id"]; ?>" class="btn btn-danger"
                                                                        onclick="deleteProgramType(<?php echo $row["id"]; ?>)">
                                                                    <i class="fas fa-trash"></i> Move To Trash
                                                                </button>

                                                                <button type="button" onclick="document.getElementById('delete_program_type<?php echo $row["id"]; ?>').style.display='none'" class="btn btn-primary">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- Program Type delete Section End -->
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
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php include_once 'include/footer.php'; ?>
        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="plugins/select2/js/select2.full.min.js"></script>
    <script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script src="dist/js/adminlte.min.js"></script>
    <script src="dist/js/demo.js"></script>

    <script>
  $(document).ready(function() {
    // Initialize the DataTable
    $('#dynamic_field').DataTable({
      "paging": true,        
      "searching": true,    
      "ordering": true,     
      "info": true,         
      "lengthChange": false, 
    });
  });
</script>


    <script>
    function updateProgramType(id) {
    var tenMark = document.querySelector(`#ten_mark_${id}`).checked ? 1 : 0;
    var tenCert = document.querySelector(`#ten_cert_${id}`).checked ? 1 : 0;
    var twelveMark = document.querySelector(`#twelve_mark_${id}`).checked ? 1 : 0;
    var twelveCert = document.querySelector(`#twelve_cert_${id}`).checked ? 1 : 0;
    var gradMark = document.querySelector(`#grad_mark_${id}`).checked ? 1 : 0;
    var gradCert = document.querySelector(`#grad_cert_${id}`).checked ? 1 : 0;
    var masMark = document.querySelector(`#mas_mark_${id}`).checked ? 1 : 0;
    var masCert = document.querySelector(`#mas_cert_${id}`).checked ? 1 : 0;
    var transferCert = document.querySelector(`#transfer_cert_${id}`).checked ? 1 : 0;
    var migrationCert = document.querySelector(`#migration_cert_${id}`).checked ? 1 : 0;
    var uidCard = document.querySelector(`#uid_card_${id}`).checked ? 1 : 0;
    var f_uid_card = document.querySelector(`#f_uid_card${id}`).checked ? 1 : 0;
    var cast_cert = document.querySelector(`#cast_cert${id}`).checked ? 1 : 0;
    var res_cert = document.querySelector(`#res_cert${id}`).checked ? 1 : 0;

    var data = new FormData();
    data.append('id', id);
    data.append('ten_mark', tenMark);
    data.append('ten_cert', tenCert);
    data.append('twelve_mark', twelveMark);
    data.append('twelve_cert', twelveCert);
    data.append('grad_mark', gradMark);
    data.append('grad_cert', gradCert);
    data.append('mas_mark', masMark);
    data.append('mas_cert', masCert);
    data.append('transfer_cert', transferCert);
    data.append('migration_cert', migrationCert);
    data.append('uid_card', uidCard);
    data.append('f_uid_card', f_uid_card);
    data.append('cast_cert', cast_cert);
    data.append('res_cert', res_cert);
    data.append('action', 'update_program_type');

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'update_program_type.php', true);
    xhr.onload = function() {
        if (xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                alert('Data updated successfully!');
                location.reload();
            } else {
                alert('Error: ' + response.message);
            }
        } else {
            alert('Error updating data.');
        }
    };
    xhr.send(data);
    }
    </script>

    <script>
    function deleteProgramType(id) {
            document.getElementById('delete_loader_section' + id).innerHTML = '<img src="loading.gif" alt="Loading...">';
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'delete_program_type.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        document.getElementById('delete_program_type' + id).style.display = 'none';
                        location.reload();
                    } else {
                        document.getElementById('delete_error_section' + id).innerHTML = response.message;
                    }
                } else {
                    document.getElementById('delete_error_section' + id).innerHTML = "Error deleting the record.";
                }
            };
            xhr.send('delete_program_type_id=' + id + '&action=delete_program_type');
        
    }
    </script>
    
    <script type="text/javascript">
    $(document).ready(function() {
    var i = 1;

    $('#add').click(function() {
        i++;
        $('#dynamic_field').append(`
            <tr id="row${i}" class="dynamic-added">
                 <td>
                    <input type="text" id="slno${i}" value="${i}" readonly class="form-control-sm form-control" style="border:none;" />
                </td>
                <td>
                    <select name="docs[${i}][program_type]" class="form-control" required>
                        <option value="" hidden>Select Program Type</option>
                        <option value="Graduate Programs">Graduate Programs</option>
                        <option value="Post Graduate Programs">Post Graduate Programs</option>
                        <option value="Doctrate Programs">Doctrate Programs</option>
                        <option value="Diploma Programs">Diploma Programs</option>
                        <option value="Value Added Course">Value Added Course</option>
                    </select>
                </td>
                <td>
                    <input type="checkbox" name="docs[${i}][10th_mark]" style="transform: scale(1.6); margin-left: 10px;">
                </td>
                <td>
                    <input type="checkbox" name="docs[${i}][10th_cert]" style="transform: scale(1.6); margin-left: 10px;">
                </td>
                <td>
                    <input type="checkbox" name="docs[${i}][12th_mark]" style="transform: scale(1.6); margin-left: 10px;">
                </td>
                <td>
                    <input type="checkbox" name="docs[${i}][12th_cert]" style="transform: scale(1.6); margin-left: 10px;">
                </td>
                <td>
                    <input type="checkbox" name="docs[${i}][gra_mark]" style="transform: scale(1.6); margin-left: 10px;">
                </td>
                <td>
                    <input type="checkbox" name="docs[${i}][gra_cert]" style="transform: scale(1.6); margin-left: 10px;">
                </td>
                <td>
                    <input type="checkbox" name="docs[${i}][mas_mark]" style="transform: scale(1.6); margin-left: 10px;">
                </td>
                <td>
                    <input type="checkbox" name="docs[${i}][mas_cert]" style="transform: scale(1.6); margin-left: 10px;">
                </td>
                <td>
                    <input type="checkbox" name="docs[${i}][transfer_cert]" style="transform: scale(1.6); margin-left: 10px;">
                </td>
                <td>
                    <input type="checkbox" name="docs[${i}][migration_cert]" style="transform: scale(1.6); margin-left: 10px;">
                </td>
                <td>
                    <input type="checkbox" name="docs[${i}][uid_card]" style="transform: scale(1.6); margin-left: 10px;">
                </td>
                 <td>
                    <input type="checkbox" name="docs[${i}][f_uid_card]" style="transform: scale(1.6); margin-left: 10px;">
                </td>
                 <td>
                    <input type="checkbox" name="docs[${i}][cast_cert]" style="transform: scale(1.6); margin-left: 10px;">
                </td>
                 <td>
                    <input type="checkbox" name="docs[${i}][res_cert]" style="transform: scale(1.6); margin-left: 10px;">
                </td>
                <td>
                    <button type="button" name="remove" id="${i}" class="btn btn-danger btn_remove">X</button>
                </td>
            </tr>
        `);
    });

    $(document).on('click', '.btn_remove', function() {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
    });

    $("form").on("reset", function() {
        $(".dynamic-added").remove();
        i = 1;
    });
});
</script>

</body>
</html>