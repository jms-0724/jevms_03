<?php

require_once(__DIR__ . '/../../connections/connection.php');

if(isset($_POST['search'])){
    $search = $_POST['search'];
    $stmt = $conn->prepare("SELECT * FROM tbl_general_ledger INNER JOIN tbl_account_title ON tbl_general_ledger.account_code = tbl_account_title.account_code INNER JOIN tbl_journal_entry ON tbl_general_ledger.journal_voucher_id = tbl_journal_entry.journal_voucher_id WHERE account_name LIKE '%$search%' ORDER BY ledger_date DESC");
} else if (isset($_POST['fromFilter'])){
    $filter = $_POST['fromFilter'];
    $stmt = $conn->prepare("SELECT * FROM tbl_general_ledger INNER JOIN tbl_account_title ON tbl_general_ledger.account_code = tbl_account_title.account_code INNER JOIN tbl_journal_entry ON tbl_general_ledger.journal_voucher_id = tbl_journal_entry.journal_voucher_id WHERE account_name = :filters ORDER BY ledger_date DESC");
    $stmt->bindParam(":filters", $filter);
} else {
    $stmt = $conn->prepare("SELECT * FROM tbl_general_ledger");
}

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($result) {
    foreach ($result as $row){
        ?>
        <tr>
            <td><?=$row['ledger_date']?></td>
            <td><?=$row['description']?></td>
            <td><?=$row['journal_voucher_no']?></td>
            <td><?=$row['debit']?></td>
            <td><?=$row['credit']?></td>
        </tr>
        <?php
    }
} else {
    ?>
        <td colspan="5">No Records Found</td>
    <?php 
}
?>