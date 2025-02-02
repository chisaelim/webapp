<?php
$host = '127.0.0.1'; //you can use localhost
$dbname = 'web_app';
$user = 'root';
$password = '';

//mysql connect
$db = new mysqli($host, $user, $password, $dbname);

if ($db->connect_error) {
    echo 'Connection failed.' . $db->connect_error;
    die();
}
