<?php
$page_no = "5";
$page_no_inside = "5_1";
include_once "include/authentication.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>NETAJI SUBHAS UNIVERSITY | Admission Form </title>
  <link rel="icon" href="images/logo.png" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
    .form-control {
      font-weight: 900 !important;
      color: #ad183a !important;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <?php include_once 'include/navbar.php'; ?>
    <?php include_once 'include/aside.php'; ?>

    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Admission Form</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              </ol>
            </div>
          </div>
        </div>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">

          <!-- SELECT2 EXAMPLE -->
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Admission Form</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
              </div>
            </div>

            <div class="form-container" style="padding: 15px;">
              <!-- Progress Bar -->
              <div class="progress-bar">
                <div class="step active">1</div>
                <div class="line active"></div>
                <div class="step">2</div>
                <div class="line"></div>
                <div class="step">3</div>
              </div>

              <!-- Step Names -->
              <div class="step-name">
                <div class="name">Personal Details</div>
                <div class="name">Educational Details</div>
                <div class="name">Upload Documents</div>
              </div>

              <!-- Step Content -->
              <div class="step-content active">
                <form action="include/add_admission.php" method="POST" enctype="multipart/form-data">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Documents Required For Admission</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <div class="card-body">
                                <div class="row">
                                    <?php
                                    $sel = mysqli_query($con, "SELECT MAX(admission_id) AS id FROM tbl_admission");
                                    $result = mysqli_fetch_array($sel);
                                    $admission_id = $result['id'];
                                    $query = "SELECT * FROM tbl_admission WHERE admission_id = $admission_id";
                                    $data_result = mysqli_query($con, $query);
                                    if ($data_result) {
                                        $data = mysqli_fetch_array($data_result);
                                        $ad_program_type = $data['admission_program_type'];
                                    }
                                    echo '<input type="hidden" name="add_admission_id" value="' . $admission_id . '" class="form-control">';

                                    $query_2 = "SELECT * FROM mandatory_documents WHERE program_type = '$ad_program_type'";
                                    $data_result_2 = mysqli_query($con, $query_2);

                                    if ($data_result_2) {
                                        if (mysqli_num_rows($data_result_2) > 0) {
                                            $data_2 = mysqli_fetch_array($data_result_2);
                                            if ($data_2['ten_mark'] == 1) {
                                                echo '<div class="col-4">
                                                        <label>10th Marksheet</label>
                                                        <input type="file" name="add_admission_tenth_marksheet" class="form-control">
                                                      </div>';
                                            }
                                            if ($data_2['ten_cert'] == 1) {
                                                echo '<div class="col-4">
                                                        <label>10th Passing Certificate</label>
                                                        <input type="file" name="add_admission_tenth_passing_certificate" class="form-control">
                                                      </div>';
                                            }
                                            if ($data_2['twelve_mark'] == 1) {
                                                echo '<div class="col-4">
                                                        <label>12th Marksheet</label>
                                                        <input type="file" name="add_admission_twelve_marksheet" class="form-control">
                                                      </div>';
                                            }
                                            if ($data_2['twelve_cert'] == 1) {
                                                echo '<div class="col-4">
                                                        <label>12th Passing Certificate</label>
                                                        <input type="file" name="add_admission_twelve_passing_certificate" class="form-control">
                                                      </div>';
                                            }
                                            if ($data_2['grad_mark'] == 1) {
                                                echo '<div class="col-4">
                                                        <label>Graduation Marksheet</label>
                                                        <input type="file" name="add_admission_graduation_marksheet" class="form-control">
                                                      </div>';
                                            }
                                        } else {
                                            echo "No matching records found.";
                                        }
                                    } else {
                                        echo "Error in query: " . mysqli_error($con);
                                    }
                                    ?>

                                    <!-- Additional file input fields -->
                                    <div class="col-4">
                                        <label>Recent Character Certificate</label>
                                        <input type="file" name="add_admission_recent_character_certificate" class="form-control">
                                    </div>

                                    <div class="col-4">
                                        <label>Other Certificate (If applicable)</label>
                                        <input type="file" name="add_admission_other_certificate" class="form-control">
                                    </div>

                                    <div class="col-4">
                                        <label>Character Certificate (If applicable)</label>
                                        <input type="file" name="add_admission_character_certificate" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <div class="button-group">
                        <input type="hidden" value="add_admission_data_3" name="add_admission_data_3">
                        <button type="submit" class="save-btn btn-sm btn-primary" style="background-color: #e3b020; color: #ffffff;">Submit</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <?php include_once 'include/footer.php'; ?>
    <aside class="control-sidebar control-sidebar-dark"></aside>
  </div>

  <!-- Scripts -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script>
    $(document).ready(function () {
        $(".step-content").first().addClass("active");
        $('.submit_btn_3').on('click', function () {
            var currentStep = $(".step-content.active");
            var nextStep = currentStep.next(".step-content");

            if (nextStep.length > 0) {
                currentStep.removeClass("active");
                nextStep.addClass("active");
                var currentStepNumber = $(".step").index(currentStep) + 1;
                $(".step").eq(currentStepNumber).addClass("active");
                $(".line").eq(currentStepNumber - 1).addClass("active");
                $(".step").slice(0, currentStepNumber).addClass("active");
                $(".line").slice(0, currentStepNumber - 1).addClass("active");
            }
        });
    });
  </script>

  <style>
    * {
      box-sizing: border-box;
    }
    .progress-bar {
      background-color: white !important;
      flex-direction: row !important;
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 15px;
      position: relative;
    }
    .progress-bar .step {
      width: 40px;
      height: 40px;
      background-color: #e0e0e0;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #fff;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }
    .progress-bar .step {
      background-color: #e3b020;
    }
    .progress-bar .line {
      flex: 1;
      height: 4px;
      background-color: #e0e0e0;
      margin: 0 8px;
      transition: background-color 0.3s ease;
    }
    .progress-bar .line {
      background-color: #e3b020;
    }
    .step-name {
      display: flex;
      justify-content: space-between;
      margin-top: 5px;
      font-size: 14px;
      color: #333;
    }
    .step-content.active {
      display: block;
      opacity: 1;
      transform: translateX(0);
    }
    .button-group {
      display: flex;
      justify-content: space-between;
      margin-top: 20px;
    }
    .button-group button {
      padding: 10px 20px;
      font-size: 16px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
  </style>
</body>

</html>
