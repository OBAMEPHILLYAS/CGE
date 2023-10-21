<?php require_once("connexion.php");
/*Debut. Affiche tous les dossiers*/
$req="SELECT * FROM candidat AS c, election AS e, electeur AS el, vote AS v WHERE v.id_election = e.id_election AND v.id_electeur = el.id_electeur AND v.id_candidat = c.id_candidat ";
$ps=$pdo->prepare($req);
$ps->execute();
/*Fin. Affiche tous les dossiers*/

/*##########       PAGINATION      ##########*/
	$mc="";	
	$size=5;
	if(isset($_GET['page'])){
		
		$page=$_GET['page'];
	}
	else{
		$page=0;
	}
	$offset=$size*$page;

	/*##########  RECHERCHER PAR MOT CLE ########*/
	if (isset($_GET['motcle'])){
		$mc=$_GET['motcle'];
		$req="SELECT * FROM dossier WHERE nom_dossier LIKE '%$mc%' LIMIT $size OFFSET $offset ";
	}
	else{
		$req= "SELECT * FROM candidat AS c, election AS e, electeur AS el, vote AS v WHERE v.id_election = e.id_election AND v.id_electeur = el.id_electeur AND v.id_candidat = c.id_candidat LIMIT $size OFFSET $offset"; 
	}
	$ps=$pdo->prepare($req);
	$ps->execute();


/*#########  NOMBRE DE PAGE DES TOUS LES DOSSIERS #######*/
	
	if (isset($_GET['motcle']))
		$ps2=$pdo->prepare("SELECT COUNT(*) AS NB_Dossier FROM centre WHERE nom_dossier LIKE '%$mc%'");	
	else 
		$ps2=$pdo->prepare("SELECT COUNT(*) AS NB_Dossier FROM vote");
	$ps2->execute();
	$ligne=$ps2->fetch(PDO::FETCH_ASSOC);
	$NBD=$ligne['NB_Dossier'];
	if (($NBD % $size)==0) $NBP=floor($NBD/$size);
	else $NBP=floor($NBD/$size)+1;
?>
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
		<?php require_once("entete.php");?>
		<div class="container">
			<div class="panel panel-info spacer">
				<div class="panel-heading">
					Les votes
				</div>
				<div class="panel-heading"> 
            		<button type="submit" class="btn btn-info btn-sm">
            		<a href="formaddvote.php">
            			Nouveau vote</a>
					</button> 
            	</div>
            	<div class="panel-body">
            		<table class="table table-striped">
            			<thead>
							<tr>
								<th><center>CIN</center></th><th><center>Nom Electeur</center></th><th><center>Prénom Electeur</center></th> <th><center>Nom candidat</center></th><th><center>Prénom candidat</center></th><th><center>Election</center></th>
							</tr>
						</thead>
						<tbody>
							<!--Debut. Recupère tous les dossiers et les affiche ligne par ligne-->
							<?php while ( $et=$ps->fetch()) { ?>
							<tr>
								<td value="<?php echo $et['id_electeur']; ?>"><center> <?php echo ($et['cni_electeur']) ?></center></td>

								<td value="<?php echo $et['id_electeur']; ?>"><center> <?php echo ($et['nom_electeur']) ?></center></td>

								<td value="<?php echo $et['id_electeur']; ?>"><center><?php echo ($et['prenom_electeur']) ?></center></td>

								<td value="<?php echo $et['id_candidat']; ?>"><center><?php echo ($et['nom_candidat']) ?></center></td>

								<td value="<?php echo $et['id_candidat']; ?>"><center><?php echo ($et['prenom_candidat']) ?></center></td>

								<td value="<?php echo $et['id_election']; ?>"><center><?php echo ($et['libelle_election']) ?></center></td>

						
								<!--le boutons modifier et supprimer-->

							</tr>
							<?php } ?>
							<!--Fin. Recupère tous les services et les affiche ligne par ligne-->
						</tbody>
            		</table>
            	</div>
            	<div class="pagination">
				<ul class="nav nav-pills">
					<?php for($i=0; $i<$NBP; $i++){?>
					<li class="<?php echo(($i==$page)?'active':'');?>">
						<a href='vote.php?page=<?php echo($i)?>&&motcle=<?php echo($mc)?>'> Page <?php echo($i)?></a>
					</li>
					<?php }?>
				</ul>
			</div>
			</div>
		</div>
	</body>
</html>