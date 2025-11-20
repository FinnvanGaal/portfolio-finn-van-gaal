<<<<<<< HEAD
<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'fgaal_php_blog';

$dbh = new mysqli($host, $user, $pass, $db);

if ($dbh->connect_error) {
    die('Connection failed: ' . $dbh->connect_error);
}
=======
<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'fgaal_php_blog';

$dbh = new mysqli($host, $user, $pass, $db);

if ($dbh->connect_error) {
    die('Connection failed: ' . $dbh->connect_error);
}
>>>>>>> 38ab6e3b03704417fcdbae3e967854145f00a340
