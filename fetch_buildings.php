<?php
$page_no = "17";
$page_no_inside = "17_36";
include_once "include/authentication.php";
// SQL query to get all buildings from the hostel_building table
$sql = "SELECT id, name, building_code FROM hostel_building";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if (!$result) {
    // Output error message and exit if query fails
    die('Error executing query: ' . mysqli_error($conn));
}

// Add the "All" option first
echo '<option value="all">All</option>';

// Check if there are results and generate options
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<option value="' . $row['id'] . '">' . $row['name'] . ' (' . $row['building_code'] . ')</option>';
    }
} else {
    echo '<option value="">No buildings available</option>';
}

// Free result set and close connection
mysqli_free_result($result);
mysqli_close($conn);
?>