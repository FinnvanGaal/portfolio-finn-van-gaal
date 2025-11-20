<?php

// Lijst met woorden die niet toegestaan zijn in posts en comments
$blacklist = [
    'kanker',
    'tyfus',
    'mongool',
    'hoer',
    'lul',
    'tering',
    'fuck',
    'shit',
    'idioot',
    'sukkel'
];

/**
 * Controleer of een tekst een verboden woord bevat
 */
function findBlacklistedWord(string $text)
{
    global $blacklist;
    foreach ($blacklist as $badWord) {
        if (stripos($text, $badWord) !== false) {
            return $badWord; // geeft het gevonden woord terug
        }
    }
    return false;
}
