<?php

include('init.php');

// Démarrer la session
session_start();

// Vérifier si la langue est déjà définie dans la session, sinon, définir la langue par défaut (fr)
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'fr';
}

// API path
$api_url = 'http://localhost:8081/api/api_controller.php';

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

                // Données à envoyer à l'API
                $data = [
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'mail' => $mail,
                    'dateVisite' => $dateVisite,
                    'HeureVisite' => $HeureVisite,
                    'NbPersonne' => $NbPersonne
                ];

                // Envoi de la requête POST à l'API pour enregistrer la réservation
                $ch = curl_init($api_url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                $response = curl_exec($ch);
                $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);

                // Vérification du statut de la réponse
                if ($status_code == 201) {
                    // Redirection vers la page de confirmation avec l'ID de réservation
                    $reservation_id = json_decode($response, true)['id_reservation'];
                    header("Location: index.php?action=confirmation&id=$reservation_id");
                    exit();
                } else {
                    // Affichage d'un message d'erreur
                    echo "Erreur lors de la réservation : " . $response;
                }
            }

            // Affichage du formulaire pour créer une réservation
            include('views/' . $_SESSION['lang'] . '/form_reservation.php');
            break;

        case 'confirmation':
            // Récupérer l'ID de réservation depuis l'URL
            $reservation_id = isset($_GET['id']) ? $_GET['id'] : null;

            // Envoi d'une requête GET à l'API pour récupérer les informations de réservation
            $api_url = "http://localhost:8081/api/api_controller.php?id=$reservation_id";
            $ch = curl_init($api_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            // Vérification du statut de la réponse
    if ($status_code == 200) {
        // Décodage de la réponse JSON
        $reservation = json_decode($response, true);

        // Envoi de l'e-mail de confirmation à l'utilisateur
        $to = $reservation['mail'];
        $subject = 'Confirmation de réservation';
        $message = '
        <html>
        <body>
            <h1>Merci pour votre réservation!</h1>
            <h2>Informations du billet :</h2>
            <p>Date de visite : ' . htmlspecialchars($reservation['dateVisite']) . '</p>
            <p>Heure de visite : ' . htmlspecialchars($reservation['HeureVisite']) . '</p> 
            <p>Nombre de personnes : ' . htmlspecialchars($reservation['NbPersonne']) . '</p>
        
            <h2>Informations de l\'utilisateur :</h2>
            <p>Nom : ' . htmlspecialchars($reservation['nom']) . '</p>
            <p>Prénom : ' . htmlspecialchars($reservation['prenom']) . '</p>
        
        </body>
        </html>
        ';

        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=UTF-8';

        if (mail($to, $subject, $message, implode("\r\n", $headers))) {
            // Redirection vers la page de confirmation
            include('views/' . $_SESSION['lang'] . '/confirmation.php');
        } else {
            // Affichage d'un message d'erreur et redirection vers le formulaire de réservation
            $error_message = "Une erreur est survenue lors de l'envoi de l'e-mail de confirmation. Veuillez réessayer.";
            include('views/' . $_SESSION['lang'] . '/form_reservation.php');
        }
    } else {
        // Affichage d'un message d'erreur et redirection vers le formulaire de réservation
        $error_message = "Une erreur est survenue lors de la récupération des informations de réservation. Veuillez réessayer.";
        include('views/' . $_SESSION['lang'] . '/form_reservation.php');
    }
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
