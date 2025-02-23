<?php
include_once "../../include/config.php";
include_once "../../framwork/main.php";
include_once "../../include/function.php";

$id = $_GET['id'];

// Define the columns to fetch with their labels
$columns = [
    'admission_tenth_marksheet' => "10th Marksheet",
    'admission_tenth_passing_certificate' => "10th Passing Certificate",
    'admission_twelve_markesheet' => "12th Marksheet",
    'admission_twelve_passing_certificate' => "12th Passing Certificate",
    'admission_graduation_marksheet' => "Graduation Marksheet",
    'admission_recent_character_certificate' => "Recent Character Certificate",
    'admission_other_certificate' => "Other Certificate",
    'admission_character_certificate' => "Character Certificate"
];

// Construct the SQL query to fetch only the specified columns
$columnsList = implode(', ', array_keys($columns));
$sql = "SELECT $columnsList FROM `tbl_admission`
        WHERE `status` = '$visible' AND `admission_id` = '$id'
        ORDER BY `admission_id` ASC";

$result = $con->query($sql);
$row = mysqli_fetch_assoc($result);

// Display the certificates in a table format with icons
echo "
<style>
table {
    width: 100%;
    border-collapse: collapse; /* Ensures table borders are collapsed */
}

th, td {
    border: 1px solid #ddd; /* Light grey border */
    padding: 8px; /* Padding inside cells */
    text-align: left; /* Aligns text to the left */
}

th {
    background-color: #f2f2f2; /* Light grey background for headers */
    font-weight: bold; /* Bold font for headers */
}

.check-icon {
    color: green;
    font-weight: bold;
    text-align: center;
}

.cross-icon {
    color: red;
    font-weight: bold;
    text-align: center;
}
</style>

<table>";
echo "<tr><th>Document Name</th><th>Status</th></tr>";

if (!empty($row)) {
    foreach ($columns as $field => $label) {
        $status = isset($row[$field]) && !empty($row[$field]) ? '✓' : '✗';
        $statusClass = $status === '✓' ? 'check-icon' : 'cross-icon';
        echo "<tr><td>$label</td><td class='$statusClass'>$status</td></tr>";
    }
} else {
    echo "<tr><td colspan='2'>No data found.</td></tr>";
}

echo "</table>";
?>