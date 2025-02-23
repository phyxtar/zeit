<?php
$page_no = "16";
$page_no_inside = "16_11";
include_once "include/authentication.php";
include_once "include/head.php";
?>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php include_once 'include/navbar.php'; ?>
        <?php include_once 'include/aside.php'; ?>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Year Wise Salary Report</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Year Wise Salary Report</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Year Wise Salary Report</h3>
                        </div>
                        <form id="salary_form" role="form" method="POST" action="find_year_wise_salary_report.php">
                            <div class="card-body" style="margin-top: 0px;">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Employee</label>
                                            <input type="text" id="teacher_name" name="" class="form-control" value="All" readonly>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Year</label>
                                            <select id="year" class="form-control" name="year" required></select>
                                            <script>
                                            const yearSelect = document.getElementById('year');
                                            const currentYear = new Date().getFullYear();
                                            const startYear = 2018;
                                            const endYear = currentYear;

                                            for (let year = startYear; year <= endYear; year++) {
                                                const option = document.createElement('option');
                                                option.value = year;
                                                option.textContent = year;
                                                yearSelect.appendChild(option);
                                            }
                                            </script>
                                        </div>
                                    </div>
                                    <div class="col-1" style="margin-top: 29px;">
                                        <button type="submit" class="btn btn-primary">Go</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div id="results" class="px-4"></div>
                        <script>
                            $(document).ready(function() {
                                $('#salary_form').on('submit', function(event) {
                                    event.preventDefault();
                                    $.ajax({
                                        url: $(this).attr('action'),
                                        method: $(this).attr('method'),
                                        data: $(this).serialize(),
                                        success: function(data) {
                                            $('#results').html(data);
                                        }
                                    });
                                });
                            });
                        </script>

                    </div>
                </div>
        </div>
        </section>
    </div>
    <?php
    include_once 'include/foot.php';
    include_once 'framwork/ajax/method.php'
    ?>
</body>

</html>