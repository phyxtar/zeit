<?php
include_once "include/config.php";

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT grade_id, grade_name FROM tbl_grade WHERE grade_name LIKE ?";
    $stmt = $con->prepare($sql);
    $searchTerm = "%" . $search . "%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="search-result-item" data-grade-id="' . htmlspecialchars($row['grade_id']) . '" data-grade="' . htmlspecialchars($row['grade_name']) . '">' . htmlspecialchars($row['grade_name']) . '</div>';
        }
    } else {
        echo '<div>No grades found.</div>';
    }
    
    $stmt->close();
}
?>