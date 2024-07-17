<?php
// Connection to the database
require_once(__DIR__ . "/../../connections/connection.php");

if(isset($_POST['search'])){
    $search = $_POST['search'];
    $stmt = $conn->prepare("SELECT * FROM `tbl_user` INNER JOIN tbl_user_info ON tbl_user.user_info_id = tbl_user_info.user_info_id WHERE user_fname LIKE '%$search%' OR user_lname LIKE '%$search%' OR user_status = 'Active");
} else {
    $stmt = $conn->prepare("SELECT * FROM `tbl_user` INNER JOIN tbl_user_info ON tbl_user.user_info_id = tbl_user_info.user_info_id WHERE user_status = 'Active'");
}

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($result) {
    foreach ($result as $row){
        ?>
            <option value="<?=$row['username']?>"><?=$row['username']?></option>
        <?php

    }
} else {
    ?>
        <option style="display: none;"></option>
    <?php 
}

?>