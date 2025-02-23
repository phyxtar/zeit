<?php

$page_no = "17";
$page_no_inside = "17_22";
include_once "include/authentication.php";
include_once "framwork/main.php";
include_once "include/function.php";

if(isset($_POST['selectedText']) && isset($_POST['selectedId'])) {
    $selectedName = $_POST['selectedText'];
    $selectedId = $_POST['selectedId'];

    $stmt = $conn->prepare("SELECT * FROM hostel_allotment WHERE admission_id = ?");
    if ($stmt) {
        $stmt->bind_param("s", $selectedId);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<p><strong>Bed ID:</strong> ' . $row['bed_no'] . '</p>';
                echo '<p><strong>Floor No:</strong> ' . $row['floor_no'] . '</p>';
                echo '<p><strong>Room No:</strong> ' . $row['room_no'] . '</p>';
                
                $buildingId = $row['building_id'];
                
                $stmt2 = $conn->prepare("SELECT * FROM hostel_building WHERE id = ?");
                if ($stmt2) {
                    $stmt2->bind_param("s", $buildingId);
                    $stmt2->execute();
                    $result2 = $stmt2->get_result();

                    if($result2->num_rows > 0) {
                        while($row2 = $result2->fetch_assoc()) {
                            echo '<p><strong>Building Name:</strong> ' . $row2['name'] . '</p>';
                        }
                    } else {
                        echo '<p>No details found for the selected building.</p>';
                    }

                    $stmt2->close();
                } else {
                    echo '<p>Failed to prepare the SQL statement for building details.</p>';
                }

                $admissionId = $row['admission_id'];
                $stmt3 = $conn->prepare("SELECT * FROM tbl_admission WHERE admission_id = ?");
                if ($stmt3) {
                    $stmt3->bind_param("s", $admissionId);
                    $stmt3->execute();
                    $result3 = $stmt3->get_result();

                    if($result3->num_rows > 0) {
                        while($row3 = $result3->fetch_assoc()) {
                            echo '<p><strong>Name:</strong> ' . $row3['admission_first_name'] . ' ' . $row3['admission_middle_name'] . ' ' . $row3['admission_last_name'] . '</p>';
                            echo '<p><strong>Mobile NO:</strong> ' . $row3['admission_mobile_student'] . '</p>';
                    
                            $courseId = $row3['admission_course_name'];
                            $stmt4 = $conn->prepare("SELECT * FROM tbl_course WHERE course_id = ?");
                            if ($stmt4) {
                                $stmt4->bind_param("s", $courseId);
                                $stmt4->execute();
                                $result4 = $stmt4->get_result();

                                if($result4->num_rows > 0) {
                                    while($row4 = $result4->fetch_assoc()) {
                                        echo '<p><strong>Course Name:</strong> ' . $row4['course_name'] . '</p>';
                                    }
                                } else {
                                    echo '<p>No course details found for the selected course ID.</p>';
                                }

                                $stmt4->close();
                            } else {
                                echo '<p>Failed to prepare the SQL statement for course details.</p>';
                            }
                            
                            $session = $row3['admission_session'];
                            $stmt5 = $conn->prepare("SELECT * FROM  tbl_university_details WHERE university_details_id  = ?");
                            if ($stmt5) {
                                $stmt5->bind_param("s", $session);
                                $stmt5->execute();
                                $result5 = $stmt5->get_result();

                                if($result5->num_rows > 0) {
                                    while($row5 = $result5->fetch_assoc()) {
                                        echo '<p><strong>Session:</strong> ' . $row5['academic_session'] . '</p>';
                                    }
                                } else {
                                    echo '<p>No additional details found for the selected session.</p>';
                                }

                                $stmt5->close();
                            } else {
                                echo '<p>Failed to prepare the SQL statement for session details.</p>';
                            }
                        }
                    } else {
                        echo '<p>No additional details found for the selected admission ID.</p>';
                    }

                    $stmt3->close();
                } else {
                    echo '<p>Failed to prepare the SQL statement for additional details.</p>';
                }
            }
        } else {
            echo '<p>No details found for the selected student.</p>';
        }

        $stmt->close();
    } else {
        echo '<p>Failed to prepare the SQL statement.</p>';
    }
    
    $conn->close();
}
?>