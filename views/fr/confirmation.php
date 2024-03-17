<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de réservation</title>
</head>
<body>

<h2>Informations de la réservation :</h2>

<?php if ($reservation): ?>
    <p>Nom : <?= isset($reservation['nom']) ? htmlspecialchars($reservation['nom']) : '' ?></p>
    <p>Prénom : <?= isset($reservation['prenom']) ? htmlspecialchars($reservation['prenom']) : '' ?></p>
    <p>Email : <?= isset($reservation['mail']) ? htmlspecialchars($reservation['mail']) : '' ?></p>
    <p>Date de visite : <?= isset($reservation['dateVisite']) ? htmlspecialchars($reservation['dateVisite']) : '' ?></p>
    <p>Heure de visite : <?= isset($reservation['HeureVisite']) ? htmlspecialchars($reservation['HeureVisite']) : '' ?></p>
    <p>Nombre de personnes : <?= isset($reservation['NbPersonne']) ? htmlspecialchars($reservation['NbPersonne']) : '' ?></p>
    <!-- Ajoutez ici d'autres informations de réservation que vous souhaitez afficher -->
<?php else: ?>
    <p>La réservation n'a pas été trouvée.</p>
<?php endif; ?>

<button>télécharger le pdf</button>
<a href="index.php?action=accueil"><button>Revenir à l'accueil</button></a>

</body>
</html>