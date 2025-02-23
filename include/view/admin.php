<?php
if ($_GET["action"] == "get_admin") {
    ?>
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Name</th>
            <th>Username</th>
            <!--                        <th>Password</th>-->
            <th>Email ID</th>
            <th>Contact</th>
            <th>User Type</th>
            <th class="project-actions text-center">Action </th>
        </tr>
    </thead>
    <tbody>
        <?php
            $sql = "SELECT * FROM `tbl_admin`
                                WHERE `status` = '$visible' && `admin_id` != 1
                                ORDER BY `admin_id` ASC
                                ";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
        <tr>
            <td><?php echo $s_no; ?></td>
            <td><?php echo $row["admin_name"]; ?></td>
            <td><?php echo $row["admin_username"]; ?></td>
            <!--                              <td><?php echo $row["admin_password"]; ?></td>-->
            <td><?php echo $row["admin_email"]; ?></td>
            <td><?php echo $row["admin_mobile"]; ?></td>
            <td><?php echo $row["admin_type"]; ?></td>
            <td class="project-actions text-center">
                <button class="btn btn-info btn-sm"
                    onclick="document.getElementById('edit_admin<?php echo $row["admin_id"]; ?>').style.display='block'">
                    <i class="fas fa-pencil-alt">
                    </i>

                </button>
                <button class="btn btn-danger btn-sm"
                    onclick="document.getElementById('delete_admin<?php echo $row["admin_id"]; ?>').style.display='block'">
                    <i class="fas fa-trash">
                    </i>

                </button>
            </td>
            <?php
                        $autority = $row["admin_permission"];
                        $allAutority = json_decode($autority);
                        ?>
            <!-- Admin Edit Section Start -->
            <div id="edit_admin<?php echo $row["admin_id"]; ?>" class="w3-modal" style="z-index:2020;">
                <div class="w3-modal-content w3-animate-top w3-card-4" style="width:60%">
                    <header class="w3-container" style="background:#343a40; color:white;">
                        <span
                            onclick="document.getElementById('edit_admin<?php echo $row["admin_id"]; ?>').style.display='none'"
                            class="w3-button w3-display-topright">&times;</span>
                        <h2 align="center">Edit Admin Details</h2>
                    </header>
                    <form id="edit_admin_form<?php echo $row["admin_id"]; ?>" role="form" method="POST">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <label> Name</label>
                                    <input type="text" name="edit_admin_name"
                                        id="edit_admin_name<?php echo $row["admin_id"]; ?>" class="form-control"
                                        value="<?php echo $row["admin_name"]; ?>">
                                </div>
                                <div class="col-6">
                                    <label>User Name</label>
                                    <input readonly type="text" name="edit_admin_username"
                                        id="edit_admin_username<?php echo $row["admin_id"]; ?>" class="form-control"
                                        value="<?php echo $row["admin_username"]; ?>">
                                </div>

                                <div class="col-6">
                                    <label>Email</label>
                                    <input type="text" name="edit_admin_email"
                                        id="edit_admin_email<?php echo $row["admin_id"]; ?>" class="form-control"
                                        value="<?php echo $row["admin_email"]; ?>">
                                </div>
                                <div class="col-6">
                                    <label>Mobile</label>
                                    <input type="text" name="edit_admin_mobile"
                                        id="edit_admin_mobile<?php echo $row["admin_id"]; ?>" class="form-control"
                                        value="<?php echo $row["admin_mobile"]; ?>">
                                </div>
                                <div class="col-6">
                                    <label>Password</label>
                                    <input type="hidden" name="admin_password"
                                        id="edit_admin_password<?php echo $row["admin_id"]; ?>" class="form-control"
                                        value="<?php echo $row["admin_password"]; ?>">
                                    <input title="Password must 0-9,a-z ,A-Z ,[!@#$%^&*-] minimum 8 character"
                                        pattern="^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$"
                                        placeholder="Enter minimum 8 character password" type="text"
                                        name="edit_admin_password" id="admin_password<?php echo $row["admin_id"]; ?>"
                                        class="form-control" value="">
                                </div>
                                <div class="col-12 mt-3">
                                    <br />
                                    <div class="card card-danger">
                                        <div class="card-header">
                                            <h3 class="card-title">Select Permissions</h3>
                                        </div>
                                        <div class="card-body">
                                            <!-- Minimal style -->
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="col-sm-12">
                                                        <div class="card card-warning">
                                                            <div class="card-header">
                                                                <h3 class="card-title">SetUp</h3>
                                                            </div>
                                                            <div class="card-body pl-5 pr-5">
                                                                <!-- Minimal style -->
                                                                <div class="row">
                                                                    <!--<div class="col-sm-6">-->
                                                                    <!-- checkbox -->
                                                                    <!--   <div class="form-group clearfix">-->
                                                                    <!--     <div class="icheck-danger d-inline">-->
                                                                    <!--       <input type="checkbox" id="checkboxPrimary1_all" name="permission_3[]" value="">-->
                                                                    <!--       <label for="checkboxPrimary1_all">All </label>-->
                                                                    <!--     </div>-->
                                                                    <!--   </div>-->
                                                                    <!-- </div>-->
                                                                    <div class="col-sm-6">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary1_1<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_3[]" value="3_1" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 3;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "3_1") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary1_1<?php echo $row["admin_id"]; ?>">University
                                                                                    Details </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary1_2<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_3[]" value="3_2" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 3;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "3_2") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary1_2<?php echo $row["admin_id"]; ?>">Courses
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="col-sm-12">
                                                        <div class="card card-warning">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Front Office</h3>
                                                            </div>
                                                            <div class="card-body pl-5 pr-5">
                                                                <!-- Minimal style -->
                                                                <div class="row">
                                                                    <!--  <div class="col-sm-6">-->
                                                                    <!-- checkbox -->
                                                                    <!--  <div class="form-group clearfix">-->
                                                                    <!--    <div class="icheck-danger d-inline">-->
                                                                    <!--      <input type="checkbox" id="checkboxPrimary2_all" name="permission_4[]" value="">-->
                                                                    <!--      <label for="checkboxPrimary2_all">All </label>-->
                                                                    <!--    </div>-->
                                                                    <!--  </div>-->
                                                                    <!--</div>-->
                                                                    <div class="col-sm-6">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary2_1<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_4[]" value="4_1" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 4;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "4_1") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary2_1<?php echo $row["admin_id"]; ?>">Prospectus
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="col-sm-12">
                                                        <div class="card card-warning">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Admission</h3>
                                                            </div>
                                                            <div class="card-body pl-5 pr-5">
                                                                <!-- Minimal style -->
                                                                <div class="row">
                                                                    <!--  <div class="col-sm-6">-->
                                                                    <!-- checkbox -->
                                                                    <!--  <div class="form-group clearfix">-->
                                                                    <!--    <div class="icheck-danger d-inline">-->
                                                                    <!--      <input type="checkbox" id="checkboxPrimary3_all" name="permission_5[]" value="">-->
                                                                    <!--      <label for="checkboxPrimary3_all">All </label>-->
                                                                    <!--    </div>-->
                                                                    <!--  </div>-->
                                                                    <!--</div>-->
                                                                    <div class="col-sm-6">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary3_1<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_5[]" value="5_1" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 5;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "5_1") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary3_1<?php echo $row["admin_id"]; ?>">Admission
                                                                                    Form </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="col-sm-12">
                                                        <div class="card card-warning">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Student</h3>
                                                            </div>
                                                            <div class="card-body pl-5 pr-5">
                                                                <!-- Minimal style -->
                                                                <div class="row">
                                                                    <!--  <div class="col-sm-6">-->
                                                                    <!-- checkbox -->
                                                                    <!--  <div class="form-group clearfix">-->
                                                                    <!--    <div class="icheck-danger d-inline">-->
                                                                    <!--      <input type="checkbox" id="checkboxPrimary4_all" name="permission_6[]" value="">-->
                                                                    <!--      <label for="checkboxPrimary4_all">All </label>-->
                                                                    <!--    </div>-->
                                                                    <!--  </div>-->
                                                                    <!--</div>-->
                                                                    <div class="col-sm-6">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary4_1<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_6[]" value="6_4" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 6;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "6_4") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary4_1<?php echo $row["admin_id"]; ?>">Student
                                                                                    List </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6" style="display:none;">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary4_2<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_6[]" value="6_5" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 6;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "6_5") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary4_2<?php echo $row["admin_id"]; ?>">Student
                                                                                    Edit </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="col-sm-12">
                                                        <div class="card card-warning">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Fee Payment</h3>
                                                            </div>
                                                            <div class="card-body pl-5 pr-5">
                                                                <!-- Minimal style -->
                                                                <div class="row">
                                                                    <!--  <div class="col-sm-6">-->
                                                                    <!-- checkbox -->
                                                                    <!--  <div class="form-group clearfix">-->
                                                                    <!--    <div class="icheck-danger d-inline">-->
                                                                    <!--      <input type="checkbox" id="checkboxPrimary5_all" name="permission_7[]" value="">-->
                                                                    <!--      <label for="checkboxPrimary5_all">All </label>-->
                                                                    <!--    </div>-->
                                                                    <!--  </div>-->
                                                                    <!--</div>-->
                                                                    <div class="col-sm-6">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary5_1<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_7[]" value="7_1" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 7;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "7_1") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary5_1<?php echo $row["admin_id"]; ?>">Add
                                                                                    Fees </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary5_2<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_7[]" value="7_4" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 7;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "7_4") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary5_2<?php echo $row["admin_id"]; ?>">Fee
                                                                                    Details </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary5_3<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_7[]" value="7_7" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 7;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "7_7") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary5_3<?php echo $row["admin_id"]; ?>">Pay
                                                                                    Fee </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary5_4<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_7[]" value="7_8" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 7;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "7_8") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary5_4<?php echo $row["admin_id"]; ?>">Print
                                                                                    Receipt </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-sm-6">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary5_11<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_7[]" value="7_13" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 7;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "7_8") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary5_11<?php echo $row["admin_id"]; ?>">Print</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>





                                                                    <div class="col-sm-6">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary5_5<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_7[]" value="7_9" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 7;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "7_9") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary5_5<?php echo $row["admin_id"]; ?>">Course
                                                                                    & Year Wise Fee Report </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary5_7<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_7[]" value="7_5" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 7;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "7_5") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary5_7<?php echo $row["admin_id"]; ?>">Hostel
                                                                                    Fee List</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary5_8<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_7[]" value="7_6" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 7;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "7_6") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary5_8<?php echo $row["admin_id"]; ?>">Student
                                                                                    Fee Card</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary5_6<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_7[]" value="7_10" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 7;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "7_10") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary5_6<?php echo $row["admin_id"]; ?>">Datewise
                                                                                    Fee Report </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary5_6<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_7[]" value="7_22" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 7;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "7_22") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary7_22<?php echo $row["admin_id"]; ?>">Hostel
                                                                                    Dashboard </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="col-sm-12">
                                                        <div class="card card-warning">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Income / Expenses</h3>
                                                            </div>
                                                            <div class="card-body pl-5 pr-5">
                                                                <!-- Minimal style -->
                                                                <div class="row">
                                                                    <!--  <div class="col-sm-6">-->
                                                                    <!-- checkbox -->
                                                                    <!--  <div class="form-group clearfix">-->
                                                                    <!--    <div class="icheck-danger d-inline">-->
                                                                    <!--      <input type="checkbox" id="checkboxPrimary6_all" name="permission_8[]" value="">-->
                                                                    <!--      <label for="checkboxPrimary6_all">All </label>-->
                                                                    <!--    </div>-->
                                                                    <!--  </div>-->
                                                                    <!--</div>-->
                                                                    <div class="col-sm-6">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary6_1<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_8[]" value="8_1" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 8;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "8_1") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary6_1<?php echo $row["admin_id"]; ?>">Extra
                                                                                    Income </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary6_2<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_8[]" value="8_2" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 8;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "8_2") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary6_2<?php echo $row["admin_id"]; ?>">Income
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary6_3<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_8[]" value="8_3" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 8;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "8_3") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary6_3<?php echo $row["admin_id"]; ?>">Expenses
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary6_4<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_8[]" value="8_4" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 8;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "8_4") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary6_4<?php echo $row["admin_id"]; ?>">Balance
                                                                                    Sheet </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="col-sm-12">
                                                        <div class="card card-warning">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Nsuniv Informations</h3>
                                                            </div>
                                                            <div class="card-body pl-5 pr-5">
                                                                <!-- Minimal style -->
                                                                <div class="row">
                                                                    <!--  <div class="col-sm-6">-->
                                                                    <!-- checkbox -->
                                                                    <!--  <div class="form-group clearfix">-->
                                                                    <!--    <div class="icheck-danger d-inline">-->
                                                                    <!--      <input type="checkbox" id="checkboxPrimary7_all" name="permission_9[]" value="">-->
                                                                    <!--      <label for="checkboxPrimary7_all">All </label>-->
                                                                    <!--    </div>-->
                                                                    <!--  </div>-->
                                                                    <!--</div>-->
                                                                    <div class="col-sm-6">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary7_1<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_9[]" value="9_4" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 9;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "9_4") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary7_1<?php echo $row["admin_id"]; ?>">Get
                                                                                    Started Enquiry </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary7_2<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_9[]" value="9_2" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 9;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "9_2") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary7_2<?php echo $row["admin_id"]; ?>">Prospectus
                                                                                    Enquiry </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary7_3<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_9[]" value="9_3" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 9;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "9_3") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary7_3<?php echo $row["admin_id"]; ?>">Admission
                                                                                    Enquiry </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary7_4<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_9[]" value="9_5" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 9;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "9_5") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary7_4<?php echo $row["admin_id"]; ?>">Notifications
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary7_5<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_9[]" value="9_6" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 9;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "9_6") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary7_5<?php echo $row["admin_id"]; ?>">Files
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="col-sm-12">
                                                        <div class="card card-warning">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Students And Examination</h3>
                                                            </div>
                                                            <div class="card-body pl-5 pr-5">
                                                                <!-- Minimal style -->
                                                                <div class="row">
                                                                    <!--  <div class="col-sm-6">-->
                                                                    <!-- checkbox -->
                                                                    <!--  <div class="form-group clearfix">-->
                                                                    <!--    <div class="icheck-danger d-inline">-->
                                                                    <!--      <input type="checkbox" id="checkboxPrimary8_all" name="permission_11[]" value="">-->
                                                                    <!--      <label for="checkboxPrimary8_all">All </label>-->
                                                                    <!--    </div>-->
                                                                    <!--  </div>-->
                                                                    <!--</div>-->
                                                                    <div class="col-sm-6">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary8_1<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_11[]" value="11_1" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 11;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "11_1") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary8_1<?php echo $row["admin_id"]; ?>">Add
                                                                                    Semester </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary8_2<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_11[]" value="11_2" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 11;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "11_2") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary8_2<?php echo $row["admin_id"]; ?>">Export
                                                                                    Student </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary8_8<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_11[]" value="11_8" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 11;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "11_8") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary8_8<?php echo $row["admin_id"]; ?>">Import
                                                                                    Student </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary8_3<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_11[]" value="11_3" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 11;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "11_3") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary8_3<?php echo $row["admin_id"]; ?>">Allocate
                                                                                    Semester to Student </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary8_4<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_11[]" value="11_4" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 11;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "11_4") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary8_4<?php echo $row["admin_id"]; ?>">Add
                                                                                    Subject </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary8_5<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_11[]" value="11_5" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 11;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "11_5") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary8_5<?php echo $row["admin_id"]; ?>">Add
                                                                                    Marks </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary8_6<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_11[]" value="11_6" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 11;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "11_6") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary8_6<?php echo $row["admin_id"]; ?>">Create
                                                                                    Report </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary8_7<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_11[]" value="11_7" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 11;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "11_7") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary8_7<?php echo $row["admin_id"]; ?>">Create
                                                                                    Full Report </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary8_30<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_11[]" value="11_30" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 11;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "11_30") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary8_30<?php echo $row["admin_id"]; ?>">Migration
                                                                                    Form </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="col-sm-12">
                                                        <div class="card card-warning">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Examination</h3>
                                                            </div>
                                                            <div class="card-body pl-5 pr-5">
                                                                <!-- Minimal style -->
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary9_1<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_12[]" value="12_1" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 12;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "12_1") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary9_1<?php echo $row["admin_id"]; ?>">Exam
                                                                                    Form</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary9_2<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_12[]" value="12_2" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 12;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "12_2") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary9_2<?php echo $row["admin_id"]; ?>">Student
                                                                                    List (No Dues) </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="col-sm-12">
                                                        <div class="card card-warning">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Complaints From Student</h3>
                                                            </div>
                                                            <div class="card-body pl-5 pr-5">
                                                                <!-- Minimal style -->
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary10_1<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_13[]" value="13_1" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 13;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "13_1") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary10_1<?php echo $row["admin_id"]; ?>">Complaints</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="col-sm-12">
                                                        <div class="card card-warning">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Admit Card</h3>
                                                            </div>
                                                            <div class="card-body pl-5 pr-5">
                                                                <!-- Minimal style -->
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary11_11<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_14[]" value="14_1" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 14;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "14_1") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary11_11<?php echo $row["admin_id"]; ?>">Admit
                                                                                    Card Approval</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>







                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-sm-6">
                                                    <div class="col-sm-12">
                                                        <div class="card card-warning">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Time Table</h3>
                                                            </div>
                                                            <div class="card-body pl-5 pr-5">
                                                                <!-- Minimal style -->
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <!-- checkbox -->
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-warning d-inline">
                                                                                <input type="checkbox"
                                                                                    id="checkboxPrimary11_1<?php echo $row["admin_id"]; ?>"
                                                                                    name="permission_15[]" value="15_1" <?php if (isset($autority)) {
                                                                                                    $page_no_temp = 15;
                                                                                                    $flag = 0;
                                                                                                    if (isset($allAutority->$page_no_temp)) {
                                                                                                        $subMenus = explode("||", $allAutority->$page_no_temp);
                                                                                                        for ($i = 0; $i < count($subMenus); $i++) {
                                                                                                            if ($subMenus[$i] == "15_1") {
                                                                                                                echo "checked";
                                                                                                                $flag++;
                                                                                                                break;
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                } ?>>
                                                                                <label
                                                                                    for="checkboxPrimary11_1<?php echo $row["admin_id"]; ?>">View
                                                                                    Time Table</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>








                                            </div>
                                        </div>
                                    </div>
                                    <br />
                                </div>

                            </div>
                            <div class="col-md-12" id="edit_error_section<?php echo $row["admin_id"]; ?>"></div>

                            <br>
                            <input type='hidden' name='edit_admin_id' id="edit_admin_id<?php echo $row["admin_id"]; ?>"
                                value='<?php echo $row["admin_id"]; ?>' />
                            <input type='hidden' name='action' id="action<?php echo $row["admin_id"]; ?>"
                                value='edit_admin' />
                            <div class="col-md-12" id="edit_loader_section<?php echo $row["admin_id"]; ?>"></div>
                            <button type="button" id="edit_admin_button<?php echo $row["admin_id"]; ?>"
                                class="btn btn-primary">Update</button>
                            <!--<button type="reset" class="btn btn-danger">Reset</button>-->
                        </div>
                    </form>
                    <script>
                    $(function() {

                        $('#edit_admin_button<?php echo $row["admin_id"]; ?>').click(function() {
                            $('#edit_loader_section<?php echo $row["admin_id"]; ?>').append(
                                '<center id = "edit_loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /></center>'
                            );
                            $('#edit_admin_button<?php echo $row["admin_id"]; ?>').prop('disabled',
                                true);
                            var permission_3 = "";
                            var permission_4 = "";
                            var permission_5 = "";
                            var permission_6 = "";
                            var permission_7 = "";
                            var permission_8 = "";
                            var permission_9 = "";
                            var permission_11 = "";
                            var permission_12 = "";
                            var permission_13 = "";
                            var permission_14 = "";

                            if ($("#checkboxPrimary1_1<?php echo $row["admin_id"]; ?>").is(":checked"))
                                permission_3 = permission_3 + $(
                                    "#checkboxPrimary1_1<?php echo $row["admin_id"]; ?>").val() + "||";
                            if ($("#checkboxPrimary1_2<?php echo $row["admin_id"]; ?>").is(":checked"))
                                permission_3 = permission_3 + $(
                                    "#checkboxPrimary1_2<?php echo $row["admin_id"]; ?>").val() + "||";

                            if ($("#checkboxPrimary2_1<?php echo $row["admin_id"]; ?>").is(":checked"))
                                permission_4 = permission_4 + $(
                                    "#checkboxPrimary2_1<?php echo $row["admin_id"]; ?>").val() + "||";

                            if ($("#checkboxPrimary3_1<?php echo $row["admin_id"]; ?>").is(":checked"))
                                permission_5 = permission_5 + $(
                                    "#checkboxPrimary3_1<?php echo $row["admin_id"]; ?>").val() + "||";

                            if ($("#checkboxPrimary4_1<?php echo $row["admin_id"]; ?>").is(":checked"))
                                permission_6 = permission_6 + $(
                                    "#checkboxPrimary4_1<?php echo $row["admin_id"]; ?>").val() + "||";
                            if ($("#checkboxPrimary4_2<?php echo $row["admin_id"]; ?>").is(":checked"))
                                permission_6 = permission_6 + $(
                                    "#checkboxPrimary4_2<?php echo $row["admin_id"]; ?>").val() + "||";

                            if ($("#checkboxPrimary5_1<?php echo $row["admin_id"]; ?>").is(":checked"))
                                permission_7 = permission_7 + $(
                                    "#checkboxPrimary5_1<?php echo $row["admin_id"]; ?>").val() + "||";
                            if ($("#checkboxPrimary5_2<?php echo $row["admin_id"]; ?>").is(":checked"))
                                permission_7 = permission_7 + $(
                                    "#checkboxPrimary5_2<?php echo $row["admin_id"]; ?>").val() + "||";
                            if ($("#checkboxPrimary5_3<?php echo $row["admin_id"]; ?>").is(":checked"))
                                permission_7 = permission_7 + $(
                                    "#checkboxPrimary5_3<?php echo $row["admin_id"]; ?>").val() + "||";
                            if ($("#checkboxPrimary5_4<?php echo $row["admin_id"]; ?>").is(":checked"))
                                permission_7 = permission_7 + $(
                                    "#checkboxPrimary5_4<?php echo $row["admin_id"]; ?>").val() + "||";
                            if ($("#checkboxPrimary5_5<?php echo $row["admin_id"]; ?>").is(":checked"))
                                permission_7 = permission_7 + $(
                                    "#checkboxPrimary5_5<?php echo $row["admin_id"]; ?>").val() + "||";
                            if ($("#checkboxPrimary5_6<?php echo $row["admin_id"]; ?>").is(":checked"))
                                permission_7 = permission_7 + $(
                                    "#checkboxPrimary5_6<?php echo $row["admin_id"]; ?>").val() + "||";
                            if ($("#checkboxPrimary5_7<?php echo $row["admin_id"]; ?>").is(":checked"))
                                permission_7 = permission_7 + $(
                                    "#checkboxPrimary5_7<?php echo $row["admin_id"]; ?>").val() + "||";
                            if ($("#checkboxPrimary5_8<?php echo $row["admin_id"]; ?>").is(":checked"))
                                permission_7 = permission_7 + $(
                                    "#checkboxPrimary5_8<?php echo $row["admin_id"]; ?>").val() + "||";

                            if ($("#checkboxPrimary6_1<?php echo $row["admin_id"]; ?>").is(":checked"))
                                permission_8 = permission_8 + $(
                                    "#checkboxPrimary6_1<?php echo $row["admin_id"]; ?>").val() + "||";
                            if ($("#checkboxPrimary6_2<?php echo $row["admin_id"]; ?>").is(":checked"))
                                permission_8 = permission_8 + $(
                                    "#checkboxPrimary6_2<?php echo $row["admin_id"]; ?>").val() + "||";
                            if ($("#checkboxPrimary6_3<?php echo $row["admin_id"]; ?>").is(":checked"))
                                permission_8 = permission_8 + $(
                                    "#checkboxPrimary6_3<?php echo $row["admin_id"]; ?>").val() + "||";
                            if ($("#checkboxPrimary6_4<?php echo $row["admin_id"]; ?>").is(":checked"))
                                permission_8 = permission_8 + $(
                                    "#checkboxPrimary6_4<?php echo $row["admin_id"]; ?>").val() + "||";

                            if ($("#checkboxPrimary7_1<?php echo $row["admin_id"]; ?>").is(":checked"))
                                permission_9 = permission_9 + $(
                                    "#checkboxPrimary7_1<?php echo $row["admin_id"]; ?>").val() + "||";
                            if ($("#checkboxPrimary7_2<?php echo $row["admin_id"]; ?>").is(":checked"))
                                permission_9 = permission_9 + $(
                                    "#checkboxPrimary7_2<?php echo $row["admin_id"]; ?>").val() + "||";
                            if ($("#checkboxPrimary7_3<?php echo $row["admin_id"]; ?>").is(":checked"))
                                permission_9 = permission_9 + $(
                                    "#checkboxPrimary7_3<?php echo $row["admin_id"]; ?>").val() + "||";
                            if ($("#checkboxPrimary7_4<?php echo $row["admin_id"]; ?>").is(":checked"))
                                permission_9 = permission_9 + $(
                                    "#checkboxPrimary7_4<?php echo $row["admin_id"]; ?>").val() + "||";
                            if ($("#checkboxPrimary7_5<?php echo $row["admin_id"]; ?>").is(":checked"))
                                permission_9 = permission_9 + $(
                                    "#checkboxPrimary7_5<?php echo $row["admin_id"]; ?>").val() + "||";
                            if ($("#checkboxPrimary7_6<?php echo $row["admin_id"]; ?>").is(":checked"))
                                permission_9 = permission_9 + $(
                                    "#checkboxPrimary7_6<?php echo $row["admin_id"]; ?>").val() + "||";

                            if ($("#checkboxPrimary8_1<?php echo $row["admin_id"]; ?>").is(":checked"))
                                permission_11 = permission_11 + $(
                                    "#checkboxPrimary8_1<?php echo $row["admin_id"]; ?>").val() + "||";
                            if ($("#checkboxPrimary8_2<?php echo $row["admin_id"]; ?>").is(":checked"))
                                permission_11 = permission_11 + $(
                                    "#checkboxPrimary8_2<?php echo $row["admin_id"]; ?>").val() + "||";
                            if ($("#checkboxPrimary8_8<?php echo $row["admin_id"]; ?>").is(":checked"))
                                permission_11 = permission_11 + $(
                                    "#checkboxPrimary8_8<?php echo $row["admin_id"]; ?>").val() + "||";
                            if ($("#checkboxPrimary8_3<?php echo $row["admin_id"]; ?>").is(":checked"))
                                permission_11 = permission_11 + $(
                                    "#checkboxPrimary8_3<?php echo $row["admin_id"]; ?>").val() + "||";
                            if ($("#checkboxPrimary8_4<?php echo $row["admin_id"]; ?>").is(":checked"))
                                permission_11 = permission_11 + $(
                                    "#checkboxPrimary8_4<?php echo $row["admin_id"]; ?>").val() + "||";
                            if ($("#checkboxPrimary8_5<?php echo $row["admin_id"]; ?>").is(":checked"))
                                permission_11 = permission_11 + $(
                                    "#checkboxPrimary8_5<?php echo $row["admin_id"]; ?>").val() + "||";
                            if ($("#checkboxPrimary8_6<?php echo $row["admin_id"]; ?>").is(":checked"))
                                permission_11 = permission_11 + $(
                                    "#checkboxPrimary8_6<?php echo $row["admin_id"]; ?>").val() + "||";
                            if ($("#checkboxPrimary8_7<?php echo $row["admin_id"]; ?>").is(":checked"))
                                permission_11 = permission_11 + $(
                                    "#checkboxPrimary8_7<?php echo $row["admin_id"]; ?>").val() + "||";
                            if ($("#checkboxPrimary8_30<?php echo $row["admin_id"]; ?>").is(":checked"))
                                permission_11 = permission_11 + $(
                                    "#checkboxPrimary8_30<?php echo $row["admin_id"]; ?>").val() + "||";

                            if ($("#checkboxPrimary9_1<?php echo $row["admin_id"]; ?>").is(":checked"))
                                permission_12 = permission_12 + $(
                                    "#checkboxPrimary9_1<?php echo $row["admin_id"]; ?>").val() + "||";
                            if ($("#checkboxPrimary9_2<?php echo $row["admin_id"]; ?>").is(":checked"))
                                permission_12 = permission_12 + $(
                                    "#checkboxPrimary9_2<?php echo $row["admin_id"]; ?>").val() + "||";

                            if ($("#checkboxPrimary10_1<?php echo $row["admin_id"]; ?>").is(":checked"))
                                permission_13 = permission_13 + $(
                                    "#checkboxPrimary10_1<?php echo $row["admin_id"]; ?>").val() + "||";

                            if ($("#checkboxPrimary11_11<?php echo $row["admin_id"]; ?>").is(
                                    ":checked"))
                                permission_14 = permission_14 + $(
                                    "#checkboxPrimary11_11<?php echo $row["admin_id"]; ?>").val() +
                                "||";

                            var action = $("#action<?php echo $row["admin_id"]; ?>").val();
                            var edit_admin_id = $("#edit_admin_id<?php echo $row["admin_id"]; ?>")
                                .val();
                            var edit_admin_name = $("#edit_admin_name<?php echo $row["admin_id"]; ?>")
                                .val();
                            var edit_admin_username = $(
                                "#edit_admin_username<?php echo $row["admin_id"]; ?>").val();
                            var edit_admin_password = $(
                                "#edit_admin_password<?php echo $row["admin_id"]; ?>").val();
                            var admin_password = $("#admin_password<?php echo $row["admin_id"]; ?>")
                                .val();

                            var edit_admin_email = $("#edit_admin_email<?php echo $row["admin_id"]; ?>")
                                .val();
                            var edit_admin_mobile = $(
                                "#edit_admin_mobile<?php echo $row["admin_id"]; ?>").val();
                            var dataString = 'action=' + action + '&permission_3=' + permission_3 +
                                '&permission_4=' + permission_4 + '&permission_5=' + permission_5 +
                                '&permission_6=' + permission_6 + '&permission_7=' + permission_7 +
                                '&permission_8=' + permission_8 + '&permission_9=' + permission_9 +
                                '&permission_11=' + permission_11 + '&permission_12=' + permission_12 +
                                '&permission_13=' + permission_13 + '&permission_14=' + permission_14 +
                                '&edit_admin_id=' + edit_admin_id + '&edit_admin_name=' +
                                edit_admin_name + '&edit_admin_username=' + edit_admin_username +
                                '&edit_admin_email=' + edit_admin_email + '&edit_admin_mobile=' +
                                edit_admin_mobile + '&edit_admin_password=' + edit_admin_password +
                                '&admin_password=' + admin_password;
                            $.ajax({
                                url: 'include/controller.php',
                                type: 'POST',
                                data: dataString,
                                success: function(result) {
                                    $('#edit_response').remove();
                                    if (result == "exsits") {
                                        $('#edit_error_section<?php echo $row["admin_id"]; ?>')
                                            .append(
                                                '<div id = "edit_response"><div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-exclamation-triangle"></i> This Username have already exsits!!!</div></div>'
                                            );
                                    }
                                    if (result == "error") {
                                        $('#edit_error_section<?php echo $row["admin_id"]; ?>')
                                            .append(
                                                '<div id = "edit_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                            );
                                    }
                                    if (result == "empty") {
                                        $('#edit_error_section<?php echo $row["admin_id"]; ?>')
                                            .append(
                                                '<div id = "edit_response"><div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-exclamation-triangle"></i>  Please fill out all fields!!!</div></div>'
                                            );
                                    }
                                    if (result == "success") {
                                        $('#edit_error_section<?php echo $row["admin_id"]; ?>')
                                            .append(
                                                '<div id = "edit_response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i>  Updated successfully!!!</div></div>'
                                            );
                                        showUpdatedData();

                                        function showUpdatedData() {
                                            $.ajax({
                                                url: 'include/view.php?action=get_admin',
                                                type: 'GET',
                                                success: function(result) {
                                                    $("#data_table").html(
                                                        result);
                                                }
                                            });
                                        }
                                    } else {
                                        $('#edit_error_section<?php echo $row["admin_id"]; ?>')
                                            .append(result);

                                    }
                                    $('#edit_loading').fadeOut(500, function() {
                                        $(this).remove();
                                    });
                                    $('#edit_admin_button<?php echo $row["admin_id"]; ?>')
                                        .prop('disabled', false);
                                }

                            });
                        });

                    });
                    </script>
                </div>
            </div>
            <!-- Admin Edit Section End -->

            <!-- Admin delete Section Start -->
            <div id="delete_admin<?php echo $row["admin_id"]; ?>" class="w3-modal" style="z-index:2020;">
                <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
                    <header class="w3-container" style="background:#343a40; color:white;">
                        <span
                            onclick="document.getElementById('delete_admin<?php echo $row["admin_id"]; ?>').style.display='none'"
                            class="w3-button w3-display-topright">&times;</span>
                        <h2 align="center">Are you sure???</h2>
                    </header>
                    <form id="delete_admin_form<?php echo $row["admin_id"]; ?>" role="form" method="POST">
                        <div class="card-body">
                            <div class="col-md-12" id="delete_error_section<?php echo $row["admin_id"]; ?>"></div>
                            <div class="col-md-12" align="center">
                                <input type='hidden' name='delete_admin_id'
                                    id="delete_admin_id<?php echo $row["admin_id"]; ?>"
                                    value='<?php echo $row["admin_id"]; ?>' />
                                <input type='hidden' name='action' id="action_delete<?php echo $row["admin_id"]; ?>"
                                    value='delete_admin' />
                                <div class="col-md-12" id="delete_loader_section<?php echo $row["admin_id"]; ?>"></div>
                                <button type="button" id="delete_admin_button<?php echo $row["admin_id"]; ?>"
                                    class="btn btn-danger">Move To Trash</button>
                                <button type="button"
                                    onclick="document.getElementById('delete_admin<?php echo $row["admin_id"]; ?>').style.display='none'"
                                    class="btn btn-primary">Cancel</button>
                            </div>

                            <!--<button type="reset" class="btn btn-danger">Reset</button>-->
                        </div>
                    </form>
                    <script>
                    $(function() {

                        $('#delete_admin_button<?php echo $row["admin_id"]; ?>').click(function() {
                            $('#delete_loader_section<?php echo $row["admin_id"]; ?>').append(
                                '<center id = "delete_loading"><img width="50px" src = "images/ajax-loader.gif" alt="Currently loading" /><br/><br/></center>'
                            );
                            $('#delete_admin_button<?php echo $row["admin_id"]; ?>').prop('disabled',
                                true);
                            var action = $("#action_delete<?php echo $row["admin_id"]; ?>").val();
                            var delete_admin_id = $("#delete_admin_id<?php echo $row["admin_id"]; ?>")
                                .val();
                            var dataString = 'action=' + action + '&delete_admin_id=' + delete_admin_id;

                            $.ajax({
                                url: 'include/controller.php',
                                type: 'POST',
                                data: dataString,
                                success: function(result) {
                                    $('#delete_response').remove();
                                    if (result == "error") {
                                        $('#delete_error_section<?php echo $row["admin_id"]; ?>')
                                            .append(
                                                '<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                            );
                                    }
                                    if (result == "empty") {
                                        $('#delete_error_section<?php echo $row["admin_id"]; ?>')
                                            .append(
                                                '<div id = "delete_response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>'
                                            );
                                    }
                                    if (result == "success") {
                                        $('#delete_error_section<?php echo $row["admin_id"]; ?>')
                                            .append(
                                                '<div id = "delete_response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Delete successfully!!!</div></div>'
                                            );
                                        showDeletedData();

                                        function showDeletedData() {
                                            $.ajax({
                                                url: 'include/view.php?action=get_admin',
                                                type: 'GET',
                                                success: function(result) {
                                                    $("#data_table").html(
                                                        result);
                                                }
                                            });
                                        }
                                    }
                                    $('#delete_loading').fadeOut(500, function() {
                                        $(this).remove();
                                    });
                                    $('#delete_admin_button<?php echo $row["admin_id"]; ?>')
                                        .prop('disabled', false);
                                }

                            });
                        });

                    });
                    </script>
                </div>
            </div>
            <!-- admin delete Section End -->
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
<?php
}