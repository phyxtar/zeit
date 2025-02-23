<?php
$page_no = "17";
$page_no_inside = "17_36";
include_once "include/authentication.php";
// Check if building_id is set in the POST request
if (!isset($_POST['building_id'])) {
    die('Building ID not provided');
}

// Get the building ID from the request
$building_id = $_POST['building_id'];

// Prepare and execute the SQL query to get all floors for the given building ID
$sql = "SELECT DISTINCT floor_no FROM hostel_room WHERE building_id = ?";
$stmt = $conn->prepare($sql);

// Check if the statement preparation was successful
if (!$stmt) {
    die('Prepare failed: ' . $conn->error);
}

$stmt->bind_param("i", $building_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if the query was successful
if (!$result) {
    die('Error executing query: ' . $conn->error);
}

// Add the "Select Floor" option first
echo '<option value="all">All</option>';

// Check if there are results and generate options
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . htmlspecialchars($row['floor_no']) . '">Floor ' . htmlspecialchars($row['floor_no']) . '</option>';
    }
} else {
    echo '<option value="">No floors available</option>';
}

// Free result set and close connection
$stmt->close();
$conn->close();
?>