<?php
//si l'action est réussie, on affiche un message dans confirmation.php
//sinon, on affiche un message d'erreur

if (isset($success) && $success === true) {
    echo "Votre réservation a bien été enregistrée.";
} else {
    echo "Une erreur est survenue lors de l'enregistrement de votre réservation.";
}


?>