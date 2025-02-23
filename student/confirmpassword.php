<?php
if (empty(session_start()))
    session_start();
//DataBase Connectivity
include "include/config.php";
$msg = '';
$password = '';


// checking the phone number and email id seated into the session or not as well as checking it is not must bes null
if (isset($_SESSION['phone']) && isset($_SESSION['email']) && $_SESSION['phone'] != '') {

    if (isset($_POST['resetpassword'])) {
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        if ($password === $cpassword) {
            $phone = $_SESSION['phone'];
            $email = $_SESSION['email'];
            $md5password = md5($password);
            $forget_password = "UPDATE `tbl_admission` SET `admission_password`='$md5password' WHERE `admission_mobile_student`='$phone' ";
            $result = mysqli_query($con, $forget_password);
            if ($result) {
                $msg = 2;
            }
        } else {
            $msg = 1;
        }
    }
} else {
    echo "<script> location.replace('forgetpassword'); </script>";
}

if (isset($_SESSION["logger_username1"]) && isset($_SESSION["logger_password1"])) {
    echo "<script> location.replace('dashboard'); </script>";
} else {

?>
<!-- this the comments -->

<head>
    <title> NETAJI SUBHAS UNIVERSITY CONFIRM PASSWORD</title>
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

    .TrT0Xe {
        font-size: 14px;
        font-weight: 800;
        list-style: circle;
    }
    </style>
    <div class="container">
        <center class="margin"> <img class="img-title" src="images/images.png">
            <p class="title">RESET PASSWORD</p>
            <form method="POST" id="student_login_form">
                <div id="error_section"></div>
                <b class="p-white font-weight-700 mt-3 text-left "> Enter new password :</b><input class="form-control"
                    title="please read password instruction" value="<?php echo $password ?>" required="" id="pass"
                    type="text" class="input data-type=" placeholder="Enter new  password " name="password"
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"></br>
                <b class="p-white font-weight-700 mt-3 text-left "> Confirm password :</b><input class="form-control"
                    title="please read password instruction" required="" id="pass" type="password"
                    class="input data-type=" placeholder="Repeat Again  password " name="cpassword"
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"></br>

                <div class="col-4">
                    <div class="col-4">
                        <button type="submit" name="resetpassword" class="btn btn-primary btn-block">Reset
                            password</button>
                    </div>
                    <div class="col-12" id="loader_section"></div>
                </div>

                <br>
                <?php if ($msg == 1) { ?>
                <small class="text-danger text-light"> <?php echo  $password ?> is not matched </small>
                <?php  } elseif ($msg == 2) { ?>
                <h3> <strong class="text-success">Password Successfully reset <a href="student_login">Login here</a>
                    </strong> </h3>

                <script>
                setInterval(function() {

                }, 2000);
                </script>
                <?php session_destroy();
                    } ?>


            </form>
            <div class="row text-danger" style="width: 35%; color: red;">
                <h4 class="text-danger">- Password instructions -</h4>
                <div class="RqBzHd text-warning font-weight-800">
                    <ul class="i8Z77e text-danger">
                        <li class="TrT0Xe">At least one lowercase character (a-z)</li>
                        <li class="TrT0Xe">At least one uppercase character (A-Z)</li>
                        <li class="TrT0Xe">At least one digit (0-9)</li>
                        <li class="TrT0Xe">At least one symbol (? . , ! _ - ~ $ % + = @)</li>
                        <li class="TrT0Xe">Minimum size of password is 8 character</li>

                    </ul>
                </div>
            </div>

        </center>

    </div>

</body>
<style>
.or {
    color: orangered !important;
}

.text-center {

    color: white;
    margin-top: 20px;
}

@media screen and (min-width: 560px) {
    .text-center {
        color: white;
    }
}
</style>
<div class="text-center">
    <?php include "include/footer.php" ?>
</div>

</html>
<?php } ?>
<!--  rtrt-->