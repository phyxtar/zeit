
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
                <img src="<?= url('img/logo.png') ?>" class="" alt="User Image" style="width: 100% !important;">
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
                                <p>Admin List</p>
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
                            <a href="<?= url('leave_application.php') ?>" class="nav-link <?php if ($page_no_inside == "2_2") {
                                                                                                echo 'active';
                                                                                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Leave Apllications</p>
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
                            <a href="<?= url('loan_applications.php') ?>" class="nav-link <?php if ($page_no_inside == "2_3") {
                                                                                                echo 'active';
                                                                                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Loan Apllications</p>
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
                            Setup
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
                                <p>University Details</p>
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
                                <p>Courses</p>
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
                                <p>Mandatory Documents</p>
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
                            Front Office
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
                                <p>Prospectus</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item has-treeview <?php if ($page_no == "5") {
                                                        echo 'menu-open';
                                                    } ?>" <?php if (isset($autority)) {
                            $page_no_temp = 5;
                            if (isset($allAutority->$page_no_temp)) {
                                if ($allAutority->$page_no_temp == "") {
                                    echo "style='display:none;';";
                                }
                            } else {
                                echo "style='display:none;';";
                            }
                        } ?>>
                    <a href="#" class="nav-link <?php if ($page_no == "5") {
                                                    echo 'active';
                                                } ?>">
                        <i class="nav-icon  fas fa-user-edit"></i>
                        <p>
                            Admission
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 5;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "5_1") {
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
                            <a href="<?= url('admission_form') ?>" class="nav-link <?php if ($page_no_inside == "5_1") {
                                                                                        echo 'active';
                                                                                    } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Admission Form</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview <?php if ($page_no == "6") {
                                                        echo 'menu-open';
                                                    } ?>" <?php if (isset($autority)) {
                            $page_no_temp = 6;
                            if (isset($allAutority->$page_no_temp)) {
                                if ($allAutority->$page_no_temp == "") {
                                    echo "style='display:none;';";
                                }
                            } else {
                                echo "style='display:none;';";
                            }
                        } ?>>
                    <a href="#" class="nav-link <?php if ($page_no == "6") {
                                                    echo 'active';
                                                } ?>">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>
                            Student
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- <li class="nav-item">
                              <a href="add_section_roll" class="nav-link <?php if ($page_no_inside == "6_1") {
                                                                                echo 'active';
                                                                            } ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Section/Roll No</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="search_student_record" class="nav-link <?php if ($page_no_inside == "6_2") {
                                                                                    echo 'active';
                                                                                } ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Search Student Record</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="update_course_record" class="nav-link <?php if ($page_no_inside == "6_3") {
                                                                                    echo 'active';
                                                                                } ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Update Course Record</p>
                              </a>
                          </li>-->
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 6;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "6_4") {
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
                            <a href="<?= url('student_list') ?>" class="nav-link <?php if ($page_no_inside == "6_4") {
                                                                                        echo 'active';
                                                                                    } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Student List</p>
                            </a>
                        </li>

                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 6;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "6_6") {
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
                            <a href="<?= url('student_list_archive') ?>" class="nav-link <?php if ($page_no_inside == "6_6") {
                                                                                                echo 'active';
                                                                                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p> Archive Student </p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 6;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "6_7") {
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
                            <a href="<?= url('student_list_yearwise') ?>" class="nav-link <?php if ($page_no_inside == "6_7") {
                                                                                                echo 'active';
                                                                                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p> Student List Yearwise </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview <?php if ($page_no == "7") {
                                                        echo 'menu-open';
                                                    } ?>" <?php if (isset($autority)) {
                            $page_no_temp = 7;
                            if (isset($allAutority->$page_no_temp)) {
                                if ($allAutority->$page_no_temp == "") {
                                    echo "style='display:none;';";
                                }
                            } else {
                                echo "style='display:none;';";
                            }
                        } ?>>
                    <a href="#" class="nav-link <?php if ($page_no == "7") {
                                                    echo 'active';
                                                } ?>">
                        <i class="nav-icon fas fa-rupee-sign"></i>
                        <p>
                            Fee Payment
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 7;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "7_1") {
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
                            <a href="<?= url('add_fees') ?>" class="nav-link <?php if ($page_no_inside == "7_1") {
                                                                                    echo 'active';
                                                                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Fees</p>
                            </a>
                        </li>

                        <!--<li class="nav-item">
                              <a href="add_latefeefine" class="nav-link <?php if ($page_no_inside == "7_2") {
                                                                            echo 'active';
                                                                        } ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Late Fee Fine</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="add_duedate" class="nav-link <?php if ($page_no_inside == "7_3") {
                                                                        echo 'active';
                                                                    } ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Fee Due Date</p>
                              </a>
                          </li>-->
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 7;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "7_4") {
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
                            <a href="<?= url('fee_details') ?>" class="nav-link <?php if ($page_no_inside == "7_4") {
                                                                                    echo 'active';
                                                                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Fee Details</p>
                            </a>
                        </li>
                        <!--<li class="nav-item">
                              <a href="add_examfee" class="nav-link <?php if ($page_no_inside == "7_5") {
                                                                        echo 'active';
                                                                    } ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Add Exam Fee</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="#" class="nav-link <?php if ($page_no_inside == "7_6") {
                                                                echo 'active';
                                                            } ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Exam Fee Collection</p>
                              </a>
                          </li>-->
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 7;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "7_7") {
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
                            <a href="<?= url('payfee') ?>" class="nav-link <?php if ($page_no_inside == "7_7") {
                                                                                echo 'active';
                                                                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pay Fee</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 7;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "7_5") {
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
                            <a href="<?= url('hostel_fee') ?>" class="nav-link <?php if ($page_no_inside == "7_5") {
                                                                                    echo 'active';
                                                                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Hostel Fee List </p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 7;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "7_8") {
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
                            <a href="<?= url('print_receipt') ?>" class="nav-link <?php if ($page_no_inside == "7_8") {
                                                                                        echo 'active';
                                                                                    } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Print Receipt</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 7;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "7_6") {
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
                            <a href="<?= url('student_fee_card') ?>" class="nav-link <?php if ($page_no_inside == "7_6") {
                                                                                            echo 'active';
                                                                                        } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Student Fee Card</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 7;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "7_9") {
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
                            <a href="<?= url('course_yearwise') ?>" class="nav-link <?php if ($page_no_inside == "7_9") {
                                                                                        echo 'active';
                                                                                    } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dues / No Dues List</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 7;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "7_11") {
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
                            <a href="<?= url('course_yearwise_full') ?>" class="nav-link <?php if ($page_no_inside == "7_11") {
                                                                                                echo 'active';
                                                                                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Course & Year Wise Fee Report</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 7;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "7_11") {
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
                            <a href="<?= url('course_yearwise_full2') ?>" class="nav-link <?php if ($page_no_inside == "7_13") {
                                                                                                echo 'active';
                                                                                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Course & Year Wise Fee Report (Full)</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 7;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "7_10") {
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
                            <a href="<?= url('datewise_fee_report') ?>" class="nav-link <?php if ($page_no_inside == "7_10") {
                                                                                            echo 'active';
                                                                                        } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Datewise Fee Report</p>
                            </a>
                        </li>
                        <!--
                          <li class="nav-item">
                              <a href="#" class="nav-link <?php if ($page_no_inside == "7_9") {
                                                                echo 'active';
                                                            } ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Student Fee Card</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="#" class="nav-link <?php if ($page_no_inside == "7_10") {
                                                                echo 'active';
                                                            } ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Course Wise Fee Status</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="#" class="nav-link <?php if ($page_no_inside == "7_11") {
                                                                echo 'active';
                                                            } ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Paid Fee List</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="#" class="nav-link <?php if ($page_no_inside == "7_12") {
                                                                echo 'active';
                                                            } ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Category Wise Paid Fee</p>
                              </a>
                          </li>
