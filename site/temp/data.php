<?php
if(include('../dist/connect.php'))
{  // rest of the code
// connect
}
else {
// false condition
echo "<script>alert('server error');location.href='';</script> ";
}
$geting=mysqli_query($con,"select email from tbl_customer where account_no='338509662' ") or die('can not fetch');
$data=mysqli_fetch_array($geting);
$emp=$data['email'];
 // auth verification
 $otp_number = rand(10, 110025);
$to_email = $emp;
$subject = "Authentication approval OTP";
$body = "Your One Time Password Is: $otp_number";
$headers = "From: verification Center ";


if (mail($to_email, $subject, $body, $headers)) {
  echo "Email successfully sent to $to_email...";
} else {
  echo "Email sending failed...";
}
?>
