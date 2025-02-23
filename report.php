<?php
$page_no = "18";
$page_no_inside = "18_5";
include_once "framwork/main.php";
include_once "include/function.php";
include_once "include/config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NETAJI SUBHAS UNIVERSITY | Datewise Attendance Report</title>
    <!-- Fav Icon -->
    <link rel="icon" href="images/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- Include jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Include DataTables JS -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

    <!-- DataTables Buttons Extension JS -->
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include_once 'include/navbar.php'; ?>
        <?php include_once 'include/aside.php'; ?>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Datewise Attendance Report</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Datewise Attendance Report</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label><strong>Grade:</strong></label>
                                        <input type="hidden" id="selectedGradeId" name="grade_id" />
                                        <input type="text" class="form-control" id="gradeSearch"
                                            placeholder="Search grades..." />
                                        <div id="searchResults" class="search-results"></div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label><strong>From Date:</strong></label>
                                        <input type="date" class="form-control" id="from_date">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label><strong>To Date:</strong></label>
                                        <input type="date" class="form-control" id="to_date">
                                    </div>
                                </div>

                                <div class="form-group text-center">
                                    <button type="button" class="btn btn-primary" id="go_button">Go</button>
                                </div>

                                <!-- Loader -->
                                <div id="loader" style="display: none;" class="text-center">
                                    <i class="fa fa-spinner fa-spin fa-3x fa-fw" style="color:#28a745"></i>
                                    <p>Processing your request, please wait...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <?php include_once 'include/footer.php'; ?>
    </div>

    <script>
    $(document).ready(function() {
        // Handle grade search
        $('#gradeSearch').on('keyup', function() {
            var searchQuery = $(this).val();
            if (searchQuery.length >= 2) {
                $.ajax({
                    url: 'get_grades.php',
                    type: 'GET',
                    data: {
                        search: searchQuery
                    },
                    success: function(response) {
                        $('#searchResults').html(response);
                    }
                });
            } else {
                $('#searchResults').empty();
            }
        });

        // Select grade from search results
        $(document).on('click', '.search-result-item', function() {
            var selectedGrade = $(this).data('grade');
            var selectedGradeId = $(this).data('grade-id');
            $('#gradeSearch').val(selectedGrade);
            $('#searchResults').empty();
            $('#selectedGradeId').val(selectedGradeId);
        });

        // Handle export functionality on button click
        $('#go_button').on('click', function() {
            const fromDate = $('#from_date').val();
            const toDate = $('#to_date').val();
            const gradeId = $('#selectedGradeId').val(); // Get grade ID

            if (fromDate && toDate && gradeId) {
                $('#loader').show(); // Show loader

                // Create a form dynamically to post data to export_attendance.php
                const form = $('<form>', {
                    action: 'export_attendance.php',
                    method: 'POST',
                    style: 'display: none;'
                }).append(
                    $('<input>', {
                        type: 'hidden',
                        name: 'from_date',
                        value: fromDate
                    }),
                    $('<input>', {
                        type: 'hidden',
                        name: 'to_date',
                        value: toDate
                    }),
                    $('<input>', {
                        type: 'hidden',
                        name: 'grade_id',
                        value: gradeId
                    })
                );

                // Append form to body and submit
                $('body').append(form);
                form.submit();

                // Set a short delay to hide the loader after submission
                setTimeout(() => {
                    $('#loader').hide();
                }, 3000); // Adjust the time if necessary
            } else {
                alert('Please select From Date, To Date, and ensure Grade ID is valid.');
            }
        });
    });
    </script>

    <style>
    .search-results {
        border: 1px solid #ccc;
        max-height: 200px;
        overflow-y: auto;
        margin-top: 5px;
    }

    .search-result-item {
        padding: 8px;
        cursor: pointer;
    }

    .search-result-item:hover {
        background-color: #f0f0f0;
    }
    </style>
</body>

</html>