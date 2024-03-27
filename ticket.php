<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ticket</title>
</head>

<style>
    @font-face {
        font-family: "Playfair Display";
        src: url(./fonts/PlayfairDisplay-Bold.woff2) format(woff2),
            url(./fonts/PlayfairDisplay-Bold.woff) format(woff);
        font-style: normal;
    }

    @font-face {
        font-family: "Satoshi-Black";
        src: url(./fonts/Satoshi-Black.woff2) format(woff2),
            url(./fonts/Satoshi-Black.woff) format(woff);
        font-style: normal;
    }



    h1 {
        font-size: 40px;
        color: white;
        padding: 0;
        margin: 0;
        font-family: 'Playfair Display', sans-serif;
    }

    h2 {
        color: #90242A;
        padding: 10px 0;
        margin: 0;
        font-family: 'Playfair Display', sans-serif;
    }

    section {
        display: flex;
        flex-direction: row;
        width: 700px;
        height: 300px;
        background-color: #1C1C1C;
        justify-content: space-between;
        border-radius: 20px;
        border-top: solid 20px #90242A;
    }

    .content {
        padding: 30px;
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .title {
        border-left: solid 1px white;
        padding-left: 20px;
    }

    .grp {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }

    .illu {
        display: flex;
        align-items: flex-end;
    }

    .valadon {
        position: absolute;
        width: 262px;
        transform: translate(-95px, 12px);
    }

    .eyes {
        width: 204px;
    }

    p {
        color: white;
        text-transform: uppercase;
        font-family: "Satoshi-Black";
    }
</style>

<body>

    <section>
        <div class="content">

            <div class="title">
                <h1>Suzanne Valadon</h1>
                <h2>Une vision de l'imperfection</h2>
            </div>

            <div class="info">
                <div class="grp">
                    <div>
                        <p>Day:</p>
                        <span><?= isset($reservation['dateVisite']) ? htmlspecialchars($reservation['dateVisite']) : '' ?></span>
                    </div>
                    <div>
                        <p>Name:</p>
                        <span>
                            <p><?= isset($reservation['nom']) ? htmlspecialchars($reservation['nom']) : '' ?></p>
                            <p><?= isset($reservation['prenom']) ? htmlspecialchars($reservation['prenom']) : '' ?></p>
                        </span>
                    </div>
                </div>
                <div class="grp">
                    <div>
                        <p>Hour:</p>
                        <span><?= isset($reservation['heureVisite']) ? htmlspecialchars($reservation['heureVisite']) : '' ?></span>
                    </div>
                    <div>
                        <p>Places:</p>
                        <span><?= isset($reservation['NbPersonne']) ? htmlspecialchars($reservation['NbPersonne']) : '' ?></span>
                    </div>
                </div>
            </div>

        </div>

        <div class=illu>
            <img class="valadon" src="./img/SV-TICKET.png" alt="Suzanne Valadon">
            <img class="eyes" src="./img/EYES-TICKET.png" alt="yeux">
        </div>

    </section>



</body>

</html>