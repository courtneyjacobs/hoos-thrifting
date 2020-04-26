<?php
// Author: Courtney Jacobs

session_start();

// destroy cookie
setcookie('redirect', 'index.php', time()-3600);  

// end session
session_unset();

// redirect to home page
session_destroy();
$redir = 'index.php';
header("Location: ". $redir);

?>