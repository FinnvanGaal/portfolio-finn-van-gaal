<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'fgaal_php_blog';

$dbh = new mysqli($host, $user, $pass, $db);

if ($dbh->connect_error) {
    die('Connection failed: ' . $dbh->connect_error);
}
