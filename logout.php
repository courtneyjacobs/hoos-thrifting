<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // end session
    session_unset();
    session_destroy();
    $redir = 'http://localhost/hoos-thrifting/index.php';
    header("Location: ". $redir);
?>