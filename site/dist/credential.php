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


<?php
    include('connect.php');
    session_start();
    error_reporting(0);
    // if Session is getting account_no then user can access index.php else require login
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
        <!-- <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" /> -->


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
        <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
            <!-- auto logout script -->
    <script src="assets/js_autolog/script.js"></script>

        <!-- ajax using with API BAed curl and put  -->


    </head>

    <body data-topbar="dark" data-layout="horizontal">
        
<!-- modal popup -->

<!-- e -->

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
                    
                        <!-- end page title -->

                        
                        <div class="row"><br></div>
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
                                        <h4 class="header-title mb-4" ><i class="fa fa-cog"></i> &nbsp;Credentials settings</h4>
                                        <?php
                                            if(isset($_SESSION["s_account_no"]) && isset($_SESSION['s_login']))
                                            {
                                        
                                               
                                        $high_risk=mysqli_query($con,"select ip_address from tbl_transaction where account_no='".$Account_no."'  ") or die('unable to connect from the database!');
                                        if($high_risk)
                                        {
                                            $getting_Fetch=mysqli_fetch_array($high_risk);
                                            if($getting)
                                            {
                                                // rest of the code
                                            }
                                            else
                                            {
                                                echo "<script>alert('server error due to technical session please try again later ');</script>"; 
                                                
                                            }
                                            
                                        }
                                    }
                                        else
                                            {
                                                echo "<script>alert('technical issuse  undermintaince ');</script>";
                                            }

                                        ?>
                                           
                                       

                                       
           
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><br>
            </div>
<!-- detele code rite here -->






<!-- end the code -->
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
       

                   
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