<?php
	
	$id_bureau=$_GET['id_bureau'];
	require_once("connexion.php");
	$ps=$pdo->prepare("SELECT * FROM bureau WHERE id_bureau=?");
	$params=array($id_bureau);
	$ps->execute($params);
	$bureau=$ps->fetch();
?>
<?php
	require_once("security.php");
	require_once("roleadmin.php");



	/* requête de la liste déroulante*/

	$ps="SELECT id_centre, nom_centre FROM centre";

	try{
		$ps=$pdo->prepare ("SELECT id_centre, nom_centre FROM centre");
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
			<div class="panel-heading">Modifier un bureau</div>
			<div class="panel-body">
				<form method="post" action="updatebureau.php" enctype="multipart/form-data">

					<div class="form-group">
						<label class="control-panel">Identifiant:	<?php echo($bureau ['id_bureau'])?></label>
						<input type="hidden" name="id_bureau" value="<?php echo($bureau ['id_bureau'])?>" class="form-control"/>
					</div>

					<div class="form-group">
					    <label class="control-panel">Nom du centre:
					        <select name="id_centre">
					            <option selected="" disabled=""> Choix centre</option>
					            <?php foreach ($results as $output) { ?>
					                <option value="<?php echo $output['id_centre']; ?>"><?php echo $output['nom_centre']; ?></option>
					            <?php } ?>
					        </select>
					    </label>
					</div>

					<div class="form-group">
						<label class="control-panel">Nom bureau:	</label>
						<input type="text" name="nom_bureau" class="form-control" value="<?php echo($bureau ['nom_bureau'])?>" placeholder=""/>
					</div>
					<div class="form-group">
						<label class="control-panel">Responsable bureau:	</label>
						<input type="text" name="responsable_bureau" class="form-control" value="<?php echo($bureau ['responsable_bureau'])?>" placeholder=""/>
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