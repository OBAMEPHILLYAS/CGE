<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<!-- css -->
		<link rel="stylesheet" type="text/css" href="css\bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="css\mystyle.css" />
		<!-- js 
		<script type="text/javascript"  href="js/bootstrap.js"></script>
		<script type="text/javascript" href="js/bootstrap.min.js"></script>
		<script type="text/javascript"  href="js/jquery.js"></script>

		<script type="text/javascript"  href="js/script.js"></script> -->
	</head>
	<body>
	<!--<?php require_once ("entete.php") ?>-->
	<!-- php authentification -->


	<!-- php authentification -->


	<div class="col-md-6 col-xs-12 col-md-offset-3 spacer" >
		<div class="panel panel-info spacer">
			<div class="panel-heading">
				<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
</svg>
				Authentification</div>
			<div class="panel-body">
				<form id="form_login" method="post" action="authentification.php">
					<div class="form-group">
						<label class="control-panel">Login:</label>
						<input id="login" type="text" name="username" class="form-control"/>
					</div>
					<div class="form-group">
						<label class="control-panel">Password:</label>
						<input id="passwors" type="password" name="password" class="form-control"/>
					</div>
					
					<div>
						<button type="submit" name="formlogin" class="btn btn-primary">Se connecter</button>
						<!--Debut alerte
					<div id="alertSI" class="alert-success alert-dismissible fade show" role="alert">Utilisateur authentifié</div>
					<div id="alertNO" class="alert-danger" role="alert">Utilisateur non authentifié</div>-->
					
				</form>
			</div>
		</div>
	</div>
	</div>
	<!--<script type="text/javascript">
		$(document).ready(function(){
			$("#alertSI").hide();
			$("#alertNO").hide();
			$("#form").submit(function(e){
				e.preventDefault();
				login = $.trim($("login").val());
				password = $.trim($("password").val());
				if (login.length>0 && password.length>0) {
					$("#alertSI").fadeTo(2000, 500).slideUp(500, function(){
						$(#alertSI).slideUp(500);
					})
				};else {
					$("#alertNO").fadeTo(2000, 500).slideUp(500, function(){
						$(#alertNO).slideUp(500);
					})
				}
			});
		})
	</script>-->
	<!--<?php require_once("pied.php");?>-->
	<!--<script type="text/javascript"  src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript"  src="js/jquery.js"></script>
<script src="js/bootstrap.bundle.js" type="text/javascript"></script>
<script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>-->
	</body>
</html>