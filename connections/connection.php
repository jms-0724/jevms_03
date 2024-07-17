<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "db_journal_entry";

try {
  $conn = new PDO("mysql:host=$servername;dbname=db_journal_system", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {

}
?>