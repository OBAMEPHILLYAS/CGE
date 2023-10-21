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
	<?php require_once ("entete.php"); ?>
		<div class="container ">
		<div class="panel panel-info panel-default spacer">
			<div class="panel-heading">Créer une élection</div>
			<div class="panel-body">
				<form method="post" action="saveelection.php">
					<div class="form-group">
						<label class="control-panel">Libelle:</label>
						<input type="text" name="libelle" class="form-control"  placeholder="Libelle de l'élection" required="required" />
					</div>
					<div>
						<button type="submit" name="submit" class="btn btn-primary">Publier</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<br>
<br>
<br>
<br>
<br>
<script src="https:js/sweetalert.min.js"></script>
<!--<?php require_once("pied.php");?>-->
</body>
</html>