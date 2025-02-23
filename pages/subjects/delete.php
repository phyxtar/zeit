<?php
include '../../framwork/main.php';
$id = $_GET['id'];
echo delete('tbl_subjects', 'subject_id=' . $id . '');