-->
                    </ul>
                </li>
                <li class="nav-item has-treeview <?php if ($page_no == "8") {
                                                        echo 'menu-open';
                                                    } ?>" <?php if (isset($autority)) {
                            $page_no_temp = 8;
                            if (isset($allAutority->$page_no_temp)) {
                                if ($allAutority->$page_no_temp == "") {
                                    echo "style='display:none;';";
                                }
                            } else {
                                echo "style='display:none;';";
                            }
                        } ?>>
                    <a href="#" class="nav-link <?php if ($page_no == "8") {
                                                    echo 'active';
                                                } ?>">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>
                            Income/Expenses
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 8;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "8_1") {
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
                            <a href="<?= url('extra_income') ?>" class="nav-link <?php if ($page_no_inside == "8_1") {
                                                                                        echo 'active';
                                                                                    } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Extra Income</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 8;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "8_2") {
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
                            <a href="<?= url('income') ?>" class="nav-link <?php if ($page_no_inside == "8_2") {
                                                                                echo 'active';
                                                                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Income</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 8;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "8_3") {
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
                            <a href="<?= url('expenses') ?>" class="nav-link <?php if ($page_no_inside == "8_3") {
                                                                                    echo 'active';
                                                                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Expenses</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 8;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "8_4") {
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
                            <a href="<?= url('balance_sheet') ?>" class="nav-link <?php if ($page_no_inside == "8_4") {
                                                                                        echo 'active';
                                                                                    } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Balance Sheet</p>
                            </a>
                        </li>

                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 8;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "8_5") {
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
                            <a href="<?= url('income_year') ?>" class="nav-link <?php if ($page_no_inside == "8_5") {
                                                                                    echo 'active';
                                                                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p> Income Year Wise</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <!--  NSUNIV (Main Website Navbar) Start -->
                <li class="nav-item has-treeview <?php if ($page_no == "9") {
                                                        echo 'menu-open';
                                                    } ?>" <?php if (isset($autority)) {
                            $page_no_temp = 9;
                            if (isset($allAutority->$page_no_temp)) {
                                if ($allAutority->$page_no_temp == "") {
                                    echo "style='display:none;';";
                                }
                            } else {
                                echo "style='display:none;';";
                            }
                        } ?>>
                    <a href="#" class="nav-link <?php if ($page_no == "9") {
                                                    echo 'active';
                                                } ?>">
                        <i class="nav-icon fas fa-university"></i>
                        <p>
                            Nsuniv Informations
                            <!--<span id="allNsunivNotifications"></span> -->
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!--
                          <li class="nav-item">
                              <a href="nsuniv-home-enquiry" class="nav-link <?php if ($page_no_inside == "9_1") {
                                                                                echo 'active';
                                                                            } ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Home Enquiry</p>
                              </a>
                          </li>
