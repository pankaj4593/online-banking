<script type="text/javascript">
    function sweetAlertSuccess() {
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Message Sent",
            showConfirmButton: !1,
            timer: 1500
        });
    }

    function accountSame() {
        Swal.fire({
            title: "Can't Sent Request",
            text: "username or password is incorrect !",
            icon: "error"
        });
    }

    function wrongAccount() {
        Swal.fire({
            title: "Can't Sent Request",
            text: "Account Number is not Registered",
            icon: "error"
        });
    }

    function amountLimit() {
        Swal.fire({
            title: "Can't Sent Request",
            text: "Limit of Request money is 500 to 20,000",
            icon: "error"
        });
    }
</script>


<?php
    include('connect.php');
                       session_start();
                       // if Session is getting account_no then user can access index.php else require login
                       if(isset($_SESSION["s_account_no"]) && isset($_SESSION['s_login']))
                       {
                           $Account_no = $_SESSION["s_account_no"];
                           // For Getting Customer Details
                           $query_customer = "SELECT * FROM tbl_customer WHERE account_no='$Account_no'";
                           $result_customer = mysqli_query($con, $query_customer);
                           $row_customer = mysqli_fetch_array($result_customer);
                       } else {
                           header("location:http://localhost/online-banking/site/dist/auth_login.php");
                       }

                   ?>

    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Request Money</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Summernote css -->
        <link href="assets/libs/summernote/summernote-bs4.css" rel="stylesheet" type="text/css" />

        <!-- Sweet Alert-->
        <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
        <!-- Sweet Alert-->
        <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <!-- auto logout script -->
    <script src="assets/js_autolog/script.js"></script>
    </head>

    <body data-topbar="dark" data-layout="horizontal">

        <!-- Begin page -->
        <div id="layout-wrapper">
            <?php
                                                                                                include "header-sidebar.php"
                                                                                                ?>

                <!-- ============================================================== -->
                <!-- Start right Content here -->
                <!-- ============================================================== -->
                <div class="main-content">

                    <div class="page-content">
                        <div class="container-fluid">

                            <!-- start page title -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title-box d-flex align-items-center justify-content-between">
                                        <h4 class="mb-0 font-size-18">Request Money</h4>

                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">Apaxy</a></li>
                                                <li class="breadcrumb-item active">Request Money</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title -->

                            <div class="row mb-4">
                                <div class="col-xl-3">
                                    <div class="card">
                                        <div class="card-body email-leftbar">
                                            <a href="request_money.php" class="btn btn-danger btn-block btn-rounded waves-effect waves-light"><i class="mdi mdi-plus mr-1"></i> New Request</a>

                                            <div class="mail-list mt-4">
                                                <?php
                                                                                                                                                $query_for_no_of_requests = "SELECT * FROM tbl_requests where to_account = $Account_no";
                                                                                                                                                $no_of_requests_result = mysqli_query($con,$query_for_no_of_requests);
                                                                                                                                                $no_of_requests = mysqli_num_rows($no_of_requests_result);
                                                                                                                                            ?>
                                                    <a href="inbox.php"><i class="mdi mdi-inbox mr-2"></i> Inbox <span class="ml-1 float-right">(<?php echo $no_of_requests; ?>)</span></a>
                                                    <a href="send_requests.php"><i class="mdi mdi-send-check-outline mr-2"></i>Send Requests</a>
                                            </div>


                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-9">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="btn-toolbar" role="toolbar">
                                                <div class="btn-group mr-2 mb-3">
                                                    <button type="button" class="btn btn-primary waves-light waves-effect"><i class="fa fa-inbox"></i></button>
                                                    <button type="button" class="btn btn-primary waves-light waves-effect"><i class="fa fa-exclamation-circle"></i></button>
                                                    <button type="button" class="btn btn-primary waves-light waves-effect"><i class="far fa-trash-alt"></i></button>
                                                </div>
                                                <div class="btn-group mr-2 mb-3">
                                                    <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                                                                                                    <i class="fa fa-folder"></i> <i class="mdi mdi-chevron-down ml-1"></i>
                                                                                                                                                </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Updates</a>
                                                        <a class="dropdown-item" href="#">Social</a>
                                                        <a class="dropdown-item" href="#">Team Manage</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="btn-toolbar justify-content-md-end" role="toolbar">
                                                <div class="btn-group ml-md-2 mb-3">
                                                    <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                                                                                                    <i class="fa fa-tag"></i> <i class="mdi mdi-chevron-down ml-1"></i>
                                                                                                                                                </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#">Updates</a>
                                                        <a class="dropdown-item" href="#">Social</a>
                                                        <a class="dropdown-item" href="#">Team Manage</a>
                                                    </div>
                                                </div>

                                                <div class="btn-group ml-2 mb-3">
                                                    <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                                                                                                    More <i class="mdi mdi-dots-vertical ml-1"></i>
                                                                                                                                                </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#">Mark as Unread</a>
                                                        <a class="dropdown-item" href="#">Mark as Important</a>
                                                        <a class="dropdown-item" href="#">Add to Tasks</a>
                                                        <a class="dropdown-item" href="#">Add Star</a>
                                                        <a class="dropdown-item" href="#">Mute</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card mb-0">
                                        <div class="card-body">
                                            <form class="custom-validation" action="#" method="post">

                                                <div class="form-group">

                                                    <label>Account Number</label>
                                                    <!-- <input name="txt_to_account" data-parsley-type="digits" type="text" class="form-control" required placeholder="Account Number" /> -->
                                                    <select name="txt_purpose" class="select2 form-control custom-select" type="text" placeholder="Name of Beneficial" required="">
                                                        <option value="">Select</option>
                                                        <option value="">454554545874</option>
                                                       
                                                </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Amount</label>
                                                    <div>
                                                        <input name="txt_amount" data-parsley-type="digits" type="text" class="form-control" required placeholder="Amount" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="subject-input">Your Message</label>
                                                    <div>
                                                        <textarea name="txt_message" required class="form-control" rows="5" required>Hey There! i really need money for some time</textarea>
                                                    </div>
                                                </div>

                                                <div class="btn-toolbar form-group mb-0">
                                                    <div class="">
                                                        <button type="button" class="btn btn-success waves-effect waves-light mr-1"><i class="far fa-save"></i></button>
                                                        <button type="button" class="btn btn-success waves-effect waves-light mr-1"><i class="far fa-trash-alt"></i></button>
                                                        <button name="btn_send" type="submit" class="btn btn-primary waves-effect waves-light"> <span>Send</span> <i class="fab fa-telegram-plane ml-1"></i> </button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                    <!-- end card -->

                                </div>
                            </div>
                            <!-- end row -->

                        </div>
                        <!-- container-fluid -->
                    </div>
                    <!-- End Page-content -->
                </div>
                <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
        <div class="right-bar">
            <div data-simplebar class="h-100">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-tabs-custom rightbar-nav-tab nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link py-3 active" data-toggle="tab" href="#chat-tab" role="tab">
                            <i class="mdi mdi-message-text font-size-22"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-3" data-toggle="tab" href="#tasks-tab" role="tab">
                            <i class="mdi mdi-format-list-checkbox font-size-22"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-3" data-toggle="tab" href="#settings-tab" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                            <i class="mdi mdi-settings font-size-22"></i>
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content text-muted">
                    <div class="tab-pane active" id="chat-tab" role="tabpanel">

                        <form class="search-bar py-4 px-3">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="mdi mdi-magnify"></span>
                            </div>
                        </form>

                        <h6 class="font-weight-medium px-4 mt-2 text-uppercase">Group Chats</h6>

                        <div class="p-2">
                            <a href="javascript: void(0);" class="text-reset notification-item pl-3 mb-2 d-block">
                                <i class="mdi mdi-checkbox-blank-circle-outline mr-1 text-success"></i>
                                <span class="mb-0 mt-1">App Development</span>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item pl-3 mb-2 d-block">
                                <i class="mdi mdi-checkbox-blank-circle-outline mr-1 text-warning"></i>
                                <span class="mb-0 mt-1">Office Work</span>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item pl-3 mb-2 d-block">
                                <i class="mdi mdi-checkbox-blank-circle-outline mr-1 text-danger"></i>
                                <span class="mb-0 mt-1">Personal Group</span>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item pl-3 d-block">
                                <i class="mdi mdi-checkbox-blank-circle-outline mr-1"></i>
                                <span class="mb-0 mt-1">Freelance</span>
                            </a>
                        </div>

                        <h6 class="font-weight-medium px-4 mt-4 text-uppercase">Favourites</h6>

                        <div class="p-2">
                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="media">
                                    <div class="position-relative mr-3">
                                        <img src="assets/images/users/avatar-10.jpg" class="rounded-circle avatar-xs" alt="user-pic">
                                        <i class="mdi mdi-circle user-status online"></i>
                                    </div>
                                    <div class="media-body overflow-hidden">
                                        <h6 class="mt-0 mb-1">Andrew Mackie</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-0 text-truncate">It will seem like simplified English.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="media">
                                    <div class="position-relative mr-3">
                                        <img src="assets/images/users/avatar-1.jpg" class="rounded-circle avatar-xs" alt="user-pic">
                                        <i class="mdi mdi-circle user-status away"></i>
                                    </div>
                                    <div class="media-body overflow-hidden">
                                        <h6 class="mt-0 mb-1">Rory Dalyell</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-0 text-truncate">To an English person, it will seem like simplified</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="media">
                                    <div class="position-relative mr-3">
                                        <img src="assets/images/users/avatar-9.jpg" class="rounded-circle avatar-xs" alt="user-pic">
                                        <i class="mdi mdi-circle user-status busy"></i>
                                    </div>
                                    <div class="media-body overflow-hidden">
                                        <h6 class="mt-0 mb-1">Jaxon Dunhill</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-0 text-truncate">To achieve this, it would be necessary.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <h6 class="font-weight-medium px-4 mt-4 text-uppercase">Other Chats</h6>

                        <div class="p-2 pb-4">
                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="media">
                                    <div class="position-relative mr-3">
                                        <img src="assets/images/users/avatar-2.jpg" class="rounded-circle avatar-xs" alt="user-pic">
                                        <i class="mdi mdi-circle user-status online"></i>
                                    </div>
                                    <div class="media-body overflow-hidden">
                                        <h6 class="mt-0 mb-1">Jackson Therry</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-0 text-truncate">Everyone realizes why a new common language.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="media">
                                    <div class="position-relative mr-3">
                                        <img src="assets/images/users/avatar-4.jpg" class="rounded-circle avatar-xs" alt="user-pic">
                                        <i class="mdi mdi-circle user-status away"></i>
                                    </div>
                                    <div class="media-body overflow-hidden">
                                        <h6 class="mt-0 mb-1">Charles Deakin</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-0 text-truncate">The languages only differ in their grammar.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="media">
                                    <div class="position-relative mr-3">
                                        <img src="assets/images/users/avatar-5.jpg" class="rounded-circle avatar-xs" alt="user-pic">
                                        <i class="mdi mdi-circle user-status online"></i>
                                    </div>
                                    <div class="media-body overflow-hidden">
                                        <h6 class="mt-0 mb-1">Ryan Salting</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-0 text-truncate">If several languages coalesce the grammar of the resulting.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="media">
                                    <div class="position-relative mr-3">
                                        <img src="assets/images/users/avatar-6.jpg" class="rounded-circle avatar-xs" alt="user-pic">
                                        <i class="mdi mdi-circle user-status online"></i>
                                    </div>
                                    <div class="media-body overflow-hidden">
                                        <h6 class="mt-0 mb-1">Sean Howse</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-0 text-truncate">It will seem like simplified English.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="media">
                                    <div class="position-relative mr-3">
                                        <img src="assets/images/users/avatar-7.jpg" class="rounded-circle avatar-xs" alt="user-pic">
                                        <i class="mdi mdi-circle user-status busy"></i>
                                    </div>
                                    <div class="media-body overflow-hidden">
                                        <h6 class="mt-0 mb-1">Dean Coward</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-0 text-truncate">The new common language will be more simple.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="media">
                                    <div class="position-relative mr-3">
                                        <img src="assets/images/users/avatar-8.jpg" class="rounded-circle avatar-xs" alt="user-pic">
                                        <i class="mdi mdi-circle user-status away"></i>
                                    </div>
                                    <div class="media-body overflow-hidden">
                                        <h6 class="mt-0 mb-1">Hayley East</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-0 text-truncate">One could refuse to pay expensive translators.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>

                    <div class="tab-pane" id="tasks-tab" role="tabpanel">
                        <h6 class="font-weight-medium px-3 mb-0 mt-4">Working Tasks</h6>

                        <div class="p-2">
                            <a href="javascript: void(0);" class="text-reset item-hovered d-block p-3">
                                <p class="text-muted mb-0">App Development<span class="float-right">75%</span></p>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset item-hovered d-block p-3">
                                <p class="text-muted mb-0">Database Repair<span class="float-right">37%</span></p>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 37%" aria-valuenow="37" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset item-hovered d-block p-3">
                                <p class="text-muted mb-0">Backup Create<span class="float-right">52%</span></p>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 52%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </a>
                        </div>

                        <h6 class="font-weight-medium px-3 mb-0 mt-4">Upcoming Tasks</h6>

                        <div class="p-2">
                            <a href="javascript: void(0);" class="text-reset item-hovered d-block p-3">
                                <p class="text-muted mb-0">Sales Reporting<span class="float-right">12%</span></p>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 12%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset item-hovered d-block p-3">
                                <p class="text-muted mb-0">Redesign Website<span class="float-right">67%</span></p>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 67%" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset item-hovered d-block p-3">
                                <p class="text-muted mb-0">New Admin Design<span class="float-right">84%</span></p>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 84%" aria-valuenow="84" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </a>
                        </div>

                        <div class="p-3 mt-2">
                            <a href="javascript: void(0);" class="btn btn-success btn-block waves-effect waves-light">Create Task</a>
                        </div>

                    </div>
                    <div class="tab-pane" id="settings-tab" role="tabpanel">
                        <h6 class="font-weight-medium px-4 py-3 text-uppercase bg-light">General Settings</h6>

                        <div class="p-4">
                            <h6 class="font-weight-medium">Online Status</h6>
                            <div class="custom-control custom-switch mb-1">
                                <input type="checkbox" class="custom-control-input" id="settings-check1" name="settings-check1" checked="">
                                <label class="custom-control-label font-weight-normal" for="settings-check1">Show your status to all</label>
                            </div>

                            <h6 class="font-weight-medium mt-4">Auto Updates</h6>
                            <div class="custom-control custom-switch mb-1">
                                <input type="checkbox" class="custom-control-input" id="settings-check2" name="settings-check2" checked="">
                                <label class="custom-control-label font-weight-normal" for="settings-check2">Keep up to date</label>
                            </div>

                            <h6 class="font-weight-medium mt-4">Backup Setup</h6>
                            <div class="custom-control custom-switch mb-1">
                                <input type="checkbox" class="custom-control-input" id="settings-check3" name="settings-check3">
                                <label class="custom-control-label font-weight-normal" for="settings-check3">Auto backup</label>
                            </div>

                        </div>

                        <h6 class="font-weight-medium px-4 py-3 mt-2 text-uppercase bg-light">Advanced Settings</h6>

                        <div class="p-4">
                            <h6 class="font-weight-medium">Application Alerts</h6>
                            <div class="custom-control custom-switch mb-1">
                                <input type="checkbox" class="custom-control-input" id="settings-check4" name="settings-check4" checked="">
                                <label class="custom-control-label font-weight-normal" for="settings-check4">Email Notifications</label>
                            </div>

                            <div class="custom-control custom-switch mb-1">
                                <input type="checkbox" class="custom-control-input" id="settings-check5" name="settings-check5">
                                <label class="custom-control-label font-weight-normal" for="settings-check5">SMS Notifications</label>
                            </div>

                            <h6 class="font-weight-medium mt-4">API</h6>
                            <div class="custom-control custom-switch mb-1">
                                <input type="checkbox" class="custom-control-input" id="settings-check6" name="settings-check6">
                                <label class="custom-control-label font-weight-normal" for="settings-check6">Enable access</label>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <!-- Summernote js -->
        <script src="assets/libs/summernote/summernote-bs4.min.js"></script>

        <!-- email summernote init -->
        <script src="assets/js/pages/email-summernote.init.js"></script>

        <!-- Sweet Alerts js -->
        <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
        <!-- Sweet alert init js-->
        <script src="assets/js/pages/sweet-alerts.init.js"></script>

        <script src="assets/js/app.js"></script>

        <!-- parsleyjs -->
        <script src="assets/libs/parsleyjs/parsley.min.js"></script>
        <!-- validation init -->
        <script src="assets/js/pages/form-validation.init.js"></script>

        <script src="assets/js/app.js"></script>


    </body>

    </html>




    <?php

                                                                                                    if(isset($_REQUEST['btn_send']))
                                                                                                    {
                                                                                                        $Account_no = $_SESSION["s_account_no"];
                                                                                                        $to_account = $_REQUEST['txt_to_account'];
                                                                                                        $amount = $_REQUEST['txt_amount'];
                                                                                                        $message = $_REQUEST['txt_message'];
                                                                                                        $hasViewed = 0;
                                                                                                        $status = 'ignore';
                                                                                                        $Req_date = date("Y-m-d H:i:s");

                                                                                                        $query_for_check_To_Account_no = mysqli_query($con,"SELECT account_no FROM  tbl_account WHERE account_no=$to_account");
                                                                                                        $result_to_account = mysqli_num_rows($query_for_check_To_Account_no);

                                                                                                        if ($to_account == $Account_no)
                                                                                                        {
                                                                                                            // echo "You can not send request to self";
                                                                                                            echo '<script type="text/JavaScript">  
                                                                                                            sameAccount();
                                                                                                            </script>' 
                                                                                                            ;
                                                                                                        }
                                                                                                        
                                                                                                        elseif ($result_to_account != 1) 
                                                                                                                            {
                                                                                                                                // echo "Account no " . $to_account . " not Available";
                                                                                                                                echo '<script type="text/JavaScript">  
                                                                                                                                wrongAccount();
                                                                                                                                </script>' 
                                                                                                                                ;
                                                                                                                            }
                                                                                                                                            elseif($amount > 20000 || $amount < 500)
                                                                                                                                            {
                                                                                                                                                echo '<script type="text/JavaScript">  
                                                                                                                                                amountLimit();
                                                                                                                                                </script>' 
                                                                                                                                                ;
                                                                                                                                            }
                                                                                                                                            else
                                                                                                                                            {
                                                                                                                                                $query_for_insert_request = "INSERT INTO tbl_requests (account_no, to_account, amount, message, hasViewed, status, request_date) VALUES ($Account_no, $to_account, $amount, '$message'
                                                                                                                                                , $hasViewed, '$status','$Req_date')";
                                                                                                                                                $result = mysqli_query($con, $query_for_insert_request) or die('SQL Error :: '.mysqli_error());

                                                                                                                                                echo '<script type="text/JavaScript">  
                                                                                                                                                sweetAlertSuccess();
                                                                                                                                                </script>' 
                                                                                                            ;
                                                                                                        }
                                                                                                        
                                                                                                    }