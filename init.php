<?php

function chargerClasse($classe)
{
    require $classe . '.php';
}

spl_autoload_register('chargerClasse');

/* $db = new PDO('mysql:host=localhost;dbname=museartbdd;port=8889', 'root', 'root'); */

$db = new PDO('mysql:host=localhost; dbname=rabarison_museartbdd; port=3306; charset=utf8','rabarison_museart', 'museartsae08');

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
