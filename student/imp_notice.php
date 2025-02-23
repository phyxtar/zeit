<?php
$sql = "SELECT * FROM `tbl_admission` WHERE `status` = '$visible' && `admission_username` = '" . $_SESSION["logger_username1"] . "'";
$result = $con->query($sql);
$row = $result->fetch_assoc();
$doc_status = $row['doc_status']; // Fetch the doc_status field
$student_name = $row['admission_first_name'];
?>
<!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
<style>
/* Modal styling */
.w3-modal-content {
    max-width: 100%;
    width: 400px;
    margin: auto;
    top: 50%;
    transform: translateY(-50%);
    position: relative;
}

/* Responsive adjustments */
@media (max-width: 600px) {
    .w3-modal-content {
        width: 90%;
    }
}

/* Apply blur to the background when modal is active */
.blurred {
    filter: blur(5px);
    pointer-events: none;
}

/* Modal content styling */
.w3-modal-header {
    background-color: #c61313;
    color: white;
    padding: 5px;
}

.w3-modal-container {
    padding: 20px;
}

/* Ensure the modal popup is always centered */
.w3-modal1 {
    display: block;
    z-index: 9999;
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
}
</style>
<?php if ($doc_status == 1): ?>
<!-- Modal Popup for Document Pending -->
<div id="doc-popup" class="w3-modal1">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom">
        <header class="w3-container w3-modal-header">
            <h4>Important Notice*</h4>
        </header>
        <div class="w3-container w3-modal-container">
            <p>Dear <?php echo $student_name; ?>, </p>
            <p>Your <b>documents</b> are pending for verification. Please contact the administration department to
                access
                your account again.</p>
            <p>Thank You</p>
        </div>
    </div>
</div>
<?php endif; ?>