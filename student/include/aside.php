<!-- Main Sidebar Container -->
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous">
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard" class="brand-link">
        <img src="images/logo.png" alt="NSU Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light" style="font-size: 18px;">Netaji Subhas University</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel  pb-2 mb-2 mt-2 d-flex">
            <div class="image">
                <?php

                $row = fetchRow('tbl_admission', '`admission_id`=' . $_SESSION['user']['admission_id'] . '');
                if (!empty($row["admission_profile_image"])) {
                    
                    ?>
                <img class="img-circle elevation-2 "
                    src="../images/student_images/<?php echo $row["admission_profile_image"]; ?>"
                    alt="Student profile picture">
                <?php
                } else if (strtolower($row["admission_gender"]) == "female") {
                    ?>
                <img class="img-circle elevation-2 img-fluid img-circle" src="images/womenIcon.png"
                    alt="Student profile picture">
                <?php } else { ?>
                <img class="img-circle elevation-2 img-fluid img-circle" src="images/menIcon.png"
                    alt="Student profile picture">
                <?php } ?>

                <a class="ml-2" href="#">
                    <?php echo $row["admission_first_name"] ?>
                    <?php echo $row["admission_middle_name"] ?>
                    <?php echo $row["admission_last_name"] ?>

                    <?php 
                    
                    ?>
                </a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview" <?php $flag = 0;
                if (isset($autority)) {
                    $allAutority = explode(",", $autority);
                    for ($i = 0; $i < count($allAutority); $i++) {
                        if ($allAutority[$i] == "1") {
                            $flag++;
                            break;
                        }
                    }
                    if ($flag == 0) {
                        echo "style='display:none;'";
                    }
                } ?>>
                    <a href="dashboard" class="nav-link <?php if ($page_no == "1") {
                        echo 'active';
                    } ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview" <?php $flag = 0;
                if (isset($autority)) {
                    $allAutority = explode(",", $autority);
                    for ($i = 0; $i < count($allAutority); $i++) {
                        if ($allAutority[$i] == "2") {
                            $flag++;
                            break;
                        }
                    }
                    if ($flag == 0) {
                        echo "style='display:none;'";
                    }
                } ?>>
                    <a href="userprofile" class="nav-link <?php if ($page_no == "2") {
                        echo 'active';
                    } ?>">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            User Profile
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview" <?php $flag = 0;
                if (isset($autority)) {
                    $allAutority = explode(",", $autority);
                    for ($i = 0; $i < count($allAutority); $i++) {
                        if ($allAutority[$i] == "30") {
                            $flag++;
                            break;
                        }
                    }
                    if ($flag == 0) {
                        echo "style='display:none;'";
                    }
                } ?>>
                    <a href="marksheet_view" class="nav-link <?php if ($page_no == "30") {
                        echo 'active';
                    } ?>">
                        <i class="nav-icon fas fa-address-card"></i>
                        <p>
                            Marksheet
                        </p>
                    </a>
                </li>


                <li class="nav-item has-treeview" <?php $flag = 0;
                if (isset($autority)) {
                    $allAutority = explode(",", $autority);
                    for ($i = 0; $i < count($allAutority); $i++) {
                        if ($allAutority[$i] == "5") {
                            $flag++;
                            break;
                        }
                    }
                    if ($flag == 0) {
                        echo "style='display:none;'";
                    }
                } ?>>
                    <a href="#" class="nav-link <?php if ($page_no == "3") {
                        echo 'active';
                    } ?>">
                        <i class="nav-icon fas fa-rupee-sign"></i>
                        <p>
                            Fee
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="payfee" class="nav-link <?php if ($page_no_inside == "3_1") {
                                echo 'active';
                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pay Fee</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                              <a href="fee_details" class="nav-link <?php if ($page_no_inside == "3_2") {
                                  echo 'active';
                              } ?>">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Total Fee Details</p>
                              </a>
                          </li>-->
                        <li class="nav-item">
                            <a href="paid_fee_details" class="nav-link <?php if ($page_no_inside == "3_3") {
                                echo 'active';
                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Paid Fee Details</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview" <?php $flag = 0;
                if (isset($autority)) {
                    $allAutority = explode(",", $autority);
                    for ($i = 0; $i < count($allAutority); $i++) {
                        if ($allAutority[$i] == "5") {
                            $flag++;
                            break;
                        }
                    }
                    if ($flag == 0) {
                        echo "style='display:none;'";
                    }
                } ?>>
                    <a href="#" class="nav-link <?php if ($page_no == "4") {
                        echo 'active';
                    } ?>">
                        <i class="nav-icon fas fa-diagnoses"></i>

                        <p>
                            Exam
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="exam" class="nav-link <?php if ($page_no_inside == "4_1") {
                                echo 'active';
                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Exam Form</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="update_apaar" class="nav-link <?php if ($page_no_inside == "4_2") {
                                echo 'active';
                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Update Apaar ID</p>
                            </a>
                        </li>
                    </ul>
                    <!-- <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="backlog_exam" class="nav-link <?php if ($page_no_inside == "4_2") {
                                echo 'active';
                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Backlog Form</p>
                            </a>
                        </li>
                    </ul> -->
                </li>


                <li class="nav-item has-treeview" <?php $flag = 0;
                if (isset($autority)) {
                    $allAutority = explode(",", $autority);
                    for ($i = 0; $i < count($allAutority); $i++) {
                        if ($allAutority[$i] == "5") {
                            $flag++;
                            break;
                        }
                    }
                    if ($flag == 0) {
                        echo "style='display:none;'";
                    }
                } ?>>
                    <a href="#" class="nav-link <?php if ($page_no == "10") {
                        echo 'active';
                    } ?>">
                        <i class="nav-icon fas fa-diagnoses"></i>

                        <p>
                            Registration
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="registration_form" class="nav-link <?php if ($page_no_inside == "10_1") {
                                echo 'active';
                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>University Registration Form</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="payment_status" class="nav-link <?php if ($page_no_inside == "10_2") {
                                echo 'active';
                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Check Payment Status</p>
                            </a>
                        </li> -->
                    </ul>
                </li>



                <li class="nav-item has-treeview" <?php $flag = 0;
                if (isset($autority)) {
                    $allAutority = explode(",", $autority);
                    for ($i = 0; $i < count($allAutority); $i++) {
                        if ($allAutority[$i] == "7") {
                            $flag++;
                            break;
                        }
                    }
                    if ($flag == 0) {
                        echo "style='display:none;'";
                    }
                } ?>>
                    <a href="#" class="nav-link <?php if ($page_no == "7") {
                        echo 'active';
                    } ?>">
                        <i class="nav-icon  fas fa-address-card"></i>

                        <p>
                            Admit Card
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="admitcard" class="nav-link <?php if ($page_no_inside == "7_1") {
                                echo 'active';
                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Admit Card</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item has-treeview" <?php $flag = 0;
                if (isset($autority)) {
                    $allAutority = explode(",", $autority);
                    for ($i = 0; $i < count($allAutority); $i++) {
                        if ($allAutority[$i] == "5") {
                            $flag++;
                            break;
                        }
                    }
                    if ($flag == 0) {
                        echo "style='display:none;'";
                    }
                } ?>>
                    <a href="#" class="nav-link <?php if ($page_no == "5") {
                        echo 'active';
                    } ?>">
                        <i class="nav-icon fas fa-envelope"></i>




                        <p>
                            Request
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="apply-migration" class="nav-link <?php if ($page_no_inside == "5_1") {
                                echo 'active';
                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Migration cum CLC</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="std_placement_form" class="nav-link <?php if ($page_no_inside == "5_3") {
                                echo 'active';
                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Placement Form</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="request-character" class="nav-link <?php if ($page_no_inside == "5_2") {
                                echo 'active';
                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Character Certificate</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item has-treeview" <?php $flag = 0;
                if (isset($autority)) {
                    $allAutority = explode(",", $autority);
                    for ($i = 0; $i < count($allAutority); $i++) {
                        if ($allAutority[$i] == "6") {
                            $flag++;
                            break;
                        }
                    }
                    if ($flag == 0) {
                        echo "style='display:none;'";
                    }
                } ?>>
                    <a href="#" class="nav-link <?php if ($page_no == "6") {
                        echo 'active';
                    } ?>">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Complaint
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="complaint" class="nav-link <?php if ($page_no_inside == "6_1") {
                                echo 'active';
                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Complaint</p>
                            </a>
                        </li>
                    </ul>
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
                <a href="logout" class="btn btn-danger"><i class="nav-icon fa fa-power-off"></i> Log Out</a>
                <button type="button" onclick="document.getElementById('logout').style.display='none'"
                    class="btn btn-primary">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- Logout Section End -->