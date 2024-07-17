<?php
// Connection to the database
require_once(__DIR__ . "/../../connections/connection.php");

if(isset($_POST['search'])){
    $search = $_POST['search'];
    $stmt = $conn->prepare("SELECT * FROM tbl_account_type WHERE account_type LIKE '%$search%'");
} else {
    $stmt = $conn->prepare("SELECT * FROM tbl_account_type");
}

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($result) {
    foreach ($result as $row){
        ?>
            <option style="display: none;"></option>
            <option value="<?=$row['account_type']?>" data-account-code="<?=$row['type_code']?>"><?=$row['account_type']?></option>
        <?php
    }
} else {
    ?>
        <option style="display: none;"></option>
    <?php 
}

?>