<?php
$page_no = "16";
$page_no_inside = "16_7";
include_once "include/authentication.php";
include "include/config.php";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>NETAJI SUBHAS UNIVERSITY | Loan Approval Form </title>
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

  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
 

  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">

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
              <h1>Loan</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Loan</a></li>
              </ol>
            </div>
          </div>
        </div>
      </section>
      <section class="content">
        <div class="container-fluid">
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Loan Application Form</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
              </div>
            </div>
            <?php
            $loan_amount = $loan_type = $emi_type = "";
            $loan_amount_err = $loan_type_err = $emi_type_err = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
              if (empty($_POST["loan_amount"])) {
                $loan_amount_err = "Loan Amount is required.";
              } else {
                $loan_amount = $_POST["loan_amount"];
              }

              if (empty($_POST["loan_type"])) {
                $loan_type_err = "Loan Type is required.";
              } else {
                $loan_type = $_POST["loan_type"];
              }

              if (empty($_POST["emi_type"])) {
                $emi_type_err = "Installment Type is required.";
              } else {
                $emi_type = $_POST["emi_type"];
              }

              if (empty($loan_amount_err) && empty($loan_type_err) && empty($emi_type_err)) {
                $admin = $_SESSION["logger_username"];
                $status = "Pending";
                $reject_reason = "Reject";
                date_default_timezone_set('Asia/Kolkata');
                $added_date = date("d F, Y");

                $stmt = $con->prepare("INSERT INTO tbl_loan (added_by, loan_type, emi_type, loan_amount, added_date, reject, status) VALUES (?, ?, ?, ?, ?, ?, ?)");

                if ($stmt) {
                  $stmt->bind_param("sssssss", $admin, $loan_type, $emi_type, $loan_amount, $added_date, $reject_reason, $status);

                  if ($stmt->execute()) {
                    echo "<div class='alert alert-success d-flex align-items-center m-4' role='alert'>
                                    <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
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
                      <label>Loan Amount</label>
                      <input type="number" class="form-control rounded-pill" name="loan_amount" id="loan_amount">
                      <span class="text-danger"><?php echo $loan_amount_err; ?></span>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label>Loan Type</label>
                      <select class="form-control" name="loan_type">
                        <option value="" hidden>-Select loan type-</option>
                        <option value="Personal Loan">Personal Loan</option>
                        <option value="Home Loan">Home Loan</option>
                        <option value="Vehicle Loan">Vehicle Loan</option>
                        <option value="Education Loan">Education Loan</option>
                      </select>
                      <span class="text-danger"><?php echo $loan_type_err; ?></span>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label>Installment Type</label>
                      <select class="form-control" name="emi_type">
                        <option value="" hidden>-Select Installment type-</option>
                        <option value="Fixed EMI">Monthly EMI</option>
                        <option value="Partwise EMI">Partwise EMI</option>
                      </select>
                      <span class="text-danger"><?php echo $emi_type_err; ?></span>
                    </div>
                  </div>
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
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>Loan Type</th>
                            <th>Installment Type</th>
                            <th>Loan Amount</th>
                            <th>Applied Date</th>
                            <th>Status</th>
                            <th>Loan Rejection Reason</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $admin = $_SESSION["logger_username"];
                          $sql = "SELECT * FROM `tbl_loan` WHERE added_by = '$admin'";
                          $result = $con->query($sql);

                          while ($row = $result->fetch_assoc()) {
                          ?>
                            <tr>
                              <td><?php echo $row['loan_type']; ?></td>
                              <td><?php echo $row['emi_type']; ?></td>
                              <td><?php echo $row['loan_amount']; ?></td>
                              <td><?php echo $row['added_date']; ?></td>
                              <td>
                                <?php
                                if ($row['why_rejected'] != "") {
                                  echo 'Rejected';
                                } else {
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
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </section>


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

</body>

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