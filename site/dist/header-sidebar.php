<!-- gettign notification    by php code -->
<?php
session_start();
$file_path=include('connect.php')   ;
if($file_path)
{ 
    // echo "<script>alert('file is located');</script>"; 
}
else
{
    echo "<script>alert('file is  not located');</script>";
}
?>
    <?php
if(isset($_SESSION["s_account_no"]) && isset($_SESSION['s_login']))
{
    $Account_no = $_SESSION["s_account_no"];
   $query=mysqli_query($con,"select * from tbl_requests where account_no='$Account_no'  ");
   $count=mysqli_num_rows($query);
}
?>


        <script type="text/javascript">
            var auto_refresh = setInterval(getData, 10000); // refresh every 10 seconds
            function getData() {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.open("GET", "get_auth_dat.php", true);
                xmlhttp.send();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {

                        document.getElementById("load_div").innerHTML = this.responseText;
                    }
                };

            }
        </script>


        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
        <!-- auto logout script -->
        <script src="assets/js_autolog/script.js"></script>

        <style>
            #page-topbar {
                background: #fff;
                box-shadow: 0 0 13px 0 rgb(82 63 105 / 5%);
                left: 0;
                position: fixed;
                right: 0;
                top: 0;
                z-index: 1;
                height: 60px;
                border-radius: 0 0 20px 20px;
                background-color: white !important;
            }
            
            .vertical-menu {
                background-color: #fff;
                bottom: 0;
                left: 0;
                margin-top: 0;
                top: 90px;
                transition: all 0.2s ease-in-out 0s;
                z-index: 1001;
                border-top-right-radius: 20px;
                box-shadow: 0 0 13px 0 rgb(82 63 105 / 5%);
                overflow-y: hidden;
            }
            
            body[data-topbar=colored] .header-item,
            body[data-topbar=dark] .header-item {
                color: black;
            }
            
            body[data-topbar=colored] .noti-icon i,
            body[data-topbar=dark] .noti-icon i {
                color: black;
            }
            
            #sidebar-menu ul li a {
                color: black;
            }
            
            .card {
                background: #fff;
                /* -webkit-box-shadow: 0 0 13px 0 rgb(82 63 105 / 5%); */
                box-shadow: 0 0 13px 0 rgb(82 63 105 / 5%);
                margin-bottom: 30px;
                border-radius: 20px;
                border: 1px solid #E5E5E5 !important;
                box-shadow: 8px 8px 15px #d4d4d4, -8px -8px 15px #ffffff;
            }
            
            body[data-layout=horizontal] .page-content {
                margin-top: 0px;
                padding: calc(70px + 24px) calc(24px / 2) 60px calc(24px / 2);
            }
            
            .navbar-brand-box {
                width: 250px !important;
            }
            
            .dropdown-menu {
                border: 1px solid #eff2f7;
                border-radius: .8rem;
                transform-origin: left top 0;
                background-color: #fff;
                box-shadow: 0 0 1.25rem rgb(31 45 61 / 8%);
            }
            
            body {
                background-color: white;
                font-family: 'Nunito', sans-serif;
            }
            
            h1,
            h2,
            h3,
            h4,
            h5,
            h6 {
                font-weight: 800;
            }
            .progress{
                height:14px !important;
            }
            
        </style>

        <header id="page-topbar" style="border:1px solid #E5E5E5 !important;box-shadow:  5px 5px 10px #e8e8e8,
