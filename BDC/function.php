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

?>
