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
        $query_for_no_of_customer = "SELECT * FROM tbl_customer";
        $result_no_of_customer = mysqli_query($con,$query_for_no_of_customer);
        $no_of_customer = mysqli_num_rows($result_no_of_customer); 

        // $debit_count
        $query_for_debit_count = "SELECT * FROM tbl_transaction where trans_type='DEBIT'";
        $result_debit_count = mysqli_query($con,$query_for_debit_count);
        $debit_count = mysqli_num_rows($result_debit_count);

        // $credit_count
        $query_for_credit_count = "SELECT * FROM tbl_transaction where trans_type='CREDIT'";
        $result_credit_count = mysqli_query($con,$query_for_credit_count);
        $credit_count = mysqli_num_rows($result_credit_count); 

        // $total_bank_balance
        $query_for_total_bank_balance = "SELECT SUM(balance) as bank_balance FROM tbl_balance"; // SUM of all account balance
        $result_total_bank_balance = mysqli_query($con,$query_for_total_bank_balance);
        $array_total_bank_balance = mysqli_fetch_assoc($result_total_bank_balance); # $no_of_transaction
        $total_bank_balance = $array_total_bank_balance['bank_balance'];

        // $query_for_credit_total = "SELECT SUM(amount) as credit_sum FROM tbl_transaction where account_no = $Account_no and trans_type='CREDIT' ";
        // $query_credit_result = mysqli_query($con,$query_for_credit_total);
        // $total_credit = mysqli_fetch_assoc($query_credit_result);
   
        // // TODO: Select All Customer and their Transaction from database and Print into Table
        // // For Getting All Customers Transaction Details
        // $query_for_transactions = "SELECT * FROM tbl_transaction where account_no = $Account_no ORDER BY trans_date DESC ";
        // $transaction_result = mysqli_query($con,$query_for_transactions);
        // $no_of_transaction = mysqli_num_rows($transaction_result); # $no_of_transaction

        // // For getting Acount Balance
        // $query_for_account_bal = "SELECT balance FROM tbl_balance WHERE account_no=$Account_no";
        // $result_account_bal = mysqli_query($con, $query_for_account_bal);
        // $account_bal = mysqli_fetch_array($result_account_bal)[0];

        // // For Sum of Credit Amount
        // $query_for_credit_total = "SELECT SUM(amount) as credit_sum FROM tbl_transaction where account_no = $Account_no and trans_type='CREDIT' ";
        // $query_credit_result = mysqli_query($con,$query_for_credit_total);
        // $total_credit = mysqli_fetch_assoc($query_credit_result);
        // if (!empty($total_credit['credit_sum'])) {
        //     $credit_sum = $total_credit['credit_sum'];
        // }
        // else {
        //     $credit_sum = 0;
        // }
        
        // // For Sum of Debit Amount
        // $query_for_debit_total = "SELECT SUM(amount) as debit_sum FROM tbl_transaction where account_no = $Account_no and trans_type='DEBIT' ";
        // $query_debit_result = mysqli_query($con,$query_for_debit_total);
        // $total_debit = mysqli_fetch_assoc($query_debit_result);
        // if (!empty($total_debit['debit_sum'])) {
        //     $debit_sum = $total_debit['debit_sum'];
        // }
        // else {
        //     $debit_sum = 0;
        // }
        

        
    } else {
        header("location:http://localhost/online-banking/admin/dist/auth-login.php");
    }

