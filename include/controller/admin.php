<?php

if ($_POST["action"] == "add_admin") {

    $admin_name = $_POST["admin_name"];
    $admin_username = $_POST["admin_username"];
    $admin_password = md5($_POST["admin_password"]);
    $admin_email = $_POST["admin_email"];
    $admin_mobile = $_POST["admin_mobile"];
    $hod_permission = isset($_POST["hod_permission"]) ? $_POST["hod_permission"] : [];
    $admin_type = $_POST["admin_type"];
    if (!empty($admin_name && $admin_username && $admin_password)) {

        if (isset($_POST["permission_2"]) && count($_POST["permission_2"]) >= 1) {
            $permission_2 = implode("||", $_POST["permission_2"]);
        } 
        else
            $permission_2 = "";

        if (isset($_POST["permission_3"]) && count($_POST["permission_3"]) >= 1) {
            $permission_3 = implode("||", $_POST["permission_3"]);
        } 
        else
            $permission_3 = "";

        if (isset($_POST["permission_4"]) && count($_POST["permission_4"]) >= 1) {
            $permission_4 = implode("||", $_POST["permission_4"]);
        } 
        else
            $permission_4 = "";

        if (isset($_POST["permission_5"]) && count($_POST["permission_5"]) >= 1) {
            $permission_5 = implode("||", $_POST["permission_5"]);
        } 
        else
            $permission_5 = "";

        if (isset($_POST["permission_6"]) && count($_POST["permission_6"]) >= 1) {
            $permission_6 = implode("||", $_POST["permission_6"]);
        } 
        else
            $permission_6 = "";

        if (isset($_POST["permission_7"]) && count($_POST["permission_7"]) >= 1) {
            $permission_7 = implode("||", $_POST["permission_7"]);
        } 
        else
            $permission_7 = "";

        if (isset($_POST["permission_8"]) && count($_POST["permission_8"]) >= 1) {
            $permission_8 = implode("||", $_POST["permission_8"]);
        } 
        else
            $permission_8 = "";

        if (isset($_POST["permission_9"]) && count($_POST["permission_9"]) >= 1) {
            $permission_9 = implode("||", $_POST["permission_9"]);
        } 
        else
            $permission_9 = "";

        if (isset($_POST["permission_11"]) && count($_POST["permission_11"]) >= 1) {
            $permission_11 = implode("||", $_POST["permission_11"]);
        } 
        else
            $permission_11 = "";

        if (isset($_POST["permission_12"]) && count($_POST["permission_12"]) >= 1) {
            $permission_12 = implode("||", $_POST["permission_12"]);
        } 
        else
            $permission_12 = "";

        if (isset($_POST["permission_13"]) && count($_POST["permission_13"]) >= 1) {
            $permission_13 = implode("||", $_POST["permission_13"]);
        } 
        else
            $permission_13 = "";

        if (isset($_POST["permission_14"]) && count($_POST["permission_14"]) >= 1) {
            $permission_14 = implode("||", $_POST["permission_14"]);
        } 
        else
            $permission_14 = "";

        if (isset($_POST["permission_15"]) && count($_POST["permission_15"]) >= 1) {
            $permission_15 = implode("||", $_POST["permission_15"]);
        } 
        else
            $permission_15 = "";

        if (isset($_POST["permission_16"]) && count($_POST["permission_16"]) >= 1) {
            $permission_16 = implode("||", $_POST["permission_16"]);
        } 
        else
            $permission_16 = "";

        if (isset($_POST["permission_17"]) && count($_POST["permission_17"]) >= 1) {
            $permission_17 = implode("||", $_POST["permission_17"]);
        } 
        else
            $permission_17 = "";

        $allPermissions = array(
            "2"          =>       $permission_2,
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
            "15"         =>       $permission_15,
            "16"         =>       $permission_16,
            "17"         =>       $permission_17,
        );
        $hod_permissions_json = json_encode($hod_permission);
        $sql = "INSERT INTO `tbl_admin`
                        (`admin_id`, `admin_name`, `admin_username`, `admin_password`, `admin_email`, `admin_mobile`, `admin_type`, `admin_permission`,`hod_permission`, `status`) 
                        VALUES 
                        (NULL,'$admin_name','$admin_username','$admin_password','$admin_email','$admin_mobile','$admin_type','" . json_encode($allPermissions) . "','$hod_permissions_json','$visible')
                        ";

        if ($con->query($sql)) {

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
//Edit Admin Start With Ajax
if ($_POST["action"] == "edit_admin") {
    $flag = 1;
    include '../framwork/main.php';
    $edit_admin_name = $_POST["edit_admin_name"];
    // $edit_permissions = $_POST["edit_permissions"];
    $edit_admin_username = $_POST["edit_admin_username"];
    //$edit_admin_password = $_POST["edit_admin_password"];
    $edit_admin_email = $_POST["edit_admin_email"];
    $edit_admin_mobile = $_POST["edit_admin_mobile"];
    $edit_admin_id = $_POST["edit_admin_id"];

    if ($_POST['admin_password'] == '') {
        $edit_admin_password = $_POST['edit_admin_password'];
    } else {
        $edit_admin_password = password_check($_POST['admin_password']);
        if (!$edit_admin_password) {
            echo '
            <div class="alert alert-danger alert-dismissible">
                <i class="icon fas fa-ban"></i> Password must 0-9,a-z ,A-Z ,[!@#$%^&*-] minimum 8 character 
            </div>';
            $flag = 0;
        }
    }
    if ($flag == 1) {
        if (!empty($edit_admin_name && $edit_admin_id)) {
            if ($_POST["permission_2"] != "") {
                $permission_2 = $_POST["permission_2"];
            } else
                $permission_2 = "";
            if ($_POST["permission_3"] != "") {
                $permission_3 = $_POST["permission_3"];
            } else
                $permission_3 = "";
            if ($_POST["permission_4"] != "") {
                $permission_4 = $_POST["permission_4"];
            } else
                $permission_4 = "";
            if ($_POST["permission_5"] != "") {
                $permission_5 = $_POST["permission_5"];
            } else
                $permission_5 = "";
            if ($_POST["permission_6"] != "") {
                $permission_6 = $_POST["permission_6"];
            } else
                $permission_6 = "";
            if ($_POST["permission_7"] != "") {
                $permission_7 = $_POST["permission_7"];
            } else
                $permission_7 = "";
            if ($_POST["permission_8"] != "") {
                $permission_8 = $_POST["permission_8"];
            } else
                $permission_8 = "";
            if ($_POST["permission_9"] != "") {
                $permission_9 = $_POST["permission_9"];
            } else
                $permission_9 = "";
            if ($_POST["permission_11"] != "") {
                $permission_11 = $_POST["permission_11"];
            } else
                $permission_11 = "";
            if ($_POST["permission_12"] != "") {
                $permission_12 = $_POST["permission_12"];
            } else
                $permission_12 = "";
            if ($_POST["permission_13"] != "") {
                $permission_13 = $_POST["permission_13"];
            } else
                $permission_13 = "";

            if ($_POST["permission_14"] != "") {
                $permission_14 = $_POST["permission_14"];
            } else
                $permission_14 = "";

            if ($_POST["permission_15"] != "") {
                $permission_15 = $_POST["permission_15"];
            } else
                $permission_15 = "";

            if ($_POST["permission_16"] != "") {
                $permission_16 = $_POST["permission_16"];
            } else
                $permission_16 = "";

            if ($_POST["permission_17"] != "") {
                $permission_17 = $_POST["permission_17"];
            } else
                $permission_17 = "";
            
           

            $allPermissions = array(
                "2"          =>       $permission_2,
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
                "15"         =>       $permission_15,
                "16"         =>       $permission_16,
                "17"         =>       $permission_17
            );



            $sql = "UPDATE `tbl_admin` 
                    SET 
                    `admin_name` = '$edit_admin_name', `admin_email` = '$edit_admin_email', `admin_mobile` = '$edit_admin_mobile', `admin_permission` = '" . json_encode($allPermissions) . "', `admin_password`='$edit_admin_password'
                    WHERE `status` = '$visible' && `admin_id` = '$edit_admin_id';
                    ";
            if ($con->query($sql))
                echo 'success';
            else
                echo 'error';
        } else
            echo 'empty';
    }
}
//Edit Admin End With Ajax
//Delete Admin Start With Ajax
if ($_POST["action"] == "delete_admin") {
    $delete_admin_id = $_POST["delete_admin_id"];
    if (!empty($delete_admin_id)) {
        $sql = "UPDATE `tbl_admin` 
                    SET 
                    `status` = '$trash'
                    WHERE `status` = '$visible' && `admin_id` = '$delete_admin_id';
                    ";
        if ($con->query($sql))
            echo 'success';
        else
            echo 'error';
    } else
        echo 'empty';
}
//Delete Admin End With Ajax