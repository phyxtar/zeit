<?php

function studentLeave($student_id, $rejoin_date = '', $leave_date)
{
    if ($leave_date != '') {
        $student_array = array();
        $student_array['student_id'] = $student_id;
        $student_array['re_join_date'] = $rejoin_date;
        $student_array['leave_date'] = $leave_date;
        insertAll('tbl_student_hostel_leave', $student_array);
    }
    if ($rejoin_date != '') {
        $leave = array();
        $leave['hostel_leave_date'] = '';
        updateAll('tbl_admission', $leave, '`admission_id`=' . $student_id . '');
    }
}
?>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"> Student hostel Leave Log</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                        <?php thGen('tbl_student_hostel_leave') ?>
                    </thead>
                    <tbody>
                        <?php tdGen('tbl_student_hostel_leave', '', '', '', '`student_id`=' . $_GET['id'] . '',) ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal end -->
<style>
    td:nth-child(2),
    th:nth-child(2) {
        display: none !important;
    }

    th {
        text-transform: uppercase;
    }
</style>