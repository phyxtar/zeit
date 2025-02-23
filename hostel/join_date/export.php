<?php
include "../../framwork/main.php";
if (isset($_GET["export"])) {
    header('Content-Type: application/xls');
    header('Content-Disposition: attachment; filename=hostel_join_date.xls');
?>
    <table class="table table-hover table-border ">
        <thead>
            <tr>
                <th>S No</th>
                <th> Year </th>
                <th>Date</th>
                <th>Created At </th>

            </tr>
        </thead>
        <tbody>
            <?php
            $s_no = 1;
            $result = fetchResult('hostel_join_date');
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?php echo $s_no; ?></td>
                        <td><?= $row['year'] ?></td>
                        <td><?= date('d-M-Y', strtotime($row['date'])) ?></td>
                        <td><?= $row['created_at'] ?></td>


                    </tr>
            <?php
                    $s_no++;
                }
            } ?>

        </tbody>
    </table>
<?php
}
?>