?>


    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Home</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- slick css -->
        <link href="assets/libs/slick-slider/slick/slick.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/slick-slider/slick/slick-theme.css" rel="stylesheet" type="text/css" />

        <!-\- jvectormap -->
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
                                        <h4 class="mb-0 font-size-18">Dashboard</h4>

                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                                <li class="breadcrumb-item active">Dashboard</li>
                                            </ol>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- end page title -->

                            <div class="row">
                                <div class="col-sm-6 col-xl-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="media">
                                                <div class="media-body">
                                                    <h5 class="font-size-14">Number of Customer</h5>
                                                </div>
                                                <div class="avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="dripicons-box"></i>
                                                </span>
                                                </div>
                                            </div>
                                            <h4 class="m-0 align-self-center">
                                                <?php echo $no_of_customer ?>
                                            </h4>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xl-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="media">
                                                <div class="media-body">
                                                    <h5 class="font-size-14">Total Debit Transactions</h5>
                                                </div>
                                                <div class="avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="dripicons-briefcase"></i>
                                                </span>
                                                </div>
                                            </div>
                                            <h4 class="m-0 align-self-center">
                                                <?php echo $debit_count?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xl-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="media">
                                                <div class="media-body">
                                                    <h5 class="font-size-14">Total Credit Transactions</h5>
                                                </div>
                                                <div class="avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="dripicons-tags"></i>
                                                </span>
                                                </div>
                                            </div>
                                            <h4 class="m-0 align-self-center">
                                                <?php echo $credit_count?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xl-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="media">
                                                <div class="media-body">
                                                    <h5 class="font-size-14">Total Bank Balance</h5>
                                                </div>
                                                <div class="avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="dripicons-cart"></i>
                                                </span>
                                                </div>
                                            </div>
                                            <h4 class="m-0 align-self-center">
                                                <?php echo $total_bank_balance ?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- end row -->


                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="header-title mb-4">All Customers</h4>

                                            <div class="table-responsive">
                                                <table class="table table-centered table-nowrap mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" style="width: 60px;"></th>
                                                            <th scope="col">Account no & Name</th>
                                                            <th scope="col">Birth Date</th>
                                                            <th scope="col">Gender</th>
                                                            <th scope="col">Mobile</th>
                                                            <th scope="col">Email</th>
                                                            <th scope="col">Balance</th>
                                                            <th scope="col">Account Type</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php

                                                    // For Getting All Customers Details
                                                    $query_for_customer_details = "SELECT * FROM tbl_customer";
                                                    $customers_details = mysqli_query($con,$query_for_customer_details);
                                                    // $row_customer_detail = mysqli_fetch_array($customers_details);

                                                    while($row = mysqli_fetch_array($customers_details)) {
                                                        $account_no = $row["account_no"];

                                                        $query_for_account_bal = "SELECT balance FROM tbl_balance WHERE account_no=$account_no";
                                                        $result_account_bal = mysqli_query($con, $query_for_account_bal);
                                                        $account_bal = mysqli_fetch_array($result_account_bal)[0];

                                                        $query_for_account_type = "SELECT account_type FROM tbl_account_type WHERE account_no=$account_no";
                                                        $result_account_type = mysqli_query($con, $query_for_account_type);
                                                        $account_type = mysqli_fetch_array($result_account_type)[0];
                                                       echo 
                                                       '<tr>
                                                       <td>
                                                       <div class="avatar-xs">
                                                       <a href="profile_view.php?account_no='.$account_no.'">
                                                       <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                                        '.$row["full_name"][0].'
                                                                    </span>
                                                        </a>

                                                                </div>
                                                            </td>
                                                            <td>
                                                       <a href="profile_view.php?account_no='.$account_no.'">

                                                                <p class="mb-1 font-size-12"># '.$row["account_no"].'</p>
                                                                <h5 class="font-size-15 mb-0">'.$row["full_name"].' </h5>
                                                        </a>


                                                            </td>
                                                            <td>'.$row["birth_date"].'</td>
                                                            <td>'.$row["gender"].'<br></td>
                                                            
                                                            <td>'.$row["mobile"].'</td>
                                                            <td> '.$row["email"].'</td>
                                                            <td>&#x20b9; '.$account_bal.'<br></td>
                                                            <td> '.$account_type.'</td>
                                                    </tr>';
                                                   } 
                                                ?>
                                                            <!-- <tr>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck2">
                                                                <label class="custom-control-label" for="customCheck2"></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="avatar-xs">
                                                                <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                                    W
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <p class="mb-1 font-size-12">#AP1235</p>
                                                            <h5 class="font-size-15 mb-0">Walter Jones</h5>
                                                        </td>
                                                        <td>04 Nov, 2019</td>
                                                        <td>$ 822</td>
                                                        <td>2</td>
                                                        
                                                        <td>
                                                            $ 1,644
                                                        </td>
                                                        <td>
                                                            <i class="mdi mdi-checkbox-blank-circle text-success mr-1"></i> Confirm
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-outline-success btn-sm">Edit</button>
                                                            <button type="button" class="btn btn-outline-danger btn-sm">Cancel</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck3">
                                                                <label class="custom-control-label" for="customCheck3"></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <img src="assets/images/users/avatar-3.jpg" alt="user" class="avatar-xs rounded-circle" />
                                                        </td>
                                                        <td>
                                                            <p class="mb-1 font-size-12">#AP1236</p>
                                                            <h5 class="font-size-15 mb-0">Eric Ryder</h5>
                                                        </td>
                                                        <td>05 Nov, 2019</td>
                                                        <td>$ 1,153</td>
                                                        <td>1</td>
                                                        
                                                        <td>
                                                            $ 1,153
                                                        </td>
                                                        <td>
                                                            <i class="mdi mdi-checkbox-blank-circle text-danger mr-1"></i> Cancel
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-outline-success btn-sm">Edit</button>
                                                            <button type="button" class="btn btn-outline-danger btn-sm">Cancel</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck4">
                                                                <label class="custom-control-label" for="customCheck4"></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <img src="assets/images/users/avatar-6.jpg" alt="user" class="avatar-xs rounded-circle" />
                                                        </td>
                                                        <td>
                                                            <p class="mb-1 font-size-12">#AP1237</p>
                                                            <h5 class="font-size-15 mb-0">Kenneth Jackson</h5>
                                                        </td>
                                                        <td>06 Nov, 2019</td>
                                                        <td>$ 1,365</td>
                                                        <td>1</td>
                                                        
                                                        <td>
                                                            $ 1,365
                                                        </td>
                                                        <td>
                                                            <i class="mdi mdi-checkbox-blank-circle text-success mr-1"></i> Confirm
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-outline-success btn-sm">Edit</button>
                                                            <button type="button" class="btn btn-outline-danger btn-sm">Cancel</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck5">
                                                                <label class="custom-control-label" for="customCheck5"></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="avatar-xs">
                                                                <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                                    R
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <p class="mb-1 font-size-12">#AP1238</p>
                                                            <h5 class="font-size-15 mb-0">Ronnie Spiller</h5>
                                                        </td>
                                                        <td>08 Nov, 2019</td>
                                                        <td>$ 740</td>
                                                        <td>2</td>
                                                        
                                                        <td>
                                                            $ 1,480
                                                        </td>
                                                        <td>
                                                            <i class="mdi mdi-checkbox-blank-circle text-warning mr-1"></i> Pending
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-outline-success btn-sm">Edit</button>
                                                            <button type="button" class="btn btn-outline-danger btn-sm">Cancel</button>
                                                        </td>
                                                    </tr> -->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
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