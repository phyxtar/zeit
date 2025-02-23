<?php
$page_no = "8";
$page_no_inside = "8_2";
include_once './framwork/main.php';
$sno = 1;
$condition1 = 1;
if (isset($_GET['limit']) && $_GET['limit'] > 0) {
    $_SESSION['limit'] = $_GET['limit'];
}
if (isset($_SESSION['limit']) && $_SESSION['limit'] > 0) {
    $limit = $_SESSION['limit'];
} else {
    $limit = 50;
}
if (isset($_GET["page"])) {
    $page  = $_GET["page"];
} else {
    $page = 1;
    unset($_SESSION['condition']);
};
$start_from = ($page - 1) * $limit;
$s_no = $start_from + 1;
$condition = '1 LIMIT ' . $start_from . ',' . $limit;
if (isset($_SESSION['condition'])) {
    if ($_SESSION['condition'] != '') {
        $condition = $_SESSION['condition'] . '  LIMIT ' . $start_from . ',' . $limit;
        $condition1 = $_SESSION['condition'];
    } else {
        $condition = '1 LIMIT ' . $start_from . ',' . $limit;
    }
}
include_once 'include/head.php';
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Income</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Income</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <div class="float-sm-right">
                            <!-- <button type="button" class="btn btn-success" onclick="document.getElementById('add_expenses').style.display='block'">Add Expenses</button>-->
                        </div>
                        <form method="post" action="pages/income/income_export.php">
                            <div class="input-daterange">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-2">
                                            From<input type="date" name="fromDate" class="form-control form-control-sm" value="<?php echo date("Y-m-d"); ?>" />
                                        </div>
                                        <div class="col-2">
                                            To<input type="date" name="toDate" class="form-control form-control-sm" value="<?php echo date("Y-m-d"); ?>" />
                                        </div>
                                        <div class="col-2">
                                            <div>&nbsp;</div>
                                            <button type="submit" name="export" class="btn btn-info btn-sm"> Export to CSV </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="row">
                            <div class="col-sm-9">
                                show
                                <select class="form=-control mt-4" onchange="page_size(this.value)" id="">

                                    <option value="<?= $limit ?>"><?= $limit ?></option>
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="500">500</option>
                                </select>
                                entires
                            </div>
                            <div class="col-sm-3">
                                Search: <input type="text" onkeyup="search(this.value)" class=" form-control form-control-sm">
                            </div>
                        </div>
                        <div id="search_data" class="card-body">

                            <table id="dtHorizontalExample" class="table table-bordered table-striped table-responsive">
                                <thead>
                                    <?= thGen('all_income_view') ?>
                                </thead>
                                <tbody>
                                    <?= tdGen('all_income_view', '', '', '', $condition, $limit) ?>
                                </tbody>

                            </table>
                            <?php paginate('all_income_view', $limit, 'income', $condition1) ?>

                        </div>

                        <!-- /.card-header -->
                        <div class="card-body" id="data_table">

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

<!-- page script -->
<style>
    .dtHorizontalExampleWrapper {
        max-width: 600px;
        margin: 0 auto;
    }

    #dtHorizontalExample th,
    td {
        white-space: nowrap;
    }

    .dataTables_paginate {
        display: none;
    }

    #dtHorizontalExample_filter {
        display: none;
    }

    .datepicker {
        display: none !important;
    }
    th{
        text-transform: capitalize;
    }
</style>

<?php include_once 'include/foot.php'; ?>

<script>
    function search(data) {
        if (data.length == '') {
            window.location.href
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                document.getElementById("search_data").innerHTML = this.responseText;
            };
            xmlhttp.open("GET", "./include/ajax/incomesearch.php?q=" + data, true);
            xmlhttp.send();
        }
    }

    function page_size(data) {
        console.log(data);

        window.location.replace(window.location.pathname + '?limit=' + data);

    }
</script>