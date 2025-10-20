<?php
    include('function.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableaux des Recettes - Madagascar</title>
    <link rel="stylesheet" href="styleG.css">

</head>

<body>
    <div class="container">
        <header>
            <h1>Recettes de l'État Malgache</h1>
            <p class="subtitle">Analyse détaillée des recettes pour les années 2024 et 2025</p>
        </header>

        <div class="summary-cards">
            <div class="card card-impots">
                <h3>Impôts</h3>
                <div class="value"><?= total_recettes_par_categorie("Impôts", 2)?></div>
                <div class="growth">+21,4% vs 2024</div>
                <p>Milliards d'Ariary</p>
            </div>
            <div class="card card-douanes">
                <h3>Douanes</h3>
                <div class="value"><?= total_recettes_par_categorie("Douanes", 2)?></div>
                <div class="growth">+15,9% vs 2024</div>
                <p>Milliards d'Ariary</p>
            </div>
            <div class="card card-non-fiscales">
                <h3>Recettes Non Fiscales</h3>
                <div class="value">2 476,6</div>
                <div class="growth">+128,0% vs 2024</div>
                <p>Milliards d'Ariary</p>
            </div>
            <div class="card card-dons">
                <h3>Dons</h3>
                <div class="value">2 476,6</div>
                <div class="growth">+125,2% vs 2024</div>
                <p>Milliards d'Ariary</p>
            </div>
        </div>

        <div class="section">
            <div class="section-title">
                <span>Détail des Recettes par Catégorie</span>
                <div class="year-toggle">
                    <button class="year-btn active" data-year="2024">2024</button>
                    <button class="year-btn" data-year="2025">2025</button>
                </div>
            </div>

            <!-- Tableau pour les Impôts -->
            <h3>Impôts</h3>
            <table id="table-impots">
                <thead>
                    <tr>
                        <th width="70%">Sous-catégorie</th>
                        <th width="30%">Montant (Mds Ariary)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="category-header">
                        <td>Impôt sur les revenus</td>
                        <td class="amount">1 179,0</td>
                    </tr>
                    <tr class="subcategory">
                        <td>Impôt sur les revenus salariaux et assimilés</td>
                        <td class="amount">848,2</td>
                    </tr>
                    <tr class="subcategory">
                        <td>Impôt sur les revenus des capitaux mobiliers</td>
                        <td class="amount">78,2</td>
                    </tr>
                    <tr class="subcategory">
                        <td>Impôt sur les plus-values immobilières</td>
                        <td class="amount">14,0</td>
                    </tr>
                    <tr class="subcategory">
                        <td>Impôt synthétique</td>
                        <td class="amount">132,3</td>
                    </tr>
                    <tr class="subcategory">
                        <td>Droit d'enregistrement</td>
                        <td class="amount">49,0</td>
                    </tr>
                    <tr class="category-header">
                        <td>TVA (y compris TTM)</td>
                        <td class="amount">1 400,2</td>
                    </tr>
                    <tr class="category-header">
                        <td>Impôt sur les marchés publics</td>
                        <td class="amount">148,7</td>
                    </tr>
                    <tr class="category-header">
                        <td>Droit d'accise (y compris taxe environnementale)</td>
                        <td class="amount">754,1</td>
                    </tr>
                    <tr class="category-header">
                        <td>Taxes sur les assurances</td>
                        <td class="amount">17,2</td>
                    </tr>
                    <tr class="category-header">
                        <td>Droit de timbre</td>
                        <td class="amount">14,1</td>
                    </tr>
                    <tr class="category-header">
                        <td>Autres</td>
                        <td class="amount">1,5</td>
                    </tr>
                    <tr class="total-row">
                        <td>TOTAL IMPÔTS</td>
                        <td class="amount">4 636,5</td>
                    </tr>
                </tbody>
            </table>

            <!-- Tableau pour les Douanes -->
            <h3 style="margin-top: 30px;">Douanes</h3>
            <table id="table-douanes">
                <thead>
                    <tr>
                        <th width="70%">Sous-catégorie</th>
                        <th width="30%">Montant (Mds Ariary)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="category-header">
                        <td>Droit de douane</td>
                        <td class="amount">847,5</td>
                    </tr>
                    <tr class="category-header">
                        <td>TVA à l'importation</td>
                        <td class="amount">1 768,3</td>
                    </tr>
                    <tr class="category-header">
                        <td>Taxe sur les produits pétroliers</td>
                        <td class="amount">308,0</td>
                    </tr>
                    <tr class="category-header">
                        <td>TVA sur les produits pétroliers</td>
                        <td class="amount">842,8</td>
                    </tr>
                    <tr class="category-header">
                        <td>Droit de navigation</td>
                        <td class="amount">1,2</td>
                    </tr>
                    <tr class="category-header">
                        <td>Autres (douanes)</td>
                        <td class="amount">0,2</td>
                    </tr>
                    <tr class="total-row">
                        <td>TOTAL DOUANES</td>
                        <td class="amount">3 768,0</td>
                    </tr>
                </tbody>
            </table>

            <!-- Tableau pour les Recettes Non Fiscales -->
            <h3 style="margin-top: 30px;">Recettes Non Fiscales</h3>
            <table id="table-non-fiscales">
                <thead>
                    <tr>
                        <th width="70%">Sous-catégorie</th>
                        <th width="30%">Montant (Mds Ariary)</th>
                    </tr>
                </thead>
                <>
                    <tr class="category-header">
                        <td>Dividendes</td>
                        <td class="amount">89,5</td>
                    </tr>
                    <tr class="category-header">
                        <td>Productions immobilières financières</td>
                        <td class="amount">0,5</td>
                    </tr>
                    <tr class="category-header">
                        <td>Redevance de pêche</td>
                        <td class="amount">10,0</td>
                    </tr>
                    <tr class="category-header">
                        <td>Redevance minières</td>
                        <td class="amount">84,9</td>
                    </tr>
                    <tr class="category-header">
                        <td>Autres redevances</td>
                        <td class="amount">9,7</td>
                    </tr>
                    <tr class="category-header">
                        <td>Produits des activités et autres</td>
                        <td class="amount">11,1</td>
                    </tr>
                    <tr class="category-header">
                        <td>Autres</td>
                        <td class="amount">140,1</td>
                    </tr>
                    <tr class="total-row">
                        <td>TOTAL RECETTES NON FISCALES</td>
                        <td class="amount">1 086,</td>
                    </tr>
            </table>
            <div class="col-12 text-center mt-4">
                <button class="btn btn-primary" type="submit"><a href="index.php">Retour au Menu</a></button>
            </div>

        </div>
    </div>
</body>

</html>