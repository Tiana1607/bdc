<?php

require 'connexion.php';

function somme_recettes($id_annee)
{
    $connexion = connection();

    $requete = "SELECT SUM(montant) AS total FROM recettes WHERE id_annee = %d";
    $final = sprintf($requete, $id_annee);
    $result = mysqli_query($connexion, $final);

    if ($result) {
        $data = mysqli_fetch_assoc($result);
        return $data['total'] ?? 0; 
    }
    return 0;
}

function somme_depenses($id_annee)
{
    $connexion = connection();

    $requete = "SELECT SUM(montant) AS total FROM depenses WHERE  id_annee = %d  AND sous_categorie = 'TOTAL dépenses publiques'";
    $final = sprintf($requete, $id_annee); 
    $result = mysqli_query($connexion, $final);

    if ($result) {
        $data = mysqli_fetch_assoc($result);
        return $data['total'] ?? 0;
    }
    return 0;
}

function total_recettes_par_categorie($categorie, $id_annee)
{
    $connexion = connection();

    $requete = "SELECT SUM(montant) AS total FROM recettes WHERE categorie = '%s' AND id_annee = %d";
    $final = sprintf($requete, $categorie, intval($id_annee));
    $result = mysqli_query($connexion, $final);

    if ($result) {
        $data = mysqli_fetch_assoc($result);
        return $data['total'] ?? 0;
    }
    return 0;
}

function get_recettes_par_categorie($categorie, $annee)
{
    $connexion = connection();
    $requete = "SELECT sous_categorie, montant FROM recettes WHERE categorie = '%s' AND id_annee = %d";
    $final = sprintf($requete, $categorie, $annee);
    $result = mysqli_query($connexion, $final);
    return $result;
}

function get_growth_rate($categorie) {
    $total_2024 = total_recettes_par_categorie($categorie, 1);
    $total_2025 = total_recettes_par_categorie($categorie, 2);
    
    // Calculer le taux de croissance
    if ($total_2024 > 0) {
        $growth = (($total_2025 - $total_2024) / $total_2024) * 100;
        return number_format($growth, 1);
    }
    
    return "???";
}


// Fonctions pour les dépenses
function somme_depenses_courantes($id_annee) {
    $connexion = connection();
    
    $requete = "SELECT SUM(montant) AS total FROM depenses 
                WHERE id_annee = %d 
                AND sous_categorie NOT IN ('Dépenses d''investissement', 'PIP sur financement interne', 'PIP sur financement externe', 'Service de la dette - principal', 'Service de la dette - intérêts')";
    $final = sprintf($requete, $id_annee);
    $result = mysqli_query($connexion, $final);

    if ($result) {
        $data = mysqli_fetch_assoc($result);
        return $data['total'] ?? 0;
    }
    return 0;
}

function total_depenses_par_categorie($categorie, $id_annee) {
    $connexion = connection();
    $requete = "SELECT SUM(montant) AS total FROM depenses WHERE categorie = '%s' AND id_annee = %d";
    $final = sprintf($requete, $categorie, intval($id_annee));
    $result = mysqli_query($connexion, $final);

    if ($result) {
        $data = mysqli_fetch_assoc($result);
        return $data['total'] ?? 0;
    }
    return 0;
}

function get_depenses_par_categorie($categorie, $annee) {
    $connexion = connection();
    $requete = "SELECT sous_categorie, montant FROM depenses WHERE categorie = '%s' AND id_annee = %d ORDER BY montant DESC";
    $final = sprintf($requete, mysqli_real_escape_string($connexion, $categorie), intval($annee));
    $result = mysqli_query($connexion, $final);
    return $result;
}

function get_growth_rate_depenses($categorie) {
    $total_2024 = total_depenses_par_categorie($categorie, 1);
    $total_2025 = total_depenses_par_categorie($categorie, 2);
    
    if ($total_2024 > 0) {
        $growth = (($total_2025 - $total_2024) / $total_2024) * 100;
        return number_format($growth, 1);
    }
    
    return "???";
}



?>
