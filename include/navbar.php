<!-- Navbar -->
<nav class=" main-header navbar navbar-expand navbar-dark " style="background-color: #8a0410 !important;">

    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="dashboard" class="nav-link"><strong style="font-size:22px;">Netaji Subhas University</strong></a>
        </li>
    </ul>
    <?php

// Fetch notifications
$query = "SELECT * FROM tbl_migration_form ORDER BY create_time DESC LIMIT 10";
$result = $conn->query($query);
$notifications = $result->fetch_all(MYSQLI_ASSOC);

// Fetch counts for pending and completed applications
$queryCounts = "SELECT
    SUM(CASE
        WHEN library = 'Not Approve' OR admin_dept = 'Not Approve' OR finance_dept = 'Not Approve' OR dept_labs = 'Not Approve' OR IT_lab = 'Not Approve'
        THEN 1
        ELSE 0
    END) AS pending_count,
    SUM(CASE
        WHEN library = 'Approve' AND admin_dept = 'Approve' AND finance_dept = 'Approve' AND dept_labs = 'Approve' AND IT_lab = 'Approve'
        THEN 1
        ELSE 0
    END) AS completed_count
FROM tbl_migration_form";
$countResult = $conn->query($queryCounts);
$counts = $countResult->fetch_assoc();

?>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-bell"></i>
                <span class="badge badge-primary navbar-badge"><?php echo count($notifications); ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">
                    <?php echo count($notifications); ?> New Migration Applications
                </span>
                <div class="dropdown-divider"></div>

                <!-- Notification items -->
                <?php if (!empty($notifications)): ?>
                <?php foreach ($notifications as $notification): ?>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file text-primary mr-2"></i>
                    <?php echo $notification['candidate_name']; ?> -
                    <?php echo $notification['name_of_the_exam']; ?> -
                    <?php echo $notification['session']; ?>
                    <span class="float-right text-muted text-sm">
                        <?php echo date('d M, H:i', strtotime($notification['create_time'])); ?>
                    </span>
                </a>
                <div class="dropdown-divider"></div>
                <?php endforeach; ?>
                <?php else: ?>
                <a href="#" class="dropdown-item text-center text-muted">
                    No new notifications
                </a>
                <?php endif; ?>

                <!-- Redirect to migration form application page -->
                <a href="migration_form_application.php" class="dropdown-item dropdown-footer">
                    See All Notifications
                </a>
                <div class="dropdown-divider"></div>

                <!-- Pending and Completed Applications -->
                <a href="#" class="dropdown-item">
                    <i class="fas fa-hourglass-half text-danger mr-2"></i>
                    Pending Applications
                    <span class="float-right badge badge-warning"><?php echo $counts['pending_count']; ?></span>
                </a>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-check-circle text-success mr-2"></i>
                    Completed Applications
                    <span class="float-right badge badge-success"><?php echo $counts['completed_count']; ?></span>
                </a>
            </div>
        </li>

        <style>
        .new-notification {
            background-color: #f8d7da;
            /* Light red background for new notifications */
        }
        </style>
        <li class="nav-item" title="Change Password">
            <a href="javascript:void(0)" class="nav-link"
                onclick="document.getElementById('changePasswordModal').style.display='block'">
                <p><i class="fas fa-edit"></i></p>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="images/logo.png" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                <?php 
                    echo $_SESSION["logger_username"]; ?>
                            </h3>
                            <p class="text-sm">Netaji Subhas University</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>

                <div class="dropdown-divider"></div>
                <a href="javascript:void(0)" class="dropdown-item dropdown-footer"
                    onclick="document.getElementById('logout').style.display='block'">Logout</a>
            </div>
        </li>
        <!--
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
-->
    </ul>
</nav>
<!-- /.navbar -->

<!-- Logout Section Start -->
<div id="logout" class="w3-modal" style="z-index:2020;">
    <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
        <header class="w3-container" style="background:#343a40; color:white;">
            <span onclick="document.getElementById('logout').style.display='none'"
                class="w3-button w3-display-topright">&times;</span>
            <h2 align="center">Are you sure???</h2>
        </header>
        <div class="card-body">
            <div class="col-md-12" align="center">
                <a href="logout" class="btn btn-danger"><i class="nav-icon fa fa-power-off"></i> Log Out</a>
                <button type="button" onclick="document.getElementById('logout').style.display='none'"
                    class="btn btn-primary">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- Logout Section End -->
