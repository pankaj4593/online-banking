<?php
if(isset($_REQUEST['submit']))
{
$username=$_REQUEST['user'];
$password=$_REQUEST['password'];
$query='select username , password form tbl_account where username=" "  and password="" ';
$result1=mysqli_query($con,$query);
if($msyqli_num_rows($result)>0)

{
    $_SESSION['s_admin_id'] = $Admin_id;
    echo "<script>rightAuth();</script>";   
}
else
{
    echo "<script>wrongAuth();</script>";
}
}
?>































