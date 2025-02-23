<?php

//     ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
//Starting Session
if (empty (session_start()))
    session_start();
//Logger Type
$logger_type = $_SESSION["logger_type"];
if ($logger_type == "subadmin")
    $autority = $_SESSION["authority"];
//print_r($autority);
//DataBase Connectivity
include_once "config.php";
include_once __DIR__ . "../../framwork/main.php";
$idle_time = 1200;
$visible = md5("visible");
$trash = md5("trash");
if (time() - $_SESSION["logger_time"] > $idle_time) {
    unset($_SESSION["logger_time"]);
    unset($_SESSION["logger_type"]);
    unset($_SESSION["logger_username"]);
    unset($_SESSION["logger_password"]);
    redirect("index");
} else {
    $_SESSION["logger_time"] = time();
}
if (!isset ($_SESSION["logger_type"]) && !isset ($_SESSION["logger_username"]) && !isset ($_SESSION["logger_password"]))
    redirect("index");

$flag = 0;
if (isset ($autority)) {
    $allAutority = json_decode($autority);
    if ($page_no != 1) {
        if (isset ($allAutority->$page_no)) {
            $subMenus = explode("||", $allAutority->$page_no);
            for ($i = 0; $i < count($subMenus); $i++) {
                if ($subMenus[$i] == $page_no_inside) {
                    $flag++;
                    break;
                }
            }
            if ($flag == 0) {
                redirect('dashboard');
            }
        } else
            redirect('dashboard');
    }
}


?>