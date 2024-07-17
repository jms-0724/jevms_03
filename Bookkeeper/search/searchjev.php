<?php
require(__DIR__ . "/../../connections/connection.php");

if(isset($_POST['uid'])){
	$jev_id=$_POST['uid'];
	$sql="SELECT * FROM tbl_journal_entry INNER JOIN tbl_journal_category ON tbl_journal_entry.category_id = tbl_journal_category.category_id WHERE journal_voucher_id = '$jev_id'";
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