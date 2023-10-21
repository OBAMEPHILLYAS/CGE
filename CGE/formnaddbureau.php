<?php
	require_once("security.php");
	require_once("roleadmin.php");
	require_once("connexion.php");

	/* requête de la liste déroulante des dossiers*/

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
	</head>
	<body>
	<?php require_once ("entete.php"); ?>
		<div class="container">
		<div class="panel panel-info panel-default spacer">
			<div class="panel-heading">
				Créer un bureau</div>
			<div class="panel-body">
				<form method="post" action="savebureau.php" enctype="multipart/form-data">
					<div class="navbar">
						<ul class="nav navbar-nav">
							<li>
							<!-- liste déroulante service-->
								<div class="form-group">
								    <label class="control-panel">Centre:
								        <select name="id_centre">
								            <option selected="" disabled=""> Choix du centre</option>
								            <?php foreach ($results as $output) { ?>
								                <option value="<?php echo $output['id_centre']; ?>"><?php echo $output['nom_centre']; ?></option>
								            <?php } ?>
								        </select>
								    </label>
								</div>
							<!--fin-->
							</li>
						</ul>
					</div>
					
					<div class="form-group">
						<label class="control-panel">Nom bureau:</label>
						<input type="text" name="nom_bureau" class="form-control"  placeholder="nom du bureau"/>
					</div>
					<div class="form-group">
						<label class="control-panel">Responsable :</label>
						<input type="text" name="responsable_bureau" class="form-control"  placeholder="Responsable du bureau"/>
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