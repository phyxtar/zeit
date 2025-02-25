<?php
$page_no = "2";
$page_no_inside = "2_3";
// update_status.php
include 'db_connection.php'; // Make sure to include your database connection file
include_once "include/authentication.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $company_name = $_POST['company_name'];
    $registration_number = $_POST['registration_number'];
    $tax_id = $_POST['tax_id'];
    $industry = $_POST['industry'];
    $founded = $_POST['founded'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $website = $_POST['website'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postal_code = $_POST['postal_code'];
    $country = $_POST['country'];
    $legal_structure = $_POST['legal_structure'];
    $business_license = $_POST['business_license'];
    $insurance_policy = $_POST['insurance_policy'];
    $linkedin = $_POST['linkedin'];
    $twitter = $_POST['twitter'];
    $facebook = $_POST['facebook'];
    $company_logo = $_POST['company_logo'];

    // Update query
    $sql = "UPDATE tbl_company_info SET 
                company_name='$company_name', 
                registration_number='$registration_number',
                tax_id='$tax_id',
                industry='$industry',
                founded='$founded',
                email='$email',
                phone='$phone',
                website='$website',
                address='$address',
                city='$city',
                state='$state',
                postal_code='$postal_code',
                country='$country',
                legal_structure='$legal_structure',
                business_license='$business_license',
                insurance_policy='$insurance_policy',
                linkedin='$linkedin',
                twitter='$twitter',
                facebook='$facebook',
                company_logo='$company_logo'
            WHERE id='$id'";

    if ($con->query($sql) === TRUE) {
        header("Location: index.php?success=Company updated successfully");
        exit();
    } else {
        echo "Error updating record: " . $con->error;
    }
}
?>
