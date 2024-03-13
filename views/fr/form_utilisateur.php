<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Vos coordonnées</h1>

<!-- Formulaire pour créer un utilisateur -->
<form action="?action=utilisateur&id_billet=<?php echo $_GET['id_billet']; ?>" method="post">
    <label for="nom">Nom :</label>
    <input type="text" name="nom" id="nom" required><br>

    <label for="prenom">Prénom :</label>
    <input type="text" name="prenom" id="prenom" required><br>

    <label for="email">Email :</label>
    <input type="email" name="email" id="email" required><br>

    <input type="hidden" name="id_billet" value="<?php echo $_GET['id_billet']; ?>">

    <input type="submit" value="Réserver">
</form>

    
</body>
</html>
