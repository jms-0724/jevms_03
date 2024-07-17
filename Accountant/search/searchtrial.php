<?php
session_start();
require_once(__DIR__ . '/../../connections/connection.php');

if(isset($_POST['search'])){
    $search = $_POST['search'];
    $stmt = $conn->prepare("SELECT tbl_account_title.account_code AS Acode, tbl_account_title.account_name, 
    SUM(CASE 
            WHEN tbl_account_type.normal_balance = 'Debit' AND tbl_trial_balance.total_debit >= tbl_trial_balance.total_credit THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
            WHEN tbl_account_type.normal_balance = 'Debit' AND tbl_trial_balance.total_debit < tbl_trial_balance.total_credit THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
            ELSE 0 
        END) AS debit_balance, 
    SUM(CASE 
            WHEN tbl_account_type.normal_balance = 'Credit' AND tbl_trial_balance.total_credit >= tbl_trial_balance.total_debit THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
            WHEN tbl_account_type.normal_balance = 'Credit' AND tbl_trial_balance.total_credit < tbl_trial_balance.total_debit THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
            ELSE 0 
        END) AS credit_balance FROM tbl_account_title INNER JOIN tbl_trial_balance ON tbl_trial_balance.account_code = tbl_account_title.account_code INNER JOIN tbl_account_type ON tbl_account_title.type_code = tbl_account_type.type_code  WHERE tbl_account_title.account_code LIKE '%$search%' OR account_name LIKE '%$search%' GROUP BY tbl_account_title.account_code, tbl_account_title.account_name ORDER BY tbl_account_title.account_code");
} else {
    $stmt = $conn->prepare("SELECT tbl_account_title.account_code AS Acode, tbl_account_title.account_name, 
    SUM(CASE 
            WHEN tbl_account_type.normal_balance = 'Debit' AND tbl_trial_balance.total_debit >= tbl_trial_balance.total_credit THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
            WHEN tbl_account_type.normal_balance = 'Debit' AND tbl_trial_balance.total_debit < tbl_trial_balance.total_credit THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
            ELSE 0 
        END) AS debit_balance, 
    SUM(CASE 
            WHEN tbl_account_type.normal_balance = 'Credit' AND tbl_trial_balance.total_credit >= tbl_trial_balance.total_debit THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
            WHEN tbl_account_type.normal_balance = 'Credit' AND tbl_trial_balance.total_credit < tbl_trial_balance.total_debit THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
            ELSE 0 
        END) AS credit_balance FROM tbl_account_title INNER JOIN tbl_trial_balance ON tbl_trial_balance.account_code = tbl_account_title.account_code INNER JOIN tbl_account_type ON tbl_account_title.type_code = tbl_account_type.type_code GROUP BY tbl_account_title.account_code, tbl_account_title.account_name ORDER BY tbl_account_title.account_code");
    
}

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($result) {
    foreach ($result as $row){
        
        ?>
        <tr>
            <td><?=$row['Acode']?></td>
            <td><?=$row['account_name']?></td>
        
            <?php
                if($row['debit_balance']> $row['credit_balance']){
                ?>
                <td><?=$row['debit_balance']?></td>
                <td></td>

                <?php
                } else {
                    ?>
                    <td></td>
                    <td><?=$row['credit_balance']?></td>
                <?php    
                }
                
                ?>
            
            
                 
            
        </tr>
        <?php
        
    }
} else {
    ?>
        <td colspan="5">No Records Found</td>
    <?php 
}
?>