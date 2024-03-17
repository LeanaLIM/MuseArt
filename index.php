<?php

include('init.php');
include('model.php');

// Démarrer la session
session_start();

// Vérifier si la langue est déjà définie dans la session, sinon, définir la langue par défaut (fr)
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'fr';
}
$model = new Model('http://localhost:8081/api/api_controller.php');

// Vérifier si l'action est définie
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'accueil':
            // Afficher la page d'accueil
            include('views/' . $_SESSION['lang'] . '/accueil.php');
            break;

        case 'reservation':
                // Formulaire pour créer une réservation
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Récupération des données du formulaire
                    $nom = $_POST['nom'];
                    $prenom = $_POST['prenom'];
                    $mail = $_POST['mail'];
                    $dateVisite = isset($_POST['dateVisite']) ? date('Y-m-d', strtotime($_POST['dateVisite'])) : '';
                    $HeureVisite = isset($_POST['HeureVisite']) ? date('H:i', strtotime($_POST['HeureVisite'])) : '';
                    $NbPersonne = isset($_POST['NbPersonne']) ? $_POST['NbPersonne'] : '';
            
                    // Enregistrement de la réservation via le modèle
                    $result = $model->enregistrerResa($nom, $prenom, $mail, $dateVisite, $HeureVisite, $NbPersonne);
            
                    // Vérification du résultat de l'enregistrement
                    if ($result) {
                        // Récupérer l'ID de la réservation nouvellement créée
                        $reservation_data = json_decode($result, true); // Convertit en tableau associatif
                        $reservation_id = isset($reservation_data['id']) ? $reservation_data['id'] : null;
            
                        // Vérifier si l'ID de réservation est disponible
                        if ($reservation_id) {
                            // Redirection vers la page de confirmation avec l'ID dans l'URL
                            header("Location: index.php?action=confirmation&id=$reservation_id");
                            exit();
                        } else {
                            // Affichage d'une erreur si l'ID de réservation est manquant
                            echo "Erreur lors de la récupération de l'ID de réservation.";
                        }
                    } else {
                        // Affichage d'une erreur si la réservation a échoué
                        echo "Erreur lors de l'enregistrement de la réservation.";
                    }
            }
        
            // Affichage du formulaire pour créer une réservation
            include('views/' . $_SESSION['lang'] . '/form_reservation.php');
            break;

            case 'confirmation':
                // Récupérer l'id de la réservation depuis l'URL
                $id = isset($_GET['id']) ? $_GET['id'] : null;
            
                // Récupérer les informations de la réservation depuis la base de données
                $reservation = $model->getResaById($id);
            
                // Vérifier si les informations de la réservation ont été récupérées avec succès
                if ($reservation) {
                    // Affecter les valeurs des informations de la réservation à des variables
                    $nom = isset($reservation['nom']) ? $reservation['nom'] : '';
                    $prenom = isset($reservation['prenom']) ? $reservation['prenom'] : '';
                    $mail = isset($reservation['mail']) ? $reservation['mail'] : '';
                    $dateVisite = isset($reservation['dateVisite']) ? date('d/m/Y', strtotime($reservation['dateVisite'])) : '';
                    $NbPersonne = isset($reservation['nbPersonne']) ? $reservation['nbPersonne'] : '';
                    $HeureVisite = isset($reservation['heureVisite']) ? substr($reservation['heureVisite'], 0, 5) : '';
            
                    //envoyer un mail de confirmation à l'utilisateur
                    $to = $mail;
                    $subject = 'Confirmation de réservation';
                    $message = '
                    <html>
                    <body>
                        <h1>Merci pour votre réservation!</h1>
                        <h2>Informations de la réservation :</h2>
            
                        <p>Nom : ' . htmlspecialchars($nom) . '</p>
                        <p>Prénom : ' . htmlspecialchars($prenom) . '</p>
                        <p>Mail : ' . htmlspecialchars($mail) . '</p>
                        <p>Date de visite : ' . htmlspecialchars($dateVisite) . '</p>
                        <p>Heure de visite : ' . htmlspecialchars($HeureVisite) . '</p> 
                        <p>Nombre de personnes : ' . htmlspecialchars($NbPersonne) . '</p>
                
                    
                    </body>
                    </html>
                    ';
            
                    $headers[] = 'MIME-Version: 1.0';
                    $headers[] = 'Content-type: text/html; charset=UTF-8';
            
                    mail($to, $subject, $message, implode("\r\n", $headers));
            
                    // Inclure la vue de confirmation
                    include('views/' . $_SESSION['lang'] . '/confirmation.php');
                } else {
                    // Rediriger vers une page d'erreur ou afficher un message d'erreur
                    echo "Erreur lors de la récupération des informations de réservation.";
                }
                break;
            
            default:
                // Rediriger vers la première étape par défaut
                header('Location: index.php?action=accueil');
                exit();
    }
}
