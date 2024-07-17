<?php
// Connection to the database
require_once(__DIR__ . "/../../connections/connection.php");

if(isset($_POST['uid'])){
    $uid = $_POST['uid'];
    $stmt = $conn->prepare("SELECT * FROM tbl_journal_items INNER JOIN tbl_account_title ON tbl_journal_items.account_code = tbl_account_title.account_code WHERE journal_voucher_id = :voucher_id");
    $stmt->bindParam(':voucher_id', $uid);
} else {
    $stmt = $conn->prepare("SELECT * FROM tbl_journal_items");
}

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($result) {
    foreach ($result as $row){
        ?>
            <tr class="jItems">
                <td><?=$row['account_code']?></td>
                <td><?=$row['account_name']?></td>
                <?php
                if ($row['journal_adjustment'] === "Debit"){
                    ?>
                    <td class="<?=$row['journal_adjustment']?>"><?=$row['journal_amount']?></td>
                    <td></td>
                    <?php
                } elseif ($row['journal_adjustment'] === "Credit"){
                    ?>
                    <td> </td>
                    <td class="<?=$row['journal_adjustment']?>"><?=$row['journal_amount']?></td>
                    <?php
                }

                ?>
                
            </tr>
        <?php
    }
} else {
    ?>
        <option style="display: none;"></option>
    <?php 
}

?>