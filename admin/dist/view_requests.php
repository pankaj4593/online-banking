<!-- Tow Fileds Request Approved and Request Ignored -->
<?php
    include('connect.php');
    session_start();
    // if Session is getting account_no then user can access index.php else require login
    if(isset($_SESSION["s_admin_id"]))
    {
        $Admin_id = $_SESSION["s_admin_id"];
        // For Getting Admin Details
        $query_admin = "SELECT * FROM tbl_admin WHERE admin_id=$Admin_id";
        $result_admin = mysqli_query($con, $query_admin);
        $row_admin_detail = mysqli_fetch_array($result_admin);

        // For Getting All Customers Details
        // $query_for_customer_details = "SELECT * FROM tbl_customer";
        // $customers_details = mysqli_query($con,$query_for_customer_details);
        // $row_customer_detail = mysqli_fetch_array($customers_details);

        // $no_of_customer
        $query_for_no_of_requests = "SELECT * FROM tbl_requests";
        $result_no_of_requests = mysqli_query($con,$query_for_no_of_requests);
        $total_requests = mysqli_num_rows($result_no_of_requests); 

        // $debit_count
        $query_for_approved_requests = "SELECT * FROM tbl_requests where status='sent'";
        $result_no_of_approved_requests = mysqli_query($con,$query_for_approved_requests);
        $total_approved = mysqli_num_rows($result_no_of_approved_requests);

        // $credit_count
        $query_for_ignored_requests = "SELECT * FROM tbl_requests where status='ignore'";
        $result_no_of_ignored_requests = mysqli_query($con,$query_for_ignored_requests);
        $total_ignored= mysqli_num_rows($result_no_of_ignored_requests); 
        if($total_ignored == null)
        {
            $total_ignored = 0;
        }
        
    } else {
        header("location:http://localhost/online-banking/admin/dist/auth-login.php");
    }

