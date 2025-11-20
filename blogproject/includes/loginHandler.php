<<<<<<< HEAD
<?php

$currentPage  = basename($_SERVER['PHP_SELF']);
$redirectPage = $_SERVER['REQUEST_URI'];

$user = new User($dbh);
$user->checkGuest();

if (isset($_POST['login'])) {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($user->login($username, $password) === true) {
        header('Location: ' . $redirectPage . '#');
        exit;
    } else {
        $errorMsg = 'Wachtwoord of gebruikersnaam is incorrect';
    }
}

if (isset($_POST['logout']) && $_POST['logout'] === 'true') {
    $user->logout($redirectPage);
}

if ($user->isLoggedIn()) {
    $login = '<a href="#profile"><i class="fa-regular fa-user"></i></a>';
} else {
    $login = '<a href="#login">Login</a>';
}
=======
<?php

$currentPage  = basename($_SERVER['PHP_SELF']);
$redirectPage = $_SERVER['REQUEST_URI'];

$user = new User($dbh);
$user->checkGuest();

if (isset($_POST['login'])) {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($user->login($username, $password) === true) {
        header('Location: ' . $redirectPage . '#');
        exit;
    } else {
        $errorMsg = 'Wachtwoord of gebruikersnaam is incorrect';
    }
}

if (isset($_POST['logout']) && $_POST['logout'] === 'true') {
    $user->logout($redirectPage);
}

if ($user->isLoggedIn()) {
    $login = '<a href="#profile"><i class="fa-regular fa-user"></i></a>';
} else {
    $login = '<a href="#login">Login</a>';
}
>>>>>>> 38ab6e3b03704417fcdbae3e967854145f00a340
