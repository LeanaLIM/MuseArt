<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reservation.css">
    <title>Réservation</title>
    <!-- Flatpickr Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>

<body>

    <h1>Réservez votre visite</h1>

    <!-- Formulaire pour créer un reservation -->
    <form action="?action=reservation" method="post">

        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" required><br>

        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom" required><br>

        <label for="mail">mail :</label>
        <input type="mail" name="mail" id="mail" required><br>

        <div>
            <label for="dateVisite">Date de visite :</label>
            <input type="date" name="dateVisite" id="dateVisite" required min="2024-03-28"><br>
        </div>


        <select name="HeureVisite" type=time>
            <option value="">Choisissez une heure de réservation</option>
            <?php
            // Boucle pour générer les options d'heure
            for ($heure = 10; $heure <= 18; $heure++) {
                for ($minute = 0; $minute < 60; $minute += 30) {
                    // Formatage de l'heure (ajout de zéros si nécessaire)
                    $heureFormattee = sprintf("%02d:%02d", $heure, $minute);
                    echo "<option value=\"$heureFormattee\">$heureFormattee</option>";
                }
            }
            ?>
        </select>

        <div>
            <label for="NbPersonne">Nombre de personnes :</label>
            <select name="NbPersonne" id="NbPersonne" required>
                <option value="">Sélectionnez le nombre</option>
                <!-- Boucle pour générer les options de 1 à 10 -->
                <?php for ($i = 1; $i <= 10; $i++) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select><br>
        </div>

        <input type="submit" value="Continuer">
    </form>

</body>

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Configuration de Flatpickr -->
<script src="app.js" type="module"></script>

</html>