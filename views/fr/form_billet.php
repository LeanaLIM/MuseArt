<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reservation.css">
    <title>Document</title>
    <!-- Flatpickr Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>

<body>

    <h1>Réservez votre visite</h1>

    <!-- Formulaire pour créer un billet -->
    <form action="?action=billet" method="post">

        <div>
            <label for="date_visite">Date de visite :</label>
            <input type="date" name="date_visite" id="date_visite" required min="2024-03-28"><br>
        </div>


        <div>
            <label for="heure_visite">Heure de visite (10h à 18h):</label>
            <input type="time" name="heure_visite" id="heure_visite" min="10:00" max="18:00" required>
            <span></span>
        </div><br>

        <div>
            <label for="nombre_personnes">Nombre de personnes :</label>
            <select name="nombre_personnes" id="nombre_personnes" required>
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