<?php
	$numero=$_GET['id_centre'];
	require_once("connexion.php");
	$ps=$pdo->prepare("SELECT * FROM centre WHERE id_centre=?");
	$params=array($numero);
	$ps->execute($params);
	$centre=$ps->fetch();
?>
<?php
	require_once("security.php");
	require_once("roleadmin.php");

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
				Modifier centre</div>
			<div class="panel-body">
				<form method="post" action="updatecentre.php">
					<div class="form-group">
						<label for="id_centre" class="control-panel">Identifiant : <?php echo($centre['id_centre'])?></label>
						<input type="hidden" id="id_centre" name="id_centre" value="<?php echo($centre['id_centre'])?>" class="form-control" required/>
					</div>

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
						<input type="text" name="nom_centre" value="<?php echo($centre ['nom_centre'])?>" class="form-control"/>
					</div>
					<div class="form-group">
						<label class="control-panel">Adresse :</label>
						<input type="text" name="adresse_centre" value="<?php echo($centre ['adresse_centre'])?>" class="form-control"/>
					</div>
					<div class="form-group">
						<label class="control-panel">Province :</label>
						<input type="text" name="province_centre" value="<?php echo($centre ['province_centre'])?>" class="form-control"/>
					</div>
					
					<div class="form-group">
						<label class="control-panel">Responsable :</label>
						<input type="text" name="responsable_centre" value="<?php echo($centre ['responsable_centre'])?>" class="form-control"/>
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