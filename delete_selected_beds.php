<?php
// Include your database connection file
include_once "include/authentication.php"; // Update this to your actual database connection file

// Check if the delete request was made
if (isset($_POST['delete_selected']) && isset($_POST['beds']) && !empty($_POST['beds'])) {
    $beds = $_POST['beds'];

    // Ensure the connection is valid
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare the SQL query to delete beds
    $placeholders = implode(',', array_fill(0, count($beds), '?'));
    $sql = "DELETE FROM hostel_bed WHERE id IN ($placeholders)";

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing the statement: " . $conn->error);
    }

    // Bind the parameters dynamically
    $types = str_repeat('i', count($beds));
    $stmt->bind_param($types, ...$beds);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect with success message
        header("Location: vacent_list.php?delete_success=1");
        exit();
    } else {
        die("Error executing the statement: " . $stmt->error);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect with error message if no beds are selected
    header("Location: vacent_list.php?delete_success=0");
    exit();
}
?>