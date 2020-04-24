<?php 
// Author: Courtney Jacobs

header('Access-Control-Allow-Origin: http://localhost:4200');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');

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