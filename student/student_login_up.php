<?php
if (empty(session_start()))
    session_start();
//DataBase Connectivity
include "include/config.php";
if (isset($_SESSION["logger_type1"]) && isset($_SESSION["logger_username1"]) && isset($_SESSION["logger_password1"]))
    echo "<script> location.replace('dashboard'); </script>";
?>


<title> NSU Login Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="dist/css/login.css" rel="stylesheet" id="bootstrap-css">

<style type="text/css">
    body {
        background: url('images/cms.png') fixed;
        background-repeat: no-repeat;
        background-size: cover;
        padding: 0;
        margin: 0;
    }

    .form-sections {
        border-radius: 90px 4px;

        margin: 14px auto;
        background: #e3b020;
        padding: 18px 20px;
        box-shadow: 5px 5px 14px #c70013;
    }

    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        color: #ffff;
        background-color: #e3b020;
        border-bottom: 2px solid;
        border-radius: 0px !important;
    }

    .nav-link {
        color: #c70013;
    }
</style>

<body>
    <section class="container">
        <h4 class="website-view mt-3 text-white">Establised Under Jharkhand State Private University Act 2018</h4>
        <div class="row">
            <div class="col-sm-3">

            </div>
            <div class="col-sm-6">
                <div class="form-sections ">
                    <center> <img width="100px" class="opt_img" src="images/logo.png"></center>
                    <h3 class="text-center text-uppercase text-danger"><b>Sign In</b></h3>
                    <small>If you don't have your Login User Id and Password or if you are getting some issues during Login your Panel, feel free to contact with this number <a href="tel:9835203429">+91 983-520-3429</a></small><br /><br />
                    <div id="error_section"></div>

                    <!-- student slipt screen start -->
                    <div class="text-center">
                       <h5>currently we are fecing technical issue , sorry for inconvience, we will get back to you soon</h5>
                    </div>
               


                    <p class="text-white text-center"><a class=" text-primary" href="forgetpassword"> Forget Password </a></p>
                    <div class="text-center">
                        <?php include "include/footer.php" ?>
                    </div>
                </div>

            </div>
            <div class="col-sm-3"></div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>

    <script>
        $(function() {

            $('#student_login_form').submit(function(event) {
                $('#loader_section').append('<center id = "loading"><img width="50px" src = "images/load.gif" alt="Currently loading" /></center>');
                $('#student_login_button').prop('disabled', true);
                $.ajax({
                    url: 'include/controller.php',
                    type: 'POST',
                    data: $('#student_login_form').serializeArray(),
                    success: function(result) {
                        $('#response').remove();
                        $('#student_login_form')[0].reset();
                        $('#error_section').append('<div id = "response">' + result + '</div>');
                        $('#loading').fadeOut(500, function() {
                            $(this).remove();
                        });
                        $('#student_login_button').prop('disabled', false);
                    }
                });
                event.preventDefault();
            });

            // login with the registration no
            $('#student_pay_fees').submit(function(event) {
                $('#loader_section').append('<center id = "loading"><img width="50px" src = "images/load.gif" alt="Currently loading" /></center>');
                $('#student_pay_fees_button').prop('disabled', true);
                $.ajax({
                    url: 'include/controller/login_with_reg',
                    type: 'POST',
                    data: $('#student_pay_fees').serializeArray(),
                    success: function(result) {
                        $('#response').remove();
                        $('#student_login_username1').attr('readonly', 'readonly');
                        console.log(result);
                        if (result == "wrong") {
                            $('#wrong_otp').html('<div id = "response"> <div class="alert alert-danger" role="alert"> Wrong OTP Please Enter 6 digit valid OTP </div> </div>');
                        } else {
                            $('#otp_data').html(result);
                        }
                        // $('#student_pay_fees')[0].reset();
                        $('#loading').fadeOut(500, function() {
                            $(this).remove();
                            $('#send_opt_btn').hide();
                        });
                        $('#student_pay_fees_button').prop('disabled', false);
                    }
                });
                event.preventDefault();
            });
        });
    </script>
</body>

</html>