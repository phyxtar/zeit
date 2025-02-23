<?php
include "../../include/config.php";
include "../../framwork/main.php";
$visible = md5('visible');
//Add admin Start With Ajax
if ($_POST["action"] == "add_admin") {
    // echo "<pre>";
    // print_r($_POST);
    // exit;
    $admin_name = $_POST["admin_name"];
    $admin_username = $_POST["admin_username"];
    $admin_password = md5($_POST["admin_password"]);

    //$retype_password = $_POST["retype_password"];
    // $admin_email = $_POST["admin_email"];
    // $admin_mobile = $_POST["admin_mobile"];
    $admin_type = $_POST["admin_type"];
    $admin_branch = $_POST["admin_branch"];
    $admin_branch = $_POST["admin_branch"];
    $hod_permission = $_POST["hod_permission"];
    $admin_employee = $_POST["admin_employee"];
    if (!empty($admin_name && $admin_username && $admin_password)) {
        if (isset($_POST["permission_3"]) && $_POST["permission_3"] != "") {
            $permission_3 = implode("||", $_POST["permission_3"]);
        } else
            $permission_3 = "";
        if (isset($_POST["permission_4"]) && $_POST["permission_4"] != "") {
            $permission_4 = implode("||", $_POST["permission_4"]);
        } else
            $permission_4 = "";
        if (isset($_POST["permission_5"]) && $_POST["permission_5"] != "") {
            $permission_5 = implode("||", $_POST["permission_5"]);
        } else
            $permission_5 = "";
        if (isset($_POST["permission_6"]) && $_POST["permission_6"] != "") {
            $permission_6 = implode("||", $_POST["permission_6"]);
        } else
            $permission_6 = "";
        if ($_POST["permission_7"] != "") {
            $permission_7 = implode("||", $_POST["permission_7"]);
        } else
            $permission_7 = "";
        if (isset($_POST["permission_8"]) && $_POST["permission_8"] != "") {
            $permission_8 = implode("||", $_POST["permission_8"]);
        } else
            $permission_8 = "";
        if (isset($_POST["permission_9"]) && $_POST["permission_9"] != "") {
            $permission_9 = implode("||", $_POST["permission_9"]);
        } else
            $permission_9 = "";
        if (isset($_POST["permission_11"]) && $_POST["permission_11"] != "") {
            $permission_11 = implode("||", $_POST["permission_11"]);
        } else
            $permission_11 = "";
        if (isset($_POST["permission_12"]) && $_POST["permission_12"] != "") {
            $permission_12 = implode("||", $_POST["permission_12"]);
        } else
            $permission_12 = "";
        if (isset($_POST["permission_13"]) && $_POST["permission_13"] != "") {
            $permission_13 = implode("||", $_POST["permission_13"]);
        } else
            $permission_13 = "";

        if (isset($_POST["permission_14"]) && $_POST["permission_14"] != "") {
            $permission_14 = implode("||", $_POST["permission_14"]);
        } else
            $permission_14 = "";

        if (isset($_POST["permission_16"]) && $_POST["permission_16"] != "") {
            $permission_16 = implode("||", $_POST["permission_16"]);
        } else
            $permission_16 = "";

        if (isset($_POST["permission_17"]) && $_POST["permission_17"] != "") {
            $permission_17 = implode("||", $_POST["permission_17"]);
        } else
            $permission_17 = "";

        if (isset($_POST["permission_18"]) && $_POST["permission_18"] != "") {
            $permission_18 = implode("||", $_POST["permission_18"]);
        } else
            $permission_18 = "";

        $allPermissions = array(
            "3"          =>       $permission_3,
            "4"          =>       $permission_4,
            "5"          =>       $permission_5,
            "6"          =>       $permission_6,
            "7"          =>       $permission_7,
            "8"          =>       $permission_8,
            "9"          =>       $permission_9,
            "11"         =>       $permission_11,
            "12"         =>       $permission_12,
            "13"         =>       $permission_13,
            "14"         =>       $permission_14,
            "16"         =>       $permission_16,
            "17"         =>       $permission_17,
            "18"         =>       $permission_18

        );
       echo $sql = "INSERT INTO `tbl_admin`
                        ( `admin_name`, `admin_username`, `admin_password`, `admin_type`, `admin_permission`, `hod_permission`, `admin_branch`,`employee_id`, `status`) 
                        VALUES 
                        ('$admin_name','$admin_username','$admin_password','$admin_type','" . json_encode($allPermissions) . "','$hod_permission','$admin_branch','$admin_employee','$visible')
                        ";
        $sql1 = "UPDATE `tbl_employee` SET `branch_id`='$admin_branch',`user_id`='$admin_username',`password`='$admin_password' WHERE `id`='$admin_employee'";
        if ($con->query($sql) && $con->query($sql1)) {

            echo '
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <i class="icon fas fa-check"></i> Added successfully!!!
                    </div>';
        } else
            echo '
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <i class="icon fas fa-ban"></i> Something went wrong please try again!!!
                    </div>';
    } else
        echo '
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="icon fas fa-exclamation-triangle"></i>  Fill out all required fields!!!
                </div>';
}
//Add admin End With Ajax