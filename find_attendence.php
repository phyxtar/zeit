<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $selected_month = $_POST['selected_month'];

    $attendance_data = getAttendanceData($selected_month);

    echo '<div class="d-flex justify-content-end mb-2">';
    echo '<button id="export_button" class="btn btn-warning"><i class="fa fa-download"></i> Export</button>';
    echo '</div>';

    echo '<table class="table" id="example1">';
    echo '  <thead>
                <tr>
                    <th scope="col">Employee Name</th>
                    <th scope="col">Month</th>
                    <th scope="col">Total Days</th>
                    <th scope="col">Working Days</th>
                    <th scope="col">Total Present</th>
                    <th scope="col">Total Absent</th>
                    <th scope="col">Added By</th>
                </tr>
            </thead>';
    echo '<tbody>';
    foreach ($attendance_data as $row) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['name']) . '</td>';
        echo '<td>' . htmlspecialchars($row['month']) . '</td>';
        echo '<td>' . htmlspecialchars($row['total_days']) . '</td>';
        echo '<td>' . htmlspecialchars($row['working_days']) . '</td>';
        echo '<td>' . htmlspecialchars($row['total_present']) . '</td>';
        echo '<td>' . htmlspecialchars($row['total_absent']) . '</td>';
        echo '<td>' . htmlspecialchars($row['added_by']) . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
}

function getAttendanceData($selected_month) {
  
    include_once('include/config.php');

    $sql = "SELECT t.staff_id, s.name, t.month, t.total_days, t.working_days, t.total_present, t.total_absent, t.added_by 
            FROM tbl_teacher_attendence t 
            JOIN tbl_staff s ON t.staff_id = s.id 
            WHERE t.month = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $selected_month);
    $stmt->execute();
    $result = $stmt->get_result();

    $attendance_data = $result->fetch_all(MYSQLI_ASSOC);

    $stmt->close();

    return $attendance_data;
}
?>

<script>
$(function () {
    $('#example1').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
    });

    document.getElementById('export_button').addEventListener('click', function() {
        var wb = XLSX.utils.table_to_book(document.getElementById('example1'), {sheet: "Attendance Data"});
        XLSX.writeFile(wb, 'Attendance_Data.xlsx');
    });
});
</script>
