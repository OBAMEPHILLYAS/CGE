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
			<div class="panel-heading">
				Nouveau centre</div>
			<div class="panel-body">
				<form method="post" action="savecentre.php">
					<div class="form-group">
						<label class="control-panel">Election :
							<select name="id_election">
					            <option selected="" disabled=""> Choix élection</option>
					            <?php foreach ($results as $output) { ?>
					                <option value="<?php echo $output['id_election']; ?>"><?php echo $output['libelle_election']; ?></option>
					            <?php } ?>
					        </select>
						</label>
						
					</div>
					<div class="form-group">
						<label class="control-panel">Nom :</label>
						<input type="text" name="nom_centre" class="form-control "  placeholder="nom du centre"/>
					</div>
					<div class="form-group">
						<label class="control-panel">Adresse :</label>
						<input type="text" name="adresse_centre" class="form-control" placeholder="Adresse du centrer"/>
					</div>
					<div class="form-group">
						<label class="control-panel">Province :</label>
						<input type="text" name="province_centre" class="form-control" placeholder="Province du centrer"/>
					</div>
					
					<div class="form-group">
						<label class="control-panel">Responsable :</label>
						<input type="text" name="responsable_centre" class="form-control" placeholder="Responsable du centrer"/>
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