<?php
session_start();
require_once(__DIR__ . '/../../connections/connection.php');

if(isset($_POST['search'])){
    $search = $_POST['search'];
    $stmt = $conn->prepare("SELECT * FROM tbl_journal_entry INNER JOIN tbl_user ON tbl_user.uid = tbl_journal_entry.uid INNER JOIN tbl_user_info ON tbl_user.user_info_id = tbl_user_info.user_info_id WHERE description LIKE '%$search%' ORDER BY journal_voucher_no DESC");
} else {
    $stmt = $conn->prepare("SELECT * FROM tbl_journal_entry INNER JOIN tbl_user ON tbl_user.uid = tbl_journal_entry.uid INNER JOIN tbl_user_info ON tbl_user.user_info_id = tbl_user_info.user_info_id ORDER BY journal_voucher_no DESC");
    
}

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($result) {
    foreach ($result as $row){
        
        ?>
        <tr>
            <td><?=$row['journal_date']?></td>
            <td><?=$row['journal_voucher_no']?></td>
            <td><?=$row['description']?></td>
            <td><?=$row['user_fname']?> <?=$row['user_lname']?></td>
            
                 
            <td>
            <button class="btn btn-secondary" type="button" onclick="viewEntry(<?= $row['journal_voucher_id']?>)"><i class="lni lni-eye"></i><span>View Entry</span></button> 
            <!-- <div class="dropdown">
                
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
                <ul class="dropdown-menu">
                    <li><a href="" class="dropdown-item">Update Entries</a></li>
                    <li><a class="dropdown-item" onclick="viewEntry(<?= $row['journal_voucher_id']?>)" >View Journal Entry</a></li>

                </ul>
            </div> -->
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