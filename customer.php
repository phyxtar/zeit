<?php
$page_no = "4";
$page_no_inside = "4_1";
include_once "include/authentication.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ZEIT | Customer</title>
    <!-- Fav Icon -->
    <link rel="icon" type="image/x-icon" href="img/fav.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
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
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
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
                            <h1>Customer</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Customer</li>
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
                                <h3 class="card-title">Customer List</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-sm" style="background-color: #ff0004; color:white" data-toggle="modal" data-target="#addCustomerModal">
                                        <i class="fas fa-plus"></i> Add New Customer
                                    </button>
                                    <div class="btn-group ml-2">
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                            Export <span class="caret"></span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#"><i class="fas fa-file-pdf"></i> Export as PDF</a>
                                            <a class="dropdown-item" href="#"><i class="fas fa-print"></i> Print List</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="customerTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Customer ID</th>
                                            <th>Company Name</th>
                                            <th>Contact Person</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Service Tenure</th>
                                            <th>Subscription Type</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM tbl_customer";
                                        $result = $con->query($sql);

                                        while ($row = $result->fetch_assoc()) {
                                            $subscriptionBadgeClass = '';
                                            switch ($row['subscription_type']) {
                                                case 'Basic':
                                                    $subscriptionBadgeClass = 'badge-secondary';
                                                    break;
                                                case 'Premium':
                                                    $subscriptionBadgeClass = 'badge-primary';
                                                    break;
                                                case 'Enterprise':
                                                    $subscriptionBadgeClass = 'badge-info';
                                                    break;
                                            }

                                            $statusBadgeClass = $row['status'] == 'Active' ? 'badge-success' : 'badge-danger';

                                            echo "<tr>
                                            <td>{$row['customer_id']}</td>
                                            <td>{$row['company_name']}</td>
                                            <td>{$row['contact_person']}</td>
                                            <td>{$row['email']}</td>
                                            <td>{$row['phone']}</td>
                                            <td>{$row['service_tenure']} years</td>
                                            <td><span class='badge {$subscriptionBadgeClass}'>{$row['subscription_type']}</span></td>
                                            <td><span class='badge {$statusBadgeClass}'>{$row['status']}</span></td>
                                            <td>
                                                <div class='btn-group'>
                                                    <button type='button' class='btn btn-info btn-sm view-customer' data-id='{$row['customer_id']}' data-toggle='collapse' data-target='#customerDetails'>
                                                        <i class='fas fa-eye'></i>
                                                    </button>
                                                    <button type='button' class='btn btn-warning btn-sm edit-customer' data-id='{$row['customer_id']}'>
                                                        <i class='fas fa-edit'></i>
                                                    </button>
                                                    <button type='button' class='btn btn-danger btn-sm delete-customer' data-id='{$row['customer_id']}'>
                                                        <i class='fas fa-trash'></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add Customer Modal -->
                <div class="modal fade" id="addCustomerModal" tabindex="-1" role="dialog" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header text-white" style="background-color: #ff0004;">
                                <h5 class="modal-title" id="addCustomerModalLabel">Add New Customer</h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="addCustomerForm" method="POST" action="add_customer.php">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="company_name" class="font-weight-bold">Company Name*</label>
                                                <input type="text" class="form-control rounded-lg" id="company_name" name="company_name" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="contact_person" class="font-weight-bold">Contact Person*</label>
                                                <input type="text" class="form-control rounded-lg" id="contact_person" name="contact_person" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="email" class="font-weight-bold">Email Address*</label>
                                                <input type="email" class="form-control rounded-lg" id="email" name="email" required>
                                                <small class="form-text text-muted font-italic">We'll never share your email with anyone else.</small>
                                            </div>

                                            <div class="form-group">
                                                <label for="password" class="font-weight-bold">Password*</label>
                                                <input type="password" class="form-control rounded-lg" id="password" name="password" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="phone" class="font-weight-bold">Phone Number*</label>
                                                <input type="tel" class="form-control rounded-lg" id="phone" name="phone" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="address" class="font-weight-bold">Address</label>
                                                <textarea class="form-control rounded-lg" id="address" name="address" rows="3"></textarea>
                                            </div>

                                           

                                            <div class="form-group">
                                                <label for="subscription_type" class="font-weight-bold">Subscription Type*</label>
                                                <select class="form-control rounded-lg" id="subscription_type" name="subscription_type" required>
                                                    <option value="">Select Subscription</option>
                                                    <?php
                                                    $sql = "SELECT id, plan, start_date, end_date, status FROM tbl_subscription";
                                                    $result = $con->query($sql);

                                                    while ($row = $result->fetch_assoc()) {
                                                        echo "<option value='{$row['id']}' 
                         data-start='{$row['start_date']}' 
                         data-end='{$row['end_date']}' 
                         data-status='{$row['status']}'>
                    {$row['plan']}
                  </option>";
                                                    }
                                                    ?>
                                                </select>
                                                <!-- Status Badge -->
                                                <span id="subscription_status_badge" class="badge badge-secondary">Select a plan</span>
                                            </div>
                                            <script>
                                                document.getElementById('subscription_type').addEventListener('change', function() {
                                                    let selectedOption = this.options[this.selectedIndex];

                                                    let startDate = selectedOption.getAttribute('data-start');
                                                    let endDate = selectedOption.getAttribute('data-end');
                                                    let status = selectedOption.getAttribute('data-status');

                                                    // Calculate tenure if start and end dates exist
                                                    if (startDate && endDate) {
                                                        let start = new Date(startDate);
                                                        let end = new Date(endDate);
                                                        let tenure = Math.round((end - start) / (1000 * 60 * 60 * 24 * 365)); // Convert to years

                                                        document.getElementById('service_tenure').value = tenure;
                                                    }

                                                    // Update Status Badge
                                                    let badge = document.getElementById('subscription_status_badge');
                                                    badge.innerText = status;
                                                    badge.className = (status === 'Active') ? 'badge badge-success' : 'badge badge-danger';
                                                });
                                            </script>

<div class="form-group">
                                                <label for="service_tenure" class="font-weight-bold">Service Tenure (Years)*</label>
                                                <input type="number" class="form-control rounded-lg" id="service_tenure" name="service_tenure" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="status" class="font-weight-bold">Status*</label>
                                                <select class="form-control rounded-lg" id="status" name="status" required>
                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer bg-light">
                                    <button type="button" class="btn btn-secondary rounded-pill" data-dismiss="modal">
                                        <i class="fas fa-times mr-1"></i>Close
                                    </button>
                                    <button type="submit" class="btn rounded-pill" style="background-color: #ff0004; color:white;">
                                        <i class="fas fa-save mr-1"></i>Save Customer
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Customer Details Section (Initially Hidden) -->
                <div class="row collapse" id="customerDetails">
                    <div class="col-lg-12">
                        <div class="card shadow-sm">
                            <div class="card-header bg-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0" id="detail-customer-id"></h5>
                                    <div>
                                        <button class="btn btn-sm mr-2" style="background-color: #ff0004; color:white" data-toggle="modal" data-target="#editCustomerModal">
                                            <i class="fa fa-edit"></i> Edit Details
                                        </button>
                                        <button class="btn btn-light btn-sm" data-toggle="collapse" data-target="#customerDetails">
                                            <i class="fa fa-times"></i> Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <dl class="row mb-0">
                                            <dt class="col-sm-4 text-muted font-weight-normal">Company Name:</dt>
                                            <dd class="col-sm-8 font-weight-medium" id="detail-company-name"></dd>

                                            <dt class="col-sm-4 text-muted font-weight-normal">Contact Person:</dt>
                                            <dd class="col-sm-8" id="detail-contact-person"></dd>

                                            <dt class="col-sm-4 text-muted font-weight-normal">Phone:</dt>
                                            <dd class="col-sm-8" id="detail-phone"></dd>

                                            <dt class="col-sm-4 text-muted font-weight-normal">Email:</dt>
                                            <dd class="col-sm-8">
                                                <a href="mailto:" id="detail-email" class="text-primary"></a>
                                            </dd>

                                            <dt class="col-sm-4 text-muted font-weight-normal">Address:</dt>
                                            <dd class="col-sm-8" id="detail-address"></dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-6">
                                        <dl class="row mb-0">
                                            <dt class="col-sm-4 text-muted font-weight-normal">Service Tenure:</dt>
                                            <dd class="col-sm-8" id="detail-tenure"></dd>

                                            <dt class="col-sm-4 text-muted font-weight-normal">Subscription Type:</dt>
                                            <dd class="col-sm-8">
                                                <span class="badge" id="detail-subscription"></span>
                                            </dd>

                                            <dt class="col-sm-4 text-muted font-weight-normal">Status:</dt>
                                            <dd class="col-sm-8">
                                                <span class="badge" id="detail-status"></span>
                                            </dd>

                                            <dt class="col-sm-4 text-muted font-weight-normal">Registration Date:</dt>
                                            <dd class="col-sm-8" id="detail-reg-date"></dd>

                                            <dt class="col-sm-4 text-muted font-weight-normal">Last Updated:</dt>
                                            <dd class="col-sm-8" id="detail-last-updated"></dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        </div>

        <?php include_once 'include/footer.php'; ?>

        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <!-- Add admin Modal Start-->




    </div>
    </div>
    <!-- Add Admin Modal End -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- page script -->

</body>

</html>