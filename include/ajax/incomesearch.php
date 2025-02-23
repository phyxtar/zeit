<?php
include '../../framwork/main.php';
if (isset($_SESSION['limit']) && $_SESSION['limit'] > 0) {
    $limit = $_SESSION['limit'];
} else {
    $limit = 50;
}
if (isset($_GET["page"])) {
    $page  = $_GET["page"];
} else {
    $page = 1;
};
$start_from = ($page - 1) * $limit;
$s_no = $start_from + 1;
$condition = '1 LIMIT ' . $start_from . ',' . $limit;
searchWithPaginationAll("all_income_view", $limit, 'income','','','','',$condition);
