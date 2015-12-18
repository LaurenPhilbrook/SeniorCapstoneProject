<?php

session_start();
$_SESSION['username'] = NULL;
session_destroy();

header("Location: http://ec2-52-1-168-208.compute-1.amazonaws.com/SP/pages/login_page.php");

?>