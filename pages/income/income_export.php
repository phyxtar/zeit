<?php
include '../../framwork/main.php';
if (isset($_POST['export'])) {
    $start_date=date('d-m-Y', strtotime($_POST['fromDate']));
    $end_date=date('d-m-Y',strtotime($_POST['toDate']));
    $condition = "`transaction_date` BETWEEN '$start_date' AND '$end_date' ";
    // $condition =1 ;

    if (isset($_POST["export"])) {
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=all_income_data.xls');
?>
        <table class="table table-hover table-border ">
            <thead>
                <tr>
                    <?php thGen("all_income_view", 'false') ?>
                </tr>
            </thead>
            <tbody>
                <?php tdGen("all_income_view", '', '', '', $condition, 100000000);
                ?>
            </tbody>
        </table>
<?php
    }
}
?>