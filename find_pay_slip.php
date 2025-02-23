<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $selected_month = $_POST['selected_month']; 

    $attendance_data = getAttendanceData();

    echo '<div class="d-flex justify-content-end mb-2">';
    echo '<button id="export_button" class="btn btn-warning"><i class="fa fa-download"></i> Export</button>';
    echo '</div>';

    echo '<table class="table table-responsive" style="width:100%;" id="example1">';
    echo '  <thead>
                <tr>
                    <th scope="col">Employee Name</th>
                    <th scope="col">Designation</th>
                    <th scope="col">Basic Salary</th>
                    <th scope="col">Fooding Allowance</th>
                    <th scope="col">House Rent Allowance</th>
                    <th scope="col">Mobile Allowance</th>
                    <th scope="col">Transportation Allowance</th>
                    <th scope="col">Medical Allowance</th>
                    <th scope="col">Accomodation</th>
                    <th scope="col">Employee PF Contribution</th>
                    <th scope="col">Company PF Contribution</th>
                    <th scope="col">Employee ESIC Contribution</th>
                    <th scope="col">Company ESIC Contribution</th>
                    <th scope="col">Total Salary</th>
                    <th scope="col">PF & ESIC Deduction</th>
                    <th scope="col">Net Salary</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>';
    echo '<tbody>';
    foreach ($attendance_data as $row) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['name']) . '</td>';
        echo '<td>' . htmlspecialchars($row['designation']) . '</td>'; 
        
        $value = isset($row['basic_salary']) && !empty($row['basic_salary']) ? htmlspecialchars($row['basic_salary']) : '0.00';
        echo '<td>₹' . number_format($value) . '</td>';

        $value = isset($row['fooding_allowance']) && !empty($row['fooding_allowance']) ? htmlspecialchars($row['fooding_allowance']) : '0.00';
        echo '<td>₹' . number_format($value) . '</td>';

        $value = isset($row['hra']) && !empty($row['hra']) ? htmlspecialchars($row['hra']) : '0.00';
        echo '<td>₹' . number_format($value) . '</td>';

        $value = isset($row['mobile_allowance']) && !empty($row['mobile_allowance']) ? htmlspecialchars($row['mobile_allowance']) : '0.00';
        echo '<td>₹' . number_format($value) . '</td>';
       
        $value = isset($row['transbortation_allowance']) && !empty($row['transbortation_allowance']) ? htmlspecialchars($row['transbortation_allowance']) : '0.00';
        echo '<td>₹' . number_format($value) . '</td>';

        $value = isset($row['medical_allownce']) && !empty($row['medical_allownce']) ? htmlspecialchars($row['medical_allownce']) : '0.00';
        echo '<td>₹' . number_format($value) . '</td>';

        $value = isset($row['accomodation']) && !empty($row['accomodation']) ? htmlspecialchars($row['accomodation']) : '0.00';
        echo '<td>₹' . number_format($value) . '</td>';

        $value = isset($row['pf_emp']) && !empty($row['pf_emp']) ? htmlspecialchars($row['pf_emp']) . '%' : '0.00';
        echo '<td>' . $value . '</td>';

        $value = isset($row['pf_cmp']) && !empty($row['pf_cmp']) ? htmlspecialchars($row['pf_cmp']) . '%' : '0.00';
        echo '<td>' . $value . '</td>';

        $value = isset($row['esic_emp']) && !empty($row['esic_emp']) ? htmlspecialchars($row['esic_emp']) . '%' : '0.00';
        echo '<td>' . $value . '</td>';

        $value = isset($row['esic_cmp']) && !empty($row['esic_cmp']) ? htmlspecialchars($row['esic_cmp']) . '%' : '0.00';
        echo '<td>' . $value . '</td>';

        $value = isset($row['total_salary']) && !empty($row['total_salary']) ? htmlspecialchars($row['total_salary']) : '0.00';
        echo '<td>₹' . number_format($value, 0) . '</td>';
        

        $difference = (isset($row['net_salary']) && isset($row['total_salary']) && !empty($row['net_salary']) && !empty($row['total_salary']))
            ? htmlspecialchars($row['total_salary'] - $row['net_salary'])
            : '0.00';
        echo '<td>₹' . number_format($difference, 0) . '</td>';


        $value = isset($row['net_salary']) && !empty($row['net_salary']) ? htmlspecialchars($row['net_salary']) : '0.00';
        echo '<td>₹' . number_format($value, 0) . '</td>';
        

        echo '<td><a href="download_pay_slip.php?id=' . $row['id'] . '" class="btn btn-primary"><i class="fa fa-download"></i></a></td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
}

function getAttendanceData() {
    global $con; 
    include_once('include/config.php'); 

    $sql = "SELECT ts.*, td.designation
            FROM tbl_staff ts 
            JOIN tbl_designation td ON ts.desg_id = td.id";

    $stmt = $con->prepare($sql);
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
        XLSX.writeFile(wb, 'Pay slips.xlsx');
    });
});
</script>