<!-- Change Password Section Start -->
<div id="changePasswordModal" class="w3-modal" style="z-index:2020;">
    <div class="w3-modal-content w3-animate-top w3-card-4" style="width:40%">
        <header class="w3-container" style="background:#343a40; color:white;">
            <span onclick="document.getElementById('changePasswordModal').style.display='none'"
                class="w3-button w3-display-topright">&times;</span>
            <h2 align="center">Change Password</h2>
        </header>
        <div class="card-body">
            <div class="col-md-12" align="center">
                <center>
                    <div id="main-result-pass"></div>
                </center>
                <form id="sendPassOtp">
                    <input type="hidden" name="action" value="sendOtpForPassword" />
                    <button id="sendOtpForPasswordButton" type="submit" class="btn btn-primary"><span
                            id="pass-loader-1"></span> Send OTP</button><br />
                    <small class="text-red">Send a Verification code to your registered Phone Number to Change
                        Password</small>
                </form>
                <form id="checkPassOtp" style="display:none">
                    <input type="number" id="checkOTPForPass" name="checkOTPForPass" placeholder="6 Digit OTP"
                        style="display: block; width: 100%; height: calc(2.25rem + 2px); padding: .375rem .75rem; font-size: 1rem; font-weight: 400; line-height: 1.5; color: #495057; background-color: #fff; background-clip: padding-box; border: 1px solid #ced4da; border-radius: .25rem;" />
                    <input type="hidden" class="form-control" name="action" value="checkOtpForPassword" />
                    <br />
                    <button id="checkOtpForPasswordButton" type="submit" class="btn btn-primary  w3-right"><span
                            id="pass-loader-2"></span> Verify OTP</button><br />
                </form>
                <form id="changePassForm" style="display:none">
                    <input type="password" id="changePassOne" required name="changePassOne" placeholder="Password"
                        style="display: block; width: 100%; height: calc(2.25rem + 2px); padding: .375rem .75rem; font-size: 1rem; font-weight: 400; line-height: 1.5; color: #495057; background-color: #fff; background-clip: padding-box; border: 1px solid #ced4da; border-radius: .25rem;" />
                    <input type="password" id="changePassTwo" required name="changePassTwo"
                        placeholder="Retype-Password"
                        style=" margin-top:20px; display: block; width: 100%; height: calc(2.25rem + 2px); padding: .375rem .75rem; font-size: 1rem; font-weight: 400; line-height: 1.5; color: #495057; background-color: #fff; background-clip: padding-box; border: 1px solid #ced4da; border-radius: .25rem;" />
                    <input type="hidden" class="form-control" name="action" value="changeForPassword" />
                    <br />
                    <button id="changePasswordButton" type="submit" class="btn btn-primary  w3-right"><span
                            id="pass-loader-3"></span>Save Changes</button><br />
                </form>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#sendPassOtp').submit(function(event) {
        $('#pass-loader-1').append(
            '<img id = "loading" width="16px" src = "images/ajax-loader.gif" alt="Currently loading" /></center>'
        );
        $('#sendOtpForPasswordButton').prop('disabled', true);
        $('#response-pass').remove();
        $.ajax({
            url: 'include/controller.php',
            type: 'POST',
            data: $('#sendPassOtp').serializeArray(),
            success: function(result) {
                if (result == "success") {
                    $('#main-result-pass').html(
                        '<div id = "response-pass"> We have send an OTP to your Registered Number, please check and verify.</div>'
                    );
                    $("#sendPassOtp").hide();
                    $("#checkPassOtp").show();
                } else
                    $('#main-result-pass').html(
                        '<div id = "response-pass">Something went wrong please try again</div>'
                    );
                $('#loading').fadeOut(500, function() {
                    $(this).remove();
                    $('#sendOtpForPasswordButton').prop('disabled', false);
                });
            }
        });
        event.preventDefault();
    });
    $('#checkPassOtp').submit(function(event) {
        $('#pass-loader-2').append(
            '<img id = "loading" width="16px" src = "images/ajax-loader.gif" alt="Currently loading" /></center>'
        );
        $('#checkOtpForPasswordButton').prop('disabled', true);
        $('#response-pass').remove();
        $.ajax({
            url: 'include/controller.php',
            type: 'POST',
            data: $('#checkPassOtp').serializeArray(),
            success: function(result) {
                if (result == "success") {
                    $('#main-result-pass').html(
                        '<div id = "response-pass"> Please change your Password Now.</div>'
                    );
                    $("#checkPassOtp").hide();
                    $("#changePassForm").show();
                } else
                    $('#main-result-pass').html('<div id = "response-pass">' + result +
                        '</div>');
                $('#loading').fadeOut(500, function() {
                    $(this).remove();
                    $('#checkOtpForPasswordButton').prop('disabled', false);
                });
            }
        });
        event.preventDefault();
    });
    $('#changePassForm').submit(function(event) {
        $('#pass-loader-3').append(
            '<img id = "loading" width="16px" src = "images/ajax-loader.gif" alt="Currently loading" /></center>'
        );
        $('#changePasswordButton').prop('disabled', true);
        $('#response-pass').remove();
        if ($('#changePassOne').val() == $('#changePassTwo').val()) {
            $.ajax({
                url: 'include/controller.php',
                type: 'POST',
                data: $('#changePassForm').serializeArray(),
                success: function(result) {
                    if (result == "success") {
                        $('#main-result-pass').html(
                            '<div id = "response-pass"> Your password has been changed Successfully.</div>'
                        );
                        $("#changePassForm").hide();
                    } else
                        $('#main-result-pass').html('<div id = "response-pass">' + result +
                            '</div>');
                    $('#loading').fadeOut(500, function() {
                        $(this).remove();
                        $('#changePasswordButton').prop('disabled', false);
                    });
                }
            });
        } else {
            $('#main-result-pass').html(
                '<div id = "response-pass"> Your Password did not match...</div>');
            $('#loading').fadeOut(500, function() {
                $(this).remove();
                $('#changePasswordButton').prop('disabled', false);
            });
        }
        event.preventDefault();
    });
});
</script>
<!-- Change Password Section End -->