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

        // For Getting Different Types of values in page
        $query_for_transactions = "SELECT * FROM tbl_transaction where account_no = $Account_no ORDER BY trans_date DESC ";
        $transaction_result = mysqli_query($con,$query_for_transactions);
        $no_of_transaction = mysqli_num_rows($transaction_result); # $no_of_transaction

        // For Getting Different Types of values in page
        $query_for_transactions_of_this_month = "SELECT * FROM tbl_transaction where account_no = $Account_no AND MONTH(trans_date) = MONTH(CURRENT_DATE()) AND YEAR(trans_date) = YEAR(CURRENT_DATE()) ";
        $transaction_result_of_this_month = mysqli_query($con,$query_for_transactions_of_this_month);
        $no_of_transaction_of_this_month = mysqli_num_rows($transaction_result_of_this_month); # $no_of_transaction

        // For getting Acount Balance
        $query_for_account_bal = "SELECT balance FROM tbl_balance WHERE account_no=$Account_no";
        $result_account_bal = mysqli_query($con, $query_for_account_bal);
        $account_bal = mysqli_fetch_array($result_account_bal)[0];

        // For Sum of Credit Amount
        $query_for_credit_total = "SELECT SUM(amount) as credit_sum FROM tbl_transaction where account_no = $Account_no and trans_type='CREDIT' ";
        $query_credit_result = mysqli_query($con,$query_for_credit_total);
        $total_credit = mysqli_fetch_assoc($query_credit_result);
        if (!empty($total_credit['credit_sum'])) {
            $credit_sum = $total_credit['credit_sum'];
        }
        else {
            $credit_sum = 0;
        }
        
        // For Sum of Debit Amount
        $query_for_debit_total = "SELECT SUM(amount) as debit_sum FROM tbl_transaction where account_no = $Account_no and trans_type='DEBIT' ";
        $query_debit_result = mysqli_query($con,$query_for_debit_total);
        $total_debit = mysqli_fetch_assoc($query_debit_result);
        if (!empty($total_debit['debit_sum'])) {
            $debit_sum = $total_debit['debit_sum'];
        }
        else {
            $debit_sum = 0;
        }

        $query_credit_sum_this_month = "SELECT SUM(amount) as credit_sum_of_this_month FROM tbl_transaction where account_no = $Account_no and trans_type='CREDIT' and MONTH(trans_date) = MONTH(CURRENT_DATE()) AND YEAR(trans_date) = YEAR(CURRENT_DATE())";
        $query_credit_sum_this_month_result = mysqli_query($con,$query_credit_sum_this_month);
        $credit_sum_this_month = mysqli_fetch_assoc($query_credit_sum_this_month_result);
        if (!empty($credit_sum_this_month['credit_sum_of_this_month'])) {
            $credit_sum_of_this_month = $credit_sum_this_month['credit_sum_of_this_month'];
        }
        else {
            $credit_sum_of_this_month = 0;
        }

        $query_debit_sum_this_month = "SELECT SUM(amount) as debit_sum_of_this_month FROM tbl_transaction where account_no = $Account_no and trans_type='DEBIT' and MONTH(trans_date) = MONTH(CURRENT_DATE()) AND YEAR(trans_date) = YEAR(CURRENT_DATE())";
        $query_debit_sum_this_month_result = mysqli_query($con,$query_debit_sum_this_month);
        $credit_sum_this_month = mysqli_fetch_assoc($query_debit_sum_this_month_result);
        if (!empty($credit_sum_this_month['debit_sum_of_this_month'])) {
            $debit_sum_of_this_month = $credit_sum_this_month['debit_sum_of_this_month'];
        }
        else {
            $debit_sum_of_this_month = 0;
        }
