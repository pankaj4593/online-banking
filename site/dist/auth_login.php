<script type="text/javascript">
    function wrongAuth() {
        Swal.fire({
            title: "Login Failed",
            text: "username or password is incorrect !",
            icon: "error"
        });
    }

    // function rightAuth() {
    //     location.replace("http://localhost/online-banking/site/dist/risk.php");
    // }
</script>
<!-- loading time -->
<?php
include('connect.php');
  session_start();
  // session_regenerate_id(true);
  // if login session set then update logout_time record in tbl_login_history
  if(isset($_SESSION["s_login"]) && isset($_SESSION["s_account_no"]))
  {
    $logout_time = date("Y-m-d H:i:s");
    $query_for_update_logout = "UPDATE tbl_login_history SET logout_time = '$logout_time' WHERE token_id = (select max(token_id) from tbl_login_history)";
    $result_for_update_logout = mysqli_query($con, $query_for_update_logout) or die('SQL Error :: '.mysqli_error($con));
  }
  session_unset();
  session_destroy();


  session_start();

  // my bind_textdomain_codeset






?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico" />

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />

        <!-- Sweet Alert-->
        <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body class="">

        <style>
            @import url('https://fonts.googleapis.com/css2?family=El+Messiri:wght@700&display=swap');
            * {
                margin: 0;
                padding: 0;
                box-shadow: border-box;
                font-family: 'El Messiri', sans-serif;
            }
            
            body {
                background: #031323;
                overflow: hidden;
            }
            
            img {
                width: 32px;
            }
            
            section {
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100%;
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
                        <h2>LOGIN</h2>
                        <form action="" method="post" >
                            <div class="inputBx">
                                <input id="adminId" name='txt_username'  value="" required>
                                <span>Your Username</span>
                                <img src="https://www.flaticon.com/svg/static/icons/svg/709/709699.svg" alt="user">
                            </div>
                            <div class="inputBx password">
                                <input id="userpassword" name="txt_password"  type="password" required>
                                <span>Your Password</span>
                                <a href="#" class="password-control" onclick="return show_hide_password(this);"></a>
                                <img src="https://www.flaticon.com/svg/static/icons/svg/1828/1828471.svg" alt="lock">
                            </div>
                            <label class="remember"><input id="customControlInline" type="checkbox">
          Remember</label>
                            <div class="inputBx">
                                <button class="btn btn-success btn-block waves-effect waves-light" type="submit" name="btn_submit">
                                Sign
                                </button>
                                <!-- <input type="submit" name="btn_submit" value="Log in" disabled> -->
                            </div>
                        </form>
                        <p>Forgot password? <a href="auth-recoverpw.html">Click Here</a></p>
                        <p>Don't have an account <a href="auth_register.php">Sign up</a></p>
                    </div>
                </div>

            </div>
        </section>

        <!-- end Account pages -->

        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script>
            function show_hide_password(target) {
                var input = document.getElementById('userpassword');
                if (input.getAttribute('type') == 'password') {
                    target.classList.add('view');
                    input.setAttribute('type', 'text');
                } else {
                    target.classList.remove('view');
                    input.setAttribute('type', 'password');
                }
                return false;
            }
        </script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <!-- Sweet Alerts js -->
        <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
        <!-- Sweet alert init js-->
        <script src="assets/js/pages/sweet-alerts.init.js"></script>

        <script src="assets/js/app.js"></script>
    </body>

    </html>
    <?php
  if(isset($_REQUEST['btn_submit']))
  {
    $username = $_REQUEST["txt_username"];
    $password = $_REQUEST["txt_password"];
    $query = "SELECT username, password  FROM tbl_account WHERE username = '$username' AND  password='$password' ";
      $result1 = mysqli_query($con,$query);
    if(mysqli_num_rows($result1) > 0 )
    {
        // get account number from userame
        $query_account_no = "SELECT account_no FROM tbl_account WHERE username='$username'";
        $result_account_no = mysqli_query($con, $query_account_no);
        $account_no = mysqli_fetch_array($result_account_no)[0];
        // echo $account_no;
        $_SESSION["s_account_no"] = $account_no;
        $_SESSION["s_login"] = date("Y-m-d H:i:s");
        $Login_time = $_SESSION["s_login"];
        // insert record of login time
        $query_for_login_history = "INSERT INTO tbl_login_history (account_no, login_time) VALUES ($account_no,'$Login_time')";
        $result_for_login_history = mysqli_query($con, $query_for_login_history) or die('SQL Error :: '.mysqli_error($con));
        // echo '<script type="text/JavaScript">
        //       rightAuth();
        //      </script>';
   echo "<script>alert('please Verify you one time password!');location.href='risk.php';</script>";
    
      }
      // if(isset($_SESSION["s_login"]) && isset($_SESSION["s_account_no"]))
      // {

     // else

     //{
    //   echo "Email sending failed...";
    // }

    else
    {
        echo '<script type="text/JavaScript">
              wrongAuth();
             </script>'
              ;
    }

}
?>