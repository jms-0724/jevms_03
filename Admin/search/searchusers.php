<?php

require_once(__DIR__ . '/../../connections/connection.php');

if(isset($_POST['search'])){
    $search = $_POST['search'];
    $stmt = $conn->prepare("SELECT * FROM `tbl_user` INNER JOIN tbl_user_info ON tbl_user.user_info_id = tbl_user_info.user_info_id WHERE user_fname LIKE '%$search%' OR user_lname LIKE '%$search%'");
} else {
    $stmt = $conn->prepare("SELECT * FROM `tbl_user` INNER JOIN tbl_user_info ON tbl_user.user_info_id = tbl_user_info.user_info_id WHERE user_status = 'Active'");
}

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($result) {
    foreach ($result as $row){
        ?>
        <tr>
            <td><?=$row['username']?></td>
            <td><?=$row['userlevel']?></td>
            <td><?=$row['user_fname']?></td>
            <td><?=$row['user_mname']?></td>
            <td><?=$row['user_lname']?></td>
            <td>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" onclick="editUser(<?=$row['uid']?>)">Update Login</a></li>
                    <li><a class="dropdown-item" onclick="editUserInfo(<?=$row['user_info_id']?>)">Update User Information</a></li>
                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#archiveUser">Archive</a></li>
                </ul>
            </div>
            </td>
        </tr>
        <?php
    }
} else {
    ?>
        <td colspan="5">No Records Found</td>
    <?php 
}
?>