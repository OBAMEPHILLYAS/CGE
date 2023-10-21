<?php
// Récupération de l'ID du candidat à partir des données POST
$numero = isset($_POST['id_centre']) ? $_POST['id_centre'] : null;

// Récupération des autres données du formulaire
$nom_centre = isset($_POST['nom_centre']) ? $_POST['nom_centre'] : "";
$adresse_centre = isset($_POST['adresse_centre']) ? $_POST['adresse_centre'] : "";
$province_centre = isset($_POST['province_centre']) ? $_POST['province_centre'] : "";
$responsable_centre = isset($_POST['responsable_centre']) ? $_POST['responsable_centre'] : "";
$id_election = isset($_POST['id_election']) ? $_POST['id_election'] : "";

require_once("connexion.php");

if (!empty($nom_centre) && !empty($adresse_centre) && !empty($province_centre) && !empty($responsable_centre) && !empty($id_election)) {
   
    // Effectuer la mise à jour des données du candidat dans la base de données
    $ps = $pdo->prepare("UPDATE centre SET nom_centre=?, adresse_centre=?, province_centre=?, responsable_centre=?, id_election=? WHERE id_centre = ?");
    $params = array($nom_centre, $adresse_centre, $province_centre, $responsable_centre, $id_election, $numero);

    if ($ps->execute($params)) {
        header("location:centre.php");
        exit(); // Arrête l'exécution du script après la redirection
    } else {
        echo "Une erreur est survenue lors de la mise à jour des données.";
    }
} else {
    echo "Veuillez remplir tous les champs obligatoires du formulaire.";
    header("location:formaddcentre.php");
}
?>
