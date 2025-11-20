<?php
require_once __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/includes/loginHandler.php';

$currentPage = basename($_SERVER['PHP_SELF']);

$user = new User($dbh);
$errorMsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $passwordConfirm = $_POST['password_confirm'] ?? '';


    if ($username === '' || $email === '' || $password === '' || $passwordConfirm === '') {
        $errorMsg = "Vul alle velden in.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg = "Voer een geldig e-mailadres in.";
    } elseif ($password !== $passwordConfirm) {
        $errorMsg = "De wachtwoorden komen niet overeen.";
    } elseif ($user->usernameExists($username)) {
        $errorMsg = "De gebruikersnaam bestaat al. Kies een andere.";
    } elseif ($user->emailExists($email)) {
        $errorMsg = "Dit e-mailadres is al in gebruik.";
    } else {
        if ($user->register($username, $email, $password)) {
            header("Location: /rea-1/PHP/26-eindopdracht-php/mijn-blog/#login");

            exit;
        } else {
            $errorMsg = "Er is een fout opgetreden bij het aanmaken van je account.";
        }
    }
}

$user = new User($dbh);
$lastVisitMessage = $user->lastVisit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/rea-1/PHP/26-eindopdracht-php/mijn-blog/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/default.css"> 
    <link rel="stylesheet" href="css/register.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Document</title>
</head>
<body>

    <div class="container postpage">
<?php
view(PARTS . '/loginPopup.php', [
    'errorMsg' => $errorMsg ?? null
]);
view(PARTS . '/header.php', ['login' => $login]);
view(PARTS . '/main.php', [
        'currentPage' => $currentPage,
        'errorMsg' => $errorMsg,
                ]);
view(PARTS . '/footer.php', ['lastVisitMessage' => $lastVisitMessage]);
?>
    </div>
</body>
</html>

