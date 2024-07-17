<?php
session_start();
require("./connections/connection.php");

if(isset($_SESSION['userid'])){
    if($_SESSION['userlevel'] == 'admin' ){
        header("location: Admin/admin.php");
    } else if ($_SESSION['userlevel'] == 'accountant') {
        header("location: Accountant/accountant.php");
    } else {
        header("location: Bookkeeper/bookkeeper.php");
    }
}  
// else {
//     header("Location: index.php");
// }
if(isset($_POST['username'])){

    $uname = $_POST['username'];
    $pword =  $_POST['password'];

    // Prepare Statement
    $sql = $conn->prepare("SELECT * FROM tbl_user INNER JOIN tbl_user_info ON tbl_user.user_info_id = tbl_user_info.user_info_id WHERE username = :username");

    if (!$sql){
        echo "Statement not prepared";
    } else {
        // Bind Parameters
        $sql->bindParam(":username",$uname,PDO::PARAM_STR);

        // Execute Sql Statement
        $sql->execute();

        if($sql->rowCount() > 0 ){
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $hashed_password = $row['password'];

            if(password_verify($pword, $hashed_password)){
                $userlevel = $row['userlevel'];
                $_SESSION['userid'] = $row['uid'];
                $_SESSION['username'] = $row['username'];

                if($userlevel === "Administrator"){
                    $_SESSION['userlevel'] = "admin";
                    $_SESSION['ulvl'] = $row['userlevel'];
                    $_SESSION['fname'] = $row['user_fname'];
                    echo "admin";
                } else if($userlevel === "Accountant") {
                    $_SESSION['userlevel'] = "accountant";
                    echo "accountant";
                    $_SESSION['ulvl'] = $row['userlevel'];
                    $_SESSION['fname'] = $row['user_fname'];
                } else {
                    $_SESSION['userlevel'] = "bookkeeper";
                    echo "accountant";
                    $_SESSION['ulvl'] = $row['userlevel'];
                    $_SESSION['fname'] = $row['user_fname'];
                }
            } else {
            echo "Incorrect Password";
            }

        } else {
        echo "No User is Found";
        }
    }
    
} else {
    echo "Invalid Request";
}

?>