<?php

require_once(__DIR__ . '/../../connections/connection.php');

if(isset($_POST['search'])){
    $search = $_POST['search'];
    $stmt = $conn->prepare("SELECT * FROM tbl_account_title WHERE account_code LIKE '%$search%' OR account_name LIKE '%$search%'");
} else {
    $stmt = $conn->prepare("SELECT * FROM tbl_account_title ORDER BY account_code");
}

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($result) {
    foreach ($result as $row){
        ?>
        <tr>
            <td><?=$row['account_code']?></td>
            <td><?=$row['account_name']?></td>
            <td><?=$row['account_type']?></td>
            
            <td>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" onclick="editAccount(<?=$row['account_code']?>)">Update Account</a></li>
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