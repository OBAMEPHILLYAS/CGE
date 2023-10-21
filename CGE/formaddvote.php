<?php
	require_once("security.php");
	require_once("roleadmin.php");
	require_once("connexion.php");

	/* requête de la liste déroulante des dossiers*/

	$ps="SELECT id_election, libelle_election FROM election";

	try{
		$ps=$pdo->prepare ("SELECT id_election, libelle_election FROM election");
		$ps->execute();
		$results=$ps->fetchAll();

	}
	catch (exception $ex){
		echo ($ex->getmessage());
	}
	/* requête de la liste déroulante des candidat*/

	$ps1="SELECT id_candidat, nom_candidat, prenom_candidat FROM candidat";

	try{
		$ps1=$pdo->prepare ("SELECT id_candidat, nom_candidat, prenom_candidat FROM candidat");
		$ps1->execute();
		$results1=$ps1->fetchAll();

	}
	catch (exception $ex){
		echo ($ex->getmessage());
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<!-- Link bootstrap css-->
		<link rel="stylesheet" type="text/css" href="css\bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="css\mystyle.css" />
	</head>
	<body>
	<?php require_once ("entete.php"); ?>
		<div class="container">
		<div class="panel panel-info panel-default spacer">
			<div class="panel-heading">
				Créer un vote</div>
			<div class="panel-body">
				<form method="post" action="savevote.php" enctype="multipart/form-data">
					<div class="navbar">
						<ul class="nav navbar-nav">
							<li>
							<!-- liste déroulante candidat-->
								<div class="form-group">
								    <label class="control-panel">Candidat:
								        <select name="id_candidat">
								            <option selected="" disabled=""> Choix du candidat</option>
								            <?php foreach ($results1 as $output) { ?>
								                <?php $nomComplet = $output['nom_candidat'] . ' ' . $output['prenom_candidat']; ?>
								                <option value="<?php echo $output['id_candidat']; ?>"><?php echo $nomComplet; ?></option>
								            <?php } ?>
								        </select>
								    </label>
								</div>

							<!--fin-->
							<!-- liste déroulante election-->
								<div class="form-group">
								    <label class="control-panel">Election:
								        <select name="id_election">
								            <option selected="" disabled=""> Choix du centre</option>
								            <?php foreach ($results as $output) { ?>
								                <option value= "<?php echo $output['id_election']; ?>"><?php echo $output['libelle_election']; ?></option>
								            <?php } ?>
								        </select>
								    </label>
								</div>
							<!--fin-->
							</li>
						</ul>
					</div>
					
					<div class="form-group">
						<label class="control-panel">CNI:</label>
						<input type="tel" name="cni_electeur" class="form-control"  placeholder="" required />
					</div>

					


					<div>
						<button type="submit" name="submit" class="btn btn-primary">Sauvegarder</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<br>
</body>
</html>