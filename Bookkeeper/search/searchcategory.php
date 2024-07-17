<?php

require_once(__DIR__ . '/../../connections/connection.php');

if(isset($_POST['search'])){
    $search = $_POST['search'];
    $stmt = $conn->prepare("SELECT * FROM tbl_journal_category WHERE category_id LIKE '%$search%' OR category_name LIKE '%$search%'");
} else {
    $stmt = $conn->prepare("SELECT * FROM tbl_journal_category ORDER BY category_name");
}

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($result) {
    foreach ($result as $row){
        ?>
        <tr>
            <td><?=$row['category_name']?></td>
            <td><?=$row['category_description']?></td>
            
            
            <td>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" onclick="editAccountCategory(<?=$row['category_id'] ?>)">Update Account</a></li>
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