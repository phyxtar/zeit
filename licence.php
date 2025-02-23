<?php 
    $page_no = "20";
    $page_no_inside = "";
    include_once "include/authentication.php"; 
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NETAJI SUBHAS UNIVERSITY | Licence Agreement</title>
    <!-- Fav Icon -->
    <link rel="icon" href="images/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- jsPDF Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <!-- jsPDF AutoTable plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.22/jspdf.plugin.autotable.min.js"></script>
    <!-- Custom CSS -->
    <style>
    .content {
        font-family: 'Source Sans Pro', sans-serif;
        /* font-size: 12px; */
    }

    .button-container {
        /* margin: 20px; */
        text-align: right;
    }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php include_once 'include/navbar.php'; ?>
        <?php include_once 'include/aside.php'; ?>

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>License Agreement</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">License Agreement</li>
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
                                <!-- <div class="button-container">
                                    <button onclick="downloadPDF()" class="btn btn-primary">Download as PDF</button>
                                </div> -->
                            </div>
                            <div class="card-body" id="content">
                                <pre>
License Number: <b>[INS-UMS-YNQ14T5C]</b>

Publisher:
<b>Company Name: Infinite Net Solutions
Address: 2nd Floor, Devdas Palace, Diagonal Rd, South Park, Bistupur, Jamshedpur, Jharkhand 831001
Contact No.: +91 - 098357 96743</b>
9852
Buyer:
<b>Name: Netaji Subhas University, Jamshedpur
Address: At: Pokhari, PO: Bhilai Pahari, PS: MGM, Dist:, Jamshedpur, Jharkhand 831012
Contact No.: 1800 889 9022</b>

Service:
<b>Vidyasra (University Management System)</b>

License Details:

<b>Issue Date: 2018-01-01
Last Expiration Date: 2023-01-01
Expiration Date: 2028-01-01
License Type: Annual 
License Scope</b>
<b>1.Permitted Use:</b>
  - Use of the University Management System (UMS) for managing administrative, academic, and student activities within the university.
<b>2.Number of Users:</b>
  - Usage permitted by up to 50 administrative users, 200 faculty members, and 500 students.
<b>3.Geographical Limitations:</b>
  - Valid for use within the campus locations of the university.
 <b>4.Duration:</b> 
  - Valid from the Issue Date to the Expiration Date.
<b>5.Access Rights:</b>
  - Access to modules including Student Information System, Course Management, Faculty Management, Attendance Tracking, Examination and Grading, Library Management, Financial Management, and Communication Module.
<b>6.Prohibited Uses:</b>
  - No commercial use outside of university management, creating derivative works, or sublicensing the software to third parties.

<b>Payment Terms: Net 30</b>


<b>License Terms and Conditions</b>

Grant of License:

<b>Infinite Net Solutions</b> grants the Buyer a non-exclusive, non-transferable license to use the Service specified in this agreement.
License Fees:

The Buyer agrees to pay the fees specified in the Payment Terms section. Fees are due according to the payment schedule.
Usage Restrictions:

The Buyer shall not reverse engineer, decompile, or disassemble the software or any part of the Service.
The Buyer shall not lease, rent, or sublicense the Service to any third party.
Term and Termination:

This License Agreement commences on the Issue Date and continues until the Expiration Date unless terminated earlier in accordance with these terms.
<b>Infinite Net Solutions</b> may terminate this agreement if the Buyer breaches any term of this agreement and fails to remedy the breach within 30 days of notice.
Support and Maintenance:

<b>Infinite Net Solutions</b> will provide support and maintenance services as outlined in the service level agreement (SLA) attached to this document.
Confidentiality:

Both parties agree to keep all terms of this agreement and any proprietary information confidential.
Liability:

<b>Infinite Net Solutions</b>’ liability under this agreement is limited to the amount paid by the Buyer for the license.
Governing Law:

This License Agreement shall be governed by and construed in accordance with the laws of Jharkhand/India.
Entire Agreement:

This License Agreement constitutes the entire agreement between the parties and supersedes all prior agreements or understandings.
Amendments:

Any amendments to this License Agreement must be in writing and signed by both parties.
Signatures:

Publisher:

Publisher Name
<b>Infinite Net Solutions</b>

Buyer:
<b>Netaji Subhas University</b>

Date: 2024-01-01

Contact Information for Support:

Email: support@infinitenetsolutions.com
Phone: +91-09835796743
Website: www.infinitenetsolutions.com

</pre>
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

        <?php include_once 'include/footer.php'; ?>

        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- jsPDF Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <!-- jsPDF AutoTable plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.22/jspdf.plugin.autotable.min.js"></script>
    <!-- page script -->
    <script>
    function downloadPDF() {
        const {
            jsPDF
        } = window.jspdf;
        const doc = new jsPDF();

        // Define styles
        const fontSize = 10;
        const margin = 10;

        // Get the content from the <pre> tag
        const content = document.querySelector("#content pre").innerText;

        // Split content into lines
        const lines = content.split('\n');

        // Add a title
        doc.setFontSize(16);
        doc.text('License Agreement', margin, margin);

        // Add content to PDF with styling
        doc.setFontSize(fontSize);
        lines.forEach((line, index) => {
            doc.text(line, margin, 20 + (index * 10)); // Adjust position based on index
        });

        // Save the PDF
        doc.save('License_Agreement.pdf');
    }
    </script>
</body>

</html>