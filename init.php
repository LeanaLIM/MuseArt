<?php

function chargerClasse($classe)
{
    require $classe . '.php';
}

spl_autoload_register('chargerClasse');

$db = new PDO('mysql:host=localhost;dbname=museartbdd;port=8889', 'root', 'root');
