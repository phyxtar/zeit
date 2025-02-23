<?php
if ($_GET["action"] == "fetch_student_allreport") {
    $course_id = $_POST["course_id"];
    $academic_year = $_POST["academic_year"];
    if ($academic_year != 0) {
?>
        <table id="dtHorizontalExample" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="10%">S.No</th>
                    <th width="10%">Reg. No</th>
                    <!--<th  width="10%">Adm. No</th>-->
                    <th width="10%">Student Name</th>
                    <th width="10%">Course</th>
                    <!--<th width="10%">Semester</th>
                    <th width="10%">Contact</th>
                    <th width="10%">Marks</th>  
                    <th width="10%">Result</th>
                     <th width="10%">Promote</th>                           
                    <th width="10%">Percentage(%)</th>-->
                    <th class="project-actions text-center">Action </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT DISTINCT(reg_no),course_id,academic_year,admission_id FROM `tbl_allot_semester`                                
                             WHERE `status` = '$visible' && `academic_year` = '$academic_year' && `course_id` = '$course_id'";
                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <tr>
                            <td><?php echo $s_no; ?></td>

                            <td><?php echo $row["reg_no"] ?></td>

                            <?php
                            $sql_id = "SELECT * FROM `tbl_admission`
                                                   WHERE `status` = '$visible' && `admission_id` = '" . $row["admission_id"] . "';
                                                   ";
                            $result_id = $con->query($sql_id);
                            $row_id = $result_id->fetch_assoc();
                            ?>
                            <td><?= $row_id["admission_first_name"] . " " . $row_id["admission_middle_name"] . $row_id["admission_last_name"] ?></td>
                            <?php
                            $sql_course = "SELECT * FROM `tbl_course`
                                                   WHERE `status` = '$visible' && `course_id` = '" . $row["course_id"] . "';
                                                   ";
                            $result_course = $con->query($sql_course);
                            $row_course = $result_course->fetch_assoc();
                            ?>
                            <td><?php echo $row_course["course_name"]; ?></td>
                            <?php
                            /*    $sql_semester = "SELECT * FROM `tbl_semester`
                                                   WHERE `status` = '$visible' && `semester_id` = '".$row["semester_id"]."';
                                                   ";
                                    $result_semester = $con->query($sql_semester);
                                    $row_semester = $result_semester->fetch_assoc();*/
                            ?>
                            <!-- <td><?php echo $row_semester["semester"]; ?></td>    -->
                            <!--<td><?php echo $row["admission_mobile_student"]; ?></td>   -->
                            <!--<td>
                                    <table>
                                        <thead>
                                            <tr>
                                            <th width="10%">Subject Name</th>
                                            <th  width="10%">Full Marks</th>
                                            <th  width="10%">Pass Marks</th>
                                            <th width="10%">Internal Marks</th>
                                            <th width="10%">External Marks</th>
                                            <th width="10%">Total Marks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $sql_get = "SELECT * FROM `tbl_marks` 
                                                        INNER JOIN `tbl_subjects` ON `tbl_marks`.`subject_id` = `tbl_subjects`.`subject_id`
                                                        WHERE `tbl_marks`.`semester_id` = '" . $row["semester_id"] . "' && `tbl_marks`.`course_id` = '" . $row["course_id"] . "' && `tbl_marks`.`fee_academic_year` = '" . $row["university_details_id"] . "' &&  `tbl_marks`.`reg_no` = '" . $row["reg_no"] . "' 
                                                        ORDER BY `tbl_subjects`.`subject_id` ASC";
                                        $row_get = $con->query($sql_get);
                                        $sum = 0;
                                        $sum1 = 0;
                                        $sum2 = 0;
                                        $divnum = 0;
                                        $passmarks_total = 0;
                                        while ($rows = $row_get->fetch_assoc()) {
                                            $sum += $rows["internal_marks"];
                                            $sum1 += $rows["external_marks"];
                                            $sum2 += $rows["internal_marks"] + $rows["external_marks"];
                                            $passmarks_total = $passmarks_total + $rows["pass_marks"];
                                        ?>
                                            <tr>
                                            <td width="10%"><?php echo $rows["subject_name"] ?></td>
                                            <td  width="10%"><?php echo $rows["full_marks"] ?></td>
                                            <td width="10%"><?php echo $rows["pass_marks"] ?></td>
                                            <td width="10%"><?php echo $rows["internal_marks"] ?></td>
                                            <td width="10%"><?php echo $rows["external_marks"] ?></td>
                                            <?php $sum_total =  $rows["internal_marks"] + $rows["external_marks"]; ?>
                                            <td width="10%"><?php echo $sum_total; ?></td>  
                                            </tr>
                                            <?php } ?>  
                                            <tr>
                                            <td></td>
                                            <td></td>
                                            <td>Total</td>
                                            <td><?php echo $sum; ?></td>
                                            <td><?php echo $sum1; ?></td>
                                            <td><?php echo $sum2; ?></td>
                                            </tr>
                                                            
                                        </tbody>
                                    </table>
                                    </td>-->
                            <!--<td><?php
                                    if ($sum2 >= $passmarks_total) {
                                        $resultVar = "PASS";
                                        echo "<b style='color: #28a745!important;'>Pass</b>";
                                    } else {
                                        echo "<b style='color: #b42a16!important;'>Fail</b>";
                                        $resultVar = "FAIL";
                                    }
                                    ?></td>
                                      
                                     <td>
                                     <?php if ($sum2 <= $passmarks_total) { ?>
                                     <form action=""><a href="tbl?id=<?php echo $row["reg_no"] ?>">Click to Promote</a>
                                     <?php  } ?>
                                      </td>
                                    <td><?php $divnum = ($sum2) / 5;
                                        echo $divnum ?> % </td> -->
                            <td>
                                <form action=""><a href="full_marksheet?id=<?php echo $row["reg_no"] ?>&course=<?php echo $row["course_id"]; ?>&session=<?php echo $row["academic_year"]; ?>">Generate Marksheet Report</a>
                                </form>
                            </td>
                        </tr>
                <?php
                        $s_no++;
                    }
                } else
                    echo '
                            <div class="alert alert-warning alert-dismissible">
                                <i class="icon fas fa-exclamation-triangle"></i>  No data available now!!!
                            </div>';
                ?>
            </tbody>
        </table>
        <script>
            $(document).ready(function() {
                $('#dtHorizontalExample').DataTable({
                    "scrollX": true
                });
                $('.dataTables_length').addClass('bs-select');
            });
        </script>
<?php
    } else
        echo "0";
}
