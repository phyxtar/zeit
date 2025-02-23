<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NETAJI SIBHAS UNIVERSITY | DOWNLOAD SLIP</title>
    <style>
        .salary-slip{
      margin: 15px;
      .empDetail {
        width: 100%;
        text-align: left;
        border: 2px solid black;
        border-collapse: collapse;
        table-layout: fixed;
      }

      .logo{
        margin-top: 8px;
      }
      
      .head {
        margin: 10px;
        margin-bottom: 50px;
        width: 100%;
      }
      .para{
        margin: 0%;
        color: #ffffff;
        text-align: center;
        font-weight: bold;
      }

      .para2{
        margin-top: 0%;
        color: #ffffff;
        text-align: center;
        font-weight: bold;
      }
      
      .companyName {
        margin: 0px;
        color: #ffffff;
        text-align: center;
        font-size: 25px;
        font-weight: bold;
      }
      
      .salaryMonth {
        text-align: center;
      }
      
      .table-border-bottom {
        border-bottom: 1px solid;
      }
      
      .table-border-right {
        border-right: 1px solid;
      }
      
      .myBackground {
        padding-top: 10px;
        text-align: left;
        border: 1px solid black;
        height: 40px;
      }
      
      .myAlign {
        text-align: center;
        border-right: 1px solid black;
      }
      
      .myTotalBackground {
        padding-top: 10px;
        text-align: left;
        background-color: #EBF1DE;
        border-spacing: 0px;
      }
      
      .align-4 {
        width: 25%;
        float: left;
      }
      
      .tail {
        margin-top: 35px;
      }
      
      .align-2 {
        margin-top: 25px;
        width: 50%;
        float: left;
      }
      
      .border-center {
        text-align: center;
      }
      .border-center th, .border-center td {
        border: 1px solid black;
      }
      
      th, td {
        padding-left: 6px;
      }
    }
    </style>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php
    if (isset($_GET['id'])) {
        include_once('include/config.php');
        $id = $_GET['id'];

        $sql = "SELECT * FROM tbl_staff WHERE id = $id";
        $result = $con->query($sql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            $name = "No record found";
        }

    } else {
        echo "No ID provided.";
    }
    ?>
    <div class="salary-slip">
        <table class="empDetail">
          <tr height="100px" style='background-color: #8a0410'>
            <td colspan='8'> 
                <center>
                <?php
                include_once('include/config.php');
                $sql = "SELECT * FROM `tbl_university_logo` WHERE `university_id` IN (1)";
                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                    $row3 = $result->fetch_assoc();
                } else {
                    $name = "No record found";
                }
                ?>
                <?php
                    if($row3['university_id'] == 1){
                        ?>
                        <img src="./uploads/university_logo/<?= $row3['university_logo'] ?>" style="height: 100px; width: 100px;">
                        <?php
                    }
                ?>
                </center>
                <h4 class="companyName">
                <?php
                if($row3['university_id'] == 1){
                    ?>
                    <?= $row3['university_heading'] ?>
                    <?php
                }
                ?>
                </h4>
                <p class="para">Address - Pokhari,Near Bhilai Pahadi,Jamshedpur,Jharkhand</p>
                <p class="para2">Phone no : 1800-889-9022</p>
            </td>
          </tr>
          <tr style='padding-top: 10px;
          height: 40px;'>
            <th colspan="3">
              Name: <?= $row['name'] ?>
            </th>
           
            <th colspan="3">
                Designation: <?php
              include_once('include/config.php');
              $desg_id = $row['desg_id'];

              $sql = "SELECT * FROM tbl_designation WHERE id = $desg_id";
              $result = $con->query($sql);
          
              if ($result->num_rows > 0) {
                  $row2 = $result->fetch_assoc();
                  echo $row2['designation'];
              } else {
                  $name = "No record found";
              }
              ?>
            </th>
            <th colspan="2">
                Date: <?php
              echo $currentDate = date('d, M, Y');
              ?>
            </th>
          </tr>
          <tr class="myBackground">
            <th colspan="2">
              Payments
            </th>
            <th>
              Particular
            </th>
            <th class="table-border-right">
              Amount (Rs.)
            </th>
            <th colspan="2">
              Deductions
            </th>
            <th>
              Particular
            </th>
            <th>
              Amount (Rs.)
            </th>
          </tr>
          <tr>
            <th colspan="2">
              Basic Salary
            </th>
            <td></td>
            <td class="myAlign">
                ₹<?= isset($row['basic_salary']) ? number_format((float)$row['basic_salary']) : '0.00' ?>
            </td>
            <th colspan="2">
                Employee PF Contribution
            </th>
            <td></td>
      
            <td class="myAlign">
              <?= !empty($row['pf_emp']) ? $row['pf_emp'] . '%' : '0%' ?>
            </td>
          </tr>
          <tr>
            <th colspan="2">
              Accomodation
            </th>
            <td></td>
      
            <td class="myAlign">
                ₹<?= isset($row['accomodation']) ? number_format((float)$row['accomodation']) : '0.00' ?>
            </td>
            <th colspan="2">
                Company PF Contribution
            </th>
            <td></td>
      
            <td class="myAlign">
              <?= !empty($row['pf_cmp']) ? $row['pf_cmp'] . '%' : '0%' ?>
            </td>
          </tr>
          <tr>
            <th colspan="2">
                House Rent Allowance
            </th>
            <td></td>
            <td class="myAlign">
                ₹<?= isset($row['hra']) ? number_format((float)$row['hra']) : '0.00' ?>
            </td>
            <th colspan="2">
                Employee ESIC Contribution 
            </th>
            <td></td>
            <td class="myAlign">
              <?= !empty($row['esic_emp']) ? $row['esic_emp'] . '%' : '0%' ?>
            </td>
          </tr>
          <tr>
            <th colspan="2">
                Mobile Allowance
            </th>
            <td></td>
            <td class="myAlign">
                ₹<?= isset($row['mobile_allowance']) ? number_format((float)$row['mobile_allowance']) : '0.00' ?>
            </td>
            <th colspan="2">
                Company ESIC Contribution
            </th>
            <td></td>
            <td class="myAlign">
            <?= !empty($row['esic_cmp']) ? $row['esic_cmp'] . '%' : '0%' ?>
            </td>
          </tr>
          <tr>
            <th colspan="2">
                Transportation Allowance
            </th>
            <td></td>
            <td class="myAlign">
                ₹<?= isset($row['transbortation_allowance']) ? number_format((float)$row['transbortation_allowance']) : '0.00' ?>
            </td>
          </tr>
          <tr>
            <th colspan="2">
                Medical Allowance
            </th>
            <td></td>
            <td class="myAlign">
                ₹<?= isset($row['medical_allownce']) ? number_format((float)$row['medical_allownce']) : '0.00' ?>
            </td>
          </tr>
          <tr>
            <th colspan="2">
                Fooding Allowance
            </th>
            <td></td>
            <td class="myAlign">
              ₹<?= isset($row['fooding_allowance']) ? number_format((float)$row['fooding_allowance']) : '0.00' ?>
            </td>
          </tr>
          <tr>
            <td colspan="4" class="table-border-right">
            </td>
          </tr>
          <tr>
            <td colspan="4" class="table-border-right"></td>
          </tr>
          <tr>
            <td colspan="4" class="table-border-right"></td>
            
          </tr>
          <tr class="myBackground">
            <th colspan="3">
              Gross Salary
            </th>
            <td class="myAlign">
              <?php
             $basic_salary = isset($row['basic_salary']) ? (float)$row['basic_salary'] : 0;
             $accomodation = isset($row['accomodation']) ? (float)$row['accomodation'] : 0;
             $hra = isset($row['hra']) ? (float)$row['hra'] : 0;
             $mobile_allowance = isset($row['mobile_allowance']) ? (float)$row['mobile_allowance'] : 0;
             $transbortation_allowance = isset($row['transbortation_allowance']) ? (float)$row['transbortation_allowance'] : 0;
             $medical_allownce = isset($row['medical_allownce']) ? (float)$row['medical_allownce'] : 0;
             $fooding_allowance = isset($row['fooding_allowance']) ? (float)$row['fooding_allowance'] : 0;
              
              $payment = $basic_salary + $accomodation + $hra + $mobile_allowance + $transbortation_allowance + $medical_allownce + $fooding_allowance;
              
              echo '₹'.number_format($payment);
              ?>
            </td>
            <th colspan="3">
              Total Deductions
            </th>
            <td class="myAlign">
              <?php
              $pf_emp = isset($row['pf_emp']) ? (float)$row['pf_emp'] : 0;
              $pf_cmp = isset($row['pf_cmp']) ? (float)$row['pf_cmp'] : 0;
              $esic_emp = isset($row['esic_emp']) ? (float)$row['esic_emp'] : 0;
              $esic_cmp = isset($row['esic_cmp']) ? (float)$row['esic_cmp'] : 0;
              $percent = $pf_emp + $pf_cmp + $esic_emp + $esic_cmp;

              if ($row['cut_from'] == 'basic_salary') {
                  $deduction = $basic_salary / 100 * $percent;
              } else {
                  $deduction = $payment / 100 * $percent;
              }

              echo '₹' . number_format($deduction, 2);
              ?>
          </td>
          </tr>
          <tr class="myBackground">
            <th colspan="8">
              <p style="font-weight: bold; text-align: center;">Net Payable</p>
            </th>
          </tr>
          <tr class="myBackground">
            <th colspan="8">
              <p style="font-weight: bold; text-align: center;">
              <?php
                $pay = $payment - $deduction;
                echo '₹'. number_format($pay);
              ?>
              </p>
            </th>
          </tr>
        </table>
      </div>

      <button id="downloadPdf" class="download"><i class="fa-solid fa-download fa-2xl" style="color:#ffffff;"></i></button>
      <style>
        .download{
          position: fixed;
          right: 40px;
          padding: 12px;
          border-radius: 50%;
          background-color: #8a0410;
        }
        .download:hover{
          cursor: pointer;
        }
      </style>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
      <script>
        document.getElementById('downloadPdf').addEventListener('click', function() {
            var element = document.body;
            var button = document.getElementById('downloadPdf');
            button.classList.add('hide-in-pdf');
            
            html2pdf().from(element).toPdf().get('pdf').then(function(pdf) {
                button.classList.remove('hide-in-pdf');
                pdf.save('payment slip.pdf');
            });
        });
    </script>
    
</body>
</html>