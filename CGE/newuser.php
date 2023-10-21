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
			<div class="panel-heading">Ajouter un utilisateur</div>
			<div class="panel-body">
				<form method="post" action="saveuser.php" enctype="multipart/form-data">
					<div class="form-group">
						<label class="control-panel">Login:</label>
						<input type="text" name="login" class="form-control"  placeholder="login"/>
					</div>
					<div class="form-group">
						<label class="control-panel">Password:</label>
						<input type="password" name="password" class="form-control"  placeholder="mot de passe"/>
					</div>
					<div class="form-group">
						<label class="control-panel">Rôle:</label>
						<input type="text" name="role" class="form-control"  placeholder="Rôle"/>
					</div>
					<div class="form-group">
						<label class="control-panel">Photo:</label>
						<input type="file" name="photo"/>
					</div>
					<div>
						<button type="submit" name="submit" class="btn btn-primary">Sauvegarder</button>
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
<?php require_once("pied.php");?>
</body>
</html>