<?php
session_start();
$user_path=include_once('connect.php');
if($user_path)
{
//    echo "<script>alert('sss');</script>";
}
else
{
    echo "<script>alert('server error due to techincal  reason  please  connnected the techincal person....!')";
}
?>
<!-- thie main of the power and getting the selcted of ad the thing is the mai of the power nad 
this data is going to ececut the mpoern and
the data is requird and somehting in  powe nad the data is read by the merhcant person and the data
-->
<?php
 if(isset($_SESSION["s_account_no"]) && isset($_SESSION['s_login']))
 {
     $Account_no = $_SESSION["s_account_no"];
    $query=mysqli_query($con,"select * from tbl_requests where account_no='$Account_no'  ");
    $count=mysqli_num_rows($query);
 }
    ?>

<button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-bell-outline"></i>
                                <span class="badge badge-danger badge-pill" style="right: 0;"><?=$count?></span>
                            </button>