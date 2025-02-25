
<!-- Main Sidebar Container -->
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous">
<aside class="main-sidebar sidebar-dark-olive elevation-4" style="background-color:rgb(255, 255, 255) !important;">
<style>
    .sidebar-dark-olive .nav-sidebar>.nav-item>.nav-link.active, .sidebar-light-olive .nav-sidebar>.nav-item>.nav-link.active {
    background-color: #ff0004 !important;
    color: #fff !important;
    }
    [class*=sidebar-dark-] .sidebar a {
    color: black;
}

.nav-pills .nav-link:not(.active):hover {
    color: #343a40 !important;
}
    
</style> 
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= url('img/logo.png') ?>" class="" alt="User Image" style="width: 90% !important;">
            </div>
            
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent text-sm" data-widget="treeview"
                role="menu" data-accordion="false">
                <li class="nav-item has-treeview" id="menu1">
                    <a href="<?= url('dashboard') ?>" class="nav-link <?php if ($page_no == "1") {
                                                                            echo 'active';
                                                                        } ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview <?php if ($page_no == "2") {
                                                        echo 'menu-open';
                                                    } ?>" <?php if (isset($autority)) {
                            $page_no_temp = 2;
                            if (isset($allAutority->$page_no_temp)) {
                                if ($allAutority->$page_no_temp == "") {
                                    echo "style='display:none;';";
                                }
                            } else {
                                echo "style='display:none;';";
                            }
                        } ?>>
                    <a href="#" class="nav-link <?php if ($page_no == "2") {
                                                    echo 'active';
                                                } ?>">
                        <i class=" nav-icon fas fa-users-cog"></i>
                        <p>
                            Administration
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <?php
                    $baseURL = ($_SERVER['HTTP_HOST'] === 'localhost') ? 'http://localhost/' : 'https://nsucmsin/';
                    $adminViewURL = $baseURL . 'admin_view';
                    ?>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 2;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "2_1") {
                                                                $flag++;
                                                                break;
                                                            }
                                                        }
                                                        if ($flag == 0) {
                                                            echo "style='display:none;';";
                                                        }
                                                    } else {
                                                        echo "style='display:none;';";
                                                    }
                                                } ?>>
                            <a href="<?= url('admin_view') ?>" class="nav-link <?php if ($page_no_inside == "2_1") {
                                                                                    echo 'active';
                                                                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Users</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 2;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "2_2") {
                                                                $flag++;
                                                                break;
                                                            }
                                                        }
                                                        if ($flag == 0) {
                                                            echo "style='display:none;';";
                                                        }
                                                    } else {
                                                        echo "style='display:none;';";
                                                    }
                                                } ?>>
                            <a href="<?= url('audit_log.php') ?>" class="nav-link <?php if ($page_no_inside == "2_2") {
                                                                                                echo 'active';
                                                                                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Audit Logs</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 2;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "2_3") {
                                                                $flag++;
                                                                break;
                                                            }
                                                        }
                                                        if ($flag == 0) {
                                                            echo "style='display:none;';";
                                                        }
                                                    } else {
                                                        echo "style='display:none;';";
                                                    }
                                                } ?>>
                            <a href="<?= url('company-info.php') ?>" class="nav-link <?php if ($page_no_inside == "2_3") {
                                                                                                echo 'active';
                                                                                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Company Info</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 2;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "2_3") {
                                                                $flag++;
                                                                break;
                                                            }
                                                        }
                                                        if ($flag == 0) {
                                                            echo "style='display:none;';";
                                                        }
                                                    } else {
                                                        echo "style='display:none;';";
                                                    }
                                                } ?>>
                            <a href="<?= url('subscription.php') ?>" class="nav-link <?php if ($page_no_inside == "2_3") {
                                                                                                echo 'active';
                                                                                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Subscription</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview <?php if ($page_no == "3") {
                                                        echo 'menu-open';
                                                    } ?>" <?php if (isset($autority)) {
                            $page_no_temp = 3;
                            if (isset($allAutority->$page_no_temp)) {
                                if ($allAutority->$page_no_temp == "") {
                                    echo "style='display:none;';";
                                }
                            } else {
                                echo "style='display:none;';";
                            }
                        } ?>>
                    <a href="#" class="nav-link <?php if ($page_no == "3") {
                                                    echo 'active';
                                                } ?>">
                        <i class="nav-icon fas fa-tree"></i>
                        <p>
                            Employee
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 3;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "3_1") {
                                                                $flag++;
                                                                break;
                                                            }
                                                        }
                                                        if ($flag == 0) {
                                                            echo "style='display:none;';";
                                                        }
                                                    } else {
                                                        echo "style='display:none;';";
                                                    }
                                                } ?>>
                            <a href="<?= url('add_university_details') ?>" class="nav-link <?php if ($page_no_inside == "3_1") {
                                                                                                echo 'active';
                                                                                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Employee List</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 3;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "3_2") {
                                                                $flag++;
                                                                break;
                                                            }
                                                        }
                                                        if ($flag == 0) {
                                                            echo "style='display:none;';";
                                                        }
                                                    } else {
                                                        echo "style='display:none;';";
                                                    }
                                                } ?>>
                            <a href="<?= url('course_view') ?>" class="nav-link <?php if ($page_no_inside == "3_2") {
                                                                                    echo 'active';
                                                                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Attendance</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 3;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "3_3") {
                                                                $flag++;
                                                                break;
                                                            }
                                                        }
                                                        if ($flag == 0) {
                                                            echo "style='display:none;';";
                                                        }
                                                    } else {
                                                        echo "style='display:none;';";
                                                    }
                                                } ?>>
                            <a href="<?= url('mandatory_documents') ?>" class="nav-link <?php if ($page_no_inside == "3_3") {
                                                                                            echo 'active';
                                                                                        } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Leave Management</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 3;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "3_3") {
                                                                $flag++;
                                                                break;
                                                            }
                                                        }
                                                        if ($flag == 0) {
                                                            echo "style='display:none;';";
                                                        }
                                                    } else {
                                                        echo "style='display:none;';";
                                                    }
                                                } ?>>
                            <a href="<?= url('mandatory_documents') ?>" class="nav-link <?php if ($page_no_inside == "3_3") {
                                                                                            echo 'active';
                                                                                        } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Payroll</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 3;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "3_3") {
                                                                $flag++;
                                                                break;
                                                            }
                                                        }
                                                        if ($flag == 0) {
                                                            echo "style='display:none;';";
                                                        }
                                                    } else {
                                                        echo "style='display:none;';";
                                                    }
                                                } ?>>
                            <a href="<?= url('mandatory_documents') ?>" class="nav-link <?php if ($page_no_inside == "3_3") {
                                                                                            echo 'active';
                                                                                        } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Employee Details</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview <?php if ($page_no == "4") {
                                                        echo 'menu-open';
                                                    } ?>" <?php if (isset($autority)) {
                            $page_no_temp = 4;
                            if (isset($allAutority->$page_no_temp)) {
                                if ($allAutority->$page_no_temp == "") {
                                    echo "style='display:none;';";
                                }
                            } else {
                                echo "style='display:none;';";
                            }
                        } ?>>

                    <a href="#" class="nav-link <?php if ($page_no == 4) {
                                                    echo 'active';
                                                } ?>">
                        <i class=" nav-icon fas fa-building"></i>
                        <p>
                        Customer
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 4;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "4_1") {
                                                                $flag++;
                                                                break;
                                                            }
                                                        }
                                                        if ($flag == 0) {
                                                            echo "style='display:none;';";
                                                        }
                                                    } else {
                                                        echo "style='display:none;';";
                                                    }
                                                } ?>>
                            <a href="<?= url('prospectus_view') ?>" class="nav-link <?php if ($page_no_inside == "4_1") {
                                                                                        echo 'active';
                                                                                    } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Customer List</p>
                            </a>
                        </li>

                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 4;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "4_1") {
                                                                $flag++;
                                                                break;
                                                            }
                                                        }
                                                        if ($flag == 0) {
                                                            echo "style='display:none;';";
                                                        }
                                                    } else {
                                                        echo "style='display:none;';";
                                                    }
                                                } ?>>
                            <a href="<?= url('prospectus_view') ?>" class="nav-link <?php if ($page_no_inside == "4_1") {
                                                                                        echo 'active';
                                                                                    } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Support Ticket</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item has-treeview" id="menu1">
                    <a href="<?= url('dashboard') ?>" class="nav-link <?php if ($page_no == "1") {
                                                                            
                                                                        } ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Reports & Analytics
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview" id="menu1">
                    <a href="<?= url('dashboard') ?>" class="nav-link <?php if ($page_no == "1") {
                                                                            
                                                                        } ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Settings
                        </p>
                    </a>
                </li>
          

                <li class="nav-item has-treeview" <?php if (isset($autority)) {
                                                        $page_no_temp = 10;
                                                        if (isset($allAutority->$page_no_temp)) {
                                                            if ($allAutority->$page_no_temp == "") {
                                                                echo "style='display:none;';";
                                                            }
                                                        } else {
                                                            echo "style='display:none;';";
                                                        }
                                                    } ?>>
                    <a href="<?= url('trash') ?>" class="nav-link <?php if ($page_no == "10") {
                                                                        echo 'active';
                                                                    } ?>">
                        <i class="nav-icon fas fa-trash-alt"></i>
                        <p>
                            Trash
                        </p>
                    </a>
                </li>



      

                <li class="nav-item has-treeview">
                    <a href="javascript:void(0)" class="nav-link"
                        onclick="document.getElementById('logout').style.display='block'">
                        <i class="nav-icon fa fa-power-off"></i>
                        <p>
                            Log Out
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<script>
    function removeThis(commingId) {
        $("#" + commingId).remove();
    }
    //    $(document).ready(function() {
    //        setInterval(function(){
    //            $.ajax({
    //                url: 'include/view.php?action=get_all_nsuniv_notifications',
    //                type: 'GET',
    //                success: function(result) {
    //                    if(parseInt(result) > 0)
    //                        $("#allNsunivNotifications").html('<sup class="btn btn-success btn-xs">'+result+'</sup>');
    //                    else
    //                        $("#allNsunivNotifications").html('');
    //                }
    //            });
    //            $.ajax({
    //                url: 'include/view.php?action=get_all_nsuniv_prospectus_notifications',
    //                type: 'GET',
    //                success: function(result) {
    //                    if(parseInt(result) > 0)
    //                        $("#allNsunivProspectusEnquiry").html('<sup class="btn btn-success btn-xs">'+result+'</sup>');
    //                    else
    //                        $("#allNsunivProspectusEnquiry").html('');
    //                }
    //            });
    //            $.ajax({
    //                url: 'include/view.php?action=get_all_nsuniv_admission_notifications',
    //                type: 'GET',
    //                success: function(result) {
    //                    if(parseInt(result) > 0)
    //                        $("#allNsunivAdmissionEnquiry").html('<sup class="btn btn-success btn-xs">'+result+'</sup>');
    //                    else
    //                        $("#allNsunivAdmissionEnquiry").html('');
    //                }
    //            });
    //            $.ajax({
    //                url: 'include/view.php?action=get_all_nsuniv_get_started_notifications',
    //                type: 'GET',
    //                success: function(result) {
    //                    if(parseInt(result) > 0)
    //                        $("#allNsunivGetStartedEnquiry").html('<sup class="btn btn-success btn-xs">'+result+'</sup>');
    //                    else
    //                        $("#allNsunivGetStartedEnquiry").html('');
    //                }
    //            });
    //
    //        }, 10000);
    //    });
</script>
<!-- Logout Section Start -->
<div id="logout" class="w3-modal" style="z-index:2020;">
    <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
        <header class="w3-container" style="background:#343a40; color:white;">
            <span onclick="document.getElementById('logout').style.display='none'"
                class="w3-button w3-display-topright">&times;</span>
            <h2 align="center">Are you sure???</h2>
        </header>
        <div class="card-body">
            <div class="col-md-12" align="center">
                <a href="<?= url('logout') ?>" class="btn btn-danger"><i class="nav-icon fa fa-power-off"></i> Log
                    Out</a>
                <button type="button" onclick="document.getElementById('logout').style.display='none'"
                    class="btn btn-primary">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- Logout Section End -->