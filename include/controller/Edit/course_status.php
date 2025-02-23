<?php
include '../../../framwork/main.php';

$url = $_SERVER['HTTP_REFERER'];
$id = $_GET['id'];
$status = $_GET['status'];

if ($status == 1) {
    $data = array('online_status' => 0);
    updateAll('tbl_course', $data, '`course_id`=' . $id);
} else {
    $data = array('online_status' => 1);
    updateAll('tbl_course', $data , '`course_id`=' . $id);
}
?>
<script>
    window.location.replace('<?= $url ?>');
</script>