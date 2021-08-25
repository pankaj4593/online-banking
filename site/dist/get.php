
<?php
$con=mysqli_connect('localhost','root', '', 'bank_db');

if(isset($_POST['custId'])){
	$id = $_POST['custId'];
{
echo "<script>alert('user');<script>";
$getting_data=mysqli_query($con,"select *  from tbl_transaction  where trnas_id='.$id.' ") or die('sql problem');
//  $decoded_value=htmlspecialchars
$response = "<table border='0' width='100%'>";
while( $row = mysqli_fetch_array($getting_data) ){
    
    $id = $row['trnas_id'];
    $name = $row['nickname'];
    $email = $row['fisrtname'];
    $contact = $row['swiftcode'];
    $country = $row['country'];

    $response .= "<tr>";
    $response .= "<td>Name : </td><td>".$name."</td>";
    $response .= "</tr>";

    $response .= "<tr>";
    $response .= "<td>Email : </td><td>".$email."</td>";
    $response .= "</tr>";

    $response .= "<tr>";
    $response .= "<td>Contact : </td><td>".$contact."</td>";
    $response .= "</tr>";

    $response .= "<tr>";
    $response .= "<td>Country : </td><td>".$country."</td>";
    $response .= "</tr>";
}
$response .= "</table>";

echo $response;
exit;
}
?>

