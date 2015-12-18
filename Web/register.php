<?php

$dbhost = 'localhost';
$dbname = 'olsenchr';
$dbuser = 'olsenchr-db';
$dbpass = '6wwVfmkYnAR8MgrY';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass)
	or die("Error connecting");

mysqli_select_db($conn, $dbname)
	or die("ERROR selecting");

$usercheck = htmlspecialchars($argv[1]);

mt_srand();
$salt = mt_rand();
$d_pass = sha1($salt . $argv[2]);

$insert = mysqli_query($conn, "INSERT INTO mp_authentication VALUES ('$usercheck', '$d_pass', '$salt')")
	or die("Something went wrong.");

mysqli_close($conn);

?>
