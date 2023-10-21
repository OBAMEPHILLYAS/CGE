<div class="navbar navbar-fixed-top bg-info">
	<ul class="nav navbar-nav">
		<li><a href="#" class="navbar-brand"><img src="image/logo.jpg" width="40" height="20" class="img-circle"></a></li>
		<li><a href="#"></a></li>
		<li><a href="election.php">
			<strong>ELECTION</strong></a></li>
		<li><a href="#"></a></li>
		<li><a href="candidat.php">
			<strong>CANDIDATURE</strong></a></li>
		<li><a href="#"></a></li>
		<li><a href="centre.php">
			<strong>CENTRE</strong></a></li>
		<li><a href="#"></a></li>
		<li><a href="bureau.php">
			<strong>BUREAU</strong></a></li>
		
		<li><a href="#"></a></li>

		<li><a href="electeur.php">
			<strong>ELECTEUR</strong></a>
		</li>
		<li><a href="#"></a></li>
		<li><a href="vote.php">
			<strong>VOTE</strong></a>
		</li>
		<li><a href="#"></a></li>
		<li><a href="#"></a></li>
		<li><a href="resultat.php">
			<strong>RESULTAT</strong></a>
		</li>
		<li><a href="#"></a></li>
		<li><a href="#"></a></li>
		<!--<li><a href="utilisateurs.php">
			<strong>UTILISATEUR</strong>
		</a></li>-->

			<li></li><li><a href="#"></a></li>
			<li><a href="#"></a></li>
		<li><a onclick="return confirm('Etes-vous sûr..?');" href="deconnexion.php">
			<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-power" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M5.578 4.437a5 5 0 1 0 4.922.044l.5-.866a6 6 0 1 1-5.908-.053l.486.875z"/>
  <path fill-rule="evenodd" d="M7.5 8V1h1v7h-1z"/>
</svg>
			<strong>DECONNEXION</strong>[<?php echo((isset($_SESSION['PROFILE']))?($_SESSION['PROFILE']['login']):"")?>]</a></li>
	</ul>
</div>
