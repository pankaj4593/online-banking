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
    <script >
function valid()
{
if(document.chngpwd.opwd.value=="")
{
alert("Old Password Filed is Empty !!");
document.chngpwd.opwd.focus();
return false;
}
else if(document.chngpwd.npwd.value=="")
{
alert("New Password Filed is Empty !!");
document.chngpwd.npwd.focus();
return false;
}
else if(document.chngpwd.cpwd.value=="")
{
alert("Confirm Password Filed is Empty !!");
document.chngpwd.cpwd.focus();
return false;
}
else if(document.chngpwd.npwd.value!= document.chngpwd.cpwd.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.chngpwd.cpwd.focus();
return false;
}
return true;
}
</script>
</head>
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

            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="p-2">
                                <h5 class="mb-5 text-center">Reset Password</h5>
                                <form class="form-horizontal" action="">

                                    <div class="row">
                                        <div class="col-md-12">
                                            

                                            <div class="form-group mt-4">
                                                <label for="useremail">Current Password</label>
                                                <input type="text" class="form-control" id="useremail" name="opwd" placeholder="Enter email">
                                            </div>
                                            <div class="form-group mt-4">
                                                <label for="useremail">New Password</label>
                                                <input type="text" class="form-control"  name="npwd" id="useremail" placeholder="Enter email">
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

    <script src="assets/js/app.js"></script>

</body>

</html>
<?php

// if Session is getting account_no then user can access index.php else require login
if(isset($_SESSION["s_account_no"]) && isset($_SESSION['s_login']))
include("connect.php");
if(isset($_POST['Submit']))
{
 $oldpass=$_POST['opwd'];

 $newpassword=$_POST['npwd'];
$sql=mysqli_query($con,"SELECT password tbl_account where password='$oldpass' ");
$num=mysqli_fetch_array($sql);
if($num>0)
{
 $con=mysqli_query($con,"update tbl_account set password=' $newpassword' ");
//$_SESSION['msg1']="Password Changed Successfully !!";
}
else
{
//$_SESSION['msg1']="Old Password not match !!";
}
}
?>