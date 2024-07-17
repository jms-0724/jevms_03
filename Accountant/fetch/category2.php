<?php
// Connection to the database
require_once(__DIR__ . "/../../connections/connection.php");

if(isset($_POST['search'])){
    $search = $_POST['search'];
    $stmt = $conn->prepare("SELECT * FROM tbl_journal_category WHERE category_name LIKE '%$search%'");
} else {
    $stmt = $conn->prepare("SELECT * FROM tbl_journal_category");
}

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($result) {
    foreach ($result as $row){
        ?>
            <option style="display: none;"></option>
            <option value="<?=$row['category_id']?>" data-account-code="<?=$row['category_id']?>" id="<?=$row['category_id']?>"><?=$row['category_name']?></option>
        <?php
    }
} else {
    ?>
        <option style="display: none;"></option>
    <?php 
}

?>