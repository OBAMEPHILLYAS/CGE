<?php
// Récupération de l'ID du candidat à partir des données POST
$numero = isset($_POST['id_electeur']) ? $_POST['id_electeur'] : null;

// Récupération des autres données du formulaire
    $cni_electeur=$_POST['cni_electeur'];
    $nom_electeur=$_POST['nom_electeur'];
    $prenom_electeur = $_POST['prenom_electeur'];
    $adresse_electeur = $_POST['adresse_electeur'];
    $date_electeur=$_POST['date_electeur'];
    $lieu_electeur=$_POST['lieu_electeur'];
    $id_bureau=$_POST['id_bureau'];
    $photo_electeur = isset($_FILES['photo_electeur']['name']) ? $_FILES['photo_electeur']['name'] : ""; 

require_once("connexion.php");

if (!empty ($_POST['cni_electeur']) && ($_POST['nom_electeur']) && !empty($_POST['prenom_electeur']) && !empty($_POST['adresse_electeur']) && !empty($_POST['date_electeur']) && !empty($_POST['lieu_electeur']) && !empty($_POST['id_bureau']) OR !empty($_POST['photo_electeur'])) {
    if (!empty($photo_electeur)) {
        // Si une nouvelle photo est téléchargée, effectuez le téléchargement
        $file_extension = strrchr($photo_electeur, ".");
        $file_tmp_name = $_FILES['photo_electeur']['tmp_name'];
        $file_dest = './photo/' . $photo_electeur;
        $extensions_autorisees = array('.jpeg', '.png', '.JPG');

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
    $ps = $pdo->prepare("UPDATE electeur SET cni_electeur=?,nom_electeur=?, prenom_electeur=?, adresse_electeur=?, date_electeur=?, lieu_electeur=?, id_bureau=?, photo_electeur=? WHERE id_electeur = ?");
    $params = array($cni_electeur,$nom_electeur, $prenom_electeur, $adresse_electeur, $date_electeur, $lieu_electeur, $id_bureau, $photo_electeur, $numero);

    if ($ps->execute($params)) {
        header("location:electeur.php");
        exit(); // Arrête l'exécution du script après la redirection
    } else {
        echo "Une erreur est survenue lors de la mise à jour des données.";
    }
} else {
    echo "Veuillez remplir tous les champs obligatoires du formulaire.";
    header("location:formaddelecteur.php");
}

?>