<?php

$username = "adminDB_89";
$password = "S3cure#dbUsr";
$dbname = "benditapizza";

try {
  $conn = new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>