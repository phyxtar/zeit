<?php
$page_no = "17";
$page_no_inside = "17_36";
include_once "include/authentication.php";

// Check if a bed has been successfully deleted
if (isset($_GET['delete_success']) && $_GET['delete_success'] == '1') {
    echo "<div class='alert alert-success'>Bed deleted successfully!</div>";
} elseif (isset($_GET['delete_success']) && $_GET['delete_success'] == '0') {
    echo "<div class='alert alert-danger'>No beds selected for deletion.</div>";
}

// Check if building and floor are set
if (isset($_POST['building']) && isset($_POST['floor'])) {
    $building_id = $_POST['building'];
    $floor_no = $_POST['floor'];

    // Ensure the connection is valid
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare the SQL query to fetch building and room details
    $sql = "
        SELECT b.id AS building_id, b.name AS building_name, b.building_code, r.start, r.end, r.floor_no, r.total_room
        FROM hostel_building b
        LEFT JOIN hostel_room r ON b.id = r.building_id
        WHERE 1 = 1
    ";

    // Add conditions based on building and floor values
    if ($building_id !== 'all') {
        $sql .= " AND b.id = ?";
    }
    if ($floor_no !== 'all') {
        $sql .= " AND r.floor_no = ?";
    }

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing the statement: " . $conn->error);
    }

    // Bind the parameters dynamically
    if ($building_id !== 'all' && $floor_no !== 'all') {
        $stmt->bind_param('ii', $building_id, $floor_no);
    } elseif ($building_id !== 'all') {
        $stmt->bind_param('i', $building_id);
    } elseif ($floor_no !== 'all') {
        $stmt->bind_param('i', $floor_no);
    }

    // Execute the statement
    if (!$stmt->execute()) {
        die("Error executing the statement: " . $stmt->error);
    }

    // Fetch the results
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<h3>Vacant List Details</h3>";

        // Create the table with dynamic bed rows
        echo "<table id='buildingTable' class='display table table-striped table-bordered' style='width:100%'>";
        echo "<thead>
                <tr>
                    <th>Sl No.</th>
                    <th>Building Name</th>
                    <th>Building Code</th>
                    <th>Floor</th>
                    <th>Room</th>
                    <th>Bed</th>
                    <th>Status</th>
                </tr>
              </thead>";
        echo "<tbody>";

        $serial = 1;

        while ($row = $result->fetch_assoc()) {
            for ($roomNumber = (int)$row['start']; $roomNumber <= (int)$row['end']; $roomNumber++) {
                $bedSql = "
                    SELECT no_of_bed 
                    FROM hostel_bed 
                    WHERE building_id = ? AND floor_no = ? AND room_no = ?
                ";
                $bedStmt = $conn->prepare($bedSql);
                $bedStmt->bind_param('iii', $row['building_id'], $row['floor_no'], $roomNumber);
                $bedStmt->execute();
                $bedResult = $bedStmt->get_result();
                $bedData = $bedResult->fetch_assoc();

                if ($bedData) {
                    for ($bedNumber = 1; $bedNumber <= $bedData['no_of_bed']; $bedNumber++) {
                        // Check if the bed is occupied
                        $allotmentSql = "
                            SELECT id 
                            FROM hostel_allotment 
                            WHERE building_id = ? AND floor_no = ? AND room_no = ? AND bed_no = ?
                        ";
                        $allotmentStmt = $conn->prepare($allotmentSql);
                        $allotmentStmt->bind_param('iiii', $row['building_id'], $row['floor_no'], $roomNumber, $bedNumber);
                        $allotmentStmt->execute();
                        $allotmentResult = $allotmentStmt->get_result();

                        $isOccupied = $allotmentResult->num_rows > 0;

                        // If the bed is occupied, skip this iteration
                        if ($isOccupied) {
                            continue;
                        }

                        // If the bed is unoccupied, display it
                        echo "<tr>";
                        echo "<td>" . $serial++ . "</td>";
                        echo "<td>" . htmlspecialchars($row['building_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['building_code']) . "</td>";
                        echo "<td>Floor " . htmlspecialchars((int)$row['floor_no']) . "</td>";
                        echo "<td>Room " . htmlspecialchars($roomNumber) . "</td>";
                        echo "<td>Bed " . htmlspecialchars($bedNumber) . "</td>";
                        echo "<td><span class='badge badge-danger'>Unoccupied</span></td>";
                        echo "</tr>";

                        $allotmentStmt->close();
                    }
                }
                $bedStmt->close();
            }
        }

        echo "</tbody>";
        echo "</table>";
    } else {
        echo "No buildings or rooms found.";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Building and floor are required.";
}
?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
<style>
/* Target DataTable buttons specifically and enforce styles with !important */
.dt-buttons .dt-button {
    background-color: #4CAF50 !important;
    color: white !important;
    border: none !important;
    padding: 10px 20px !important;
    text-align: center !important;
    text-decoration: none !important;
    display: inline-block !important;
    font-size: 14px !important;
    margin: 4px 2px !important;
    cursor: pointer !important;
    border-radius: 5px !important;
}

/* Different colors for different buttons */
.dt-buttons .buttons-copy {
    background-color: #f44336 !important;
}

.dt-buttons .buttons-csv {
    background-color: #008CBA !important;
}

.dt-buttons .buttons-excel {
    background-color: #4CAF50 !important;
}

.dt-buttons .buttons-pdf {
    background-color: #e7e7e7 !important;
    color: black !important;
}
</style>
<script>
$(document).ready(function() {
    $('#buildingTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        orderable: false,
        pageLength: 100,
        columnDefs: [{
            orderable: false,
            targets: 0
        }]
    });
});
</script>