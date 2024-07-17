<?php
require(__DIR__ . "/../../connections/connection.php");

if(isset($_POST['uid'])){
	$u_id=$_POST['uid'];
	$sql="SELECT * FROM tbl_user_info WHERE user_info_id = '$u_id'";
	$result=$conn->query($sql);
	$response=array();
	foreach ($conn->query($sql) as $row) {
		$response=$row;
	}
	echo json_encode($response);
}
else
{
	$response['status']=200; //200 means ok
	$response['message']="Invalid or data not found";
}


?>