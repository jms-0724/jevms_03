<?php
 
require(__DIR__ . "/../../connections/connection.php");

if(isset($_POST['add_category'])) {

   
    $category_name = $_POST['add_category'];
    $category_description = $_POST['add_category_description'];
    $sql1 = $conn->prepare("SELECT * FROM tbl_journal_category WHERE category_name = :category_name");
    $sql1->bindParam(":category_name", $category_name);
    if (!$sql1) {
        echo "No Statement Prepared";
    }
    $sql1->execute();
    $result = $sql1->fetchAll(PDO::FETCH_ASSOC);

    if ($result) {
        echo "Account Category Already Existing";
    } else {
        $sql2 = $conn->prepare("INSERT INTO tbl_journal_category (category_name, category_description) VALUES (:c_name, :c_description)");
        $sql2->bindParam("c_name", $category_name);
        $sql2->bindParam(":c_description", $category_description);
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