<?php
require 'function.php';

$selected_year = isset($_GET['year']) ? $_GET['year'] : 2024;
$year_id = ($selected_year == 2025) ? 2 : 1;

$growth_impots = get_growth_rate("Impôts");
$growth_douanes = get_growth_rate("Douanes");
$growth_non_fiscales = get_growth_rate("Recettes non fiscales");
$growth_dons = get_growth_rate("Dons");
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
                <div class="value"><?= total_recettes_par_categorie("Impôts", $year_id) ?></div>
                <div class="growth">+<?= $growth_impots ?>% vs 2024</div>
                <p>Milliards d'Ariary</p>
            </div>
            <div class="card card-douanes">
                <h3>Douanes</h3>
                <div class="value"><?= total_recettes_par_categorie("Douanes", $year_id) ?></div>
                <div class="growth">+<?= $growth_douanes ?>% vs 2024</div>
                <p>Milliards d'Ariary</p>
            </div>
            <div class="card card-non-fiscales">
                <h3>Recettes Non Fiscales</h3>
                <div class="value"><?= total_recettes_par_categorie("Recettes non fiscales", $year_id) ?></div>
                <div class="growth">+<?= $growth_non_fiscales ?>% vs 2024</div>
                <p>Milliards d'Ariary</p>
            </div>
            <div class="card card-dons">
                <h3>Dons</h3>
                <div class="value"><?= total_recettes_par_categorie("Dons", $year_id) ?></div>
                <div class="growth">+<?= $growth_dons ?>% vs 2024</div>
                <p>Milliards d'Ariary</p>
            </div>
        </div>

        <div class="section">
            <div class="section-title">
                <span>Détail des Recettes par Catégorie - <?= $selected_year ?></span>
                <div class="year-toggle">
                    <a href="?year=2024" class="year-btn <?= $selected_year == 2024 ? 'active' : '' ?>">2024</a>
                    <a href="?year=2025" class="year-btn <?= $selected_year == 2025 ? 'active' : '' ?>">2025</a>
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
                    <?php
                    $impots_data = get_recettes_par_categorie("Impôts", $year_id);
                    $total_impots = 0;

                    if ($impots_data) {
                        while ($row = mysqli_fetch_assoc($impots_data)) {
                            $total_impots += $row['montant'];
                            $class = (strpos($row['sous_categorie'], 'Impôt sur les revenus') === 0 ||
                                in_array($row['sous_categorie'], ['TVA (y compris TTM)', 'Droit d\'accise (y compris taxe environnementale)']))
                                ? 'category-header' : 'subcategory';
                            echo "<tr class='{$class}'>";
                            echo "<td>{$row['sous_categorie']}</td>";
                            echo "<td class='amount'>" . number_format($row['montant'], 1, ',', ' ') . "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                    <tr class="total-row">
                        <td><strong>TOTAL IMPÔTS</strong></td>
                        <td class="amount">
                            <strong><?= number_format(total_recettes_par_categorie("Impôts", $year_id), 1, ',', ' ') ?></strong>
                        </td>
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
                    <?php
                    $douanes_data = get_recettes_par_categorie("Douanes", $year_id);

                    if ($douanes_data) {
                        while ($row = mysqli_fetch_assoc($douanes_data)) {
                            echo "<tr class='category-header'>";
                            echo "<td>{$row['sous_categorie']}</td>";
                            echo "<td class='amount'>" . number_format($row['montant'], 1, ',', ' ') . "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                    <tr class="total-row">
                        <td><strong>TOTAL DOUANES</strong></td>
                        <td class="amount">
                            <strong><?= number_format(total_recettes_par_categorie("Douanes", $year_id), 1, ',', ' ') ?></strong>
                        </td>
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
                <tbody>
                    <?php
                    $non_fiscales_data = get_recettes_par_categorie("Recettes non fiscales", $year_id);

                    if ($non_fiscales_data) {
                        while ($row = mysqli_fetch_assoc($non_fiscales_data)) {
                            echo "<tr class='category-header'>";
                            echo "<td>{$row['sous_categorie']}</td>";
                            echo "<td class='amount'>" . number_format($row['montant'], 1, ',', ' ') . "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                    <tr class="total-row">
                        <td><strong>TOTAL RECETTES NON FISCALES</strong></td>
                        <td class="amount">
                            <strong><?= number_format(total_recettes_par_categorie("Recettes non fiscales", $year_id), 1, ',', ' ') ?></strong>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Tableau pour les Dons -->
            <h3 style="margin-top: 30px;">Dons</h3>
            <table id="table-dons">
                <thead>
                    <tr>
                        <th width="70%">Sous-catégorie</th>
                        <th width="30%">Montant (Mds Ariary)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $dons_data = get_recettes_par_categorie("Dons", $year_id);

                    if ($dons_data) {
                        while ($row = mysqli_fetch_assoc($dons_data)) {
                            echo "<tr class='category-header'>";
                            echo "<td>{$row['sous_categorie']}</td>";
                            echo "<td class='amount'>" . number_format($row['montant'], 1, ',', ' ') . "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                    <tr class="total-row">
                        <td><strong>TOTAL DONS</strong></td>
                        <td class="amount">
                            <strong><?= number_format(total_recettes_par_categorie("Dons", $year_id), 1, ',', ' ') ?></strong>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="col-12 text-center mt-4">
                <button class="btn btn-primary" type="submit"><a href="index.php">Retour au Menu</a></button>
            </div>
        </div>
    </div>
</body>

</html>