<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/includes/loginHandler.php';

$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <base href="/rea-1/PHP/26-eindopdracht-php/mijn-blog/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="css/default.css"> 
    <link rel="stylesheet" href="css/about.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <title>Over Deze Website</title>
</head>
<body>
    <div class="container postpage">
        <?php
        view(PARTS . '/loginPopup.php', ['errorMsg' => $errorMsg ?? null]);
view(PARTS . '/header.php', ['login' => $login]);
?>

        <main class="content content--form">
            <section class="page-info">
                <h1>Over Deze Website</h1>

                <p>
                    Welkom op <strong>Mijn Blog</strong> — een online platform waar recepten, gerechten 
                    en culinaire inspiratie op een overzichtelijke manier worden gedeeld.  
                    De site is ontworpen om eenvoudig te gebruiken te zijn, met een schone lay-out en duidelijke navigatie.
                </p>

                <h2>Doel van de website</h2>
                <p>
                    Het doel van deze website is om bezoekers de mogelijkheid te geven om 
                    gerechten te ontdekken, recepten te lezen en zelf bijdragen te leveren.  
                    Zowel geregistreerde gebruikers als gasten kunnen deelnemen aan discussies via reacties.
                </p>

                <h2>Technische werking</h2>
                <ul>
                    <li>De website draait volledig op <strong>PHP</strong> en <strong>MySQL</strong></li>
                    <li>Gegevens (zoals posts en reacties) worden opgeslagen in een relationele database</li>
                    <li>De layout is opgebouwd met een grid-systeem en flexbox-ondersteuning</li>
                    <li>Er is gebruikgemaakt van <strong>object-georiënteerde code</strong> (OOP) voor beter onderhoud</li>
                    <li>Bezoekers zonder account krijgen automatisch een tijdelijk “gastprofiel”</li>
                </ul>

                <h2>Toekomstige uitbreidingen</h2>
                <p>
                    In de toekomst kan de site worden uitgebreid met functies zoals:
                </p>
                <ul>
                    <li>Een zoekfilter op ingrediënten of categorie</li>
                    <li>Favorietenlijst voor gebruikers</li>
                    <li>Beheerderspaneel om posts te beheren</li>
                    <li>Geavanceerde opmaakopties via een visuele editor</li>
                </ul>

                <h2>Visuele stijl</h2>
                <p>
                    De website gebruikt een natuurlijke kleurencombinatie van 
                    <span style="color:#588157;">olijfgroen</span>,
                    <span style="color:#a3b18a;">lichtgroen</span> en
                    <span style="color:#f6f5f3;">beige</span>.  
                    Deze kleuren zorgen voor rust, consistentie en een warme uitstraling die past bij een blog over eten en recepten.
                </p>

                <p>
                    Heb je vragen of suggesties?  
                    Laat gerust een bericht achter via de <a href="contact.php">contactpagina</a>.
                </p>
            </section>
        </main>

        <?php view(PARTS . '/footer.php'); ?>
    </div>
</body>
</html>