<?php

// Create connection
if ($_SERVER['HTTP_HOST'] == 'localhost') {
    $con = new mysqli("localhost", "root", "", "zeit");
} else {

    //$con = new mysqli("localhost", "nsucms_cms", "wpNnnOv5", "nsucms_cms");

    $con = new mysqli("localhost", "usernsucms_cms", "Nsuraja83013@#", "nsucms_cms");
    // $con = new mysqli("localhost", "usernsucms_cms", "wpNnnOv5", "usernsucms_cms");
}
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}