-5px -5px 10px #ffffff;">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="index.php" class="logo logo-dark">
                            <span class="logo-sm">
                                    <img src="http://bigit.io/images/logo.png" alt="" height="22">
                                </span>
                            <span class="logo-lg">
                                    <img src="http://bigit.io/images/logo.png" alt="" height="20">
                                </span>
                        </a>

                        <a href="index.php" class="logo logo-light">
                            <span class="logo-sm">
                                    <img src="http://bigit.io/images/logo.png" alt="" height="22">
                                </span>
                            <span class="logo-lg">
                                    <img src="http://bigit.io/images/logo.png" alt="" height="20">
                                </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                            <i class="mdi mdi-backburger"></i>
                        </button>

                    <!-- App Search-->
                    <!-- <form class="app-search d-none d-lg-block">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="mdi mdi-magnify"></span>
                            </div>
                        </form> -->
                </div>

                <div class="d-flex">

                    <div class="dropdown d-inline-block d-lg-none ml-2">
                        <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-magnify"></i>
                            </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0" aria-labelledby="page-header-search-dropdown">

                            <form class="p-3">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>




                    <div class="dropdown d-inline-block" id="load_div">
                        <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-bell-outline"></i>
                                <span class="badge badge-danger badge-pill" style="right: 0;"><?=$count?></span>
                            </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0" aria-labelledby="page-header-notifications-dropdown">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0 font-weight-medium text-uppercase">Notifications </h6>
                                    </div>
                                    <div class="col-auto">
                                        <span class="badge badge-pill badge-primary">New <?=$count?></span>
                                    </div>
                                </div>
                            </div>
                            <div data-simplebar style="max-height: 230px;">
                                <?php
                    while($data=mysqli_fetch_array($query))
                    {
                        ?>
                                    <a href="" class="text-reset notification-item">
                                        <div class="media">
                                            <span class="fa fa-user rounded-circle avatar-xs" style="font-size:15px; color:blue;"> </span>
                                            <div class="media-body">
                                                <h6 class="mt-0 mb-1">Account No-
                                                    <?=$data['account_no']?>
                                                </h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">
                                                        <?=$data['message']?>
                                                    </p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i>
                                                        <?=$data['request_date']?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <?php
                    }
                    ?>
                                        <!-- <a href="" class="text-reset notification-item">
                            <div class="media">
                                <div class="avatar-xs mr-3">
                                    <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                    <i class="mdi mdi-cart"></i>
                                                </span>
                                </div>
                               
                        </a> -->


                                        <!-- <a href="" class="text-reset notification-item">
                            <div class="media">
                                <img src="assets/images/users/avatar-4.jpg" class="mr-3 rounded-circle avatar-xs" alt="user-pic">
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1">Dominic Kellway</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">As a skeptical Cambridge friend of mine occidental.</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                    </div>
                                </div>
                            </div>
                        </a> -->
                            </div>
                            <div class="p-2 border-top">
                                <a class="btn-link btn btn-block text-center" href="javascript:void(0)">
                                    <i class="mdi mdi-arrow-down-circle mr-1"></i> Load More..
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <!-- <img class="rounded-circle header-profile-user" src="assets/images/users/avatar-1.jpg"
                                    alt="Header Avatar"> -->
                                     
                                <span class="d-none d-sm-inline-block ml-1"><?php echo $row_customer['full_name'] ?></span>
                                <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                            </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- item-->
                            <a class="dropdown-item" href="profile.php"><i class="mdi mdi-face-profile font-size-16 align-middle mr-1"></i> Profile</a>
                            <a class="dropdown-item" href="#"><i class="mdi mdi-account-settings font-size-16 align-middle mr-1"></i> Settings</a>
                            <a class="dropdown-item" href="http://localhost/online-banking/site/dist/auth_login.php"><i class="mdi mdi-logout font-size-16 align-middle mr-1"></i>Logout</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu" style="border:1px solid #E5E5E5 !important;box-shadow:  5px 5px 10px #e8e8e8,
-5px -5px 10px #ffffff;">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title">Menu</li>

                        <li>
                            <a href="index.php" class="waves-effect">
                                <i class="mdi mdi-view-dashboard"></i>
                                <span>Home</span>
                            </a>
                        </li>

                        <li>
                            <a href="quick_transfer.php" class=" waves-effect">
                                <i class="mdi mdi-calendar-month"></i>
                                <span>Transfers</span>
                            </a>
                        </li>
                        <!-- makign new meinu  -->
                        <li>
                            <a href="list.php" class=" waves-effect">
                                <i class="fa  fa-list"></i>
                                <span>List Of Beneficiary </span>
                            </a>
                        </li>
                        <!-- end new meinu -->

                        <li>
                            <a href="inbox.php" class="waves-effect">
                                <i class="mdi mdi-account-group"></i>
                                <span>Request Money </span>
                            </a>
                        </li>



                        <!-- <li>
                                <a href="analysis.php" class="waves-effect">
                                    <i class="mdi mdi-chart-areaspline-variant"></i>
                                    <span>Analysis</span>
                                </a>
                            </li> -->
                        <!-- <li>
                                <a href="manage_feedback.php" class="waves-effect">
                                    <i class="mdi mdi-heart-outline"></i>
                                    <span>Cheque Book Requests</span>
                                </a>
                            </li> -->

                        
                        <li>
                            <a href="statement.php" class="waves-effect">
                                <i class="fas fa-file-alt"></i>
                                <span>Statement</span>
                            </a>
                        </li>
                        <li>
                            <a href="credential.php" class="waves-effect">
                                <i class="fa fa-cog"></i>
                                <span>Credential Setting</span>
                            </a>
                        </li>
                        <li>
                            <a href="feedback.php" class="waves-effect">
                                <i class="mdi mdi-heart-outline"></i>
                                <span>Feedback</span>
                            </a>
                        </li>

                </div>
                <!-- Sidebar -->
            </div>
        </div>