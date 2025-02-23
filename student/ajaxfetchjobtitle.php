<?php
include 'include/config.php';

$data = $_POST['data'];
echo $data;
// exit;
$sql = "SELECT * FROM tbl_placement WHERE company_name = '$data'";
$result = mysqli_query($con, $sql);

$row = $result->fetch_assoc();
// Convert string to array using explode
$array = explode(",", $row['job_title']);

// Loop through the array to display each job title as an option
foreach ($array as $job_title) {
?>
  <option value="<?php echo trim($job_title); ?>"><?php echo trim($job_title); ?></option>
<?php
}
?>
