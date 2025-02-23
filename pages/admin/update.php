<?php
include "../../include/config.php";
include "../../framwork/main.php";
//Edit Admin Start With Ajax
if ($_POST["action"] == "edit_admin") {

    $edit_admin_name = $_POST["edit_admin_name"];
    // $edit_permissions = $_POST["edit_permissions"];
    $edit_admin_username = $_POST["edit_admin_username"];
    //$edit_admin_password = $_POST["edit_admin_password"];
    $edit_admin_email = $_POST["edit_admin_email"];
    $edit_admin_mobile = $_POST["edit_admin_mobile"];
    $edit_admin_id = $_POST["edit_admin_id"];
    $admin_type = $_POST['admin_type'];
    $selected_courses = isset($_POST['hod_permission']) ? $_POST['hod_permission'] : [];

    // Convert the selected courses array to a JSON format
    $new_selected_courses = json_encode($selected_courses);
    if ($_POST['edit_admin_password'] == '') {
        $edit_admin_password = $_POST['admin_password'];
    } else {
        $edit_admin_password = md5($_POST['edit_admin_password']);
    }

    if (!empty($edit_admin_name && $edit_admin_id)) {
        if (isset($_POST["permission_2"]) && $_POST["permission_2"] != "") {
            $permission_2 = implode("||", $_POST["permission_2"]);
        } else
            $permission_2 = "";
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

        if (isset($_POST["permission_15"]) && $_POST["permission_15"] != "") {
            $permission_15 = implode("||", $_POST["permission_15"]);
        } else
            $permission_15 = "";

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

        print_r($permission_18);
    }
    $allPermissions = array(
        "2"          =>        $permission_2,
        "3"          =>        $permission_3,
        "4"          =>        $permission_4,
        "5"          =>        $permission_5,
        "6"          =>        $permission_6,
        "7"          =>        $permission_7,
        "8"          =>        $permission_8,
        "9"          =>        $permission_9,
        "11"         =>        $permission_11,
        "12"         =>        $permission_12,
        "13"         =>        $permission_13,
        "14"         =>        $permission_14,
        "15"         =>        $permission_15,
        "16"         =>        $permission_16,
        "17"         =>        $permission_17,
        "18"         =>        $permission_18,
    );
    $sql = "UPDATE `tbl_admin` 
                    SET 
                    `admin_name` = '$edit_admin_name', `admin_email` = '$edit_admin_email', `admin_mobile` = '$edit_admin_mobile', `admin_permission` = '" . json_encode($allPermissions) . "'
                    ,`admin_password`='$edit_admin_password',`admin_type`='$admin_type', `hod_permission`= '$new_selected_courses'
                    WHERE `status` = '$visible' && `admin_id` = '$edit_admin_id';
                    ";
    if ($con->query($sql)) {
        echo success_alert("Admin updated SuccessFully !!!");
    } else {
        echo danger_alert($con->error);
    }
} else
    echo warning_alert('Please Fill All the Filled !!!');
//Edit Admin End With Ajax
