<?php
require(__DIR__ . "/../../connections/connection.php");


if (isset($_POST['add_username'])){
    // Variable Declaration
    $add_username = trim($_POST['add_username']);
    $add_password = trim($_POST['add_password']);
    $add_userlevel = trim($_POST['add_userlevel']);
    $add_userfname = trim($_POST['add_userfname']);
    $add_usermname = trim($_POST['add_usermname']);
    $add_userlname = trim($_POST['add_userlname']);
    $user_status = "Active";

    // SQL for SELECTING Existing User
    $sql1 = $conn->prepare("SELECT * FROM tbl_user WHERE username=?");
    $sql1->bindParam(1, $add_username, PDO::PARAM_STR);
    if (!$sql1) {
        echo "NO SQL Prepared";
    };
    $sql1->execute();
    $result = $sql1->fetch(PDO::FETCH_ASSOC);
    // Validates if Username is already existing 
    if ($result) {
        echo "Username already exists";
    } else {
        $sql3 = $conn->prepare("INSERT INTO tbl_user_info (user_fname, user_mname, user_lname) VALUES(?,?,?)");
        $sql3->bindParam(1,$add_userfname,PDO::PARAM_STR);
        $sql3->bindParam(2,$add_usermname,PDO::PARAM_STR);
        $sql3->bindParam(3,$add_userlname,PDO::PARAM_STR);
        if($sql3->execute()){
            $add_user_info_id = $conn->lastInsertId();
            $sql2 = $conn->prepare("INSERT INTO tbl_user (username, password, userlevel, user_status, user_info_id) VALUES(?,?,?,?,?)");
            $hashedpassword = password_hash($add_password,PASSWORD_BCRYPT);
            $sql2->bindParam(1,$add_username,PDO::PARAM_STR);
            $sql2->bindParam(2,$hashedpassword,PDO::PARAM_STR);
            $sql2->bindParam(3,$add_userlevel,PDO::PARAM_STR);
            $sql2->bindParam(4,$user_status,PDO::PARAM_STR);
            $sql2->bindParam(5,$add_user_info_id,PDO::PARAM_INT);
            if($sql2->execute()){
                echo "Success";
            } else {
                echo "Failed in Inserting User";
            }
        } else {
            echo "Failed in Inserting User Info";
        }
    }
}
?>