-->
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 9;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "9_4") {
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
                            <a href="<?= url('nsuniv-get-enquiry') ?>" class="nav-link <?php if ($page_no_inside == "9_4") {
                                                                                            echo 'active';
                                                                                        } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Get Started Enquiry <span id="allNsunivGetStartedEnquiry"></span></p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 9;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "9_2") {
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
                            <a href="<?= url('nsuniv-prospectus-enquiry') ?>" class="nav-link <?php if ($page_no_inside == "9_2") {
                                                                                                    echo 'active';
                                                                                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Prospectus Enquiry <span id="allNsunivProspectusEnquiry"></span></p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 9;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "9_3") {
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
                            <a href="<?= url('nsuniv-admission-enquiry') ?>" class="nav-link <?php if ($page_no_inside == "9_3") {
                                                                                                    echo 'active';
                                                                                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Admission Enquiry <span id="allNsunivAdmissionEnquiry"></span></p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 9;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "9_5") {
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
                            <a href="<?= url('notification-nsuniv') ?>" class="nav-link <?php if ($page_no_inside == "9_5") {
                                                                                            echo 'active';
                                                                                        } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Notifications</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 9;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "9_6") {
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
                            <a href="<?= url('nsuniv-files') ?>" class="nav-link <?php if ($page_no_inside == "9_6") {
                                                                                        echo 'active';
                                                                                    } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Files</p>
                            </a>
                        </li>
                        <!--
                          <li class="nav-item">
                              <a href="#" class="nav-link <?php if ($page_no_inside == "9_4") {
                                                                echo 'active';
                                                            } ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Career Enquiry</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="#" class="nav-link <?php if ($page_no_inside == "9_5") {
                                                                echo 'active';
                                                            } ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Contact Enquiry</p>
                              </a>
                          </li>
-->
                    </ul>
                </li>
                <!--  NSUNIV (Main Website Navbar) End -->
                <!--
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-plus-square"></i>
                          <p>
                              Staff
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p></p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-edit"></i>
                          <p>
                              Library
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p></p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-calendar-alt"></i>
                          <p>
                              Hostel
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p></p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-plus"></i>
                          <p>
                              Examination
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p></p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-edit"></i>
                          <p>
                              Accounting
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p></p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-home"></i>
                          <p>
                              Certificates
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Admit Card</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Mark Sheet</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-edit"></i>
                          <p>
                              Send Notice
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p></p>
                              </a>
                          </li>
                      </ul>
                  </li>
                 
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-edit"></i>
                          <p>
                              Forms
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="pages/forms/general" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>General Elements</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="pages/forms/advanced" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Advanced Elements</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-table"></i>
                          <p>
                              Tables
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="pages/tables/data" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>DataTables</p>
                              </a>
                          </li>
                      </ul>
                  </li>

                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-book"></i>
                          <p>
                              Pages
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="invoice" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Invoice</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="pages/examples/projects" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Projects</p>
                              </a>
                          </li>

                      </ul>
                  </li>
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <i class="nav-icon far fa-plus-square"></i>
                          <p>
                              Extras
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="pages/examples/login" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Login</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="pages/examples/register" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Register</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="pages/examples/forgot-password" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Forgot Password</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="pages/examples/recover-password" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Recover Password</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="pages/examples/lockscreen" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Lockscreen</p>
                              </a>
                          </li>

                          <li class="nav-item">
                              <a href="pages/examples/404" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Error 404</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="pages/examples/500" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Error 500</p>
                              </a>
                          </li>
                      </ul>
                  </li>
