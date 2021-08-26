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
    <!-- auto logout script -->
    <!-- <script src="assets/js_autolog/script.js"></script> -->
    </head>
    <style>
        .card {
            border-radius: 22px;
            background: #ffffff;
        }
    </style>

    <body class="" style="background-image: url(https://i.imgur.com/3hXohqn.png);background-repeat: no-repeat;background-position: center;background-size: cover;">
        <!-- <div class="home-btn d-none d-sm-block">
          https://i.imgur.com/3hXohqn.png
            <a href="https://localhost/online-banking/admin/dist/auth-login.php"><i class="mdi mdi-home-variant h2 text-white"></i></a>
        </div> -->
        <div class="account-pages my-5">
            <div class="container">


                <div class="row justify-content-center" style="margin-top: 10%;">
                    <div class="col-lg-5">
                        <!-- <img style="width: 300px;" src="https://media.istockphoto.com/vectors/bank-modern-thin-line-design-style-vector-illustration-vector-id1031507604?k=6&m=1031507604&s=612x612&w=0&h=bnJDD3qU81dUXV5wKgKM39icU8b-BU29z1vEgdr0rCw=" alt=""> -->

                        <div class="row mt-3">
                            <div class="col-lg-3"> <img style="width: 100px;height: 70px;" src="https://www.saros.co.uk/static/home/img/cybersecurity.png" alt="">
                            </div>
                            <div class="col mt-3">
                                <h3>Tips For Sequrity</h3>
                            </div>
                            <div class="col-lg-12 mt-4">
                                <ul type="circle ">
                                    <li>
                                        <h5 class="text-muted">This Is A Demo Content The system supports multiple administrator accounts, with different roles and permissions.</h5>
                                    </li>
                                    <li>
                                        <h5 class="text-muted">This Is A Demo Content The system supports multiple administrator accounts, with different roles and permissions.</h5>
                                    </li>
                                    <li>
                                        <h5 class="text-muted">Ready to deploy and start operations. Modules can easily be added as needed. Includes the capability to create unlimited users, user-groups, and administrators</h5>
                                    </li>
                                    <li>
                                        <h5 class="text-muted">This Is A Demo Content</h5>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-7">
                        <div class="card" style="box-shadow: -2px -2px 9px #d4d4d4, 0px 0px 0px #ffffff;width: 60%;">
                            <div class="card-body p-4">
                                <div class="p-2">
                                    <h1 class="mb-2 text-center">
                                        SIGN IN
                                    </h1>
                                    <form class="form-horizontal mt-3" method="post">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group mb-4">
                                                            <label for="id">Username</label>
                                                            <input type="text" class="form-control" id="adminId" name='txt_username' placeholder="Your Username" value="" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group mb-4">
                                                            <label for="userpassword">Password</label>
                                                            <input type="password" class="form-control" id="userpassword" name="txt_password" placeholder="Enter password" required />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="customControlInline" />
                                                            <label class="custom-control-label" for="customControlInline">Remember me</label
                              >
                            </div>
                                                </div>
                                                <div class="col-md-6">
                                                  
                                                </div>
                                              </div>
                        <div class="mt-4 text-center">
                          <button style="width: 40%;border-radius: 30px;"
                            class="btn btn-outline-primary btn-block waves-effect waves-light"
                            type="submit"
                            name="btn_submit"
                          >
                          SIGN IN
                          </button>
                        </div>
                        <div class="mt-3">
                          <a href="auth_register.php" class="text-muted"
                            ><i class="mdi mdi-account-circle mr-1"></i> Create
                            an account</a
                          >
                        </div>
                        <div class="mt-2">
                          <a href="auth-recoverpw.html" class="text-muted"
                            ><i class="mdi mdi-lock"></i> Forgot your
                            password?</a
                          >
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- end row -->
      </div>
    </div>
    <!-- end Account pages -->

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
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
  echo "<script>alert('please Verify you one time password!');location.href='otp.php';</script>";
    
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