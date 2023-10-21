<?php
// Récupération de l'ID du candidat à partir des données POST
$numero = isset($_POST['id_candidat']) ? $_POST['id_candidat'] : null;

// Récupération des autres données du formulaire
$nom_candidat = isset($_POST['nom_candidat']) ? $_POST['nom_candidat'] : "";
$prenom_candidat = isset($_POST['prenom_candidat']) ? $_POST['prenom_candidat'] : "";
$parti_candidat = isset($_POST['parti_candidat']) ? $_POST['parti_candidat'] : "";
$id_election = isset($_POST['id_election']) ? $_POST['id_election'] : "";
$photo_candidat = isset($_FILES['photo_candidat']['name']) ? $_FILES['photo_candidat']['name'] : "";

require_once("connexion.php");

if (!empty($nom_candidat) && !empty($prenom_candidat) && !empty($parti_candidat) && !empty($id_election)) {
    if (!empty($photo_candidat)) {
        // Si une nouvelle photo est téléchargée, effectuez le téléchargement
        $file_extension = strrchr($photo_candidat, ".");
        $file_tmp_name = $_FILES['photo_candidat']['tmp_name'];
        $file_dest = './photo/' . $photo_candidat;
        $extensions_autorisees = array('.jpeg', '.png', '.jpg');

        if (in_array($file_extension, $extensions_autorisees)) {
            if (move_uploaded_file($file_tmp_name, $file_dest)) {
                // Le téléchargement de la nouvelle photo a réussi
            } else {
                echo "Une erreur est survenue lors du téléchargement du fichier.";
                header("location:formaddcandidat.php");
                exit(); // Arrête l'exécution du script
            }
        } else {
            echo  "Vérifier extension du fichier";
            header("location:formaddcandidat.php");
            exit(); // Arrête l'exécution du script
        }
    }

    // Effectuer la mise à jour des données du candidat dans la base de données
    $ps = $pdo->prepare("UPDATE candidat SET nom_candidat=?, prenom_candidat=?, parti_candidat=?, id_election=?, photo_candidat=? WHERE id_candidat = ?");
    $params = array($nom_candidat, $prenom_candidat, $parti_candidat, $id_election, $photo_candidat, $numero);

    if ($ps->execute($params)) {
        header("location:candidat.php");
        exit(); // Arrête l'exécution du script après la redirection
    } else {
        echo "Une erreur est survenue lors de la mise à jour des données.";
    }
} else {
    echo "Veuillez remplir tous les champs obligatoires du formulaire.";
    header("location:formaddcandidat.php");
}
?>
