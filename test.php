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
                            <strong>Manage User</strong>
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
                            <h5>Audit Logs</h5>
                            <div class="ibox-tools">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-white btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Export <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#"><i class="fa fa-file-excel-o"></i> Excel</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fa fa-file-pdf-o"></i> PDF</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fa fa-file-text-o"></i> CSV</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <!-- Summary Stats -->
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <div class="widget style1 navy-bg">
                                        <div class="row">
                                            <div class="col-4">
                                                <i class="fa fa-database fa-3x"></i>
                                            </div>
                                            <div class="col-8 text-right">
                                                <span>Total Logs</span>
                                                <h2 class="font-bold">2,342</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="widget style1 lazur-bg">
                                        <div class="row">
                                            <div class="col-4">
                                                <i class="fa fa-user fa-3x"></i>
                                            </div>
                                            <div class="col-8 text-right">
                                                <span>Unique Users</span>
                                                <h2 class="font-bold">147</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="widget style1 yellow-bg">
                                        <div class="row">
                                            <div class="col-4">
                                                <i class="fa fa-warning fa-3x"></i>
                                            </div>
                                            <div class="col-8 text-right">
                                                <span>Failed Actions</span>
                                                <h2 class="font-bold">23</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="widget style1 red-bg">
                                        <div class="row">
                                            <div class="col-4">
                                                <i class="fa fa-shield fa-3x"></i>
                                            </div>
                                            <div class="col-8 text-right">
                                                <span>Security Events</span>
                                                <h2 class="font-bold">45</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-b-sm">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Event Type</label>
                                        <select class="form-control">
                                            <option>All Events</option>
                                            <option>Login</option>
                                            <option>Logout</option>
                                            <option>Create</option>
                                            <option>Update</option>
                                            <option>Delete</option>
                                            <option>Password Change</option>
                                            <option>Permission Change</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>User</label>
                                        <select class="form-control">
                                            <option>All Users</option>
                                            <option>Admin Users</option>
                                            <option>Regular Users</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Date Range</label>
                                        <div class="input-daterange input-group">
                                            <input type="date" class="form-control" name="start">
                                            <span class="input-group-addon">to</span>
                                            <input type="date" class="form-control" name="end">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <button class="btn btn-primary btn-block">Search Logs</button>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Timestamp</th>
                                            <th>Event Type</th>
                                            <th>User</th>
                                            <th>IP Address</th>
                                            <th>Module</th>
                                            <th>Action</th>
                                            <th>Details</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>2023-06-15 14:30:25</td>
                                            <td><span class="label label-primary">Login</span></td>
                                            <td>admin@example.com</td>
                                            <td>192.168.1.100</td>
                                            <td>Authentication</td>
                                            <td>User Login</td>
                                            <td>Successful login attempt</td>
                                            <td><span class="label label-success">Success</span></td>
                                        </tr>
                                        <tr>
                                            <td>2023-06-15 14:25:12</td>
                                            <td><span class="label label-warning">Update</span></td>
                                            <td>john.doe@example.com</td>
                                            <td>192.168.1.101</td>
                                            <td>User Management</td>
                                            <td>Profile Update</td>
                                            <td>Updated user profile information</td>
                                            <td><span class="label label-success">Success</span></td>
                                        </tr>
                                        <tr>
                                            <td>2023-06-15 14:20:45</td>
                                            <td><span class="label label-danger">Delete</span></td>
                                            <td>admin@example.com</td>
                                            <td>192.168.1.100</td>
                                            <td>Document Management</td>
                                            <td>Delete File</td>
                                            <td>Deleted file: report.pdf</td>
                                            <td><span class="label label-success">Success</span></td>
                                        </tr>
                                        <tr>
                                            <td>2023-06-15 14:15:30</td>
                                            <td><span class="label label-info">Create</span></td>
                                            <td>jane.smith@example.com</td>
                                            <td>192.168.1.102</td>
                                            <td>Project Management</td>
                                            <td>Create Project</td>
                                            <td>Created new project: Website Redesign</td>
                                            <td><span class="label label-success">Success</span></td>
                                        </tr>
                                        <tr>
                                            <td>2023-06-15 14:10:15</td>
                                            <td><span class="label label-danger">Failed Login</span></td>
                                            <td>unknown@example.com</td>
                                            <td>192.168.1.103</td>
                                            <td>Authentication</td>
                                            <td>Login Attempt</td>
                                            <td>Failed login attempt - Invalid credentials</td>
                                            <td><span class="label label-danger">Failed</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="text-right">
                                        <ul class="pagination">
                                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                        </ul>
                                    </div>
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
