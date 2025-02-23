<?php
include('include/config.php');
if (isset($_POST['delete_program_type_id']) && isset($_POST['action']) && $_POST['action'] == 'delete_program_type') {
    $id = intval($_POST['delete_program_type_id']);
    $sql = "DELETE FROM mandatory_documents WHERE id = $id";
    if ($con->query($sql) === TRUE) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Error deleting the record."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request."]);
}
?>
