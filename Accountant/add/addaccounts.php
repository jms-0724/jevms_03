<?php
 
require(__DIR__ . "/../../connections/connection.php");

if(isset($_POST['account_code'])) {

    $account_code = $_POST['account_code'];
    $account_name = $_POST['account_name'];
    $account_type = $_POST['account_type'];
    $account_group = $_POST['accountGroup'];
    $sql1 = $conn->prepare("SELECT * FROM tbl_account_title WHERE account_code = :account_code AND account_name = :account_name");
    $sql1->bindParam(":account_code", $account_code);
    $sql1->bindParam(":account_name", $account_name);
    if (!$sql1) {
        echo "No Statement Prepared";
    }
    $sql1->execute();
    $result = $sql1->fetchAll(PDO::FETCH_ASSOC);

    if ($result) {
        echo "Account Title Already Existing";
    } else {
        $sql2 = $conn->prepare("INSERT INTO tbl_account_title (account_code, account_name, account_type, type_code) VALUES (:accnt_code, :accnt_name, :account_type, :type_code)");
        $sql2->bindParam("accnt_code", $account_code);
        $sql2->bindParam("accnt_name", $account_name);
        $sql2->bindParam(":account_type", $account_type);
       
        $sql2->bindParam(":type_code",$account_group);
        
        if (!$sql2){
            echo "No Statement Prepared";
        } else {
            if ($sql2->execute()) {
                echo "Success";
            } else {
                echo "Failed in Inserting Accounts";
            }
                
        }
    }

}

?>