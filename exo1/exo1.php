<?php
// Tableau associatif : clé = nom de l'étudiant, valeur = moyenne (slide 3 : tableaux associatifs)
$etudiantsNote = [
    "JOHN"   => 9,
    "BOB"    => 15.5,
    "RAYANE" => 7,
    "ROSIE"  => 13
];

// Fonction qui retourne vrai si la note est >= 10 (slide 3 : fonctions)
function estAdmissible($note) {
    return $note >= 10; // (slide 4 : opérateurs de comparaison)
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Etudiants-Note</title>
    </head>
    <body>

    <table id="table1" border="1">
        <tr>
            <th>Etudiant</th>
            <th>Note</th>
        </tr>

        <?php
            // Boucle sur le tableau : $nom = clé, $note = valeur (slide 4 : boucle foreach)
            foreach ($etudiantsNote as $nom => $note) {

                // Vert si admissible, sinon rouge (slide 4 : structure if/else)
                if (estAdmissible($note)) {
                    $couleur = "rgb(136,248,136)"; // vert
                } else {
                    $couleur = "rgb(251,173,173)"; // rouge
                }
            ?>
            <tr class="row">
                <td class="etud"><?= $nom ?></td>
                <!-- CSS inline comme demandé dans l'énoncé -->
                <td class="note" style="background-color: <?= $couleur ?>;"><?= $note ?></td>
            </tr>
        <?php } ?>
    </table>

    </body>
</html>