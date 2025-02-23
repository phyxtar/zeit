<?php
if (empty(session_start()))
    session_start();
//DataBase Connectivity
include "include/config.php";
include '.././include/sms.php';


$msg = '';
$flag = 0;
$phone = '';
if (isset($_POST['forget'])) {
    $phone = $_POST['phone'];
    $forget_password = "SELECT * FROM `tbl_admission` WHERE `admission_mobile_student`='$phone' || `admission_username`='$phone'";
    $result = mysqli_query($con, $forget_password);
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_array($result);
        // adding otp into the session
        $_SESSION['phone'] = $data['admission_mobile_student'];
        if ($phone == $data['admission_mobile_student']) {
            $_SESSION['otp'] = otp($_SESSION['phone']);
            $_SESSION['email'] = $data['admission_emailid_student'];
            $flag = 1;
        } else {
            $flag = 0;
            $msg = 1;
        }
    } else {
        $flag = 0;
        $msg = 1;
    }
}

if (isset($_POST['submit_otp']) && $_POST['otp'] != '') {
    $otp = $_POST['otp'];
    $phone = $_POST['phone'];
    $flag = 1;

    if ($otp == $_SESSION['otp'] && $phone == $_SESSION['phone']) {

        echo '<script>
    window.location.replace("confirmpassword");
        </script>';
    } else {
        $msg = 2;
    }
}

if (isset($_SESSION["logger_username1"]) && isset($_SESSION["logger_password1"])) {
    echo "<script> location.replace('dashboard'); </script>";
} else {

    ?>
<!-- this the comments -->

<head>
    <title> NETAJI SUBHAS UNIVERSITY FORGET PASSWORD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../app-assets/images/logo/favicon-32x32.png" sizes="32x32">
    <link rel="icon" href="../app-assets/images/logo/favicon-192x192.png" sizes="192x192">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <link href="dist/css/login.css" rel="stylesheet" id="bootstrap-css">
</head>

<body>
    <?php include 'imp_notice.php'; ?>

    <style type="text/css">
    body {
        background: url('images/img_bg_nsu.png') fixed;
        background-repeat: no-repeat;
        background-size: cover;
        padding: 0;
        margin: 0;

    }

    .img-title {
        margin-top: 5%;
        width: 300px;
    }

    .title {
        color: red;
        font-size: 30px;
        font-weight: 900;
        margin-top: 5%;
        margin-bottom: 10px;

    }

    .p-white {
        color: white;
    }

    @media (max-width: 768px) {

        .img-title {
            margin-top: 84% !important;
            width: 300px;
        }
    }
    </style>
    <div class="container">
        <center class="margin"> <img class="img-title" src="images/images.png">
            <p class="title">FORGOT PASSWORD</p>
            <form method="POST" id="student_login_form">
                <div id="error_section"></div>
                <b class="text-danger font-weight-700 mt-3 text-left "> Enter 10 digit mobile number :</b><input
                    type="text" id="student_login_username" value="<?php echo $phone; ?>" name="phone"
                    class="form-control" placeholder="Enter UserName or Register 10  digit mobile number"></br>
                <?php if ($flag == 1) { ?>
                <b class=" text-success">Otp has been sended to <?php echo $phone ?> : </b><input type="text"
                    id="student_login_password" name="otp" class="form-control" placeholder="Enter 6 digit otp">

                </br>
                <div class="col-4">
                    <button type="submit" name="submit_otp" class="btn btn-primary btn-block">Submit otp</button>
                </div>

                <?php } else { ?>
                <div class="col-4">
                    <div class="col-4">
                        <button type="submit" name="forget" class="btn btn-primary btn-block">Reset password</button>
                    </div>
                    <div class="col-12" id="loader_section"></div>
                </div>
                <?php }
                    ?>
                <br>
                <?php if ($msg == 1) { ?>
                <strong>
                    <p class="text-danger text-light bg-white p-2"> <?php echo $phone ?> is not match with our records
                        <a href="index">back</a>
                    </p>
                </strong>
                <?php } elseif ($msg == 2) { ?>
                <small class="text-danger text-light"> Please enter valid otp <?php echo $otp ?> </small>

                <?php } ?>
            </form>
            <br><br>
        </center>
    </div>
    </div>
    <div class="text-center">
        <?php include "include/footer.php" ?>
    </div>
</body>
<style>
.or {
    color: orangered !important;
}

.text-center {

    color: white;
    margin-top: 100px;
}

@media screen and (min-width: 560px) {
    .text-center {
        color: white;
    }
}
</style>


</html>
<?php } ?>
<!--  rtrt-->