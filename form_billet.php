<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<!-- Formulaire pour créer un billet -->
<form action="?action=billet" method="post">
    <label for="date_visite">Date de visite :</label>
    <input type="date" name="date_visite" id="date_visite" required><br>

    <label for="heure_visite">Heure de visite :</label>
    <input type="time" name="heure_visite" id="heure_visite" required><br>

    <label for="nombre_personnes">Nombre de personnes :</label>
    <input type="number" name="nombre_personnes" id="nombre_personnes" required><br>

    <input type="submit" value="Continuer">
</form>
</body>
</html>

