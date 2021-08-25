<?php

// Get the user id
$user_id = $_REQUEST['user_id'];

// Database connection
$con = mysqli_connect("localhost", "root", "", "bank_db");

if ($user_id !== "") {
	
	// Get corresponding first name and
	// last name for that user id	
	$query = mysqli_query($con,"SELECT  to_account , account_bal, account_no, firstname,purpose,  amount, swiftcode
	 FROM tbl_transaction WHERE to_account='$user_id'");

	$row = mysqli_fetch_array($query);

	// Get the first name
	
	$first_name = $row["firstname"];

	// Get the first name
	$to_account = $row["amount"];
	$last_name = $row["to_account"];
	
	// $amount = $row["amount"];
	$swiftcode = $row["swiftcode"];
	$purpose = $row["purpose"];
}

else

{
// echo "<script>alert('test  function');</script>";

}
// Store it in a array
$result = array("$first_name", "$last_name" ,"$swiftcode" , "$to_account", "$purpose");

// Send in JSON encoded form
$myJSON = json_encode($result);
echo $myJSON;
?>

