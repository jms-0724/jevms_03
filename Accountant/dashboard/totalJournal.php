<?php
require(__DIR__ . "/../../connections/conn.php");

$stmt = $conn->prepare("SELECT count(*) AS total_journal FROM tbl_journal_entry");
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        ?>
        <span><?=$row['total_journal']?></span>
        <?php
    }
} else {
    ?>
    <span>Result Not Found</span>
    <?php
}
?> 