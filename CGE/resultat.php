<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <!-- Link bootstrap css-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/mystyle.css" />
</head>
<body>
    <?php require_once("entete.php");?>
    <div class="container">
        <div class="panel panel-info spacer">
            <div class="panel-heading">
                Résultats
            </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <tbody>
                        <?php
                        // Inclure le fichier de connexion à la base de données
                        require_once("connexion.php");

                        // Sélectionner tous les candidats
                        $sql_candidats = "SELECT id_candidat, nom_candidat FROM candidat";
                        $ps_candidats = $pdo->prepare($sql_candidats);
                        $ps_candidats->execute();
                        $candidats = $ps_candidats->fetchAll(PDO::FETCH_ASSOC);

                        // Initialiser un tableau pour stocker les résultats
                        $resultats = array();

                        // Pour chaque candidat, compter le nombre de votes
                        foreach ($candidats as $candidat) {
                            $id_candidat = $candidat['id_candidat'];
                            $sql_votes = "SELECT COUNT(*) AS total_votes FROM vote WHERE id_candidat = ?";
                            $ps_votes = $pdo->prepare($sql_votes);
                            $ps_votes->execute([$id_candidat]);
                            $row = $ps_votes->fetch(PDO::FETCH_ASSOC);
                            $resultats[$candidat['nom_candidat']] = $row['total_votes'];
                        }

                        // Calculer le nombre total de votants
                        $nombre_total_votants = array_sum($resultats);

                        // Afficher les résultats
                        echo "<h1>Résultats de l'élection</h1>";
                        echo "<p>Nombre total de votants : $nombre_total_votants</p>";
                        echo "<table>";
                        echo "<tr><th>Candidat</th><th>Nombre de votes</th><th>Part du vote</th></tr>";
                        foreach ($resultats as $candidat => $votes) {
                            $part_vote = ($votes / $nombre_total_votants) * 100;
                            echo "<tr><td>$candidat</td><td>$votes</td><td>$part_vote%</td></tr>";
                        }
                        echo "</table>";
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
