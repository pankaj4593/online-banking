<?php
include ('connect.php');
session_start();

if (isset($_SESSION["s_account_no"]) && isset($_SESSION['s_login'])) 
{
    $Account_no = $_SESSION["s_account_no"];
    $query= mysqli_query($con, "SELECT   email FROM  tbl_customer WHERE account_no='$Account_no' ")or die('not connect from databse');
    $email=mysqli_fetch_array($query) or die('sql server error');
    $email_Send=$email['email'];
    $otp_auth_verification=rand(0,3005);
        $to_email = "$email_Send";
$opt_insert_into_Database= "UPDATE tbl_customer SET  otp='$otp_auth_verification'  where account_no='$Account_no' " or die('sql error');
// echo $opt_insert_into_Database;
// die;
$result_declear=mysqli_query($con,$opt_insert_into_Database);
// echo var_dump($result_declear);
// die;
if($opt_insert_into_Database)
{
$subject = "Verification Center";
$body = "Your verification code is $otp_auth_verification";
$headers = "From: sender email";

if (mail($to_email, $subject, $body, $headers)) 
{
    // echo "Email successfully sent to $to_email...";
    // header('location:otp.php');

} 

else {
    echo "<script>alert('Server error due to technical error!')";
}
}
}
else
{

header('location:auth_login.php');

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>otp Auth E-banks site</title>
<style>
#mail_loader
{text-align: center;
    margin-top: 126px;
}
</style>

</head>
<body>
    <form>
<!-- <input type="hidden" name="hidden" value="hidden" >     -->
<!-- <p id="mail_loader"><img src="assets/load/vin.webp"></p> -->
    </form>
</body>
</html>
<!-- <script>
setTimeout('document.getElementById("mail_loader").innerHTML="";', 60000);
 setTimeout("location.href ='otp.php';", 10000);
</script> -->