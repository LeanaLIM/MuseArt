<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MUSE & ART</title>
</head>

<body>
    <h1>SUZANNE VALADON • HOMEPAGE</h1>

    <!-- Changer la langue en français -->
    <form action="change_lang.php" method="get">
        <label for="lang">Choose the language:</label>
        <select name="lang" id="lang">
            <option value="fr" <?php echo ($_SESSION['lang'] === 'fr') ? 'selected' : ''; ?>>Français</option>
            <option value="eng" <?php echo ($_SESSION['lang'] === 'eng') ? 'selected' : ''; ?>>English</option>
        </select>
        <button type="submit">Change language</button>

        <a href="index.php?action=billet">Visit</a>

</body>

</html>