<?php
include_once "../../include/config.php";
include_once "../../framwork/main.php";

if ($_GET["action"] == "income_year") {
    $all_year = $_POST['year'][0];
    $year = $all_year . '-04-01';
    $newYear = $all_year + 1 . '-03-31';
    $result = fetchResult('tbl_course', ' `status` = "' . $visible . '"');
    $s_no = 1;

?>

    <table class="table table-bordered table-striped table-responsive" style="overflow-x:auto;">
        <thead>
            <tr>

                <th width="10%"> Course Name</th>
                <th width="10%"> Fee</th>
                <th width="10%"> Paid</th>
                <th width="10%"> Due</th>

            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_assoc($result)) {

                    $paid_amount = get_sum('tbl_income', 'amount', ' course=' . $row['course_id'] . ' &&  `received_date` BETWEEN      "' . $year . '" AND  "' . $newYear . '" ');
                    $fee_amount = get_sum('tbl_fee', 'fee_amount', ' course_id=' . $row['course_id'] . ' && `fee_lastdate`  BETWEEN      "' . $year . '" AND  "' . $newYear . '"');
                    $prospectus_amount = get_sum('tbl_income', 'amount', ' course=' . $row['course_id'] . ' &&  `received_date` BETWEEN      "' . $year . '" AND  "' . $newYear . '" && `particulars` LIKE "%prospectus%"');
                    $exam_form = get_sum('tbl_income', 'amount', ' course=' . $row['course_id'] . ' &&  `received_date` BETWEEN      "' . $year . '" AND  "' . $newYear . '" && `particulars` LIKE "%Exam Form%"');
                    $fine = get_sum('tbl_income', 'amount', ' course=' . $row['course_id'] . ' &&  `received_date` BETWEEN      "' . $year . '" AND  "' . $newYear . '" && `particulars` LIKE "%Fine%"');

                    // getting the student count in a particular session

                    $student_year = fetchRow('tbl_fee', 'fee_amount', ' course_id=' . $row['course_id'] . ' && `fee_lastdate`  BETWEEN      "' . $year . '" AND  "' . $newYear . '"');


            ?>
                    <tr>
                        <td><?php echo $row["course_name"] ?></td>
                        <td><?= $total= round($fee_amount + $prospectus_amount + $exam_form + $fine) ?></td>
                        <td><?php echo round($paid_amount) ?></td>
                        <td><?php echo round($total-$paid_amount) ?></td>
                    </tr>
            <?php
                    $s_no++;
                }
            } else
                echo '
                            <div class="alert alert-warning alert-dismissible">
                                <i class="icon fas fa-exclamation-triangle"></i>  No data available now!!!
                            </div>';
            ?>
        </tbody>
    </table>

    <script>
        $(function() {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });
    </script>
<?php
    include_once "../../framwork/ajax/method.php";
}
?>

<!-- Button trigger modal -->
