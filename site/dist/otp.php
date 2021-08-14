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

    <script>
        function blank_validate() {
            debugger;
            var error = document.getElementById('1').value;
            var error1 = document.getElementById('2').value;
            var error2 = document.getElementById('3').value;
            var error3 = document.getElementById('4').value;

            if (error == "" && error1 == "" && error2 == "" && error3 == "") {
                alert('Please Enter Your Otp');
            }

        }
    </script>
    <style>
        .bg-pattern {
            /* background-image: url('https://i.pinimg.com/originals/f9/11/d3/f911d38579709636499618b6b3d9b6f6.jpg'); */
            /* background-size: cover;
background-position: center; */
            background-color: white !important;
        }
        
        .card {
            border-radius: 22px;
            background: #ffffff;
            box-shadow: 7px 7px 21px #cfcfcf, -7px -7px 21px #ffffff;
        }
    </style>

    <body class="bg-primary bg-pattern">
        <!-- <div class="home-btn d-none d-sm-block">
        <a href="index.html"><i class="mdi mdi-home-variant h2 text-white"></i></a>
    </div> -->

        <div class="account-pages ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mb-5">
                            <a href="index.html" class="logo"><img src="http://bigit.io/images/logo.png" height="24" alt="logo"></a>
                            <h5 class="font-size-16 text-white-50 mb-4">Responsive Bootstrap 4 Admin Dashboard</h5>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <style>
                    #wrapper {
                        font-family: Lato;
                        font-size: 1.5rem;
                        text-align: center;
                        box-sizing: border-box;
                        color: #333;
                    }
                    
                    #wrapper #dialog {
                        border: solid 1px #ccc;
                        margin: 10px auto;
                        padding: 20px 30px;
                        display: inline-block;
                        /* box-shadow: 0 0 4px #ccc; */
                        /* background-color: white; */
                        overflow: hidden;
                        position: relative;
                        max-width: 450px;
                        /* border-radius:9px; */
                        border-radius: 26px;
                        background: #ffffff;
                        box-shadow: 5px 5px 10px #d9d9d9, -5px -5px 10px #ffffff;
                    }
                    
                    #wrapper #dialog h3 {
                        margin: 0 0 10px;
                        padding: 0;
                        line-height: 1.25;
                    }
                    
                    #wrapper #dialog span {
                        font-size: 90%;
                    }
                    
                    #wrapper #dialog #form {
                        max-width: 240px;
                        margin: 25px auto 0;
                    }
                    
                    #wrapper #dialog #form input {
                        margin: 0 5px;
                        text-align: center;
                        line-height: 80px;
                        font-size: 50px;
                        border: solid 1px #ccc;
                        box-shadow: 0 0 5px #ccc inset;
                        outline: none;
                        width: 15%;
                        transition: all .2s ease-in-out;
                        border-radius: 3px;
                    }
                    
                    #wrapper #dialog #form input:focus {
                        border-color: purple;
                        box-shadow: 0 0 5px purple inset;
                    }
                    
                    #wrapper #dialog #form input::selection {
                        background: transparent;
                    }
                    
                    #wrapper #dialog #form button {
                        margin: 30px 0 50px;
                        width: 100%;
                        padding: 6px;
                        border: none;
                        text-transform: uppercase;
                    }
                    /* #wrapper #dialog button.close {
                    border: solid 2px;
                    border-radius: 30px;
                    line-height: 19px;
                    font-size: 120%;
                    width: 22px;
                    position: absolute;
                    right: 5px;
                    top: 5px;
                } */
                    
                    #wrapper #dialog div {
                        position: relative;
                        z-index: 1;
                    }
                    
                    #wrapper #dialog img {
                        position: absolute;
                        bottom: -70px;
                        right: -63px;
                    }
                </style>

                <div id="wrapper">
                    <div id="dialog">
                        <!-- <button class="close">×</button> -->
                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&nbsp;</button>Please check your <b>Email</b> for verify your self(OTP)
                        </div>
                        <div id="form">
                            <form method="post">
                                <input type="text" id="1" name="1" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                                <input type="text" id="2" name="2" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                                <input type="text" id="3" name="3" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                                <input type="text" id="4" name="4" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                                <button class="btn btn-primary" type="submit" name="submit" id="submit" onclick="return blank_validate();">Verify</button>

                            </form>
                            <div id="hide1" style="display:none;">Time left = <span id="timer"></span></div>
                            <a id="hide2" style="display:none;" onclick="javscript:location.href='risk.php' " class="btn btn-primary" style="color:white;"> RESEND</a>



                            <!-- <div>
                        Didn't receive the code?<br />
                        <a href="#">Send code again</a><br />
                        <a href="#">Change phone number</a>
                    </div> -->
                        </div>
                    </div>


                    <!-- <form method="post">
            <input type="text" name="1"  maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                        <input type="text"  name="2" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                        <input type="text" name="3" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                        <input type="text" name="4" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}"  />
                        <input  type="submit" name="submit" id="submit" value="submit">

            </form>
<?php
// for testing purpose
// if ($_SERVER['REQUEST_METHOD']=='POST') {
//     $one=$_POST['1'];
//     $one1=$_POST['2'];
//     $one2=$_POST['3'];
//     $one3=$_POST['4'];
//     $arr = array($one,$one1,$one2,'$one3');
//     echo implode(" ", $arr);
//  }
?> -->
                    <!--x`<div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="p-2">
                                <h5 class="mb-5 text-center">Reset Password</h5>
                                <form class="form-horizontal" action="index.html">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-warning alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Enter your <b>Email</b> and instructions will be sent to you!
                                            </div>

                                            <div class="form-group mt-4">
                                                <label for="useremail">Email</label>
                                                <input type="email" class="form-control" id="useremail" placeholder="Enter email">
                                            </div>
                                            <div class="mt-4">
                                                <button class="btn btn-success btn-block waves-effect waves-light" type="submit">Send Email</button>
                                            </div>

                                        </div>
                                    </div>
                                </form>



                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
                    <!-- end row -->
                </div>
            </div>
            <!-- end Account pages -->


            <!-- JAVASCRIPT -->
            <script src="assets/libs/jquery/jquery.min.js"></script>
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

                })
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