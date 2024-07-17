<?php

require(__DIR__ . "/../../connections/connection.php");

if (isset($_POST['users'])){
    $users = $_POST['users'];
    $archived = $_POST['archived'];

    $sql1 = $conn->prepare("UPDATE tbl_user SET user_status = :userstatus WHERE username = :username");
    $sql1->bindParam(':userstatus', $archived);
    $sql1->bindParam(':username', $users);

    if (!$sql1) {
        echo "No Statement Prepared";
    } else {
        if($sql1->execute()){
            echo "Success";
        } else {
            echo "Failed";
        }
    }
}
?>