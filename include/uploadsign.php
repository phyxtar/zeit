<?php
if (empty(session_start()))
    session_start();
//DataBase Connectivity
include "config.php";
include "db_class.php";
include "../framwork/main.php";
include "../framwork/config.php";

// Create the dynamic_table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS tbl_sign (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    des_id INT(11) NOT NULL UNIQUE KEY,
    name VARCHAR(255) NOT NULL,
    designation VARCHAR(255) NOT NULL,
    image_data LONGBLOB,
    upload_date varchar(255),
    status varchar(255)
)";

if ($conn->query($sql) === TRUE) {
    // echo "Table 'tbl_sign' created successfully!!!";
} else {
    echo "Error creating table: " . $conn->error;
}

$targetDir = "uploads/";

// Handle form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['name_r']) && $_POST['name_r'] !== "") {
        // Your code here 
        $date = date('d-m-Y');
        $des_id_r = $_POST['des_id_r'];
        $name = $_POST['name_r'];
        $designation = $_POST['designation_r'];
        $image = $_FILES['image_r']['tmp_name'];
        $imageContent = addslashes(file_get_contents($image)); // Read and prepare image content

        $sql = "INSERT INTO tbl_sign (des_id,name, designation, image_data, upload_date, status) VALUES ('$des_id_r','$name', '$designation', '$imageContent','$date','active')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    alert('Sign Uploaded Successfully.');
                    window.location.href = '../upload_sign';
                </script>";
        } else {
            echo "<script>
                    alert('Error inserting data: " . $conn->error . "');
                    window.location.href = '../upload_sign'; 
                </script>";
        }
    } else if (isset($_POST['name_c']) && $_POST['name_c'] !== "") {
        // Your code here    
        $date = date('d-m-Y');
        $des_id_c = $_POST['des_id_c'];
        $name = $_POST['name_c'];
        $designation = $_POST['designation_c'];
        $image = $_FILES['image_c']['tmp_name'];
        $imageContent = addslashes(file_get_contents($image)); // Read and prepare image content

        $sql = "INSERT INTO tbl_sign (des_id,name, designation, image_data, upload_date, status) VALUES ('$des_id_c','$name', '$designation', '$imageContent','$date','active')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    alert('Sign Uploaded Successfully.');
                    window.location.href = '../upload_sign';
                </script>";
        } else {
            echo "<script>
                    alert('Error inserting data: " . $conn->error . "');
                    window.location.href = '../upload_sign'; 
                </script>";
        }
    } else if (isset($_POST['name_c']) && $_POST['name_c'] !== "") {
        // Your code here    
        $date = date('d-m-Y');
        $des_id_c = $_POST['des_id_c'];
        $name = $_POST['name_c'];
        $designation = $_POST['designation_c'];
        $image = $_FILES['image_c']['tmp_name'];
        $imageContent = addslashes(file_get_contents($image)); // Read and prepare image content

        $sql = "INSERT INTO tbl_sign (des_id,name, designation, image_data, upload_date, status) VALUES ('$des_id_r','$name', '$designation', '$imageContent','$date','active')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    alert('Sign Uploaded Successfully.');
                    window.location.href = '../upload_sign';
                </script>";
        } else {
            echo "<script>
                    alert('Error inserting data: " . $conn->error . "');
                    window.location.href = '../upload_sign'; 
                </script>";
        }
    } else if (isset($_POST['name_vc']) && $_POST['name_vc'] !== "") {
        // Your code here 
        $date = date('d-m-Y');
        $des_id_vc = $_POST['des_id_vc'];
        $name = $_POST['name_vc'];
        $designation = $_POST['designation_vc'];
        $image = $_FILES['image_vc']['tmp_name'];
        $imageContent = addslashes(file_get_contents($image)); // Read and prepare image content

        $sql = "INSERT INTO tbl_sign (des_id,name, designation, image_data, upload_date, status) VALUES ('$des_id_vc','$name', '$designation', '$imageContent','$date','active')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    alert('Sign Uploaded Successfully.');
                    window.location.href = '../upload_sign';
                </script>";
        } else {
            echo "<script>
                    alert('Error inserting data: " . $conn->error . "');
                    window.location.href = '../upload_sign'; 
                </script>";
        }
    } else if (isset($_POST['name_pvc']) && $_POST['name_pvc'] !== "") {
        // Your code here    
        $date = date('d-m-Y');
        $des_id_pvc = $_POST['des_id_pvc'];
        $name = $_POST['name_pvc'];
        $designation = $_POST['designation_pvc'];
        $image = $_FILES['image_pvc']['tmp_name'];
        $imageContent = addslashes(file_get_contents($image)); // Read and prepare image content

        $sql = "INSERT INTO tbl_sign (des_id,name, designation, image_data, upload_date, status) VALUES ('$des_id_pvc','$name', '$designation', '$imageContent','$date','active')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    alert('Sign Uploaded Successfully.');
                    window.location.href = '../upload_sign';
                </script>";
        } else {
            echo "<script>
                    alert('Error inserting data: " . $conn->error . "');
                    window.location.href = '../upload_sign'; 
                </script>";
        }
    } else if (isset($_POST['name_ch']) && $_POST['name_ch'] !== "") {
        // Your code here    
        $date = date('d-m-Y');
        $des_id_ch = $_POST['des_id_ch'];
        $name = $_POST['name_ch'];
        $designation = $_POST['designation_ch'];
        $image = $_FILES['image_ch']['tmp_name'];
        $imageContent = addslashes(file_get_contents($image)); // Read and prepare image content

        $sql = "INSERT INTO tbl_sign (des_id,name, designation, image_data, upload_date, status) VALUES ('$des_id_ch','$name', '$designation', '$imageContent','$date','active')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    alert('Sign Uploaded Successfully.');
                    window.location.href = '../upload_sign';
                </script>";
        } else {
            echo "<script>
                    alert('Error inserting data: " . $conn->error . "');
                    window.location.href = '../upload_sign'; 
                </script>";
        }
    } else if (isset($_POST['name_a']) && $_POST['name_a'] !== "") {
        // Your code here   
        $date = date('d-m-Y');
        $des_id_a = $_POST['des_id_a'];
        $name = $_POST['name_a'];
        $designation = $_POST['designation_a'];
        $image = $_FILES['image_a']['tmp_name'];
        $imageContent = addslashes(file_get_contents($image)); // Read and prepare image content

        $sql = "INSERT INTO tbl_sign (des_id,name, designation, image_data, upload_date, status) VALUES ('$des_id_a','$name', '$designation', '$imageContent','$date','active')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    alert('Sign Uploaded Successfully.');
                    window.location.href = '../upload_sign';
                </script>";
        } else {
            echo "<script>
                    alert('Error inserting data: " . $conn->error . "');
                    window.location.href = '../upload_sign'; 
                </script>";
        }
    } else if (isset($_POST['name_t']) && $_POST['name_t'] !== "") {
        // Your code here    
        $date = date('d-m-Y');
        $des_id_t = $_POST['des_id_t'];
        $name = $_POST['name_t'];
        $designation = $_POST['designation_t'];
        $image = $_FILES['image_t']['tmp_name'];
        $imageContent = addslashes(file_get_contents($image)); // Read and prepare image content

        $sql = "INSERT INTO tbl_sign (des_id,name, designation, image_data, upload_date, status) VALUES ('$des_id_t','$name', '$designation', '$imageContent','$date','active')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    alert('Sign Uploaded Successfully.');
                    window.location.href = '../upload_sign';
                </script>";
        } else {
            echo "<script>
                    alert('Error inserting data: " . $conn->error . "');
                    window.location.href = '../upload_sign'; 
                </script>";
        }
    } else if (isset($_POST['name_p']) && $_POST['name_p'] !== "") {
        // Your code here    
        $date = date('d-m-Y');
        $des_id_p = $_POST['des_id_p'];
        $name = $_POST['name_p'];
        $designation = $_POST['designation_p'];
        $image = $_FILES['image_p']['tmp_name'];
        $imageContent = addslashes(file_get_contents($image)); // Read and prepare image content

        $sql = "INSERT INTO tbl_sign (des_id,name, designation, image_data, upload_date, status) VALUES ('$des_id_p','$name', '$designation', '$imageContent','$date','active')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    alert('Sign Uploaded Successfully.');
                    window.location.href = '../upload_sign';
                </script>";
        } else {
            echo "<script>
                    alert('Error inserting data: " . $conn->error . "');
                    window.location.href = '../upload_sign'; 
                </script>";
        }
    } else if (isset($_POST['name_o']) && $_POST['name_o'] !== "") {
        // Your code here   
        $date = date('d-m-Y');
        $des_id_o = $_POST['des_id_o'];
        $name = $_POST['name_o'];
        $designation = $_POST['designation_o'];
        $image = $_FILES['image_o']['tmp_name'];
        $imageContent = addslashes(file_get_contents($image)); // Read and prepare image content

        $sql = "INSERT INTO tbl_sign (des_id,name, designation, image_data, upload_date, status) VALUES ('$des_id_o','$name', '$designation', '$imageContent','$date','active')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    alert('Sign Uploaded Successfully.');
                    window.location.href = '../upload_sign';
                </script>";
        } else {
            echo "<script>
                    alert('Error inserting data: " . $conn->error . "');
                    window.location.href = '../upload_sign'; 
                </script>";
        }
    }
}
//Delete code


$conn->close();
