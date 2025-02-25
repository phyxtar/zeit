<?php
$page_no = "2";
$page_no_inside = "2_3";
include_once "include/authentication.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ZEIT | Company Info</title>
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
                            <h1>Company info</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Comapany Info</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
          
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Company Information</h3>
                            <div class="card-tools">
                            <button class="btn btn-sm" style="background-color: #f90004; color:white;" data-toggle="modal" data-target="#editCompanyModal">
    <i class="fas fa-edit"></i> Edit Company Info
</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                            $sql = "SELECT `id`, `company_name`, `registration_number`, `tax_id`, `industry`, `founded`, 
                                          `email`, `phone`, `website`, `address`, `city`, `state`, `postal_code`, `country`,
                                          `legal_structure`, `business_license`, `insurance_policy`, `linkedin`, `twitter`,
                                          `facebook`, `company_logo` 
                                   FROM `tbl_company_info` LIMIT 1";
                            $result = $con->query($sql);
                            if($row = $result->fetch_assoc()) {
                            ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info-box">
                                        <div class="info-box-content">
                                            <h5 class="info-box-text text-danger">Basic Information</h5>
                                            <table class="table table-striped">
                                                <tbody>
                                                    <tr>
                                                        <th style="width: 35%">Company Name</th>
                                                        <td><?php echo htmlspecialchars($row['company_name']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Registration Number</th>
                                                        <td><?php echo htmlspecialchars($row['registration_number']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Tax ID</th>
                                                        <td><?php echo htmlspecialchars($row['tax_id']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Industry</th>
                                                        <td><?php echo htmlspecialchars($row['industry']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Founded</th>
                                                        <td><?php echo htmlspecialchars($row['founded']); ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="info-box mt-4">
                                        <div class="info-box-content">
                                            <h5 class="info-box-text text-danger">Contact Information</h5>
                                            <table class="table table-striped">
                                                <tbody>
                                                    <tr>
                                                        <th style="width: 35%">Email</th>
                                                        <td><a href="mailto:<?php echo htmlspecialchars($row['email']); ?>"><?php echo htmlspecialchars($row['email']); ?></a></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Phone</th>
                                                        <td><a href="tel:<?php echo htmlspecialchars($row['phone']); ?>"><?php echo htmlspecialchars($row['phone']); ?></a></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Website</th>
                                                        <td><a href="<?php echo htmlspecialchars($row['website']); ?>" target="_blank"><?php echo htmlspecialchars($row['website']); ?></a></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Address</th>
                                                        <td><?php echo htmlspecialchars($row['address']); ?><br>
                                                            <?php echo htmlspecialchars($row['city']); ?>, <?php echo htmlspecialchars($row['state']); ?> <?php echo htmlspecialchars($row['postal_code']); ?><br>
                                                            <?php echo htmlspecialchars($row['country']); ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="info-box">
                                        <div class="info-box-content">
                                            <h5 class="info-box-text text-danger">Legal Information</h5>
                                            <table class="table table-striped">
                                                <tbody>
                                                    <tr>
                                                        <th style="width: 35%">Legal Structure</th>
                                                        <td><?php echo htmlspecialchars($row['legal_structure']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Business License</th>
                                                        <td><?php echo htmlspecialchars($row['business_license']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Insurance Policy</th>
                                                        <td><?php echo htmlspecialchars($row['insurance_policy']); ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="info-box mt-4">
                                        <div class="info-box-content">
                                            <h5 class="info-box-text text-danger">Social Media</h5>
                                            <table class="table table-striped">
                                                <tbody>
                                                    <tr>
                                                        <th style="width: 35%"><i class="fab fa-linkedin"></i> LinkedIn</th>
                                                        <td><a href="<?php echo htmlspecialchars($row['linkedin']); ?>" target="_blank"><?php echo htmlspecialchars($row['linkedin']); ?></a></td>
                                                    </tr>
                                                    <tr>
                                                        <th><i class="fab fa-twitter"></i> Twitter</th>
                                                        <td><a href="<?php echo htmlspecialchars($row['twitter']); ?>" target="_blank"><?php echo htmlspecialchars($row['twitter']); ?></a></td>
                                                    </tr>
                                                    <tr>
                                                        <th><i class="fab fa-facebook"></i> Facebook</th>
                                                        <td><a href="<?php echo htmlspecialchars($row['facebook']); ?>" target="_blank"><?php echo htmlspecialchars($row['facebook']); ?></a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="info-box mt-4">
                                        <div class="info-box-content">
                                            <h5 class="info-box-text text-danger">Company Logo</h5>
                                            <div class="text-center p-3">
                                                <img src="<?php echo htmlspecialchars($row['company_logo']); ?>" alt="Company Logo" class="img-fluid" style="max-width: 200px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            } else {
                                echo '<div class="alert alert-warning">No company information found.</div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content -->
        </div>


<!-- Edit Button -->
<button class="btn btn-sm" style="background-color: #f90004; color:white;" data-toggle="modal" data-target="#editCompanyModal">
    <i class="fas fa-edit"></i> Edit Company Info
</button>

<!-- Edit Modal -->
<div class="modal fade" id="editCompanyModal" tabindex="-1" aria-labelledby="editCompanyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-white py-2" style="background-color: #f90004;">
                <h5 class="modal-title mb-0" id="editCompanyModalLabel">
                    <i class="fas fa-building mr-2"></i>Edit Company Information
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="update_company.php" method="POST">
                <div class="modal-body py-3">
                    <?php
                    $sql = "SELECT * FROM `tbl_company_info` LIMIT 1";
                    $result = $con->query($sql);
                    if ($row = $result->fetch_assoc()) {
                    ?>
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label class="mb-2"><i class="fas fa-building mr-1"></i> Company Name</label>
                                <input type="text" name="company_name" class="form-control" value="<?php echo $row['company_name']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label class="mb-2"><i class="fas fa-registered mr-1"></i> Registration Number</label>
                                <input type="text" name="registration_number" class="form-control" value="<?php echo $row['registration_number']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label class="mb-2"><i class="fas fa-file-invoice mr-1"></i> Tax ID</label>
                                <input type="text" name="tax_id" class="form-control" value="<?php echo $row['tax_id']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label class="mb-2"><i class="fas fa-industry mr-1"></i> Industry</label>
                                <input type="text" name="industry" class="form-control" value="<?php echo $row['industry']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label class="mb-2"><i class="fas fa-calendar-alt mr-1"></i> Founded Date</label>
                                <input type="date" name="founded" class="form-control" value="<?php echo $row['founded']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label class="mb-2"><i class="fas fa-envelope mr-1"></i> Email</label>
                                <input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label class="mb-2"><i class="fas fa-phone mr-1"></i> Phone</label>
                                <input type="text" name="phone" class="form-control" value="<?php echo $row['phone']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label class="mb-2"><i class="fas fa-globe mr-1"></i> Website</label>
                                <input type="text" name="website" class="form-control" value="<?php echo $row['website']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="mb-2"><i class="fas fa-map-marker-alt mr-1"></i> Address</label>
                        <textarea name="address" class="form-control" rows="3"><?php echo $row['address']; ?></textarea>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label class="mb-2"><i class="fas fa-city mr-1"></i> City</label>
                                <input type="text" name="city" class="form-control" value="<?php echo $row['city']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label class="mb-2"><i class="fas fa-map mr-1"></i> State</label>
                                <input type="text" name="state" class="form-control" value="<?php echo $row['state']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label class="mb-2"><i class="fas fa-mail-bulk mr-1"></i> Postal Code</label>
                                <input type="text" name="postal_code" class="form-control" value="<?php echo $row['postal_code']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label class="mb-2"><i class="fas fa-globe-americas mr-1"></i> Country</label>
                                <input type="text" name="country" class="form-control" value="<?php echo $row['country']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label class="mb-2"><i class="fas fa-balance-scale mr-1"></i> Legal Structure</label>
                                <input type="text" name="legal_structure" class="form-control" value="<?php echo $row['legal_structure']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label class="mb-2"><i class="fas fa-certificate mr-1"></i> Business License</label>
                                <input type="text" name="business_license" class="form-control" value="<?php echo $row['business_license']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="mb-2"><i class="fas fa-file-contract mr-1"></i> Insurance Policy</label>
                        <input type="text" name="insurance_policy" class="form-control" value="<?php echo $row['insurance_policy']; ?>">
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-group mb-0">
                                <label class="mb-2"><i class="fab fa-linkedin mr-1"></i> LinkedIn</label>
                                <input type="text" name="linkedin" class="form-control" value="<?php echo $row['linkedin']; ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-0">
                                <label class="mb-2"><i class="fab fa-twitter mr-1"></i> Twitter</label>
                                <input type="text" name="twitter" class="form-control" value="<?php echo $row['twitter']; ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-0">
                                <label class="mb-2"><i class="fab fa-facebook mr-1"></i> Facebook</label>
                                <input type="text" name="facebook" class="form-control" value="<?php echo $row['facebook']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <label class="mb-2"><i class="fas fa-image mr-1"></i> Company Logo URL</label>
                        <input type="text" name="company_logo" class="form-control" value="<?php echo $row['company_logo']; ?>">
                    </div>

                    <?php } ?>
                </div>
                <div class="modal-footer py-2">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i>Close
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-save mr-1"></i>Save Changes
                    </button>
                </div>
            </form>
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