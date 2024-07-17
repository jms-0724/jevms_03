<?php

require(__DIR__ . "/../../connections/connection.php");

if (isset($_POST['upd_username'])){


    $uid = $_POST['uid'];
    $username = $_POST['upd_username'];
    $password = $_POST['upd_password'];
    $hashedpassword = password_hash($password, PASSWORD_BCRYPT);
    $userlevel = $_POST['upd_userlevel'];
    $sql1 = $conn->prepare("UPDATE tbl_user SET username = :username, password = :password, userlevel = :userlevel WHERE uid = :uid");
    $sql1->bindParam(':username', $username);
    $sql1->bindParam(':password', $hashedpassword);
    $sql1->bindParam(':userlevel', $userlevel);
    $sql1->bindParam(':uid', $uid);

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