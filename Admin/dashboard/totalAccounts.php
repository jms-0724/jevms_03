<?php
require(__DIR__ . "/../../connections/conn.php");

$stmt = $conn->prepare("SELECT count(*) AS total_titles FROM tbl_account_title");
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        ?>
        <span><?=$row['total_titles']?></span>
        <?php
    }
} else {
    ?>
    <span>Result Not Found</span>
    <?php
}
?> 