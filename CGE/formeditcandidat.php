<?php
	$numero=$_GET['id_candidat'];
	require_once("connexion.php");
	$ps=$pdo->prepare("SELECT * FROM candidat WHERE id_candidat=?");
	$params=array($numero);
	$ps->execute($params);
	$candidat=$ps->fetch();
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
	<?php require_once ("entete.php") ?>
	<div class="container">
		<div class="panel panel-info panel-default spacer ">
			<div class="panel-heading">Modifier le candidat</div>
			<div class="panel-body">
				<form method="post" action="updatecandidat.php">

					<div class="form-group">
						<label class="control-panel">Identifiant:	<?php echo($candidat ['id_candidat'])?></label>
						<input type="hidden" name="id_candidat" value="<?php echo($candidat ['id_candidat'])?>" class="form-control"/>
					</div>
					
					<div class="form-group">
						<label class="control-panel">Nom :</label>
						<input type="text" name="nom_candidat" value="<?php echo($candidat ['nom_candidat'])?>" class="form-control"/>
					</div>
					<div class="form-group">
						<label class="control-panel">Prénom :</label>
						<input type="text" name="prenom_candidat" value="<?php echo($candidat ['prenom_candidat'])?>" class="form-control"/>
					</div>
					
					<div class="form-group">
						<label class="control-panel">Parti politique :</label>
						<input type="text" name="parti_candidat" value="<?php echo($candidat ['parti_candidat'])?>" class="form-control"/>
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
						<img src="photo/<?php echo ($candidat['photo_candidat'])?>" width="100" height="100" class="img-circle"/>
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