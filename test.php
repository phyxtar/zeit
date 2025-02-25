<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/img/fav.png">
    <title>ZEIT | Dashboard</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">



</head>

<body>

    <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <img alt="image" class="img-fluid" src="img/logo.png"/>
                    </div>
                    <div class="logo-element">
                        IN+
                    </div>
                </li>
                
                <!-- Overview -->
                <li>
                    <a href="dashboard.html"><i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard</span></a>
                </li>
            
                <!-- System Admin -->
                <li>
                    <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">Admin</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="user-management.html">Manage Users</a></li>
                        <li><a href="audit-logs.html">Audit Logs</a></li>
                        <li><a href="company-info.html">Company Info</a></li>
                        <li><a href="subscriptions.html">Manage Subscriptions</a></li>
                    </ul>
                </li>
            
                <!-- Employee -->
                <li>
                    <a href="#"><i class="fa fa-user-circle-o"></i> <span class="nav-label">Employee</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="employees.html">Employee List</a></li>
                        <li><a href="attendance.html">Attendance</a></li>
                        <li><a href="leave.html">Leave Management</a></li>
                        <li><a href="payroll.html">Payroll</a></li>
                        <li><a href="employee-details.html">Employee Details</a></li>
                    </ul>
                </li>
            
                <!-- Customers -->
                <li>
                    <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Customer</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="customer-list.html">Customer List</a></li>
                        <li><a href="support-tickets.html">Support Tickets</a></li>
                       
                    </ul>
                </li>
            
                <!-- Reports -->
                <li>
                    <a href="reports.html"><i class="fa fa-files-o"></i> <span class="nav-label">Reports & Analytics</span></a>
                </li>
            
                <!-- Settings -->
                <li>
                    <a href="settings.html"><i class="fa fa-gear"></i> <span class="nav-label">Settings</span></a>
                </li>
            
                <!-- Logout -->
                <li class="special_link">
                    <a style="margin-top: 50px;" href="logout.html"><i class="fa fa-sign-out"></i> <span class="nav-label">Logout</span></a>
                </li>
            </ul>

        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                </div>
            </form>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Welcome User</span>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <div class="dropdown-messages-box">
                                <a class="dropdown-item float-left" href="profile.html">
                                    <img alt="image" class="rounded-circle" src="img/a7.jpg">
                                </a>
                                <div class="media-body">
                                    <small class="float-right">46h ago</small>
                                    <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a class="dropdown-item float-left" href="profile.html">
                                    <img alt="image" class="rounded-circle" src="img/a4.jpg">
                                </a>
                                <div class="media-body ">
                                    <small class="float-right text-navy">5h ago</small>
                                    <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a class="dropdown-item float-left" href="profile.html">
                                    <img alt="image" class="rounded-circle" src="img/profile.jpg">
                                </a>
                                <div class="media-body ">
                                    <small class="float-right">23h ago</small>
                                    <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                    <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="mailbox.html" class="dropdown-item">
                                    <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="mailbox.html" class="dropdown-item">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                    <span class="float-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <a href="profile.html" class="dropdown-item">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="float-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <a href="grid_options.html" class="dropdown-item">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="float-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="notifications.html" class="dropdown-item">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="login.html">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>

        </nav>
        </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Attendance</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Home</a>
                        </li>
                        
                        <li class="breadcrumb-item active">
                            <strong>Payroll</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Customer List</h5>
                            <div class="ibox-tools">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addCustomerModal">
                                    <i class="fa fa-plus"></i> Add New Customer
                                </button>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-white btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Export <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#"><i class="fa fa-file-pdf-o"></i> Export as PDF</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fa fa-print"></i> Print List</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-hover">
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
                                        <tr>
                                            <td>CUST001</td>
                                            <td>Acme Corp</td>
                                            <td>John Smith</td>
                                            <td>john@acmecorp.com</td>
                                            <td>+1 234-567-8900</td>
                                            <td>2 years</td>
                                            <td><span class="badge badge-info">Enterprise</span></td>
                                            <td><span class="badge badge-primary">Active</span></td>
                                            <td>
                                                <button class="btn btn-white btn-sm" data-toggle="collapse" data-target="#customerDetails">
                                                    <i class="fa fa-eye"></i> View Details
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Customer Details Section (Initially Hidden) -->
            <div class="row collapse" id="customerDetails">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Customer Details</h5>
                            <div class="ibox-tools">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editCustomerModal">
                                    <i class="fa fa-edit"></i> Edit Details
                                </button>
                                <button class="btn btn-white btn-sm" data-toggle="collapse" data-target="#customerDetails">
                                    <i class="fa fa-times"></i> Close
                                </button>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-md-6">
                                    <dl class="row">
                                        <dt class="col-sm-4">Company Name:</dt>
                                        <dd class="col-sm-8">Acme Corp</dd>

                                        <dt class="col-sm-4">Corporate Address:</dt>
                                        <dd class="col-sm-8">123 Business Ave, Suite 100</dd>

                                        <dt class="col-sm-4">GSTIN:</dt>
                                        <dd class="col-sm-8">29ABCDE1234F1Z5</dd>

                                        <dt class="col-sm-4">Phone:</dt>
                                        <dd class="col-sm-8">+1 234-567-8900</dd>

                                        <dt class="col-sm-4">Email:</dt>
                                        <dd class="col-sm-8">contact@acmecorp.com</dd>

                                        <dt class="col-sm-4">Max Users:</dt>
                                        <dd class="col-sm-8">50</dd>
                                    </dl>
                                </div>
                                <div class="col-md-6">
                                    <dl class="row">
                                        <dt class="col-sm-4">Service Tenure:</dt>
                                        <dd class="col-sm-8">2 years</dd>

                                        <dt class="col-sm-4">Subscription Type:</dt>
                                        <dd class="col-sm-8">Enterprise</dd>

                                        <dt class="col-sm-4">Subscription Date:</dt>
                                        <dd class="col-sm-8">01/01/2023</dd>

                                        <dt class="col-sm-4">Branch Details:</dt>
                                        <dd class="col-sm-8">
                                            <strong>Branch 1:</strong><br>
                                            456 Branch St, Location A<br>
                                            Contact: Jane Doe<br>
                                            Phone: +1 234-567-8901<br>
                                            Email: branch1@acmecorp.com
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="float-right">
                           </div>
            <div>
                <strong>Copyright</strong> Zeit &copy; Reserved 2025
            </div>
        </div>

        </div>
        </div>



    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

<script>

    $(document).ready(function(){

        $(document.body).on("click",".client-link",function(e){
            e.preventDefault()
            $(".selected .tab-pane").removeClass('active');
            $($(this).attr('href')).addClass("active");
        });

    });


</script>

</body>
</html>
