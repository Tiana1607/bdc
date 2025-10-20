<?php
include('function.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Citoyen Madagascar 2025</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .hero {
            background: #004aad;
            color: white;
            padding: 60px 0;
            text-align: center;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <div class="hero">
        <h1>Budget Citoyen Madagascar 2025</h1>
        <p>Comprendre simplement comment l'argent de l'État est utilisé</p>
    </div>

    <div class="container mt-5">
        <h2 class="mb-4">Aperçu rapide du budget 2025</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="stat-card text-center">
                    <h4><a href="recette.php" class="lien">Recettes 2025</a></h4>
                    <p><strong><?= somme_recettes(2) ?> milliards Ar</strong></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card text-center">
                    <h4><a href="depense.php" class="lien">Dépenses 2025</a></h4>
                    <p><strong><?= somme_depenses(2) ?> milliards Ar</strong></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card text-center">
                    <h4>Déficit 2025</h4>
                    <p><strong><?= somme_depenses(2) - somme_recettes(2) ?> milliards Ar</strong></p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>