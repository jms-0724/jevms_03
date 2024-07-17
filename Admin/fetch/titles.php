<?php
// Connection to the database
require_once(__DIR__ . "/../../connections/connection.php");

if(isset($_POST['search'])){
    $search = $_POST['search'];
    $stmt = $conn->prepare("SELECT * FROM tbl_account_title");
} else {
    $stmt = $conn->prepare("SELECT * FROM tbl_account_title INNER JOIN tbl_account_type ON tbl_account_title.type_code = tbl_account_type.type_code");
}

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($result) {
    foreach ($result as $row){
        ?>
            <option style="display: none;"></option>
            <option value="<?=$row['account_name']?>" data-account-code="<?=$row['account_code']?>" data-account-type="<?=$row['account_type']?>" data-normal-balance="<?=$row['normal_balance']?>">  <?=$row['account_name']?> </option>

        <?php
    }
} else {
    ?>
        <option style="display: none;"></option>
    <?php 
}

?>