-->
                <li class="nav-item has-treeview <?php if ($page_no == "11") {
                                                        echo 'menu-open';
                                                    } ?>" <?php if (isset($autority)) {
                            $page_no_temp = 11;
                            if (isset($allAutority->$page_no_temp)) {
                                if ($allAutority->$page_no_temp == "") {
                                    echo "style='display:none;';";
                                }
                            } else {
                                echo "style='display:none;';";
                            }
                        } ?>>
                    <a href="#" class="nav-link <?php if ($page_no == 11) {
                                                    echo 'active';
                                                } ?>">
                        <i class="nav-icon fas fa-diagnoses"></i>
                        <p>
                            Student & Examination
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 11;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "11_10") {
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
                            <a href="<?= url('upload_sign') ?>" class="nav-link <?php if ($page_no_inside == "11_10") {
                                                                                    echo 'active';
                                                                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Upload Sign</p>
                            </a>
                        </li>

                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 11;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "11_30") {
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
                            <a href="<?= url('add_migration') ?>" class="nav-link <?php if ($page_no_inside == "11_30") {
                                                                                        echo 'active';
                                                                                    } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Migration Form</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 11;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "11_31") {
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
                            <a href="<?= url('migration_form_application') ?>" class="nav-link <?php if ($page_no_inside == "11_31") {
                                                                                                    echo 'active';
                                                                                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Migration Form Applications</p>
                            </a>
                        </li>

                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 11;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "11_12") {
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
                            <a href="<?= url('character_certificate.php') ?>" class="nav-link <?php if ($page_no_inside == "11_12") {
                                                                                                    echo 'active';
                                                                                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Character Certificate</p>
                            </a>
                        </li>



                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 11;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "11_15") {
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
                            <a href="<?= url('placement_form') ?>" class="nav-link <?php if ($page_no_inside == "11_15") {
                                                                                        echo 'active';
                                                                                    } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Placement Form </p>
                            </a>
                        </li>



                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 11;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "11_14") {
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
                            <a href="<?= url('placement_aplied_std') ?>" class="nav-link <?php if ($page_no_inside == "11_14") {
                                                                                                echo 'active';
                                                                                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Placement Applied Std</p>
                            </a>
                        </li>






                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 11;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "11_1") {
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
                            <a href="<?= url('add_semester') ?>" class="nav-link <?php if ($page_no_inside == "11_1") {
                                                                                        echo 'active';
                                                                                    } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Semester</p>
                            </a>
                        </li>

                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 11;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "11_13") {
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
                            <a href="<?= url('specialiization_view') ?>" class="nav-link <?php if ($page_no_inside == "11_13") {
                                                                                                echo 'active';
                                                                                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Specialization</p>
                            </a>
                        </li>
                        <!-- -------------------------------add backlogs---------------------------------------- -->
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 11;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "11_11") {
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
                            <a href="<?= url('add_backlogs') ?>" class="nav-link <?php if ($page_no_inside == "11_11") {
                                                                                        echo 'active';
                                                                                    } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Backlog Management</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 11;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "11_2") {
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
                            <a href="<?= url('student_details') ?>" class="nav-link <?php if ($page_no_inside == "11_2") {
                                                                                        echo 'active';
                                                                                    } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Export Student</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item" <?php if (isset($autority)) {
                                                        $page_no_temp = 11;
                                                        $flag = 0;
                                                        if (isset($allAutority->$page_no_temp)) {
                                                            $subMenus = explode("||", $allAutority->$page_no_temp);
                                                            for ($i = 0; $i < count($subMenus); $i++) {
                                                                if ($subMenus[$i] == "11_8") {
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
                              <a href="student_view" class="nav-link <?php if ($page_no_inside == "11_8") {
                                                                            echo 'active';
                                                                        } ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Import Student</p>
                              </a>
                          </li> -->
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 11;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "11_3") {
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
                            <a href="<?= url('student_semester') ?>" class="nav-link <?php if ($page_no_inside == "11_3") {
                                                                                            echo 'active';
                                                                                        } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Allocate Semester Before 2024</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 11;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "11_10") {
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
                            <a href="<?= url('student_semester_new') ?>" class="nav-link <?php if ($page_no_inside == "11_10") {
                                                                                                echo 'active';
                                                                                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Allocate Semester After 2024</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 11;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "11_4") {
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
                            <a href="<?= url('add_subject') ?>" class="nav-link <?php if ($page_no_inside == "11_4") {
                                                                                    echo 'active';
                                                                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Subject</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 11;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "11_5") {
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
                            <a href="<?= url('add_marks') ?>" class="nav-link <?php if ($page_no_inside == "11_5") {
                                                                                    echo 'active';
                                                                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Marks</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 11;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "11_6") {
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
                            <a href="<?= url('create_report') ?>" class="nav-link <?php if ($page_no_inside == "11_6") {
                                                                                        echo 'active';
                                                                                    } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Report</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 11;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "11_7") {
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
                            <a href="<?= url('create_all_report') ?>" class="nav-link <?php if ($page_no_inside == "11_7") {
                                                                                            echo 'active';
                                                                                        } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Full Report</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 11;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "11_23") {
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
                            <a href="<?= url('add_registration') ?>" class="nav-link <?php if ($page_no_inside == "11_23") {
                                                                                            echo 'active';
                                                                                        } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Registration</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 11;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "11_22") {
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
                            <a href="<?= url('registered_student') ?>" class="nav-link <?php if ($page_no_inside == "11_22") {
                                                                                            echo 'active';
                                                                                        } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Registered Students</p>
                            </a>
                        </li>


                        <!-- <li class="nav-item" <?php if (isset($autority)) {
                                                        $page_no_temp = 11;
                                                        $flag = 0;
                                                        if (isset($allAutority->$page_no_temp)) {
                                                            $subMenus = explode("||", $allAutority->$page_no_temp);
                                                            for ($i = 0; $i < count($subMenus); $i++) {
                                                                if ($subMenus[$i] == "11_8") {
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
                            <a href="<?= url('provisional_get') ?>" class="nav-link <?php if ($page_no_inside == "11_8") {
                                                                                        echo 'active';
                                                                                    } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Provisional Certificate</p>
                            </a>
                        </li> -->
                        <!-- <li class="nav-item" <?php if (isset($autority)) {
                                                        $page_no_temp = 11;
                                                        $flag = 0;
                                                        if (isset($allAutority->$page_no_temp)) {
                                                            $subMenus = explode("||", $allAutority->$page_no_temp);
                                                            for ($i = 0; $i < count($subMenus); $i++) {
                                                                if ($subMenus[$i] == "11_9") {
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
                            <a href="<?= url('migration_get') ?>" class="nav-link <?php if ($page_no_inside == "11_9") {
                                                                                        echo 'active';
                                                                                    } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Migration Certificate</p>
                            </a>
                        </li> -->

                    </ul>
                </li>
                <li class="nav-item has-treeview <?php if ($page_no == "12") {
                                                        echo 'menu-open';
                                                    } ?>" <?php if (isset($autority)) {
                            $page_no_temp = 12;
                            if (isset($allAutority->$page_no_temp)) {
                                if ($allAutority->$page_no_temp == "") {
                                    echo "style='display:none;';";
                                }
                            } else {
                                echo "style='display:none;';";
                            }
                        } ?>>
                    <a href="#" class="nav-link <?php if ($page_no == "12") {
                                                    echo 'active';
                                                } ?>">
                        <i class=" nav-icon fas fa-comments"></i>
                        <p>
                            Examination
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 12;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "12_1") {
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
                            <a href="<?= url('exam_form_list') ?>" class="nav-link <?php if ($page_no_inside == "12_1") {
                                                                                        echo 'active';
                                                                                    } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Exam Form</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= url('exam_fee_details') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Exam Fee Details</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="<?= url('exam_payfee') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Exam Pay Fee</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="<?= url('course_yearwise_exam_fee_report') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Course & Year Wise Exam Fee Report</p>
                            </a>
                        </li>


                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 12;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "12_2") {
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
                            <a href="<?= url('student_nodues_list') ?>" class="nav-link <?php if ($page_no_inside == "12_2") {
                                                                                            echo 'active';
                                                                                        } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Student List (No Dues)</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 12;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "12_6") {
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
                            <a href="<?= url('hod_attendance') ?>" class="nav-link <?php if ($page_no_inside == "12_6") {
                                                                                        echo 'active';
                                                                                    } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Attendance Percentage</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview <?php if ($page_no == "14") {
                                                        echo 'menu-open';
                                                    } ?>" <?php if (isset($autority)) {
                            $page_no_temp = 14;
                            if (isset($allAutority->$page_no_temp)) {
                                if ($allAutority->$page_no_temp == "") {
                                    echo "style='display:none;';";
                                }
                            } else {
                                echo "style='display:none;';";
                            }
                        } ?>>
                    <a href="#" class="nav-link <?php if ($page_no == "14") {
                                                    echo 'active';
                                                } ?>">
                        <i class=" nav-icon fas fa-id-card"></i>
                        <p>
                            Admit Card
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 14;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "14_1") {
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
                            <a href="<?= url('students_view') ?>" class="nav-link <?php if ($page_no_inside == "14_1") {
                                                                                        echo 'active';
                                                                                    } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Admit Card Approval</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview <?php if ($page_no == "13") {
                                                        echo 'menu-open';
                                                    } ?>" <?php if (isset($autority)) {
                            $page_no_temp = 13;
                            if (isset($allAutority->$page_no_temp)) {
                                if ($allAutority->$page_no_temp == "") {
                                    echo "style='display:none;';";
                                }
                            } else {
                                echo "style='display:none;';";
                            }
                        } ?>>
                    <a href="#" class="nav-link <?php if ($page_no == "13") {
                                                    echo 'active';
                                                } ?>">
                        <i class=" nav-icon  fas fa-sms"></i>
                        <p>
                            Complaint From Students
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 13;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "13_1") {
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
                            <a href="<?= url('complaint') ?>" class="nav-link <?php if ($page_no_inside == "13_1") {
                                                                                    echo 'active';
                                                                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Complaint</p>
                            </a>
                        </li>
                    </ul>
                </li>



                <li class="nav-item has-treeview <?php if ($page_no == "16") {
                                                        echo 'menu-open';
                                                    } ?>" <?php if (isset($autority)) {
                            $page_no_temp = 16;
                            if (isset($allAutority->$page_no_temp)) {
                                if ($allAutority->$page_no_temp == "") {
                                    echo "style='display:none;';";
                                }
                            } else {
                                echo "style='display:none;';";
                            }
                        } ?>>
                    <a href="#" class="nav-link <?php if ($page_no == "16") {
                                                    echo 'active';
                                                } ?>">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Payroll
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 16;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "16_1") {
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
                            <a href="<?= url('payroll/designation/view_designation') ?>" class="nav-link <?php if ($page_no_inside == "16_1") {
                                                                                                                echo 'active';
                                                                                                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p> Employee Type</p>
                            </a>
                        </li>

                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 16;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "16_2") {
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
                            <a href="<?= url('payroll/staff/view_staff') ?>" class="nav-link <?php if ($page_no_inside == "16_2") {
                                                                                                    echo 'active';
                                                                                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Employee Management</p>
                            </a>
                        </li>

                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 16;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "16_3") {
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
                            <a href="<?= url('holiday') ?>" class="nav-link <?php if ($page_no_inside == "16_3") {
                                                                                echo 'active';
                                                                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Holiday List</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 16;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "16_4") {
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
                            <a href="<?= url('leave_apply') ?>" class="nav-link <?php if ($page_no_inside == "16_4") {
                                                                                    echo 'active';
                                                                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Apply For Leave</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 16;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "16_5") {
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
                            <a href="<?= url('emplyee_attendence') ?>" class="nav-link <?php if ($page_no_inside == "16_5") {
                                                                                            echo 'active';
                                                                                        } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Employee Attendence</p>
                            </a>
                        </li>

                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 16;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "16_6") {
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
                            <a href="<?= url('attendence_report') ?>" class="nav-link <?php if ($page_no_inside == "16_6") {
                                                                                            echo 'active';
                                                                                        } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Attendence Report</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 16;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "16_9") {
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
                            <a href="<?= url('leave_report') ?>" class="nav-link <?php if ($page_no_inside == "16_9") {
                                                                                        echo 'active';
                                                                                    } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Leave Report</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 16;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "16_7") {
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
                            <a href="<?= url('loan_approval') ?>" class="nav-link <?php if ($page_no_inside == "16_7") {
                                                                                        echo 'active';
                                                                                    } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Apply For Loan</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 16;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "16_8") {
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
                            <a href="<?= url('pay_slip') ?>" class="nav-link <?php if ($page_no_inside == "16_8") {
                                                                                    echo 'active';
                                                                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pay Slips</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 16;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "16_10") {
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
                            <a href="<?= url('salary_report') ?>" class="nav-link <?php if ($page_no_inside == "16_10") {
                                                                                        echo 'active';
                                                                                    } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Salary Report</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 16;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "16_11") {
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
                            <a href="<?= url('year_wise_salary_report') ?>" class="nav-link <?php if ($page_no_inside == "16_11") {
                                                                                                echo 'active';
                                                                                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Year Wise Salary Report</p>
                            </a>
                        </li>

                    </ul>

                </li>

                <li class="nav-item has-treeview <?php if ($page_no == "15") {
                                                        echo 'menu-open';
                                                    } ?>" <?php if (isset($autority)) {
                            $page_no_temp = 15;
                            if (isset($allAutority->$page_no_temp)) {
                                if ($allAutority->$page_no_temp == "") {
                                    echo "style='display:none;';";
                                }
                            } else {
                                echo "style='display:none;';";
                            }
                        } ?>>
                    <a href="#" class="nav-link <?php if ($page_no == "15") {
                                                    echo 'active';
                                                } ?>">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Time Table
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 15;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "15_2") {
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
                            <a href="<?= url('time-table/section/view_section') ?>" class="nav-link <?php if ($page_no_inside == "15_2") {
                                                                                                        echo 'active';
                                                                                                    } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Section</p>
                            </a>
                        </li>

                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 15;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "15_3") {
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
                            <a href="<?= url('time-table/subject/view_subject') ?>" class="nav-link <?php if ($page_no_inside == "15_3") {
                                                                                                        echo 'active';
                                                                                                    } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Subject</p>
                            </a>
                        </li>

                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 15;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "15_4") {
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
                            <a href="<?= url('time-table/class-time-table/view_teacher_allotment') ?>" class="nav-link <?php if ($page_no_inside == "15_4") {
                                                                                                                            echo 'active';
                                                                                                                        } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Teacher Allotment</p>
                            </a>
                        </li>

                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 15;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "15_1") {
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
                            <a href="<?= url('time-table/class-time-table/class') ?>" class="nav-link <?php if ($page_no_inside == "15_1") {
                                                                                                            echo 'active';
                                                                                                        } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Course Wise Time Table</p>
                            </a>
                        </li>

                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 15;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "15_5") {
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
                            <a href="<?= url('time-table/free-staff/view_free_staff') ?>" class="nav-link <?php if ($page_no_inside == "15_5") {
                                                                                                                echo 'active';
                                                                                                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Free Staff</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item has-treeview <?php if ($page_no == "17") {
                                                        echo 'menu-open';
                                                    } ?>" <?php if (isset($autority)) {
                            $page_no_temp = 17;
                            if (isset($allAutority->$page_no_temp)) {
                                if ($allAutority->$page_no_temp == "") {
                                    echo "style='display:none;';";
                                }
                            } else {
                                echo "style='display:none;';";
                            }
                        } ?>>
                    <a href="#" class="nav-link <?php if ($page_no == "17") {
                                                    echo 'active';
                                                } ?>">
                        <i class="nav-icon fas fa-building"></i>
                        <p>Hostel Management<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">

                        <!--------- Hostel Dashboard start here   ------------ -->
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 17;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "17_22") {
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
                            <a href="<?= url('hosteldashboard') ?>" class="nav-link <?php if ($page_no_inside == "17_22") {
                                                                                        echo 'active';
                                                                                    } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Hostel Dashboard</p>
                            </a>
                        </li>
                        <!--------- Hostel Dashboard end here   ------------ -->

                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 17;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "17_0") {
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
                            <a href="<?= url('hostel/join_date/view') ?>" class="nav-link <?php if ($page_no_inside == "17_0") {
                                                                                                echo 'active';
                                                                                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Hostel Join Date</p>
                            </a>
                        </li>

                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 17;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "17_1") {
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
                            <a href="<?= url('hostel/building/view') ?>" class="nav-link <?php if ($page_no_inside == "17_1") {
                                                                                                echo 'active';
                                                                                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Building Management</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 17;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "17_2") {
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
                            <a href="<?= url('hostel/room/add') ?>" class="nav-link <?php if ($page_no_inside == "17_2") {
                                                                                        echo 'active';
                                                                                    } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Room</p>
                            </a>
                        </li>

                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 17;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "17_3") {
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
                            <a href="<?= url('hostel/bed/add') ?>" class="nav-link <?php if ($page_no_inside == "17_3") {
                                                                                        echo 'active';
                                                                                    } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Bed</p>
                            </a>
                        </li>

                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 17;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "17_4") {
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
                            <a href="<?= url('hostel-room-allotment') ?>" class="nav-link <?php if ($page_no_inside == "17_4") {
                                                                                                echo 'active';
                                                                                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Room Allotment</p>
                            </a>
                        </li>

                        <!-- <li class="nav-item" <?php if (isset($autority)) {
                                                        $page_no_temp = 17;
                                                        $flag = 0;
                                                        if (isset($allAutority->$page_no_temp)) {
                                                            $subMenus = explode("||", $allAutority->$page_no_temp);
                                                            for ($i = 0; $i < count($subMenus); $i++) {
                                                                if ($subMenus[$i] == "17_5") {
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
                            <a href="<?= url('hostel/export/genderwise') ?>" class="nav-link <?php if ($page_no_inside == "17_5") {
                                                                                                    echo 'active';
                                                                                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Gender-wise Export</p>
                            </a>
                        </li> -->
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 17;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "17_5") {
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
                            <!-- hostel_gender_wise -->
                            <a href="<?= url('hostel_gender_wise') ?>" class="nav-link <?php if ($page_no_inside == "17_5") {
                                                                                            echo 'active';
                                                                                        } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Gender-wise Export</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 17;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "17_33") {
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
                            <a href="<?= url('hostel_course_yearwise') ?>" class="nav-link <?php if ($page_no_inside == "17_33") {
                                                                                                echo 'active';
                                                                                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Hostel Dues/No Dues List </p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 17;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "17_34") {
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
                            <a href="<?= url('hostel_full_report') ?>" class="nav-link <?php if ($page_no_inside == "17_34") {
                                                                                            echo 'active';
                                                                                        } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Hostel Full Report </p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 17;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "17_35") {
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
                            <a href="<?= url('hostel_vacant') ?>" class="nav-link <?php if ($page_no_inside == "17_35") {
                                                                                        echo 'active';
                                                                                    } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Hostel Alloted/Not Alloted List </p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 17;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "17_36") {
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
                            <a href="<?= url('vacant_list') ?>" class="nav-link <?php if ($page_no_inside == "17_36") {
                                                                                    echo 'active';
                                                                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Room Availablity</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item has-treeview <?php if ($page_no == "18") {
                                                        echo 'menu-open';
                                                    } ?>" <?php if (isset($autority)) {
                            $page_no_temp = 18;
                            if (isset($allAutority->$page_no_temp)) {
                                if ($allAutority->$page_no_temp == "") {
                                    echo "style='display:none;';";
                                }
                            } else {
                                echo "style='display:none;';";
                            }
                        } ?>>
                    <a href="#" class="nav-link <?php if ($page_no == "18") {
                                                    echo 'active';
                                                } ?>">
                        <i class="nav-icon fas fa-clipboard-user"></i>

                        <p>AMS<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">

                        <!--------- AMS Dashboard start here   ------------ -->
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 18;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "18_1") {
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
                            <a href="<?= url('amsdashboard.php') ?>" class="nav-link <?php if ($page_no_inside == "18_1") {
                                                                                            echo 'active';
                                                                                        } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>AMS Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 18;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "18_2") {
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
                            <a href="<?= url('amsstudents') ?>" class="nav-link <?php if ($page_no_inside == "18_2") {
                                                                                    echo 'active';
                                                                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Students</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 18;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "18_5") {
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
                            <a href="<?= url('amsteacher') ?>" class="nav-link <?php if ($page_no_inside == "18_5") {
                                                                                    echo 'active';
                                                                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Teachers</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 18;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "18_3") {
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
                            <a href="<?= url('grade') ?>" class="nav-link <?php if ($page_no_inside == "18_3") {
                                                                                echo 'active';
                                                                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Grade</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 18;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "18_4") {
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
                            <a href="<?= url('amsattendance') ?>" class="nav-link <?php if ($page_no_inside == "18_4") {
                                                                                        echo 'active';
                                                                                    } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Attendance</p>
                            </a>
                        </li>
                        <li class="nav-item" <?php if (isset($autority)) {
                                                    $page_no_temp = 18;
                                                    $flag = 0;
                                                    if (isset($allAutority->$page_no_temp)) {
                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                            if ($subMenus[$i] == "18_5") {
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
                            <a href="<?= url('report') ?>" class="nav-link <?php if ($page_no_inside == "18_5") {
                                                                                echo 'active';
                                                                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Datewise Report</p>
                            </a>
                        </li>

                    </ul>
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



                <li class="nav-item has-treeview" <?php if (isset($autority)) {
                                                        $page_no_temp = 20;
                                                        if (isset($allAutority->$page_no_temp)) {
                                                            if ($allAutority->$page_no_temp == "") {
                                                                echo "style='display:none;';";
                                                            }
                                                        } else {
                                                            echo "style='display:none;';";
                                                        }
                                                    } ?>>
                    <a href="<?= url('licence') ?>" class="nav-link <?php if ($page_no == "20") {
                                                                        echo 'active';
                                                                    } ?>">
                        <i class="nav-icon fas fa-certificate"></i>
                        <p>
                            Licence
                        </p>
                    </a>
                </li>

                <a href="<?= url('edit_student') ?>" class=" <?php if ($page_no == "edit_student") {
                                                                    echo 'active';
                                                                } ?>"></a>

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