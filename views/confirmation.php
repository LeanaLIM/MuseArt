<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de réservation</title>
</head>

<body>

<h2>Informations du billet :</h2>

<p>Date de visite : <?= htmlspecialchars($dateVisite) ?></p>
<p>Heure de visite : <?= htmlspecialchars($HeureVisite) ?></p> 
<p>Nombre de personnes : <?= htmlspecialchars($nombrePersonnes) ?></p>

<h2>Informations de l'utilisateur :</h2>
<p>Nom : <?= htmlspecialchars($utilisateur['Nom']) ?></p>
<p>Prénom : <?= htmlspecialchars($utilisateur['Prenom']) ?></p>
<p>Email : <?= htmlspecialchars($utilisateur['mail']) ?></p>

<p>Vous avez reçu un mail de confirmation ! </p>



</body>

</html>