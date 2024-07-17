<?php

require(__DIR__ . "/../../connections/connection.php");

if (isset($_POST['upd_code'])){


    $upd_code = $_POST['upd_code'];
    $upd_name = $_POST['upd_name'];
    $upd_account_type = $_POST['upd_account_type'];
    $type_code = $_POST['account_group'];
    $sql1 = $conn->prepare("UPDATE tbl_account_title SET account_name = :account_name, account_type = :account_type, type_code = :type_code WHERE account_code = :account_code");
    $sql1->bindParam(':account_name', $upd_name);
    $sql1->bindParam(':account_type', $upd_account_type);
    $sql1->bindParam(':type_code', $type_code);
    $sql1->bindParam(':account_code', $upd_code);

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