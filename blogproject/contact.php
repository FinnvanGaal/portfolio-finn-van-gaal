<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/includes/loginHandler.php';
require_once __DIR__ . '/includes/mailer.php';

$currentPage = basename($_SERVER['PHP_SELF']);

?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <base href="/rea-1/PHP/26-eindopdracht-php/mijn-blog/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="css/default.css"> 
    <link rel="stylesheet" href="css/post.css"> 
    <link rel="stylesheet" href="css/contact.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <title>Contact</title>
</head>
<body>
    <div class="container postpage">
        <?php
        view(PARTS . '/loginPopup.php', ['errorMsg' => $errorMsg ?? null]);
view(PARTS . '/header.php', ['login' => $login]);
?>

        <main class="content content--form">
            <section class="contact-section">
                <h1>Contact</h1>

                    <form method="post" class="contact-form">
                        <label for="name">Naam</label>
                        <input type="text" id="name" name="name" required>

                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" required>

                        <label for="message">Bericht</label>
                        <textarea id="message" name="message" rows="5" required></textarea>

                        <button type="submit"><i class="fa-solid fa-paper-plane"></i> Verstuur</button>
                    </form>
            </section>
        </main>

        <?php view(PARTS . '/footer.php'); ?>
    </div>
</body>
</html>
