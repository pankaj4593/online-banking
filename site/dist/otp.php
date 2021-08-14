<?php
include 'connect.php';
session_start();
if (isset($_SESSION["s_account_no"]) && isset($_SESSION['s_login'])) {
    $Account_no = $_SESSION["s_account_no"];

    if (isset($_REQUEST['submit'])) {
        $one1=$_POST['1'];
        $one2=$_POST['2'];
        $one3=$_POST['3'];
        $one4=$_POST['4'];
        $convert_into_array=array($one1,$one2,$one3,$one4);
        $check_Converted=implode('', $convert_into_array);
        // echo $check_Converted;
        // die;
                        $query=mysqli_query($con, "SELECT  otp  FROM tbl_customer WHERE otp='$check_Converted' and account_no='$Account_no'   ") or die('sql error');
        $data_query_match=mysqli_fetch_array($query);
       
        if ($data_query_match) {
            echo "<script>alert('You Can Avail Your Services');location.href='index.php';</script>";
        } else {
            echo '<script>alert("Otp is Invalid");</script>';
            // rest of the code
        }
    }
}
else {
   header("location:http://localhost/online-banking/site/dist/auth_login.php");
   }
?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Recover Password | Apaxy - Responsive Bootstrap 4 Admin Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />

    </head>
    <!-- validation for blank -->





    <body>

        <style>
            body {
                background: #031323;
                overflow: hidden;
                height: 100% !important;
            }
            
            img {
                width: 32px;
            }
            
            section {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
                background-size: 400% 400%;
                animation: gradient 10s ease infinite;
            }
            
            @keyframes gradient {
                0% {
                    background-position: 0% 50%;
                }
                50% {
                    background-position: 100% 50%;
                }
                100% {
                    background-position: 0% 50%;
                }
            }
            
            .box {
                position: relative;
            }
            
            .box .square {
                position: absolute;
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(5px);
                box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
                border: 1px solid rgba(255, 255, 255, 0.15);
                border-radius: 15px;
                animation: square 10s linear infinite;
                animation-delay: calc(-1s * var(--i));
            }
            
            @keyframes square {
                0%,
                100% {
                    transform: translateY(-20px);
                }
                50% {
                    transform: translateY(20px);
                }
            }
            
            .box .square:nth-child(1) {
                width: 100px;
                height: 100px;
                top: -15px;
                right: -45px;
            }
            
            .box .square:nth-child(2) {
                width: 150px;
                height: 150px;
                top: 105px;
                left: -125px;
                z-index: 2;
            }
            
            .box .square:nth-child(3) {
                width: 60px;
                height: 60px;
                bottom: 85px;
                right: -45px;
                z-index: 2;
            }
            
            .box .square:nth-child(4) {
                width: 50px;
                height: 50px;
                bottom: 35px;
                left: -95px;
            }
            
            .box .square:nth-child(5) {
                width: 50px;
                height: 50px;
                top: -15px;
                left: -25px;
            }
            
            .box .square:nth-child(6) {
                width: 85px;
                height: 85px;
                top: 165px;
                right: -155px;
                z-index: 2;
            }
            
            .container {
                position: relative;
                padding: 30px;
                width: 100%;
                min-height: auto;
                display: flex;
                justify-content: center;
                align-items: center;
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(5px);
                border-radius: 10px;
                box-shadow: 0 25px 45px rgba(0, 0, 0, 0.2);
            }
            
            .container::after {
                content: '';
                position: absolute;
                top: 5px;
                right: 5px;
                bottom: 5px;
                left: 5px;
                border-radius: 5px;
                pointer-events: none;
                background: linear-gradient(to bottom, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.1) 2%);
            }
            
            .form {
                position: relative;
                width: 100%;
                height: 100%;
            }
            
            .form h2 {
                color: #fff;
                letter-spacing: 2px;
                margin-bottom: 30px;
            }
            
            .form .inputBx {
                position: relative;
                width: 100%;
                margin-bottom: 20px;
            }
            
            .form .inputBx input {
                width: 80%;
                outline: none;
                border: none;
                border: 1px solid rgba(255, 255, 255, 0.2);
                background: rgba(255, 255, 255, 0.2);
                padding: 8px 10px;
                padding-left: 40px;
                border-radius: 15px;
                color: #fff;
                font-size: 16px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            }
            
            .form .inputBx .password-control {
                position: absolute;
                top: 11px;
                right: 10px;
                display: inline-block;
                width: 20px;
                height: 20px;
                background: url(https://snipp.ru/demo/495/view.svg) 0 0 no-repeat;
                transition: 0.5s;
            }
            
            .form .inputBx .view {
                background: url(https://snipp.ru/demo/495/no-view.svg) 0 0 no-repeat;
                transition: 0.5s;
            }
            
            .form .inputBx img {
                position: absolute;
                top: 6px;
                left: 8px;
                transform: scale(0.6);
                filter: invert(1);
            }
            
            .form .inputBx input[type="submit"] {
                background: #fff;
                color: #111;
                max-width: 100px;
                padding: 8px 10px;
                box-shadow: none;
                letter-spacing: 1px;
                cursor: pointer;
                transition: 1.5s;
            }
            
            .form .inputBx input[type="submit"]:hover {
                background: linear-gradient(115deg, rgba(0, 0, 0, 0.10), rgba(255, 255, 255, 0.25));
                color: #fff;
                transition: 0.5s;
            }
            
            .form .inputBx input::placeholder {
                color: #fff;
            }
            
            .form .inputBx span {
                position: absolute;
                left: 30px;
                padding: 10px;
                display: inline-block;
                color: #fff;
                transition: 0.5s;
                pointer-events: none;
            }
            
            .form .inputBx input:focus~span,
            .form .inputBx input:valid~span {
                transform: translateX(-30px) translateY(-25px);
                font-size: 12px;
            }
            
            .form p {
                color: #fff;
                font-size: 15px;
                margin-top: 5px;
            }
            
            .form p a {
                color: #fff;
            }
            
            .form p a:hover {
                background-color: #000;
                background-image: linear-gradient(to right, #434343 0%, black 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            
            .remember {
                position: relative;
                display: inline-block;
                color: #fff;
                margin-bottom: 10px;
                cursor: pointer;
            }
            
            form {
                max-width: 100%;
                margin: 25px auto 0;
            }
            
            form input {
                margin: 0 5px;
                text-align: center;
                line-height: 60px;
                font-size: 25px;
                border: solid 1px #ccc;
                box-shadow: 0 0 5px #ccc inset;
                outline: none;
                width: 20%;
                transition: all .2s ease-in-out;
                border-radius: 3px;
            }
            
            form input:focus {
                border-color: purple;
                box-shadow: 0 0 5px purple inset;
            }
            
            form input::selection {
                background: transparent;
            }
            
            form button {
                margin: 30px 0 50px;
                width: 100%;
                padding: 6px;
                border: none;
                text-transform: uppercase;
            }
        </style>
        <section>

            <div class="box">

                <div class="square" style="--i:0;"></div>
                <div class="square" style="--i:1;"></div>
                <div class="square" style="--i:2;"></div>
                <div class="square" style="--i:3;"></div>
                <div class="square" style="--i:4;"></div>
                <div class="square" style="--i:5;"></div>

                <div class="container">
                    <div class="form">
                        <h2>ENTER OTP</h2>
                        <div id="form">
                            <form method="post">
                                <input type="text" id="1" name="1" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                                <input type="text" id="2" name="2" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                                <input type="text" id="3" name="3" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                                <input type="text" id="4" name="4" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                                <button class="btn btn-primary" type="submit" name="submit" id="submit" onclick="return blank_validate();">Verify</button>

                            </form>
                            <div id="hide1" style="display:none;color:white;">Time left = <span id="timer"></span></div>
                            <a id="hide2" style="display:none;" onclick="javscript:location.href='risk.php' " class="btn btn-primary" style="color:white;"> RESEND</a>

                        </div>
                        <p>Forgot password? <a href="auth-recoverpw.html">Click Here</a></p>
                        <p>Don't have an account <a href="auth_register.php">Sign up</a></p>
                    </div>
                </div>

            </div>
        </section>








        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script>
            function blank_validate() {
                //  debugger;
                var error = document.getElementById('1').value;
                var error1 = document.getElementById('2').value;
                var error2 = document.getElementById('3').value;
                var error3 = document.getElementById('4').value;

                if (error == "" && error1 == "" && error2 == "" && error3 == "") {
                    alert('Please Enter Your Otp');
                }

            }
        </script>
        <script>
            $(function() {
                'use strict';

                var body = $('body');

                function goToNextInput(e) {
                    var key = e.which,
                        t = $(e.target),
                        sib = t.next('input');

                    if (key != 9 && (key < 48 || key > 57)) {
                        e.preventDefault();
                        return false;
                    }

                    if (key === 9) {
                        return true;
                    }

                    if (!sib || !sib.length) {
                        sib = body.find('input').eq(0);
                    }
                    sib.select().focus();
                }

                function onKeyDown(e) {
                    var key = e.which;

                    if (key === 9 || (key >= 48 && key <= 57)) {
                        return true;
                    }

                    e.preventDefault();
                    return false;
                }

                function onFocus(e) {
                    $(e.target).select();
                }

                body.on('keyup', 'input', goToNextInput);
                body.on('keydown', 'input', onKeyDown);
                body.on('click', 'input', onFocus);

            });
        </script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <script src="assets/js/app.js"></script>


        <script>
            //  debugger;
            let timerOn = true;

            function timer(remaining) {
                var m = Math.floor(remaining / 60);
                var s = remaining % 60;

                m = m < 10 ? '0' + m : m;
                s = s < 10 ? '0' + s : s;
                document.getElementById('timer').innerHTML = m + ':' + s;
                remaining -= 1;

                //alert(remaining);

                if (remaining >= 0 && timerOn) {
                    setTimeout(function() {
                        document.getElementById("hide1").style.display = "block";
                        timer(remaining);

                    }, 1000);

                    return;
                    // console.log("mybtn-show");

                }
                //   if (remaining == 0 ) {
                //     console.log("mybtn-show");
                //   }
                if (!timerOn) {
                    // Do validate stuff here

                    return;
                }

                // Do timeout stuff here
                alert('Timeout for otp');
                // console.log("mybtn-show");
                document.getElementById("hide1").style.display = "none";
                document.getElementById("hide2").style.display = "block";
            }

            timer(120);
        </script>

    </body>

    </html>