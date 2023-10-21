<?php
// Inclure le fichier de connexion à la base de données
require_once("connexion.php");

// Vérifier si le formulaire a été soumis
if (isset($_POST['cni_electeur'], $_POST['id_candidat'], $_POST['id_election'])) {
    // Récupérer les données du formulaire
    $cni_electeur = $_POST['cni_electeur'];
    $id_candidat = $_POST['id_candidat'];
    $id_election = $_POST['id_election'];

    // Requête SQL pour rechercher l'identifiant de l'électeur en fonction de son CNI
    $sql_electeur = "SELECT id_electeur FROM electeur WHERE cni_electeur = ?";
    
    // Préparer la requête
    $ps_electeur = $pdo->prepare($sql_electeur);

    // Exécuter la requête en passant le CNI de l'électeur en paramètre
    $ps_electeur->execute([$cni_electeur]);

    // Récupérer l'identifiant de l'électeur (s'il existe)
    $row_electeur = $ps_electeur->fetch();

    if ($row_electeur) {
        $id_electeur = $row_electeur['id_electeur'];

        // Vérifier si l'électeur a déjà voté pour cette élection et ce candidat
        $sql_vote_exist = "SELECT id_vote FROM vote WHERE id_candidat = ? OR id_election = ? AND id_electeur = ?";
        $ps_vote_exist = $pdo->prepare($sql_vote_exist);
        $ps_vote_exist->execute([$id_candidat, $id_election, $id_electeur]);
        $row_vote_exist = $ps_vote_exist->fetch();

        if (!$row_vote_exist) {
            // L'électeur n'a pas encore voté pour cette élection et ce candidat, nous pouvons insérer le vote
            $sql_insert_vote = "INSERT INTO vote (id_candidat, id_election, id_electeur) VALUES (?, ?, ?)";
            $ps_insert_vote = $pdo->prepare($sql_insert_vote);
            $ps_insert_vote->execute([$id_candidat, $id_election, $id_electeur]);
            header("location:vote.php");
            echo "Le vote a été enregistré avec succès.";
        } else {
            echo "Cet électeur a déjà voté pour ce candidat lors de cette élection.";
        }
    } else {
        echo "Aucun électeur trouvé avec ce CNI.";
    }
}
?>
