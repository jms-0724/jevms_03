<?php

require(__DIR__ . "/../../connections/connection.php");

if (isset($_POST['typeCode'])){


    $type_code = $_POST['typeCode'];
    $upd_account_type = $_POST['upd_type'];
    $upd_normal_balance = $_POST['upd_normal_balance'];
    $upd_type_description = $_POST['upd_description'];
    $sql1 = $conn->prepare("UPDATE tbl_account_type SET account_type = :account_type, normal_balance = :normal_balance, type_description = :type_description WHERE type_code = :type_code");
    $sql1->bindParam(':account_type', $upd_account_type);
    $sql1->bindParam(':normal_balance', $upd_normal_balance);
    $sql1->bindParam(':type_description', $upd_type_description);
    $sql1->bindParam(':type_code', $type_code);


    if($sql1->execute()){
        if($sql1->rowCount() > 0){
            echo "Success";
        } else {
            echo "No Rows Fetched";
        }
        
    } else {
        echo "Failed";
    }


}
?>