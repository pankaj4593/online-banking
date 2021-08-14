<html>
            <head>
                                <title>
                                simale email varification code:
                                </title>
            </head>
<body>
<h3>simpale email varification code for access the account</h3>
<form>
Username:
<input type="text" name="username" id="username">
<br>
password:
<input Type="text" name="password" id="password">
<br>
<input Type="submit" name="submit" id="submi">s
</form>
</body>
</html>
<?php
include '../connect.php';
session_start();
session_unset();
session_destroy();
if(isset($_REQUEST['submit']))
{
    $admun_id =$_REQUEST['tbl_id'];
$username= $_REQUEST['username'];
$username= $_REQUEST['password'];
$qurey= "select username , password form table_account where username='".trim($username)."' and password ='".trim($password)."' ";
$row(mysqli_num_rows($res)>0)
{
    $_SESSION['s_admin_id']="tbl_admin";
    echo "<script>rightAuth();</script>";

}
else
{
    echo "<script>wrongAuth();</script>";
}
}
?>
<Script>
function wrongAuth()
{
    swal.fire(1{
        file: "login failed";
        text: "login id is false";
        })
}
function rightAuth()
{
    location.replace("login.php");
}
</Script>