<?php
// ============================================================
// TP6 - Exercice 2 : Monitoring de serveurs
// Balise d'ouverture et de fermeture de PHP : vue dans le slide 58
// ============================================================

// Commentaires // et /* */ : vus dans le slide 59

// Tableau associatif "serveurs" (slide 64) :
// cle = nom du serveur, valeur = un autre tableau associatif (cpu, ram, status)
// Les variables commencent par $ et s'affectent avec "=" (slides 59-60)
$serveurs = array(
    "api-01"   => array("cpu" => 45, "ram" => 60, "status" => "1"),
    "api-02"   => array("cpu" => 92, "ram" => 78, "status" => "1"),
    "db-prod"  => array("cpu" => 70, "ram" => 95, "status" => "1"),
    "web-01"   => array("cpu" => 30, "ram" => 40, "status" => "1"),
    "web-02"   => array("cpu" => 55, "ram" => 65, "status" => "0"),
    "cache-01" => array("cpu" => 88, "ram" => 92, "status" => "1")
);

// Fonction avec parametres et retour (slide 71)
// Operateurs arithmetiques + - / (slide 66)
// $cpu et $ram sont des variables locales a la fonction (slide 73)
function calculerScore($cpu, $ram) {
    return 100 - ($cpu + $ram) / 2;
}

// Fonction qui retourne un booleen (slide 71)
// Operateurs relationnels > et logique || (le OU) : slide 66
function estCritique($cpu, $ram) {
    return ($cpu > 85 || $ram > 90);
}

// Variables pour le resume : initialisation (slide 60)
$totalOnline = 0;
$sommeScores = 0;
$meilleurScore = -1;
$meilleurServeur = "";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Monitoring de serveurs</title>
</head>
<body>

<!-- PHP melange avec du HTML (slides 27 et 58) -->
<table id="table1" border="1">
    <tr>
        <th>Serveur</th>
        <th>CPU%</th>
        <th>RAM%</th>
        <th>Status</th>
        <th>Score</th>
        <th>État</th>
    </tr>

    <?php
    // Boucle foreach sur un tableau associatif : cle => valeur (slide 69)
    foreach ($serveurs as $nom => $infos) {

        // Acces au contenu d'un tableau associatif (slide 64)
        $cpu = $infos["cpu"];
        $ram = $infos["ram"];

        // Appel de fonction (slide 71)
        $score = calculerScore($cpu, $ram);
        $critique = estCritique($cpu, $ram);

        // Texte du status : condition if / else, operateur == (slides 66-67)
        // ("1" est compare avec ==, type juggling : slide 62)
        if ($infos["status"] == "1") {
            $statusTxt = "online";
        } else {
            $statusTxt = "offline";
        }

        // Texte de l'etat : if / elseif / else (slide 67)
        if ($critique) {
            $etat = "CRITIQUE";
        } elseif ($score >= 50) {
            $etat = "OK";
        } else {
            $etat = "ATTENTION";
        }

        // Couleur de fond de la ligne : if / elseif / else (slide 67)
        // Ordre de priorite : offline > critique > score >= 50 > sinon
        if ($statusTxt == "offline") {
            $couleur = "rgb(200,200,200)";   // gris
        } elseif ($critique) {
            $couleur = "rgb(255,180,180)";   // rouge
        } elseif ($score >= 50) {
            $couleur = "rgb(180,255,180)";   // vert
        } else {
            $couleur = "rgb(255,220,150)";   // orange
        }

        // Mise a jour du resume : incrementation $i++ et addition (slide 66)
        if ($statusTxt == "online") {
            $totalOnline++;
        }
        $sommeScores = $sommeScores + $score;
        if ($score > $meilleurScore) {
            $meilleurScore = $score;
            $meilleurServeur = $nom;
        }

        // Generation d'une ligne HTML avec echo (slide 25)
        // Variables dans une chaine entre guillemets doubles (slide 61)
        // CSS inline demande par l'enonce
        echo "<tr class=\"row\" style=\"background-color: $couleur;\">";
        echo "<td class=\"serveur\">$nom</td>";
        echo "<td class=\"cpu\">$cpu</td>";
        echo "<td class=\"ram\">$ram</td>";
        echo "<td class=\"status\">$statusTxt</td>";
        echo "<td class=\"score\">$score</td>";
        echo "<td class=\"etat\">$etat</td>";
        echo "</tr>";
    }

    // count() : fonction native sur les tableaux (slide 65)
    // Division : operateur arithmetique (slide 66)
    $moyenne = $sommeScores / count($serveurs);
    ?>
</table>

<h3>Résumé</h3>
<!-- echo pour afficher une expression (slide 25) -->
<p>Serveurs online: <span id="total_online_servers"><?php echo $totalOnline; ?></span></p>
<p>Score moyen: <span id="moy_scores"><?php echo $moyenne; ?></span></p>
<!-- Concatenation avec le point (slide 60) -->
<p>Meilleur serveur: <span id="best_serv"><?php echo $meilleurServeur . " (" . $meilleurScore . ")"; ?></span></p>

</body>
</html>