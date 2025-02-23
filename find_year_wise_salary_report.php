<?php
error_reporting(0);
include "include/config.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selected_year = $_POST['year'];
    $total_days = 0;
    $start_date = new DateTime("$selected_year-01-01");
    $end_date = new DateTime("$selected_year-12-31");
    while ($start_date <= $end_date) {
        if ($start_date->format('N') != 7) {
            $total_days++;
        }
        $start_date->modify('+1 day');
    }
    $holiday_days = getHolidayDays($selected_year);
    $attendance_data = getAttendanceData($selected_year);
    $total_employees = count($attendance_data);
    $total_present_days = 0; 
    $total_basic_salary = 0; 
    $total_food_allow = 0; 
    $total_house_allow = 0;
    $total_mobile_allow = 0;
    $total_transport_allow = 0;
    $total_medical_allow = 0;
    $total_accom = 0;
    $total_pf_employee = 0;
    $total_pf_company = 0;
    $total_esic_emp = 0;
    $total_esic_company = 0;

    foreach ($attendance_data as $row) {
        $basic_salary = isset($row['basic_salary']) && is_numeric($row['basic_salary']) ? (float)$row['basic_salary'] : 0;
        $total_basic_salary += $basic_salary;

        $food_allow = isset($row['fooding_allowance']) && is_numeric($row['fooding_allowance']) ? (float)$row['fooding_allowance'] : 0;
        $total_food_allow += $food_allow;

        $house_allow = isset($row['hra']) && is_numeric($row['hra']) ? (float)$row['hra'] : 0;
        $total_house_allow += $house_allow;

        $mobile_allow = isset($row['mobile_allowance']) && is_numeric($row['mobile_allowance']) ? (float)$row['mobile_allowance'] : 0;
        $total_mobile_allow += $mobile_allow;

        $transport_allow = isset($row['transbortation_allowance']) && is_numeric($row['transbortation_allowance']) ? (float)$row['transbortation_allowance'] : 0;
        $total_transport_allow += $transport_allow;

        $medical_allow = isset($row['medical_allownce']) && is_numeric($row['medical_allownce']) ? (float)$row['medical_allownce'] : 0;
        $total_medical_allow += $medical_allow;

        $accom = isset($row['accomodation']) && is_numeric($row['accomodation']) ? (float)$row['accomodation'] : 0;
        $total_accom += $accom;

        $pf_employee = isset($row['pf_emp']) && is_numeric($row['pf_emp']) ? (float)$row['pf_emp'] : 0;
        $total_pf_employee += $pf_employee;

        $pf_company = isset($row['pf_cmp']) && is_numeric($row['pf_cmp']) ? (float)$row['pf_cmp'] : 0;
        $total_pf_company += $pf_company;

        $esic_emp = isset($row['esic_emp']) && is_numeric($row['esic_emp']) ? (float)$row['esic_emp'] : 0;
        $total_esic_emp += $esic_emp;

        $esic_company = isset($row['esic_cmp']) && is_numeric($row['esic_cmp']) ? (float)$row['esic_cmp'] : 0;
        $total_esic_company += $esic_company;

        $total_present_days += $row['total_present'];
        
    }
    echo '<div class="d-flex justify-content-end mb-2">';
    echo '<button id="export_button" class="btn btn-warning"><i class="fa fa-download"></i> Export</button>';
    echo '</div>';
    echo '<table class="table table-responsive" style="width:100%;" id="example1">';
    echo '<thead>
            <tr>
                <th scope="col">Employee Name</th>
                <th scope="col">Designation</th>
                <th scope="col">Total Working Days</th>
                <th scope="col">Total Present</th>
                <th scope="col">Total Absent</th>
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
                <th scope="col">Net Salary</th>
            </tr>
          </thead>';
    echo '<tbody>';
    foreach ($attendance_data as $row) {
        $basic_salary = isset($row['basic_salary']) && is_numeric($row['basic_salary']) ? (float)$row['basic_salary'] : 0;
        $fooding_allowance = isset($row['fooding_allowance']) && is_numeric($row['fooding_allowance']) ? (float)$row['fooding_allowance'] : 0;
        $hra = isset($row['hra']) && is_numeric($row['hra']) ? (float)$row['hra'] : 0;
        $mobile_allowance = isset($row['mobile_allowance']) && is_numeric($row['mobile_allowance']) ? (float)$row['mobile_allowance'] : 0;
        $transportation_allowance = isset($row['transportation_allowance']) && is_numeric($row['transportation_allowance']) ? (float)$row['transportation_allowance'] : 0;
        $medical_allowance = isset($row['medical_allowance']) && is_numeric($row['medical_allowance']) ? (float)$row['medical_allowance'] : 0;
        $accommodation = isset($row['accommodation']) && is_numeric($row['accommodation']) ? (float)$row['accommodation'] : 0;
        $pf_emp = isset($row['pf_emp']) && is_numeric($row['pf_emp']) ? (float)$row['pf_emp'] : 0;
        $esic_emp = isset($row['esic_emp']) && is_numeric($row['esic_emp']) ? (float)$row['esic_emp'] : 0;
        $working_days = $total_days - $holiday_days;
        $per_day_salary = $working_days ? $basic_salary / $working_days : 0;
        $absence_deduction = $per_day_salary * ($row['total_absent'] ?? 0);
        $total_salary = $basic_salary + $fooding_allowance + $hra + $mobile_allowance + $transportation_allowance + $medical_allowance + $accommodation;
        $pf_esic_deduction = ($total_salary * $pf_emp / 100) + ($total_salary * $esic_emp / 100);
        $net_salary = $total_salary - $pf_esic_deduction - $absence_deduction;
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['name']) . '</td>';
        echo '<td>' . htmlspecialchars($row['designation']) . '</td>';
        echo '<td>' . $working_days . '</td>';
        echo '<td>' . htmlspecialchars($row['total_present']) . '</td>';
        echo '<td>' . htmlspecialchars($row['total_absent']) . '</td>';
        $yearly_salary = $basic_salary * 12;
        $daily_salary = $yearly_salary / $working_days;
        $salary =  $daily_salary * $working_days;
        echo '<td>₹' . number_format($salary) . '</td>';
        $food = $fooding_allowance * 12;
        echo '<td>₹' . number_format($food) . '</td>';
        $house = $hra * 12;
        echo '<td>₹' . number_format($house) . '</td>';
        $mobile = $mobile_allowance * 12;
        echo '<td>₹' . number_format( $mobile) . '</td>';
        $transport = $transportation_allowance * 12;
        echo '<td>₹' . number_format($transport) . '</td>';
        $medical = $medical_allowance * 12;
        echo '<td>₹' . number_format($medical) . '</td>';
        $accom = $accommodation * 12;
        echo '<td>₹' . number_format( $accom) . '</td>';
        echo '<td>' . htmlspecialchars($pf_emp) . '%</td>';
        echo '<td>' . (!empty($row['pf_cmp']) ? htmlspecialchars($row['pf_cmp']) : '0') . '%</td>';
        echo '<td>' . htmlspecialchars($esic_emp) . '%</td>';
        echo '<td>' . (!empty($row['esic_cmp']) ? htmlspecialchars($row['esic_cmp']) : '0') . '%</td>';
        $salary =  $salary + $food + $house + $mobile + $transport + $medical + $accom;
        echo '<td>₹' . number_format($salary, 0) . '</td>';
        $deduction = (float)$pf_emp + (float)$row['pf_cmp'] + (float)$esic_emp + (float)$row['esic_cmp'];
        echo '<td>' . number_format($deduction, 0) . '%</td>';
        $net = $salary * ($deduction / 100);
        $final_salary = $salary -  $net;
        echo '<td>₹' . number_format($final_salary, 0) . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';

    echo '<div class="row mb-5 mt-3">';
    echo '<div class="col-2">';
    echo '<button class="btn btn-primary btn-sm px-3 mb-3"><b>Total Employee: ' . $total_employees . '</b></button>';
    echo '</div>';
    echo '<div class="col-2">';
    $result = $total_employees*$working_days;
    echo '<button class="btn btn-secondary text-light btn-sm px-3 mb-3"><b>Working Days: '.$result.'<b></button>';
    echo '</div>';
    echo '<div class="col-2">';
    echo '<button class="btn btn-warning btn-sm px-3 mb-3"><b>Total Present: '. $total_present_days . '</b></button>';
    echo '</div>';
    echo '<div class="col-2">';
    $t_b_salary = $total_basic_salary * 12;
    echo '<button class="btn btn-danger btn-sm px-3 mb-3"><b>Basic Salary: ₹' . number_format($t_b_salary, 0) . '</b></button>';
    echo '</div>';

    echo '<div class="col-2">';
    $t_f_a = $total_food_allow * 12;
    echo '<button class="btn btn-dark btn-sm px-3 mb-3"><b>Food Allowance: ₹ '.number_format($t_f_a, 0).'</b></button>';
    echo '</div>';

    echo '<div class="col-2">';
    $t_hra = $total_house_allow * 12;
    echo '<button class="btn btn-success btn-sm px-3 mb-3"><b>H R Allowance: ₹ '.number_format($t_hra, 0).'</b></button>';
    echo '</div>';

    echo '<div class="col-2">';
    $t_m_a = $total_mobile_allow * 12;
    echo '<button class="btn btn-warning btn-sm px-3 mb-3"><b>Mobile Allowance: ₹ '.number_format($t_m_a, 0).'</b></button>';
    echo '</div>';

    echo '<div class="col-2">';
    $t_t_a = $total_transport_allow * 12;
    echo '<button class="btn btn-danger btn-sm px-3 mb-3"><b>Trans. Allowance: ₹ '.number_format($t_t_a, 0).'</b></button>';
    echo '</div>';

    echo '<div class="col-2">';
    $t_m_a = $total_medical_allow * 12;
    echo '<button class="btn btn-success btn-sm px-3 mb-3"><b>Medical Allowance: ₹ '.number_format($t_m_a, 0).'</b></button>';
    echo '</div>';

    echo '<div class="col-2">';
    $t_accomodation = $total_accom * 12;
    echo '<button class="btn btn-secondary btn-sm px-3 mb-3"><b>Accommodation: ₹'.number_format($t_accomodation, 0).'</b></button>';
    echo '</div>';

    echo '<div class="col-2">';
    $final_total_salary = $t_b_salary +  $t_f_a + $t_hra + $t_m_a +  $t_t_a +  $t_m_a +  $t_accomodation;
    echo '<button class="btn btn-primary btn-sm px-3 mb-3"><b>Total Salary: ₹ '.number_format($final_total_salary, 0).'</b></button>';
    echo '</div>';

    echo '<div class="col-2">';
    echo '<button class="btn btn-warning btn-sm px-3 mb-3"><b>PF Emp. Deduction: '.htmlspecialchars($total_pf_employee).'%</b></button>';
    echo '</div>';

    echo '<div class="col-2">';
    echo '<button class="btn btn-danger btn-sm px-3 mb-3"><b>PF Com. Deduction: '.htmlspecialchars($total_pf_company).'%</b></button>';
    echo '</div>';

    echo '<div class="col-2">';
    echo '<button class="btn btn-success btn-sm px-3 mb-3"><b>ESIC Emp. Deduction: '.htmlspecialchars($total_esic_emp).'%</b></button>';
    echo '</div>';

    echo '<div class="col-2">';
    echo '<button class="btn btn-primary btn-sm px-3 mb-3"><b>ESIC Emp. Deduction: '.htmlspecialchars($total_esic_company).'%</b></button>';
    echo '</div>';

    echo '<div class="col-2">';
    $deduction = $total_pf_employee + $total_pf_company + $total_esic_emp + $total_esic_company;
    $sal = $final_total_salary / 100 * $deduction;
    $net_pay  = $final_total_salary - $sal ;
    echo '<button class="btn btn-dark btn-sm px-3 mb-3"><b>Net Salary: ₹ '.number_format($net_pay, 0).'</b></button>';
    echo '</div>';

    echo '</div>';
}
function getAttendanceData($selected_year)
{
    global $con;

    $sql = "SELECT ts.name, td.designation,
                   SUM(IFNULL(tta.total_present, 0)) AS total_present,
                   SUM(IFNULL(tta.total_absent, 0)) AS total_absent,
                   ts.basic_salary, ts.fooding_allowance, ts.hra, ts.mobile_allowance,
                   ts.transbortation_allowance, ts.medical_allownce, ts.accomodation,
                   ts.pf_emp, ts.esic_emp, ts.pf_cmp, ts.esic_cmp
            FROM tbl_staff ts 
            JOIN tbl_designation td ON ts.desg_id = td.id
            LEFT JOIN tbl_teacher_attendence tta ON ts.id = tta.staff_id 
                AND YEAR(tta.added_date) = ? 
            WHERE YEAR(ts.created_at) = ?  
            GROUP BY ts.id";

    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param("ss", $selected_year, $selected_year); 
        $stmt->execute();
        $result = $stmt->get_result();
        $attendance_data = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $attendance_data;
    } else {
        die("Failed to prepare statement: " . $con->error);
    }
}

function getHolidayDays($selected_year)
{
    global $con;
    $sql = "SELECT h_date_from, h_date_to 
            FROM tbl_holiday 
            WHERE YEAR(h_date_from) = ? OR YEAR(h_date_to) = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $selected_year, $selected_year);
    $stmt->execute();
    $result = $stmt->get_result();
    $holiday_days = 0;
    while ($row = $result->fetch_assoc()) {
        $h_date_from = new DateTime($row['h_date_from']);
        $h_date_to = new DateTime($row['h_date_to']);

        if ($h_date_from->format('Y') == $selected_year || $h_date_to->format('Y') == $selected_year) {
            $interval = $h_date_from->diff($h_date_to);
            $holiday_days += $interval->days + 1;
        }
    }
    $stmt->close();
    return $holiday_days;
}
?>
<script>
    $(function() {
        $('#example1').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
        });

        document.getElementById('export_button').addEventListener('click', function() {
            var wb = XLSX.utils.table_to_book(document.getElementById('example1'), {
                sheet: "Attendance Data"
            });
            XLSX.writeFile(wb, 'Pay_slips.xlsx');
        });
    });
</script>