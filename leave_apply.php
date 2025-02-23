<?php
$page_no = "16";
$page_no_inside = "16_4";
include_once "include/authentication.php";
include "include/config.php";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>NETAJI SUBHAS UNIVERSITY | Leave Application Form </title>
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
              <h1>Leave</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Leave</a></li>
              </ol>
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="container-fluid">

          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Leave Application Form</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
              </div>
            </div>
            <?php
            $from_date = $to_date = $leave_reason = $leave_type = $reject_reason = "";
            $from_date_err = $to_date_err = $leave_reason_err = $leave_type_err = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST["from_date"])) {
                    $from_date_err = "From Date is required.";
                } else {
                    $from_date = $_POST["from_date"];
                }
                if (empty($_POST["to_date"])) {
                    $to_date_err = "To Date is required.";
                } else {
                    $to_date = $_POST["to_date"];
                }
                if (empty($_POST["leave"])) {
                    $leave_reason_err = "Reason for leave is required.";
                } else {
                    $leave_reason = $_POST["leave"];
                }
                if (empty($_POST["leave_type"])) {
                    $leave_type_err = "Leave Type is required.";
                } else {
                    $leave_type = $_POST["leave_type"];
                }

                $admin = $_SESSION["logger_username"];
                $status = "Pending";
                $reject_reason = "Reject";
                date_default_timezone_set('asia/kolkata');
                $added_date = date("d F,Y");

                if (empty($from_date_err) && empty($to_date_err) && strtotime($from_date) > strtotime($to_date)) {
                    $to_date_err = "To Date must be after From Date.";
                }

                if (empty($from_date_err) && empty($to_date_err) && empty($leave_reason_err) && empty($leave_type_err)) {
                  
                    $from_date_dt = new DateTime($from_date);
                    $to_date_dt = new DateTime($to_date);
                    $interval = $from_date_dt->diff($to_date_dt);
                    $days = $interval->days + 1;

                    $stmt = $con->prepare("INSERT INTO tbl_apply_leave (from_date, to_date, reason, leave_type, added_by, status, reject, added_date, days) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    
                    if ($stmt) {
                        $stmt->bind_param("ssssssssi", $from_date, $to_date, $leave_reason, $leave_type, $admin, $status, $reject_reason, $added_date, $days);

                        if ($stmt->execute()) {
                            echo "<div class='alert alert-success d-flex align-items-center m-4' role='alert'>
                                    <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Success:'><use xlink:href='#exclamation-triangle-fill'/></svg>
                                    <div>
                                        Applied Successfully
                                    </div>
                                  </div>";
                        } else {
                            echo "<div class='alert alert-danger d-flex align-items-center m-4' role='alert'>
                                    <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg>
                                    <div>
                                        Something Went Wrong: " . $stmt->error . "
                                    </div>
                                  </div>";
                        }
                        $stmt->close();
                    } else {
                        echo "<div class='alert alert-danger d-flex align-items-center m-4' role='alert'>
                                <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg>
                                <div>
                                    SQL preparation failed: " . $con->error . "
                                </div>
                              </div>";
                    }
                }
            }
            ?>
            <form action="" method="POST">
                <div class="card-body">
                    <div class="row mb-3">
                    <div class="col-4">
                          <div class="form-group">
                              <label>From Date</label>
                              <input type="date" class="form-control rounded-pill" name="from_date" id="from_date">
                              <span class="text-danger"><?php echo $from_date_err; ?></span>
                          </div>
                      </div>
                      <div class="col-4">
                          <div class="form-group">
                              <label>To Date</label>
                              <input type="date" class="form-control rounded-pill" name="to_date" id="to_date">
                              <span class="text-danger"><?php echo $to_date_err; ?></span>
                          </div>
                      </div>
                      <div class="col-4">
                          <div class="form-group">
                              <label>Leave Type</label>
                              <select class="form-control" name="leave_type" id="leave_type">
                                  <option value="" hidden>-Select leave type-</option>
                                  <option value="paid">Paid Leave (PL)</option>
                                  <option value="sick">Sick Leave (SL)</option>
                                  <option value="casual">Casual Leave (CL)</option>
                                  <option value="privilege">Privilege Leave (PL)</option>
                                  <option value="earned">Earned Leave (EL)</option>
                                  <option value="annual">Annual Leave (AL)</option>
                                  <option value="maternity">Maternity Leave (ML)</option>
                                  <option value="paternity">Paternity Leave (PL)</option>
                                  <option value="bereavement">Bereavement Leave (BL)</option>
                                  <option value="compensatory">Compensatory Off (comp-off)</option>
                                  <option value="loss of pay">Loss Of Pay Leave (LOP/LWP)</option>
                              </select>
                              <span class="text-danger"><?php echo $leave_type_err; ?></span>
                          </div>
                      </div>
                      <!-- <div class="col-3">
                          <div class="form-group">
                              <label>Remaining Paid Leaves</label>
                              <input type="number" class="form-control rounded-pill" value="12" name="remaining_paid_leaves" id="remaining_paid_leaves" readonly>
                          </div>
                      </div> -->
                    </div>
                    <div class="mb-3">
                        <label for="leave" class="form-label">Reason For Leave</label>
                        <textarea class="form-control" id="leave" name="leave" rows="3"></textarea>
                        <span class="text-danger"><?php echo $leave_reason_err; ?></span>
                    </div>
                    <div class="col-sm-12 text-center my-3">
                        <input type="submit" value="Apply" class="btn btn-danger rounded-pill">
                    </div>
                </div>
            </form>

            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                              <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                  <tr>
                                  <th>Leave Type</th>
                                  <th>From Date</th>
                                  <th>To Date</th>
                                  <th>Applied On</th>
                                  <th>Status</th>
                                  <th>Application Rejection Reason</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php
                                  $admin = $_SESSION["logger_username"];
                                  $sql = "SELECT * FROM `tbl_apply_leave` WHERE added_by = '$admin'";
                                  $result = $con->query($sql);
                                
                                      while ($row = $result->fetch_assoc()) {
                                  ?>
                                  <tr>
                                  <td><?php echo $row['leave_type']; ?></td>
                                  <td><?php echo $row['from_date']; ?></td>
                                  <td><?php echo $row['to_date']; ?></td>
                                  <td><?php echo $row['added_date']; ?></td>
                                  <td>
                                    <?php
                                        if($row['why_rejected']!= ""){
                                          echo 'Rejected';
                                        }else{
                                          echo $row['status'];
                                        }
                                    ?>
                                  </td>
                                  <td><?php echo $row['why_rejected']; ?></td>
                                  </tr>
                                  <?php
                                    }
                                ?>
                                </tbody>
                              </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
      </section>
    </div>

    <?php include_once 'include/footer.php'; ?>

    <aside class="control-sidebar control-sidebar-dark">
    </aside>
  </div>

  <script src="plugins/jquery/jquery.min.js"></script>
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
</body>

