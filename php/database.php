<?php

$host = "MySQL 8.2 Server";
$dbname = "guviexam";
$username = "siddhucode";
$password = "siddhucode";

$mysqli = new mysqli(hostname: $host, username: $username, password: $password, database: $dbname);
                     
if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;
