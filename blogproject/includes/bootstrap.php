<?php
/**
 * ---- Bootstrap: laden aan het begin van elke pagina ----
 * Doel: sessie starten, vaste paden (constants), database,
 *       classes laden en een view-helper beschikbaar maken.
 */

// 🧠 Sessie starten
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 📍 Centrale paden als constants
define('BASE_PATH', __DIR__ . '/..');   // project root (1 map hoger)
define('INC', __DIR__);                 // pad naar /includes
define('CLS', BASE_PATH . '/classes');  // pad naar /classes
define('PARTS', INC . '/partials');

// 🗄️ Database en classes laden
require_once INC . '/db.php';
require_once CLS . '/user.php';
require_once CLS . '/posts.php';

// 🚫 Blacklist laden
require_once INC . '/blacklist.php';

// 🧩 View helper
function view(string $file, array $data = []): void
{
    extract($data, EXTR_SKIP);
    require $file;
}
