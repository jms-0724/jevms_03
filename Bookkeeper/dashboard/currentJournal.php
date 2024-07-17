<?php
require(__DIR__ . "/../../connections/conn.php");

$datetoday = date('Y/m/d');
$stmt = $conn->prepare("SELECT count(*) AS total_journal FROM tbl_journal_entry WHERE journal_date = ?");
$stmt->bind_param('i',$datetoday);
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