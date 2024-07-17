<?php

require_once(__DIR__ . '/../../connections/connection.php');

if(isset($_POST['search'])){
    $search = $_POST['search'];
    $stmt = $conn->prepare("SELECT * FROM tbl_account_type WHERE type_code LIKE '%$search%' OR account_type LIKE '%$search%'");
} else {
    $stmt = $conn->prepare("SELECT * FROM tbl_account_type ORDER BY account_type");
}

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($result) {
    foreach ($result as $row){
        ?>
        <tr>
            <td><?=$row['account_type']?></td>
            <td><?=$row['normal_balance']?></td>
            <td><?=$row['type_description']?></td>
            
            
            <td>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" onclick="editAccountType(<?=$row['type_code']?>)">Edit Account Type</a></li>
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