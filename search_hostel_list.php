<?php 
$page_no = "17";
$page_no_inside = "17_22";
include_once "include/authentication.php";
include_once "framwork/main.php";
include_once "include/function.php";

if(isset($_POST['value'])){
    $output = '';
    $value = mysqli_real_escape_string($con, $_POST['value']);
    $qry = "
        SELECT * FROM tbl_admission 
        WHERE (
            admission_id LIKE '%$value%' 
            OR admission_first_name LIKE '%$value%'
            OR admission_middle_name LIKE '%$value%'
            OR admission_last_name LIKE '%$value%'
        )
        AND admission_hostel = 'Yes'
        AND (`hostel_leave_date` IS NULL OR `hostel_leave_date` = '')
    ";
    $result = mysqli_query($con, $qry);

    $output = '<ul class="list-unstyled list-group">';
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_array($result)) {
            $output .= '<li class="list-group-item" data-id="' . $row['admission_id'] . '">
            ' . $row['admission_first_name'] . ' ' . $row['admission_middle_name'] . ' ' . $row['admission_last_name'] . '
            <input type="hidden" class="hidden-id" value="' . $row['admission_id'] . '">
        </li>';
        }
    } else {
        $output .= '<li>Invalid ID or Name</li>';
    }
    $output .= '</ul>';
    echo $output;
}
?>
<script>
$(document).on('click', '#hostel_id_list li', function() {
    var selectedText = $(this).text().trim();
    var selectedId = $(this).find('.hidden-id').val(); // Get the hidden ID

    $('#hostel_id').val(selectedText);
    $('#hostel_id_list').fadeOut();

    $.ajax({
        url: "selected_hostel_student.php",
        method: "POST",
        data: {
            selectedText: selectedText,
            selectedId: selectedId // Pass the ID
        },
        success: function(myresponse) {
            $('#certificateDetails').html(myresponse);
            $('#certificateModal').modal('show');
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
});
</script>