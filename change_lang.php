<?php

session_start();

// Vérifier si la langue est spécifiée dans l'URL
if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];

    // Vérifier si la langue est valide (fr ou eng)
    if ($lang === 'fr' || $lang === 'eng') {
        // Définir la langue dans la session
        $_SESSION['lang'] = $lang;
    }
}

// Rediriger vers la page précédente (peut-être index.php)
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
?>