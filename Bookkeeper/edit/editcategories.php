<?php

require(__DIR__ . "/../../connections/connection.php");

if (isset($_POST['cCode'])){


    $cCode = $_POST['cCode'];
    $upd_category = $_POST['upd_category'];
    $upd_description2 = $_POST['upd_description2'];
    
    $sql1 = $conn->prepare("UPDATE tbl_journal_category SET category_name = :category_name, category_description = :category_description WHERE category_id = :category_id");
    $sql1->bindParam(':category_name', $upd_category);
    $sql1->bindParam(':category_description', $upd_description2);
    $sql1->bindParam(':category_id', $cCode);
    
   


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