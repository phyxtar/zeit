<?php

// Create connection
if ($_SERVER['HTTP_HOST'] == 'localhost') {
    $con = new mysqli("localhost", "root", "", "zeit");
} else {

    //$con = new mysqli("localhost", "nsucms_cms", "wpNnnOv5", "nsucms_cms");

    $con = new mysqli("localhost", "dev03_zeit", "g&d!KBaM]^x!", "dev03_zeit");
    // $con = new mysqli("localhost", "usernsucms_cms", "wpNnnOv5", "usernsucms_cms");
}
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}