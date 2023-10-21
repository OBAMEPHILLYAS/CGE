<?php
	$numero=$_GET['id_electeur'];
	require_once("connexion.php");
	$ps=$pdo->prepare("SELECT * FROM electeur WHERE id_electeur=?");
	$params=array($numero);
	$ps->execute($params);
	$electeur=$ps->fetch();
?>
<?php
	require_once("security.php");
	require_once("roleadmin.php");

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
	<?php require_once ("entete.php") ?>
	<div class="container">
		<div class="panel panel-info panel-default spacer ">
			<div class="panel-heading">Modifier l'électeur</div>
			<div class="panel-body">
				<form method="post" action="updateelecteur.php">

					<div class="form-group">
						<label class="control-panel">Identifiant:	<?php echo($electeur ['id_electeur'])?></label>
						<input type="hidden" name="id_electeur" value="<?php echo($electeur ['id_electeur'])?>" class="form-control"/>
					</div>
					
					<div class="form-group">
						<label class="control-panel">CNI :</label>
						<input type="tel" name="cni_electeur" value="<?php echo($electeur ['cni_electeur'])?>" class="form-control"/>
					</div>
					<div class="form-group">
						<label class="control-panel">Nom :</label>
						<input type="text" name="nom_electeur" value="<?php echo($electeur ['nom_electeur'])?>" class="form-control"/>
					</div>
					<div class="form-group">
						<label class="control-panel">Prénom :</label>
						<input type="text" name="prenom_electeur" value="<?php echo($electeur ['prenom_electeur'])?>" class="form-control"/>
					</div>
					<div class="form-group">
						<label class="control-panel">Adresse :</label>
						<input type="text" name="adresse_electeur" value="<?php echo($electeur ['adresse_electeur'])?>" class="form-control"/>
					</div>
					<div class="form-group">
						<label class="control-panel">Date naissance :</label>
						<input type="date" name="date_electeur" value="<?php echo($electeur ['date_electeur'])?>" class="form-control"/>
					</div>
					<div class="form-group">
						<label class="control-panel">Lieu naissance :</label>
						<input type="text" name="lieu_electeur" value="<?php echo($electeur ['lieu_electeur'])?>" class="form-control"/>
					</div>
					

					<div class="form-group">
					    <label class="control-panel">Bureau:
					        <select name="id_bureau">
					            <option selected="" disabled=""> Choix bureau</option>
					            <?php foreach ($results as $output) { ?>
					                <option value="<?php echo $output['id_bureau']; ?>"><?php echo $output['nom_bureau']; ?></option>
					            <?php } ?>
					        </select>
					    </label>
					</div>

					
					<div class="form-group">
						<label class="control-panel">Photo:</label>
						<input type="file" name="photo_electeur"/>
						<img src="photo/<?php echo ($electeur['photo_electeur'])?>" width="100" height="100" class="img-circle"/>
					</div>
					
					<div>
						<button type="submit" name="submit" class="btn btn-primary">Sauvegarder</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	</body>
</html>