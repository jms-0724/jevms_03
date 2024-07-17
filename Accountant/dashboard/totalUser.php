<?php
require(__DIR__ . "/../../connections/conn.php");

$stmt = $conn->prepare("SELECT count(*) AS user_total FROM tbl_user");
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        ?>
        <span><?=$row['user_total']?></span>
        <?php
    }
} else {
    ?>
    <span>Result Not Found</span>
    <?php
}
?> 