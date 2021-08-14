<script type="text/javascript">
    function checkPurpose(val) {
        var element = document.getElementById('txt_purpose_hide');
        if (val == 'Select' || val == 'Others')
            element.style.display = 'block';
        else
            element.style.display = 'none';
    }


    function sweetAlertSuccess() {
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Money Successfully Transferred",
            showConfirmButton: !1,
            timer: 1500
        });
    }

    function wrongAccountNo() {
        Swal.fire({
            title: "Transaction Failed",
            text: "Account Number is Incorrect",
            icon: "error"
        });
    }

    function mismatchAccountNo() {
        Swal.fire({
            title: "Transaction Failed",
            text: "Account Number Not Matched",
            icon: "error"
        });
    }

    function lowBalance() {
        Swal.fire({
            title: "Transaction Failed",
            text: "You don't have sufficient balance for this Transaction.",
            icon: "error"
        });
    }

    function sameAccountNo() {
        Swal.fire({
            title: "Transaction Failed",
            text: "You can not provide your own account number.",
            icon: "error"
        });
    }

    function transferLimit() {
        Swal.fire({
            title: "Transaction Failed",
            text: "Limit of Quick Transfer is 500 to 20,000",
            icon: "error"
        });
    }
</script>



<?php
    include('connect.php');
    session_start();
    session_regenerate_id(false);
    // if Session is getting account_no then user can access index.php else require login
    if(isset($_SESSION["s_account_no"]))
    {
        $Account_no = $_SESSION["s_account_no"];
        // For Getting Customer Details
        $query_customer = "SELECT * FROM tbl_customer WHERE account_no='$Account_no'";
        $result_customer = mysqli_query($con, $query_customer);
        $row_customer = mysqli_fetch_array($result_customer);

        // For Getting no_of_transaction
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
        

        
    } else {
        header("location:http://localhost/online-banking/site/dist/auth_login.php");
    }

    
