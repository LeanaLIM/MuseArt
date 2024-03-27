<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MUSE & ART</title>
</head>

<body>
    <h1>SUZANNE VALADON • ACCUEIL</h1>

    <!-- Changer la langue -->

    <form action="change_lang.php" method="get">
        <label for="lang">Choisir la langue :</label>
        <select name="lang" id="lang">
            <option value="fr" <?php echo ($_SESSION['lang'] === 'fr') ? 'selected' : ''; ?>>Français</option>
            <option value="eng" <?php echo ($_SESSION['lang'] === 'eng') ? 'selected' : ''; ?>>English</option>
        </select>
        <button type="submit">Changer la langue</button>

        <a href="index.php?action=reservation">Réserver</a>

    </form>

</body>

</html> 