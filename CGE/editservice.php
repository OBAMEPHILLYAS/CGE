<?php
	$id_election=1;
	require_once("connexion.php");
	$ps=$pdo->prepare("SELECT * FROM election WHERE id_election=?");
	$params=array($id_election);
	$ps->execute($params);
	$election=$ps->fetch();
?>
<?php
	require_once("security.php");
	require_once("roleadmin.php");
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
			<div class="panel-heading">Modifier une élection</div>
			<div class="panel-body">
				<form method="post" action="updateelection.php"> 
					<div class="form-group">
						<label class="control-panel">Libelle:</label>
						<input type="text" name="libelle" value="<?php echo($election ['libelle_election'])?>" class="form-control"/>
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