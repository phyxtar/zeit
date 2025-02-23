<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $selected_month = $_POST['selected_month']; 
    $attendance_data = getAttendanceData($selected_month);

    echo '<div class="d-flex justify-content-end mb-2">';
    echo '<button id="export_button" class="btn btn-warning"><i class="fa fa-download"></i> Export</button>';
    echo '</div>';

    echo '<table class="table table-responsive" style="width:100%;" id="example1">';
    echo '<thead>
            <tr>
                <th scope="col">Employee Name</th>
                <th scope="col">Designation</th>
                <th scope="col">Total Working Days</th>
                <th scope="col">Total Absent</th>
                <th scope="col">Total Present</th>
                <th scope="col">Basic Salary</th>
                <th scope="col">Fooding Allowance</th>
                <th scope="col">House Rent Allowance</th>
                <th scope="col">Mobile Allowance</th>
                <th scope="col">Transportation Allowance</th>
                <th scope="col">Medical Allowance</th>
                <th scope="col">Accommodation</th>
                <th scope="col">Employee PF Contribution</th>
                <th scope="col">Company PF Contribution</th>
                <th scope="col">Employee ESIC Contribution</th>
                <th scope="col">Company ESIC Contribution</th>
                <th scope="col">Total Salary</th>
                <th scope="col">PF & ESIC Deduction</th>
                <th scope="col">Absence Deduction</th>
                <th scope="col">Net Salary</th>
                <th scope="col">Action</th>
            </tr>
          </thead>';
    echo '<tbody>';
    
    foreach ($attendance_data as $row) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['name']) . '</td>';
        echo '<td>' . htmlspecialchars($row['designation']) . '</td>'; 
    
        // Attendance Details
        echo '<td>' . htmlspecialchars($row['working_days']) . '</td>';
        echo '<td>' . htmlspecialchars($row['total_absent']) . '</td>';
        echo '<td>' . htmlspecialchars($row['total_present']) . '</td>';
    
        // Salary Details
        $basic_salary = isset($row['basic_salary']) && is_numeric($row['basic_salary']) ? $row['basic_salary'] : 0;
        echo '<td>₹' . number_format($basic_salary) . '</td>';
    
        $value = isset($row['fooding_allowance']) && is_numeric($row['fooding_allowance']) ? $row['fooding_allowance'] : 0;
        echo '<td>₹' . number_format($value) . '</td>';
    
        $value = isset($row['hra']) && is_numeric($row['hra']) ? $row['hra'] : 0;
        echo '<td>₹' . number_format($value) . '</td>';
    
        $value = isset($row['mobile_allowance']) && is_numeric($row['mobile_allowance']) ? $row['mobile_allowance'] : 0;
        echo '<td>₹' . number_format($value) . '</td>';
       
        $value = isset($row['transbortation_allowance']) && !empty($row['transbortation_allowance']) ? htmlspecialchars($row['transbortation_allowance']) : '0.00';
        echo '<td>₹' . number_format($value) . '</td>';

        $value = isset($row['medical_allownce']) && !empty($row['medical_allownce']) ? htmlspecialchars($row['medical_allownce']) : '0.00';
        echo '<td>₹' . number_format($value) . '</td>';
    
        $value = isset($row['accomodation']) && !empty($row['accomodation']) ? htmlspecialchars($row['accomodation']) : '0.00';
        echo '<td>₹' . number_format($value) . '</td>';
    
        $value = isset($row['pf_emp']) && is_numeric($row['pf_emp']) ? $row['pf_emp'] : 0;
        echo '<td>' . htmlspecialchars($value) . '%</td>';
    
        $value = isset($row['pf_cmp']) && is_numeric($row['pf_cmp']) ? $row['pf_cmp'] : 0;
        echo '<td>' . htmlspecialchars($value) . '%</td>';
    
        $value = isset($row['esic_emp']) && is_numeric($row['esic_emp']) ? $row['esic_emp'] : 0;
        echo '<td>' . htmlspecialchars($value) . '%</td>';
    
        $value = isset($row['esic_cmp']) && is_numeric($row['esic_cmp']) ? $row['esic_cmp'] : 0;
        echo '<td>' . htmlspecialchars($value) . '%</td>';
    
        $total_salary = isset($row['total_salary']) && is_numeric($row['total_salary']) ? $row['total_salary'] : 0;
        $net_salary = isset($row['net_salary']) && is_numeric($row['net_salary']) ? $row['net_salary'] : 0;

        echo '<td>₹' . number_format($total_salary, 0) . '</td>';

        $pf_esic_deduction = $total_salary - $net_salary;
        echo '<td>₹' . number_format($pf_esic_deduction, 0) . '</td>';

        $working_days = isset($row['working_days']) && $row['working_days'] != 0 ? $row['working_days'] : 1;
        $per_day_salary = $basic_salary / $working_days;
        $absence_deduction = $per_day_salary * $row['total_absent'];
        echo '<td>₹' . number_format($absence_deduction, 2) . '</td>';

        $net_salary_after_deduction = $net_salary - $absence_deduction;
        echo '<td>₹' . number_format($net_salary_after_deduction, 0) . '</td>';
    
        echo '<td><button type="button" href="" data-id="' . $row['id'] . '" class="status-btn btn ' . ($row['salary_status'] === 'Paid' ? 'btn-success' : 'btn-warning') . '">'
        . $row["salary_status"] . '</button></td>';
   
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
}

function getAttendanceData($selected_month) {
    global $con; 
    include_once('include/config.php'); 

    $sql = "SELECT ts.*, td.designation, 
                   IFNULL(tta.working_days, 0) AS working_days,
                   IFNULL(tta.total_absent, 0) AS total_absent,
                   IFNULL(tta.total_present, 0) AS total_present
            FROM tbl_staff ts 
            JOIN tbl_designation td ON ts.desg_id = td.id
            LEFT JOIN tbl_teacher_attendence tta ON ts.id = tta.staff_id AND tta.month = ?";
    
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

    $('#example1').on('click', '.status-btn', function() {
    var button = $(this);
    var id = button.data('id');
    $.ajax({
        url: 'salary_report_btn.php',
        type: 'POST',
        data: {
            id: id
        },
        dataType: 'json',
        success: function(response) {
            if (response.new_status) {
                button.text(response.new_status);
                button.removeClass('btn-success btn-warning').addClass(response.new_class);
                var row = table.row(button.parents('tr'));
                var cellIndex = table.cell(button.parents('td')).index().column;
                table.cell(row, cellIndex).data(response.new_status).draw(false);
                window.location.reload();
            } else {
                alert(response.error);
            }
        }
    });
});


    document.getElementById('export_button').addEventListener('click', function() {
        var wb = XLSX.utils.table_to_book(document.getElementById('example1'), {sheet: "Attendance Data"});
        XLSX.writeFile(wb, 'Pay slips.xlsx');
    });
});
</script>
