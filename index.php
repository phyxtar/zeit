<?php
if (empty(session_start()))
    session_start();
//DataBase Connectivity
include_once "include/config.php";
if (isset($_SESSION["logger_type"]) && isset($_SESSION["logger_username"]) && isset($_SESSION["logger_password"]))
    echo "<script> location.replace('dashboard'); </script>";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ZEIT | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <link rel="icon" href="img/fav.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Font Awesome -->
</head>

<body>
    <div class="l-form">
        <div class="shape1"></div>
        <div class="shape2"></div>

        <div class="form">
            <img src="https://i.postimg.cc/WbVD3VTV/authentication.png" alt="image" class="form-img">

            <form id="admin_login_form" method="POST" class="form-content">
            <div id="error_section"></div>
                <img src="img/logo.png">
            
                <div class="form-div form-div-one">
                    <div class="form-icon">
                        <i class='bx bxs-user-circle'></i>
                    </div>
                    <div class="form-div-input">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="admin_login_username" name="admin_login_username" class="form-input" required>
                    </div>
                </div>
            
                <div class="form-div">
                    <div class="form-icon">
                        <i class='bx bx-lock'></i>
                    </div>
                    <div class="form-div-input">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="admin_login_password" name="admin_login_password" class="form-input" required>
                    </div>
                </div>
            
                <a href="#" class="form-forgot">Forgot Password?</a>
                <input type='hidden' name='action' value='admin_login' />
                <input type="submit" id="admin_login_button" name="admin_login_button" class="form-button">
                <div class="col-12" id="loader_section"></div>
               
            </form>
            
           
            
        </div>
    </div>

    <script src="main.js"></script>
</body>

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <script>
        $(function() {

            $('#admin_login_form').submit(function(event) {
                $('#loader_section').append('<center id = "loading"><img width="50px" src = "images/load.gif" alt="Currently loading" /></center>');
                $('#admin_login_button').prop('disabled', true);
                $.ajax({
                    url: 'include/controller.php',
                    type: 'POST',
                    data: $('#admin_login_form').serializeArray(),
                    success: function(result) {
                        $('#response').remove();
                        $('#admin_login_form')[0].reset();
                        $('#error_section').append('<div id = "response">' + result + '</div>');
                        $('#loading').fadeOut(500, function() {
                            $(this).remove();
                        });
                        $('#admin_login_button').prop('disabled', false);
                    }

                });
                event.preventDefault();
            });

        });
    </script>

    <script>
        window.addEventListener('load', () => {
            registerSW();
        });

        // Register the Service Worker
        async function registerSW() {
            if ('serviceWorker' in navigator) {
                try {
                    await navigator
                        .serviceWorker
                        .register('serviceworker.js');
                } catch (e) {
                    console.log('SW registration failed');
                }
            }
        }
    </script>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

:root {
    --first-color: #12192c;
    --text-color: #8590ad;

    --body-font: 'Roboto', sans-serif;
    --big-font-size: 2rem;
    --normal-font-size: .938rem;
    --smaller-font-size: .875rem;
}

@media screen and (min-width: 768px) {
    :root {
        --big-font-size: 2.5rem;
        --normal-font-size: 1rem;
    }
}

*,::before,::after { box-sizing: border-box; }

body {
    margin: 0;
    padding: 0;
    font-family: var(--body-font);
    color: var(--first-color);
}

h1 { margin: 0; }
a { text-decoration: none; }
img { max-width: 100%; height: auto; }

.l-form {
    position: relative;
    height: 100vh;
    overflow: hidden;
}

.shape1, .shape2 {
    position: absolute;
    width: 200px;
    height: 200px;
    border-radius: 50%;
}

    .shape1 { 
        top: -7rem;
        left: -3.5rem;
        /* background: linear-gradient(180deg, var(--first-color) 0%, rgba(196, 196, 196, 0) 100%); */
        background: linear-gradient(180deg, #fbbc05 0%, #ff0004 100%);
        
    }

    .shape2 {
        bottom: -6rem;
        right: -5.5rem;
        background: linear-gradient(180deg, #fbbc05 0%, #ff0004 100%);
        transform: rotate(180deg);
    }

.form {
    height: 100vh;
    display: grid;
    justify-content: center;
    align-items: center;
    padding: 0 1rem;
}

.form-content { width: 290px; }
.form-img { display: none; }

.form-title {
    font-size: var(--big-font-size);
    font-weight: 500;
    margin-bottom: 2rem;
}

.form-div {
    position: relative;
    display: grid;
    grid-template-columns: 7% 93%;
    margin-bottom: 1rem;
    padding: 0.25rem 0;
    border-bottom: 1px solid var(--text-color);
}

    .form-div.focus { border-bottom: 1px solid var(--first-color); }

.form-div-one { margin-bottom: 3rem; }
.form-icon { 
    font-size: 1.5rem; 
    color: #ff0004;
    transition: .3s; 
}

    .form-div.focus .form-icon { color: var(--first-color); }

.form-label {
    display: block;
    position: absolute;
    left: 0.75rem;
    top: 0.25rem;
    font-size: var(--normal-font-size);
    color: var(--text-color);
    transition: .3s;
}

    .form-div.focus .form-label {
        top: -1.5rem;
        font-size: .875rem;
        color: var(--first-color);
    }

.form-div-input { position: relative; }

.form-input {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: none;
    outline: none;
    background: none;
    padding: 0.5rem .75rem;
    font-size: 1.2rem;
    color: var(--first-color);
    transition: .3s;
}

.form-forgot {
    display: block;
    text-align: right;
    margin-bottom: 2rem;
    font-size: var(--normal-font-size);
    color: #ff0004;
    font-weight: 500;
    transition: .5s;
}

    .form-forgot:hover { color: var(--first-color); }

.form-button {
    width: 100%;
    padding: 1rem;
    font-size: var(--normal-font-size);
    outline: none;
    border: none;
    margin-bottom: 3rem;
    background-color: #ff0004;
    color: #fff;
    border-radius: .5rem;
    cursor: pointer;
    transition: .3s;
}

    .form-button:hover { box-shadow: 0px 15px 36px rgba(0, 0, 0, .15); }

.form-social { text-align: center; }

.form-social-text {
    display: block;
    font-size: var(--normal-font-size);
    margin-bottom: 1rem;
}

.form-social-icon {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    width: 30px;
    height: 30px;
    margin-right: 1rem;
    padding: 0.5rem;
    background-color: #ff0004;
    color: #fff;
    font-size: 1.25rem;
    border-radius: 50%;
    transition: .5s;
}

    .form-social-icon:hover { background-color: var(--first-color); }

@media screen and (min-width: 968px) {
    .shape1 { 
        width: 400px;
        height: 400px;
        top: -11rem;
        left: -6.5rem;
    }

    .shape2 {
        width: 300px;
        height: 300px;
        right: -6.5rem;
    }

    .form {
        grid-template-columns: 1.5fr 1fr;
        padding: 0 2rem;
    }

    .form-content { width: 320px; }
    .form-img { 
        display: block;
        width: 700px;
        justify-self: center; 
    }
}
</style>

<script>
    const inputs = document.querySelectorAll(".form-input");

function addfocus() {
    let parent = this.parentNode.parentNode;
    parent.classList.add("focus");
}

function remfocus() {
    let parent = this.parentNode.parentNode;
    if(this.value == ""){
        parent.classList.remove("focus");
    }
}

inputs.forEach(input => {
    input.addEventListener("focus", addfocus);
    input.addEventListener("blur", remfocus)
});
</script>


    <script src="serviceworker.js"></script>


</html>