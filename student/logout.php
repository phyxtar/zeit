<?php
//Starting Session
if (empty(session_start()))
    session_start();
//DataBase Connectivity
include "include/config.php";
session_destroy();
echo "<script> location.replace('student_login'); </script>";
