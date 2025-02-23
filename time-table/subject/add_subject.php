<?php
$page_no = "15";
$page_no_inside = "15_3";
include_once "../include/authentication.php";
include_once "../include/head.php";
include_once "../include/config.php";
include '../../framwork/ajax/method.php';

$visible = md5("visible");
date_default_timezone_set("Asia/Calcutta");
$date_variable_today_month_year_with_timing = date("Y-m-d h:i:s");
?>



<body class="hold-transition sidebar-mini">
  <div class="wrapper">



    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Add Subjects</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Add Subjects</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- SELECT2 EXAMPLE -->
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Add Subjects</h3>


            </div>
            <br>
          
            <form role="form" method="POST" id="add_subjects_form">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12" id="error_section"></div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Course Name</label>
                      <select class="form-control" name="course_id" id="course_id" onchange="change_semester(this.value)" required>
                        <option value="">Select</option>
                        <?php $sel_dept = mysqli_query($con, "SELECT * FROM `tbl_course`");
                        while ($res_dept = mysqli_fetch_assoc($sel_dept)) { ?>
                          <option value="<?php echo $res_dept['course_id']; ?>"><?php echo $res_dept['course_name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>

                    <div class="form-group">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Academic Year</label>
                      <select class="form-control" onchange="showdesg(this.value)" id="session_id" name="academic_year">
                        <option value="0">Select</option>
                        <?php
                        $sql_ac_year = "SELECT * FROM `tbl_university_details`
                                       WHERE `status` = '$visible';
                                       ";
                        $result_ac_year = $con->query($sql_ac_year);
                        while ($row_ac_year = $result_ac_year->fetch_assoc()) {
                        ?>
                          <?php
                          $completeSessionStart = explode("-", $row_ac_year["university_details_academic_start_date"]);
                          $completeSessionEnd = explode("-", $row_ac_year["university_details_academic_end_date"]);
                          $completeSessionOnlyYear = $completeSessionStart[0] . "-" . $completeSessionEnd[0];
                          ?>
                          <option value="<?php echo $row_ac_year["university_details_id"]; ?>"><?php echo $completeSessionOnlyYear; ?></option>
                        <?php } ?>
                      </select>
                    </div>


                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Semester</label>
                      <select class="form-control" name="semester_id" id="sem">
                        <option value="-1">Select</option>
                      </select>
                    </div>

                    <div class="form-group">
                    </div>
                  </div>
                </div>

              </div>

              <!-- /.card-header -->

              <div class="card-body">
                <table class="table table-bordered" id="dynamic_field" style="overflow-y:auto;">
                  <thead>
                    <tr>
                      <th data-field="S.NO" data-sortable="true" rowspan="2">S.no</th>
                      <th data-field="SubjectName" data-sortable="true" rowspan="2">Subject Name</th>
                      <th data-field="SubjectCode" data-sortable="true" rowspan="2">Subject Code</th>
                    
                      <th width="5%" >Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td width="5%"><input type="text" id="slno1" value="1" readonly class="form-control" style="border:none;" /></td>

                      <td width="30%"><input type="text" name="subject_name[]" placeholder="Subject Name" class="form-control" /></td>
                      <td width="25%"><input type="text" name="subject_code[]" placeholder="Subject Code" class="form-control" /></td>
                    
                      <td><button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i></button></td>

                    </tr>
                  </tbody>
                </table>

                <br>
                <input type='hidden' name='action' value='add_sub' />
                <div class="col-md-12" id="loader_section"></div>
                <button type="button" id="add_subjects_button" class="btn btn-primary">Add</button>
                <button type="reset" class="btn btn-danger">Reset</button>
              </div>
              <!-- /.card-body -->


          </div>

          </form>
        </div>
      </section>
      <!-- /.content -->
    </div>

    <?php include_once '../include/foot.php'; ?>

    <aside class="control-sidebar control-sidebar-dark">
    </aside>
  </div>

  <script>
    $(function() {

      $('#add_subjects_button').click(function() {
        $('#loader_section').append('<center id = "loading"><img width="50px" src = "<?= url('images/ajax-loader.gif') ?>" alt="Currently loading" /></center>');
        $('#add_subjects_button').prop('disabled', true);
        $.ajax({
          url: 'insert.php',
          type: 'POST',
          data: $('#add_subjects_form').serializeArray(),
          success: function(result) {
            $('#response').remove();
            if (result == "courseempty")
              $('#error_section').append('<div id = "response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Please First Add Courses!!!</div></div>');
            if (result == "empty")
              $('#error_section').append('<div id = "response"><div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-exclamation-triangle"></i>  Please fill out all required fields!!!</div></div>');
            if (result == "error")
              $('#error_section').append('<div id = "response"><div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something went wrong please try again!!!</div></div>');
            if (result == "success") {
              $('#add_subjects_form')[0].reset();
              $('#error_section').append('<div id = "response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Subject added successfully!!!</div></div>');
            }
            if (result == "update") {
              $('#add_subjects_form')[0].reset();
              $('#error_section').append('<div id = "response"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i> Subject updated successfully!!!</div></div>');
            }
            console.log(result);
            $('#loading').fadeOut(500, function() {
              $(this).remove();
            });
            $('#add_subjects_button').prop('disabled', false);
          }

        });
      });

    });
  </script>

  <script type="text/javascript">
    $(document).ready(function() {
      var i = 1;

      $('#add').click(function() {
        i++;
        $('#dynamic_field').append('<tr id="row' + i + '" class="dynamic-added" ><td><input type="text" id="slno' + i + '" value="' + i + '" readonly class="form-control" style="border:none;" /></td>' +
          '<td><input type="text" name="subject_name[]" placeholder="Subject Name" class="form-control" /></td>' +
          '<td><input type="text" name="subject_code[]" placeholder="Subject Code" class="form-control" />' +
         
          '</td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td>' +
          '</tr>');
      });

      $(document).on('click', '.btn_remove', function() {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
      });

    });

    function change_semester(semester) {
      $.ajax({
        url: '<?= url('include/ajax/add_semester.php') ?>',
        type: 'POST',
        data: {
          'data': semester
        },
        success: function(result) {
          document.getElementById('session_id').innerHTML = result;
        }

      });
    }

    function showdesg(session) {
      var dept = document.getElementById('course_id').value;
      $.ajax({
        url: '<?= url('ajaxdata.php') ?>',
        type: 'POST',
        data: {
          'depart': dept,
          'session': session
        },
        success: function(data) {
          $("#sem").html(data);
        },
      });

    }
  </script>

</body>

</html>