?>



    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Quick Transfer</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- slick css -->
        <link href="assets/libs/slick-slider/slick/slick.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/slick-slider/slick/slick-theme.css" rel="stylesheet" type="text/css" />

        <!-- Sweet Alert-->
        <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />


        <!-- alertifyjs default themes  Css -->
        <link href="assets/libs/alertifyjs/build/css/themes/default.min.css" rel="stylesheet" type="text/css" />

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

                            <!-- start page title -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title-box d-flex align-items-center justify-content-between">
                                        <h4 class="mb-0 font-size-18">Quick transfer<br></h4>

                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item">Net Banking<br></li>
                                                <li class="breadcrumb-item active">Quick transfer<br></li>
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
                                                    <h5 class="font-size-14">Number of Transactions<br></h5>
                                                </div>
                                                <div class="avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="dripicons-box"></i>
                                                </span>
                                                </div>
                                            </div>
                                            <h4 class="m-0 align-self-center">
                                                <?php echo $no_of_transaction?>
                                            </h4>

                                            <p class="mb-0 mt-3 text-muted"><span class="text-dark"> <?php echo $no_of_transaction_of_this_month; ?> </span> Transaction From This Month</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xl-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="media">
                                                <div class="media-body">
                                                    <h5 class="font-size-14">Total Credit Amount<br></h5>
                                                </div>
                                                <div class="avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="dripicons-briefcase"></i>
                                                </span>
                                                </div>
                                            </div>
                                            <h4 class="m-0 align-self-center">&#x20b9;
                                                <?php echo $credit_sum ?>
                                            </h4>
                                            <p class="mb-0 mt-3 text-muted"><span class="text-success">&#x20b9; <?php echo $credit_sum_of_this_month ?> <i class="mdi mdi-trending-up mr-1"></i></span> From This Month</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xl-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="media">
                                                <div class="media-body">
                                                    <h5 class="font-size-14">Total Debit Amount<br></h5>
                                                </div>
                                                <div class="avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="dripicons-tags"></i>
                                                </span>
                                                </div>
                                            </div>
                                            <h4 class="m-0 align-self-center">&#x20b9;
                                                <?php echo $debit_sum ?>
                                            </h4>
                                            <p class="mb-0 mt-3 text-muted"><span class="text-danger">&#x20b9; <?php echo $debit_sum_of_this_month ?> <i class="mdi mdi-trending-up mr-1"></i></span> From This Month</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xl-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="media">
                                                <div class="media-body">
                                                    <h5 class="font-size-14">Current Balance<br></h5>
                                                </div>
                                                <div class="avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="dripicons-cart"></i>
                                                </span>
                                                </div>
                                            </div>
                                            <h4 class="m-0 align-self-center">&#x20b9;
                                                <?php echo $account_bal ?>
                                            </h4>
                                            <?php 
                                            $result_of_this_month = $credit_sum_of_this_month - $debit_sum_of_this_month;
                                            if ($result_of_this_month < 0)
                                            {
                                                $echo_result_of_this_month =  '<p class="mb-0 mt-3 text-muted"><span class="text-danger">&#x20b9; '.$result_of_this_month.' <i class="mdi mdi-trending-up mr-1"></i></span> From This Month</p>';
                                            }
                                            else
                                            {
                                                $echo_result_of_this_month =  '<p class="mb-0 mt-3 text-muted"><span class="text-success">&#x20b9; '.$result_of_this_month.' <i class="mdi mdi-trending-up mr-1"></i></span> From This Month</p>';
                                            }

                                            echo $echo_result_of_this_month;
                                        ?>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row"><br></div>
                            <!-- end row -->
                            <!-- Modal -->

                            <div class="row mb-3 align-items-center">
                                <div class="col-12">

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h4 class="header-title">Quick Transfer</h4>
                                                </div>
                                                <div class="col"> <a type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-outline-info float-lg-right"><i class="fas fa-plus"></i> Add Beneficial</a>
                                                </div>
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Add Beneficial</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="needs-validation " novalidate>
                                                                <div class="row ">
                                                                    <div class="col-md-6 ">
                                                                        <label for="validationCustom01 ">Account Holder Name</label>
                                                                        <input type="text " class="form-control " id="validationCustom01 " placeholder="First name " value="Mark " required>
                                                                        <div class="valid-feedback ">
                                                                            Looks good!
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 ">
                                                                        <div class="form-group ">
                                                                            <label>Account Number</label>
                                                                            <div>
                                                                                <input data-parsley-type="number " type="text " class="form-control " required placeholder="Enter only numbers " />
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="row ">
                                                                    <div class="col-md-6 mb-3">
                                                                        <label for="validationCustom03 ">City</label>
                                                                        <input type="text " class="form-control " id="validationCustom03 " placeholder="City " required>
                                                                        <div class="invalid-feedback ">
                                                                            Please provide a valid city.
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 mb-3">
                                                                        <label>State</label>
                                                                        <select class="custom-select " required>
                                                                            <option value=" ">Open this select State</option>
                                                                            <option value="1 ">California</option>
                                                                            <option value="2 ">Nevada</option>
                                                                            <option value="3 ">Montana</option>
                                                                        </select>
                                                                        <div class="invalid-feedback ">Example invalid custom select feedback</div>
                                                                    </div>

                                                                </div>

                                                                <button class="btn btn-primary " type="submit ">Submit form</button>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <p class="card-title-desc"> </p>

                                            <form class="custom-validation row">
                                                <div class="form-group col-md-6">

                                                    <label>Beneficial Person Name</label>
                                                    <!-- <input type="text" class="form-control" required placeholder="Name of Beneficial" /> -->
                                                    <select name="txt_purpose" class="select2 form-control custom-select" type="text" placeholder="Name of Beneficial" required>
                                                        <option value="">Select</option>
                                                        <option value="">Name 2</option>
                                                       
                                                </select>
                                                </div>



                                                <div class="form-group col-md-6">
                                                    <label>Beneficial Account Number</label>
                                                    <div>
                                                        <select name="txt_purpose" class="select2 form-control custom-select" type="text" placeholder="Name of Beneficial" required>
                                                            <option value="">Select</option>
                                                            <option value="">7878878414494</option>
                                                           
                                                    </select>
                                                        <!-- <input type="password" name="txt_ben_account_no" id="pass2" class="form-control" required data-parsley-minlength="9" placeholder="Account number" /> -->
                                                    </div>

                                                </div>


                                                <div class="form-group col-md-6">
                                                    <label>Account Number</label>
                                                    <input type="number" name="txt_ben_account_no_2" class="form-control" required data-parsley-minlength="9" data-parsley-equalto="#pass2" placeholder="Re-Type Account number" />

                                                </div>



                                                <div class="form-group col-md-6">
                                                    <label>Amount</label>

                                                    <div class="input-group">
                                                        <input type="text" name="txt_amount" class="form-control" placeholder="10,000" aria-label="Recipient 's username" aria-describedby="basic-addon2" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" id="basic-addon2">&#x20b9;</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Purpose to Transfer Money -->

                                                <div class="form-group col-md-6">
                                                    <label>purpose</label>
                                                    <select name="txt_purpose" class="select2 form-control custom-select" style="width: 100%;height:36px;" onchange='checkPurpose(this.options[this.selectedIndex].value);' required>
                                                        	<option value="">Select</option>
                                                            <option value="Payment towords loan repayment">Payment towords loan repayment</option>
                                                            <option value="Deposite / Investment">Deposite / Investment</option>
                                                            <option value="Gift to relative / Friends">Gift to relative / Friends</option>
                                                            <option value="Donation">Donation</option>
                                                            <option value="Payment of Education Fee">Payment of Education Fee</option>
                                                            <option value="Rent">Rent</option>
                                                            <option value="Others">Others</option>
                                                    </select>
                                                </div>
                                                <!-- <div class="form-group col-md-6">
                                                    <label> Enter purpose</label>
                                                    <div class="col-lg-4 col-md-12">
                                                        <div class="input-group">
                                                            <input type="text" id="txt_purpose_hide" name="txt_purpose_others" class="form-control" placeholder="Purpose of this transaction" aria-label="Recipient 's username" aria-describedby="basic-addon2" style='display:none;' />

                                                        </div>
                                                    </div>
                                                </div> -->


                                                <div class="form-group col-12">
                                                    <div>
                                                        <button type="submit" name="btn_submit" class="btn btn-primary waves-effect waves-light mr-1">Submit</button>


                                                        <button type="reset" class="btn btn-secondary waves-effect">
                                                        Reset
                                                    </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <!-- end col -->
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
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>



        <!-- Jq vector map -->
        <script src="assets/libs/jqvmap/jquery.vmap.min.js"></script>
        <script src="assets/libs/jqvmap/maps/jquery.vmap.usa.js"></script>

        <script src="assets/js/pages/dashboard.init.js"></script>

        <script src="assets/js/app.js"></script>

        <!-- parsleyjs -->
        <script src="assets/libs/parsleyjs/parsley.min.js"></script>
        <!-- validation init -->
        <script src="assets/js/pages/form-validation.init.js"></script>

        <!-- Sweet Alerts js -->
        <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

        <!-- Sweet alert init js-->
        <script src="assets/js/pages/sweet-alerts.init.js"></script>


    </body>

    </html>




    <?php

    if(isset($_REQUEST['btn_submit']))
    {
        // Steps to do in quick transfer
        // 1. Reduce amount in loggin in customer
            // if account_bal is not sufficient then display message and stop exicution
            // else Make All Exicution of code
        // 2. add amount in to_account customer
        // 3. insert transaction debit record for logged_in user in tbl_transaction
        // 4. insert transaction credit record for to_account user in tbl_transaction



        // $query_for_Account_no = "SELECT account_no FROM tbl_customer WHERE username='$Username'";
        // $result = mysqli_query($con, $query_for_Account_no) or die('SQL Error :: '.mysqli_error());
        // $row = mysqli_fetch_assoc($result);

        // $Account_no = $row['account_no'];

        $query_for_Account_bal = "SELECT balance FROM tbl_balance WHERE account_no=$Account_no";
        $result = mysqli_query($con, $query_for_Account_bal) or die('SQL Error :: '.mysqli_error());
        $row = mysqli_fetch_assoc($result);

        $Acount_bal = $row['balance'];
        $Amount = $_REQUEST['txt_amount'];
        $To_account = $_REQUEST['txt_ben_account_no'];
        $To_account2 = $_REQUEST['txt_ben_account_no_2'];


        // Check To_account no. is in database or not
        // $lectureName = mysql_real_escape_string($lectureName);  // SECURITY!
        // $result = mysql_query("SELECT 1 FROM preditors_assigned WHERE lecture_name='$lectureName' LIMIT 1");
        // if (mysql_fetch_row($result)) {
            // return 'Assigned';
        // } else {
            // return 'Available';
        // }


        $query_for_check_To_Account_no = mysqli_query($con,"SELECT account_no FROM  tbl_account WHERE account_no=$To_account");
        $result_to_account = mysqli_num_rows($query_for_check_To_Account_no);

        
        


        // if Account_bal is not Sufficient then Run This block Of code That disply You have not Sufficient bal or ben_account_no == logged_in usee then Display You can not set    Your Account Number
        // else Run  Below Code
        if ($Amount > $Acount_bal)
        {
            echo '<script type="text/JavaScript">  
              lowBalance();
             </script>' 
              ;
        }
        elseif ($To_account == $Account_no)
        {
            echo '<script type="text/JavaScript">  
              sameAccountNo();
             </script>' 
              ;
        }
        
        elseif ($result_to_account != 1) 
        {
            echo '<script type="text/JavaScript">  
              wrongAccountNo();
             </script>' 
              ;
        }

        elseif ($To_account != $To_account2)
        {
            echo '<script type="text/JavaScript">  
              mismatchAccountNo();
             </script>' 
              ;
        }

        elseif ($Amount < 500 || $Amount > 20000)
        {
            echo '<script type="text/JavaScript">  
              transferLimit();
             </script>' 
              ;
        }

        else
        {
        
            // 1. Reduce amount in login in customer
            $Acount_bal = $Acount_bal - $Amount;
            $query_for_update_from_Account_bal = "UPDATE tbl_balance SET balance=$Acount_bal WHERE  account_no=$Account_no";
            $result = mysqli_query($con, $query_for_update_from_Account_bal) or die('SQL Error ::   '.mysqli_error());



            // 2. add amount in to_account customer
            $To_account = $_REQUEST['txt_ben_account_no'];
            $query_for_Ben_Account_bal = "SELECT balance FROM tbl_balance WHERE account_no=$To_account";
            $result = mysqli_query($con, $query_for_Ben_Account_bal) or die('SQL Error :: '.mysqli_error());
            $row = mysqli_fetch_assoc($result);
            $Acount_bal = $row['balance'];
            $Amount = $_REQUEST['txt_amount'];

            $Account_bal = $Acount_bal + $Amount;
            $query_for_update_Ben_Account_bal = "UPDATE tbl_balance SET balance=$Account_bal WHERE  account_no=$To_account";
            $result = mysqli_query($con, $query_for_update_Ben_Account_bal) or die('SQL Error ::    '.mysqli_error());



            $Trans_date = date("Y-m-d H:i:s");
            $Amount = $_REQUEST['txt_amount'];
            $Trans_type = "DEBIT";
            $Purpose = $_REQUEST['txt_purpose'];
            if($Purpose == "" || $Purpose == "Others" ){
                $Purpose = $_REQUEST['txt_purpose_others'];
            }
            else {
                $Purpose = $_REQUEST['txt_purpose'];

            }
            $To_account = $_REQUEST['txt_ben_account_no'];

            // $query_for_Account_no = "SELECT account_no FROM tbl_customer WHERE username='$Username'";
            // $result = mysqli_query($con, $query_for_Account_no) or die('SQL Error :: '.mysqli_error());
            // $row = mysqli_fetch_assoc($result);
            // $Account_no = $row['account_no'];

            $query_for_Account_bal = "SELECT balance FROM tbl_balance WHERE account_no=$Account_no";
            $result = mysqli_query($con, $query_for_Account_bal) or die('SQL Error :: '.mysqli_error());
            $row = mysqli_fetch_assoc($result);
            $Acount_bal = $row['balance'];

            // 3. insert transaction debit record for logged_in user in tbl_transaction
            $query_debit_record = "INSERT INTO tbl_transaction (trans_date,amount,trans_type,purpose,   to_account,account_no,account_bal) 
            VALUES ('$Trans_date', $Amount, '$Trans_type', '$Purpose', $To_account, $Account_no,    $Acount_bal)";
            $result = mysqli_query($con, $query_debit_record) or die('SQL Error :: '.mysqli_error());


            $Trans_type = "CREDIT";
            $query_for_Ben_Account_bal = "SELECT balance FROM tbl_balance WHERE account_no=$To_account";
            $result = mysqli_query($con, $query_for_Ben_Account_bal) or die('SQL Error :: '.mysqli_error());
            $row = mysqli_fetch_assoc($result);
            $Acount_bal = $row['balance'];

            // 4. insert transaction credit record for to_account user in tbl_transaction
            $query_credit_record = "INSERT INTO tbl_transaction (trans_date,amount,trans_type,purpose,  to_account,account_no,account_bal) 
            VALUES ('$Trans_date', $Amount, '$Trans_type', '$Purpose', $Account_no, $To_account,    $Acount_bal)";
            $result = mysqli_query($con, $query_credit_record) or die('SQL Error :: '.mysqli_error());


            if ($result)
            {
              echo '<script type="text/JavaScript">  
              sweetAlertSuccess();
             </script>' 
              ;
            }
            else
            {
              print($result);
            
              echo "ERROR: Could not able to execute $query. " . mysqli_error($con);
            }
        }
    }
?>