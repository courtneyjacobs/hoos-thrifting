<?php 
$hostname = 'localhost:3306';
$dbname = 'hoos_thrifting';
$username = 'test';
$password = 'test';

$dsn = "mysql:host=$hostname;dbname=$dbname"; 
try {
  $db = new PDO($dsn, $username, $password);
  //echo "successfully connected";
}
catch(PDOException $e) {
  $error_message = $e->getMessage();
  echo "pdo $error_message";
}
catch(Exception $e) {
  $error_message = $e->getMessage();
    echo "ex $error_message";
}
?>