 <?php
	require_once("security.php");
	require_once("roleadmin.php");
	require_once ("connexion.php");

	/* requête de la liste déroulante*/

	$ps="SELECT id_bureau, nom_bureau FROM bureau";

	try{
		$ps=$pdo->prepare ("SELECT id_bureau, nom_bureau FROM bureau");
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
			<div class="panel-heading"> Créer un nouvel électeur</div>
			<div class="panel-body">
				<form method="post" action="saveelecteur.php">
					<div class="form-group">
						<label class="control-panel">CIN :</label>
						<input type="tel" name="cni_electeur" class="form-control" required />
					</div>
					<div class="form-group">
						<label class="control-panel">Nom:</label>
						<input type="text" name="nom_electeur" class="form-control "  placeholder="" required/>
					</div>
					<div class="form-group">
						<label class="control-panel">Prénom:</label>
						<input type="text" name="prenom_electeur" class="form-control" placeholder="" required/>
					</div>
					<div class="form-group">
						<label class="control-panel">Adresse :</label>
						<input type="text" name="adresse_electeur" class="form-control" required/>
					</div>
					<div class="form-group">
						<label class="control-panel">Date de naissance :</label>
						<input type="date" name="date_electeur" class="form-control" required/>
					</div>
					<div class="form-group">
						<label class="control-panel">Lieu de naissance :</label>
						<input type="text" name="lieu_electeur" class="form-control" required/>
					</div>
					
					<div class="form-group">
					    <label class="control-panel">Bureau:
					        <select name="id_bureau">
					            <option selected="" disabled=""> Choix bureau</option>
					            <?php foreach ($results as $output) { ?>
					                <option value="<?php echo $output['id_bureau']; ?>" required><?php echo $output['nom_bureau']; ?></option>
					            <?php } ?>
					        </select>
					    </label>
					</div>

					<div class="form-group">
						<label class="control-panel">Photo:</label>
						<input type="file" name="photo_electeur" required/>
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