//         SELECT *
// FROM tbl_transaction
// WHERE MONTH(trans_date) = MONTH(CURRENT_DATE())
// AND YEAR(trans_date) = YEAR(CURRENT_DATE())
        

        
    } else {
        header("location:http://localhost/online-banking/site/dist/auth_login.php");
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

        <!-- jvectormap -->
        <link href="assets/libs/jqvmap/jqvmap.min.css" rel="stylesheet" />

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />





    </head>

    <body data-topbar="dark" data-layout="horizontal">

        <!-- Begin page -->
        <div id="layout-wrapper">


            <?php
         include "header-sidebar.php";
         ?>






                <!-- ============================================================== -->
                <!-- Start right Content here -->
                <!-- ============================================================== -->
                <div class="main-content">

                    <div class="page-content">
                        <div class="container-fluid">




                            <!-- end row -->
                            <?php            

                        

                        // echo "<table>"; // start a table tag in the HTML
                        // // For transactions in Home Page(index page)
                        // $query_for_transactions = "SELECT * FROM tbl_transaction where account_no = $Account_no ORDER BY trans_date DESC ";
                        // $transaction_result = mysqli_query($con,$query_for_transactions);

                        // while($row = mysqli_fetch_array($transaction_result)) {
                        // $to_account_no = $row['to_account'];
                        // $query_for_ben_name = "SELECT full_name FROM tbl_customer WHERE account_no=$to_account_no";
                        // $result_ben_name = mysqli_query($con, $query_for_ben_name);
                        // $ben_name = mysqli_fetch_array($result_ben_name)[0];

                        // echo "<tr><td>" . $row['trans_id'] . "</td><td>" .$ben_name . "</td><td>" . $row['trans_date'] . "</td><td>" . $row['purpose'] ."</td><td>" . $row['trans_type'] . "</td><td>" .  $row['amount'] . "</td><td>" . $row['account_bal'] . "</td></tr>";  //$row['index'] the index here is a field name
                        // }

                        // echo "</table>"; //Close the table in HTML
                   
                        
                        // $result = mysql_query('SELECT SUM(value) AS value_sum FROM codes'); 
                        // $row = mysql_fetch_assoc($result); 
                        // $sum = $row['value_sum'];
                    
                        
                        ?>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <a class="btn btn-outline-info mb-2" id="btnExport" onclick="javascript:xport.toCSV('testTable');">
                                                <i class="fas fa-file-download"></i>&nbsp;Download
                                                <a>

                                                    <div class="table-responsive">
                                                        <table class="table table-centered table-nowrap mb-0" id="testTable">
                                                            <thead>
                                                                <tr>
                                                                    <!-- <th scope="col" style="width: 50px;">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="customCheckall">
                                                                            <label class="custom-control-label" for="customCheckall"></label>
                                                                        </div>
                                                                    </th>
                                                                    <th scope="col" style="width: 60px;"><br></th> -->
                                                                    <th scope="col">Transaction ID &amp; Name</th>
                                                                    <th scope="col">Date</th>
                                                                    <th scope="col"><br></th>
                                                                    <th scope="col">Purpose</th>
                                                                    <th scope="col">Transaction Type<br></th>
                                                                    <th scope="col">Amount</th>
                                                                    <th scope="col">Balance<br></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>


                                                                <?php
                                                    // For transactions in Home Page(index page)
                                                    $query_for_transactions = "SELECT * FROM tbl_transaction where account_no = $Account_no ORDER BY trans_date DESC ";
                                                    $transaction_result = mysqli_query($con,$query_for_transactions);
                                                    $no_of_transaction = mysqli_num_rows($transaction_result);

                                                    while($row = mysqli_fetch_array($transaction_result)) {
                                                        $to_account_no = $row['to_account'];
                                                        $query_for_ben_name = "SELECT full_name FROM tbl_customer WHERE account_no=$to_account_no";
                                                        $result_ben_name = mysqli_query($con, $query_for_ben_name);
                                                        $ben_name = mysqli_fetch_array($result_ben_name)[0];
                                                   if($row["trans_type"] == "DEBIT") {
                                                        $trans_light = '<i class="mdi mdi-checkbox-blank-circle text-danger mr-1"></i>';
                                                   }
                                                   else {
                                                        $trans_light = '<i class="mdi mdi-checkbox-blank-circle text-success mr-1"></i>';

                                                   }
                                                       echo 
                                                       '<tr>
                                                            <!-- <td>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input"
                                                                        id="customCheck1">
                                                                    <label class="custom-control-label" for="customCheck1"></label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="avatar-xs">
                                                                    <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                                        '.$ben_name[0].'
                                                                    </span>
                                                                </div>
                                                            </td> -->
                                                            <td>
                                                                <p class="mb-1 font-size-12"># '.$row["trans_id"].'</p>
                                                                <h5 class="font-size-15 mb-0">'.$ben_name.' </h5>
                                                            </td>
                                                            <td>'.$row["trans_date"].'</td>
                                                            <td><br></td>
                                                            <td>'.$row["purpose"].'<br></td>
                                                            
                                                            <td>'.$trans_light.'
                                                            '.$row["trans_type"].'</td>
                                                            <td>&#x20b9; '.$row["amount"].'</td>
                                                            <td>&#x20b9; '.$row["account_bal"].'<br></td>
                                                    </tr>';
                                                   } 
                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><br>
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



        <script>
            var xport = {
                _fallbacktoCSV: true,
                toXLS: function(tableId, filename) {
                    this._filename = (typeof filename == 'undefined') ? tableId : filename;

                    //var ieVersion = this._getMsieVersion();
                    //Fallback to CSV for IE & Edge
                    if ((this._getMsieVersion() || this._isFirefox()) && this._fallbacktoCSV) {
                        return this.toCSV(tableId);
                    } else if (this._getMsieVersion() || this._isFirefox()) {
                        alert("Not supported browser");
                    }

                    //Other Browser can download xls
                    var htmltable = document.getElementById(tableId);
                    var html = htmltable.outerHTML;

                    this._downloadAnchor("data:application/vnd.ms-excel" + encodeURIComponent(html), 'xls');
                },
                toCSV: function(tableId, filename) {
                    this._filename = (typeof filename === 'undefined') ? tableId : filename;
                    // Generate our CSV string from out HTML Table
                    var csv = this._tableToCSV(document.getElementById(tableId));
                    // Create a CSV Blob
                    var blob = new Blob([csv], {
                        type: "text/csv"
                    });

                    // Determine which approach to take for the download
                    if (navigator.msSaveOrOpenBlob) {
                        // Works for Internet Explorer and Microsoft Edge
                        navigator.msSaveOrOpenBlob(blob, this._filename + ".csv");
                    } else {
                        this._downloadAnchor(URL.createObjectURL(blob), 'csv');
                    }
                },
                _getMsieVersion: function() {
                    var ua = window.navigator.userAgent;

                    var msie = ua.indexOf("MSIE ");
                    if (msie > 0) {
                        // IE 10 or older => return version number
                        return parseInt(ua.substring(msie + 5, ua.indexOf(".", msie)), 10);
                    }

                    var trident = ua.indexOf("Trident/");
                    if (trident > 0) {
                        // IE 11 => return version number
                        var rv = ua.indexOf("rv:");
                        return parseInt(ua.substring(rv + 3, ua.indexOf(".", rv)), 10);
                    }

                    var edge = ua.indexOf("Edge/");
                    if (edge > 0) {
                        // Edge (IE 12+) => return version number
                        return parseInt(ua.substring(edge + 5, ua.indexOf(".", edge)), 10);
                    }

                    // other browser
                    return false;
                },
                _isFirefox: function() {
                    if (navigator.userAgent.indexOf("Firefox") > 0) {
                        return 1;
                    }

                    return 0;
                },
                _downloadAnchor: function(content, ext) {
                    var anchor = document.createElement("a");
                    anchor.style = "display:none !important";
                    anchor.id = "downloadanchor";
                    document.body.appendChild(anchor);

                    // If the [download] attribute is supported, try to use it

                    if ("download" in anchor) {
                        anchor.download = this._filename + "." + ext;
                    }
                    anchor.href = content;
                    anchor.click();
                    anchor.remove();
                },
                _tableToCSV: function(table) {
                    // We'll be co-opting `slice` to create arrays
                    var slice = Array.prototype.slice;

                    return slice
                        .call(table.rows)
                        .map(function(row) {
                            return slice
                                .call(row.cells)
                                .map(function(cell) {
                                    return '"t"'.replace("t", cell.textContent);
                                })
                                .join(",");
                        })
                        .join("\r\n");
                }
            };
        </script>


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