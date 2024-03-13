<?php

include('init.php');
include('model.php');

// Démarrer la session
session_start();

// Vérifier si la langue est déjà définie dans la session, sinon, définir la langue par défaut (fr)
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'fr';
}

$model = new Model($db);

// Vérifier si l'action est définie
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'accueil':
            include('views/' . $_SESSION['lang'] . '/accueil.php');
            break;

        case 'billet':
            // Formulaire pour créer un billet
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $dateVisite = $_POST['date_visite'];
                $heureVisite = $_POST['heure_visite'];
                $nombrePersonnes = $_POST['nombre_personnes'];

                // Enregistrer le billet dans la base de données
                $idBillet = $model->enregistrerBillet($dateVisite, $heureVisite, $nombrePersonnes);

                // Rediriger vers le formulaire utilisateur avec l'id du billet en paramètre
                header("Location: index.php?action=utilisateur&id_billet=$idBillet");
                exit();
            }

            // Afficher le formulaire pour créer un billet
            include('views/' . $_SESSION['lang'] . '/form_billet.php');
            break;

        case 'utilisateur':
            // Formulaire pour créer un utilisateur
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $email = $_POST['email'];

                // Récupérer l'id du billet depuis l'URL
                $idBillet = isset($_GET['id_billet']) ? $_GET['id_billet'] : null;

                // Enregistrer l'utilisateur dans la base de données avec l'id du billet
                $model->enregistrerUtilisateur($nom, $prenom, $email, $idBillet);

                // Rediriger vers la page de confirmation ou autre
                header("Location: index.php?action=confirmation&id_billet=$idBillet");
                exit();
            }

            // Afficher le formulaire pour créer un utilisateur avec un champ caché pour l'id du billet
            include('views/' . $_SESSION['lang'] . '/form_utilisateur.php');
            break;

        case 'confirmation':
            // Récupérer l'id du billet depuis l'URL
            $idBillet = isset($_GET['id_billet']) ? $_GET['id_billet'] : null;

            // Récupérer les informations du billet pour afficher dans la confirmation
            $billet = $model->getBilletById($idBillet);

            // Vérifier si les clés sont définies dans le tableau $billet avant de les utiliser
            $dateVisite = isset($billet['dateVisite']) ? date('d/m/Y', strtotime($billet['dateVisite'])) : '';
            $nombrePersonnes = isset($billet['NbPersonne']) ? $billet['NbPersonne'] : '';
            $HeureVisite = isset($billet['HeureVisite']) ? substr($billet['HeureVisite'], 0, 5) : '';

            // Récupérer les informations de l'utilisateur pour afficher dans la confirmation
            $utilisateur = $model->getUtilisateurByBilletId($idBillet);

            //envoyer un mail de confirmation à l'utilisateur
            $to = $utilisateur['mail'];
            $subject = 'Confirmation de réservation';
            $message = '
            <html>
            <body>
                <h1>Merci pour votre réservation!</h1>
                <h2>Informations du billet :</h2>
                <p>Date de visite : ' . htmlspecialchars($dateVisite) . '</p>
                <p>Heure de visite : ' . htmlspecialchars($HeureVisite) . '</p> 
                <p>Nombre de personnes : ' . htmlspecialchars($nombrePersonnes) . '</p>
            
                <h2>Informations de l\'utilisateur :</h2>
                <p>Nom : ' . htmlspecialchars($utilisateur['Nom']) . '</p>
                <p>Prénom : ' . htmlspecialchars($utilisateur['Prenom']) . '</p>
            
            </body>
            </html>
            ';

            $headers[] = 'MIME-Version: 1.0';
            $headers[] = 'Content-type: text/html; charset=UTF-8';

            mail($to, $subject, $message, implode("\r\n", $headers));

            include('views/' . $_SESSION['lang'] . '/confirmation.php');
            break;

        default:
            // Rediriger vers la première étape par défaut
            header('Location: index.php?action=accueil');
            exit();
    }
} else {
    // Rediriger vers la première étape par défaut si aucune action définie
    header('Location: index.php?action=accueil');
    exit();
}
?>