?>


    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>View Requests</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- slick css -->
        <link href="assets/libs/slick-slider/slick/slick.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/slick-slider/slick/slick-theme.css" rel="stylesheet" type="text/css" />

        <!-- jvectormap -->
        <link href="assets/libs/jqvmap/jqvmap.min.css" rel="stylesheet" />

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body data-sidebar="dark">

        <!-- Begin page -->
        <div id="layout-wrapper">

            <?php

            include "header-sidepanel.php"
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
                                        <h4 class="mb-0 font-size-18">Requests Dashboard</h4>

                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                                <li class="breadcrumb-item active">Requests</li>
                                            </ol>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- end page title -->

                            <div class="row">
                                <div class="col-sm-6 col-xl-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="media">
                                                <div class="media-body">
                                                    <h5 class="font-size-14">Number of Requests</h5>
                                                </div>
                                                <div class="avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="dripicons-box"></i>
                                                </span>
                                                </div>
                                            </div>
                                            <h4 class="m-0 align-self-center">
                                                <?php echo $total_requests ?>
                                            </h4>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xl-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="media">
                                                <div class="media-body">
                                                    <h5 class="font-size-14">Approved Requests</h5>
                                                </div>
                                                <div class="avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="dripicons-briefcase"></i>
                                                </span>
                                                </div>
                                            </div>
                                            <h4 class="m-0 align-self-center">
                                                <?php echo $total_approved?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xl-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="media">
                                                <div class="media-body">
                                                    <h5 class="font-size-14">Ignored Requests</h5>
                                                </div>
                                                <div class="avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="dripicons-tags"></i>
                                                </span>
                                                </div>
                                            </div>
                                            <h4 class="m-0 align-self-center">
                                                <?php echo $total_ignored?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <!-- end row -->


                            <div class="card mb-0">
                                <div class="card-body">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs nav-justified nav-tabs-custom" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#custom-primary" role="tab">
                                                <i class="mdi mdi-inbox mr-2 align-middle font-size-18"></i> <span class="d-none d-md-inline-block">Approved Requests</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#custom-social" role="tab">
                                                <i class="mdi mdi-account-group-outline mr-2 align-middle font-size-18"></i> <span class="d-none d-md-inline-block"> Ignored Requests</span>
                                            </a>
                                        </li>

                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content pt-3">
                                        <div class="tab-pane active" id="custom-primary" role="tabpanel">
                                            <ul class="message-list mb-0">
                                                <?php
                                                    // For transactions in Home Page(index page)
                                                    $query_for_request = "SELECT * FROM tbl_requests where status='sent' ORDER BY request_date DESC ";
                                                    $request_result = mysqli_query($con,$query_for_request);
                                                    $no_of_requests = mysqli_num_rows($request_result);

                                                    while($row = mysqli_fetch_array($request_result)) {
                                                        $from_account = $row['account_no'];
                                                        $query_for_from_account = "SELECT full_name FROM tbl_customer WHERE account_no=$from_account";
                                                        $result_ben_name = mysqli_query($con, $query_for_from_account);
                                                        $sender_name = mysqli_fetch_array($result_ben_name)[0];

                                                        $first_sender_name = strtok($sender_name, " ");

                                                        $to_account = $row['to_account'];
                                                        $query_for_to_account = "SELECT full_name FROM tbl_customer WHERE account_no=$to_account";
                                                        $result_to_account = mysqli_query($con, $query_for_to_account);
                                                        $reciver_name = mysqli_fetch_array($result_to_account)[0];

                                                        $first_reciver_name = strtok($reciver_name, " ");

                                                        $date_format = $row["request_date"];
                                                        $date_format=substr($date_format, 0, 10);


                                                        $unread = 'class="unread"';

                                                        if($row['status'] != 'sent')
                                                        {
                                                            $badge_color = "badge-danger";
                                                        } else {
                                                            $badge_color = "badge-success";
                                                        }
                                                        
                                                        echo '
                                                        <li '.$unread.'>
                                                        <div class="col-mail col-mail-1">
                                                            <div class="checkbox-wrapper-mail">
                                                                <input type="checkbox" id="chk16">
                                                                <label for="chk16" class="toggle"></label>
                                                            </div>
                                                            <a href="view_request_read.php?request_id='.$row['request_id'].'" class="title">'.$first_sender_name.' To '.$first_reciver_name.'</a>
                                                        </div>
                                                        <div class="col-mail col-mail-2">
                                                            <a href="view_request_read.php?request_id='.$row['request_id'].'" class="subject"><span class="'.$badge_color.' badge mr-2">&#x20b9; '.$row['amount'].'</span>'.$row["message"].'
                                                            </a>
                                                            <div class="date">'.$date_format.'</div>
                                                        </div>
                                                    </li>';
                                                    }
                                                    ?>


                                            </ul>
                                        </div>
                                        <div class="tab-pane" id="custom-social" role="tabpanel">
                                            <ul class="message-list mb-0">

                                                <?php
                                                    // For transactions in Home Page(index page)
                                                    $query_for_request = "SELECT * FROM tbl_requests where status='ignore' ORDER BY request_date DESC ";
                                                    $request_result = mysqli_query($con,$query_for_request);
                                                    $no_of_requests = mysqli_num_rows($request_result);

                                                    while($row = mysqli_fetch_array($request_result)) {
                                                        $from_account = $row['account_no'];
                                                        $query_for_from_account = "SELECT full_name FROM tbl_customer WHERE account_no=$from_account";
                                                        $result_ben_name = mysqli_query($con, $query_for_from_account);
                                                        $sender_name = mysqli_fetch_array($result_ben_name)[0];

                                                        $first_sender_name = strtok($sender_name, " ");

                                                        $to_account = $row['to_account'];
                                                        $query_for_to_account = "SELECT full_name FROM tbl_customer WHERE account_no=$to_account";
                                                        $result_to_account = mysqli_query($con, $query_for_to_account);
                                                        $reciver_name = mysqli_fetch_array($result_to_account)[0];

                                                        $first_reciver_name = strtok($reciver_name, " ");

                                                        $date_format = $row["request_date"];
                                                        $date_format=substr($date_format, 0, 10);


                                                        $unread = 'class="unread"';

                                                        if($row['status'] != 'sent')
                                                        {
                                                            $badge_color = "badge-danger";
                                                        } else {
                                                            $badge_color = "badge-success";
                                                        }
                                                        
                                                        echo '
                                                        <li '.$unread.'>
                                                        <div class="col-mail col-mail-1">
                                                            <div class="checkbox-wrapper-mail">
                                                                <input type="checkbox" id="chk16">
                                                                <label for="chk16" class="toggle"></label>
                                                            </div>
                                                            <a href="view_request_read.php?request_id='.$row['request_id'].'" class="title">'.$first_sender_name.' To '.$first_reciver_name.'</a>
                                                        </div>
                                                        <div class="col-mail col-mail-2">
                                                            <a href="view_request_read.php?request_id='.$row['request_id'].'" class="subject"><span class="'.$badge_color.' badge mr-2">&#x20b9; '.$row['amount'].'</span>'.$row["message"].'
                                                            </a>
                                                            <div class="date">'.$date_format.'</div>
                                                        </div>
                                                    </li>';
                                                    }
                                                    ?>


                                            </ul>
                                        </div>


                                    </div>

                                </div>
                            </div>
                            <!-- end card -->
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

        <!-- apexcharts -->
        <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

        <script src="assets/libs/slick-slider/slick/slick.min.js"></script>

        <!-- Jq vector map -->
        <script src="assets/libs/jqvmap/jquery.vmap.min.js"></script>
        <script src="assets/libs/jqvmap/maps/jquery.vmap.usa.js"></script>

        <script src="assets/js/pages/dashboard.init.js"></script>

        <script src="assets/js/app.js"></script>

    </body>

    </html>