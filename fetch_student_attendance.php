<?php
$page_no = "2";
$page_no_inside = "";
include_once "framwork/main.php";
include_once "include/function.php";
include_once "include/config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Form</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <div class="attendance-container">
        <h4>Add Attendance</h4>

        <form method="POST" action="attendance_submit.php">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label><strong>Grade:</strong></label>
                    <input type="hidden" id="selectedGradeId" name="grade_id" />
                    <input type="text" class="form-control" id="gradeSearch" placeholder="Search grades..." />
                    <div id="searchResults" class="search-results"></div>
                </div>
                <div class="form-group col-md-6">
                    <label><strong>Attendance Date:</strong></label>
                    <input type="date" name="attendance_date" class="form-control" value="" required>
                </div>
            </div>
            <div class="buttons">
                <button type="button" id="present_all" class="btn green">Present All</button>
                <button type="button" id="absent_all" class="btn red">Absent All</button>
            </div>
            <table class="attendance-table">
                <thead>
                    <tr>
                        <th>Roll No.</th>
                        <th>Student Name</th>
                        <th>Present</th>
                        <th>Absent</th>
                    </tr>
                </thead>
                <tbody id="attendanceResults">
                    <script>
                        $(document).on('click', '.search-result-item', function() {
                            var selectedGrade = $(this).data('grade');
                            var selectedGradeId = $(this).data('grade-id');
                            $('#gradeSearch').val(selectedGrade);
                            $('#searchResults').empty();
                            $('#selectedGradeId').val(selectedGradeId);
                            
                            $.ajax({
                                url: 'get_student.php',
                                type: 'GET',
                                data: { grade_id: selectedGradeId },
                                success: function(response) {
                                    try {
                                        response = JSON.parse(response);
                                    } catch (e) {
                                        console.error('Invalid JSON response:', response);
                                        return;
                                    }

                                    if (Array.isArray(response) && response.length > 0) {
                                        $('#attendanceResults').empty();
                                        $.each(response, function(index, student) {
                                            $('#attendanceResults').append(`
                                                <tr>
                                                    <td>${student.student_roll_number}</td>
                                                    <td>${student.student_name}</td>
                                                    <td><input type="radio" name="attendance_status_${student.student_id}" value="Present"></td>
                                                    <td><input type="radio" name="attendance_status_${student.student_id}" value="Absent"></td>
                                                </tr>
                                            `);
                                        });
                                    } else {
                                        $('#attendanceResults').empty().append(`
                                            <tr>
                                                <td colspan="4">No attendance records found for this grade.</td>
                                            </tr>
                                        `);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    alert("An error occurred while fetching data.");
                                }
                            });
                        });
                    </script>
                </tbody>
            </table>
            <div class="form-actions">
                <button type="submit" class="btn submit">Add</button>
                <button type="button" class="btn close" onclick="window.close()">Close</button>
            </div>
        </form>
    </div>

    <script src="scripts.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .attendance-container {
            max-width: 800px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h4 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="radio"] {
            margin: 0 10px;
        }

        .buttons {
            text-align: center;
            margin-bottom: 20px;
        }

        .btn {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .green {
            background-color: #28a745;
            color: white;
        }

        .red {
            background-color: #dc3545;
            color: white;
        }

        .submit {
            background-color: #007bff;
            color: white;
            width: 100%;
        }

        .close {
            background-color: #6c757d;
            color: white;
            width: 100%;
            margin-top: 10px;
        }

        .attendance-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .attendance-table th,
        .attendance-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .attendance-table th {
            background-color: #f2f2f2;
        }

        .required {
            color: red;
        }
    </style>
    <script>
        document.getElementById('present_all').addEventListener('click', function () {
            const radios = document.querySelectorAll('input[type="radio"][value="Present"]');
            radios.forEach(radio => radio.checked = true);
        });

        document.getElementById('absent_all').addEventListener('click', function () {
            const radios = document.querySelectorAll('input[type="radio"][value="Absent"]');
            radios.forEach(radio => radio.checked = true);
        });
    </script>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
    $(document).ready(function(){
        $('#gradeSearch').on('keyup', function(){
            var searchQuery = $(this).val();
            if (searchQuery.length >= 2) { 
                $.ajax({
                    url: 'get_grades.php', 
                    type: 'GET',
                    data: { search: searchQuery },
                    success: function(response) {
                        $('#searchResults').html(response);
                    }
                });
            } else {
                $('#searchResults').empty();
            }
        });
        $(document).on('click', '.search-result-item', function() {
            var selectedGrade = $(this).data('grade');
            var selectedGradeId = $(this).data('grade-id'); 
            $('#gradeSearch').val(selectedGrade); 
            $('#searchResults').empty();
            console.log("Selected Grade ID: " + selectedGradeId);
            console.log("Selected Grade Name: " + selectedGrade);
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