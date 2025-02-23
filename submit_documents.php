<?php
include('include/config.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $docs = $_POST['docs'];

    foreach ($docs as $doc) {
        $program_type = mysqli_real_escape_string($con, $doc['program_type']);
        $tenth_mark = isset($doc['10th_mark']) ? 1 : 0;
        $tenth_cert = isset($doc['10th_cert']) ? 1 : 0;
        $twelfth_mark = isset($doc['12th_mark']) ? 1 : 0;
        $twelfth_cert = isset($doc['12th_cert']) ? 1 : 0;
        $graduate_mark = isset($doc['gra_mark']) ? 1 : 0;
        $graduate_cert = isset($doc['gra_cert']) ? 1 : 0;
        $masters_mark = isset($doc['mas_mark']) ? 1 : 0;
        $masters_cert = isset($doc['mas_cert']) ? 1 : 0;
        $transfer_cert = isset($doc['transfer_cert']) ? 1 : 0;
        $migration_cert = isset($doc['migration_cert']) ? 1 : 0;
        $uid_card = isset($doc['uid_card']) ? 1 : 0;
        $f_uid_card = isset($doc['f_uid_card']) ? 1 : 0;
        $cast_cert = isset($doc['cast_cert']) ? 1 : 0;
        $res_cert = isset($doc['res_cert']) ? 1 : 0;
        $sql = "INSERT INTO mandatory_documents (program_type, ten_mark, ten_cert, twelve_mark, twelve_cert, grad_mark, grad_cert, mas_mark, mas_cert, transfer_cert, migration_cert, uid_card, father_uid_card, cast_cert, res_cert)
                VALUES ('$program_type', $tenth_mark, $tenth_cert, $twelfth_mark, $twelfth_cert, $graduate_mark, $graduate_cert, $masters_mark, $masters_cert, $transfer_cert, $migration_cert, $uid_card, $f_uid_card, $cast_cert, $res_cert)";
        if ($con->query($sql) === TRUE) {
            echo "<script>
            alert('Records added successfully!');
            window.location.href = 'mandatory_documents.php'; 
            </script>";
        } else {
            echo "<script>
            alert('An error occurred while adding the records. Please try again.');
            window.location.href = 'mandatory_documents.php'; 
            </script>";
        }
    }
}
?>
