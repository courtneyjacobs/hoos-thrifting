<?php
session_start();

// end session
session_unset();
session_destroy();
$redir = 'index.php';
header("Location: ". $redir);
//exit; 

?>