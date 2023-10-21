<?php
	require_once("security.php");
	require_once("roleadmin.php");
	require_once ("connexion.php");

	/* requête de la liste déroulante*/

	$ps="SELECT id_election, libelle_election FROM election";

	try{
		$ps=$pdo->prepare ("SELECT id_election, libelle_election FROM election");
		$ps->execute();
		$results=$ps->fetchAll();

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
		<!-- js 
		<script type="text/javascript"  href="js/bootstrap.js"></script>
		<script type="text/javascript" href="js/bootstrap.min.js"></script>
		<script type="text/javascript"  href="js/jquery.js"></script>

		<script type="text/javascript"  href="js/script.js"></script> -->
	</head>
	<body>
	<?php require_once ("entete.php"); ?>
		<div class="container ">
		<div class="panel panel-info panel-default spacer">
			<div class="panel-heading"> Créer un nouveau candidat</div>
			<div class="panel-body">
				<form method="post" action="savecandidat.php">
					<div class="form-group">
						<label class="control-panel">Nom:</label>
						<input type="text" name="nom_candidat" class="form-control "  placeholder="Nom du candidat"/>
					</div>
					<div class="form-group">
						<label class="control-panel">Prénom:</label>
						<input type="text" name="prenom_candidat" class="form-control" placeholder="Prénom du candidat"/>
					</div>
					<div class="form-group">
						<label class="control-panel">Parti politique:</label>
						<input type="text" name="parti_candidat" class="form-control"/>
					</div>
					<div class="form-group">
					    <label class="control-panel">Election:
					        <select name="id_election">
					            <option selected="" disabled=""> Choix élection</option>
					            <?php foreach ($results as $output) { ?>
					                <option value="<?php echo $output['id_election']; ?>"><?php echo $output['libelle_election']; ?></option>
					            <?php } ?>
					        </select>
					    </label>
					</div>

					<div class="form-group">
						<label class="control-panel">Photo:</label>
						<input type="file" name="photo_candidat"/>
					</div>
					<div>
						<button type="submit" name="submit" class="btn btn-primary">Sauvegarder</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<br>
<script src="https:js/sweetalert.min.js"></script>
</body>
</html>