<script>
    document.getElementById('from_date').addEventListener('change', calculateRemainingLeaves);
    document.getElementById('to_date').addEventListener('change', calculateRemainingLeaves);
    document.getElementById('leave_type').addEventListener('change', calculateRemainingLeaves);

    document.querySelector('form').addEventListener('submit', function(event) {
        const remainingLeaves = parseInt(document.getElementById('remaining_paid_leaves').value, 10);
        const leaveType = document.getElementById('leave_type').value;

        if (leaveType === 'paid' && remainingLeaves < 0) {
            event.preventDefault();
            alert("You don't have sufficient Paid Leaves to apply for this leave.");
        }
    });

    function calculateRemainingLeaves() {
        const fromDate = new Date(document.getElementById('from_date').value);
        const toDate = new Date(document.getElementById('to_date').value);
        const leaveType = document.getElementById('leave_type').value;
        let remainingLeaves = parseInt(document.getElementById('remaining_paid_leaves').value, 10);

        if (leaveType === 'paid' && fromDate && toDate && !isNaN(remainingLeaves)) {
            const timeDifference = toDate - fromDate;
            const daysDifference = timeDifference / (1000 * 3600 * 24) + 1;
            const updatedLeaves = remainingLeaves - daysDifference;

            if (updatedLeaves >= 0) {
                document.getElementById('remaining_paid_leaves').value = updatedLeaves;
            } else {
                alert("You don't have sufficient Paid Leaves for this period.");
                document.getElementById('remaining_paid_leaves').value = 0;
            }
        }
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

</html>