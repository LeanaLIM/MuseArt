<?php

include('init.php');
include('model.php');

$model = new Model($db);

// Vérifier si l'action est définie
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
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
            include('form_billet.php');
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
            include('form_utilisateur.php');
            break;

            case 'confirmation':
                // Récupérer l'id du billet depuis l'URL
                $idBillet = isset($_GET['id_billet']) ? $_GET['id_billet'] : null;
            
                // Récupérer les informations du billet pour afficher dans la confirmation
                $billet = $model->getBilletById($idBillet);
            
                // Vérifier si les clés sont définies dans le tableau $billet avant de les utiliser
                $dateVisite = isset($billet['dateVisite']) ? $billet['dateVisite'] : '';
                $heureVisite = isset($billet['heureVisite']) ? $billet['heureVisite'] : '';
                $nombrePersonnes = isset($billet['NbPersonne']) ? $billet['NbPersonne'] : '';
            
                // Récupérer les informations de l'utilisateur pour afficher dans la confirmation
                $utilisateur = $model->getUtilisateurByBilletId($idBillet);
            
                // Vérifier si les clés sont définies dans le tableau $utilisateur avant de les utiliser
                $email = isset($utilisateur['mail']) ? $utilisateur['mail'] : '';
            
                // Afficher la page de confirmation
                include('confirmation.php');

            break;

        default:
            // Rediriger vers la première étape par défaut
            header('Location: index.php?action=billet');
            exit();
    }
} else {
    // Rediriger vers la première étape par défaut si aucune action définie
    header('Location: index.php?action=billet');
    exit();
}
