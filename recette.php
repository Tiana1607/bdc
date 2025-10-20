<?php
include('function.php');
$total24 = somme_recettes(1);
$total25 = somme_recettes(2);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recettes fiscales 2024-2025</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: lightcyan;
            min-height: 100vh;
            padding: 20px;
        }

        .chart-container {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            margin: 20px auto;
            max-width: 900px;
        }

        .chart-title {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
            font-weight: 600;
            font-size: 2rem;
        }

        .chart {
            display: flex;
            justify-content: center;
            align-items: end;
            gap: 60px;
            margin-bottom: 40px;
            position: relative;
            height: 400px;
        }

        .y-axis {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
            padding-right: 10px;
            color: #666;
            font-weight: 500;
        }

        .y-axis span {
            text-align: right;
            font-size: 0.9rem;
        }

        .year-column {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        .year-label {
            font-weight: bold;
            color: #2c3e50;
            font-size: 1.2rem;
        }

        .bar-group {
            display: flex;
            align-items: end;
            gap: 8px;
            height: 350px;
        }

        .bar {
            width: 70px;
            border-radius: 5px 5px 0 0;
            position: relative;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .bar:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .bar-impots {
            background: linear-gradient(to top, #e74c3c, #c0392b);
        }

        .bar-douanes {
            background: linear-gradient(to top, #3498db, #2980b9);
        }

        .bar-non-fiscales {
            background: linear-gradient(to top, #2ecc71, #27ae60);
        }

        .bar-dons {
            background: linear-gradient(to top, #f39c12, #e67e22);
        }

        .bar-value {
            position: absolute;
            top: -25px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
            white-space: nowrap;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .bar:hover .bar-value {
            opacity: 1;
        }

        .legend {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
            margin-top: 30px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .legend-color {
            width: 20px;
            height: 20px;
            border-radius: 4px;
        }

        .btn-primary {
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            .chart {
                gap: 30px;
                height: 300px;
            }

            .bar {
                width: 50px;
            }

            .bar-group {
                height: 250px;
            }

            .legend {
                gap: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="chart-container">
        <h1 class="chart-title">Recettes de l'État (en milliards d'Ariary)</h1>

        <div class="chart">
            <div class="y-axis">
                <span>14 000,0</span>
                <span>12 000,0</span>
                <span>10 000,0</span>
                <span>8 000,0</span>
                <span>6 000,0</span>
                <span>4 000,0</span>
                <span>2 000,0</span>
                <span>0</span>
            </div>

            <!-- 2024 -->
            <div class="year-column">
                <div class="year-label">2024</div>
                <div class="bar-group">
                    <div class="bar bar-impots" style="height: 30.1%;"
                        title="Impôts - <?= total_recettes_par_categorie("Impôts", 1) ?> Md Ar">
                        <div class="bar-value"><?= total_recettes_par_categorie("Impôts", 1) ?></div>
                    </div>
                    <div class="bar bar-douanes" style="height: 26.9%;"
                        title="Douanes - <?= total_recettes_par_categorie("Douanes", 1) ?> Md Ar">
                        <div class="bar-value"><?= total_recettes_par_categorie("Douanes", 1) ?></div>
                    </div>
                    <div class="bar bar-non-fiscales" style="height: 2.5%;"
                        title="Recettes non fiscales - <?= total_recettes_par_categorie("Recettes non fiscales", 1) ?> Md Ar">
                        <div class="bar-value"><?= total_recettes_par_categorie("Recettes non fiscales", 1) ?></div>
                    </div>
                    <div class="bar bar-dons" style="height: 7.8%;"
                        title="Dons - <?= total_recettes_par_categorie("Dons", 1) ?> Md Ar">
                        <div class="bar-value"><?= total_recettes_par_categorie("Dons", 1) ?></div>
                    </div>
                </div>
            </div>

            <!-- 2025 -->
            <div class="year-column">
                <div class="year-label">2025</div>
                <div class="bar-group">
                    <div class="bar bar-impots" style="height: 40.2%"
                        title="Impôts - <?= total_recettes_par_categorie("Impôts", 2) ?> Md Ar">
                        <div class="bar-value"><?= total_recettes_par_categorie("Impôts", 2) ?></div>
                    </div>
                    <div class="bar bar-douanes" style="height: 31.2%;"
                        title="Douanes - <?= total_recettes_par_categorie("Douanes", 2) ?> Md Ar">
                        <div class="bar-value"><?= total_recettes_par_categorie("Douanes", 2) ?></div>
                    </div>
                    <div class="bar bar-non-fiscales" style="height: 3.5%;"
                        title="Recettes non fiscales - <?= total_recettes_par_categorie("Recettes non fiscales", 2) ?> Md Ar">
                        <div class="bar-value"><?= total_recettes_par_categorie("Recettes non fiscales", 2) ?></div>
                    </div>
                    <div class="bar bar-dons" style="height: 17.7%;"
                        title="Dons - <?= total_recettes_par_categorie("Dons", 2) ?> Md Ar">
                        <div class="bar-value"><?= total_recettes_par_categorie("Dons", 2) ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="legend">
            <div class="legend-item">
                <div class="legend-color bar-impots"></div>
                <span>Impôts</span>
            </div>
            <div class="legend-item">
                <div class="legend-color bar-douanes"></div>
                <span>Douanes</span>
            </div>
            <div class="legend-item">
                <div class="legend-color bar-non-fiscales"></div>
                <span>Recettes non fiscales</span>
            </div>
            <div class="legend-item">
                <div class="legend-color bar-dons"></div>
                <span>Dons</span>
            </div>
        </div>
    </div>

    <div class="col-12 text-center mt-4">
        <a href="recette_det.php" style="color: white; text-decoration: none; display:block;">
            <button class="btn btn-primary" type="submit">Plus de détails</button>
        </a>
    </div>

</body>

</html>