<?php
require(__DIR__ . "/../../connections/connection.php");

if(isset($_POST['uid'])){
	$aid=$_POST['uid'];
	$sql="SELECT * FROM tbl_journal_category WHERE category_id = '$aid'";
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