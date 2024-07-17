<?php
 
require(__DIR__ . "/../../connections/connection.php");

if(isset($_POST['account_type'])) {

    $account_type = $_POST['account_type'];
    $normal_balance = $_POST['normal_balance'];
    $description = $_POST['description'];
    $sql1 = $conn->prepare("SELECT * FROM tbl_account_title WHERE account_name = :account_name");
    
    $sql1->bindParam(":account_name", $account_type);
    if (!$sql1) {
        echo "No Statement Prepared";
    }
    $sql1->execute();
    $result = $sql1->fetchAll(PDO::FETCH_ASSOC);

    if ($result) {
        echo "Account Type Already Existing";
    } else {
        $sql2 = $conn->prepare("INSERT INTO tbl_account_type (account_type, normal_balance, type_description) VALUES (:account_type, :normal_balance, :t_description)");
       
        $sql2->bindParam("account_type", $account_type);
        $sql2->bindParam(":normal_balance", $normal_balance);
        $sql2->bindParam(":t_description", $description);
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