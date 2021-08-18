<script type="text/javascript">
    function wrongAuth() {
        Swal.fire({
            title: "Login Failed",
            text: "Admin Id or password is incorrect !",
            icon: "error"
        });
    }

    function rightAuth() {
        location.replace("http://localhost/online-banking/admin/dist/index.php");
    }
</script>
<?php

  include('connect.php');
  session_start();
  session_unset();
  session_destroy();

  
  session_start();
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Admin Login</title>
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
    <style>
        .card {
            border-radius: 22px;
            background: #ffffff;
            box-shadow: -2px -2px 9px #d4d4d4, 0px 0px 0px #ffffff;
        }
    </style>

    <body class="" style="background-image: url(https://i.imgur.com/3hXohqn.png);background-repeat: no-repeat;background-position: center;background-size: cover;">

        <div class="account-pages pt-5">
            <div class="container">
                <!-- end row -->

                <div class="row justify-content-center mt-4">


                    <div class="col-lg-5">
                        <img style="width: 100%;" src="https://media.istockphoto.com/vectors/bank-modern-thin-line-design-style-vector-illustration-vector-id1031507604?k=6&m=1031507604&s=612x612&w=0&h=bnJDD3qU81dUXV5wKgKM39icU8b-BU29z1vEgdr0rCw=" alt="">



                    </div>


                    <div class="col-lg-7">
                        <div class="card" style="width: 70%;">
                            <div class="card-body p-4">
                                <div class="p-2">
                                    <h1 class="mb-5 text-center">
                                        SIGN IN TO ADMIN
                                    </h1>
                                    <form class="form-horizontal" method="post">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group mb-4">
                                                    <label for="id">Admin ID</label>
                                                    <input type="text" class="form-control" id="adminId" name='txt_adminid' placeholder="Enter admin Id" value="" required />
                                                </div>
                                                <div class="form-group mb-4">
                                                    <label for="userpassword">Password</label>
                                                    <input type="password" class="form-control" id="userpassword" name="txt_password" placeholder="Enter password" required />
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
                            <div class="text-md-right mt-3 mt-md-0">
                              <a href="auth-recoverpw.html" class="text-muted"
                                ><i class="mdi mdi-lock"></i> Forgot your
                                password?</a
                              >
                            </div>
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
                        <div class="mt-4 ">
                          <a href="auth-register.php" class="text-muted"
                            ><i class="mdi mdi-account-circle mr-1"></i> Create
                            an account</a
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
    $Admin_id = $_REQUEST["txt_adminid"];
    $Password = $_REQUEST["txt_password"];
    $query = "SELECT admin_id, password FROM tbl_admin WHERE admin_id = '$Admin_id' AND  password='$Password' ";
    $result1 = mysqli_query($con,$query);
    $row = mysqli_fetch_assoc($result1);

    if(mysqli_num_rows($result1) > 0 )
    {
      $_SESSION['s_admin_id'] = $Admin_id;
      header("location:https://localhost/online-banking/admin/dist/index.php");
      echo '<script type="text/JavaScript">  
              rightAuth();
             </script>' 
              ;
    }
    else
    {
      echo '<script type="text/JavaScript">  
              wrongAuth();
             </script>' 
              ;
    }
  }
?>