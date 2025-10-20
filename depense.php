<?php
require 'function.php';

$selected_year = isset($_GET['year']) ? $_GET['year'] : 2024;
$year_id = ($selected_year == 2025) ? 2 : 1;

$growth_courantes = get_growth_rate_depenses("Dépenses");
$growth_investissement = get_growth_rate_depenses("Dépenses");
$growth_dette = get_growth_rate_depenses("Dette");
$total_depenses_2024 = somme_depenses(1);
$total_depenses_2025 = somme_depenses(2);
$growth_total_depenses = $total_depenses_2024 > 0 ? number_format((($total_depenses_2025 - $total_depenses_2024) / $total_depenses_2024) * 100, 1) : "???";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableaux des Dépenses - Madagascar</title>
    <link rel="stylesheet" href="styleG.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Dépenses de l'État Malgache</h1>
            <p class="subtitle">Analyse détaillée des dépenses pour les années 2024 et 2025</p>
        </header>

        <div class="summary-cards">
            <div class="card card-courantes">
                <h3>Dépenses Courantes</h3>
                <div class="value"><?= number_format(somme_depenses_courantes($year_id), 1, ',', ' ') ?></div>
                <div class="growth">+<?= $growth_courantes ?>% vs 2024</div>
                <p>Milliards d'Ariary</p>
            </div>
            <div class="card card-investissement">
                <h3>Dépenses d'Investissement</h3>
                <div class="value"><?= number_format(total_depenses_par_categorie("Dépenses", $year_id), 1, ',', ' ') ?></div>
                <div class="growth">+<?= $growth_investissement ?>% vs 2024</div>
                <p>Milliards d'Ariary</p>
            </div>
            <div class="card card-dette">
                <h3>Service de la Dette</h3>
                <div class="value"><?= number_format(total_depenses_par_categorie("Dette", $year_id), 1, ',', ' ') ?></div>
                <div class="growth">+<?= $growth_dette ?>% vs 2024</div>
                <p>Milliards d'Ariary</p>
            </div>
            <div class="card card-total">
                <h3>Total Dépenses</h3>
                <div class="value"><?= number_format(somme_depenses($year_id), 1, ',', ' ') ?></div>
                <div class="growth">+<?= $growth_total_depenses ?>% vs 2024</div>
                <p>Milliards d'Ariary</p>
            </div>
        </div>

        <div class="section">
            <div class="section-title">
                <span>Détail des Dépenses par Catégorie - <?= $selected_year ?></span>
                <div class="year-toggle">
                    <a href="?year=2024" class="year-btn <?= $selected_year == 2024 ? 'active' : '' ?>">2024</a>
                    <a href="?year=2025" class="year-btn <?= $selected_year == 2025 ? 'active' : '' ?>">2025</a>
                </div>
            </div>

            <!-- Tableau pour les Dépenses Courantes -->
            <h3>Dépenses Courantes</h3>
            <table id="table-courantes">
                <thead>
                    <tr>
                        <th width="70%">Sous-catégorie</th>
                        <th width="30%">Montant (Mds Ariary)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $courantes_data = get_depenses_par_categorie("Dépenses", $year_id);
                    $total_courantes = 0;

                    if ($courantes_data) {
                        while ($row = mysqli_fetch_assoc($courantes_data)) {
                            
                            if (!in_array($row['sous_categorie'], ['Dépenses d\'investissement', 'PIP sur financement interne', 'PIP sur financement externe', 'Service de la dette - principal', 'Service de la dette - intérêts'])) {
                                $total_courantes += $row['montant'];
                                $class = in_array($row['sous_categorie'], ['Dépenses courantes de solde (hors indemnités)', 'Dépenses courantes hors solde', 'Intérêts de la dette']) ? 'category-header' : 'subcategory';
                                echo "<tr class='{$class}'>";
                                echo "<td>{$row['sous_categorie']}</td>";
                                echo "<td class='amount'>" . number_format($row['montant'], 1, ',', ' ') . "</td>";
                                echo "</tr>";
                            }
                        }
                    }
                    ?>
                    <tr class="total-row">
                        <td><strong>TOTAL DÉPENSES COURANTES</strong></td>
                        <td class="amount">
                            <strong><?= number_format($total_courantes, 1, ',', ' ') ?></strong>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Tableau pour les Dépenses d'Investissement -->
            <h3 style="margin-top: 30px;">Dépenses d'Investissement</h3>
            <table id="table-investissement">
                <thead>
                    <tr>
                        <th width="70%">Sous-catégorie</th>
                        <th width="30%">Montant (Mds Ariary)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $investissement_data = get_depenses_par_categorie("Dépenses", $year_id);
                    $total_investissement = 0;

                    if ($investissement_data) {
                        mysqli_data_seek($investissement_data, 0); 
                        while ($row = mysqli_fetch_assoc($investissement_data)) {
                            // Filtrer pour ne montrer que les dépenses d'investissement
                            if (in_array($row['sous_categorie'], ['Dépenses d\'investissement', 'PIP sur financement interne', 'PIP sur financement externe'])) {
                                $total_investissement += $row['montant'];
                                echo "<tr class='category-header'>";
                                echo "<td>{$row['sous_categorie']}</td>";
                                echo "<td class='amount'>" . number_format($row['montant'], 1, ',', ' ') . "</td>";
                                echo "</tr>";
                            }
                        }
                    }
                    ?>
                    <tr class="total-row">
                        <td><strong>TOTAL DÉPENSES D'INVESTISSEMENT</strong></td>
                        <td class="amount">
                            <strong><?= number_format($total_investissement, 1, ',', ' ') ?></strong>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Tableau pour le Service de la Dette -->
            <h3 style="margin-top: 30px;">Service de la Dette</h3>
            <table id="table-dette">
                <thead>
                    <tr>
                        <th width="70%">Sous-catégorie</th>
                        <th width="30%">Montant (Mds Ariary)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $dette_data = get_depenses_par_categorie("Dépenses", $year_id);
                    $dette_specifique_data = get_depenses_par_categorie("Dette", $year_id);
                    $total_dette = 0;

                    // Dette de la table principale
                    if ($dette_data) {
                        mysqli_data_seek($dette_data, 0); // Reset du pointeur
                        while ($row = mysqli_fetch_assoc($dette_data)) {
                            if (in_array($row['sous_categorie'], ['Intérêts de la dette', 'Service de la dette - principal', 'Service de la dette - intérêts'])) {
                                $total_dette += $row['montant'];
                                echo "<tr class='category-header'>";
                                echo "<td>{$row['sous_categorie']}</td>";
                                echo "<td class='amount'>" . number_format($row['montant'], 1, ',', ' ') . "</td>";
                                echo "</tr>";
                            }
                        }
                    }

                    // Dette de la table spécifique
                    if ($dette_specifique_data) {
                        while ($row = mysqli_fetch_assoc($dette_specifique_data)) {
                            $total_dette += $row['montant'];
                            echo "<tr class='category-header'>";
                            echo "<td>{$row['sous_categorie']}</td>";
                            echo "<td class='amount'>" . number_format($row['montant'], 1, ',', ' ') . "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                    <tr class="total-row">
                        <td><strong>TOTAL SERVICE DE LA DETTE</strong></td>
                        <td class="amount">
                            <strong><?= number_format($total_dette, 1, ',', ' ') ?></strong>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Tableau récapitulatif -->
            <h3 style="margin-top: 30px;">Récapitulatif des Dépenses</h3>
            <table id="table-recap">
                <thead>
                    <tr>
                        <th width="70%">Catégorie</th>
                        <th width="30%">Montant (Mds Ariary)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="category-header">
                        <td>Dépenses Courantes</td>
                        <td class="amount"><?= number_format($total_courantes, 1, ',', ' ') ?></td>
                    </tr>
                    <tr class="category-header">
                        <td>Dépenses d'Investissement</td>
                        <td class="amount"><?= number_format($total_investissement, 1, ',', ' ') ?></td>
                    </tr>
                    <tr class="category-header">
                        <td>Service de la Dette</td>
                        <td class="amount"><?= number_format($total_dette, 1, ',', ' ') ?></td>
                    </tr>
                    <tr class="total-row">
                        <td><strong>TOTAL DÉPENSES PUBLIQUES</strong></td>
                        <td class="amount">
                            <strong><?= number_format(somme_depenses($year_id), 1, ',', ' ') ?></strong>
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