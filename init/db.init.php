<?php
// connect to the database
$host = '127.0.0.1'; // localhost
$dbname = 'webapp';
$user = 'root';
$password = '';

// mysqli connect
$db = new mysqli($host, $user, $password, $dbname);

if ($db->connect_error){
	echo 'Connection failed. '. $db->connect_error;
	die();
}


